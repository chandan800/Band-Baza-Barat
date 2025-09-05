@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg">
            <div class="container">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <h1 class="hero-title">Find Your Perfect Life Partner</h1>
                            <p class="hero-subtitle">Rooted in Tradition, Embraced by Modernity</p>
                            <p class="hero-description">Join millions of Hindu families who found their soulmate through BandBazaBarat. Your journey to eternal happiness starts here.</p>
                            
                            <!-- Quick Search -->
                            <div class="quick-search-card">
                                <h5 class="mb-3"><i class="fas fa-search me-2"></i>Quick Partner Search</h5>
                                <form class="quick-search-form" method="GET" action="{{ route('search') }}">
    <div class="row g-3">
        <div class="col-md-6">
            <select class="form-select" required name="gender">
                <option value="">Looking for</option>
                <option value="male">Bride</option>
                <option value="female">Groom</option>
            </select>
        </div>
        <div class="col-md-6">
            <select class="form-select" name="ageRange">
                <option value="">Age Range</option>
                <option value="18-25">18-25 years</option>
                <option value="26-30">26-30 years</option>
                <option value="31-35">31-35 years</option>
                <option value="36-40">36-40 years</option>
                <option value="41+">41+ years</option>
            </select>
        </div>
        <div class="col-md-6">
            <select class="form-select" name="caste">
                <option value="">Caste</option>
                <option value="brahmin">Brahmin</option>
                <option value="kshatriya">Kshatriya</option>
                <option value="vaishya">Vaishya</option>
                <option value="obc">Other Backward Classes</option>
                <option value="sc">Scheduled Caste</option>
                <option value="st">Scheduled Tribe</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="col-md-6">
            <select class="form-select" name="location">
                <option value="">Location</option>
                <option value="mumbai">Mumbai</option>
                <option value="delhi">Delhi</option>
                <option value="bangalore">Bangalore</option>
                <option value="pune">Pune</option>
                <option value="chennai">Chennai</option>
                <option value="hyderabad">Hyderabad</option>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search me-2"></i>Find Matches
            </button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image">
                            <div class="mandala-bg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Stats -->
    <section class="trust-stats py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">2M+</div>
                        <div class="stat-label">Happy Couples</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Years of Trust</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">5M+</div>
                        <div class="stat-label">Verified Profiles</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Privacy Protected</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">How It Works</h2>
                <p class="section-subtitle">Your journey to finding the perfect life partner in 3 simple steps</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card text-center">
                        <div class="step-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h4>1. Create Profile</h4>
                        <p>Register and create your detailed profile with photos, preferences, and family details.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card text-center">
                        <div class="step-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>2. Find Matches</h4>
                        <p>Browse through verified profiles that match your preferences and cultural values.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card text-center">
                        <div class="step-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4>3. Connect & Meet</h4>
                        <p>Send interests, chat securely, and meet your potential life partner.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Members -->
    <section class="featured-members py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Featured Members</h2>
                <p class="section-subtitle">Discover profiles of our premium members</p>
            </div>
            
            <div class="row g-4">
    @foreach($users as $user)
        <div class="col-lg-3 col-md-6">
            <div class="profile-card">
                <div class="profile-image">
                    @if($user->photos && $user->photos->where('is_profile_photo', 1)->first())
                        <img src="{{ $user->photos->where('is_profile_photo', 1)->first()->photo_url }}" alt="{{ $user->first_name }}" class="img-fluid rounded">
                    @else
                        <div class="profile-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif

                    @if($user->is_premium)
                        <div class="premium-badge">Premium</div>
                    @endif
                </div>

                <div class="profile-content">
                    <h5 class="profile-name">{{ $user->first_name }} {{ Str::substr($user->last_name, 0, 1) }}.</h5>

                    @if($user->profile)
                        <p class="profile-details">
                            {{ $user->age ?? 'N/A' }} years,
                            {{ $user->profile->height_cm ?? '?' }}",
                            {{ $user->education ?? '' }}<br>
                            {{ $user->occupation ?? '' }},
                            {{ $user->profile->current_city ?? '' }}
                        </p>
                        <div class="profile-caste">
                            {{ $user->profile->religion ?? '' }} - {{ $user->profile->caste ?? '' }}
                        </div>
                    @endif

                    <button class="btn btn-primary btn-sm w-100 mt-2">View Profile</button>
                </div>
            </div>
        </div>
    @endforeach
</div>

            
            <div class="text-center mt-4">
                <a href="search.html" class="btn btn-outline-primary">View All Profiles</a>
            </div>
        </div>
    </section>

    <!-- Membership Benefits -->
    <section class="membership-benefits py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Membership Benefits</h2>
                <p class="section-subtitle">Unlock premium features to enhance your matrimonial journey</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h5>Unlimited Profile Views</h5>
                        <p>View as many profiles as you want without any restrictions.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Direct Messaging</h5>
                        <p>Send personalized messages to connect with potential matches.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Contact Details</h5>
                        <p>Access phone numbers and email addresses of interested profiles.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card text-center">
                        <div class="benefit-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5>Priority Matching</h5>
                        <p>Get priority in search results and receive better match suggestions.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('membership')}}" class="btn btn-primary">View Membership Plans</a>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="success-stories py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Success Stories</h2>
                <p class="section-subtitle">Real couples, real happiness, real testimonials</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="story-card">
                        <div class="story-image">
                            <div class="couple-placeholder">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <div class="story-content">
                            <h5>Anjali & Rajesh</h5>
                            <p class="story-location">Mumbai, Maharashtra</p>
                            <p class="story-text">"We found each other through BandBazaBarat and couldn't be happier. The platform made it easy to find someone who shares our values and traditions."</p>
                            <div class="story-date">Married: March 2023</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="story-card">
                        <div class="story-image">
                            <div class="couple-placeholder">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <div class="story-content">
                            <h5>Deepika & Vikram</h5>
                            <p class="story-location">Bangalore, Karnataka</p>
                            <p class="story-text">"Thanks to BandBazaBarat, we found our perfect match. The detailed profiles and compatibility matching helped us connect instantly."</p>
                            <div class="story-date">Married: January 2023</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="story-card">
                        <div class="story-image">
                            <div class="couple-placeholder">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <div class="story-content">
                            <h5>Meera & Aditya</h5>
                            <p class="story-location">Chennai, Tamil Nadu</p>
                            <p class="story-text">"A wonderful platform that respects traditions while embracing modern technology. We're grateful for helping us find each other."</p>
                            <div class="story-date">Married: November 2022</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('success_storiess')}}" class="btn btn-outline-primary">Read More Stories</a>
            </div>
        </div>
    </section>

    <!-- App Download -->
    <section class="app-download py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3>Get Our Mobile App</h3>
                    <p class="mb-4">Find your life partner on the go with our mobile app. Available on iOS and Android.</p>
                    <div class="app-buttons">
                        <a href="#" class="app-button me-3">
                            <i class="fab fa-apple"></i>
                            <div>
                                <small>Download on the</small>
                                <div>App Store</div>
                            </div>
                        </a>
                        <a href="#" class="app-button">
                            <i class="fab fa-google-play"></i>
                            <div>
                                <small>Get it on</small>
                                <div>Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="qr-code">
                        <div class="qr-placeholder">
                            <i class="fas fa-qrcode"></i>
                            <p class="mt-2">Scan QR Code</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
