@extends('layouts.app')
@section('content')
    
    <style>
        .contact-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .contact-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .contact-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 5 L60 35 L90 35 L68 55 L78 85 L50 65 L22 85 L32 55 L10 35 L40 35 Z' fill='%23FFFFFF' fill-opacity='0.1'/%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }
        
        .contact-content {
            position: relative;
            z-index: 1;
        }
        
        .contact-info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: -3rem auto 3rem;
            position: relative;
            z-index: 2;
        }
        
        .contact-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .contact-icon {
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
        
        .contact-title {
            color: var(--maroon);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .contact-details {
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        
        .contact-action {
            margin-top: 1rem;
        }
        
        .form-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3rem 2rem;
            margin-bottom: 3rem;
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
        
        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.75rem;
            transition: var(--transition);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.25);
        }
        
        .office-locations {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        
        .office-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
        }
        
        .office-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .office-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--white);
        }
        
        .office-name {
            color: var(--maroon);
            font-weight: 600;
            margin: 0;
        }
        
        .office-type {
            color: var(--muted);
            font-size: 0.9rem;
        }
        
        .office-address {
            color: var(--text-dark);
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .office-contact {
            border-top: 1px solid #f0f0f0;
            padding-top: 1rem;
        }
        
        .office-contact p {
            margin: 0.5rem 0;
            display: flex;
            align-items: center;
        }
        
        .office-contact i {
            width: 20px;
            margin-right: 0.5rem;
            color: var(--maroon);
        }
        
        .faq-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3rem 2rem;
            margin: 3rem 0;
        }
        
        .accordion-button {
            color: var(--maroon);
            font-weight: 500;
        }
        
        .accordion-button:not(.collapsed) {
            background: var(--light-bg);
            color: var(--maroon);
        }
        
        .support-hours {
            background: linear-gradient(135deg, rgba(128, 0, 0, 0.1), rgba(255, 179, 71, 0.1));
            border-radius: var(--border-radius);
            padding: 2rem;
            margin: 2rem 0;
            text-align: center;
        }
        
        .hours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .hours-item {
            background: var(--white);
            padding: 1rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        
        .hours-day {
            font-weight: 600;
            color: var(--maroon);
        }
        
        .hours-time {
            color: var(--text-dark);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .contact-container {
                padding: 1rem;
            }
            
            .contact-header {
                padding: 2rem 0;
            }
            
            .contact-info-cards {
                margin-top: 1rem;
            }
            
            .form-section {
                padding: 2rem 1rem;
            }
            
            .office-card {
                padding: 1.5rem;
            }
        }
    </style>
    <!-- Contact Container -->
    <div class="contact-container">
        <!-- Header Section -->
        <div class="contact-header">
            <div class="container">
                <div class="contact-content">
                    <h1><i class="fas fa-envelope me-3"></i>Contact Us</h1>
                    <p class="lead">We're here to help you find your perfect life partner</p>
                    <p class="mb-0">Get in touch with our dedicated support team for any assistance</p>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Contact Info Cards -->
            <div class="contact-info-cards">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h4 class="contact-title">Call Us</h4>
                    <div class="contact-details">
                        <p><strong>Toll Free:</strong> 1800-123-4567</p>
                        <p><strong>Direct:</strong> +91 98765 43210</p>
                        <p>Available 24/7 for your queries</p>
                    </div>
                    <div class="contact-action">
                        <a href="tel:1800-123-4567" class="btn btn-outline-primary">Call Now</a>
                    </div>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 class="contact-title">Email Us</h4>
                    <div class="contact-details">
                        <p><strong>General:</strong> support@BandBazaBarat.com</p>
                        <p><strong>Technical:</strong> tech@BandBazaBarat.com</p>
                        <p>We respond within 24 hours</p>
                    </div>
                    <div class="contact-action">
                        <a href="mailto:support@BandBazaBarat.com" class="btn btn-outline-primary">Send Email</a>
                    </div>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h4 class="contact-title">WhatsApp</h4>
                    <div class="contact-details">
                        <p><strong>Support:</strong> +91 98765 43210</p>
                        <p><strong>Quick Assistance:</strong> +91 87654 32109</p>
                        <p>Chat with us instantly</p>
                    </div>
                    <div class="contact-action">
                        <a href="https://wa.me/919876543210" target="_blank" class="btn btn-outline-primary">
                            <i class="fab fa-whatsapp me-2"></i>Chat Now
                        </a>
                    </div>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h4 class="contact-title">Live Chat</h4>
                    <div class="contact-details">
                        <p><strong>Web Chat:</strong> Available on website</p>
                        <p><strong>Mobile App:</strong> In-app messaging</p>
                        <p>Real-time support available</p>
                    </div>
                    <div class="contact-action">
                        <button class="btn btn-outline-primary" onclick="openLiveChat()">Start Chat</button>
                    </div>
                </div>
            </div>

            <!-- Support Hours -->
            <div class="support-hours">
                <h3 class="section-title">Support Hours</h3>
                <p class="text-muted">Our customer support team is available to assist you</p>
                
                <div class="hours-grid">
                    <div class="hours-item">
                        <div class="hours-day">Monday - Friday</div>
                        <div class="hours-time">9:00 AM - 9:00 PM</div>
                    </div>
                    <div class="hours-item">
                        <div class="hours-day">Saturday</div>
                        <div class="hours-time">10:00 AM - 6:00 PM</div>
                    </div>
                    <div class="hours-item">
                        <div class="hours-day">Sunday</div>
                        <div class="hours-time">10:00 AM - 4:00 PM</div>
                    </div>
                    <div class="hours-item">
                        <div class="hours-day">Emergency Support</div>
                        <div class="hours-time">24/7 Available</div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="form-section">
                <h3 class="section-title text-center mb-4">Send Us a Message</h3>
                <p class="text-center text-muted mb-4">Fill out the form below and we'll get back to you as soon as possible</p>
                
                <form id="contactForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label required">Full Name</label>
                                <input type="text" class="form-control" name="fullName" placeholder="Enter your full name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label required">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label required">Phone Number</label>
                                <input type="tel" class="form-control" name="phone" placeholder="Enter your phone number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Profile ID (if any)</label>
                                <input type="text" class="form-control" name="profileId" placeholder="e.g., CM123456">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required">Subject</label>
                        <select class="form-select" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="technical">Technical Support</option>
                            <option value="billing">Billing & Membership</option>
                            <option value="profile">Profile Issues</option>
                            <option value="matching">Matching & Search</option>
                            <option value="privacy">Privacy & Security</option>
                            <option value="suggestion">Feedback & Suggestions</option>
                            <option value="complaint">Complaint</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Priority Level</label>
                        <select class="form-select" name="priority">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required">Message</label>
                        <textarea class="form-control" name="message" rows="6" placeholder="Please describe your query in detail..." required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="responseConsent" required>
                            <label class="form-check-label" for="responseConsent">
                                I agree to receive response via email and phone regarding my query
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="border rounded p-3 text-center bg-light">
                            <i class="fas fa-shield-alt text-success fs-2 mb-2"></i>
                            <p class="mb-0"><strong>reCAPTCHA verification will appear here</strong></p>
                            <small class="text-muted">Please verify that you are not a robot</small>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </div>
                </form>
            </div>

            <!-- Office Locations -->
            <div class="form-section">
                <h3 class="section-title text-center mb-4">Our Office Locations</h3>
                <p class="text-center text-muted mb-4">Visit us at any of our offices across India</p>
                
                <div class="office-locations">
                    <div class="office-card">
                        <div class="office-header">
                            <div class="office-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div>
                                <h4 class="office-name">Mumbai Head Office</h4>
                                <p class="office-type">Corporate Headquarters</p>
                            </div>
                        </div>
                        <div class="office-address">
                            BandBazaBarat Corporate Tower<br>
                            Plot No. 123, Sector 15<br>
                            Vashi, Navi Mumbai - 400703<br>
                            Maharashtra, India
                        </div>
                        <div class="office-contact">
                            <p><i class="fas fa-phone"></i> +91 22 4567 8901</p>
                            <p><i class="fas fa-envelope"></i> mumbai@BandBazaBarat.com</p>
                            <p><i class="fas fa-clock"></i> Mon-Sat: 9:00 AM - 7:00 PM</p>
                        </div>
                    </div>
                    
                    <div class="office-card">
                        <div class="office-header">
                            <div class="office-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div>
                                <h4 class="office-name">Delhi Branch</h4>
                                <p class="office-type">Regional Office</p>
                            </div>
                        </div>
                        <div class="office-address">
                            BandBazaBarat Delhi Office<br>
                            A-45, Sector 18<br>
                            Noida - 201301<br>
                            Uttar Pradesh, India
                        </div>
                        <div class="office-contact">
                            <p><i class="fas fa-phone"></i> +91 11 2345 6789</p>
                            <p><i class="fas fa-envelope"></i> delhi@BandBazaBarat.com</p>
                            <p><i class="fas fa-clock"></i> Mon-Sat: 9:30 AM - 6:30 PM</p>
                        </div>
                    </div>
                    
                    <div class="office-card">
                        <div class="office-header">
                            <div class="office-icon">
                                <i class="fas fa-city"></i>
                            </div>
                            <div>
                                <h4 class="office-name">Bangalore Branch</h4>
                                <p class="office-type">Regional Office</p>
                            </div>
                        </div>
                        <div class="office-address">
                            BandBazaBarat Tech Hub<br>
                            123, MG Road, Richmond Town<br>
                            Bangalore - 560025<br>
                            Karnataka, India
                        </div>
                        <div class="office-contact">
                            <p><i class="fas fa-phone"></i> +91 80 3456 7890</p>
                            <p><i class="fas fa-envelope"></i> bangalore@BandBazaBarat.com</p>
                            <p><i class="fas fa-clock"></i> Mon-Sat: 9:00 AM - 7:00 PM</p>
                        </div>
                    </div>
                    
                    <div class="office-card">
                        <div class="office-header">
                            <div class="office-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div>
                                <h4 class="office-name">Chennai Branch</h4>
                                <p class="office-type">Regional Office</p>
                            </div>
                        </div>
                        <div class="office-address">
                            BandBazaBarat South India<br>
                            789, Anna Salai, Nungambakkam<br>
                            Chennai - 600034<br>
                            Tamil Nadu, India
                        </div>
                        <div class="office-contact">
                            <p><i class="fas fa-phone"></i> +91 44 4567 8901</p>
                            <p><i class="fas fa-envelope"></i> chennai@BandBazaBarat.com</p>
                            <p><i class="fas fa-clock"></i> Mon-Sat: 9:00 AM - 6:30 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section">
                <h3 class="section-title text-center mb-4">Frequently Asked Questions</h3>
                <p class="text-center text-muted mb-4">Quick answers to common questions</p>
                
                <div class="accordion" id="contactFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                How can I contact customer support?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                You can contact our customer support through multiple channels: call our toll-free number 1800-123-4567, email us at support@BandBazaBarat.com, chat with us on WhatsApp at +91 98765 43210, or use the live chat feature on our website. Our support team is available 24/7 for urgent queries.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                What is the typical response time for queries?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                We strive to respond to all queries as quickly as possible. Email queries are typically answered within 24 hours, while phone and live chat support provide immediate assistance. For urgent matters, we recommend calling our toll-free number for fastest resolution.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                Can I visit your office in person?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                Yes, we welcome visitors at all our office locations. We recommend calling ahead to schedule an appointment to ensure our relationship managers are available to assist you. Our offices are located in Mumbai, Delhi, Bangalore, and Chennai.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                How do I report a technical issue or bug?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                For technical issues, please email us at tech@BandBazaBarat.com with detailed information about the problem, including screenshots if possible. You can also use our contact form and select "Technical Support" as the subject. Our technical team will investigate and resolve the issue promptly.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                Is there support available in regional languages?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                Yes, our customer support team can assist you in multiple Indian languages including Hindi, Tamil, Telugu, Marathi, Gujarati, Bengali, Kannada, Malayalam, and Punjabi. Please mention your preferred language when contacting us.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        // Show loading
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending Message...';
        submitBtn.disabled = true;

        // Basic validation
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            field.classList.remove('is-invalid');
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            }
        });

        if (!isValid) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            window.BandBazaBarat.showNotification('Please fill in all required fields', 'error');
            return;
        }

        // Email validation
        const emailField = this.querySelector('[name="email"]');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            emailField.classList.add('is-invalid');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            window.BandBazaBarat.showNotification('Please enter a valid email address', 'error');
            return;
        }

        // Phone validation
        const phoneField = this.querySelector('[name="phone"]');
        const phoneRegex = /^[6-9]\d{9}$/;
        if (!phoneRegex.test(phoneField.value.replace(/[^0-9]/g, ''))) {
            phoneField.classList.add('is-invalid');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            window.BandBazaBarat.showNotification('Please enter a valid phone number', 'error');
            return;
        }

        // Prepare data
        const formData = new FormData(this);

        // AJAX request
        fetch('{{ route("contact.submit") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            console.log('data',data);
            if(data.success) {
                showNotification(data.message, 'success');
                contactForm.reset();
                contactForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                showNotification(data.message || 'Something went wrong', 'error')
            }
        })
        .catch(err => {
            console.error(err);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            showNotification('Server error. Please try again later.', 'error');
        });
    });

     // Live chat function
            window.openLiveChat = function() {
                window.BandBazaBarat.showNotification('Live chat feature will be available soon. Please use other contact methods for immediate assistance.', 'info');
            };

            // Animate contact cards on scroll
            const animateCards = () => {
                const cards = document.querySelectorAll('.contact-card, .office-card');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, { threshold: 0.1 });
                
                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                    observer.observe(card);
                });
            };

            animateCards();
});

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
</script>

@endsection

           