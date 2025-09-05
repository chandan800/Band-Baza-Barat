@extends('layouts.app')
@section('content')
    
    
    <style>
        .about-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .about-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .about-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 5 L60 35 L90 35 L68 55 L78 85 L50 65 L22 85 L32 55 L10 35 L40 35 Z' fill='%23FFFFFF' fill-opacity='0.1'/%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }
        
        .about-content {
            position: relative;
            z-index: 1;
        }
        
        .section-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3rem 2rem;
            margin-bottom: 2rem;
        }
        
        .mission-section {
            background: linear-gradient(135deg, rgba(128, 0, 0, 0.05), rgba(255, 179, 71, 0.05));
            border-left: 5px solid var(--maroon);
        }
        
        .vision-section {
            background: linear-gradient(135deg, rgba(227, 99, 135, 0.05), rgba(255, 179, 71, 0.05));
            border-left: 5px solid var(--deep-pink);
        }
        
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .value-item {
            text-align: center;
            padding: 2rem;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .value-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .value-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--white);
        }
        
        .value-title {
            color: var(--maroon);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .timeline {
            position: relative;
            padding: 2rem 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: var(--golden-orange);
            border-radius: 2px;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 3rem;
            width: 45%;
        }
        
        .timeline-item:nth-child(odd) {
            left: 0;
            text-align: right;
        }
        
        .timeline-item:nth-child(even) {
            left: 55%;
            text-align: left;
        }
        
        .timeline-content {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            position: relative;
        }
        
        .timeline-content::before {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border: 15px solid transparent;
        }
        
        .timeline-item:nth-child(odd) .timeline-content::before {
            right: -30px;
            border-left-color: var(--white);
        }
        
        .timeline-item:nth-child(even) .timeline-content::before {
            left: -30px;
            border-right-color: var(--white);
        }
        
        .timeline-year {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: var(--maroon);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 0 0 4px var(--white), 0 0 0 8px var(--golden-orange);
        }
        
        .timeline-item:nth-child(odd) .timeline-year {
            right: -85px;
        }
        
        .timeline-item:nth-child(even) .timeline-year {
            left: -85px;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .team-member {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
        }
        
        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .member-photo {
            height: 250px;
            background: linear-gradient(135deg, var(--soft-peach), var(--golden-orange));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--white);
            opacity: 0.7;
        }
        
        .member-info {
            padding: 2rem;
        }
        
        .member-name {
            color: var(--maroon);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        
        .member-role {
            color: var(--deep-pink);
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        .member-description {
            color: var(--muted);
            font-size: 0.9rem;
        }
        
        .stats-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3rem 2rem;
            margin: 3rem 0;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }
        
        .stat-item {
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--maroon);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--muted);
            font-weight: 500;
        }
        
        .cta-section {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 4rem 2rem;
            border-radius: var(--border-radius);
            text-align: center;
            margin: 3rem 0;
        }
        
        @media (max-width: 768px) {
            .about-container {
                padding: 1rem;
            }
            
            .about-header {
                padding: 2rem 0;
            }
            
            .section-card {
                padding: 2rem 1rem;
            }
            
            .timeline::before {
                left: 30px;
            }
            
            .timeline-item {
                width: 100%;
                left: 0 !important;
                text-align: left !important;
                padding-left: 80px;
            }
            
            .timeline-year {
                left: 0 !important;
                right: auto !important;
            }
            
            .timeline-content::before {
                left: -30px !important;
                right: auto !important;
                border-right-color: var(--white) !important;
                border-left-color: transparent !important;
            }
        }
    </style>

    <!-- About Container -->
    <div class="about-container">
        <!-- Header Section -->
        <div class="about-header">
            <div class="container">
                <div class="about-content">
                    <h1><i class="fas fa-info-circle me-3"></i>About BandBazaBarat</h1>
                    <p class="lead">India's Most Trusted Hindu Matrimonial Platform</p>
                    <p class="mb-0">Connecting hearts and families since 2009 with tradition, technology, and trust</p>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Mission Section -->
            <div class="section-card mission-section">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="section-title">Our Mission</h2>
                        <p class="lead">To help Hindu families find perfect life partners while preserving cultural values and traditions.</p>
                        <p>BandBazaBarat was born from the belief that marriage is not just the union of two individuals, but the coming together of two families, their values, traditions, and dreams. Our mission is to provide a trusted platform where Hindu families can find compatible matches based on cultural compatibility, shared values, and mutual respect.</p>
                        <p>We understand the importance of maintaining religious and cultural traditions in Hindu marriages while embracing modern technology to make the process more efficient and accessible.</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="value-icon" style="width: 150px; height: 150px; font-size: 3rem;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vision Section -->
            <div class="section-card vision-section">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-center">
                        <div class="value-icon" style="width: 150px; height: 150px; font-size: 3rem; background: linear-gradient(135deg, var(--deep-pink), var(--golden-orange));">
                            <i class="fas fa-telescope"></i>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="section-title">Our Vision</h2>
                        <p class="lead">To become the world's most respected platform for Hindu matrimonial services.</p>
                        <p>We envision a future where every Hindu individual, regardless of their location or background, can find their ideal life partner through our platform. Our vision extends beyond just matchmaking - we aim to strengthen the institution of marriage in Hindu culture by promoting values of compatibility, understanding, and mutual respect.</p>
                        <p>We strive to continuously innovate while staying rooted in traditional values, ensuring that the sacred bond of marriage is formed on the strongest foundations of cultural harmony and personal compatibility.</p>
                    </div>
                </div>
            </div>

            <!-- Values Section -->
            <div class="section-card">
                <h2 class="section-title text-center">Our Core Values</h2>
                <p class="text-center text-muted mb-4">The principles that guide everything we do</p>
                
                <div class="values-grid">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="value-title">Trust & Safety</h4>
                        <p>We prioritize the safety and privacy of our members with verified profiles and secure communication.</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-om"></i>
                        </div>
                        <h4 class="value-title">Cultural Heritage</h4>
                        <p>Preserving and celebrating Hindu traditions, customs, and cultural values in the matrimonial journey.</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4 class="value-title">Integrity</h4>
                        <p>Maintaining honesty, transparency, and ethical practices in all our interactions and services.</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="value-title">Family Values</h4>
                        <p>Understanding that marriage is a union of families and respecting the importance of family approval.</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4 class="value-title">Innovation</h4>
                        <p>Continuously improving our platform with technology while maintaining traditional matchmaking wisdom.</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="value-title">Compassion</h4>
                        <p>Treating every member's journey with empathy, understanding, and personalized care.</p>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="stats-section">
                <h2 class="section-title text-center">Our Journey in Numbers</h2>
                <p class="text-center text-muted mb-4">Milestones that showcase our commitment to successful marriages</p>
                
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">2,50,000+</div>
                        <div class="stat-label">Successful Marriages</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5,00,000+</div>
                        <div class="stat-label">Active Members</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Cities Covered</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Years of Experience</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Customer Satisfaction</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Customer Support</div>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <!-- <div class="section-card">
                <h2 class="section-title text-center">Our Journey</h2>
                <p class="text-center text-muted mb-4">Key milestones in BandBazaBarat's growth story</p>
                
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Founded BandBazaBarat</h4>
                            <p>Started with a vision to create India's most trusted Hindu matrimonial platform, focusing on cultural compatibility and family values.</p>
                        </div>
                        <div class="timeline-year">2009</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Mobile App Launch</h4>
                            <p>Launched our mobile application to make matrimonial search more accessible and convenient for families across India.</p>
                        </div>
                        <div class="timeline-year">2012</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>100,000 Successful Marriages</h4>
                            <p>Celebrated our first major milestone of facilitating 100,000 successful marriages across various Hindu communities.</p>
                        </div>
                        <div class="timeline-year">2015</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Advanced Matching Algorithm</h4>
                            <p>Introduced AI-powered compatibility matching with horoscope compatibility and cultural preference matching.</p>
                        </div>
                        <div class="timeline-year">2018</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Global Expansion</h4>
                            <p>Extended our services to Hindu families worldwide, including USA, UK, Canada, Australia, and Middle East countries.</p>
                        </div>
                        <div class="timeline-year">2020</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>2,50,000 Marriages Milestone</h4>
                            <p>Proudly achieved 2,50,000 successful marriages, establishing ourselves as India's leading Hindu matrimonial platform.</p>
                        </div>
                        <div class="timeline-year">2024</div>
                    </div>
                </div>
            </div> -->
            <div class="section-card">
                <h2 class="section-title text-center">Our Journey</h2>
                <p class="text-center text-muted mb-4">Key milestones in BandBazaBarat's growth story</p>
                
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Founded BandBazaBarat</h4>
                            <p>Started with a vision to create India's most trusted Hindu matrimonial platform, focusing on cultural compatibility and family values.</p>
                        </div>
                        <div class="timeline-year">2009</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>100,000 Successful Marriages</h4>
                            <p>Celebrated our first major milestone of facilitating 1,00,000 successful marriages across various Hindu communities.</p>
                        </div>
                        <div class="timeline-year">2012</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Advanced Matching Algorithm</h4>
                            <p>Introduced AI-powered compatibility matching, including horoscope compatibility and cultural preference analysis.</p>
                        </div>
                        <div class="timeline-year">2015</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Global Expansion</h4>
                            <p>Extended our services to Hindu families worldwide, including USA, UK, Canada, Australia, and Middle East countries.</p>
                        </div>
                        <div class="timeline-year">2018</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>2,50,000 Marriages Milestone</h4>
                            <p>Proudly achieved 2,50,000 successful marriages, establishing ourselves as India's leading Hindu matrimonial platform.</p>
                        </div>
                        <div class="timeline-year">2020</div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Premium Community Services</h4>
                            <p>Launched exclusive community-based matchmaking services, focusing on traditions, rituals, and regional preferences.</p>
                        </div>
                        <div class="timeline-year">2023</div>
                    </div>
            
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>500,000 Success Stories</h4>
                            <p>Reached the incredible milestone of 5,00,000 successful marriages, uniting families across the globe.</p>
                        </div>
                        <div class="timeline-year">2025</div>
                    </div>
                </div>
            </div>
            
            <!-- Team Section -->
            <div class="section-card">
                <h2 class="section-title text-center">Our Leadership Team</h2>
                <p class="text-center text-muted mb-4">Meet the people dedicated to your matrimonial success</p>
                
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-photo">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">Rajesh Sharma</h4>
                            <p class="member-role">Founder & CEO</p>
                            <p class="member-description">15+ years in matrimonial industry. Passionate about preserving Hindu cultural values while embracing technology.</p>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-photo">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">Dr. Priya Patel</h4>
                            <p class="member-role">Head of Matchmaking</p>
                            <p class="member-description">PhD in Psychology, specializing in relationship compatibility and family counseling for over 12 years.</p>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-photo">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">Arjun Mehta</h4>
                            <p class="member-role">Chief Technology Officer</p>
                            <p class="member-description">Tech expert with 10+ years in developing secure, scalable platforms for sensitive personal data.</p>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-photo">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">Kavya Reddy</h4>
                            <p class="member-role">Head of Customer Success</p>
                            <p class="member-description">Dedicated to ensuring every member has a positive experience and finds their perfect life partner.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action Section -->
            <div class="cta-section">
                <h2>Ready to Find Your Perfect Match?</h2>
                <p class="lead">Join millions of Hindu families who trust BandBazaBarat for finding their ideal life partner.</p>
                <div class="mt-4">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-user-plus me-2"></i>Create Profile
                    </a>
                    <a href="{{ route('search') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-search me-2"></i>Search Profiles
                    </a>
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
            // Animate numbers on scroll
            const animateNumbers = () => {
                const statNumbers = document.querySelectorAll('.stat-number');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const target = entry.target;
                            const finalNumber = target.textContent;
                            const isPercentage = finalNumber.includes('%');
                            const isPlus = finalNumber.includes('+');
                            const cleanNumber = parseInt(finalNumber.replace(/[^\d]/g, ''));
                            
                            let current = 0;
                            const increment = cleanNumber / 100;
                            const timer = setInterval(() => {
                                current += increment;
                                if (current >= cleanNumber) {
                                    clearInterval(timer);
                                    target.textContent = finalNumber;
                                } else {
                                    let displayNumber = Math.floor(current);
                                    if (displayNumber >= 1000) {
                                        displayNumber = Math.floor(displayNumber / 1000) + ',' + String(displayNumber % 1000).padStart(3, '0');
                                    }
                                    target.textContent = displayNumber + (isPercentage ? '%' : '') + (isPlus ? '+' : '');
                                }
                            }, 20);
                            
                            observer.unobserve(target);
                        }
                    });
                });
                
                statNumbers.forEach(el => observer.observe(el));
            };
            
            // Animate timeline items
            const animateTimeline = () => {
                const timelineItems = document.querySelectorAll('.timeline-item');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, { threshold: 0.1 });
                
                timelineItems.forEach(item => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(50px)';
                    item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    observer.observe(item);
                });
            };
            
            // Animate value items
            const animateValues = () => {
                const valueItems = document.querySelectorAll('.value-item');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, { threshold: 0.1 });
                
                valueItems.forEach((item, index) => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(30px)';
                    item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                    observer.observe(item);
                });
            };
            
            // Initialize animations
            animateNumbers();
            animateTimeline();
            animateValues();
        });
    </script>
@endsection
