@extends('layouts.app')
@section('content')
    <style>
        .search-tab.disabled {
    pointer-events: auto; /* still clickable for alert */
    opacity: 0.5;
    cursor: not-allowed;
}

        .search-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .search-header {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .search-tabs {
            display: flex;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .search-tab {
            flex: 1;
            background: none;
            border: none;
            padding: 1rem 2rem;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }
        
        .search-tab.active {
            background: var(--maroon);
            color: var(--white);
        }
        
        .search-form-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .basic-search {
            display: block;
        }
        
        .advanced-search {
            display: none;
        }
        
        .search-section {
            margin-bottom: 2rem;
        }
        
        .search-section h6 {
            color: var(--maroon);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .search-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .range-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .range-slider {
            flex: 1;
        }
        
        .range-output {
            background: var(--light-bg);
            padding: 0.5rem;
            border-radius: 4px;
            min-width: 80px;
            text-align: center;
            font-weight: 500;
            color: var(--maroon);
        }
        
        .profile-id-search {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }
        
        .profile-id-search h5 {
            margin-bottom: 1rem;
        }
        
        .profile-id-input {
            display: flex;
            gap: 1rem;
        }
        
        .profile-id-input input {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .profile-id-input button {
            background: var(--white);
            color: var(--maroon);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .profile-id-input button:hover {
            background: var(--light-bg);
        }
        
        .saved-searches {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .saved-search-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .saved-search-item:hover {
            border-color: var(--maroon);
            background: var(--light-bg);
        }
        
        .saved-search-info {
            flex: 1;
        }
        
        .saved-search-name {
            font-weight: 500;
            color: var(--maroon);
            margin-bottom: 0.25rem;
        }
        
        .saved-search-details {
            color: var(--muted);
            font-size: 0.9rem;
        }
        
        .saved-search-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .horoscope-section {
            background: linear-gradient(135deg, rgba(128, 0, 0, 0.1), rgba(255, 179, 71, 0.1));
            padding: 1.5rem;
            border-radius: var(--border-radius);
            border: 1px solid var(--golden-orange);
        }
        
        .premium-feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--golden-orange);
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        .gotra-warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .gotra-warning .warning-icon {
            color: #f39c12;
            margin-right: 0.5rem;
        }
        
        .quick-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .quick-filter {
            background: var(--light-bg);
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }
        
        .quick-filter:hover,
        .quick-filter.active {
            background: var(--maroon);
            color: var(--white);
            border-color: var(--maroon);
        }
        
        .search-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .search-actions .btn {
            min-width: 150px;
        }
        
        @media (max-width: 768px) {
            .search-container {
                padding: 1rem;
            }
            
            .search-header {
                padding: 1rem;
            }
            
            .search-form-container {
                padding: 1rem;
            }
            
            .search-tabs {
                flex-direction: column;
            }
            
            .search-row {
                grid-template-columns: 1fr;
            }
            
            .range-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .profile-id-input {
                flex-direction: column;
            }
            
            .search-actions {
                flex-direction: column;
            }
        }
    </style>

    <!-- Search Container -->
    <div class="search-container">
        <div class="container">
            <!-- Header -->
            <div class="search-header">
                <h2><i class="fas fa-search me-2"></i>Find Your Perfect Life Partner</h2>
                <p class="text-muted mb-0">Search through thousands of verified Hindu matrimonial profiles</p>
            </div>

            <!-- Profile ID Search -->
            <form>
            <div class="profile-id-search">
                <h5><i class="fas fa-id-badge me-2"></i>Search by Profile ID</h5>
                <p class="mb-3">Already have a specific profile ID? Search directly here.</p>
                <div class="profile-id-input">
                    <input type="text" placeholder="Enter Profile ID (e.g., CM123456)" id="profileIdInput">
                    <button type="button" onclick="searchByProfileId()">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </div>
            </form>

            <section class="featured-members py-5 bg-light">
        <div class="container">
            
            <div class="row g-4" id="featured-members-container">
    @foreach($users as $user)
        @include('partials._profile-card', ['users' => [$user]])
    @endforeach
</div>

        </div>
    </section>
            <!-- Search Tabs -->
            <div class="search-tabs">
                <button class="search-tab active" data-tab="basic">
                    <i class="fas fa-search me-2"></i>Basic Search
                </button>
                <button 
                    class="search-tab {{ !Auth::check() ? 'disabled' : '' }}" 
                    data-tab="advanced"
                    @if(!Auth::check()) onclick="showLoginAlert()" @endif>
                    <i class="fas fa-sliders-h me-2"></i>Advanced Search
                </button>
            </div>

            <!-- Search Forms -->
            <div class="search-form-container">
                <!-- Basic Search -->
                <form id="basicSearchForm" class="basic-search">
                    <div class="quick-filters">
                        <div class="quick-filter" data-filter="age-22-28">22-28 years</div>
                        <div class="quick-filter" data-filter="height-5-2-5-8">5'2" - 5'8"</div>
                        <div class="quick-filter" data-filter="graduate">Graduate</div>
                        <div class="quick-filter" data-filter="professional">Professional</div>
                        <div class="quick-filter" data-filter="mumbai">Mumbai</div>
                        <div class="quick-filter" data-filter="bangalore">Bangalore</div>
                        <div class="quick-filter" data-filter="delhi">Delhi</div>
                        <div class="quick-filter" data-filter="vegetarian">Vegetarian</div>
                    </div>

                    <div class="search-row">
                        <div class="form-group">
                            <label class="form-label">Looking for</label>
                            <select class="form-select" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Bride</option>
                                <option value="female">Groom</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Age Range</label>
                            <div class="range-container">
                                <input type="range" class="range-slider" id="basicAgeMin" min="18" max="60" value="22">
                                <div class="range-output" id="basicAgeRange">{{ $ageMin }} - {{ $ageMax }} years</div>
                                <input type="range" class="range-slider" id="basicAgeMax" min="{{ $ageMin }}" max="{{ $ageMax }}" value="30">
                            </div>
                        </div>
                    </div>

                    <div class="search-row">
                        <div class="form-group">
                            <label class="form-label">Caste</label>
                           <select class="form-select" name="caste">
                            <option value="">Any Caste</option>
                            @foreach($castes as $caste)
                                <option value="{{ strtolower($caste) }}">{{ $caste }}</option>
                            @endforeach
                            <option value="other">Other</option>
                        </select>

                        </div>
                        <div class="form-group">
                            <label class="form-label">Location (State)</label>
                            <select class="form-select" name="state">
                                <option value="">Any State</option>
                                @foreach($states as $state)
                                <option value="{{ strtolower($state) }}">{{ $state}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="search-row">
                        <div class="form-group">
                            <label class="form-label">Education</label>
                            <select class="form-select" name="education">
                                <option value="">Any Education</option>
                                @foreach($educations as $education)
                                <option value="{{ strtolower($education) }}">{{ $education }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Occupation</label>
                            <select class="form-select" name="occupation">
                                <option value="">Any Occupation</option>
                                @foreach($occupations as $occupation)
                                <option value="{{ strtolower($occupation) }}">{{$occupation}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="search-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Search Profiles
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm('basicSearchForm')">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                </form>

                <!-- Advanced Search -->
                <form id="advancedSearchForm" class="advanced-search">
                    <!-- Personal Information -->
                    <div class="search-section">
                        <h6><i class="fas fa-user me-2"></i>Personal Information</h6>
                        <div class="search-row">
                            <div class="form-group">
                                <label class="form-label">Looking for</label>
                                <select class="form-select" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Bride</option>
                                    <option value="female">Groom</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Marital Status</label>
                                <select class="form-select" name="maritalStatus">
                                    <option value="">Any Status</option>
                                    <option value="unmarried">Unmarried</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mother Tongue</label>
                                <select class="form-select" name="motherTongue">
                                    <option value="">Any Language</option>
                                    <option value="hindi">Hindi</option>
                                    <option value="english">English</option>
                                    <option value="tamil">Tamil</option>
                                    <option value="telugu">Telugu</option>
                                    <option value="marathi">Marathi</option>
                                    <option value="gujarati">Gujarati</option>
                                    <option value="bengali">Bengali</option>
                                    <option value="kannada">Kannada</option>
                                    <option value="malayalam">Malayalam</option>
                                    <option value="punjabi">Punjabi</option>
                                </select>
                            </div>
                        </div>

                        <div class="search-row">
                            <div class="form-group">
                                <label class="form-label">Age Range</label>
                                <div class="range-container">
                                    <input type="range" class="range-slider" id="advancedAgeMin" min="18" max="60" value="22" name="advancedAgeMin">
                                    <div class="range-output" id="advancedAgeRange">22 - 35</div>
                                    <input type="range" class="range-slider" id="advancedAgeMax" min="18" max="60" value="35" name="advancedAgeMax">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Height Range</label>
                                <div class="range-container">
                                    <input type="range" class="range-slider" id="heightMin" min="54" max="84" value="62" name="heightRange1">
                                    <div class="range-output" id="heightRange">5'2" - 5'8"</div>
                                    <input type="range" class="range-slider" id="heightMax" min="54" max="84" value="68" name="heightRange2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cultural Information -->
                    <div class="search-section">
                        <h6><i class="fas fa-om me-2"></i>Cultural Information</h6>
                        <div class="search-row">
                            <div class="form-group">
                                <label class="form-label">Caste</label>
                                <select class="form-select" name="caste" id="advancedCaste">
                                    <option value="">Any Caste</option>
                                    <option value="brahmin">Brahmin</option>
                                    <option value="kshatriya">Kshatriya</option>
                                    <option value="vaishya">Vaishya</option>
                                    <option value="obc">Other Backward Classes</option>
                                    <option value="sc">Scheduled Caste</option>
                                    <option value="st">Scheduled Tribe</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sub-Caste</label>
                                <select class="form-select" name="subCaste" id="advancedSubCaste">
                                    <option value="">Any Sub-Caste</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Gotra</label>
                                <select class="form-select" name="gotra">
                                    <option value="">Any Gotra</option>
                                    <option value="bharadwaj">Bharadwaj</option>
                                    <option value="kashyap">Kashyap</option>
                                    <option value="vasistha">Vasistha</option>
                                    <option value="agastya">Agastya</option>
                                    <option value="atri">Atri</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="gotra-warning">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="allowSameGotra" name="allowSameGotra">
                                <label class="form-check-label" for="allowSameGotra">
                                    <i class="fas fa-exclamation-triangle warning-icon"></i>
                                    <strong>Allow Same Gotra Matches</strong>
                                    <br><small class="text-muted">Note: Same gotra marriages are traditionally not recommended. Please consult with elders before proceeding.</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="search-section">
                        <h6><i class="fas fa-map-marker-alt me-2"></i>Location Preferences</h6>
                        <div class="search-row">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <select class="form-select" name="country">
                                    <option value="">Any Country</option>
                                    <option value="india" selected>India</option>
                                    <option value="usa">United States</option>
                                    <option value="uk">United Kingdom</option>
                                    <option value="canada">Canada</option>
                                    <option value="australia">Australia</option>
                                    <option value="uae">UAE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">State/Province</label>
                                <select class="form-select" name="state">
                                    <option value="">Any State</option>
                                    <option value="maharashtra">Maharashtra</option>
                                    <option value="karnataka">Karnataka</option>
                                    <option value="tamil-nadu">Tamil Nadu</option>
                                    <option value="kerala">Kerala</option>
                                    <option value="gujarat">Gujarat</option>
                                    <option value="rajasthan">Rajasthan</option>
                                    <option value="uttar-pradesh">Uttar Pradesh</option>
                                    <option value="west-bengal">West Bengal</option>
                                    <option value="delhi">Delhi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" name="city" placeholder="Enter city name">
                            </div>
                        </div>
                    </div>

                    <!-- Education & Career -->
                    <div class="search-section">
                        <h6><i class="fas fa-graduation-cap me-2"></i>Education & Career</h6>
                        <div class="search-row">
                            <div class="form-group">
                                <label class="form-label">Education Level</label>
                                <select class="form-select" name="education">
                                    <option value="">Any Education</option>
                                    <option value="12th">12th / Higher Secondary</option>
                                    <option value="diploma">Diploma</option>
                                    <option value="graduate">Graduate</option>
                                    <option value="postgraduate">Post Graduate</option>
                                    <option value="professional">Professional</option>
                                    <option value="doctorate">Doctorate</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Occupation</label>
                                <select class="form-select" name="occupation">
                                    <option value="">Any Occupation</option>
                                    <option value="private">Private Sector</option>
                                    <option value="government">Government / PSU</option>
                                    <option value="business">Business / Self Employed</option>
                                    <option value="professional">Professional</option>
                                    <option value="student">Student</option>
                                    <option value="homemaker">Homemaker</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Annual Income (INR)</label>
                                <select class="form-select" name="income">
                                    <option value="">Any Income</option>
                                    <option value="upto-3">Up to 3 Lakh</option>
                                    <option value="3-5">3-5 Lakh</option>
                                    <option value="5-10">5-10 Lakh</option>
                                    <option value="10-20">10-20 Lakh</option>
                                    <option value="20-50">20-50 Lakh</option>
                                    <option value="50+">50 Lakh+</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Lifestyle -->
                    <div class="search-section">
                        <h6><i class="fas fa-heart me-2"></i>Lifestyle Preferences</h6>
                        <div class="search-row">
                            <div class="form-group">
                                <label class="form-label">Food Habits</label>
                                <select class="form-select" name="foodHabits">
                                    <option value="">Any Food Habit</option>
                                    <option value="vegetarian">Vegetarian</option>
                                    <option value="non-vegetarian">Non-Vegetarian</option>
                                    <option value="eggetarian">Eggetarian</option>
                                    <option value="vegan">Vegan</option>
                                    <option value="jain">Jain Vegetarian</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Smoking Habits</label>
                                <select class="form-select" name="smoking">
                                    <option value="">Any</option>
                                    <option value="never">Never</option>
                                    <option value="occasionally">Occasionally</option>
                                    <option value="regularly">Regularly</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Drinking Habits</label>
                                <select class="form-select" name="drinking">
                                    <option value="">Any</option>
                                    <option value="never">Never</option>
                                    <option value="occasionally">Occasionally</option>
                                    <option value="socially">Socially</option>
                                    <option value="regularly">Regularly</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Horoscope (Premium) -->
                    <div class="search-section horoscope-section">
    @if(Auth::check() && Auth::user()->is_premium)
        <!-- ✅ Premium User: Enable fields -->
        <div class="search-row">
            <div class="form-group">
                <label class="form-label">Rashi (Moon Sign)</label>
                <select class="form-select" name="rashi">
                    <option value="">Any Rashi</option>
                    <option value="aries">Mesh (Aries)</option>
                    <option value="taurus">Vrishabh (Taurus)</option>
                    <option value="gemini">Mithun (Gemini)</option>
                    <option value="cancer">Kark (Cancer)</option>
                    <option value="leo">Simha (Leo)</option>
                    <option value="virgo">Kanya (Virgo)</option>
                    <option value="libra">Tula (Libra)</option>
                    <option value="scorpio">Vrishchik (Scorpio)</option>
                    <option value="sagittarius">Dhanu (Sagittarius)</option>
                    <option value="capricorn">Makar (Capricorn)</option>
                    <option value="aquarius">Kumbh (Aquarius)</option>
                    <option value="pisces">Meen (Pisces)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Manglik Status</label>
                <select class="form-select" name="manglik">
                    <option value="">Any Status</option>
                    <option value="yes">Manglik</option>
                    <option value="no">Non-Manglik</option>
                    <option value="partially">Partially Manglik</option>
                </select>
            </div>
        </div>
    @else
        <!-- ❌ Free User: Show locked feature -->
        <div class="premium-feature">
            <i class="fas fa-crown"></i>
            <span>Premium Feature - Horoscope Matching</span>
        </div>
        <div class="search-row">
            <div class="form-group">
                <label class="form-label">Rashi (Moon Sign)</label>
                <select class="form-select" name="rashi" disabled>
                    <option value="">Any Rashi</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Manglik Status</label>
                <select class="form-select" name="manglik" disabled>
                    <option value="">Any Status</option>
                </select>
            </div>
        </div>
        <div class="text-center mt-2">
            <a href="{{ route('membership')}}" class="btn btn-warning btn-sm">
                <i class="fas fa-crown me-2"></i>Upgrade for Horoscope Matching
            </a>
        </div>
    @endif
</div>


                    <div class="search-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Search Profiles
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm('advancedSearchForm')">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="saveSearch()">
                            <i class="fas fa-save me-2"></i>Save Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Saved Searches -->
            <div class="saved-searches">
                <h5><i class="fas fa-bookmark me-2"></i>Saved Searches</h5>
                <div class="saved-search-item" onclick="loadSavedSearch('preferred-matches')">
                    <div class="saved-search-info">
                        <div class="saved-search-name">Preferred Matches</div>
                        <div class="saved-search-details">Age: 24-30, Caste: Brahmin, Location: Maharashtra</div>
                    </div>
                    <div class="saved-search-actions">
                        <button class="btn btn-sm btn-primary">Load</button>
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </div>
                </div>
                <div class="saved-search-item" onclick="loadSavedSearch('nearby-profiles')">
                    <div class="saved-search-info">
                        <div class="saved-search-name">Nearby Profiles</div>
                        <div class="saved-search-details">Location: Mumbai, Education: Graduate+</div>
                    </div>
                    <div class="saved-search-actions">
                        <button class="btn btn-sm btn-primary">Load</button>
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize search functionality
            initializeTabs();
            initializeRangeSliders();
            initializeQuickFilters();
            initializeDependentDropdowns();
            initializeForms();
        });

        function initializeTabs() {
            const tabs = document.querySelectorAll('.search-tab');
            const basicSearch = document.querySelector('.basic-search');
            const advancedSearch = document.querySelector('.advanced-search');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabType = this.dataset.tab;
                    
                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show/hide forms
                    if (tabType === 'basic') {
                        basicSearch.style.display = 'block';
                        advancedSearch.style.display = 'none';
                    } else {
                        basicSearch.style.display = 'none';
                        advancedSearch.style.display = 'block';
                    }
                });
            });
        }

        function initializeRangeSliders() {
            // Basic age range
            const basicAgeMin = document.getElementById('basicAgeMin');
            const basicAgeMax = document.getElementById('basicAgeMax');
            const basicAgeRange = document.getElementById('basicAgeRange');

            function updateBasicAgeRange() {
                const min = parseInt(basicAgeMin.value);
                const max = parseInt(basicAgeMax.value);
                if (min > max) {
                    basicAgeMax.value = min;
                }
                basicAgeRange.textContent = `${min} - ${basicAgeMax.value}`;
            }

            basicAgeMin.addEventListener('input', updateBasicAgeRange);
            basicAgeMax.addEventListener('input', updateBasicAgeRange);

            // Advanced age range
            const advancedAgeMin = document.getElementById('advancedAgeMin');
            const advancedAgeMax = document.getElementById('advancedAgeMax');
            const advancedAgeRange = document.getElementById('advancedAgeRange');

            function updateAdvancedAgeRange() {
                const min = parseInt(advancedAgeMin.value);
                const max = parseInt(advancedAgeMax.value);
                if (min > max) {
                    advancedAgeMax.value = min;
                }
                advancedAgeRange.textContent = `${min} - ${advancedAgeMax.value}`;
            }

            advancedAgeMin.addEventListener('input', updateAdvancedAgeRange);
            advancedAgeMax.addEventListener('input', updateAdvancedAgeRange);

            // Height range
            const heightMin = document.getElementById('heightMin');
            const heightMax = document.getElementById('heightMax');
            const heightRange = document.getElementById('heightRange');

            function updateHeightRange() {
                const min = parseInt(heightMin.value);
                const max = parseInt(heightMax.value);
                if (min > max) {
                    heightMax.value = min;
                }
                const minFeet = Math.floor(min / 12);
                const minInches = min % 12;
                const maxFeet = Math.floor(max / 12);
                const maxInches = max % 12;
                heightRange.textContent = `${minFeet}'${minInches}" - ${maxFeet}'${maxInches}"`;
            }

            heightMin.addEventListener('input', updateHeightRange);
            heightMax.addEventListener('input', updateHeightRange);
        }

        function initializeQuickFilters() {
            const quickFilters = document.querySelectorAll('.quick-filter');
            
            quickFilters.forEach(filter => {
                filter.addEventListener('click', function() {
                    this.classList.toggle('active');
                    
                    // Apply quick filter logic based on data-filter attribute
                    const filterType = this.dataset.filter;
                    applyQuickFilter(filterType, this.classList.contains('active'));
                });
            });
        }

        function applyQuickFilter(filterType, isActive) {
            // Apply filter based on type
            switch(filterType) {
                case 'age-22-28':
                    if (isActive) {
                        document.getElementById('basicAgeMin').value = 22;
                        document.getElementById('basicAgeMax').value = 28;
                        updateBasicAgeRange();
                    }
                    break;
                case 'graduate':
                    const eduSelect = document.querySelector('[name="education"]');
                    if (eduSelect && isActive) {
                        eduSelect.value = 'graduate';
                    }
                    break;
                // Add more filter cases as needed
            }
        }

        function initializeDependentDropdowns() {
            const casteSelect = document.getElementById('advancedCaste');
            const subCasteSelect = document.getElementById('advancedSubCaste');
            
            if (casteSelect && subCasteSelect) {
                casteSelect.addEventListener('change', function() {
                    updateSubCasteOptions(this.value, subCasteSelect);
                });
            }
        }

        function updateSubCasteOptions(caste, subCasteSelect) {
            const subCasteOptions = {
                'brahmin': ['Iyer', 'Iyengar', 'Saraswat', 'Namboothiri', 'Deshastha', 'Chitpavan'],
                'kshatriya': ['Rajput', 'Maratha', 'Reddy', 'Nair', 'Thakur'],
                'vaishya': ['Agarwal', 'Baniya', 'Maheshwari', 'Khandelwal', 'Porwal'],
                'obc': ['Yadav', 'Kurmi', 'Jat', 'Gujjar', 'Patel'],
                'sc': ['Chamar', 'Mahar', 'Mala', 'Madiga'],
                'st': ['Gond', 'Santal', 'Bhil', 'Munda']
            };

            // Clear existing options
            subCasteSelect.innerHTML = '<option value="">Any Sub-Caste</option>';

            // Add new options
            if (subCasteOptions[caste]) {
                subCasteOptions[caste].forEach(subCaste => {
                    const option = document.createElement('option');
                    option.value = subCaste.toLowerCase();
                    option.textContent = subCaste;
                    subCasteSelect.appendChild(option);
                });
            }
        }

        function initializeForms() {
            const basicForm = document.getElementById('basicSearchForm');
            const advancedForm = document.getElementById('advancedSearchForm');

            basicForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleSearch(this, 'basic');
            });

            advancedForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleAdvanceSearch(this, 'advanced');
            });
        }

       function handleSearch(form, type) {
    const formData = new FormData(form);
    const searchData = {};

    for (let [key, value] of formData.entries()) {
        if (value) {
            searchData[key] = value;
        }
    }

    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Searching...';
    submitBtn.disabled = true;

    fetch('/basicSearch', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(searchData)
    })
    .then(res => res.json())
    .then(data => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        const container = document.getElementById('featured-members-container');
        container.innerHTML = data.html;

        if (data.success) {
            showNotification('Profiles found!', 'success');
        } else {
            showNotification('No profiles match your search', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        showNotification('Something went wrong', 'error');
    });
        }


        function handleAdvanceSearch(form, type) {
    const formData = new FormData(form);
    const searchData = {};

    for (let [key, value] of formData.entries()) {
        if (value) {
            searchData[key] = value;
        }
    }
    console.log('searchData',searchData);
    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Searching...';
    submitBtn.disabled = true;

    fetch('/advanceSearch', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(searchData)
    })
    .then(res => res.json())
    .then(data => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        const container = document.getElementById('featured-members-container');
        container.innerHTML = data.html;

        if (data.success) {
            showNotification('Profiles found!', 'success');
        } else {
            showNotification('No profiles match your search', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        showNotification('Something went wrong', 'error');
    });
        }


        function resetForm(formId) {
            const form = document.getElementById(formId);
            form.reset();
            
            // Reset range sliders to default
            if (formId === 'basicSearchForm') {
                document.getElementById('basicAgeMin').value = 22;
                document.getElementById('basicAgeMax').value = 30;
                updateBasicAgeRange();
            } else {
                document.getElementById('advancedAgeMin').value = 22;
                document.getElementById('advancedAgeMax').value = 35;
                document.getElementById('heightMin').value = 62;
                document.getElementById('heightMax').value = 68;
                updateAdvancedAgeRange();
                updateHeightRange();
            }
            
            // Clear active quick filters
            document.querySelectorAll('.quick-filter.active').forEach(filter => {
                filter.classList.remove('active');
            });
            
            window.BandBazaBarat.showNotification('Search form reset', 'info');
        }

        function saveSearch() {
            const searchName = prompt('Enter a name for this search:');
            if (!searchName) return;

            const formData = new FormData(document.getElementById('advancedSearchForm'));
            const searchData = {};
            
            for (let [key, value] of formData.entries()) {
                if (value) {
                    searchData[key] = value;
                }
            }

            // Save to localStorage (in real app, this would be sent to server)
            const savedSearches = JSON.parse(localStorage.getItem('savedSearches') || '[]');
            savedSearches.push({
                name: searchName,
                data: searchData,
                date: new Date().toISOString()
            });
            
            localStorage.setItem('savedSearches', JSON.stringify(savedSearches));
            window.BandBazaBarat.showNotification('Search saved successfully!', 'success');
        }

        function loadSavedSearch(searchId) {
            // Mock loading saved search
            window.BandBazaBarat.showNotification('Loading saved search...', 'info');
            
            setTimeout(() => {
                window.BandBazaBarat.showNotification('Search loaded successfully!', 'success');
            }, 1000);
        }

        function searchByProfileId() {
        const profileId = document.getElementById('profileIdInput').value.trim();

        if (!profileId) {
            showNotification('Please enter a profile ID', 'error');
            return;
        }


            showNotification('Searching for profile...', 'info');

            fetch('/searchbyid', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ profile_id: profileId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Replace existing members with search result
                    document.getElementById('featured-members-container').innerHTML = data.html;
                    showNotification('Profile found!', 'success');
                } else {
                    document.getElementById('featured-members-container').innerHTML = data.html;
                    showNotification('Profile not found', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                showNotification('Something went wrong', 'error');
            });
        }

        // Load URL parameters if any
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.size > 0) {
            urlParams.forEach((value, key) => {
                const input = document.querySelector(`[name="${key}"]`);
                if (input) {
                    input.value = value;
                }
            });
        }
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease;
        `;
        
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(notification);

        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function showLoginAlert() {
        Swal.fire({
            icon: 'info',
            title: 'Login Required',
            text: 'Please login to use advanced search.',
            confirmButtonText: 'Login'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }
    </script>

@endsection