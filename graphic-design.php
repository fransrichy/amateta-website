<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/graphic-design.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - Graphic Design Services</title>
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
            padding-top: 80px; /* Space for fixed navbar */
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
            Hero Section
            --------------------------------- */
        .page-hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%2300b4d8" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center;
            background-size: cover;
            color: var(--white);
            padding: 120px 0;
            min-height: 40vh;
            display: flex;
            align-items: center;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
            position: relative;
            overflow: hidden;
        }

        .page-hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%2300b4d8" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center;
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        /* ---------------------------------
            Floating WhatsApp Button
            --------------------------------- */
        #whatsapp-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #06014b;
            color: var(--white);
            border: none;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 1.1rem;
            font-weight: 700;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            animation: pulse 2.5s infinite;
            transition: transform 0.2s;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        #whatsapp-btn:hover {
            transform: scale(1.05);
            background-color: #00c3ff;
        }
        
        #whatsapp-btn i {
            margin-right: 8px;
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5); }
            50% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
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
            Graphic Design Service Styles
            --------------------------------- */
        .service-detail-section {
            padding: 80px 0;
        }
        
        .service-category {
            margin-bottom: 4rem;
        }
        
        .category-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .category-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        
        .category-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--light-blue);
        }
        
        .category-description {
            font-size: 1.2rem;
            color: var(--dark-gray);
            max-width: 600px;
            margin: 0 auto;
        }
        
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
        
        .process-section {
            padding: 80px 0;
            background-color: var(--light-gray);
        }
        
        .process-step {
            text-align: center;
            padding: 2rem;
        }
        
        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--accent-blue) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .step-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }
        
        .step-description {
            color: var(--dark-gray);
            line-height: 1.6;
        }
        
        .portfolio-showcase {
            padding: 80px 0;
        }
        
        .portfolio-item {
            margin-bottom: 30px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            background-color: var(--white);
        }
        
        .portfolio-item:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }
        
        .portfolio-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .portfolio-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(10, 37, 64, 0.8), rgba(0, 180, 216, 0.8));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 20px;
            text-align: center;
        }
        
        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }
        
        .portfolio-title {
            color: var(--white);
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        
        .portfolio-category-tag {
            color: var(--light-blue);
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        
        .portfolio-link {
            color: var(--white);
            background-color: var(--light-blue);
            padding: 8px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .portfolio-link:hover {
            background-color: var(--white);
            color: var(--primary-blue);
        }
        
        .portfolio-info {
            padding: 1.5rem;
        }
        
        .portfolio-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .portfolio-info p {
            color: var(--dark-gray);
            margin-bottom: 1rem;
        }
        
        .pricing-section {
            padding: 80px 0;
            background-color: var(--light-gray);
        }
        
        .pricing-card {
            background-color: var(--white);
            padding: 2.5rem 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .pricing-card.featured {
            border: 2px solid var(--light-blue);
            transform: scale(1.05);
        }
        
        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }
        
        .pricing-card.featured:hover {
            transform: translateY(-8px) scale(1.05);
        }
        
        .pricing-header {
            margin-bottom: 2rem;
        }
        
        .pricing-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }
        
        .pricing-price {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--light-blue);
            margin-bottom: 0.5rem;
        }
        
        .pricing-period {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }
        
        .pricing-features {
            margin-bottom: 2rem;
        }
        
        .pricing-feature {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .pricing-feature i {
            color: var(--light-blue);
            margin-right: 0.5rem;
        }
        
        .featured-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--light-blue);
            color: var(--white);
            padding: 8px 15px;
            font-size: 0.8rem;
            font-weight: 700;
            border-bottom-left-radius: 12px;
        }

        /* ---------------------------------
            Stats Section
            --------------------------------- */
        .stats-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--accent-blue) 100%);
            color: var(--white);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* ---------------------------------
            Footer Style
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

        .newsletter-form input[type="email"] {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 6px;
            margin-bottom: 10px;
            color: var(--primary-blue);
            background-color: var(--white);
        }

        .newsletter-form button {
            width: 100%;
            padding: 12px 15px;
            background-color: var(--light-blue);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .newsletter-form button:hover {
            background-color: var(--accent-blue);
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
            
            .page-hero-section {
                padding: 80px 0;
                min-height: 30vh;
            }
            
            .page-hero-section h1 {
                font-size: 2.2rem;
            }
            
            .page-hero-section p.lead {
                font-size: 1.1rem;
            }
            
            #whatsapp-btn {
                bottom: 15px;
                right: 15px;
                padding: 12px 20px;
                font-size: 1rem;
            }
            
            .service-card, .portfolio-item {
                margin-bottom: 20px;
            }
            
            .pricing-card.featured {
                transform: scale(1);
            }
            
            .pricing-card.featured:hover {
                transform: translateY(-8px);
            }
            
            .stats-grid .col-md-3 {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 768px) {
            .page-hero-section h1 {
                font-size: 1.8rem;
            }
            
            .section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</head>
<body>

    <a href="https://wa.me/264853441248?text=Hello%20AMATETA%20Techs%20%26%20Designs,%20I%20would%20like%20to%20get%20more%20information%20about%20your%20graphic%20design%20services" id="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i> WhatsApp Us
    </a>

    <?php render_nav('services'); ?>

    <main>
        
        <section class="page-hero-section">
            <div class="container text-center hero-content">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">Graphic Design Services</h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Creative visual solutions that transform your brand identity and captivate your audience</p>
                <div data-aos="fade-up" data-aos-delay="200">
                    <a href="#services" class="btn cta-btn-primary btn-lg me-3">View Our Services</a>
                    <a href="contact.php" class="btn cta-btn-secondary btn-lg">Get Free Consultation</a>
                </div>
            </div>
        </section>

        <section id="services" class="service-detail-section">
            <div class="container">
                <!-- Brand Identity Design Category -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Brand Identity Design</h2>
                        <p class="category-description">Comprehensive branding solutions that establish your unique identity in the market</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-palette"></i>
                                    <h4 class="fw-bold mb-3">Logo Design</h4>
                                    <p class="mb-4">Unique, memorable logos that capture your brand essence and make a lasting impression.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Custom Logo Concepts</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Multiple Design Options</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Brand Color Palette</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Final Logo Files</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-id-card"></i>
                                    <h4 class="fw-bold mb-3">Business Stationery</h4>
                                    <p class="mb-4">Professional business cards, letterheads, and envelopes that reflect your brand identity.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Business Card Design</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Letterhead Design</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Envelope Design</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Email Signature</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-book"></i>
                                    <h4 class="fw-bold mb-3">Brand Guidelines</h4>
                                    <p class="mb-4">Comprehensive brand manuals that ensure consistent application of your visual identity.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Logo Usage Rules</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Color Specifications</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Typography Guidelines</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Brand Voice & Tone</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Marketing Materials Category -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Marketing & Advertising Design</h2>
                        <p class="category-description">Eye-catching designs that drive engagement and convert viewers into customers</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-bullhorn"></i>
                                    <h4 class="fw-bold mb-3">Social Media Graphics</h4>
                                    <p class="mb-4">Engaging visuals optimized for social platforms that boost your online presence.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Facebook & Instagram Posts</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Twitter Headers</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> LinkedIn Banners</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Story & Reel Graphics</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-newspaper"></i>
                                    <h4 class="fw-bold mb-3">Brochures & Flyers</h4>
                                    <p class="mb-4">Informative and visually appealing print materials that effectively communicate your message.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Tri-Fold Brochures</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Product Flyers</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Event Posters</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Sales Sheets</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-ad"></i>
                                    <h4 class="fw-bold mb-3">Digital Ads & Banners</h4>
                                    <p class="mb-4">High-converting digital advertisements designed for various platforms and screen sizes.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Google Display Ads</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Social Media Ads</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Website Banners</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Email Marketing Graphics</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Print & Packaging Category -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Print & Packaging Design</h2>
                        <p class="category-description">Professional designs that enhance your physical products and marketing materials</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-box-open"></i>
                                    <h4 class="fw-bold mb-3">Product Packaging</h4>
                                    <p class="mb-4">Eye-catching packaging designs that stand out on shelves and protect your products.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Box & Container Design</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Label Design</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Die-Cut Templates</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Print-Ready Files</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-file-alt"></i>
                                    <h4 class="fw-bold mb-3">Corporate Documents</h4>
                                    <p class="mb-4">Professionally designed business documents that reflect your company's credibility.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Company Profiles</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Annual Reports</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Presentation Decks</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Proposal Templates</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-card">
                                <div class="service-card-content text-center">
                                    <i class="fas fa-tshirt"></i>
                                    <h4 class="fw-bold mb-3">Merchandise Design</h4>
                                    <p class="mb-4">Creative designs for promotional products that increase brand visibility and loyalty.</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li><i class="fas fa-check text-light-blue me-2"></i> T-Shirt & Apparel</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Mug & Drinkware</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Tote Bags & Accessories</li>
                                        <li><i class="fas fa-check text-light-blue me-2"></i> Promotional Items</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Design Process Section -->
        <section class="process-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Our Design Process</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">A structured approach that ensures your vision becomes reality</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                        <div class="process-step">
                            <div class="step-number">1</div>
                            <h3 class="step-title">Discovery & Research</h3>
                            <p class="step-description">We begin by understanding your business, target audience, and design requirements through detailed consultation.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="process-step">
                            <div class="step-number">2</div>
                            <h3 class="step-title">Concept Development</h3>
                            <p class="step-description">Our designers create multiple concepts and present initial design directions for your feedback and approval.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="process-step">
                            <div class="step-number">3</div>
                            <h3 class="step-title">Design & Refinement</h3>
                            <p class="step-description">We refine the selected concept based on your feedback, ensuring every detail aligns with your vision.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="process-step">
                            <div class="step-number">4</div>
                            <h3 class="step-title">Final Delivery</h3>
                            <p class="step-description">We deliver the final design files in all required formats, along with guidelines for implementation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio Showcase Section -->
        <section class="portfolio-showcase">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Our Graphic Design Portfolio</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Showcasing our creative work across various industries and design categories</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="portfolio-item">
                            <img src="images/Lavital.jpg" alt="LAVITAL Brand Identity" class="portfolio-img">
                            <div class="portfolio-overlay">
                                <h3 class="portfolio-title">LAVITAL Investments</h3>
                                <p class="portfolio-category-tag">Brand Identity</p>
                                <p class="text-white mb-3">Complete corporate branding including logo, stationery, and marketing materials</p>
                                <a href="portfolio.php" class="portfolio-link">View Project</a>
                            </div>
                            <div class="portfolio-info">
                                <h3>LAVITAL Investments Branding</h3>
                                <p>Complete corporate identity package including logo design, business cards, and marketing collateral.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="portfolio-item">
                            <img src="images/Ads.jpg" alt="Marketing Campaign Ads" class="portfolio-img">
                            <div class="portfolio-overlay">
                                <h3 class="portfolio-title">Marketing Campaign</h3>
                                <p class="portfolio-category-tag">Advertising Design</p>
                                <p class="text-white mb-3">Series of promotional posters and digital ads for various marketing campaigns</p>
                                <a href="portfolio.php" class="portfolio-link">View Project</a>
                            </div>
                            <div class="portfolio-info">
                                <h3>Marketing Campaign Ads</h3>
                                <p>Series of promotional posters and digital ads designed for maximum engagement and conversion.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="portfolio-item">
                            <img src="images/business-card-2.jpg" alt="Business Card Designs" class="portfolio-img">
                            <div class="portfolio-overlay">
                                <h3 class="portfolio-title">Business Card Collection</h3>
                                <p class="portfolio-category-tag">Print Design</p>
                                <p class="text-white mb-3">Professional business card designs for various industries and professions</p>
                                <a href="portfolio.php" class="portfolio-link">View Project</a>
                            </div>
                            <div class="portfolio-info">
                                <h3>Business Card Collection</h3>
                                <p>A collection of professionally designed business cards with various styles and finishes.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4" data-aos="fade-up">
                    <a href="portfolio.php" class="btn cta-btn-primary btn-lg">View Full Portfolio</a>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section class="pricing-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Graphic Design Packages</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Flexible pricing options to suit your design needs and budget</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-title">Starter Package</h3>
                                <div class="pricing-price">N$ 1,500</div>
                                <div class="pricing-period">One-time project</div>
                            </div>
                            <div class="pricing-features">
                                <div class="pricing-feature"><i class="fas fa-check"></i> Single Design Concept</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> 2 Revisions</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> Source Files</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> 5-7 Day Turnaround</div>
                                <div class="pricing-feature"><i class="fas fa-times"></i> Brand Guidelines</div>
                            </div>
                            <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card featured">
                            <div class="featured-badge">Most Popular</div>
                            <div class="pricing-header">
                                <h3 class="pricing-title">Professional Package</h3>
                                <div class="pricing-price">N$ 3,500</div>
                                <div class="pricing-period">One-time project</div>
                            </div>
                            <div class="pricing-features">
                                <div class="pricing-feature"><i class="fas fa-check"></i> 3 Design Concepts</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> Unlimited Revisions</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> Source Files</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> 7-10 Day Turnaround</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> Basic Brand Guidelines</div>
                            </div>
                            <a href="contact.php" class="btn cta-btn-primary">Get Started</a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-title">Enterprise Package</h3>
                                <div class="pricing-price">N$ 7,000+</div>
                                <div class="pricing-period">Custom project</div>
                            </div>
                            <div class="pricing-features">
                                <div class="pricing-feature"><i class="fas fa-check"></i> Complete Brand Identity</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> Unlimited Revisions</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> All Source Files</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> 14-21 Day Turnaround</div>
                                <div class="pricing-feature"><i class="fas fa-check"></i> Comprehensive Brand Guidelines</div>
                            </div>
                            <a href="contact.php" class="btn cta-btn-primary">Get Quote</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4" data-aos="fade-up">
                    <p class="text-muted">All packages include consultation, design process, and final delivery. Contact us for custom requirements.</p>
                </div>
            </div>
        </section>

        <section class="stats-section">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up">
                        <div class="stat-item">
                            <div class="stat-number">200+</div>
                            <div class="stat-label">Design Projects</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-item">
                            <div class="stat-number">98%</div>
                            <div class="stat-label">Client Satisfaction</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-item">
                            <div class="stat-number">5+</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Design Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 text-center text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
            <div class="container" data-aos="zoom-in">
                <h2 class="fw-bold mb-3">Ready to Transform Your Visual Identity?</h2>
                <p class="lead mb-4">Let's create stunning designs that elevate your brand and captivate your audience.</p>
                <a href="contact.php" class="btn cta-btn-primary btn-lg">
                    <i class="far fa-calendar-check me-2"></i> START YOUR DESIGN PROJECT
                </a>
            </div>
        </section>

    </main>

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