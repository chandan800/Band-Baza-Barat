<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\SubscriptionPlanController;
use App\Models\UserSubscription;
use App\Models\UserPhoto;


class UserController extends Controller
{
    protected $twilio;
    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }
    
    public function index() {
        $users = User::with(['profile', 'photos'])->get();
        return view('home',compact('users'));  
    }

    // Search
    public function search(Request $request)
{
    $users = collect(); // default empty collection

    // ✅ Check agar query params diye gaye hain tabhi search run karo
    if ($request->query()) {
        $query = User::with(['profile', 'photos']);

        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        // ✅ Age range parsing
        if ($request->ageRange) {
            if ($request->ageRange === "41+") {
                $query->whereHas('profile', fn($q) =>
                    $q->where('age', '>=', 41)
                );
            } else {
                [$ageMin, $ageMax] = explode('-', $request->ageRange);
                $query->whereHas('profile', fn($q) =>
                    $q->whereBetween('age', [(int)$ageMin, (int)$ageMax])
                );
            }
        }

        if ($request->caste) {
            $query->whereHas('profile', fn($q) => $q->where('caste', $request->caste));
        }

        if ($request->state) {
            $query->whereHas('profile', fn($q) => $q->where('current_state', $request->state));
        }

        if ($request->education) {
            $query->whereHas('profile', fn($q) => $q->where('education', $request->education));
        }

        if ($request->occupation) {
            $query->whereHas('profile', fn($q) => $q->where('occupation', $request->occupation));
        }

        if ($request->heightRange) {
            [$heightMin, $heightMax] = explode('-', $request->heightRange);
            $query->whereHas('profile', fn($q) =>
                $q->whereBetween('height_cm', [(int)$heightMin, (int)$heightMax])
            );
        }

        $users = $query->get();
    }

    // ----------------------------
    // 📌 Populate dropdown filters
    // ----------------------------
    $educations = User::with('profile')->get()->pluck('profile.education')->filter()->unique()->values();
    $occupations = User::with('profile')->get()->pluck('profile.occupation')->filter()->unique()->values();
    $states = User::with('profile')->get()->pluck('profile.current_state')->filter()->unique()->values();
    $castes = User::with('profile')->get()->pluck('profile.caste')->filter()->unique()->values();

    $ageMin = User::with('profile')->get()->pluck('profile.age')->filter()->min() ?? 18;
    $ageMax = User::with('profile')->get()->pluck('profile.age')->filter()->max() ?? 60;

    $heightMin = User::with('profile')->get()->pluck('profile.height_cm')->filter()->min() ?? 150;
    $heightMax = User::with('profile')->get()->pluck('profile.height_cm')->filter()->max() ?? 180;

    return view('search', compact(
        'users',
        'educations',
        'occupations',
        'states',
        'castes',
        'ageMin',
        'ageMax',
        'heightMin',
        'heightMax'
    ));
}

   public function searchById(Request $request)
{
    $request->validate([
        'profile_id' => 'required'
    ]);

    $users= User::with(['profile', 'photos'])
        ->whereHas('profile', function($q) use ($request) {
            $q->where('profile_key', $request->profile_id);
        })
        ->first();

    if (!$users) {
        return response()->json([
            'success' => false,
            'html' => '<p class="text-center text-danger fw-bold">Profile not found</p>'
        ]);
    }

    $html = view('partials._profile-card', compact('users'))->render();

    return response()->json([
        'success' => true,
        'html' => $html
    ]);
}

public function basicSearch(Request $request)
{
    $users = User::with(['profile', 'photos'])
        ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
        ->when($request->ageMin && $request->ageMax, function ($q) use ($request) {
            $q->whereHas('profile', fn($query) =>
                $query->whereBetween('age', [(int)$request->ageMin, (int)$request->ageMax])
            );
        })
        ->when($request->caste, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('caste', $request->caste))
        )
        ->when($request->state, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('current_state', $request->state))
        )
        ->when($request->education, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('education', $request->education))
        )
        ->when($request->occupation, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('occupation', $request->occupation))
        )
        ->get();

    if ($users->isEmpty()) {
        return response()->json([
            'success' => false,
            'html' => '<p class="text-center text-danger fw-bold">No profiles found</p>'
        ]);
    }

    // Pass users instead of user
    $html = view('partials._profile-card', compact('users'))->render();

    return response()->json([
        'success' => true,
        'html' => $html
    ]);
}


