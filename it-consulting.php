<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/it-consulting.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - IT Consulting Services</title>
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
            Service Cards
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
            Service Categories
            --------------------------------- */
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

        /* ---------------------------------
            Company Stamps Section
            --------------------------------- */
        .stamps-section {
            padding: 80px 20px;
            background-color: var(--white);
            text-align: center;
        }

        .stamps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .stamp-item {
            background-color: var(--light-gray);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .stamp-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stamp-icon {
            font-size: 3rem;
            color: var(--light-blue);
            margin-bottom: 1rem;
        }

        /* ---------------------------------
            IT Consulting Styles
            --------------------------------- */
        .consulting-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
        }

        .consulting-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .consulting-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .consulting-content {
            padding: 1.5rem;
        }

        .consulting-category {
            font-size: 0.9rem;
            color: var(--light-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .consulting-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }

        .consulting-features {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .consulting-features li {
            padding: 0.25rem 0;
            display: flex;
            align-items: center;
        }

        .consulting-features li i {
            color: var(--light-blue);
            margin-right: 0.5rem;
            font-size: 0.8rem;
        }

        .pricing-section {
            background-color: var(--light-gray);
            padding: 80px 0;
        }

        .pricing-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 2.5rem 2rem;
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

        .pricing-card.featured::before {
            content: 'Most Popular';
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--light-blue);
            color: var(--white);
            padding: 0.5rem 1.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            transform: rotate(45deg) translate(30%, -50%);
        }

        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .pricing-card.featured:hover {
            transform: scale(1.05) translateY(-8px);
        }

        .pricing-header {
            margin-bottom: 2rem;
        }

        .pricing-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .pricing-price {
            font-size: 3rem;
            font-weight: 700;
            color: var(--light-blue);
            margin-bottom: 0.5rem;
        }

        .pricing-period {
            color: var(--dark-gray);
            font-size: 1rem;
        }

        .pricing-features {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        .pricing-features li {
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--medium-gray);
        }

        .pricing-features li:last-child {
            border-bottom: none;
        }

        .process-section {
            padding: 80px 0;
            background-color: var(--white);
        }

        .process-step {
            text-align: center;
            padding: 2rem;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background-color: var(--light-blue);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
        }

        .step-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }

        .industries-section {
            padding: 80px 0;
            background-color: var(--light-gray);
        }

        .industry-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
        }

        .industry-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .industry-icon {
            font-size: 3rem;
            color: var(--light-blue);
            margin-bottom: 1.5rem;
        }

        .benefits-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
        }

        .benefit-item {
            text-align: center;
            padding: 2rem;
        }

        .benefit-icon {
            font-size: 3rem;
            color: var(--light-blue);
            margin-bottom: 1.5rem;
        }

        .case-studies-section {
            padding: 80px 0;
            background-color: var(--white);
        }

        .case-study-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
        }

        .case-study-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .case-study-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .case-study-content {
            padding: 1.5rem;
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
            
            .service-card {
                margin-bottom: 20px;
            }
            
            .stats-grid .col-md-3 {
                margin-bottom: 30px;
            }

            .pricing-card.featured {
                transform: scale(1);
                margin-top: 2rem;
                margin-bottom: 2rem;
            }

            .pricing-card.featured:hover {
                transform: translateY(-8px);
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

    <a href="https://wa.me/264853441248?text=Hello%20AMATETA%20Techs%20%26%20Designs,%20I%20would%20like%20to%20get%20more%20information%20about%20your%20IT%20consulting%20services" id="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i> WhatsApp Us
    </a>

    <?php render_nav('services'); ?>

    <main>
        
        <section class="page-hero-section">
            <div class="container text-center hero-content">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">IT Consulting Services</h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Strategic technology guidance to optimize your business operations, reduce costs, and drive digital transformation.</p>
                <div data-aos="fade-up" data-aos-delay="200">
                    <a href="#services" class="btn cta-btn-primary btn-lg me-3">View Services</a>
                    <a href="contact.php" class="btn cta-btn-secondary btn-lg">Free IT Assessment</a>
                </div>
            </div>
        </section>

        <section id="services" class="py-5 bg-light">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="section-title" data-aos="fade-up">Strategic IT Consulting Services</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">We provide expert guidance to help businesses leverage technology for growth, efficiency, and competitive advantage.</p>
                    </div>
                </div>

                <!-- Strategic IT Consulting Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Strategic IT Consulting</h2>
                        <p class="category-description">High-level technology strategy and planning services</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="IT Strategy Planning" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">STRATEGIC</div>
                                    <h3 class="consulting-name">IT Strategy & Roadmap</h3>
                                    <p>Comprehensive technology strategy development aligned with your business objectives.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Technology Assessment</li>
                                        <li><i class="fas fa-check"></i> Strategic Roadmap Development</li>
                                        <li><i class="fas fa-check"></i> Budget Planning & ROI Analysis</li>
                                        <li><i class="fas fa-check"></i> Implementation Planning</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Digital Transformation" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">STRATEGIC</div>
                                    <h3 class="consulting-name">Digital Transformation</h3>
                                    <p>Guide your organization through digital transformation initiatives and technology adoption.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Digital Maturity Assessment</li>
                                        <li><i class="fas fa-check"></i> Change Management Strategy</li>
                                        <li><i class="fas fa-check"></i> Technology Adoption Planning</li>
                                        <li><i class="fas fa-check"></i> Process Optimization</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Cloud Strategy" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">STRATEGIC</div>
                                    <h3 class="consulting-name">Cloud Strategy & Migration</h3>
                                    <p>Develop and execute cloud adoption strategies for improved scalability and cost efficiency.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Cloud Readiness Assessment</li>
                                        <li><i class="fas fa-check"></i> Migration Planning</li>
                                        <li><i class="fas fa-check"></i> Cost Optimization</li>
                                        <li><i class="fas fa-check"></i> Security & Compliance</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technical Consulting Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Technical Consulting</h2>
                        <p class="category-description">Expert guidance on technology infrastructure and implementation</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Network Infrastructure" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">TECHNICAL</div>
                                    <h3 class="consulting-name">Network Infrastructure</h3>
                                    <p>Design and optimize network infrastructure for performance, security, and reliability.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Network Architecture Design</li>
                                        <li><i class="fas fa-check"></i> Security Assessment</li>
                                        <li><i class="fas fa-check"></i> Performance Optimization</li>
                                        <li><i class="fas fa-check"></i> Disaster Recovery Planning</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Cybersecurity Consulting" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">TECHNICAL</div>
                                    <h3 class="consulting-name">Cybersecurity Consulting</h3>
                                    <p>Comprehensive security assessment and strategy development to protect your business.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Security Risk Assessment</li>
                                        <li><i class="fas fa-check"></i> Compliance Auditing</li>
                                        <li><i class="fas fa-check"></i> Security Policy Development</li>
                                        <li><i class="fas fa-check"></i> Incident Response Planning</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1552664688-cf412ec27db2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Software Selection" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">TECHNICAL</div>
                                    <h3 class="consulting-name">Software & Vendor Selection</h3>
                                    <p>Objective guidance in selecting the right software solutions and technology partners.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Requirements Analysis</li>
                                        <li><i class="fas fa-check"></i> Vendor Evaluation</li>
                                        <li><i class="fas fa-check"></i> Implementation Planning</li>
                                        <li><i class="fas fa-check"></i> Contract Negotiation Support</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Process Consulting Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Business Process Consulting</h2>
                        <p class="category-description">Optimizing business operations through technology-enabled process improvement</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1552664688-cf412ec27db2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Workflow Automation" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">PROCESS</div>
                                    <h3 class="consulting-name">Workflow Automation</h3>
                                    <p>Identify and implement automation opportunities to streamline business processes.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Process Analysis & Mapping</li>
                                        <li><i class="fas fa-check"></i> Automation Opportunity Assessment</li>
                                        <li><i class="fas fa-check"></i> Implementation Planning</li>
                                        <li><i class="fas fa-check"></i> ROI Analysis</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Data Analytics" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">PROCESS</div>
                                    <h3 class="consulting-name">Data Analytics & BI Strategy</h3>
                                    <p>Leverage data to drive business decisions and gain competitive insights.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Data Strategy Development</li>
                                        <li><i class="fas fa-check"></i> BI Tool Selection</li>
                                        <li><i class="fas fa-check"></i> Dashboard Design</li>
                                        <li><i class="fas fa-check"></i> Data Governance</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="consulting-card">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="IT Governance" class="consulting-img">
                                <div class="consulting-content">
                                    <div class="consulting-category">PROCESS</div>
                                    <h3 class="consulting-name">IT Governance & Compliance</h3>
                                    <p>Establish effective IT governance frameworks and ensure regulatory compliance.</p>
                                    <ul class="consulting-features">
                                        <li><i class="fas fa-check"></i> Governance Framework Design</li>
                                        <li><i class="fas fa-check"></i> Policy Development</li>
                                        <li><i class="fas fa-check"></i> Compliance Assessment</li>
                                        <li><i class="fas fa-check"></i> Risk Management</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="benefits-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title text-white" data-aos="fade-up">Benefits of IT Consulting</h2>
                        <p class="lead text-white" data-aos="fade-up" data-aos-delay="100">Partnering with our IT consultants delivers measurable business value and competitive advantage</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="step-title">Cost Optimization</h3>
                            <p>Reduce IT costs through strategic planning, vendor management, and technology optimization.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h3 class="step-title">Improved Efficiency</h3>
                            <p>Streamline operations and automate processes to increase productivity and reduce manual work.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="step-title">Enhanced Security</h3>
                            <p>Protect your business with comprehensive security strategies and compliance frameworks.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h3 class="step-title">Digital Transformation</h3>
                            <p>Modernize your technology stack and processes to stay competitive in the digital age.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h3 class="step-title">Scalable Solutions</h3>
                            <p>Implement technology solutions that grow with your business and adapt to changing needs.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3 class="step-title">Strategic Insights</h3>
                            <p>Gain valuable insights from data and technology trends to inform business decisions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Industries Section -->
        <section class="industries-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Industries We Serve</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">We provide specialized IT consulting services across various industries</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="industry-card">
                            <div class="industry-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <h3 class="step-title">Financial Services</h3>
                            <p>Compliance, security, and digital banking solutions for banks and financial institutions.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="industry-card">
                            <div class="industry-icon">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            <h3 class="step-title">Healthcare</h3>
                            <p>HIPAA compliance, EHR systems, and healthcare technology optimization.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="industry-card">
                            <div class="industry-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 class="step-title">Retail & E-commerce</h3>
                            <p>E-commerce platforms, inventory management, and customer experience optimization.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="industry-card">
                            <div class="industry-icon">
                                <i class="fas fa-industry"></i>
                            </div>
                            <h3 class="step-title">Manufacturing</h3>
                            <p>Supply chain optimization, IoT integration, and production process automation.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="industry-card">
                            <div class="industry-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h3 class="step-title">Education</h3>
                            <p>Learning management systems, campus technology, and digital transformation.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="industry-card">
                            <div class="industry-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h3 class="step-title">Logistics & Transportation</h3>
                            <p>Fleet management, route optimization, and supply chain technology solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Case Studies Section -->
        <section class="case-studies-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Success Stories</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">See how our IT consulting has helped businesses achieve their technology goals</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="case-study-card">
                            <img src="https://images.unsplash.com/photo-1565689228866-1d7af8a1047d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Manufacturing Case Study" class="case-study-img">
                            <div class="case-study-content">
                                <h4>Manufacturing Company Digital Transformation</h4>
                                <p class="text-light-blue mb-2">45% increase in production efficiency</p>
                                <p>Implemented IoT sensors and automated production tracking systems, reducing manual data entry by 80% and improving real-time monitoring capabilities.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="case-study-card">
                            <img src="https://images.unsplash.com/photo-1552664688-cf412ec27db2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Retail Case Study" class="case-study-img">
                            <div class="case-study-content">
                                <h4>Retail Chain Cloud Migration</h4>
                                <p class="text-light-blue mb-2">30% reduction in IT infrastructure costs</p>
                                <p>Migrated from on-premise servers to cloud infrastructure, improving scalability and reducing maintenance overhead while enhancing data security.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="case-study-card">
                            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Financial Services Case Study" class="case-study-img">
                            <div class="case-study-content">
                                <h4>Financial Services Security Overhaul</h4>
                                <p class="text-light-blue mb-2">100% compliance with regulatory requirements</p>
                                <p>Implemented comprehensive security framework, multi-factor authentication, and data encryption, significantly reducing security risks and ensuring compliance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Consulting Process Section -->
        <section class="process-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Our Consulting Approach</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">We follow a structured methodology to ensure successful technology outcomes</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                        <div class="process-step">
                            <div class="step-number">1</div>
                            <h3 class="step-title">Discovery & Assessment</h3>
                            <p>Comprehensive analysis of your current technology landscape, business processes, and objectives.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="process-step">
                            <div class="step-number">2</div>
                            <h3 class="step-title">Strategy Development</h3>
                            <p>Create tailored technology roadmap aligned with your business goals and budget constraints.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="process-step">
                            <div class="step-number">3</div>
                            <h3 class="step-title">Implementation Planning</h3>
                            <p>Detailed project planning, resource allocation, and timeline development for execution.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="process-step">
                            <div class="step-number">4</div>
                            <h3 class="step-title">Ongoing Support</h3>
                            <p>Continuous monitoring, optimization, and strategic guidance to ensure long-term success.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section class="pricing-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="section-title" data-aos="fade-up">IT Consulting Engagement Models</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Flexible engagement options to meet your specific consulting needs</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Project-Based</h3>
                                <div class="pricing-price">Custom</div>
                                <div class="pricing-period">Fixed Scope</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Defined Project Scope</li>
                                <li>Fixed Timeline & Budget</li>
                                <li>Deliverable-Based</li>
                                <li>Ideal for Specific Initiatives</li>
                                <li>Quality Assurance Included</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card featured">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Retainer Model</h3>
                                <div class="pricing-price">$2,500/mo</div>
                                <div class="pricing-period">Ongoing Support</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Monthly Retainer Fee</li>
                                <li>Dedicated Consultant</li>
                                <li>Flexible Hours Allocation</li>
                                <li>Strategic Advisory</li>
                                <li>Priority Support</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Fractional CTO</h3>
                                <div class="pricing-price">$4,500/mo</div>
                                <div class="pricing-period">Executive Leadership</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Part-Time Technology Leadership</li>
                                <li>Strategic Technology Planning</li>
                                <li>Team Management Guidance</li>
                                <li>Vendor & Budget Oversight</li>
                                <li>Board-Level Reporting</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted">*All engagements include initial assessment and strategy session. Custom packages available for enterprise clients.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Stamps Section -->
        <section class="stamps-section">
            <div class="container">
                <h2 class="text-4xl font-bold mb-4 text-primary-color">Why Choose AMATETA for IT Consulting?</h2>
                <p class="text-xl max-w-2xl mx-auto mb-8">We combine technical expertise with business acumen to deliver technology solutions that drive real business value</p>
                
                <div class="stamps-grid">
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Business-Focused Approach</h3>
                        <p>Technology solutions aligned with your business objectives and ROI targets</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Expert Team</h3>
                        <p>Certified consultants with diverse industry experience and technical expertise</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Vendor-Neutral Advice</h3>
                        <p>Objective recommendations based on your needs, not vendor partnerships</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Proven Methodology</h3>
                        <p>Structured approach that ensures successful project delivery and outcomes</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Security & Compliance</h3>
                        <p>Expertise in implementing secure solutions that meet regulatory requirements</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Ongoing Partnership</h3>
                        <p>Long-term relationships focused on your continued success and growth</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 text-center text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
            <div class="container" data-aos="zoom-in">
                <h2 class="fw-bold mb-3">Ready to Transform Your Technology Strategy?</h2>
                <p class="lead mb-4">Contact us today for a free IT assessment and discover how our consulting services can drive your business forward.</p>
                <a href="contact.php" class="btn cta-btn-primary btn-lg me-3">
                    <i class="fas fa-laptop-code me-2"></i> FREE IT ASSESSMENT
                </a>
                <a href="tel:+264853441248" class="btn cta-btn-secondary btn-lg">
                    <i class="fas fa-phone me-2"></i> CALL OUR CONSULTANTS
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

        // Cookie consent functionality
        document.addEventListener('DOMContentLoaded', function() {
            const cookieConsent = document.getElementById('cookieConsent');
            const acceptCookies = document.getElementById('acceptCookies');
            const declineCookies = document.getElementById('declineCookies');
            
            // Check if user has already made a choice
            if (!localStorage.getItem('cookiesAccepted')) {
                setTimeout(() => {
                    cookieConsent.classList.add('show');
                }, 1000);
            }
            
            acceptCookies.addEventListener('click', function() {
                localStorage.setItem('cookiesAccepted', 'true');
                cookieConsent.classList.remove('show');
            });
            
            declineCookies.addEventListener('click', function() {
                localStorage.setItem('cookiesAccepted', 'false');
                cookieConsent.classList.remove('show');
            });
        });
    </script>

</body>
</html>