@extends('layouts.app')
@section('content')
    
    <style>
        .privacy-container {
            background: linear-gradient(135deg, var(--light-bg) 0%, #FFF5F0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .privacy-hero-section {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .privacy-hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFFFFF' fill-opacity='0.1'%3E%3Cpath d='M30 10 L40 25 L55 25 L45 40 L55 55 L30 45 L5 55 L15 40 L5 25 L20 25 Z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.3;
            animation: float 12s ease-in-out infinite;
        }
        
        .privacy-hero-section h1 {
            position: relative;
            z-index: 2;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }
        
        .privacy-hero-section p {
            position: relative;
            z-index: 2;
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .privacy-content {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 3rem;
            margin-top: -2rem;
            position: relative;
            z-index: 10;
        }
        
        .privacy-section {
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .privacy-section:last-child {
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
        
        .privacy-text {
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
        
        .privacy-list {
            list-style: none;
            padding: 0;
        }
        
        .privacy-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
            padding-left: 2rem;
        }
        
        .privacy-list li:last-child {
            border-bottom: none;
        }
        
        .privacy-list li::before {
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
            content: '🔒';
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
        
        .data-table {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .data-table h4 {
            color: var(--maroon);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            background: var(--maroon);
            color: var(--white);
            border: none;
            padding: 1rem;
        }
        
        .table td {
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .table tr:hover {
            background: rgba(255, 179, 71, 0.1);
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
        
        .cookie-policy {
            background: linear-gradient(135deg, #e8f4fd, #f0f8ff);
            border: 2px solid #007bff;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .cookie-policy h4 {
            color: #007bff;
            margin-bottom: 1rem;
        }
        
        .cookie-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .cookie-type {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: 1px solid #e9ecef;
        }
        
        .cookie-type h5 {
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .privacy-hero-section h1 {
                font-size: 2.5rem;
            }
            
            .privacy-content {
                margin: 0 1rem;
                margin-top: -1rem;
                padding: 2rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .cookie-types {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

    <!-- Privacy Hero Section -->
    <section class="privacy-hero-section">
        <div class="container">
            <h1><i class="fas fa-shield-alt me-3"></i>Privacy Policy</h1>
            <p class="lead">Your privacy is our priority. Learn how we protect your personal information.</p>
        </div>
    </section>

    <!-- Privacy Content -->
    <div class="privacy-container">
        <div class="container">
            <div class="privacy-content">
                <!-- Table of Contents -->
                <div class="table-of-contents">
                    <h3><i class="fas fa-list me-2"></i>Table of Contents</h3>
                    <ul class="toc-list">
                        <li><a href="#introduction">1. Introduction</a></li>
                        <li><a href="#information-collection">2. Information We Collect</a></li>
                        <li><a href="#how-we-use">3. How We Use Your Information</a></li>
                        <li><a href="#information-sharing">4. Information Sharing</a></li>
                        <li><a href="#data-security">5. Data Security</a></li>
                        <li><a href="#your-rights">6. Your Privacy Rights</a></li>
                        <li><a href="#cookies">7. Cookies & Tracking</a></li>
                        <li><a href="#third-party">8. Third-Party Services</a></li>
                        <li><a href="#children">9. Children's Privacy</a></li>
                        <li><a href="#changes">10. Changes to Privacy Policy</a></li>
                        <li><a href="#contact">11. Contact Us</a></li>
                    </ul>
                </div>

                <!-- Last Updated -->
                <div class="highlight-box">
                    <h5><i class="fas fa-calendar-alt me-2"></i>Last Updated: January 15, 2025</h5>
                    <p>This Privacy Policy describes how BandBazaBarat collects, uses, and protects your personal information when you use our matrimonial platform.</p>
                </div>

                <!-- Section 1: Introduction -->
                <div class="privacy-section" id="introduction">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i>1. Introduction
                    </h2>
                    <div class="privacy-text">
                        <p>At BandBazaBarat, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our Hindu matrimonial platform.</p>
                        
                        <p>By using our services, you agree to the collection and use of information in accordance with this policy. We respect your privacy and are committed to protecting it through our compliance with this policy.</p>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Important Note</h5>
                            <p>This privacy policy applies to all users of BandBazaBarat.com and related services. Please read this policy carefully to understand our practices regarding your personal information.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Information We Collect -->
                <div class="privacy-section" id="information-collection">
                    <h2 class="section-title">
                        <i class="fas fa-database"></i>2. Information We Collect
                    </h2>
                    <div class="privacy-text">
                        <p>We collect several types of information from and about users of our platform, including:</p>
                        
                        <div class="data-table">
                            <h4><i class="fas fa-table me-2"></i>Types of Information We Collect</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Information Type</th>
                                            <th>Examples</th>
                                            <th>Purpose</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Personal Information</strong></td>
                                            <td>Name, email, phone number, date of birth, gender</td>
                                            <td>Account creation, profile management, communication</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Profile Information</strong></td>
                                            <td>Education, occupation, family background, preferences</td>
                                            <td>Matching algorithms, profile display</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Cultural Information</strong></td>
                                            <td>Caste, sub-caste, gotra, rashi, nakshatra</td>
                                            <td>Cultural matching, horoscope compatibility</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Photos & Media</strong></td>
                                            <td>Profile photos, family photos</td>
                                            <td>Profile display, verification</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Communication Data</strong></td>
                                            <td>Messages, interest requests, chat history</td>
                                            <td>Communication between users</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Technical Data</strong></td>
                                            <td>IP address, device information, usage patterns</td>
                                            <td>Security, analytics, service improvement</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="highlight-box">
                            <h5><i class="fas fa-camera me-2"></i>Photo Protection</h5>
                            <ul class="privacy-list">
                                <li>All photos are protected with watermarks</li>
                                <li>Download and screenshot prevention measures</li>
                                <li>Photo usage is strictly controlled</li>
                                <li>Users can remove photos anytime</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section 3: How We Use Your Information -->
                <div class="privacy-section" id="how-we-use">
                    <h2 class="section-title">
                        <i class="fas fa-cogs"></i>3. How We Use Your Information
                    </h2>
                    <div class="privacy-text">
                        <p>We use the information we collect for various purposes, including:</p>
                        
                        <ul class="privacy-list">
                            <li><strong>Account Management:</strong> Creating and managing your account, verifying your identity</li>
                            <li><strong>Profile Matching:</strong> Using algorithms to suggest compatible matches</li>
                            <li><strong>Communication:</strong> Enabling communication between interested users</li>
                            <li><strong>Customer Support:</strong> Providing assistance and resolving issues</li>
                            <li><strong>Service Improvement:</strong> Analyzing usage patterns to improve our platform</li>
                            <li><strong>Security:</strong> Protecting against fraud and unauthorized access</li>
                            <li><strong>Legal Compliance:</strong> Meeting legal obligations and enforcing our terms</li>
                        </ul>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-heart me-2"></i>Cultural Sensitivity</h5>
                            <p>We understand the cultural importance of privacy in Hindu matrimony. Your information is handled with the utmost respect for traditional values and family privacy.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Information Sharing -->
                <div class="privacy-section" id="information-sharing">
                    <h2 class="section-title">
                        <i class="fas fa-share-alt"></i>4. Information Sharing
                    </h2>
                    <div class="privacy-text">
                        <p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
                        
                        <ul class="privacy-list">
                            <li><strong>With Your Consent:</strong> When you explicitly agree to share information</li>
                            <li><strong>Between Users:</strong> When you choose to share information with other users</li>
                            <li><strong>Service Providers:</strong> With trusted partners who help us operate our platform</li>
                            <li><strong>Legal Requirements:</strong> When required by law or to protect our rights</li>
                            <li><strong>Safety & Security:</strong> To prevent fraud or protect user safety</li>
                        </ul>
                        
                        <div class="highlight-box">
                            <h5><i class="fas fa-lock me-2"></i>Data Protection Measures</h5>
                            <ul class="privacy-list">
                                <li>All data transfers are encrypted</li>
                                <li>Access is restricted to authorized personnel only</li>
                                <li>Regular security audits and updates</li>
                                <li>Compliance with data protection regulations</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Data Security -->
                <div class="privacy-section" id="data-security">
                    <h2 class="section-title">
                        <i class="fas fa-shield-alt"></i>5. Data Security
                    </h2>
                    <div class="privacy-text">
                        <p>We implement comprehensive security measures to protect your personal information:</p>
                        
                        <ul class="privacy-list">
                            <li><strong>Encryption:</strong> All data is encrypted using industry-standard protocols</li>
                            <li><strong>Access Controls:</strong> Strict access controls and authentication measures</li>
                            <li><strong>Regular Audits:</strong> Regular security assessments and vulnerability testing</li>
                            <li><strong>Data Backup:</strong> Secure backup systems with encryption</li>
                            <li><strong>Employee Training:</strong> Regular privacy and security training for staff</li>
                            <li><strong>Incident Response:</strong> Procedures for handling security incidents</li>
                        </ul>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Security Reminder</h5>
                            <p>While we implement strong security measures, no method of transmission over the internet is 100% secure. We encourage users to also take steps to protect their own information.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 6: Your Privacy Rights -->
                <div class="privacy-section" id="your-rights">
                    <h2 class="section-title">
                        <i class="fas fa-user-check"></i>6. Your Privacy Rights
                    </h2>
                    <div class="privacy-text">
                        <p>You have several rights regarding your personal information:</p>
                        
                        <ul class="privacy-list">
                            <li><strong>Access:</strong> Request access to your personal information</li>
                            <li><strong>Correction:</strong> Request correction of inaccurate information</li>
                            <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                            <li><strong>Portability:</strong> Request a copy of your data in a portable format</li>
                            <li><strong>Restriction:</strong> Request restriction of processing</li>
                            <li><strong>Objection:</strong> Object to certain types of processing</li>
                            <li><strong>Withdrawal:</strong> Withdraw consent at any time</li>
                        </ul>
                        
                        <div class="highlight-box">
                            <h5><i class="fas fa-cog me-2"></i>Account Controls</h5>
                            <ul class="privacy-list">
                                <li>Control who can view your profile</li>
                                <li>Manage photo visibility settings</li>
                                <li>Choose what information to display</li>
                                <li>Block or report other users</li>
                                <li>Deactivate or delete your account</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section 7: Cookies & Tracking -->
                <div class="privacy-section" id="cookies">
                    <h2 class="section-title">
                        <i class="fas fa-cookie-bite"></i>7. Cookies & Tracking
                    </h2>
                    <div class="privacy-text">
                        <p>We use cookies and similar technologies to enhance your experience on our platform:</p>
                        
                        <div class="cookie-policy">
                            <h4><i class="fas fa-info-circle me-2"></i>Cookie Policy</h4>
                            <p>Cookies help us provide a better user experience and improve our services.</p>
                            
                            <div class="cookie-types">
                                <div class="cookie-type">
                                    <h5><i class="fas fa-user me-2"></i>Essential Cookies</h5>
                                    <p>Required for basic platform functionality, login, and security.</p>
                                </div>
                                <div class="cookie-type">
                                    <h5><i class="fas fa-chart-line me-2"></i>Analytics Cookies</h5>
                                    <p>Help us understand how users interact with our platform.</p>
                                </div>
                                <div class="cookie-type">
                                    <h5><i class="fas fa-bullseye me-2"></i>Preference Cookies</h5>
                                    <p>Remember your preferences and settings.</p>
                                </div>
                                <div class="cookie-type">
                                    <h5><i class="fas fa-ad me-2"></i>Marketing Cookies</h5>
                                    <p>Used for relevant advertising and content personalization.</p>
                                </div>
                            </div>
                        </div>
                        
                        <p>You can control cookie settings through your browser preferences. However, disabling certain cookies may affect platform functionality.</p>
                    </div>
                </div>

                <!-- Section 8: Third-Party Services -->
                <div class="privacy-section" id="third-party">
                    <h2 class="section-title">
                        <i class="fas fa-external-link-alt"></i>8. Third-Party Services
                    </h2>
                    <div class="privacy-text">
                        <p>Our platform may integrate with third-party services for specific functionalities:</p>
                        
                        <ul class="privacy-list">
                            <li><strong>Payment Processors:</strong> Secure payment processing</li>
                            <li><strong>Analytics Services:</strong> Platform usage analysis</li>
                            <li><strong>Email Services:</strong> Communication delivery</li>
                            <li><strong>Cloud Storage:</strong> Secure data storage</li>
                            <li><strong>Security Services:</strong> Fraud prevention and security</li>
                        </ul>
                        
                        <p>These third-party services have their own privacy policies. We recommend reviewing their policies to understand how they handle your information.</p>
                    </div>
                </div>

                <!-- Section 9: Children's Privacy -->
                <div class="privacy-section" id="children">
                    <h2 class="section-title">
                        <i class="fas fa-baby"></i>9. Children's Privacy
                    </h2>
                    <div class="privacy-text">
                        <p>BandBazaBarat is designed for adults aged 18 and above. We do not knowingly collect personal information from children under 18.</p>
                        
                        <div class="important-note">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Age Requirement</h5>
                            <p>If you are under 18, please do not use our platform. If we become aware that we have collected information from a child under 18, we will take steps to delete such information.</p>
                        </div>
                    </div>
                </div>

                <!-- Section 10: Changes to Privacy Policy -->
                <div class="privacy-section" id="changes">
                    <h2 class="section-title">
                        <i class="fas fa-edit"></i>10. Changes to Privacy Policy
                    </h2>
                    <div class="privacy-text">
                        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons.</p>
                        
                        <ul class="privacy-list">
                            <li>We will notify you of any material changes via email</li>
                            <li>Updates will be posted on this page with a new "Last Updated" date</li>
                            <li>Continued use of our platform constitutes acceptance of changes</li>
                            <li>You can review the current policy anytime on this page</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 11: Contact Us -->
                <div class="privacy-section" id="contact">
                    <h2 class="section-title">
                        <i class="fas fa-envelope"></i>11. Contact Us
                    </h2>
                    <div class="privacy-text">
                        <p>If you have any questions about this Privacy Policy or our privacy practices, please contact us:</p>
                    </div>
                    
                    <div class="contact-info-box">
                        <h4><i class="fas fa-headset me-2"></i>Privacy Team Contact</h4>
                        <p><i class="fas fa-envelope me-2"></i>Email: privacy@bandbazabarat.com</p>
                        <p><i class="fas fa-phone me-2"></i>Phone: +91 9234410536</p>
                        <p><i class="fas fa-map-marker-alt me-2"></i>Address: MAA TARA APPARTMENT FITTJEE BUILDING SHOP NO-2, KOLAKUSMA SARAIDHELA, DHANBAD, JHARKHAND, INDIA</p>
                        <a href="contact.html" class="btn btn-light mt-3">
                            <i class="fas fa-comments me-2"></i>Contact Support
                        </a>
                    </div>
                </div>

                <!-- Agreement Section -->
                <div class="highlight-box text-center">
                    <h5><i class="fas fa-handshake me-2"></i>Your Privacy Matters</h5>
                    <p>At BandBazaBarat, we are committed to protecting your privacy and ensuring a secure, trustworthy environment for finding your perfect match. Your trust is our most valuable asset.</p>
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
                const sections = document.querySelectorAll('.privacy-section');
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
