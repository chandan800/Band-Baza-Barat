@extends('layouts.app')
@section('content')
    
    <style>
        .terms-container {
            background: linear-gradient(135deg, var(--light-bg) 0%, #FFF5F0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .terms-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 3rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .terms-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFFFFF' fill-opacity='0.1'%3E%3Cpath d='M40 10 L50 30 L70 30 L55 45 L65 70 L40 55 L15 70 L25 45 L10 30 L30 30 Z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.3;
            animation: float 8s ease-in-out infinite;
        }
        
        .terms-header h1 {
            position: relative;
            z-index: 2;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .terms-header p {
            position: relative;
            z-index: 2;
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .terms-content {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 3rem;
            margin-top: -2rem;
            position: relative;
            z-index: 10;
        }
        
        .terms-section {
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .terms-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .section-title {
            color: var(--maroon);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-title i {
            color: var(--golden-orange);
        }
        
        .terms-text {
            line-height: 1.8;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }
        
        .highlight-box {
            background: linear-gradient(135deg, var(--light-bg), #FFF5F0);
            border: 2px solid var(--golden-orange);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin: 1.5rem 0;
        }
        
        .highlight-box h5 {
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        .terms-list {
            list-style: none;
            padding: 0;
        }
        
        .terms-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
            padding-left: 2rem;
        }
        
        .terms-list li:last-child {
            border-bottom: none;
        }
        
        .terms-list li::before {
            content: '•';
            color: var(--golden-orange);
            font-weight: bold;
            position: absolute;
            left: 0;
            font-size: 1.5rem;
        }
        
        .important-note {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #ffc107;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin: 2rem 0;
            position: relative;
        }
        
        .important-note::before {
            content: '⚠️';
            position: absolute;
            top: -10px;
            left: 20px;
            background: var(--white);
            padding: 0 10px;
            font-size: 1.2rem;
        }
        
        .important-note h5 {
            color: #856404;
            margin-bottom: 1rem;
        }
        
        .important-note p {
            color: #856404;
            margin-bottom: 0;
        }
        
        .contact-info-box {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            margin: 2rem 0;
        }
        
        .contact-info-box h4 {
            margin-bottom: 1rem;
        }
        
        .contact-info-box p {
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        
        .table-of-contents {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 3rem;
        }
        
        .table-of-contents h3 {
            color: var(--maroon);
            margin-bottom: 1.5rem;
        }
        
        .toc-list {
            list-style: none;
            padding: 0;
        }
        
        .toc-list li {
            margin-bottom: 0.5rem;
        }
        
        .toc-list a {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .toc-list a:hover {
            color: var(--maroon);
            transform: translateX(5px);
        }
        
        .toc-list a::before {
            content: '→';
            color: var(--golden-orange);
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .terms-header h1 {
                font-size: 2.5rem;
            }
            
            .terms-content {
                margin: 0 1rem;
                margin-top: -1rem;
                padding: 2rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

    <!-- Terms Header -->
    <section class="terms-header">
        <div class="container">
            <h1><i class="fas fa-file-contract me-3"></i>Terms of Service</h1>
            <p>Please read these terms carefully before using BandBazaBarat</p>
        </div>
    </section>

    <!-- Terms Content -->
    <div class="terms-container">
        <div class="container">
            <div class="terms-content">
                <!-- Table of Contents -->
                <div class="table-of-contents">
                    <h3><i class="fas fa-list me-2"></i>Table of Contents</h3>
                    <ul class="toc-list">
                        <li><a href="#acceptance">1. Acceptance of Terms</a></li>
                        <li><a href="#eligibility">2. Eligibility</a></li>
                        <li><a href="#registration">3. Registration & Account</a></li>
                        <li><a href="#privacy">4. Privacy & Data Protection</a></li>
                        <li><a href="#conduct">5. User Conduct</a></li>
                        <li><a href="#prohibited">6. Prohibited Activities</a></li>
                        <li><a href="#membership">7. Membership & Payments</a></li>
                        <li><a href="#intellectual">8. Intellectual Property</a></li>
                        <li><a href="#liability">9. Limitation of Liability</a></li>
                        <li><a href="#termination">10. Termination</a></li>
                        <li><a href="#changes">11. Changes to Terms</a></li>
                        <li><a href="#contact">12. Contact Information</a></li>
                    </ul>
                </div>

                <!-- Last Updated -->
                <div class="highlight-box">
                    <h5><i class="fas fa-calendar-alt me-2"></i>Last Updated: January 15, 2025</h5>
                    <p>These Terms of Service govern your use of BandBazaBarat.com and all related services. By accessing or using our platform, you agree to be bound by these terms.</p>
                </div>

                <!-- Section 1: Acceptance of Terms -->
                <div class="terms-section" id="acceptance">
                    <h2 class="section-title">
                        <i class="fas fa-check-circle"></i>1. Acceptance of Terms
                    </h2>
                    <div class="terms-text">
                        <p>By accessing and using BandBazaBarat ("the Service"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
                        
                        <p>These terms apply to all visitors, users, and others who access or use the Service. By using our Service, you agree to:</p>
                        
                        <ul class="terms-list">
                            <li>Comply with all applicable laws and regulations</li>
                            <li>Provide accurate and complete information</li>
                            <li>Maintain the security of your account</li>
                            <li>Respect the privacy and rights of other users</li>
                            <li>Use the Service only for lawful purposes</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 2: Eligibility -->
                <div class="terms-section" id="eligibility">
                    <h2 class="section-title">
                        <i class="fas fa-user-check"></i>2. Eligibility
                    </h2>
                    <div class="terms-text">
                        <p>To use BandBazaBarat, you must meet the following eligibility requirements:</p>
                        
                        <ul class="terms-list">
                            <li>Be at least 18 years of age at the time of registration</li>
                            <li>Be legally single, divorced, or widowed</li>
                            <li>Have the legal capacity to enter into a binding agreement</li>
                            <li>Reside in a jurisdiction where our services are available</li>
                            <li>Provide accurate and truthful information during registration</li>
                        </ul>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Important Note</h5>
                            <p>We reserve the right to verify your eligibility and may request additional documentation to confirm your identity and marital status. Providing false information may result in immediate account termination.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Registration & Account -->
                <div class="terms-section" id="registration">
                    <h2 class="section-title">
                        <i class="fas fa-user-plus"></i>3. Registration & Account
                    </h2>
                    <div class="terms-text">
                        <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for:</p>
                        
                        <ul class="terms-list">
                            <li>Maintaining the confidentiality of your account credentials</li>
                            <li>All activities that occur under your account</li>
                            <li>Notifying us immediately of any unauthorized use</li>
                            <li>Keeping your profile information up to date</li>
                            <li>Ensuring your profile photos are recent and accurate</li>
                        </ul>
                        
                        <p>You may not:</p>
                        <ul class="terms-list">
                            <li>Create multiple accounts for the same person</li>
                            <li>Use someone else's identity or information</li>
                            <li>Share your account credentials with others</li>
                            <li>Create accounts on behalf of others without their consent</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 4: Privacy & Data Protection -->
                <div class="terms-section" id="privacy">
                    <h2 class="section-title">
                        <i class="fas fa-shield-alt"></i>4. Privacy & Data Protection
                    </h2>
                    <div class="terms-text">
                        <p>Your privacy is important to us. Our Privacy Policy explains how we collect, use, and protect your personal information. By using our Service, you consent to our collection and use of information as detailed in our Privacy Policy.</p>
                        
                        <div class="highlight-box">
                            <h5><i class="fas fa-lock me-2"></i>Data Protection Measures</h5>
                            <ul class="terms-list">
                                <li>All personal data is encrypted using industry-standard protocols</li>
                                <li>We implement strict access controls and security measures</li>
                                <li>Your photos are protected with watermarks</li>
                                <li>We never share your personal information with third parties without consent</li>
                                <li>You have full control over your privacy settings</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section 5: User Conduct -->
                <div class="terms-section" id="conduct">
                    <h2 class="section-title">
                        <i class="fas fa-handshake"></i>5. User Conduct
                    </h2>
                    <div class="terms-text">
                        <p>As a user of BandBazaBarat, you agree to conduct yourself in a respectful and appropriate manner. You must:</p>
                        
                        <ul class="terms-list">
                            <li>Treat all users with respect and dignity</li>
                            <li>Communicate honestly and truthfully</li>
                            <li>Respect cultural and religious differences</li>
                            <li>Report any suspicious or inappropriate behavior</li>
                            <li>Maintain appropriate boundaries in communications</li>
                        </ul>
                        
                        <p>We encourage users to:</p>
                        <ul class="terms-list">
                            <li>Be honest about their intentions and background</li>
                            <li>Respect traditional values and cultural practices</li>
                            <li>Engage in meaningful conversations</li>
                            <li>Take time to get to know potential matches</li>
                            <li>Involve families in the decision-making process when appropriate</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 6: Prohibited Activities -->
                <div class="terms-section" id="prohibited">
                    <h2 class="section-title">
                        <i class="fas fa-ban"></i>6. Prohibited Activities
                    </h2>
                    <div class="terms-text">
                        <p>The following activities are strictly prohibited on BandBazaBarat:</p>
                        
                        <ul class="terms-list">
                            <li>Creating fake or misleading profiles</li>
                            <li>Harassing, bullying, or threatening other users</li>
                            <li>Using the platform for commercial purposes</li>
                            <li>Sharing inappropriate or offensive content</li>
                            <li>Attempting to bypass security measures</li>
                            <li>Collecting personal information of other users</li>
                            <li>Using automated tools or bots</li>
                            <li>Impersonating staff or other users</li>
                        </ul>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Consequences</h5>
                            <p>Violation of these terms may result in immediate account suspension or termination, and in some cases, legal action may be taken.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 7: Membership & Payments -->
                <div class="terms-section" id="membership">
                    <h2 class="section-title">
                        <i class="fas fa-crown"></i>7. Membership & Payments
                    </h2>
                    <div class="terms-text">
                        <p>BandBazaBarat offers both free and premium membership options. Premium memberships provide additional features and benefits.</p>
                        
                        <div class="highlight-box">
                            <h5><i class="fas fa-credit-card me-2"></i>Payment Terms</h5>
                            <ul class="terms-list">
                                <li>All payments are processed securely through trusted payment gateways</li>
                                <li>Membership fees are charged in advance for the selected period</li>
                                <li>Refunds are provided according to our refund policy</li>
                                <li>Prices may change with 30 days' notice</li>
                                <li>Automatic renewals can be cancelled at any time</li>
                            </ul>
                        </div>
                        
                        <p>Premium features include:</p>
                        <ul class="terms-list">
                            <li>Unlimited profile views and searches</li>
                            <li>Direct messaging capabilities</li>
                            <li>Access to contact details</li>
                            <li>Priority customer support</li>
                            <li>Advanced matching algorithms</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 8: Intellectual Property -->
                <div class="terms-section" id="intellectual">
                    <h2 class="section-title">
                        <i class="fas fa-copyright"></i>8. Intellectual Property
                    </h2>
                    <div class="terms-text">
                        <p>The Service and its original content, features, and functionality are and will remain the exclusive property of BandBazaBarat and its licensors. The Service is protected by copyright, trademark, and other laws.</p>
                        
                        <p>You retain ownership of content you submit to the Service, but you grant us a license to use, display, and distribute your content as necessary to provide the Service.</p>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Content Guidelines</h5>
                            <p>You are responsible for ensuring that any content you upload does not violate copyright laws or infringe on the rights of others.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 9: Limitation of Liability -->
                <div class="terms-section" id="liability">
                    <h2 class="section-title">
                        <i class="fas fa-balance-scale"></i>9. Limitation of Liability
                    </h2>
                    <div class="terms-text">
                        <p>In no event shall BandBazaBarat, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.</p>
                        
                        <p>Our liability is limited to the amount you paid for the Service in the 12 months preceding the claim.</p>
                        
                        <div class="highlight-box">
                            <h5><i class="fas fa-info-circle me-2"></i>Important Disclaimers</h5>
                            <ul class="terms-list">
                                <li>We do not guarantee successful matches or marriages</li>
                                <li>We are not responsible for the actions of other users</li>
                                <li>We do not verify all information provided by users</li>
                                <li>We recommend meeting in person before making important decisions</li>
                                <li>We encourage involving families in the decision-making process</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section 10: Termination -->
                <div class="terms-section" id="termination">
                    <h2 class="section-title">
                        <i class="fas fa-times-circle"></i>10. Termination
                    </h2>
                    <div class="terms-text">
                        <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
                        
                        <p>Upon termination, your right to use the Service will cease immediately. If you wish to terminate your account, you may simply discontinue using the Service or contact us to delete your account.</p>
                        
                        <ul class="terms-list">
                            <li>You can deactivate your account at any time</li>
                            <li>We will retain your data for 30 days after deactivation</li>
                            <li>You can reactivate your account within 30 days</li>
                            <li>After 30 days, your data will be permanently deleted</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 11: Changes to Terms -->
                <div class="terms-section" id="changes">
                    <h2 class="section-title">
                        <i class="fas fa-edit"></i>11. Changes to Terms
                    </h2>
                    <div class="terms-text">
                        <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days' notice prior to any new terms taking effect.</p>
                        
                        <p>What constitutes a material change will be determined at our sole discretion. By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms.</p>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-bell me-2"></i>Notification</h5>
                            <p>We will notify you of any changes to these terms via email or through a notice on our website. It is your responsibility to review these terms periodically.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 12: Contact Information -->
                <div class="terms-section" id="contact">
                    <h2 class="section-title">
                        <i class="fas fa-envelope"></i>12. Contact Information
                    </h2>
                    <div class="terms-text">
                        <p>If you have any questions about these Terms of Service, please contact us:</p>
                    </div>
                    
                    <div class="contact-info-box">
                        <h4><i class="fas fa-headset me-2"></i>Get in Touch</h4>
                        <p><i class="fas fa-envelope me-2"></i>Email: legal@bandbazabarat.com</p>
                        <p><i class="fas fa-phone me-2"></i>Phone: +91 9234410536</p>
                        <p><i class="fas fa-map-marker-alt me-2"></i>Address: MAA TARA APPARTMENT FITTJEE BUILDING SHOP NO-2, KOLAKUSMA SARAIDHELA, DHANBAD, JHARKHAND, INDIA</p>
                        <a href="contact.html" class="btn btn-light mt-3">
                            <i class="fas fa-comments me-2"></i>Contact Support
                        </a>
                    </div>
                </div>

                <!-- Agreement Section -->
                <div class="highlight-box text-center">
                    <h5><i class="fas fa-handshake me-2"></i>Agreement</h5>
                    <p>By using BandBazaBarat, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service. These terms constitute the entire agreement between you and BandBazaBarat regarding the use of our Service.</p>
                    <p class="mb-0"><strong>Last Updated:</strong> January 15, 2025</p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for table of contents links
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

            // Highlight current section in table of contents
            window.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('.terms-section');
                const tocLinks = document.querySelectorAll('.toc-list a');
                
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (window.pageYOffset >= sectionTop - 200) {
                        current = section.getAttribute('id');
                    }
                });

                tocLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.add('active');
                    }
                });
            });

            // Add active class styling
            const style = document.createElement('style');
            style.textContent = `
                .toc-list a.active {
                    color: var(--maroon) !important;
                    font-weight: 600;
                }
                .toc-list a.active::before {
                    color: var(--maroon) !important;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection
