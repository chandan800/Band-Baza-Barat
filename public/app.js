// BandBazaBarat - Main JavaScript File
// Handles form validation, animations, and interactive features

document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    initializeAnimations();
    initializeForms();
    initializeModals();
    initializeLocalStorage();
    initializeFilters();
    initializeCarousels();

  

    // Initialize scroll animations
    function initializeAnimations() {
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        const animatedElements = document.querySelectorAll('.step-card, .profile-card, .benefit-card, .story-card');
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }

    // Form validation and handling
    function initializeForms() {
        // Quick search form
        const quickSearchForm = document.querySelector('.quick-search-form');
        if (quickSearchForm) {
            quickSearchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleQuickSearch(this);
            });
        }

        // Multi-step registration wizard
        initializeRegistrationWizard();

        // Login form
        const loginForm = document.querySelector('#loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleLogin(this);
            });
        }

        // Contact form
        const contactForm = document.querySelector('#contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleContactForm(this);
            });
        }

        // Advanced search filters
        initializeAdvancedSearch();
    }

    // Registration wizard functionality
    function initializeRegistrationWizard() {
        const wizard = document.querySelector('.registration-wizard');
        if (!wizard) return;

        const steps = wizard.querySelectorAll('.wizard-step');
        const progressBar = wizard.querySelector('.progress-bar');
        const nextButtons = wizard.querySelectorAll('.btn-next');
        const prevButtons = wizard.querySelectorAll('.btn-prev');
        
        let currentStep = 0;

        function updateWizard() {
            // Hide all steps
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === currentStep);
            });

            // Update progress bar
            const progress = ((currentStep + 1) / steps.length) * 100;
            if (progressBar) {
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
            }

            // Save progress to localStorage
            saveRegistrationProgress();
        }

        // Next button handlers
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (validateCurrentStep(currentStep)) {
                    currentStep = Math.min(currentStep + 1, steps.length - 1);
                    updateWizard();
                }
            });
        });

        // Previous button handlers
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentStep = Math.max(currentStep - 1, 0);
                updateWizard();
            });
        });

        // Initialize wizard
        updateWizard();
        loadRegistrationProgress();
    }

    // Validate current step in registration
    function validateCurrentStep(stepIndex) {
        const currentStepElement = document.querySelector(`.wizard-step:nth-child(${stepIndex + 1})`);
        if (!currentStepElement) return true;

        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            showNotification('Please fill in all required fields', 'error');
        }

        return isValid;
    }

    // Handle quick search
    function handleQuickSearch(form) {
        const formData = new FormData(form);
        const searchParams = new URLSearchParams();

        for (let [key, value] of formData.entries()) {
            if (value) {
                searchParams.append(key, value);
            }
        }

        // Redirect to search page with parameters
        window.location.href = `search.html?${searchParams.toString()}`;
    }

    // Handle login
    function handleLogin(form) {
        const formData = new FormData(form);
        const email = formData.get('email');
        const password = formData.get('password');

        // Basic validation
        if (!email || !password) {
            showNotification('Please fill in all fields', 'error');
            return;
        }

        // Show loading state
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.textContent = 'Logging in...';
        submitButton.disabled = true;

        // Simulate API call
        setTimeout(() => {
            // Restore button state
            submitButton.textContent = originalText;
            submitButton.disabled = false;

            // Mock authentication
            if (email === 'demo@BandBazaBarat.com' && password === 'demo123') {
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userEmail', email);
                showNotification('Login successful!', 'success');
                window.location.href = 'dashboard.html';
            } else {
                showNotification('Invalid credentials. Try demo@BandBazaBarat.com / demo123', 'error');
            }
        }, 1500);
    }

    // Handle contact form
    function handleContactForm(form) {
        const formData = new FormData(form);
        const name = formData.get('name');
        const email = formData.get('email');
        const message = formData.get('message');

        if (!name || !email || !message) {
            showNotification('Please fill in all fields', 'error');
            return;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNotification('Please enter a valid email address', 'error');
            return;
        }

        // Show loading state
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.textContent = 'Sending...';
        submitButton.disabled = true;

        // Simulate API call
        setTimeout(() => {
            submitButton.textContent = originalText;
            submitButton.disabled = false;
            form.reset();
            showNotification('Message sent successfully! We will get back to you soon.', 'success');
        }, 2000);
    }

    // Initialize modals
    function initializeModals() {
        // Login modal
        const loginModal = document.querySelector('#loginModal');
        if (loginModal) {
            loginModal.addEventListener('show.bs.modal', function() {
                const emailInput = this.querySelector('input[type="email"]');
                if (emailInput) {
                    setTimeout(() => emailInput.focus(), 500);
                }
            });
        }

        // OTP modal
        const otpModal = document.querySelector('#otpModal');
        if (otpModal) {
            initializeOTPInput(otpModal);
        }

        // Photo upload modal
        const photoModal = document.querySelector('#photoUploadModal');
        if (photoModal) {
            initializePhotoUpload(photoModal);
        }
    }

    // OTP input handling
    function initializeOTPInput(modal) {
        const otpInputs = modal.querySelectorAll('.otp-input');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
    }

    // Photo upload handling
    function initializePhotoUpload(modal) {
        const dropZone = modal.querySelector('.photo-drop-zone');
        const fileInput = modal.querySelector('input[type="file"]');
        const preview = modal.querySelector('.photo-preview');

        if (dropZone && fileInput) {
            dropZone.addEventListener('click', () => fileInput.click());

            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('drag-over');
            });

            dropZone.addEventListener('dragleave', function() {
                this.classList.remove('drag-over');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                const files = e.dataTransfer.files;
                handleFileUpload(files[0], preview);
            });

            fileInput.addEventListener('change', function() {
                handleFileUpload(this.files[0], preview);
            });
        }
    }

    // Handle file upload
    function handleFileUpload(file, preview) {
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showNotification('Please select a valid image file', 'error');
            return;
        }

        if (file.size > 5 * 1024 * 1024) { // 5MB limit
            showNotification('File size should be less than 5MB', 'error');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            if (preview) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid rounded">`;
            }
        };
        reader.readAsDataURL(file);
    }

    // Local storage management
    function initializeLocalStorage() {
        // Check login status
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        if (isLoggedIn) {
            updateUIForLoggedInUser();
        }
    }

    // Update UI for logged in user
    function updateUIForLoggedInUser() {
        const loginButtons = document.querySelectorAll('a[href="login.html"]');
        const registerButtons = document.querySelectorAll('a[href="register.html"]');
        const userEmail = localStorage.getItem('userEmail');

        loginButtons.forEach(btn => {
            btn.textContent = 'Dashboard';
            btn.href = 'dashboard.html';
        });

        registerButtons.forEach(btn => {
            btn.textContent = 'Logout';
            btn.href = '#';
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                logout();
            });
        });
    }

    // Logout functionality
    function logout() {
        localStorage.removeItem('isLoggedIn');
        localStorage.removeItem('userEmail');
        localStorage.removeItem('registrationProgress');
        showNotification('Logged out successfully', 'success');
        setTimeout(() => {
            window.location.href = 'index.html';
        }, 1000);
    }

    // Save registration progress
    function saveRegistrationProgress() {
        const wizard = document.querySelector('.registration-wizard');
        if (!wizard) return;

        const formData = {};
        const inputs = wizard.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            if (input.name && input.value) {
                formData[input.name] = input.value;
            }
        });

        localStorage.setItem('registrationProgress', JSON.stringify(formData));
    }

    // Load registration progress
    function loadRegistrationProgress() {
        const savedData = localStorage.getItem('registrationProgress');
        if (!savedData) return;

        try {
            const formData = JSON.parse(savedData);
            Object.keys(formData).forEach(name => {
                const input = document.querySelector(`[name="${name}"]`);
                if (input) {
                    input.value = formData[name];
                }
            });
        } catch (e) {
            console.error('Error loading registration progress:', e);
        }
    }

    // Initialize advanced search filters
    function initializeAdvancedSearch() {
        const filterForm = document.querySelector('#advancedSearchForm');
        if (!filterForm) return;

        // Age range slider
        const ageSliders = filterForm.querySelectorAll('.age-range-slider');
        ageSliders.forEach(slider => {
            slider.addEventListener('input', function() {
                const output = document.querySelector(`#${this.id}Value`);
                if (output) {
                    output.textContent = this.value;
                }
            });
        });

        // Height range slider
        const heightSliders = filterForm.querySelectorAll('.height-range-slider');
        heightSliders.forEach(slider => {
            slider.addEventListener('input', function() {
                const output = document.querySelector(`#${this.id}Value`);
                if (output) {
                    const feet = Math.floor(this.value / 12);
                    const inches = this.value % 12;
                    output.textContent = `${feet}'${inches}"`;
                }
            });
        });

        // Caste and sub-caste dependency
        const casteSelect = filterForm.querySelector('#caste');
        const subCasteSelect = filterForm.querySelector('#subCaste');
        
        if (casteSelect && subCasteSelect) {
            casteSelect.addEventListener('change', function() {
                updateSubCasteOptions(this.value, subCasteSelect);
            });
        }

        // Filter form submission
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            applySearchFilters(this);
        });
    }

    // Update sub-caste options based on caste selection
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
        subCasteSelect.innerHTML = '<option value="">Select Sub-Caste</option>';

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

    // Apply search filters
    function applySearchFilters(form) {
        const formData = new FormData(form);
        const filters = {};

        for (let [key, value] of formData.entries()) {
            if (value) {
                filters[key] = value;
            }
        }

    // Initialize filter sidebar
    function initializeFilters() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const clearFiltersBtn = document.querySelector('#clearFilters');
        const saveFilterBtn = document.querySelector('#saveFilter');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                updateFilterCount();
            });
        });

        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.form-control, .form-select').forEach(input => {
                    input.value = '';
                });
                updateFilterCount();
            });
        }

        if (saveFilterBtn) {
            saveFilterBtn.addEventListener('click', saveCurrentFilters);
        }
    }

    // Update filter count display
    function updateFilterCount() {
        const activeFilters = document.querySelectorAll('.filter-btn.active').length;
        const filterCount = document.querySelector('#filterCount');
        
        if (filterCount) {
            filterCount.textContent = activeFilters;
        }
    }

    // Save current filters
    function saveCurrentFilters() {
        const filterName = prompt('Enter a name for this filter:');
        if (!filterName) return;

        const activeFilters = Array.from(document.querySelectorAll('.filter-btn.active'))
            .map(btn => btn.dataset.filter);

        const savedFilters = JSON.parse(localStorage.getItem('savedFilters') || '[]');
        savedFilters.push({
            name: filterName,
            filters: activeFilters,
            date: new Date().toISOString()
        });

        localStorage.setItem('savedFilters', JSON.stringify(savedFilters));
        showNotification('Filter saved successfully!', 'success');
    }

    // Initialize carousels
    function initializeCarousels() {
        // Photo carousel in profile view
        const photoCarousel = document.querySelector('#photoCarousel');
        if (photoCarousel) {
            // Add touch/swipe support for mobile
            let startX = 0;
            let currentX = 0;
            let isDragging = false;

            photoCarousel.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
                isDragging = true;
            });

            photoCarousel.addEventListener('touchmove', function(e) {
                if (!isDragging) return;
                currentX = e.touches[0].clientX;
            });

            photoCarousel.addEventListener('touchend', function() {
                if (!isDragging) return;
                
                const diffX = startX - currentX;
                const carousel = bootstrap.Carousel.getInstance(this);
                
                if (Math.abs(diffX) > 50) {
                    if (diffX > 0) {
                        carousel.next();
                    } else {
                        carousel.prev();
                    }
                }
                
                isDragging = false;
            });
        }
    }

    // Notification system
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

    window.sendInterest = function(profileId) {
        const button = event.target;
        const originalText = button.textContent;
        
        button.textContent = 'Sending...';
        button.disabled = true;

       fetch('/send-interest', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ profile_id: profileId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            button.textContent = 'Interest Sent';
            button.classList.replace('btn-primary', 'btn-success');
        } else {
            button.textContent = originalText;
            showNotification(data.message, 'success'); // ✅ Correct

        }
        button.disabled = false;
    })
    .catch(() => {
        button.textContent = originalText;
        button.disabled = false;
        alert('Error');
    });
    };

    window.addToShortlist = function(profileId) {
    const button = event.target;

    fetch('/shortlist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ shortlisted_user_id: profileId })
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === 'success') {
            // Update button state
            const isShortlisted = button.classList.contains('btn-warning');

            if (isShortlisted) {
                button.classList.remove('btn-warning');
                button.classList.add('btn-outline-warning');
                button.innerHTML = '<i class="fas fa-bookmark"></i> Shortlist';
                showNotification('Removed from shortlist', 'info');
            } else {
                button.classList.remove('btn-outline-warning');
                button.classList.add('btn-warning');
                button.innerHTML = '<i class="fas fa-bookmark"></i> Shortlisted';
                showNotification('Added to shortlist', 'success');
            }
        }
    })
    .catch(err => {
        console.error(err);
        alert('Something went wrong. Please try again.');
    });
};

    window.viewProfile = function(profileId) {
        // Track profile view
        const viewedProfiles = JSON.parse(localStorage.getItem('viewedProfiles') || '[]');
        if (!viewedProfiles.includes(profileId)) {
            viewedProfiles.push(profileId);
            localStorage.setItem('viewedProfiles', JSON.stringify(viewedProfiles));
        }
        
        window.location.href = `profile.html?id=${profileId}`;
    };


    // CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .drag-over {
            border-color: var(--maroon) !important;
            background-color: var(--light-bg) !important;
        }
        
        .filter-btn.active {
            background: var(--maroon) !important;
            color: white !important;
            border-color: var(--maroon) !important;
        }
        
        .otp-input {
            width: 50px !important;
            height: 50px !important;
            text-align: center !important;
            font-size: 1.2rem !important;
            font-weight: bold !important;
        }
    `;
    document.head.appendChild(style);

    // Page-specific initializations
    const currentPage = window.location.pathname.split('/').pop();
    
    switch (currentPage) {
        case 'index.html':
        case '':
            initializeHomePage();
            break;
        case 'search.html':
            initializeSearchPage();
            break;
        case 'matches.html':
            initializeMatchesPage();
            break;
        case 'profile.html':
            initializeProfilePage();
            break;
        case 'dashboard.html':
            initializeDashboard();
            break;
    }

    // Page-specific functions
    function initializeHomePage() {
        // Auto-advance hero testimonials
        const testimonials = document.querySelectorAll('.testimonial-item');
        let currentTestimonial = 0;
        
        if (testimonials.length > 1) {
            setInterval(() => {
                testimonials[currentTestimonial].classList.remove('active');
                currentTestimonial = (currentTestimonial + 1) % testimonials.length;
                testimonials[currentTestimonial].classList.add('active');
            }, 5000);
        }
    }

    function initializeSearchPage() {
        // Load search parameters from URL
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.forEach((value, key) => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) {
                input.value = value;
            }
        });
    }

    function initializeMatchesPage() {
        // Load saved filters
        const savedFilters = localStorage.getItem('searchFilters');
        if (savedFilters) {
            try {
                const filters = JSON.parse(savedFilters);
                Object.keys(filters).forEach(key => {
                    const input = document.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.value = filters[key];
                    }
                });
            } catch (e) {
                console.error('Error loading saved filters:', e);
            }
        }
    }

    function initializeProfilePage() {
        // Load profile data from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const profileId = urlParams.get('id');
        
        if (profileId) {
            loadProfileData(profileId);
        }
    }

    function initializeDashboard() {
        // Check if user is logged in
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        if (!isLoggedIn) {
            window.location.href = 'login.html';
            return;
        }
        
        // Load dashboard data
        loadDashboardData();
    }

    // Mock profile data loading
    function loadProfileData(profileId) {
        // In a real application, this would fetch from an API
        const profileData = {
            name: 'Sample Profile',
            age: 28,
            location: 'Mumbai, Maharashtra',
            education: 'MBA',
            occupation: 'Software Engineer'
        };
        
        // Update profile information on page
        updateProfileDisplay(profileData);
    }

    function updateProfileDisplay(data) {
        const nameElement = document.querySelector('#profileName');
        const ageElement = document.querySelector('#profileAge');
        const locationElement = document.querySelector('#profileLocation');
        
        if (nameElement) nameElement.textContent = data.name;
        if (ageElement) ageElement.textContent = `${data.age} years`;
        if (locationElement) locationElement.textContent = data.location;
    }

    function loadDashboardData() {
        // Load user's dashboard statistics
        const userEmail = localStorage.getItem('userEmail');
        if (userEmail) {
            document.querySelector('#userEmail').textContent = userEmail;
        }
        
        // Load recent activity, matches, etc.
        // This would be populated from API in a real application
    }

    console.log('BandBazaBarat application initialized successfully');
});

// Utility functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR',
        minimumFractionDigits: 0
    }).format(amount);
}

function formatDate(date) {
    return new Intl.DateTimeFormat('en-IN', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(new Date(date));
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    const re = /^[6-9]\d{9}$/;
    return re.test(phone);
}

// Export functions for global access
window.BandBazaBarat = {
    showNotification,
    sendInterest,
    addToShortlist,
    viewProfile,
    upgradeMembership,
    formatCurrency,
    formatDate,
    validateEmail,
    validatePhone
};
