@extends('layouts.auth_app')
@section('content')
                <div class="col-lg-9">
                    <div class="dashboard-main">
                        <!-- Welcome Section -->
                        <div class="welcome-section mb-4">
                            <h2>Welcome to Your Dashboard</h2>
                            <p class="text-muted">Manage your matrimonial profile and find your perfect life partner.</p>
                        </div>

                        <!-- Statistics Cards -->
                        <div class="stat-cards">
                            <div class="stat-card">
                                <i class="fas fa-eye"></i>
                                <div class="stat-number">248</div>
                                <div>Profile Views</div>
                            </div>
                            <div class="stat-card">
                                <i class="fas fa-heart"></i>
                                <div class="stat-number">{{ $stats['interests_received'] }}</div>
                                <div>Interests Received</div>
                            </div>
                            <div class="stat-card">
                                <i class="fas fa-paper-plane"></i>
                                <div class="stat-number">{{ $stats['interests_sent'] }}</div>
                                <div>Interests Sent</div>
                            </div>
                            <div class="stat-card">
                                <i class="fas fa-bookmark"></i>
                                <div class="stat-number">{{ $stats['shortlisted_users'] }}</div>
                                <div>Shortlisted</div>
                            </div>
                        </div>

                       @php
    $user = auth()->user();

    // Initialize
    $completion = 0;
    $tips = [];

    // 1️⃣ Basic information (users table)
    $basicInfoComplete = !empty($user->first_name) && !empty($user->last_name) && !empty($user->email);
    $completion += $basicInfoComplete ? 20 : 0;
    $tips[] = ['text' => 'Basic information added', 'completed' => $basicInfoComplete];

    // 2️⃣ Profile photo (user_photos table)
    $profilePhoto = \App\Models\UserPhoto::where('user_id', $user->user_id)->where('is_profile_photo', 1)->first();
    $completion += $profilePhoto ? 20 : 0;
    $tips[] = ['text' => 'Profile photo uploaded', 'completed' => (bool)$profilePhoto];

    // 3️⃣ Additional photos (user_photos table)
    $galleryPhotosCount = \App\Models\UserPhoto::where('user_id', $user->user_id)->count();
    $completion += $galleryPhotosCount >= 3 ? 20 : 0;
    $tips[] = ['text' => 'Add more photos (2-3 recommended)', 'completed' => $galleryPhotosCount >= 3];

    // 4️⃣ Horoscope details (user_profiles table)
    $profile = \App\Models\UserProfile::where('user_id', $user->user_id)->first();
    $horoscopeComplete = $profile && !empty($profile->dob) && !empty($profile->rashi) && !empty($profile->nakshatra);
    $completion += $horoscopeComplete ? 20 : 0;
    $tips[] = ['text' => 'Complete horoscope details', 'completed' => $horoscopeComplete];

    // 5️⃣ Mobile verification (users table)
    $mobileVerified = !empty($user->phone_verified_at);
    $completion += $mobileVerified ? 20 : 0;
    $tips[] = ['text' => 'Verify mobile number', 'completed' => $mobileVerified];
@endphp

<div class="profile-completion">
    <div class="completion-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Profile Completion</h5>
        <span class="badge bg-warning">{{ $completion }}% Complete</span>
    </div>
    <div class="completion-bar" style="background: #e9ecef; border-radius: 5px; height: 10px;">
        <div class="completion-progress" style="width: {{ $completion }}%; background-color: #ffc107; height: 10px; border-radius: 5px;"></div>
    </div>
    <div class="completion-tips mt-2">
        <h6>Complete your profile to get better matches:</h6>
        <ul class="list-unstyled">
            @foreach($tips as $tip)
                <li>
                    <i class="fas fa-{{ $tip['completed'] ? 'check text-success' : 'times text-danger' }} me-2"></i>
                    {{ $tip['text'] }}
                </li>
            @endforeach
        </ul>
    </div>
