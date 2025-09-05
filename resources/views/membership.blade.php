@extends('layouts.app')
@section('content')
  <style>
        .membership-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .membership-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .membership-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 5 L60 35 L90 35 L68 55 L78 85 L50 65 L22 85 L32 55 L10 35 L40 35 Z' fill='%23FFFFFF' fill-opacity='0.1'/%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }
        
        .membership-content {
            position: relative;
            z-index: 1;
        }
        
        .pricing-cards {
            margin-top: -2rem;
            position: relative;
            z-index: 2;
        }
        
        .pricing-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            height: 100%;
            transition: var(--transition);
            position: relative;
        }
        
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .pricing-card.popular {
            border: 3px solid var(--accent-gold);
        }
        
        .popular-badge {
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent-gold);
            color: var(--text-dark);
            padding: 0.5rem 2rem;
            border-radius: 0 0 15px 15px;
            font-weight: 700;
            font-size: 0.9rem;
            z-index: 3;
        }
        
        .pricing-header {
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        
        .free-header {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: var(--white);
        }
        
        .gold-header {
            background: linear-gradient(135deg, var(--maroon), var(--deep-pink));
            color: var(--white);
        }
        
        .diamond-header {
            background: linear-gradient(135deg, var(--accent-gold), #ffd700);
            color: var(--text-dark);
        }
        
        .platinum-header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: var(--white);
        }
        
        .plan-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .plan-subtitle {
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
        
        .plan-price {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .plan-duration {
            opacity: 0.8;
            margin-bottom: 1rem;
        }
        
        .plan-savings {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .pricing-features {
            padding: 0 2rem 2rem;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .feature-item:last-child {
            border-bottom: none;
        }
        
        .feature-icon {
            width: 20px;
            margin-right: 1rem;
            color: #28a745;
        }
        
        .feature-icon.unavailable {
            color: #dc3545;
        }
        
        .feature-text {
            flex: 1;
            color: var(--text-dark);
        }
        
        .feature-text.unavailable {
            color: var(--muted);
            text-decoration: line-through;
        }
        
        .pricing-footer {
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }
        
        .btn-choose-plan {
            width: 100%;
            padding: 1rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        
        .btn-free {
            background: #6c757d;
            border: none;
            color: var(--white);
        }
        
        .btn-free:hover {
            background: #495057;
            color: var(--white);
        }
        
        .btn-gold {
            background: linear-gradient(135deg, var(--maroon), var(--deep-pink));
            border: none;
            color: var(--white);
        }
        
        .btn-gold:hover {
            background: linear-gradient(135deg, var(--deep-pink), var(--maroon));
            color: var(--white);
        }
        
        .btn-diamond {
            background: linear-gradient(135deg, var(--accent-gold), #ffd700);
            border: none;
            color: var(--text-dark);
        }
        
        .btn-diamond:hover {
            background: linear-gradient(135deg, #ffd700, var(--accent-gold));
            color: var(--text-dark);
        }
        
        .btn-platinum {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            border: none;
            color: var(--white);
        }
        
        .btn-platinum:hover {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: var(--white);
        }
        
        .comparison-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin: 4rem 0;
        }
        
        .comparison-table {
            overflow-x: auto;
        }
        
        .table th {
            background: var(--light-bg);
            border: none;
            font-weight: 600;
            color: var(--maroon);
            padding: 1rem;
        }
        
        .table td {
            border: none;
            padding: 1rem;
            text-align: center;
        }
        
        .table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .check-icon {
            color: #28a745;
            font-size: 1.2rem;
        }
        
        .cross-icon {
            color: #dc3545;
            font-size: 1.2rem;
        }
        
        .payment-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .payment-method {
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .payment-method:hover,
        .payment-method.selected {
            border-color: var(--maroon);
            background: var(--light-bg);
        }
        
        .payment-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--maroon);
        }
        
        .testimonials-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .testimonial-card {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            position: relative;
        }
        
        .testimonial-quote {
            font-style: italic;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }
        
        .testimonial-author {
            font-weight: 600;
            color: var(--maroon);
        }
        
        .testimonial-plan {
            color: var(--muted);
            font-size: 0.9rem;
        }
        
        .faq-section {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .accordion-button {
            color: var(--maroon);
            font-weight: 500;
        }
        
        .accordion-button:not(.collapsed) {
            background: var(--light-bg);
            color: var(--maroon);
        }
        
        @media (max-width: 768px) {
            .membership-container {
                padding: 1rem;
            }
            
            .membership-header {
                padding: 2rem 0;
            }
            
            .pricing-cards {
                margin-top: 1rem;
            }
            
            .plan-price {
                font-size: 2rem;
            }
            
            .comparison-table {
                font-size: 0.9rem;
            }
            
            .table th,
            .table td {
                padding: 0.5rem;
            }
        }

        @keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
    </style>

    <div class="membership-container">
        <!-- Header Section -->
        <div class="membership-header">
            <div class="container">
                <div class="membership-content">
                    <h1><i class="fas fa-crown me-3"></i>Choose Your Perfect Plan</h1>
                    <p class="lead">Unlock premium features and find your life partner faster with our exclusive membership plans</p>
                    <div class="row mt-4">
                        <div class="col-md-3 col-6">
                            <div class="stat-item text-center">
                                <div class="fs-2 fw-bold">2M+</div>
                                <div>Success Stories</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item text-center">
                                <div class="fs-2 fw-bold">5M+</div>
                                <div>Verified Profiles</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item text-center">
                                <div class="fs-2 fw-bold">15+</div>
                                <div>Years Experience</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item text-center">
                                <div class="fs-2 fw-bold">100%</div>
                                <div>Privacy Protected</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="container">
        <!-- Pricing Cards -->
        <div class="pricing-cards">
            <div class="row g-4">
                @foreach($plans as $plan)
                <div class="col-lg-3 col-md-6">
                    <div class="pricing-card {{ $plan['name'] === 'Diamond' ? 'popular' : '' }}">
                        @if($plan['name'] === 'Diamond')
                            <div class="popular-badge">Most Popular</div>
                        @endif

                        <div class="pricing-header {{ strtolower($plan['name']) }}-header">
                            <div class="plan-name">{{ $plan['name'] }}</div>
                            <div class="plan-subtitle">{{ $plan['description'] ?? '' }}</div>
                            <div class="plan-price">₹{{ number_format($plan['price'], 2) }}</div>
                            <div class="plan-duration">{{ $plan['duration_days'] }} Days</div>
                        </div>

                        <div class="pricing-features">
                            <ul class="feature-list">
                                {{-- Included Features --}}
                                @foreach($plan['features'] as $feature)
                                    <li class="feature-item">
                                        <i class="fas fa-check feature-icon"></i>
                                        <span class="feature-text">{{ $feature }}</span>
                                    </li>
                                @endforeach

                                {{-- Excluded Features --}}
                                @foreach($plan['excluded_features'] as $feature)
                                    <li class="feature-item">
                                        <i class="fas fa-times feature-icon unavailable"></i>
                                        <span class="feature-text unavailable">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="pricing-footer">
    <button 
        class="btn btn-choose-plan btn-{{ strtolower($plan['name']) }} {{ $plan['plan_id'] == $userPremiumPlanId ? 'btn-current' : '' }}" 
        onclick="selectPlan({{ json_encode($plan) }})"
        {{ $plan['plan_id'] == $userPremiumPlanId ? 'disabled' : '' }}
    >
        {{ $plan['plan_id'] == $userPremiumPlanId ? 'Current Plan' : "Choose {$plan['name']}" }}
    </button>
</div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Detailed Comparison Section -->
        <div class="comparison-section mt-5">
            <h3 class="text-center mb-4">Detailed Feature Comparison</h3>
            <div class="comparison-table">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Features</th>
                            @foreach($plans as $plan)
                                <th class="text-center">{{ $plan['name'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $allFeatures = [];
                        foreach($plans as $plan) {
                            foreach($plan['features'] as $feature) {
                                $allFeatures[$feature] = $allFeatures[$feature] ?? [];
                                $allFeatures[$feature][$plan['name']] = true;
                            }
                            foreach($plan['excluded_features'] as $feature) {
                                $allFeatures[$feature] = $allFeatures[$feature] ?? [];
                                $allFeatures[$feature][$plan['name']] = false;
                            }
                        }
                    @endphp

                    @foreach($allFeatures as $featureName => $availability)
                        <tr>
                            <td><strong>{{ $featureName }}</strong></td>
                            @foreach($plans as $plan)
                                <td class="text-center">
                                    <i class="fas fa-{{ $availability[$plan['name']] ?? false ? 'check' : 'times' }} check-icon"></i>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

            <!-- Payment Methods -->
           

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Complete Your Purchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-credit-card fs-1 text-primary mb-3"></i>
                    <h5 id="selectedPlan">Plan Name</h5>
                    <p class="text-muted" id="planDuration">Plan Duration</p>
                    <div class="fs-2 fw-bold text-success mb-3" id="planPrice">₹0</div>
                    <p class="text-muted">You are being redirected to our secure payment gateway...</p>
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="payment-section">
                <h3 class="text-center mb-4">Secure Payment Methods</h3>
                <p class="text-center text-muted mb-4">We support all major payment methods for your convenience</p>
                
                <div class="payment-methods">
                    <div class="payment-method">
                        <div class="payment-icon">
                            <i class="fab fa-cc-visa"></i>
                        </div>
                        <h6>Credit/Debit Cards</h6>
                        <p class="text-muted mb-0">Visa, MasterCard, Rupay</p>
                    </div>
                    <div class="payment-method">
                        <div class="payment-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <h6>Net Banking</h6>
                        <p class="text-muted mb-0">All major banks supported</p>
                    </div>
                    <div class="payment-method">
                        <div class="payment-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h6>UPI</h6>
                        <p class="text-muted mb-0">GPay, PhonePe, Paytm</p>
                    </div>
                    <div class="payment-method">
                        <div class="payment-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h6>Digital Wallets</h6>
                        <p class="text-muted mb-0">Paytm, Mobikwik, Freecharge</p>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <i class="fas fa-shield-alt text-success fs-2 mb-2"></i>
                            <h6>SSL Encrypted</h6>
                            <small class="text-muted">256-bit encryption</small>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-lock text-success fs-2 mb-2"></i>
                            <h6>PCI Compliant</h6>
                            <small class="text-muted">Industry standard security</small>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-undo text-success fs-2 mb-2"></i>
                            <h6>Money Back Guarantee</h6>
                            <small class="text-muted">7-day return policy</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonials -->
            <div class="testimonials-section">
                <h3 class="text-center mb-4">What Our Premium Members Say</h3>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">
                                "The Diamond plan helped me find my perfect match within 2 months. The horoscope matching feature was incredibly accurate and gave us confidence in our compatibility."
                            </div>
                            <div class="testimonial-author">Rajesh & Priya</div>
                            <div class="testimonial-plan">Diamond Member • Married in 2023</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">
                                "As a Platinum member, having a dedicated relationship manager made all the difference. They helped coordinate meetings and guided us through the entire process."
                            </div>
                            <div class="testimonial-author">Arjun & Kavya</div>
                            <div class="testimonial-plan">Platinum Member • Married in 2023</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">
                                "The Gold plan gave me access to unlimited profiles and messaging. I found my life partner within the first month of upgrading from the free plan."
                            </div>
                            <div class="testimonial-author">Neha & Vikram</div>
                            <div class="testimonial-plan">Gold Member • Married in 2024</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">
                                "BandBazaBarat's premium features are worth every penny. The profile verification and priority support made me feel secure throughout my search."
                            </div>
                            <div class="testimonial-author">Aditya & Meera</div>
                            <div class="testimonial-plan">Diamond Member • Married in 2024</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section">
                <h3 class="text-center mb-4">Frequently Asked Questions</h3>
                
                <div class="accordion" id="membershipFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                Can I upgrade or downgrade my plan anytime?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#membershipFAQ">
                            <div class="accordion-body">
                                Yes, you can upgrade your plan anytime. The price difference will be adjusted proportionally. However, downgrading is only possible at the end of your current billing cycle.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                Is there a money-back guarantee?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#membershipFAQ">
                            <div class="accordion-body">
                                Yes, we offer a 7-day money-back guarantee if you're not satisfied with our premium features. No questions asked.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                How does the relationship manager service work?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#membershipFAQ">
                            <div class="accordion-body">
                                Platinum members get a dedicated relationship manager who personally assists with profile optimization, match suggestions, and meeting coordination. They're available via phone and email during business hours.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                Are payments secure?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#membershipFAQ">
                            <div class="accordion-body">
                                Absolutely! We use 256-bit SSL encryption and are PCI DSS compliant. All payment information is processed securely through trusted payment gateways.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                What happens when my membership expires?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#membershipFAQ">
                            <div class="accordion-body">
                                Your profile remains active, but premium features are disabled. You'll revert to the free plan limitations. You can renew anytime to restore full access.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<!-- Razorpay & Modal Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function selectPlan(plan) {
    // Update modal content dynamically
    document.getElementById('selectedPlan').textContent = plan.name;
    document.getElementById('planPrice').textContent = '₹' + Number(plan.price).toLocaleString();
    document.getElementById('planDuration').textContent = plan.duration_days + ' Days';

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();

    // Create order
    fetch('/create-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ amount: plan.price * 100 }) // Razorpay in paise
    })
    .then(res => res.json())
    .then(data => {
        if (!data.order_id) return console.error('Order ID not returned');

        const options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": plan.price * 100,
            "currency": "INR",
            "name": "BandBazaBarat",
            "description": plan.name,
            "image": "/logo.png",
            "order_id": data.order_id,
            "handler": function (response) {
                fetch('/payment-success', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        plan_id: plan.plan_id
                    })
                }).then(() => {
                     modal.hide();
                    showNotification('Payment successful! Welcome to ' + plan.name, 'success');
                });
            },
            "prefill": {
                "name": "{{ Auth::user()->name ?? '' }}",
                "email": "{{ Auth::user()->email ?? '' }}",
                "contact": "{{ Auth::user()->phone ?? '' }}"
            },
            "theme": { "color": "#8B0000" }
        };

        const rzp1 = new Razorpay(options);
        rzp1.open();

        rzp1.on('payment.failed', function (response){
            modal.hide();
showNotification('Payment failed!', 'error');

        });
    })
    .catch(err => console.error('Error creating order:', err));
}

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

@endsection
