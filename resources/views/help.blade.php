@extends('layouts.app')
@section('content')
    
    <style>
        .help-container {
            background: linear-gradient(135deg, var(--light-bg) 0%, #FFF5F0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .help-hero-section {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .help-hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFFFFF' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.3;
            animation: float 10s ease-in-out infinite;
        }
        
        .help-hero-section h1 {
            position: relative;
            z-index: 2;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }
        
        .help-hero-section p {
            position: relative;
            z-index: 2;
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .search-box {
            position: relative;
            z-index: 2;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-box .form-control {
            border-radius: 50px;
            padding: 1rem 1.5rem;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .search-box .btn {
            border-radius: 50px;
            padding: 1rem 2rem;
            margin-left: 0.5rem;
        }
        
        .help-content {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 3rem;
            margin-top: -2rem;
            position: relative;
            z-index: 10;
        }
        
        .help-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }
        
        .category-card {
            background: linear-gradient(135deg, var(--light-bg), #FFF5F0);
            border: 2px solid transparent;
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--golden-orange), var(--deep-pink));
            opacity: 0;
            transition: var(--transition);
        }
        
        .category-card:hover::before {
            opacity: 0.1;
        }
        
        .category-card:hover {
            border-color: var(--golden-orange);
            transform: translateY(-5px);
        }
        
        .category-card i {
            font-size: 3rem;
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        .category-card h3 {
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        .category-card p {
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }
        
        .category-card .btn {
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
        }
        
        .faq-section {
            margin-bottom: 4rem;
        }
        
        .faq-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .faq-header h2 {
            color: var(--maroon);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .faq-header p {
            color: var(--text-dark);
            font-size: 1.1rem;
        }
        
        .faq-item {
            background: var(--white);
            border: 1px solid #e9ecef;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .faq-item:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .faq-question {
            background: linear-gradient(135deg, var(--light-bg), #FFF5F0);
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: none;
            width: 100%;
            text-align: left;
        }
        
        .faq-question h4 {
            color: var(--maroon);
            margin: 0;
            font-size: 1.1rem;
        }
        
        .faq-question i {
            color: var(--golden-orange);
            transition: var(--transition);
        }
        
        .faq-question.active i {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .faq-answer.active {
            padding: 1.5rem;
            max-height: 500px;
        }
        
        .faq-answer p {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 0;
        }
        
        .contact-support {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            border-radius: var(--border-radius);
            padding: 3rem;
            text-align: center;
            margin: 3rem 0;
        }
        
        .contact-support h3 {
            margin-bottom: 1.5rem;
        }
        
        .contact-support p {
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .contact-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .contact-method {
            background: rgba(255,255,255,0.1);
            border-radius: var(--border-radius);
            padding: 2rem;
            backdrop-filter: blur(10px);
        }
        
        .contact-method i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        
        .contact-method h5 {
            margin-bottom: 1rem;
        }
        
        .contact-method p {
            margin-bottom: 1rem;
            opacity: 0.8;
        }
        
        .quick-links {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-top: 3rem;
        }
        
        .quick-links h3 {
            color: var(--maroon);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .quick-link {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 1rem;
            text-align: center;
            text-decoration: none;
            color: var(--text-dark);
            transition: var(--transition);
            border: 1px solid #e9ecef;
        }
        
        .quick-link:hover {
            background: var(--golden-orange);
            color: var(--white);
            transform: translateY(-2px);
            text-decoration: none;
        }
        
        .quick-link i {
            display: block;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .help-hero-section h1 {
                font-size: 2.5rem;
            }
            
            .help-content {
                margin: 0 1rem;
                margin-top: -1rem;
                padding: 2rem;
            }
            
            .help-categories {
                grid-template-columns: 1fr;
            }
            
            .contact-methods {
                grid-template-columns: 1fr;
            }
            
            .quick-links-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>


    <!-- Help Hero Section -->
    <section class="help-hero-section">
        <div class="container">
            <h1><i class="fas fa-question-circle me-3"></i>How Can We Help You?</h1>
            <p class="lead">Find answers to your questions, learn about our services, and get support.</p>
            
            <div class="search-box">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for topics or questions..." id="helpSearchInput">
                    <button class="btn btn-light" type="button" id="helpSearchBtn">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Content -->
    <div class="help-container">
        <div class="container">
            <div class="help-content">
                <!-- Help Categories -->
                <div class="help-categories">
                    <div class="category-card">
                        <i class="fas fa-user-plus"></i>
                        <h3>Getting Started</h3>
                        <p>Learn how to create your profile, complete registration, and start your journey to find your perfect match.</p>
                        <a href="#getting-started" class="btn btn-primary">Learn More</a>
                    </div>
                    
                    <div class="category-card">
                        <i class="fas fa-search"></i>
                        <h3>Search & Match</h3>
                        <p>Discover how to search for profiles, use filters, and understand our matching algorithms.</p>
                        <a href="#search-match" class="btn btn-primary">Learn More</a>
                    </div>
                    
                    <div class="category-card">
                        <i class="fas fa-crown"></i>
                        <h3>Membership</h3>
                        <p>Understand our membership plans, payment options, and premium features available to you.</p>
                        <a href="#membership" class="btn btn-primary">Learn More</a>
                    </div>
                    
                    <div class="category-card">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Privacy & Security</h3>
                        <p>Learn about our privacy measures, data protection, and how to keep your information safe.</p>
                        <a href="#privacy-security" class="btn btn-primary">Learn More</a>
                    </div>
                    
                    <div class="category-card">
                        <i class="fas fa-credit-card"></i>
                        <h3>Billing & Payments</h3>
                        <p>Get help with payment issues, subscription management, and billing questions.</p>
                        <a href="#billing-payments" class="btn btn-primary">Learn More</a>
                    </div>
                    
                    <div class="category-card">
                        <i class="fas fa-cog"></i>
                        <h3>Account Settings</h3>
                        <p>Manage your profile, update information, change settings, and control your privacy.</p>
                        <a href="#account-settings" class="btn btn-primary">Learn More</a>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="faq-section">
                    <div class="faq-header">
                        <h2><i class="fas fa-question-circle me-2"></i>Frequently Asked Questions</h2>
                        <p>Find quick answers to the most common questions about BandBazaBarat</p>
                    </div>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-user-plus me-2"></i>How do I create a profile on BandBazaBarat?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Creating a profile is easy! Click on "Register" in the top navigation, fill in your basic information including name, email, and phone number. You'll then be guided through a step-by-step process to complete your profile with details like education, occupation, family background, and preferences. Make sure to upload a recent photo and provide accurate information to increase your chances of finding the right match.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-search me-2"></i>How does the matching system work?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Our advanced matching system considers multiple factors including age, location, education, occupation, family background, cultural preferences, and horoscope compatibility. We use sophisticated algorithms to suggest profiles that align with your preferences and values. You can also use our search filters to find specific criteria like caste, sub-caste, gotra, or other cultural parameters important in Hindu matrimony.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-crown me-2"></i>What are the benefits of premium membership?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Premium members enjoy unlimited profile views, direct messaging capabilities, access to contact details, priority customer support, advanced search filters, and personalized match recommendations. You also get access to horoscope matching, family background verification, and exclusive events. Premium membership significantly increases your chances of finding your perfect match.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-shield-alt me-2"></i>How do you protect my privacy?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>We take your privacy seriously. All personal data is encrypted using industry-standard protocols. Your photos are protected with watermarks, and you have full control over your privacy settings. We never share your personal information with third parties without your explicit consent. You can choose who can view your profile and contact details, and you can block or report any user if needed.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-credit-card me-2"></i>What payment methods do you accept?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>We accept all major credit cards, debit cards, net banking, UPI, and digital wallets like Paytm, Google Pay, and PhonePe. All payments are processed securely through trusted payment gateways. We also offer EMI options for premium memberships. You can choose from various subscription plans - monthly, quarterly, or yearly - depending on your needs.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-user-edit me-2"></i>How can I edit my profile information?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>You can edit your profile anytime by logging into your account and clicking on "Edit Profile" in your dashboard. You can update personal information, photos, preferences, and contact details. We recommend keeping your profile updated with recent photos and accurate information to improve your matching prospects. All changes are saved automatically.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-heart me-2"></i>How do I contact someone I'm interested in?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Free members can send interest requests to profiles they like. Premium members can send direct messages and access contact details. We encourage respectful communication and recommend taking time to get to know each other before sharing personal contact information. Always involve your family in the decision-making process as per traditional Hindu matrimonial customs.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFAQ(this)">
                                <h4><i class="fas fa-calendar-alt me-2"></i>Do you offer horoscope matching services?</h4>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes! We offer comprehensive horoscope matching services including kundali matching, rashi compatibility, nakshatra analysis, and manglik status verification. Our expert astrologers provide detailed compatibility reports. Premium members get access to advanced horoscope matching features and can consult with our certified astrologers for personalized guidance.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Support Section -->
                <div class="contact-support">
                    <h3><i class="fas fa-headset me-2"></i>Still Need Help?</h3>
                    <p>Our dedicated support team is here to help you with any questions or concerns.</p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <i class="fas fa-phone"></i>
                            <h5>Call Us</h5>
                            <p>Speak directly with our support team</p>
                            <a href="tel:+919234410536" class="btn btn-light btn-sm">+91 9234410536</a>
                        </div>
                        
                        <div class="contact-method">
                            <i class="fas fa-envelope"></i>
                            <h5>Email Support</h5>
                            <p>Get detailed responses via email</p>
                            <a href="mailto:support@bandbazabarat.com" class="btn btn-light btn-sm">support@bandbazabarat.com</a>
                        </div>
                        
                        <div class="contact-method">
                            <i class="fas fa-comments"></i>
                            <h5>Live Chat</h5>
                            <p>Chat with us in real-time</p>
                            <button class="btn btn-light btn-sm" onclick="openLiveChat()">Start Chat</button>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="quick-links">
                    <h3><i class="fas fa-link me-2"></i>Quick Links</h3>
                    <div class="quick-links-grid">
                        <a href="register.html" class="quick-link">
                            <i class="fas fa-user-plus"></i>
                            <span>Create Profile</span>
                        </a>
                        <a href="search.html" class="quick-link">
                            <i class="fas fa-search"></i>
                            <span>Search Matches</span>
                        </a>
                        <a href="membership.html" class="quick-link">
                            <i class="fas fa-crown"></i>
                            <span>Membership Plans</span>
                        </a>
                        <a href="edituser.html" class="quick-link">
                            <i class="fas fa-user-edit"></i>
                            <span>Edit Profile</span>
                        </a>
                        <a href="Terms-of-views.html" class="quick-link">
                            <i class="fas fa-file-contract"></i>
                            <span>Terms of Service</span>
                        </a>
                        <a href="contact.html" class="quick-link">
                            <i class="fas fa-envelope"></i>
                            <span>Contact Us</span>
                        </a>
                        <a href="about.html" class="quick-link">
                            <i class="fas fa-info-circle"></i>
                            <span>About Us</span>
                        </a>
                        <a href="success-stories.html" class="quick-link">
                            <i class="fas fa-heart"></i>
                            <span>Success Stories</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ Toggle Function
            window.toggleFAQ = function(element) {
                const answer = element.nextElementSibling;
                const icon = element.querySelector('i.fa-chevron-down');
                
                // Close all other FAQs
                document.querySelectorAll('.faq-question').forEach(question => {
                    if (question !== element) {
                        question.classList.remove('active');
                        question.nextElementSibling.classList.remove('active');
                    }
                });
                
                // Toggle current FAQ
                element.classList.toggle('active');
                answer.classList.toggle('active');
            };
            
            // Search Functionality
            const searchInput = document.getElementById('helpSearchInput');
            const searchBtn = document.getElementById('helpSearchBtn');
            
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();
                const faqItems = document.querySelectorAll('.faq-item');
                
                faqItems.forEach(item => {
                    const question = item.querySelector('h4').textContent.toLowerCase();
                    const answer = item.querySelector('p').textContent.toLowerCase();
                    
                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                        // Highlight matching text
                        if (searchTerm) {
                            item.style.backgroundColor = 'rgba(255, 179, 71, 0.1)';
                        } else {
                            item.style.backgroundColor = '';
                        }
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
            
            searchBtn.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
            
            // Live Chat Function
            window.openLiveChat = function() {
                alert('Live chat feature will be available soon! For now, please contact us via phone or email.');
            };
            
            // Smooth scrolling for category links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endsection