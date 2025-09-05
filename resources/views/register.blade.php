@extends('layouts.app')
@section('content')
    
    <style>
        .registration-container {
            background: linear-gradient(135deg, var(--light-bg) 0%, #FFF5F0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .wizard-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        
        .wizard-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 2rem;
            text-align: center;
        }
        
        .progress-container {
            padding: 1rem 2rem;
            background: #f8f9fa;
        }
        
        .progress-custom {
            height: 8px;
            border-radius: 10px;
            background: #e9ecef;
        }
        
        .progress-bar-custom {
            background: linear-gradient(90deg, var(--maroon), var(--golden-orange));
            border-radius: 10px;
            transition: width 0.3s ease;
        }
        
        .wizard-step {
            display: none;
            padding: 2rem;
        }
        
        .wizard-step.active {
            display: block;
            animation: fadeInUp 0.5s ease;
        }
        
        .step-title {
            color: var(--maroon);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        
        .required::after {
            content: " *";
            color: #dc3545;
        }
        
        .wizard-navigation {
            padding: 1.5rem 2rem;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .profile-for-cards {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* default 2 columns on desktop */
    gap: 1rem;
    margin-bottom: 1.5rem;
}

/* On smaller screens, make it 1 column */
@media (max-width: 768px) {
    .profile-for-cards {
        grid-template-columns: 1fr;
    }
}

        
        .profile-for-card {
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .profile-for-card:hover,
        .profile-for-card.selected {
            border-color: var(--maroon);
            background: var(--light-bg);
        }
        
        .profile-for-card i {
            font-size: 2rem;
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        .hobbies-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .hobby-chip {
            background: #e9ecef;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }
        
        .hobby-chip.selected {
            background: var(--maroon);
            color: var(--white);
            border-color: var(--maroon);
        }
        
        .photo-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: var(--border-radius);
            padding: 3rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .photo-upload-area:hover {
            border-color: var(--maroon);
            background: var(--light-bg);
        }
        
        .photo-upload-area i {
            font-size: 3rem;
            color: var(--muted);
            margin-bottom: 1rem;
        }
        
        .verification-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .verification-card {
            border: 1px solid #dee2e6;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition);
        }
        
        .verification-card:hover {
            border-color: var(--maroon);
            box-shadow: var(--shadow);
        }
        
        .verification-card i {
            font-size: 2rem;
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .wizard-container {
                margin: 0 1rem;
            }
            
            .wizard-header {
                padding: 1.5rem;
            }
            
            .wizard-step {
                padding: 1.5rem;
            }
            
            .wizard-navigation {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .profile-for-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Registration Container -->
    <div class="registration-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="wizard-container registration-wizard">
                        <!-- Wizard Header -->
                        <div class="wizard-header">
                            <h2><i class="fas fa-user-plus me-2"></i>Create Your Profile</h2>
                            <p class="mb-0">Find your perfect life partner in just a few steps</p>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress-container">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">Step <span id="currentStep">1</span> of 8</small>
                                <small class="text-muted"><span id="progressPercent">12</span>% Complete</small>
                            </div>
                            <div class="progress progress-custom">
                                <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 12.5%" aria-valuenow="12.5" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Registration Form -->
                        <form id="registrationForm" novalidate>
                            <!-- Step 1: Profile For -->
                            <div class="wizard-step active">
                                <h3 class="step-title">Who is this profile for?</h3>
                                <div class="profile-for-cards">
                                    <div class="profile-for-card" data-value="self">
                                        <i class="fas fa-user"></i>
                                        <h5>Myself</h5>
                                        <input type="hidden" name="myself" value="Myself">
                                        <p class="text-muted">Creating profile for myself</p>
                                    </div>
                                    <div class="profile-for-card" data-value="son">
                                        <i class="fas fa-male"></i>
                                        <h5>My Son</h5>
                                        <input type="hidden" name="myson" value="My Son">
                                        <p class="text-muted">Creating profile for my son</p>
                                    </div>
                                    <div class="profile-for-card" data-value="daughter">
                                        <i class="fas fa-female"></i>
                                        <h5>My Daughter</h5>
                                         <input type="hidden" name="mydaughter" value="My Daughter">
                                        <p class="text-muted">Creating profile for my daughter</p>
                                    </div>
                                    <div class="profile-for-card" data-value="relative">
                                        <i class="fas fa-users"></i>
                                        <h5>Relative/Friend</h5>
                                        <input type="hidden" name="relativeFriend" value="Relative/Friend">
                                        <p class="text-muted">Creating profile for relative or friend</p>
                                    </div>
                                </div>
                                <input type="hidden" name="profileFor" required>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" class="form-control" name="fullName" placeholder="Enter full name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Gender</label>
                                            <select class="form-select" name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Date of Birth</label>
                                            <input type="date" class="form-control" name="dateOfBirth" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Age</label>
                                            <input type="number" class="form-control" name="age" placeholder="Will be calculated" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Cultural Information -->
                            <div class="wizard-step">
                                <h3 class="step-title">Cultural Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Religion</label>
                                            <select class="form-select" name="religion" required>
                                                <option value="hindu" selected>Hindu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Caste</label>
                                            <select class="form-select" name="caste" id="caste" required>
                                                <option value="">Select Caste</option>
                                                <option value="brahmin">Brahmin</option>
                                                <option value="kshatriya">Kshatriya</option>
                                                <option value="vaishya">Vaishya</option>
                                                <option value="obc">Other Backward Classes (OBC)</option>
                                                <option value="sc">Scheduled Caste (SC)</option>
                                                <option value="st">Scheduled Tribe (ST)</option>
                                                <option value="other">Other/Not Specified</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Sub-Caste</label>
                                            <select class="form-select" name="subCaste" id="subCaste">
                                                <option value="">Select Sub-Caste</option>
                                                <option value="cdc">cdc-Caste</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Gotra</label>
                                            <select class="form-select" name="gotra">
                                                <option value="">Select Gotra (Optional)</option>
                                                <option value="bharadwaj">Bharadwaj</option>
                                                <option value="kashyap">Kashyap</option>
                                                <option value="vasistha">Vasistha</option>
                                                <option value="agastya">Agastya</option>
                                                <option value="atri">Atri</option>
                                                <option value="vishwamitra">Vishwamitra</option>
                                                <option value="jamadagni">Jamadagni</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Mother Tongue</label>
                                            <select class="form-select" name="motherTongue" required>
                                                <option value="">Select Mother Tongue</option>
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
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Marital Status</label>
                                            <select class="form-select" name="maritalStatus" required>
                                                <option value="">Select Marital Status</option>
                                                <option value="unmarried">Unmarried</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="separated">Separated</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Location -->
                            <div class="wizard-step">
                                <h3 class="step-title">Location Details</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Native State</label>
                                            <select class="form-select" name="nativeState" required>
                                                <option value="">Select Native State</option>
                                                <option value="andhra-pradesh">Andhra Pradesh</option>
                                                <option value="karnataka">Karnataka</option>
                                                <option value="kerala">Kerala</option>
                                                <option value="tamil-nadu">Tamil Nadu</option>
                                                <option value="telangana">Telangana</option>
                                                <option value="maharashtra">Maharashtra</option>
                                                <option value="gujarat">Gujarat</option>
                                                <option value="rajasthan">Rajasthan</option>
                                                <option value="uttar-pradesh">Uttar Pradesh</option>
                                                <option value="bihar">Bihar</option>
                                                <option value="west-bengal">West Bengal</option>
                                                <option value="punjab">Punjab</option>
                                                <option value="haryana">Haryana</option>
                                                <option value="delhi">Delhi</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Native District</label>
                                            <input type="text" class="form-control" name="nativeDistrict" placeholder="Enter native district">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Current Country</label>
                                            <select class="form-select" name="currentCountry" required>
                                                <option value="india" selected>India</option>
                                                <option value="usa">United States</option>
                                                <option value="uk">United Kingdom</option>
                                                <option value="canada">Canada</option>
                                                <option value="australia">Australia</option>
                                                <option value="uae">UAE</option>
                                                <option value="singapore">Singapore</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Current State/Province</label>
                                            <input type="text" class="form-control" name="currentState" placeholder="Enter current state" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Current City</label>
                                            <input type="text" class="form-control" name="currentCity" placeholder="Enter current city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">PIN/ZIP Code</label>
                                            <input type="text" class="form-control" name="pinCode" placeholder="Enter PIN/ZIP code">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Education & Professional -->
                            <div class="wizard-step">
                                <h3 class="step-title">Education & Professional Details</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Highest Qualification</label>
                                            <select class="form-select" name="education" required>
                                                <option value="">Select Education</option>
                                                <option value="10th">10th / Matric</option>
                                                <option value="12th">12th / Higher Secondary</option>
                                                <option value="diploma">Diploma</option>
                                                <option value="graduate">Graduate (B.A/B.Sc/B.Com)</option>
                                                <option value="postgraduate">Postgraduate (M.A/M.Sc/MBA)</option>
                                                <option value="btech">B.Tech / B.E</option>
                                                <option value="mtech">M.Tech / M.E</option>
                                                <option value="mbbs">MBBS</option>
                                                <option value="ca">Chartered Accountant</option>
                                                <option value="llb">LLB</option>
                                                <option value="phd">PhD</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Occupation Category</label>
                                            <select class="form-select" name="occupationCategory" required>
                                                <option value="">Select Category</option>
                                                <option value="private">Private Sector Employee</option>
                                                <option value="government">Government / PSU</option>
                                                <option value="business">Business / Self Employed</option>
                                                <option value="professional">Professional (Doctor/Engineer/CA/Lawyer)</option>
                                                <option value="student">Student</option>
                                                <option value="homemaker">Homemaker</option>
                                                <option value="retired">Retired</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Job Title/Designation</label>
                                            <input type="text" class="form-control" name="jobTitle" placeholder="e.g., Software Engineer">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Employer/Company</label>
                                            <input type="text" class="form-control" name="employer" placeholder="Enter company name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Annual Income (INR)</label>
                                            <select class="form-select" name="annualIncome">
                                                <option value="">Select Income Range</option>
                                                <option value="upto-1">Up to 1 Lakh</option>
                                                <option value="1-2">1-2 Lakh</option>
                                                <option value="2-3">2-3 Lakh</option>
                                                <option value="3-5">3-5 Lakh</option>
                                                <option value="5-10">5-10 Lakh</option>
                                                <option value="10-20">10-20 Lakh</option>
                                                <option value="20-50">20-50 Lakh</option>
                                                <option value="50-100">50 Lakh - 1 Crore</option>
                                                <option value="1crore+">1 Crore & Above</option>
                                                <option value="no-answer">Prefer Not to Say</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5: Lifestyle & Preferences -->
                            <div class="wizard-step">
                                <h3 class="step-title">Lifestyle & Preferences</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label required">Height</label>
                                            <select class="form-select" name="height" required>
                                                <option value="">Select Height</option>
                                                <option value="4'6">4'6" (137 cm)</option>
                                                <option value="4'7">4'7" (140 cm)</option>
                                                <option value="4'8">4'8" (142 cm)</option>
                                                <option value="4'9">4'9" (145 cm)</option>
                                                <option value="4'10">4'10" (147 cm)</option>
                                                <option value="4'11">4'11" (150 cm)</option>
                                                <option value="5'0">5'0" (152 cm)</option>
                                                <option value="5'1">5'1" (155 cm)</option>
                                                <option value="5'2">5'2" (157 cm)</option>
                                                <option value="5'3">5'3" (160 cm)</option>
                                                <option value="5'4">5'4" (163 cm)</option>
                                                <option value="5'5">5'5" (165 cm)</option>
                                                <option value="5'6">5'6" (168 cm)</option>
                                                <option value="5'7">5'7" (170 cm)</option>
                                                <option value="5'8">5'8" (173 cm)</option>
                                                <option value="5'9">5'9" (175 cm)</option>
                                                <option value="5'10">5'10" (178 cm)</option>
                                                <option value="5'11">5'11" (180 cm)</option>
                                                <option value="6'0">6'0" (183 cm)</option>
                                                <option value="6'1">6'1" (185 cm)</option>
                                                <option value="6'2">6'2" (188 cm)</option>
                                                <option value="6'3">6'3" (191 cm)</option>
                                                <option value="6'4+">6'4" & Above</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Weight (kg)</label>
                                            <input type="number" class="form-control" name="weight" placeholder="Enter weight in kg" min="30" max="150">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label required">Food Habits</label>
                                            <select class="form-select" name="foodHabits" required>
                                                <option value="">Select Food Habits</option>
                                                <option value="vegetarian">Vegetarian</option>
                                                <option value="non-vegetarian">Non-Vegetarian</option>
                                                <option value="eggetarian">Eggetarian</option>
                                                <option value="vegan">Vegan</option>
                                                <option value="jain">Jain Vegetarian</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Smoking Habits</label>
                                            <select class="form-select" name="smokingHabits">
                                                <option value="">Select Smoking Habits</option>
                                                <option value="never">Never</option>
                                                <option value="occasionally">Occasionally</option>
                                                <option value="regularly">Regularly</option>
                                                <option value="trying-to-quit">Trying to Quit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Drinking Habits</label>
                                            <select class="form-select" name="drinkingHabits">
                                                <option value="">Select Drinking Habits</option>
                                                <option value="never">Never</option>
                                                <option value="occasionally">Occasionally</option>
                                                <option value="socially">Socially</option>
                                                <option value="regularly">Regularly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Hobbies & Interests</label>
                                            <div class="hobbies-container">
                                                <span class="hobby-chip" data-hobby="reading">Reading</span>
                                                <span class="hobby-chip" data-hobby="music">Music</span>
                                                <span class="hobby-chip" data-hobby="dancing">Dancing</span>
                                                <span class="hobby-chip" data-hobby="cooking">Cooking</span>
                                                <span class="hobby-chip" data-hobby="traveling">Traveling</span>
                                                <span class="hobby-chip" data-hobby="sports">Sports</span>
                                                <span class="hobby-chip" data-hobby="photography">Photography</span>
                                                <span class="hobby-chip" data-hobby="gardening">Gardening</span>
                                                <span class="hobby-chip" data-hobby="movies">Movies</span>
                                                <span class="hobby-chip" data-hobby="painting">Painting</span>
                                                <span class="hobby-chip" data-hobby="yoga">Yoga/Meditation</span>
                                                <span class="hobby-chip" data-hobby="fitness">Fitness</span>
                                            </div>
                                            <input type="hidden" name="hobbies">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 6: Family Background -->
                            <div class="wizard-step">
                                <h3 class="step-title">Family Background</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Father's Occupation</label>
                                            <input type="text" class="form-control" name="fatherOccupation" placeholder="Enter father's occupation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mother's Occupation</label>
                                            <input type="text" class="form-control" name="motherOccupation" placeholder="Enter mother's occupation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Family Status</label>
                                            <select class="form-select" name="familyStatus">
                                                <option value="">Select Family Status</option>
                                                <option value="middle-class">Middle Class</option>
                                                <option value="upper-middle-class">Upper Middle Class</option>
                                                <option value="rich">Rich/Affluent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Number of Siblings</label>
                                            <select class="form-select" name="siblings">
                                                <option value="">Select Number</option>
                                                <option value="0">No Siblings</option>
                                                <option value="1">1 Sibling</option>
                                                <option value="2">2 Siblings</option>
                                                <option value="3">3 Siblings</option>
                                                <option value="4+">4 or More Siblings</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">About Family</label>
                                            <textarea class="form-control" name="aboutFamily" rows="3" placeholder="Brief description about your family background, values, and traditions..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 7: Horoscope (Optional) -->
                            <div class="wizard-step">
                                <h3 class="step-title">Horoscope Details (Optional)</h3>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Horoscope matching is optional but helps in finding more compatible matches based on traditional astrology.
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Rashi (Moon Sign)</label>
                                            <select class="form-select" name="rashi">
                                                <option value="">Select Rashi</option>
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nakshatra</label>
                                            <select class="form-select" name="nakshatra">
                                                <option value="">Select Nakshatra</option>
                                                <option value="ashwini">Ashwini</option>
                                                <option value="bharani">Bharani</option>
                                                <option value="krittika">Krittika</option>
                                                <option value="rohini">Rohini</option>
                                                <option value="mrigashira">Mrigashira</option>
                                                <option value="ardra">Ardra</option>
                                                <option value="punarvasu">Punarvasu</option>
                                                <option value="pushya">Pushya</option>
                                                <option value="ashlesha">Ashlesha</option>
                                                <option value="magha">Magha</option>
                                                <option value="purva-phalguni">Purva Phalguni</option>
                                                <option value="uttara-phalguni">Uttara Phalguni</option>
                                                <option value="hasta">Hasta</option>
                                                <option value="chitra">Chitra</option>
                                                <option value="swati">Swati</option>
                                                <option value="vishakha">Vishakha</option>
                                                <option value="anuradha">Anuradha</option>
                                                <option value="jyeshtha">Jyeshtha</option>
                                                <option value="mula">Mula</option>
                                                <option value="purva-ashadha">Purva Ashadha</option>
                                                <option value="uttara-ashadha">Uttara Ashadha</option>
                                                <option value="shravana">Shravana</option>
                                                <option value="dhanishta">Dhanishta</option>
                                                <option value="shatabhisha">Shatabhisha</option>
                                                <option value="purva-bhadrapada">Purva Bhadrapada</option>
                                                <option value="uttara-bhadrapada">Uttara Bhadrapada</option>
                                                <option value="revati">Revati</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Manglik Status</label>
                                            <select class="form-select" name="manglik">
                                                <option value="">Select Manglik Status</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                                <option value="partially">Partially</option>
                                                <option value="dont-know">Don't Know</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Birth Time</label>
                                            <input type="time" class="form-control" name="birthTime">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Birth Place</label>
                                            <input type="text" class="form-control" name="birthPlace" placeholder="Enter birth place (City, State)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 8: Verification & Finish -->
                            <div class="wizard-step">
                                <h3 class="step-title">Verification & Complete Registration</h3>
                                
                                <!-- Mobile Verification -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Mobile Number</label>
                                            <input type="tel" class="form-control" name="mobile" placeholder="Enter 10-digit mobile number" required pattern="[6-9][0-9]{9}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">WhatsApp Number</label>
                                            <input type="tel" class="form-control" name="whatsapp" placeholder="Enter WhatsApp number">
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Photo Upload -->
                                <div class="form-group mb-4">
                                    <label class="form-label required">Profile Photo</label>
                                    <div class="photo-upload-area" onclick="document.getElementById('profilePhoto').click()">
                                        <i class="fas fa-camera"></i>
                                        <h5>Upload Profile Photo</h5>
                                        <p class="text-muted">Click to browse or drag & drop your photo here</p>
                                        <small class="text-muted">Supported formats: JPG, PNG, GIF (Max 5MB)</small>
                                    </div>
                                    <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" style="display: none;" required>
                                </div>

                                <!-- Email & Password -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Create Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="6-14 characters" required minlength="6" maxlength="14">
                                            <div class="password-strength mt-2">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" id="passwordStrength" style="width: 0%"></div>
                                                </div>
                                                <small class="text-muted">Password strength indicator</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Privacy Preferences -->
                                <div class="form-group">
                                    <label class="form-label">Privacy Preferences</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hideProfile" id="hideProfile">
                                        <label class="form-check-label" for="hideProfile">
                                            Hide my profile from search engines
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="watermarkPhotos" id="watermarkPhotos" checked>
                                        <label class="form-check-label" for="watermarkPhotos">
                                            Add watermark to my photos for protection
                                        </label>
                                    </div>
                                </div>

                                <!-- Terms & Conditions -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="termsAccepted" id="termsAccepted" required>
                                        <label class="form-check-label" for="termsAccepted">
                                            I agree to the <a href="terms.html" target="_blank">Terms & Conditions</a> and <a href="privacy.html" target="_blank">Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- reCAPTCHA Placeholder -->
                                <div class="form-group">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <i class="fas fa-shield-alt text-success fs-2 mb-2"></i>
                                        <p class="mb-0"><strong>reCAPTCHA verification will appear here</strong></p>
                                        <small class="text-muted">Please verify that you are not a robot</small>
                                    </div>
                                </div>
                            </div>
                       

                        <!-- Navigation -->
                        <div class="wizard-navigation">
                            <button type="button" class="btn btn-outline-secondary btn-prev" disabled>
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            <div class="text-center">
                                <small class="text-muted">Step <span id="navCurrentStep">1</span> of 8</small>
                            </div>
                            <button type="button" class="btn btn-primary btn-next">
                                Next<i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <button type="submit" class="btn btn-success btn-submit" style="display: none;">
                                <i class="fas fa-check me-2"></i>Create Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Registration wizard specific JavaScript
            const wizard = document.querySelector('.registration-wizard');
            const steps = wizard.querySelectorAll('.wizard-step');
            const progressBar = wizard.querySelector('.progress-bar');
            const nextButtons = wizard.querySelectorAll('.btn-next');
            const prevButtons = wizard.querySelectorAll('.btn-prev');
            const submitButton = wizard.querySelector('.btn-submit');
            
            let currentStep = 0;
            const totalSteps = steps.length;

            // Profile for selection
            const profileForCards = document.querySelectorAll('.profile-for-card');
            const profileForInput = document.querySelector('input[name="profileFor"]');

            profileForCards.forEach(card => {
                card.addEventListener('click', function() {
                    profileForCards.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                    profileForInput.value = this.dataset.value;
                });
            });

            // Age calculation
            const dobInput = document.querySelector('input[name="dateOfBirth"]');
            const ageInput = document.querySelector('input[name="age"]');

            dobInput.addEventListener('change', function() {
                if (this.value) {
                    const birthDate = new Date(this.value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    
                    ageInput.value = age;
                }
            });

            // Hobbies selection
            const hobbyChips = document.querySelectorAll('.hobby-chip');
            const hobbiesInput = document.querySelector('input[name="hobbies"]');
            const selectedHobbies = [];

            hobbyChips.forEach(chip => {
                chip.addEventListener('click', function() {
                    const hobby = this.dataset.hobby;
                    
                    if (this.classList.contains('selected')) {
                        this.classList.remove('selected');
                        const index = selectedHobbies.indexOf(hobby);
                        if (index > -1) {
                            selectedHobbies.splice(index, 1);
                        }
                    } else {
                        this.classList.add('selected');
                        selectedHobbies.push(hobby);
                    }
                    
                    hobbiesInput.value = selectedHobbies.join(',');
                });
            });

            // Password strength indicator
            const passwordInput = document.querySelector('input[name="password"]');
            const strengthBar = document.getElementById('passwordStrength');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                if (password.length >= 6) strength += 25;
                if (password.match(/[a-z]/)) strength += 25;
                if (password.match(/[A-Z]/)) strength += 25;
                if (password.match(/[0-9]/)) strength += 25;
                
                strengthBar.style.width = strength + '%';
                
                if (strength < 50) {
                    strengthBar.className = 'progress-bar bg-danger';
                } else if (strength < 75) {
                    strengthBar.className = 'progress-bar bg-warning';
                } else {
                    strengthBar.className = 'progress-bar bg-success';
                }
            });

            // Update wizard display
            function updateWizard() {
                // Update step visibility
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });

                // Update progress bar
                const progress = ((currentStep + 1) / totalSteps) * 100;
                progressBar.style.width = progress + '%';
                progressBar.setAttribute('aria-valuenow', progress);

                // Update step counters
                document.getElementById('currentStep').textContent = currentStep + 1;
                document.getElementById('navCurrentStep').textContent = currentStep + 1;
                document.getElementById('progressPercent').textContent = Math.round(progress);

                // Update navigation buttons
                const prevBtn = wizard.querySelector('.btn-prev');
                const nextBtn = wizard.querySelector('.btn-next');
                
                prevBtn.disabled = currentStep === 0;
                
                if (currentStep === totalSteps - 1) {
                    nextBtn.style.display = 'none';
                    submitButton.style.display = 'inline-block';
                } else {
                    nextBtn.style.display = 'inline-block';
                    submitButton.style.display = 'none';
                }

                // Save progress
                localStorage.setItem('registrationStep', currentStep);
            }

            // Next button handler
            wizard.addEventListener('click', function(e) {
                if (e.target.closest('.btn-next')) {
                    if (validateCurrentStep()) {
                        currentStep = Math.min(currentStep + 1, totalSteps - 1);
                        updateWizard();
                        saveFormData();
                    }
                }
            });

            // Previous button handler
            wizard.addEventListener('click', function(e) {
                if (e.target.closest('.btn-prev')) {
                    currentStep = Math.max(currentStep - 1, 0);
                    updateWizard();
                }
            });

            // Form submission
           const registrationForm = document.getElementById('registrationForm');

registrationForm.addEventListener('submit', function(e) {
    e.preventDefault(); // page reload stop
    console.log("Yets");

    if (!validateCurrentStep()) {
        return;
    }

    console.log("Yet");

    // Show loading state
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Profile...';
    submitButton.disabled = true;

    // Collect form data
    const formData = new FormData(registrationForm);

    // AJAX call
    fetch('/register', {
        method: 'POST',
         headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        console.log("Server response:", data);

        if (data.success) {
            localStorage.removeItem('registrationStep');
            localStorage.removeItem('registrationProgress');

            alert('Profile created successfully! Please check your email to verify your account.');
            window.location.href = 'dashboard';
        } else {
            alert(data.message || "Something went wrong!");
            submitButton.innerHTML = 'Submit';
            submitButton.disabled = false;
        }
    })
    .catch(err => {
        console.error(err);
        alert("Server error. Try again!");
        submitButton.innerHTML = 'Submit';
        submitButton.disabled = false;
    });
});


            // Validate current step
            function validateCurrentStep() {
                const currentStepElement = steps[currentStep];
                const requiredFields = currentStepElement.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    field.classList.remove('is-invalid');
                    
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                    
                    // Special validation for email
                    if (field.type === 'email' && field.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            field.classList.add('is-invalid');
                            isValid = false;
                        }
                    }
                    
                    // Special validation for mobile
                    if (field.name === 'mobile' && field.value) {
                        const mobileRegex = /^[6-9]\d{9}$/;
                        if (!mobileRegex.test(field.value)) {
                            field.classList.add('is-invalid');
                            isValid = false;
                        }
                    }
                });

                // Special validation for profile for selection
                if (currentStep === 0 && !profileForInput.value) {
                    window.BandBazaBarat.showNotification('Please select who this profile is for', 'error');
                    isValid = false;
                }

                if (!isValid) {
                    window.BandBazaBarat.showNotification('Please fill in all required fields correctly', 'error');
                }

                return isValid;
            }

            // Save form data to localStorage
            function saveFormData() {
                const formData = new FormData(registrationForm);
                const data = {};
                
                for (let [key, value] of formData.entries()) {
                    data[key] = value;
                }
                
                localStorage.setItem('registrationProgress', JSON.stringify(data));
            }

            // Load saved progress
            function loadSavedProgress() {
                const savedStep = localStorage.getItem('registrationStep');
                const savedData = localStorage.getItem('registrationProgress');
                
                if (savedStep) {
                    currentStep = parseInt(savedStep);
                }
                
                if (savedData) {
                    try {
                        const data = JSON.parse(savedData);
                        Object.keys(data).forEach(key => {
                            const field = registrationForm.querySelector(`[name="${key}"]`);
                            if (field) {
                                field.value = data[key];
                                
                                // Trigger change event for special fields
                                if (key === 'dateOfBirth') {
                                    field.dispatchEvent(new Event('change'));
                                }
                            }
                        });
                        
                        // Restore profile for selection
                        if (data.profileFor) {
                            const selectedCard = document.querySelector(`[data-value="${data.profileFor}"]`);
                            if (selectedCard) {
                                selectedCard.click();
                            }
                        }
                        
                        // Restore hobbies
                        if (data.hobbies) {
                            const hobbies = data.hobbies.split(',');
                            hobbies.forEach(hobby => {
                                const chip = document.querySelector(`[data-hobby="${hobby}"]`);
                                if (chip) {
                                    chip.click();
                                }
                            });
                        }
                        
                    } catch (e) {
                        console.error('Error loading saved data:', e);
                    }
                }
            }
            updateWizard();
            loadSavedProgress();
        });
    </script>
@endsection
