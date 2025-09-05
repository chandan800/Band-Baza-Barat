@extends('layouts.app')
@section('content')
    
    <style>
        .stories-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .stories-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .stories-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 5 L60 35 L90 35 L68 55 L78 85 L50 65 L22 85 L32 55 L10 35 L40 35 Z' fill='%23FFFFFF' fill-opacity='0.1'/%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }
        
        .stories-content {
            position: relative;
            z-index: 1;
        }
        
        .filter-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }
        
        .filter-btn {
            background: var(--light-bg);
            border: 2px solid #e0e0e0;
            color: var(--text-dark);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: var(--maroon);
            border-color: var(--maroon);
            color: var(--white);
        }
        
        .stories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .story-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .story-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .story-image {
            position: relative;
            height: 250px;
            background: linear-gradient(135deg, var(--soft-peach), var(--golden-orange));
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .story-placeholder {
            font-size: 3rem;
            color: var(--white);
            opacity: 0.7;
        }
        
        .story-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.3));
        }
        
        .story-date {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--white);
            color: var(--maroon);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .story-content {
            padding: 2rem;
        }
        
        .couple-names {
            color: var(--maroon);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-family: 'Playfair Display', serif;
        }
        
        .couple-location {
            color: var(--muted);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .story-text {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .story-stats {
            display: flex;
            justify-content: between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
        }
        
        .meeting-time {
            color: var(--muted);
            font-size: 0.9rem;
        }
        
        .caste-info {
            background: var(--light-bg);
            color: var(--maroon);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .featured-story {
            border: 3px solid var(--accent-gold);
        }
        
        .featured-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--accent-gold);
            color: var(--text-dark);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .submit-story-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3rem;
            text-align: center;
            margin: 3rem 0;
        }
        
        .submit-story-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: var(--white);
        }
        
        .stats-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin: 2rem 0;
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
        
        @media (max-width: 768px) {
            .stories-container {
                padding: 1rem;
            }
            
            .stories-header {
                padding: 2rem 0;
            }
            
            .filter-section {
                padding: 1rem;
            }
            
            .filter-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .stories-grid {
                grid-template-columns: 1fr;
            }
            
            .story-content {
                padding: 1.5rem;
            }
            
            .submit-story-section {
                padding: 2rem 1rem;
            }
        }
    </style>
    <!-- Header -->


    <!-- Success Stories Container -->
    <div class="stories-container">
        <!-- Header Section -->
        <div class="stories-header">
            <div class="container">
                <div class="stories-content">
                    <h1><i class="fas fa-heart me-3"></i>Success Stories</h1>
                    <p class="lead">Real love stories of couples who found their perfect match through BandBazaBarat</p>
                    <p class="mb-0">Inspiring journeys of love, tradition, and happily ever after</p>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Statistics Section -->
            <div class="stats-section">
                <h3 class="text-center mb-4">Celebrating Love Across India</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">2,50,000+</div>
                        <div class="stat-label">Happy Marriages</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Cities Covered</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Years of Trust</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Success Rate</div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <h5 class="text-center mb-3">Filter Success Stories</h5>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All Stories</button>
                    <button class="filter-btn" data-filter="recent">Recent Weddings</button>
                    <button class="filter-btn" data-filter="brahmin">Brahmin</button>
                    <button class="filter-btn" data-filter="kshatriya">Kshatriya</button>
                    <button class="filter-btn" data-filter="vaishya">Vaishya</button>
                    <button class="filter-btn" data-filter="mumbai">Mumbai</button>
                    <button class="filter-btn" data-filter="bangalore">Bangalore</button>
                    <button class="filter-btn" data-filter="delhi">Delhi</button>
                    <button class="filter-btn" data-filter="featured">Featured Stories</button>
                </div>
            </div>

            <!-- Success Stories Grid -->
            <div class="stories-grid" id="storiesGrid">
                <!-- Featured Story -->
                <div class="story-card featured-story" data-category="featured brahmin mumbai recent">
                    <div class="story-image">
                        <div class="story-placeholder">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="story-overlay"></div>
                        <div class="featured-badge">Featured</div>
                        <div class="story-date">Dec 2024</div>
                    </div>
                    <div class="story-content">
                        <h4 class="couple-names">Radhika & Arjun</h4>
                        <div class="couple-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Mumbai, Maharashtra</span>
                        </div>
                        <p class="story-text">
                            "We both were working professionals looking for someone who understood our career ambitions and family values. BandBazaBarat's matching algorithm connected us based on our similar backgrounds and interests. Our first conversation lasted 3 hours, and we knew we were meant for each other. Six months later, we had our dream Hindu wedding with both families' blessings."
                        </p>
                        <div class="story-stats">
                            <span class="meeting-time">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Met in March 2024
                            </span>
                            <span class="caste-info">Brahmin - Iyer</span>
                        </div>
                    </div>
                </div>

                <!-- Story 2 -->
                <div class="story-card" data-category="kshatriya bangalore recent">
                    <div class="story-image">
                        <div class="story-placeholder">
                            <i class="fas fa-rings-wedding"></i>
                        </div>
                        <div class="story-overlay"></div>
                        <div class="story-date">Nov 2024</div>
                    </div>
                    <div class="story-content">
                        <h4 class="couple-names">Priya & Vikram</h4>
                        <div class="couple-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bangalore, Karnataka</span>
                        </div>
                        <p class="story-text">
                            "After years of searching, we found each other through BandBazaBarat. What impressed us most was how the platform respected our cultural preferences while helping us connect. Vikram's profile stood out because of his genuine approach and family values. We're grateful for this wonderful platform that brought us together."
                        </p>
                        <div class="story-stats">
                            <span class="meeting-time">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Met in February 2024
                            </span>
                            <span class="caste-info">Kshatriya - Rajput</span>
                        </div>
                    </div>
                </div>

                <!-- Story 3 -->
                <div class="story-card" data-category="vaishya delhi">
                    <div class="story-image">
                        <div class="story-placeholder">
                            <i class="fas fa-heart-circle"></i>
                        </div>
                        <div class="story-overlay"></div>
                        <div class="story-date">Oct 2024</div>
                    </div>
                    <div class="story-content">
                        <h4 class="couple-names">Kavya & Rohit</h4>
                        <div class="couple-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Delhi, India</span>
                        </div>
                        <p class="story-text">
                            "Our families had been looking for suitable matches for us for over a year. BandBazaBarat's detailed profiles and compatibility matching helped us find each other quickly. We appreciated the privacy features and the genuine people on this platform. Our wedding was a beautiful celebration of two families coming together."
                        </p>
                        <div class="story-stats">
                            <span class="meeting-time">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Met in January 2024
                            </span>
                            <span class="caste-info">Vaishya - Agarwal</span>
                        </div>
                    </div>
                </div>

                <!-- Story 4 -->
                <div class="story-card" data-category="brahmin chennai">
                    <div class="story-image">
                        <div class="story-placeholder">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div class="story-overlay"></div>
                        <div class="story-date">Sep 2024</div>
                    </div>
                    <div class="story-content">
                        <h4 class="couple-names">Meera & Aditya</h4>
                        <div class="couple-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Chennai, Tamil Nadu</span>
                        </div>
                        <p class="story-text">
                            "Being traditional South Indian families, finding the right match with proper horoscope compatibility was crucial. BandBazaBarat's horoscope matching feature gave us confidence. We connected over our shared love for classical music and similar family backgrounds. Our wedding was blessed by both families and astrologers."
                        </p>
                        <div class="story-stats">
                            <span class="meeting-time">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Met in December 2023
                            </span>
                            <span class="caste-info">Brahmin - Iyengar</span>
                        </div>
                    </div>
                </div>

                <!-- Story 5 -->
                <div class="story-card" data-category="kshatriya pune">
                    <div class="story-image">
                        <div class="story-placeholder">
                            <i class="fas fa-lotus"></i>
                        </div>
                        <div class="story-overlay"></div>
                        <div class="story-date">Aug 2024</div>
                    </div>
                    <div class="story-content">
                        <h4 class="couple-names">Ananya & Karan</h4>
                        <div class="couple-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Pune, Maharashtra</span>
                        </div>
                        <p class="story-text">
                            "We were both working in IT and looking for someone who understood our professional commitments. BandBazaBarat connected us based on our career goals and cultural values. Our conversations flowed naturally, and we found we had so much in common. Thank you BandBazaBarat for helping us find our perfect match."
                        </p>
                        <div class="story-stats">
                            <span class="meeting-time">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Met in November 2023
                            </span>
                            <span class="caste-info">Kshatriya - Maratha</span>
                        </div>
                    </div>
                </div>

                <!-- Story 6 -->
                <div class="story-card" data-category="vaishya ahmedabad">
                    <div class="story-image">
                        <div class="story-placeholder">
                            <i class="fas fa-dove"></i>
                        </div>
                        <div class="story-overlay"></div>
                        <div class="story-date">Jul 2024</div>
                    </div>
                    <div class="story-content">
                        <h4 class="couple-names">Riya & Nikhil</h4>
                        <div class="couple-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Ahmedabad, Gujarat</span>
                        </div>
                        <p class="story-text">
                            "Our families found each other through BandBazaBarat's platform. What we loved most was the detailed family background information and the genuine profiles. Both our families felt comfortable throughout the process. We had a grand Gujarati wedding with all the traditional ceremonies. Grateful to BandBazaBarat for making it possible."
                        </p>
                        <div class="story-stats">
                            <span class="meeting-time">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Met in October 2023
                            </span>
                            <span class="caste-info">Vaishya - Patel</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-4">
                <button class="btn btn-outline-primary" id="loadMoreBtn">
                    <i class="fas fa-plus me-2"></i>Load More Stories
                </button>
            </div>

            <!-- Submit Your Story Section -->
            <div class="submit-story-section">
                <div class="submit-story-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <h3>Share Your Success Story</h3>
                <p class="lead">Found your soulmate through BandBazaBarat? Share your beautiful journey with us!</p>
                <p class="text-muted mb-4">Help inspire other singles by sharing how you met your life partner. Your story could be featured on our platform.</p>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#submitStoryModal">
                    <i class="fas fa-pen-fancy me-2"></i>Submit Your Story
                </button>
            </div>
        </div>
    </div>

    <!-- Submit Story Modal -->
    <div class="modal fade" id="submitStoryModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share Your Success Story</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="storySubmissionForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Bride's Name</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Groom's Name</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Wedding Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" placeholder="City, State" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Love Story</label>
                            <textarea class="form-control" rows="5" placeholder="Share how you met, your journey, and what made BandBazaBarat special for you..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Wedding Photo</label>
                            <input type="file" class="form-control" accept="image/*">
                            <small class="text-muted">Optional - Your photo will be used with your permission</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="permissionCheck" required>
                            <label class="form-check-label" for="permissionCheck">
                                I give permission to BandBazaBarat to feature my story on the website and marketing materials
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="storySubmissionForm" class="btn btn-primary">Submit Story</button>
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
            // Filter functionality
            const filterButtons = document.querySelectorAll('.filter-btn');
            const storyCards = document.querySelectorAll('.story-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.dataset.filter;
                    
                    // Filter stories
                    storyCards.forEach(card => {
                        if (filter === 'all' || card.dataset.category.includes(filter)) {
                            card.style.display = 'block';
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            }, 100);
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    });
                });
            });

            // Load more functionality
            document.getElementById('loadMoreBtn').addEventListener('click', function() {
                const button = this;
                const originalText = button.innerHTML;
                
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading More Stories...';
                button.disabled = true;

                // Simulate loading
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    window.BandBazaBarat.showNotification('More success stories loaded!', 'success');
                }, 2000);
            });

            // Story submission form
            document.getElementById('storySubmissionForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = document.querySelector('#submitStoryModal button[type="submit"]');
                const originalText = submitBtn.textContent;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
                submitBtn.disabled = true;

                // Simulate form submission
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    
                    bootstrap.Modal.getInstance(document.getElementById('submitStoryModal')).hide();
                    window.BandBazaBarat.showNotification('Thank you for sharing your story! We will review it and get back to you soon.', 'success');
                    this.reset();
                }, 3000);
            });

            // Add fade-in animation to cards
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            storyCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
@endsection