public function advanceSearch(Request $request)
{
    $authUser = auth()->user();

    // 🔹 Normalize / map frontend request names to backend variables
    $gender          = $request->input('gender');
    $maritalStatus   = $request->input('maritalStatus');
    $motherTongue    = $request->input('motherTongue');
    $ageMin          = $request->input('advancedAgeMin');
    $ageMax          = $request->input('advancedAgeMax');
    $heightMin       = $request->input('heightRange1');
    $heightMax       = $request->input('heightRange2');
    $caste           = $request->input('caste');
    $subCaste        = $request->input('subCaste');
    $gotra           = $request->input('gotra');
    $allowSameGotra  = $request->has('allowSameGotra') ? $request->input('allowSameGotra') : null;
    $country         = $request->input('country');
    $state           = $request->input('state');
    $city            = $request->input('city');
    $education       = $request->input('education');
    $occupation      = $request->input('occupation');
    $income          = $request->input('income');
    $foodHabits      = $this->mapFoodHabits($request->input('foodHabits'));
    $smoking         = $request->input('smoking');
    $drinking        = $request->input('drinking');
    $rashi           = $request->input('rashi');
    $manglik         = $request->input('manglik');

    $users = User::with(['profile', 'photos'])
        ->when($gender, fn($q) => $q->where('gender', $gender))

        ->when($ageMin && $ageMax, function ($q) use ($ageMin, $ageMax) {
            $q->whereHas('profile', fn($query) =>
                $query->whereBetween('age', [(int)$ageMin, (int)$ageMax])
            );
        })

        ->when($maritalStatus, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('marital_status', $maritalStatus))
        )

        ->when($motherTongue, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('mother_tongue', $motherTongue))
        )

        ->when($heightMin && $heightMax, function ($q) use ($heightMin, $heightMax) {
            $q->whereHas('profile', fn($query) =>
                $query->whereBetween('height_cm', [(int)$heightMin, (int)$heightMax])
            );
        })

        ->when($caste, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('caste', $caste))
        )

        ->when($subCaste, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('sub_caste', $subCaste))
        )

        ->when($gotra, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('gotra', $gotra))
        )

        ->when($country, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('current_country', $country))
        )

        ->when($state, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('current_state', $state))
        )

        ->when($city, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('current_city', $city))
        )

        ->when($education, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('education', $education))
        )

        ->when($occupation, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('occupation', $occupation))
        )

        ->when($income, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('annual_income', $income))
        )

        ->when($foodHabits, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('food_habits', $foodHabits))
        )

        ->when($smoking, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('smoking_habits', $smoking))
        )

        ->when($drinking, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('drinking_habits', $drinking))
        )

        // ✅ Horoscope filters only for Premium
        ->when($authUser && $authUser->is_premium && $rashi, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('rashi', $rashi))
        )

        ->when($authUser && $authUser->is_premium && $manglik, fn($q) =>
            $q->whereHas('profile', fn($query) => $query->where('manglik_status', $manglik))
        )

        // ✅ Gotra exclusion only for Premium
        ->when($allowSameGotra === "off", function ($q) use ($authUser) {
            if ($authUser->profile && $authUser->profile->gotra) {
                $q->whereHas('profile', fn($query) =>
                    $query->where('gotra', '!=', $authUser->profile->gotra)
                );
            }
        })

        ->get();

    if ($users->isEmpty()) {
        return response()->json([
            'success' => false,
            'html' => '<p class="text-center text-danger fw-bold">No profiles found</p>'
        ]);
    }

    $html = view('partials._profile-card', compact('users'))->render();

    return response()->json([
        'success' => true,
        'html' => $html
    ]);
}






  public function matches()
{
    $users = User::with(['photos', 'profile'])->get();

    // Filter options
    $educations = User::distinct()->pluck('education')->filter()->values();
    $occupations = User::distinct()->pluck('occupation')->filter()->values();
    $states = User::with('profile')->get()->pluck('profile.current_state')->filter()->unique()->values();
    $cities = User::with('profile')->get()->pluck('profile.current_city')->filter()->unique()->values();

    // Age range
    $ageMin = User::min('age') ?? 18;
    $ageMax = User::max('age') ?? 60;

    // Height range (cm)
    $heightMin = User::with('profile')->get()->pluck('profile.height_cm')->filter()->min() ?? 150;
    $heightMax = User::with('profile')->get()->pluck('profile.height_cm')->filter()->max() ?? 180;
    $gotras = User::with('profile')
        ->get()
        ->pluck('profile.gotra')
        ->filter()          // remove null/empty
        ->unique()          // remove duplicates
        ->values(); 

    return view('matches', compact(
        'users', 'educations', 'occupations', 'states', 'cities',
        'ageMin', 'ageMax', 'heightMin', 'heightMax','gotras'
    ));
}


  public function getMatches()
{
    $authUser = auth()->user();

    $query = User::with(['photos', 'profile']);

    if ($authUser && $authUser->profile && $authUser->profile->caste) {
        $query->whereHas('profile', function ($q) use ($authUser) {
            $q->where('caste', $authUser->profile->caste);
        })
        ->where('user_id', '!=', $authUser->user_id); // ✅ Exclude own profile
    }

    $users = $query->get();
    $count = $users->count();

    return response()->json([
        'users' => $users,
        'count' => $count,
    ]);
}




