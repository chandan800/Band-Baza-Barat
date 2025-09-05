@extends('layouts.app')
@section('content')
    
    <style>
        .shortlist-container {
            background: linear-gradient(135deg, var(--light-bg) 0%, #FFF5F0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .shortlist-hero-section {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 3rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .shortlist-hero-section::before {
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
        
        .shortlist-hero-section h1 {
            position: relative;
            z-index: 2;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .shortlist-hero-section p {
            position: relative;
            z-index: 2;
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .shortlist-content {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            margin-top: -2rem;
            position: relative;
            z-index: 10;
        }
        
        .nav-tabs {
            border-bottom: 2px solid var(--light-bg);
            margin-bottom: 2rem;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: var(--text-dark);
            font-weight: 500;
            padding: 1rem 2rem;
            border-radius: 0;
            position: relative;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--maroon);
            background: transparent;
            border-bottom: 3px solid var(--golden-orange);
        }
        
        .nav-tabs .nav-link:hover {
            border-color: transparent;
            color: var(--maroon);
        }
        
        .profile-card {
            background: var(--white);
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--golden-orange), var(--deep-pink));
        }
        
        .profile-card:hover {
            border-color: var(--golden-orange);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .profile-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--golden-orange);
        }
        
        .profile-info h5 {
            color: var(--maroon);
            margin-bottom: 0.5rem;
        }
        
        .profile-info p {
            color: var(--text-dark);
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }
        
        .profile-badge {
            background: linear-gradient(135deg, var(--golden-orange), var(--deep-pink));
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .detail-item i {
            color: var(--golden-orange);
            width: 20px;
        }
        
        .detail-item span {
            color: var(--text-dark);
            font-size: 0.9rem;
        }
        
        .profile-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            border: none;
        }
        
        .btn-primary-action {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
        }
        
        .btn-primary-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(128, 0, 0, 0.3);
        }
        
        .btn-secondary-action {
            background: var(--light-bg);
            color: var(--maroon);
            border: 1px solid var(--golden-orange);
        }
        
        .btn-secondary-action:hover {
            background: var(--golden-orange);
            color: var(--white);
        }
        
        .message-card {
            background: var(--white);
            border: 1px solid #e9ecef;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: var(--transition);
        }
        
        .message-card:hover {
            border-color: var(--golden-orange);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .message-sender {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sender-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--golden-orange);
        }
        
        .sender-info h6 {
            color: var(--maroon);
            margin-bottom: 0.25rem;
        }
        
        .sender-info p {
            color: var(--text-dark);
            font-size: 0.8rem;
            margin-bottom: 0;
        }
        
        .message-time {
            color: var(--text-muted);
            font-size: 0.8rem;
        }
        
        .message-content {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .message-text {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 0;
        }
        
        .message-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--golden-orange);
            margin-bottom: 1rem;
        }
        
        .empty-state h4 {
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        .empty-state p {
            margin-bottom: 2rem;
        }
        
        .filter-section {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .filter-section h5 {
            color: var(--maroon);
            margin-bottom: 1rem;
        }
        
        .filter-options {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .filter-option {
            background: var(--white);
            border: 1px solid #e9ecef;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }
        
        .filter-option.active {
            background: var(--golden-orange);
            color: var(--white);
            border-color: var(--golden-orange);
        }
        
        .filter-option:hover {
            border-color: var(--golden-orange);
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--light-bg), #FFF5F0);
            border: 2px solid transparent;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition);
        }
        
        .stat-card:hover {
            border-color: var(--golden-orange);
            transform: translateY(-2px);
        }
        
        .stat-card i {
            font-size: 2rem;
            color: var(--maroon);
            margin-bottom: 0.5rem;
        }
        
        .stat-card h3 {
            color: var(--maroon);
            margin-bottom: 0.5rem;
        }
        
        .stat-card p {
            color: var(--text-dark);
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .compatibility-badge {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .online-indicator {
            width: 12px;
            height: 12px;
            background: #28a745;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .shortlist-hero-section h1 {
                font-size: 2.5rem;
            }
            
            .shortlist-content {
                margin: 0 1rem;
                margin-top: -1rem;
                padding: 1.5rem;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-details {
                grid-template-columns: 1fr;
            }
            
            .profile-actions {
                justify-content: center;
            }
            
            .message-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .filter-options {
                flex-direction: column;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Shortlist Hero Section -->
    <section class="shortlist-hero-section">
        <div class="container">
            <h1><i class="fas fa-heart me-3"></i>Shortlist & Messages</h1>
            <p class="lead">Manage your connections and build meaningful relationships</p>
        </div>
    </section>

    <!-- Shortlist Content -->
    <div class="shortlist-container" style="display:flex;">
        <div class="container">
            <div class="shortlist-content">
                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card">
                        <i class="fas fa-heart"></i>
                        <h3>12</h3>
                        <p>Shortlisted Profiles</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-comments"></i>
                        <h3>8</h3>
                        <p>Active Conversations</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-eye"></i>
                        <h3>25</h3>
                        <p>Profile Views</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-star"></i>
                        <h3>5</h3>
                        <p>Premium Matches</p>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs" id="shortlistTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="shortlist-tab" data-bs-toggle="tab" data-bs-target="#shortlist" type="button" role="tab">
                            <i class="fas fa-heart me-2"></i>Shortlisted Profiles
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab">
                            <i class="fas fa-comments me-2"></i>Messages
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="interests-tab" data-bs-toggle="tab" data-bs-target="#interests" type="button" role="tab">
                            <i class="fas fa-user-plus me-2"></i>Interest Received
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="shortlistTabsContent">
                    <!-- Shortlisted Profiles Tab -->
                    <div class="tab-pane fade show active" id="shortlist" role="tabpanel">
                        <!-- Filter Section -->
                        <div class="filter-section">
                            <h5><i class="fas fa-filter me-2"></i>Filter Profiles</h5>
                            <div class="filter-options">
                                <div class="filter-option active" data-filter="all">All Profiles</div>
                                <div class="filter-option" data-filter="online">Online Now</div>
                                <div class="filter-option" data-filter="premium">Premium</div>
                                <div class="filter-option" data-filter="verified">Verified</div>
                                <div class="filter-option" data-filter="recent">Recently Active</div>
                            </div>
                        </div>

                        <!-- Shortlisted Profiles -->
                        <div class="shortlisted-profiles">
                            <div class="profile-card" data-category="premium verified">
                                <div class="profile-header">
                                    <img src="https://via.placeholder.com/80/FFB347/FFFFFF?text=P" alt="Profile Photo" class="profile-photo">
                                    <div class="profile-info">
                                        <h5>Priya Sharma <span class="online-indicator"></span><span class="compatibility-badge">95% Match</span></h5>
                                        <p><i class="fas fa-map-marker-alt me-1"></i>Mumbai, Maharashtra</p>
                                        <p><i class="fas fa-graduation-cap me-1"></i>Software Engineer, 28 years</p>
                                    </div>
                                </div>
                                
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <i class="fas fa-caste"></i>
                                        <span>Brahmin</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-star"></i>
                                        <span>Premium Member</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Verified Profile</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Online 2 hours ago</span>
                                    </div>
                                </div>
                                
                                <div class="profile-actions">
                                    <button class="btn btn-action btn-primary-action">
                                        <i class="fas fa-comments me-1"></i>Send Message
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-heart-broken me-1"></i>Remove
                                    </button>
                                </div>
                            </div>

                            <div class="profile-card" data-category="verified">
                                <div class="profile-header">
                                    <img src="https://via.placeholder.com/80/E36387/FFFFFF?text=A" alt="Profile Photo" class="profile-photo">
                                    <div class="profile-info">
                                        <h5>Anjali Patel <span class="compatibility-badge">88% Match</span></h5>
                                        <p><i class="fas fa-map-marker-alt me-1"></i>Delhi, NCR</p>
                                        <p><i class="fas fa-graduation-cap me-1"></i>Doctor, 26 years</p>
                                    </div>
                                </div>
                                
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <i class="fas fa-caste"></i>
                                        <span>Patel</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Verified Profile</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Active 1 day ago</span>
                                    </div>
                                </div>
                                
                                <div class="profile-actions">
                                    <button class="btn btn-action btn-primary-action">
                                        <i class="fas fa-comments me-1"></i>Send Message
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-heart-broken me-1"></i>Remove
                                    </button>
                                </div>
                            </div>

                            <div class="profile-card" data-category="online">
                                <div class="profile-header">
                                    <img src="https://via.placeholder.com/80/800000/FFFFFF?text=R" alt="Profile Photo" class="profile-photo">
                                    <div class="profile-info">
                                        <h5>Riya Gupta <span class="online-indicator"></span><span class="compatibility-badge">92% Match</span></h5>
                                        <p><i class="fas fa-map-marker-alt me-1"></i>Bangalore, Karnataka</p>
                                        <p><i class="fas fa-graduation-cap me-1"></i>Marketing Manager, 27 years</p>
                                    </div>
                                </div>
                                
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <i class="fas fa-caste"></i>
                                        <span>Bania</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Online now</span>
                                    </div>
                                </div>
                                
                                <div class="profile-actions">
                                    <button class="btn btn-action btn-primary-action">
                                        <i class="fas fa-comments me-1"></i>Send Message
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-heart-broken me-1"></i>Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Tab -->
                    <div class="tab-pane fade" id="messages" role="tabpanel">
                        <div class="messages-list">
                            <div class="message-card">
                                <div class="message-header">
                                    <div class="message-sender">
                                        <img src="https://via.placeholder.com/50/FFB347/FFFFFF?text=P" alt="Sender Photo" class="sender-photo">
                                        <div class="sender-info">
                                            <h6>Priya Sharma <span class="online-indicator"></span></h6>
                                            <p>Mumbai, Maharashtra • 28 years</p>
                                        </div>
                                    </div>
                                    <div class="message-time">2 hours ago</div>
                                </div>
                                
                                <div class="message-content">
                                    <p class="message-text">Namaste! I really liked your profile. Your values and family background align perfectly with what I'm looking for. Would love to know more about you and your family. Are you comfortable with traditional Hindu customs?</p>
                                </div>
                                
                                <div class="message-actions">
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-reply me-1"></i>Reply
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                </div>
                            </div>

                            <div class="message-card">
                                <div class="message-header">
                                    <div class="message-sender">
                                        <img src="https://via.placeholder.com/50/E36387/FFFFFF?text=A" alt="Sender Photo" class="sender-photo">
                                        <div class="sender-info">
                                            <h6>Anjali Patel</h6>
                                            <p>Delhi, NCR • 26 years</p>
                                        </div>
                                    </div>
                                    <div class="message-time">1 day ago</div>
                                </div>
                                
                                <div class="message-content">
                                    <p class="message-text">Hello! Thank you for your interest. I found your profile very interesting. I'm a doctor and value family traditions. Would you be interested in talking to my parents as well? They are very involved in this process.</p>
                                </div>
                                
                                <div class="message-actions">
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-reply me-1"></i>Reply
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                </div>
                            </div>

                            <div class="message-card">
                                <div class="message-header">
                                    <div class="message-sender">
                                        <img src="https://via.placeholder.com/50/800000/FFFFFF?text=R" alt="Sender Photo" class="sender-photo">
                                        <div class="sender-info">
                                            <h6>Riya Gupta <span class="online-indicator"></span></h6>
                                            <p>Bangalore, Karnataka • 27 years</p>
                                        </div>
                                    </div>
                                    <div class="message-time">3 days ago</div>
                                </div>
                                
                                <div class="message-content">
                                    <p class="message-text">Hi! I'm Riya. I work in marketing and love traveling. I saw your profile and was impressed by your educational background. Do you believe in horoscope matching? My family is quite traditional about these things.</p>
                                </div>
                                
                                <div class="message-actions">
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-reply me-1"></i>Reply
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interest Received Tab -->
                    <div class="tab-pane fade" id="interests" role="tabpanel">
                        <div class="interests-list">
                            <div class="profile-card" data-category="premium">
                                <div class="profile-header">
                                    <img src="https://via.placeholder.com/80/FFD700/FFFFFF?text=S" alt="Profile Photo" class="profile-photo">
                                    <div class="profile-info">
                                        <h5>Sunita Verma <span class="compatibility-badge">90% Match</span></h5>
                                        <p><i class="fas fa-map-marker-alt me-1"></i>Pune, Maharashtra</p>
                                        <p><i class="fas fa-graduation-cap me-1"></i>Teacher, 25 years</p>
                                    </div>
                                </div>
                                
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <i class="fas fa-caste"></i>
                                        <span>Brahmin</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-star"></i>
                                        <span>Premium Member</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Sent interest 2 days ago</span>
                                    </div>
                                </div>
                                
                                <div class="profile-actions">
                                    <button class="btn btn-action btn-primary-action">
                                        <i class="fas fa-heart me-1"></i>Accept Interest
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-times me-1"></i>Decline
                                    </button>
                                </div>
                            </div>

                            <div class="profile-card" data-category="verified">
                                <div class="profile-header">
                                    <img src="https://via.placeholder.com/80/FFB347/FFFFFF?text=M" alt="Profile Photo" class="profile-photo">
                                    <div class="profile-info">
                                        <h5>Meera Singh <span class="compatibility-badge">85% Match</span></h5>
                                        <p><i class="fas fa-map-marker-alt me-1"></i>Chennai, Tamil Nadu</p>
                                        <p><i class="fas fa-graduation-cap me-1"></i>Architect, 29 years</p>
                                    </div>
                                </div>
                                
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <i class="fas fa-caste"></i>
                                        <span>Rajput</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Verified Profile</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Sent interest 1 week ago</span>
                                    </div>
                                </div>
                                
                                <div class="profile-actions">
                                    <button class="btn btn-action btn-primary-action">
                                        <i class="fas fa-heart me-1"></i>Accept Interest
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-eye me-1"></i>View Profile
                                    </button>
                                    <button class="btn btn-action btn-secondary-action">
                                        <i class="fas fa-times me-1"></i>Decline
                                    </button>
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
            // Filter functionality
            const filterOptions = document.querySelectorAll('.filter-option');
            const profileCards = document.querySelectorAll('.profile-card');
            
            filterOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    filterOptions.forEach(opt => opt.classList.remove('active'));
                    // Add active class to clicked option
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    profileCards.forEach(card => {
                        if (filter === 'all' || card.getAttribute('data-category').includes(filter)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            
            // Profile action buttons
            document.querySelectorAll('.btn-action').forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.textContent.trim();
                    
                    if (action.includes('Send Message')) {
                        alert('Message feature will open in a new window. Premium members can send unlimited messages.');
                    } else if (action.includes('View Profile')) {
                        alert('Profile will open in a new window.');
                    } else if (action.includes('Remove')) {
                        if (confirm('Are you sure you want to remove this profile from your shortlist?')) {
                            this.closest('.profile-card').style.display = 'none';
                        }
                    } else if (action.includes('Accept Interest')) {
                        alert('Interest accepted! You can now start messaging.');
                    } else if (action.includes('Decline')) {
                        if (confirm('Are you sure you want to decline this interest?')) {
                            this.closest('.profile-card').style.display = 'none';
                        }
                    } else if (action.includes('Reply')) {
                        alert('Reply feature will open in a new window.');
                    }
                });
            });
            
            // Tab functionality (Bootstrap handles this, but we can add custom behavior)
            const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
            tabLinks.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(event) {
                    // Update active tab styling
                    const targetTab = event.target;
                    const targetId = targetTab.getAttribute('data-bs-target');
                    
                    // You can add custom logic here when tabs change
                    console.log('Switched to tab:', targetId);
                });
            });
            
            // Online indicator animation
            const onlineIndicators = document.querySelectorAll('.online-indicator');
            onlineIndicators.forEach(indicator => {
                indicator.style.animation = 'pulse 2s infinite';
            });
            
            // Add pulse animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes pulse {
                    0% { opacity: 1; }
                    50% { opacity: 0.5; }
                    100% { opacity: 1; }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection