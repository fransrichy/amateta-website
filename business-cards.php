<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/business-cards.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - Business Cards Printing</title>
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
            Business Cards Styles
            --------------------------------- */
        .business-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
        }

        .business-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .business-card-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .business-card-content {
            padding: 1.5rem;
        }

        .business-card-category {
            font-size: 0.9rem;
            color: var(--light-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .business-card-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }

        .business-card-features {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .business-card-features li {
            padding: 0.25rem 0;
            display: flex;
            align-items: center;
        }

        .business-card-features li i {
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

        .finishes-section {
            padding: 80px 0;
            background-color: var(--light-gray);
        }

        .finish-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
        }

        .finish-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .finish-icon {
            font-size: 3rem;
            color: var(--light-blue);
            margin-bottom: 1.5rem;
        }

        .card-showcase {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
        }

        .showcase-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow-xl);
            margin: 2rem 0;
            color: var(--primary-blue);
            transition: all 0.3s ease;
        }

        .showcase-card:hover {
            transform: translateY(-5px);
        }

        .card-preview {
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            padding: 2rem;
            margin: 1rem 0;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
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

    <a href="https://wa.me/264853441248?text=Hello%20AMATETA%20Techs%20%26%20Designs,%20I%20would%20like%20to%20get%20more%20information%20about%20your%20business%20cards%20printing%20services" id="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i> WhatsApp Us
    </a>

    <?php render_nav('services'); ?>

    <main>
        
        <section class="page-hero-section">
            <div class="container text-center hero-content">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">Business Cards Printing</h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Make a lasting impression with professionally designed and printed business cards that reflect your brand's quality and professionalism.</p>
                <div data-aos="fade-up" data-aos-delay="200">
                    <a href="#cards" class="btn cta-btn-primary btn-lg me-3">View Card Options</a>
                    <a href="contact.php" class="btn cta-btn-secondary btn-lg">Design My Card</a>
                </div>
            </div>
        </section>

        <section id="cards" class="py-5 bg-light">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="section-title" data-aos="fade-up">Premium Business Card Options</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Choose from our wide range of business card options, from standard to premium finishes that make your card stand out.</p>
                    </div>
                </div>

                <!-- Standard Business Cards Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Standard Business Cards</h2>
                        <p class="category-description">High-quality standard cards perfect for everyday professional use</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="business-card">
                                <img src="./images/Glossy Finish Cards.webp" alt="Standard Glossy Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">STANDARD</div>
                                    <h3 class="business-card-name">Glossy Finish Cards</h3>
                                    <p>Professional glossy finish that makes colors pop and creates a vibrant appearance.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> 350gsm Premium Card Stock</li>
                                        <li><i class="fas fa-check"></i> High-Gloss Coating</li>
                                        <li><i class="fas fa-check"></i> Full Color Both Sides</li>
                                        <li><i class="fas fa-check"></i> Standard Rounded Corners</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="business-card">
                                <img src="./images/Matte Finish Cards.jpg" alt="Matte Finish Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">STANDARD</div>
                                    <h3 class="business-card-name">Matte Finish Cards</h3>
                                    <p>Elegant matte finish that provides a sophisticated, non-reflective surface.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> 350gsm Premium Card Stock</li>
                                        <li><i class="fas fa-check"></i> Soft-Touch Matte Coating</li>
                                        <li><i class="fas fa-check"></i> Full Color Both Sides</li>
                                        <li><i class="fas fa-check"></i> Easy to Write On</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="business-card">
                                <img src="./images/Uncoated Cards.png" alt="Uncoated Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">STANDARD</div>
                                    <h3 class="business-card-name">Uncoated Cards</h3>
                                    <p>Natural uncoated paper with a classic, professional feel perfect for writing.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> 300gsm Uncoated Card Stock</li>
                                        <li><i class="fas fa-check"></i> Natural Paper Texture</li>
                                        <li><i class="fas fa-check"></i> Ideal for Handwritten Notes</li>
                                        <li><i class="fas fa-check"></i> Eco-Friendly Option</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Premium Business Cards Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Premium Business Cards</h2>
                        <p class="category-description">Luxury cards with special finishes that make a powerful statement</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="business-card">
                                <img src="./images/Spot UV Cards.jpg" alt="Spot UV Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">PREMIUM</div>
                                    <h3 class="business-card-name">Spot UV Cards</h3>
                                    <p>Selective glossy coating on specific areas that creates stunning visual contrast.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> 400gsm Premium Card Stock</li>
                                        <li><i class="fas fa-check"></i> Selective Glossy Coating</li>
                                        <li><i class="fas fa-check"></i> Matte Background</li>
                                        <li><i class="fas fa-check"></i> High-Impact Design</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="business-card">
                                <img src="./images/Foil Stamped Cards.jpg" alt="Foil Stamped Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">PREMIUM</div>
                                    <h3 class="business-card-name">Foil Stamped Cards</h3>
                                    <p>Metallic foil accents in gold, silver, or copper that add luxury and elegance.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> 400gsm Premium Card Stock</li>
                                        <li><i class="fas fa-check"></i> Gold/Silver/Copper Foil</li>
                                        <li><i class="fas fa-check"></i> Custom Foil Patterns</li>
                                        <li><i class="fas fa-check"></i> Luxurious Appearance</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="business-card">
                                <img src="./images/Die-Cut Cards.jpeg" alt="Die-Cut Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">PREMIUM</div>
                                    <h3 class="business-card-name">Die-Cut Cards</h3>
                                    <p>Unique shapes and custom cuts that make your card truly memorable.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> 400gsm Premium Card Stock</li>
                                        <li><i class="fas fa-check"></i> Custom Shape Cutting</li>
                                        <li><i class="fas fa-check"></i> Rounded or Unique Corners</li>
                                        <li><i class="fas fa-check"></i> Maximum Brand Impact</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specialty Business Cards Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Specialty Business Cards</h2>
                        <p class="category-description">Unique cards with special materials and features for maximum impact</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="business-card">
                                <img src="./images/Transparent Cards.webp" alt="Transparent Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">SPECIALTY</div>
                                    <h3 class="business-card-name">Transparent Cards</h3>
                                    <p>Clear plastic cards that create a modern, innovative impression.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> Clear Plastic Material</li>
                                        <li><i class="fas fa-check"></i> Full Color Printing</li>
                                        <li><i class="fas fa-check"></i> Modern & Innovative</li>
                                        <li><i class="fas fa-check"></i> Durable & Long-lasting</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="business-card">
                                <img src="./images/Metal Business Cards.jpg" alt="Metal Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">SPECIALTY</div>
                                    <h3 class="business-card-name">Metal Business Cards</h3>
                                    <p>Premium metal cards that convey exclusivity and superior quality.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> Stainless Steel Material</li>
                                        <li><i class="fas fa-check"></i> Laser Etched Design</li>
                                        <li><i class="fas fa-check"></i> Exceptional Durability</li>
                                        <li><i class="fas fa-check"></i> Ultimate Luxury Statement</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="business-card">
                                <img src="./images/Embossed Debossed Cards.jpg" alt="Embossed Cards" class="business-card-img">
                                <div class="business-card-content">
                                    <div class="business-card-category">SPECIALTY</div>
                                    <h3 class="business-card-name">Embossed/Debossed Cards</h3>
                                    <p>Textured cards with raised or recessed elements for a tactile experience.</p>
                                    <ul class="business-card-features">
                                        <li><i class="fas fa-check"></i> 400gsm Premium Card Stock</li>
                                        <li><i class="fas fa-check"></i> Raised or Recessed Elements</li>
                                        <li><i class="fas fa-check"></i> Enhanced Tactile Feel</li>
                                        <li><i class="fas fa-check"></i> Sophisticated Appearance</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Card Showcase Section -->
        <section class="card-showcase">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title text-white" data-aos="fade-up">Business Card Design Showcase</h2>
                        <p class="lead text-white" data-aos="fade-up" data-aos-delay="100">See examples of our professionally designed business cards across different industries</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="showcase-card">
                            <h3 class="text-center mb-3">Corporate Executive</h3>
                            <div class="card-preview text-center" style="background: linear-gradient(135deg, #0a2540, #03045e); color: white;">
                                <h4 class="mb-2">Frans Haufiku</h4>
                                <p class="mb-1">Chief Executive Officer</p>
                                <p class="mb-1">AMATETA Techs & Designs</p>
                                <p class="mb-0">+264 85 344 1248</p>
                            </div>
                            <p class="text-center mt-3">Elegant design with foil accents for senior executives</p>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="showcase-card">
                            <h3 class="text-center mb-3">Creative Professional</h3>
                            <div class="card-preview text-center" style="background: linear-gradient(135deg, #00b4d8, #0077b6); color: white;">
                                <h4 class="mb-2">Shipanga Teopolina</h4>
                                <p class="mb-1">Logistic Manager</p>
                                <p class="mb-1">AMATETA Designs</p>
                                <p class="mb-0">s.teopolina@amateta.com</p>
                            </div>
                            <p class="text-center mt-3">Modern design with spot UV for creative professionals</p>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="showcase-card">
                            <h3 class="text-center mb-3">Medical Professional</h3>
                            <div class="card-preview text-center" style="background: white; color: #0a2540; border: 2px solid #00b4d8;">
                                <h4 class="mb-2">Dr. Michael Brown</h4>
                                <p class="mb-1">Senior Medical Consultant</p>
                                <p class="mb-1">Windhoek Medical Center</p>
                                <p class="mb-0">+264 61 234 567</p>
                            </div>
                            <p class="text-center mt-3">Clean, professional design for healthcare providers</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Finishes Section -->
        <section class="finishes-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Premium Finishes & Effects</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Enhance your business cards with our premium finishing options</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                        <div class="finish-card">
                            <div class="finish-icon">
                                <i class="fas fa-sun"></i>
                            </div>
                            <h3 class="step-title">Spot UV</h3>
                            <p>Selective glossy coating that creates contrast and highlights specific elements.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="finish-card">
                            <div class="finish-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                            <h3 class="step-title">Foil Stamping</h3>
                            <p>Metallic foil in gold, silver, or copper for a luxurious, eye-catching effect.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="finish-card">
                            <div class="finish-icon">
                                <i class="fas fa-cut"></i>
                            </div>
                            <h3 class="step-title">Die Cutting</h3>
                            <p>Custom shapes and unique cuts that make your card stand out from the rest.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="finish-card">
                            <div class="finish-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <h3 class="step-title">Embossing</h3>
                            <p>Raised elements that create texture and depth for a sophisticated feel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Printing Process Section -->
        <section class="process-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Our Business Card Printing Process</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">We follow a meticulous process to ensure your business cards are perfect</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                        <div class="process-step">
                            <div class="step-number">1</div>
                            <h3 class="step-title">Consultation</h3>
                            <p>We discuss your needs, brand identity, and card specifications.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="process-step">
                            <div class="step-number">2</div>
                            <h3 class="step-title">Design</h3>
                            <p>Our designers create or refine your card design based on your requirements.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="process-step">
                            <div class="step-number">3</div>
                            <h3 class="step-title">Proofing</h3>
                            <p>We provide digital proofs for your review and approval before printing.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="process-step">
                            <div class="step-number">4</div>
                            <h3 class="step-title">Production & Delivery</h3>
                            <p>High-quality printing with premium finishes and timely delivery.</p>
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
                        <h2 class="section-title" data-aos="fade-up">Business Card Pricing</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Competitive pricing for high-quality business cards in various quantities</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Starter Pack</h3>
                                <div class="pricing-price">N$455</div>
                                <div class="pricing-period">100 Cards</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Standard Glossy or Matte</li>
                                <li>350gsm Card Stock</li>
                                <li>Full Color Both Sides</li>
                                <li>Basic Design Included</li>
                                <li>3-5 Business Days</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Order Now</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card featured">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Professional Pack</h3>
                                <div class="pricing-price">N$865</div>
                                <div class="pricing-period">250 Cards</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Premium Finish Options</li>
                                <li>400gsm Card Stock</li>
                                <li>Spot UV or Foil Stamping</li>
                                <li>Custom Design Services</li>
                                <li>2-3 Business Days</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Order Now</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Enterprise Pack</h3>
                                <div class="pricing-price">N$1120</div>
                                <div class="pricing-period">500 Cards</div>
                            </div>
                            <ul class="pricing-features">
                                <li>All Premium Finishes Available</li>
                                <li>Luxury Card Stocks</li>
                                <li>Die-Cut & Special Shapes</li>
                                <li>Priority Design Services</li>
                                <li>1-2 Business Days</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Order Now</a>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted">Prices may vary based on specific requirements and customizations. Contact us for exact pricing.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Stamps Section -->
        <section class="stamps-section">
            <div class="container">
                <h2 class="text-4xl font-bold mb-4 text-primary-color">Why Choose AMATETA for Business Cards?</h2>
                <p class="text-xl max-w-2xl mx-auto mb-8">We combine quality craftsmanship with attention to detail to create business cards that make a lasting impression.</p>
                
                <div class="stamps-grid">
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Custom Design</h3>
                        <p>Professional designs tailored to your brand identity</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Premium Quality</h3>
                        <p>High-quality materials and printing techniques</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Fast Turnaround</h3>
                        <p>Quick production without compromising quality</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Competitive Pricing</h3>
                        <p>Affordable rates for premium business cards</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Quality Guarantee</h3>
                        <p>We stand behind the quality of our work</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Expert Support</h3>
                        <p>Professional guidance throughout the process</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 text-center text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
            <div class="container" data-aos="zoom-in">
                <h2 class="fw-bold mb-3">Ready to Make Your Mark?</h2>
                <p class="lead mb-4">Contact us today to design and print business cards that truly represent your professional identity.</p>
                <a href="contact.php" class="btn cta-btn-primary btn-lg me-3">
                    <i class="fas fa-id-card me-2"></i> DESIGN MY CARD
                </a>
                <a href="tel:+264853441248" class="btn cta-btn-secondary btn-lg">
                    <i class="fas fa-phone me-2"></i> CALL FOR QUOTE
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