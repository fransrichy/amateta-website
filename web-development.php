<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/web-development.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Development - AMATETA Techs & Designs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="images/logo.jpg" type="image/x-icon">
    
    <style>
        :root {
            --primary-blue: #0a2540;
            --light-blue: #00b4d8;
            --accent-blue: #0077b6;
            --dark-blue: #03045e;
            --white: #ffffff;
            --light-gray: #f8fafc;
            --medium-gray: #e2e8f0;
            --dark-gray: #64748b;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--white);
            color: var(--primary-blue);
            padding-top: 80px;
        }

        /* ---------------------------------
            Navigation & Header Styles
            --------------------------------- */
        .navbar {
            background-color: var(--primary-blue);
            transition: background-color 0.3s;
            box-shadow: var(--shadow);
            z-index: 1030;
            padding: 10px 0;
        }

        .navbar.scrolled {
            padding: 5px 0;
            background-color: rgba(10, 37, 64, 0.95);
            backdrop-filter: blur(10px);
        }

        .logo-mobile-safe {
            max-height: 50px;
        }

        .navbar-brand, .nav-link {
            color: var(--white) !important;
            font-weight: 600;
            padding: 10px 15px !important;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--light-blue) !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link.active {
            font-weight: 700;
            border-bottom: 2px solid var(--light-blue);
        }

        .navbar-toggler {
            border: none;
            color: var(--white);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* ---------------------------------
            Hero Section - Matches Main Site
            --------------------------------- */
        .service-hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%2300b4d8" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center;
            background-size: cover;
            color: var(--white);
            padding: 120px 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
            position: relative;
            overflow: hidden;
        }

        .service-hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('./images/web-development-hero.jpg') no-repeat bottom center;
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        /* ---------------------------------
            General Content & CTA Styles
            --------------------------------- */
        .text-primary-color { color: var(--primary-blue) !important; }
        .text-light-blue { color: var(--light-blue) !important; }

        .cta-btn-primary {
            background-color: var(--light-blue);
            border-color: var(--light-blue);
            color: var(--white);
            transition: background-color 0.3s, transform 0.1s;
            font-weight: 600;
            padding: 12px 30px;
        }
        
        .cta-btn-primary:hover {
            background-color: var(--accent-blue);
            border-color: var(--accent-blue);
            transform: translateY(-2px);
            color: var(--white);
        }

        .cta-btn-secondary {
            background-color: transparent;
            border: 2px solid var(--white);
            color: var(--white);
            transition: background-color 0.3s, border-color 0.3s, color 0.3s, transform 0.1s;
            font-weight: 600;
            padding: 12px 30px;
        }
        
        .cta-btn-secondary:hover {
            background-color: var(--white);
            color: var(--primary-blue);
            border-color: var(--white);
            transform: translateY(-2px);
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--light-blue);
        }

        .text-center .section-title::after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        /* ---------------------------------
            Service Cards - Matches Main Site
            --------------------------------- */
        .service-card {
            background-color: var(--white);
            padding: 2.5rem 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            border-top: 5px solid var(--light-blue);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(to bottom, var(--light-blue), transparent);
            transition: height 0.3s ease;
            z-index: 0;
        }

        .service-card:hover::before {
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .service-card-content {
            position: relative;
            z-index: 1;
        }

        .service-card i {
            color: var(--light-blue);
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        /* ---------------------------------
            Domain & Hosting Cards
            --------------------------------- */
        .domain-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            border-left: 5px solid var(--light-blue);
        }

        .domain-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .domain-price {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--light-blue);
            margin: 1rem 0;
        }

        .domain-period {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }

        .hosting-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .hosting-card.featured {
            border: 2px solid var(--light-blue);
            transform: scale(1.05);
            z-index: 1;
        }

        .hosting-header {
            background: var(--primary-blue);
            color: var(--white);
            padding: 2rem;
            text-align: center;
        }

        .hosting-price {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 1.5rem 0;
        }

        .price-option {
            text-align: center;
        }

        .price-amount {
            font-size: 2rem;
            font-weight: 700;
            color: var(--white);
        }

        .price-period {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .hosting-features {
            list-style: none;
            padding: 2rem;
            margin: 0;
        }

        .hosting-features li {
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--medium-gray);
        }

        .hosting-features li:last-child {
            border-bottom: none;
        }

        .hosting-features li i {
            color: var(--light-blue);
            margin-right: 10px;
        }

        /* ---------------------------------
            Pricing Tables
            --------------------------------- */
        .pricing-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .pricing-card.featured {
            border: 2px solid var(--light-blue);
            transform: scale(1.05);
            z-index: 1;
        }

        .pricing-header {
            background: var(--primary-blue);
            color: var(--white);
            padding: 2rem;
            text-align: center;
        }

        .pricing-price {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 1rem 0;
        }

        .pricing-features {
            list-style: none;
            padding: 2rem;
            margin: 0;
        }

        .pricing-features li {
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--medium-gray);
        }

        .pricing-features li:last-child {
            border-bottom: none;
        }

        .pricing-features li i {
            color: var(--light-blue);
            margin-right: 10px;
        }

        /* ---------------------------------
            Features Grid
            --------------------------------- */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .feature-item {
            background: var(--light-gray);
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        .feature-item i {
            color: var(--light-blue);
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        /* ---------------------------------
            Domain Table
            --------------------------------- */
        .domain-table {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .domain-table-header {
            background: var(--primary-blue);
            color: var(--white);
            padding: 1.5rem;
            text-align: center;
        }

        .domain-table-body {
            padding: 0;
        }

        .domain-row {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid var(--medium-gray);
            transition: background-color 0.3s;
        }

        .domain-row:hover {
            background-color: var(--light-gray);
        }

        .domain-row:last-child {
            border-bottom: none;
        }

        .domain-extension {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-blue);
            min-width: 100px;
        }

        .domain-price-small {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--light-blue);
            margin-left: auto;
        }

        /* ---------------------------------
            Footer Style - Same as Main Site
            --------------------------------- */
        .amateta-footer {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 60px 0 20px;
            font-size: 0.9rem;
        }

        .amateta-footer h5 { 
            color: var(--light-blue); 
            margin-bottom: 20px; 
            position: relative;
            padding-bottom: 10px;
        }

        .amateta-footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--light-blue);
        }

        .amateta-footer a { 
            color: #ccc; 
            text-decoration: none; 
            display: block; 
            margin-bottom: 8px; 
            transition: color 0.2s, transform 0.2s;
            display: flex;
            align-items: center;
        }

        .amateta-footer a:hover { 
            color: var(--light-blue); 
            transform: translateX(5px);
        }

        .amateta-footer a i {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        .amateta-footer .social-icons a { 
            display: inline-block; 
            margin-right: 15px; 
            font-size: 1.5rem; 
            color: var(--white); 
            transition: color 0.2s, transform 0.2s; 
        }

        .amateta-footer .social-icons a:hover { 
            color: var(--light-blue); 
            transform: translateY(-3px);
        }

        .credit-line { 
            border-top: 1px solid rgba(255, 255, 255, 0.1); 
            padding-top: 20px; 
            margin-top: 30px; 
            text-align: center; 
            font-size: 0.8rem; 
        }

        .help-box {
            background-color: rgba(0, 180, 216, 0.2);
            padding: 20px;
            border-radius: 8px;
            margin-top: 1.5rem;
            text-align: center;
            border-left: 4px solid var(--light-blue);
        }

        .help-box h5 {
            color: var(--white);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .help-box a {
            color: var(--white);
            display: inline-block;
            background-color: var(--light-blue);
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 0.5rem;
        }

        .help-box a:hover {
            background-color: var(--accent-blue);
            transform: scale(1.05);
        }

        /* ---------------------------------
            Mobile Responsiveness
            --------------------------------- */
        @media (max-width: 992px) {
            body {
                padding-top: 70px;
            }
            
            .logo-mobile-safe {
                max-height: 40px !important;
            }
            
            .service-hero-section {
                padding: 80px 0;
                min-height: 60vh;
            }
            
            .hosting-card.featured,
            .pricing-card.featured {
                transform: none;
                margin: 1rem 0;
            }
            
            .hosting-price {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .service-hero-section h1 {
                font-size: 1.8rem;
            }
            
            .section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .domain-row {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
            
            .domain-extension {
                min-width: auto;
            }
            
            .domain-price-small {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Header -->
    <?php render_nav('services'); ?>

    <main>
        <!-- Hero Section -->
        <section class="service-hero-section">
            <div class="container hero-content">
                <div class="row align-items-center">
                    <div class="col-lg-8" data-aos="fade-right">
                        <h1 class="display-4 fw-bold mb-4">Complete Website Development & Hosting Solutions</h1>
                        <p class="lead mb-4">Everything you need for a successful online presence - from stunning website design to reliable hosting and domain services. Your complete all-in-one solution in Namibia.</p>
                        <div class="hero-features mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>Custom Website Design & Development</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>Local Namibian Hosting Provider</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>Domain Registration & Management</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>24/7 Support & Maintenance</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#web-development" class="btn cta-btn-primary btn-lg me-3">Website Packages</a>
                        <a href="#hosting-domains" class="btn cta-btn-secondary btn-lg">Hosting & Domains</a>
                    </div>
                    <div class="col-lg-4" data-aos="fade-left">
                        <img src="./images/sackaria.jpg" alt="Website Development & Hosting" class="img-fluid rounded shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <!-- Domain Registration Section -->
        <section id="domains" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title text-primary-color">🏷️ Domain Registration Services</h2>
                    <p class="lead">Secure your online identity with our competitive domain registration prices. All prices are in Namibian Dollars (N$) - no hidden fees!</p>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="domain-table">
                            <div class="domain-table-header">
                                <h4 class="mb-0">Domain Registration (Annual)</h4>
                                <p class="mb-0">Your company's online identity and website address</p>
                            </div>
                            <div class="domain-table-body">
                                <div class="domain-row">
                                    <div class="domain-extension">.com</div>
                                    <div class="domain-description">The world's most popular domain extension</div>
                                    <div class="domain-price-small">N$350 <span class="domain-period">/year</span></div>
                                </div>
                                <div class="domain-row">
                                    <div class="domain-extension">.net</div>
                                    <div class="domain-description">Great for networks and technology companies</div>
                                    <div class="domain-price-small">N$420 <span class="domain-period">/year</span></div>
                                </div>
                                <div class="domain-row">
                                    <div class="domain-extension">.org</div>
                                    <div class="domain-description">Perfect for organizations and non-profits</div>
                                    <div class="domain-price-small">N$380 <span class="domain-period">/year</span></div>
                                </div>
                                <div class="domain-row">
                                    <div class="domain-extension">.co.za</div>
                                    <div class="domain-description">South African commercial extension</div>
                                    <div class="domain-price-small">N$300 <span class="domain-period">/year</span></div>
                                </div>
                                <div class="domain-row">
                                    <div class="domain-extension">.africa</div>
                                    <div class="domain-description">Show your African pride and presence</div>
                                    <div class="domain-price-small">N$550 <span class="domain-period">/year</span></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-4 bg-white rounded shadow-sm" data-aos="fade-up" data-aos-delay="100">
                            <h5 class="fw-bold mb-3">All Domain Packages Include:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Free WHOIS Privacy Protection</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Full DNS Management</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Domain Setup & Configuration</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Email & Hosting Connection Support</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-success mt-3 mb-0">
                                <i class="fas fa-tags me-2"></i> <strong>Best Value in Namibia!</strong> Our domain prices are the most competitive and affordable in the country.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Web Hosting Packages -->
        <section id="hosting-domains" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title text-primary-color">🌍 Web Hosting Services</h2>
                    <p class="lead">Reliable local hosting solutions for small businesses, growing companies, and online platforms. We're proud to be a Namibian hosting provider, not a reseller.</p>
                </div>
                
                <div class="row">
                    <!-- Basic Hosting -->
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="hosting-card">
                            <div class="hosting-header">
                                <h4>BASIC HOSTING</h4>
                                <p>Perfect for small websites</p>
                                <div class="hosting-price">
                                    <div class="price-option">
                                        <div class="price-amount">N$150</div>
                                        <div class="price-period">per month</div>
                                    </div>
                                    <div class="price-option">
                                        <div class="price-amount">N$1,500</div>
                                        <div class="price-period">per year</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="hosting-features">
                                <li><i class="fas fa-check text-light-blue"></i> 1 Website</li>
                                <li><i class="fas fa-check text-light-blue"></i> Free SSL Certificate</li>
                                <li><i class="fas fa-check text-light-blue"></i> Business Email Accounts</li>
                                <li><i class="fas fa-check text-light-blue"></i> PHP & MySQL Support</li>
                                <li><i class="fas fa-check text-light-blue"></i> 5 GB SSD Storage</li>
                                <li><i class="fas fa-check text-light-blue"></i> 50 GB Bandwidth</li>
                            </ul>
                            <div class="p-4">
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Business Hosting (Recommended) -->
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="hosting-card featured">
                            <div class="hosting-header">
                                <h4>BUSINESS HOSTING</h4>
                                <p><strong>RECOMMENDED</strong> - Most Popular</p>
                                <div class="hosting-price">
                                    <div class="price-option">
                                        <div class="price-amount">N$220</div>
                                        <div class="price-period">per month</div>
                                    </div>
                                    <div class="price-option">
                                        <div class="price-amount">N$2,200</div>
                                        <div class="price-period">per year</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="hosting-features">
                                <li><i class="fas fa-check text-light-blue"></i> Unlimited Websites</li>
                                <li><i class="fas fa-check text-light-blue"></i> Unlimited Email Accounts</li>
                                <li><i class="fas fa-check text-light-blue"></i> Free SSL Certificate</li>
                                <li><i class="fas fa-check text-light-blue"></i> Improved Performance</li>
                                <li><i class="fas fa-check text-light-blue"></i> 20 GB SSD Storage</li>
                                <li><i class="fas fa-check text-light-blue"></i> Unlimited Bandwidth</li>
                            </ul>
                            <div class="p-4">
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Hosting -->
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="hosting-card">
                            <div class="hosting-header">
                                <h4>PREMIUM HOSTING</h4>
                                <p>For growing businesses</p>
                                <div class="hosting-price">
                                    <div class="price-option">
                                        <div class="price-amount">N$350</div>
                                        <div class="price-period">per month</div>
                                    </div>
                                    <div class="price-option">
                                        <div class="price-amount">N$3,500</div>
                                        <div class="price-period">per year</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="hosting-features">
                                <li><i class="fas fa-check text-light-blue"></i> High-Performance Hosting</li>
                                <li><i class="fas fa-check text-light-blue"></i> Faster Website Loading</li>
                                <li><i class="fas fa-check text-light-blue"></i> Priority Technical Support</li>
                                <li><i class="fas fa-check text-light-blue"></i> Suitable for E-commerce</li>
                                <li><i class="fas fa-check text-light-blue"></i> 50 GB SSD Storage</li>
                                <li><i class="fas fa-check text-light-blue"></i> Unlimited Bandwidth</li>
                            </ul>
                            <div class="p-4">
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Included Features -->
                <div class="mt-5" data-aos="fade-up">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">🔐 INCLUDED WITH ALL HOSTING PACKAGES</h4>
                    </div>
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-lock"></i>
                            <h6>Free SSL (HTTPS Security)</h6>
                            <p class="small mb-0">Secure your website with free SSL certificates</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-envelope"></i>
                            <h6>Email Setup & Configuration</h6>
                            <p class="small mb-0">Professional business email setup</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-cogs"></i>
                            <h6>DNS Management</h6>
                            <p class="small mb-0">Full control over your DNS settings</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-headset"></i>
                            <h6>Website Support</h6>
                            <p class="small mb-0">Technical support for your website</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-server"></i>
                            <h6>Secure & Reliable Servers</h6>
                            <p class="small mb-0">99.9% uptime guarantee</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Website Development Packages -->
        <section id="web-development" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title text-primary-color">Website Development Packages</h2>
                    <p class="lead">Complete web solutions including design, development, and hosting. Choose the perfect package for your business.</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h4>Starter Package</h4>
                                <div class="pricing-price">N$3999.00</div>
                                <p>Perfect for small businesses</p>
                            </div>
                            <ul class="pricing-features">
                                <li><i class="fas fa-check text-light-blue"></i> 5 Page Website</li>
                                <li><i class="fas fa-check text-light-blue"></i> Responsive Design</li>
                                <li><i class="fas fa-check text-light-blue"></i> Contact Form</li>
                                <li><i class="fas fa-check text-light-blue"></i> Basic SEO Setup</li>
                                <li><i class="fas fa-check text-light-blue"></i> Domain Registration</li>
                                <li><i class="fas fa-check text-light-blue"></i> 6 Months Basic Hosting</li>
                            </ul>
                            <div class="p-4">
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card featured">
                            <div class="pricing-header">
                                <h4>Business Package</h4>
                                <div class="pricing-price">N$5999.00</div>
                                <p>Most Popular</p>
                            </div>
                            <ul class="pricing-features">
                                <li><i class="fas fa-check text-light-blue"></i> 10 Page Website</li>
                                <li><i class="fas fa-check text-light-blue"></i> CMS Integration</li>
                                <li><i class="fas fa-check text-light-blue"></i> Advanced SEO</li>
                                <li><i class="fas fa-check text-light-blue"></i> Social Media Integration</li>
                                <li><i class="fas fa-check text-light-blue"></i> Domain Registration</li>
                                <li><i class="fas fa-check text-light-blue"></i> 1 Year Business Hosting</li>
                            </ul>
                            <div class="p-4">
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h4>Enterprise Package</h4>
                                <div class="pricing-price">N$10,999.00</div>
                                <p>For growing businesses</p>
                            </div>
                            <ul class="pricing-features">
                                <li><i class="fas fa-check text-light-blue"></i> Unlimited Pages</li>
                                <li><i class="fas fa-check text-light-blue"></i> Full E-commerce</li>
                                <li><i class="fas fa-check text-light-blue"></i> Custom Web Applications</li>
                                <li><i class="fas fa-check text-light-blue"></i> Advanced Security</li>
                                <li><i class="fas fa-check text-light-blue"></i> Priority Support</li>
                                <li><i class="fas fa-check text-light-blue"></i> 1 Year Premium Hosting</li>
                            </ul>
                            <div class="p-4">
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Complete Web Solution Features -->
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title text-primary-color">Why Choose Our Complete Solution?</h2>
                    <p class="lead">Everything you need in one place for a seamless online experience</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4" data-aos="fade-right">
                        <div class="service-card">
                            <div class="service-card-content">
                                <i class="fas fa-handshake"></i>
                                <h4 class="fw-bold mb-3">Single Point of Contact</h4>
                                <p>No more dealing with multiple providers. We handle everything from domain registration to website development and ongoing hosting.</p>
                                <ul class="mt-3">
                                    <li><i class="fas fa-check text-light-blue me-2"></i> One invoice for all services</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Dedicated account manager</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Coordinated support team</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4" data-aos="fade-left">
                        <div class="service-card">
                            <div class="service-card-content">
                                <i class="fas fa-shield-alt"></i>
                                <h4 class="fw-bold mb-3">Local Namibian Support</h4>
                                <p>As a local provider, not a reseller, we offer faster response times and better understanding of the Namibian market.</p>
                                <ul class="mt-3">
                                    <li><i class="fas fa-check text-light-blue me-2"></i> 24/7 local technical support</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Faster server response times</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Understanding of local business needs</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5 text-center text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
            <div class="container" data-aos="zoom-in">
                <h2 class="fw-bold mb-3">Ready to Launch Your Online Presence?</h2>
                <p class="lead mb-4">Get your complete web solution today - website, domain, and hosting all in one package!</p>
                <a href="contact.php" class="btn cta-btn-primary btn-lg me-3">
                    <i class="far fa-calendar-check me-2"></i> Get Free Consultation
                </a>
                <a href="tel:+264853441248" class="btn cta-btn-secondary btn-lg">
                    <i class="fas fa-phone me-2"></i> Call Us Now: +264 85 344 1248
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php render_footer(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
        });

        // Set current year in footer
        document.getElementById('year').textContent = new Date().getFullYear();

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>