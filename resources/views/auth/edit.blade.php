@extends('layouts.app')
@section('content')
    
    <style>
        .edit-profile-container {
            background: linear-gradient(135deg, var(--light-bg) 0%, #FFF5F0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .edit-profile-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        
        .edit-profile-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        
        .edit-profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFFFFF' fill-opacity='0.1'%3E%3Cpath d='M30 5 L35 20 L50 20 L40 30 L45 50 L30 40 L15 50 L20 30 L10 20 L25 20 Z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }
        
        .edit-profile-header h2 {
            position: relative;
            z-index: 2;
        }
        
        .profile-photo-section {
            background: var(--light-bg);
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }
        
        .current-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--white);
            box-shadow: var(--shadow);
            margin-bottom: 1rem;
        }
        
        .photo-upload-btn {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .photo-upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
        
        .edit-section {
            padding: 2rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .section-title {
            color: var(--maroon);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-title i {
            color: var(--golden-orange);
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
        
        .save-changes-btn {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            border: none;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(128, 0, 0, 0.3);
        }
        
        .save-changes-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(128, 0, 0, 0.4);
        }
        
        .cancel-btn {
            background: transparent;
            color: var(--maroon);
            border: 2px solid var(--maroon);
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
        }
        
        .cancel-btn:hover {
            background: var(--maroon);
            color: var(--white);
        }
        
        .divider {
            height: 2px;
            background: linear-gradient(90deg, var(--golden-orange), var(--deep-pink));
            border: none;
            margin: 2rem 0;
        }
        
        .alert-custom {
            background: linear-gradient(135deg, var(--light-bg), #FFF5F0);
            border: 1px solid var(--golden-orange);
            border-radius: var(--border-radius);
            color: var(--maroon);
        }
        
        @media (max-width: 768px) {
            .edit-profile-card {
                margin: 0 1rem;
            }
            
            .edit-profile-header {
                padding: 1.5rem;
            }
            
            .edit-section {
                padding: 1.5rem;
            }
            
            .current-photo {
                width: 100px;
                height: 100px;
            }
        }
    </style>

    <!-- Edit Profile Container -->
    <div class="edit-profile-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="edit-profile-card">
                        <!-- Header -->
                        <div class="edit-profile-header">
                            <h2><i class="fas fa-user-edit me-2"></i>Edit Your Profile</h2>
                            <p class="mb-0">Update your information to find better matches</p>
                        </div>

                        <!-- Profile Photo Section -->
                        <div class="profile-photo-section">
                            <img src="https://via.placeholder.com/120x120/FFB347/FFFFFF?text=Profile" alt="Current Profile Photo" class="current-photo" id="currentPhoto">
                            <br>
                            <button type="button" class="photo-upload-btn" onclick="document.getElementById('profilePhoto').click()">
                                <i class="fas fa-camera me-2"></i>Change Photo
                            </button>
                            <input type="file" id="profilePhoto" accept="image/*" style="display: none;" onchange="previewPhoto(this)">
                            <p class="text-muted mt-2 mb-0">Upload a clear, recent photo for better matches</p>
                        </div>

                        <!-- Edit Profile Form -->
                        <form id="editProfileForm">
                            <!-- Basic Information -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-user"></i>Basic Information
                                </h3>
                                <div class="alert alert-custom">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Profile For:</strong> Myself (Priya Sharma)
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" class="form-control" name="fullName" value="Priya Sharma" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Gender</label>
                                            <select class="form-select" name="gender" required>
                                                <option value="female" selected>Female</option>
                                                <option value="male">Male</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Date of Birth</label>
                                            <input type="date" class="form-control" name="dateOfBirth" value="1998-05-15" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Age</label>
                                            <input type="number" class="form-control" name="age" value="26" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cultural Information -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-om"></i>Cultural Information
                                </h3>
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
                                            <select class="form-select" name="caste" required>
                                                <option value="brahmin" selected>Brahmin</option>
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
                                            <select class="form-select" name="subCaste">
                                                <option value="iyer" selected>Iyer</option>
                                                <option value="iyengar">Iyengar</option>
                                                <option value="other">Other</option>
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
                                                <option value="hindi" selected>Hindi</option>
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
                                                <option value="unmarried" selected>Unmarried</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="separated">Separated</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Details -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-map-marker-alt"></i>Location Details
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Native State</label>
                                            <select class="form-select" name="nativeState" required>
                                                <option value="maharashtra" selected>Maharashtra</option>
                                                <option value="andhra-pradesh">Andhra Pradesh</option>
                                                <option value="karnataka">Karnataka</option>
                                                <option value="kerala">Kerala</option>
                                                <option value="tamil-nadu">Tamil Nadu</option>
                                                <option value="telangana">Telangana</option>
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
                                            <input type="text" class="form-control" name="nativeDistrict" value="Mumbai">
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
                                            <input type="text" class="form-control" name="currentState" value="Maharashtra" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Current City</label>
                                            <input type="text" class="form-control" name="currentCity" value="Mumbai" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">PIN/ZIP Code</label>
                                            <input type="text" class="form-control" name="pinCode" value="400001">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Education & Professional -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-graduation-cap"></i>Education & Professional Details
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Highest Qualification</label>
                                            <select class="form-select" name="education" required>
                                                <option value="postgraduate" selected>Postgraduate (M.A/M.Sc/MBA)</option>
                                                <option value="10th">10th / Matric</option>
                                                <option value="12th">12th / Higher Secondary</option>
                                                <option value="diploma">Diploma</option>
                                                <option value="graduate">Graduate (B.A/B.Sc/B.Com)</option>
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
                                                <option value="private" selected>Private Sector Employee</option>
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
                                            <input type="text" class="form-control" name="jobTitle" value="Software Engineer">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Employer/Company</label>
                                            <input type="text" class="form-control" name="employer" value="Tech Solutions Ltd">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Annual Income (INR)</label>
                                            <select class="form-select" name="annualIncome">
                                                <option value="5-10" selected>5-10 Lakh</option>
                                                <option value="upto-1">Up to 1 Lakh</option>
                                                <option value="1-2">1-2 Lakh</option>
                                                <option value="2-3">2-3 Lakh</option>
                                                <option value="3-5">3-5 Lakh</option>
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

                            <!-- Lifestyle & Preferences -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-heart"></i>Lifestyle & Preferences
                                </h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label required">Height</label>
                                            <select class="form-select" name="height" required>
                                                <option value="5'4" selected>5'4" (163 cm)</option>
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
                                            <input type="number" class="form-control" name="weight" value="55" min="30" max="150">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label required">Food Habits</label>
                                            <select class="form-select" name="foodHabits" required>
                                                <option value="vegetarian" selected>Vegetarian</option>
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
                                                <option value="never" selected>Never</option>
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
                                                <option value="never" selected>Never</option>
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
                                                <span class="hobby-chip selected" data-hobby="reading">Reading</span>
                                                <span class="hobby-chip selected" data-hobby="music">Music</span>
                                                <span class="hobby-chip" data-hobby="dancing">Dancing</span>
                                                <span class="hobby-chip selected" data-hobby="cooking">Cooking</span>
                                                <span class="hobby-chip" data-hobby="traveling">Traveling</span>
                                                <span class="hobby-chip" data-hobby="sports">Sports</span>
                                                <span class="hobby-chip" data-hobby="photography">Photography</span>
                                                <span class="hobby-chip" data-hobby="gardening">Gardening</span>
                                                <span class="hobby-chip selected" data-hobby="movies">Movies</span>
                                                <span class="hobby-chip" data-hobby="painting">Painting</span>
                                                <span class="hobby-chip" data-hobby="yoga">Yoga/Meditation</span>
                                                <span class="hobby-chip" data-hobby="fitness">Fitness</span>
                                            </div>
                                            <input type="hidden" name="hobbies" value="reading,music,cooking,movies">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Family Background -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-home"></i>Family Background
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Father's Occupation</label>
                                            <input type="text" class="form-control" name="fatherOccupation" value="Government Officer">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mother's Occupation</label>
                                            <input type="text" class="form-control" name="motherOccupation" value="Teacher">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Family Status</label>
                                            <select class="form-select" name="familyStatus">
                                                <option value="middle-class" selected>Middle Class</option>
                                                <option value="upper-middle-class">Upper Middle Class</option>
                                                <option value="rich">Rich/Affluent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Number of Siblings</label>
                                            <select class="form-select" name="siblings">
                                                <option value="1" selected>1 Sibling</option>
                                                <option value="0">No Siblings</option>
                                                <option value="2">2 Siblings</option>
                                                <option value="3">3 Siblings</option>
                                                <option value="4+">4 or More Siblings</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">About Family</label>
                                            <textarea class="form-control" name="aboutFamily" rows="3" placeholder="Brief description about your family background, values, and traditions...">We are a traditional Hindu family with strong cultural values. My parents have always emphasized the importance of education and maintaining our cultural roots.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Horoscope Details -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-star"></i>Horoscope Details (Optional)
                                </h3>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Horoscope matching is optional but helps in finding more compatible matches based on traditional astrology.
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Rashi (Moon Sign)</label>
                                            <select class="form-select" name="rashi">
                                                <option value="cancer" selected>Kark (Cancer)</option>
                                                <option value="aries">Mesh (Aries)</option>
                                                <option value="taurus">Vrishabh (Taurus)</option>
                                                <option value="gemini">Mithun (Gemini)</option>
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
                                                <option value="pushya" selected>Pushya</option>
                                                <option value="ashwini">Ashwini</option>
                                                <option value="bharani">Bharani</option>
                                                <option value="krittika">Krittika</option>
                                                <option value="rohini">Rohini</option>
                                                <option value="mrigashira">Mrigashira</option>
                                                <option value="ardra">Ardra</option>
                                                <option value="punarvasu">Punarvasu</option>
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
                                                <option value="no" selected>No</option>
                                                <option value="yes">Yes</option>
                                                <option value="partially">Partially</option>
                                                <option value="dont-know">Don't Know</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Birth Time</label>
                                            <input type="time" class="form-control" name="birthTime" value="14:30">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Birth Place</label>
                                            <input type="text" class="form-control" name="birthPlace" value="Mumbai, Maharashtra">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="edit-section">
                                <h3 class="section-title">
                                    <i class="fas fa-phone"></i>Contact Information
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Mobile Number</label>
                                            <input type="tel" class="form-control" name="mobile" value="9876543210" required pattern="[6-9][0-9]{9}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">WhatsApp Number</label>
                                            <input type="tel" class="form-control" name="whatsapp" value="9876543210">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" class="form-control" name="email" value="priya.sharma@email.com" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="edit-section text-center">
                                <hr class="divider">
                                <div class="d-flex justify-content-center gap-3 flex-wrap">
                                    <button type="submit" class="save-changes-btn">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                    <button type="button" class="cancel-btn" onclick="window.location.href='profile.html'">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="app.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit profile specific JavaScript
            
            // Age calculation
            const dobInput = document.querySelector('input[name="dateOfBirth"]');
            const ageInput = document.querySelector('input[name="age"]');

            function calculateAge() {
                if (dobInput.value) {
                    const birthDate = new Date(dobInput.value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    
                    ageInput.value = age;
                }
            }

            dobInput.addEventListener('change', calculateAge);
            calculateAge(); // Calculate on page load

            // Hobbies selection
            const hobbyChips = document.querySelectorAll('.hobby-chip');
            const hobbiesInput = document.querySelector('input[name="hobbies"]');
            const selectedHobbies = [];

            // Initialize selected hobbies
            const initialHobbies = hobbiesInput.value.split(',');
            initialHobbies.forEach(hobby => {
                if (hobby.trim()) {
                    selectedHobbies.push(hobby.trim());
                    const chip = document.querySelector(`[data-hobby="${hobby.trim()}"]`);
                    if (chip) {
                        chip.classList.add('selected');
                    }
                }
            });

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

            // Form submission
            const editProfileForm = document.getElementById('editProfileForm');
            editProfileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = document.querySelector('.save-changes-btn');
                const originalText = submitBtn.innerHTML;
                
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving Changes...';
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    showNotification('Profile updated successfully!', 'success');
                    
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    
                    // Redirect to profile page after a delay
                    setTimeout(() => {
                        window.location.href = 'profile.html';
                    }, 2000);
                }, 2000);
            });

            // Notification function
            function showNotification(message, type) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
                alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                document.body.appendChild(alertDiv);
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
            }
        });

        // Photo preview function
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('currentPhoto').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