public function filterMatches(Request $request)
{
    $sql = "SELECT u.* 
            FROM `users` u
            LEFT JOIN `user_profiles` up ON u.user_id = up.user_id
            WHERE 1=1";
    $bindings = [];

    // Age
    if (!empty($request->ageMin) && !empty($request->ageMax)) {
        $sql .= " AND u.age BETWEEN ? AND ?";
        $bindings[] = (int)$request->ageMin;
        $bindings[] = (int)$request->ageMax;
    }

    // Height
    if (!empty($request->heightMin) && !empty($request->heightMax)) {
        $sql .= " AND up.height_cm BETWEEN ? AND ?";
        $bindings[] = (int)$request->heightMin;
        $bindings[] = (int)$request->heightMax;
    }

    // Education
    if (!empty($request->education) && is_array($request->education)) {
        $placeholders = implode(',', array_fill(0, count($request->education), '?'));
        $sql .= " AND u.education IN ($placeholders)";
        $bindings = array_merge($bindings, $request->education);
    }

    // Occupation
    if (!empty($request->occupation) && is_array($request->occupation)) {
        $placeholders = implode(',', array_fill(0, count($request->occupation), '?'));
        $sql .= " AND u.occupation IN ($placeholders)";
        $bindings = array_merge($bindings, $request->occupation);
    }

    // State
    if (!empty($request->state)) {
        $sql .= " AND LOWER(up.current_state) = LOWER(?)";
        $bindings[] = $request->state;
    }

    // City
    if (!empty($request->city)) {
        $sql .= " AND LOWER(up.current_city) = LOWER(?)";
        $bindings[] = $request->city;
    }

    // Gotra
    // if (isset($request->allowSameGotra) && !$request->allowSameGotra) {
    //     $userGotra = auth()->user()->profile->gotra ?? null;
    //     if ($userGotra) {
    //         $sql .= " AND LOWER(up.gotra) != LOWER(?)";
    //         $bindings[] = $userGotra;
    //     }
    // }

    // Build SQL with actual values for debugging
    $debugSql = $sql;
    foreach ($bindings as $binding) {
        $value = is_numeric($binding) ? $binding : "'$binding'";
        $debugSql = preg_replace('/\?/', $value, $debugSql, 1);
    }

    // Dump the final query
    // dd($debugSql);

    // Execute query
    $users = DB::select($sql, $bindings);
    $count = count($users);

    return response()->json([
        'users' => $users,
        'count' => $count,
    ]);
}





   public function membership() {
    $user = Auth::user();
    $plans = (new SubscriptionPlanController)->index();
    $plans = json_decode($plans->getContent(), true);

    foreach ($plans as &$plan) {
        if (!empty($plan['features'])) {
            $decoded = json_decode($plan['features'], true);
            $plan['features'] = is_array($decoded) ? $decoded : [];
        } else {
            $plan['features'] = [];
        }


        if (!empty($plan['excluded_features'])) {
            $decoded = json_decode($plan['excluded_features'], true);
            $plan['excluded_features'] = is_array($decoded) ? $decoded : [];
        } else {
            $plan['excluded_features'] = [];
        }
    }

        $userSubscription = null;

        if (auth()->check()) {
            $user = auth()->user();
            $userSubscription = UserSubscription::where('user_id', $user->user_id)
                                ->where('is_active', 1)
                                ->first();
        }

    $userPremiumPlanId = $userSubscription->plan_id ?? null;

    return view('membership', compact('plans','userPremiumPlanId'));
}





    // Success Stories
    public function successStories() {
        return view('success_stories');
    }

    // About
    public function about() {
        return view('about');
    }

    // Contact
    public function contact() {
        return view('contact');
    }

    // Login
    public function login() {
        return view('login');
    }

    // Register
    public function register() {
        return view('register');
    }

    public function help() {
        return view('help');
    }

    public function privacy() {
        return view('privacy');
    }

    public function terms() {
        return view('terms');
    }