</div>


                        <div class="row">
                            <!-- Quick Actions -->
                            <div class="col-lg-8">
                                <h5 class="mb-3">Quick Actions</h5>
                                <div class="quick-actions">
                                    <a href="#" class="quick-action">
                                        <i class="fas fa-user-edit"></i>
                                        <div>Edit Profile</div>
                                    </a>
                                    <a href="#" class="quick-action">
                                        <i class="fas fa-camera"></i>
                                        <div>Upload Photo</div>
                                    </a>
                                    <a href="{{ route('search')}}" class="quick-action">
                                        <i class="fas fa-search"></i>
                                        <div>Search Profiles</div>
                                    </a>
                                    <a href="{{ route('match')}}" class="quick-action">
                                        <i class="fas fa-heart"></i>
                                        <div>View Matches</div>
                                    </a>
                                    <a href="#" class="quick-action">
                                        <i class="fas fa-shield-alt"></i>
                                        <div>Verify Profile</div>
                                    </a>
                                    <a href="{{ route('membership') }}" class="quick-action">
                                        <i class="fas fa-crown"></i>
                                        <div>Upgrade Plan</div>
                                    </a>
                                </div>

                                <!-- Recent Activity -->
                                <div class="recent-activity">
                                    <h5 class="mb-3">Recent Activity</h5>
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div>You received an interest from CM789012</div>
                                            <div class="activity-time">2 hours ago</div>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div>Your profile was viewed by CM456789</div>
                                            <div class="activity-time">5 hours ago</div>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="fas fa-paper-plane"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div>You sent an interest to CM345678</div>
                                            <div class="activity-time">1 day ago</div>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div>Profile photo updated successfully</div>
                                            <div class="activity-time">2 days ago</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                
   
                            <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-crown me-2 text-warning"></i>Membership Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            @php
                                                $activePlan = auth()->user()->subscription; // get user subscription
                                                $planName = 'FREE';
                                                $planFeatures = [];
                                                $planExpires = null;

                                                if ($activePlan && $activePlan->is_active && \Carbon\Carbon::now()->lt($activePlan->expires_at)) {
                                                    $planName = strtoupper($activePlan->plan->name ?? 'PREMIUM');
                                                    $planExpires = \Carbon\Carbon::parse($activePlan->expires_at)->format('d M, Y');

                                                    // Decode features if stored as JSON string
                                                    if (!empty($activePlan->plan->features)) {
                                                        $planFeatures = is_array($activePlan->plan->features) 
                                                                        ? $activePlan->plan->features 
                                                                        : json_decode($activePlan->plan->features, true);
                                                    }
                                                }
                                            @endphp

                                            <div class="membership-badge mb-2">
                                                <span class="badge {{ $planName === 'FREE' ? 'bg-secondary' : 'bg-success' }} fs-6">
                                                    {{ $planName }} MEMBER
                                                </span>
                                            </div>

                                            @if($planExpires)
                                                <p class="text-muted mb-3">Valid until: {{ $planExpires }}</p>
                                            @else
                                                <p class="text-muted mb-3">Upgrade to premium for unlimited access</p>
                                            @endif

                                            {{-- Show plan features if available --}}
                                            @if(!empty($planFeatures))
                                                <ul class="list-group list-group-flush mb-3">
                                                    @foreach($planFeatures as $feature)
                                                        <li class="list-group-item">
                                                            <i class="fas fa-check text-success me-2"></i>{{ $feature }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            {{-- Show Upgrade button only if not premium or expired --}}
                                            @if($planName === 'FREE' || !$planExpires)
                                                <a href="{{ route('membership') }}" class="btn btn-primary btn-sm">Upgrade Now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <!-- Today's Matches -->
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-heart me-2 text-danger"></i>Today's Matches</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="fs-2 text-primary mb-2">{{ $sameCasteCount }}</div>
                                            <p class="text-muted mb-3">New matches found for you</p>
                                            <a href="{{ route('match')}}" class="btn btn-outline-primary btn-sm">View Matches</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Tips -->
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-lightbulb me-2 text-warning"></i>Profile Tips</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                <small>Add a genuine recent photo</small>
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                <small>Write about your interests</small>
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-exclamation-circle text-warning me-2"></i>
                                                <small>Verify your mobile number</small>
                                            </li>
                                            <li>
                                                <i class="fas fa-exclamation-circle text-warning me-2"></i>
                                                <small>Complete horoscope details</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if user is logged in
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            // if (!isLoggedIn) {
            //     window.location.href = 'login.html';
            //     return;
            // }

            // Load user data
            const userEmail = localStorage.getItem('userEmail');
            if (userEmail) {
                document.getElementById('userDisplayName').textContent = userEmail.split('@')[0];
            }

            // Animate statistics on page load
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        clearInterval(timer);
                        stat.textContent = target;
                    } else {
                        stat.textContent = Math.floor(current);
                    }
                }, 30);
            });

            // Logout function
            window.logout = function() {
                if (confirm('Are you sure you want to logout?')) {
                    localStorage.removeItem('isLoggedIn');
                    localStorage.removeItem('userEmail');
                    localStorage.removeItem('userMobile');
                    window.BandBazaBarat.showNotification('Logged out successfully', 'success');
                    setTimeout(() => {
                        window.location.href = 'index.html';
                    }, 1000);
                }
            };
        });
    </script>
@endsection