public function dashboard()
{
    $user = Auth::user();
    $stats = $user->stats();

    $userSubscription = UserSubscription::where('user_id', $user->user_id)
        ->where('is_active', 1)
        ->first();

    $userPremiumPlanId = $userSubscription->plan_id ?? null;

    // ✅ Same caste members count
    $sameCasteCount = 0;
    if ($user->profile && $user->profile->caste) {
        $sameCasteCount = User::whereHas('profile', function ($q) use ($user) {
            $q->where('caste', $user->profile->caste);
        })
        ->where('user_id', '!=', $user->user_id) // fixed column
        ->count();
    }

    // ✅ Same state members count
    $sameStateCount = 0;
    if ($user->profile && $user->profile->current_state) {
        $sameStateCount = User::whereHas('profile', function ($q) use ($user) {
            $q->where('current_state', $user->profile->current_state);
        })
        ->where('user_id', '!=', $user->user_id) // fixed column
        ->count();
    }

    // ✅ Opposite gender count
    $oppositeGenderCount = User::where('gender', $user->gender === 'male' ? 'female' : 'male')
        ->count();

    return view('auth.dashboard', compact(
        'userPremiumPlanId',
        'stats',
        'sameCasteCount',
        'sameStateCount',
        'oppositeGenderCount'
    ));
}



    public function ajaxRegister(Request $request)
{
    dd($request);

    DB::beginTransaction();
    try {
        // Create user
        $user = User::create([
            'username' => strtok($request->fullName, ' '),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => strtok($request->fullName, ' '),
            'last_name' => trim(str_replace(strtok($request->fullName, ' '), '', $request->fullName)),
            'gender' => ucfirst($request->gender),
            'age' => $request->age,
            'education' => $request->education,
            'occupation' => $request->jobTitle,
            'community' => $request->caste,
        ]);

        // Create profile
        $user->profile()->create([
            'profile_for' =>$request->profileFor,
            'dob' => $request->dateOfBirth,
            'height_cm' => $this->convertHeightToCm($request->height),
            'weight_kg' => $request->weight,
            'marital_status' => ucfirst($request->maritalStatus),
            'diet' => $this->mapFoodHabits($request->foodHabits),
            'mother_tongue' => $request->motherTongue,
            'religion' => $request->religion,
            'caste' => $request->caste,
            'subcaste' => $request->subCaste,
            'gotra' => $request->gotra,
            'occupation_category' => $request->occupationCategory,
            'job_title' => $request->jobTitle,
            'employer' => $request->employer,
            'annual_income' => $request->annualIncome,
            'native_state' => $request->nativeState,
            'native_district' => $request->nativeDistrict,
            '   ' => $request->currentCountry,
            'current_state' => $request->currentState,
            'current_city' => $request->currentCity,
            'pin_code' => $request->pinCode,
            'father_occupation' => $request->fatherOccupation,
            'mother_occupation' => $request->motherOccupation,
            'family_status' => $request->familyStatus,
            'siblings' => $request->siblings,
            'about_family' => $request->aboutFamily,
            'rashi' => $request->rashi,
            'nakshatra' => $request->nakshatra,
            'manglik' => $request->manglik,
            'birth_time' => $request->birthTime,
            'birth_place' => $request->birthPlace,
            'hobbies' => $request->hobbies,
            'hide_profile' => $request->has('hideProfile'),
            'watermark_photos' => $request->has('watermarkPhotos'),
            'mobile' => $request->mobile,
            'whatsapp' => $request->whatsapp,
            'smoking_habits' =>$request->smokingHabits,
            'drinking_habits' =>$request->drinkingHabits,
        ]);

        if ($request->hasFile('profilePhoto')) {
        $photo = $request->file('profilePhoto');
        $photoPath = $photo->store('user_photos', 'public'); // store in storage/app/public/user_photos

       UserPhoto::create([
            'user_id' => $user->user_id,
            'photo_url' => 'storage/' . $photoPath, // accessible via public path
            'is_profile_photo' => 1,
            'is_verified' => 0,
            'uploaded_at' => Carbon::now(),
        ]);
        }

        DB::commit();
        Mail::to($user->email)->send(new WelcomeMail($user));

        return response()->json(['success' => true, 'user_id' => $user->id]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}



private function convertHeightToCm($height)
{
    if (preg_match("/(\d+)'(\d+)/", $height, $m)) {
        return ($m[1] * 30.48) + ($m[2] * 2.54);
    }
    return null;
}

private function mapFoodHabits($foodHabits)
{
    return match(strtolower($foodHabits)) {
        'vegetarian'     => 'Veg',
        'non-vegetarian' => 'Non-Veg',
        'eggetarian'     => 'Eggetarian',
        default          => null,
    };
}



public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not registered ']);
        }

        // Generate OTP
        $otp = rand(100000, 999999);


        Otp::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(5)]
        );
        session()->put('otp_email', $request->email);
       Mail::send('emails.otps', ['otp' => $otp], function ($message) use ($request) {
        $message->to($request->email)
            ->subject('Your OTP Code for Login');
        });
    return redirect()->route('user.otp')
                 ->with([
                     'success' => 'OTP sent to your email!',
                     'email'   => $request->email
                 ]);


    }


    public function sendMobileOtp(Request $request)
    {
    $request->validate([
        'mobile' => 'required|digits:10'
    ]);

   $user = User::whereHas('profile', function($q) use ($request) {
    $q->where('mobile', $request->mobile);
    })->first();
    if (!$user) {
        return back()->withErrors(['mobile' => 'Mobile number not registered']);
    }

    $otp = rand(100000, 999999);
    $this->twilio->sendSms(
        "+91" . $request->mobile,
        "Your OTP is $otp"
    );
     Otp::updateOrCreate(
        ['mobile' => $request->mobile],
        ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(5)]
    );
    session()->put('otp_mobile', $request->mobile);
    Log::info("OTP for {$request->mobile} is {$otp}");
    return redirect()->route('user.otp.mobile-view')
        ->with([
            'success' => 'OTP sent to your mobile number!',
            'mobile'  => $request->mobile
        ]);
    }


    public function verifyOtp(Request $request)
{
        $request->validate([
        'otp'    => 'required|digits:6',
        'email'  => 'sometimes|nullable|email|required_without:mobile',
        'mobile' => 'sometimes|nullable|digits:10|required_without:email',
    ]);

    if ($request->filled('email')) {
        $record = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>=', Carbon::now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        $user = User::where('email', $request->email)->first();
        session()->forget('otp_email');
    } 
    elseif ($request->filled('mobile')) {
        $record = Otp::where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>=', Carbon::now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        $user = User::whereHas('profile', function($q) use ($request) {
        $q->where('mobile', $request->mobile);
        })->first();
        session()->forget('otp_mobile');
    } 
    else {
        return back()->withErrors(['login' => 'Email or Mobile is required']);
    }

    Auth::guard('web')->login($user, true);
    $request->session()->regenerate();
    $record->delete();
    return redirect()->route('dashboard')->with('success', 'Login successful!');
}


    public function otp_form(){
        return view('otp');
    }

    public function otp_form_mobile(){
        return view('otp_mobile');
    }

    public function submit(Request $request)
    {
        // dd($request);
        $request->validate([
            'fullName'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string'
        ]);

        // Send email to admin
        Mail::send('emails.contact-admin', ['data' => $request->all()], function($message) use ($request) {
            $message->to('mohitramgupta180@gmail.com')->subject('New Contact Form Submission');
        });

        // Send confirmation email to user
        Mail::send('emails.contact-user', ['data' => $request->all()], function($message) use ($request) {
            $message->to($request->email)->subject('We received your message');
        });

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you within 24 hours.'
        ]);
    }


    public function shortlist(){
        return view('auth.shortlist');
    }

    public function edit_profile(){
        return view('auth.edit');
    }
}
