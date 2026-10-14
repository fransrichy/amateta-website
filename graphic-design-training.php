<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/graphic-design-training.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - Graphic Design Training</title>
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
            Training Styles
            --------------------------------- */
        .training-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
        }

        .training-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .training-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .training-content {
            padding: 1.5rem;
        }

        .training-category {
            font-size: 0.9rem;
            color: var(--light-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .training-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }

        .training-features {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .training-features li {
            padding: 0.25rem 0;
            display: flex;
            align-items: center;
        }

        .training-features li i {
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

        .instructors-section {
            padding: 80px 0;
            background-color: var(--light-gray);
        }

        .instructor-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
        }

        .instructor-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .instructor-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.5rem;
            border: 4px solid var(--light-blue);
        }

        .testimonials-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
        }

        .testimonial-card {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 12px;
            margin: 1rem 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .testimonial-text::before {
            content: '"';
            font-size: 4rem;
            color: var(--light-blue);
            position: absolute;
            top: -20px;
            left: -10px;
            opacity: 0.3;
        }

        .student-work-section {
            padding: 80px 0;
            background-color: var(--white);
        }

        .work-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .work-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .work-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .work-content {
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

    <a href="https://wa.me/264853441248?text=Hello%20AMATETA%20Techs%20%26%20Designs,%20I%20would%20like%20to%20get%20more%20information%20about%20your%20graphic%20design%20training%20programs" id="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i> WhatsApp Us
    </a>

    <?php render_nav('services'); ?>

    <main>
        
        <section class="page-hero-section">
            <div class="container text-center hero-content">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">Graphic Design Training</h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Master the art of visual communication with our comprehensive graphic design training programs. From beginner to professional level.</p>
                <div data-aos="fade-up" data-aos-delay="200">
                    <a href="#courses" class="btn cta-btn-primary btn-lg me-3">View Courses</a>
                    <a href="contact.php" class="btn cta-btn-secondary btn-lg">Free Consultation</a>
                </div>
            </div>
        </section>

        <section id="courses" class="py-5 bg-light">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="section-title" data-aos="fade-up">Comprehensive Design Training Programs</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Our hands-on training programs are designed to equip you with practical skills for today's creative industry.</p>
                    </div>
                </div>

                <!-- Adobe Creative Suite Training Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Adobe Creative Suite Training</h2>
                        <p class="category-description">Master the industry-standard tools for professional graphic design</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1634942537034-2531766767d1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Adobe Photoshop Training" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">ADOBE TRAINING</div>
                                    <h3 class="training-name">Adobe Photoshop Mastery</h3>
                                    <p>Comprehensive training in photo editing, digital painting, and graphic design using Photoshop.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> Photo Editing & Retouching</li>
                                        <li><i class="fas fa-check"></i> Digital Painting Techniques</li>
                                        <li><i class="fas fa-check"></i> Layer Management</li>
                                        <li><i class="fas fa-check"></i> Advanced Selection Tools</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1634760017987-31c4b2c6be8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Adobe Illustrator Training" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">ADOBE TRAINING</div>
                                    <h3 class="training-name">Adobe Illustrator Essentials</h3>
                                    <p>Learn vector graphics creation, logo design, and illustration techniques with Illustrator.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> Vector Illustration</li>
                                        <li><i class="fas fa-check"></i> Logo & Icon Design</li>
                                        <li><i class="fas fa-check"></i> Typography & Text Effects</li>
                                        <li><i class="fas fa-check"></i> Pen Tool Mastery</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1586716402207-14d1d510c1e9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Adobe InDesign Training" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">ADOBE TRAINING</div>
                                    <h3 class="training-name">Adobe InDesign Layout</h3>
                                    <p>Professional layout design for print and digital publications using InDesign.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> Page Layout Design</li>
                                        <li><i class="fas fa-check"></i> Typography & Grid Systems</li>
                                        <li><i class="fas fa-check"></i> Print Preparation</li>
                                        <li><i class="fas fa-check"></i> Interactive PDF Creation</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specialized Design Training Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Specialized Design Training</h2>
                        <p class="category-description">Focused courses for specific design disciplines and career paths</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="UI/UX Design Training" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">DIGITAL DESIGN</div>
                                    <h3 class="training-name">UI/UX Design Fundamentals</h3>
                                    <p>Learn user interface and user experience design principles for digital products.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> User Research Methods</li>
                                        <li><i class="fas fa-check"></i> Wireframing & Prototyping</li>
                                        <li><i class="fas fa-check"></i> Interaction Design</li>
                                        <li><i class="fas fa-check"></i> Design System Creation</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Brand Identity Training" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">BRANDING</div>
                                    <h3 class="training-name">Brand Identity Design</h3>
                                    <p>Comprehensive training in creating complete brand identity systems.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> Logo Design Principles</li>
                                        <li><i class="fas fa-check"></i> Color Theory & Psychology</li>
                                        <li><i class="fas fa-check"></i> Typography Systems</li>
                                        <li><i class="fas fa-check"></i> Brand Guidelines Creation</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1545235617-9465d2a55698?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Motion Graphics Training" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">MOTION DESIGN</div>
                                    <h3 class="training-name">Motion Graphics & Animation</h3>
                                    <p>Create dynamic animations and motion graphics for video and web.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> After Effects Fundamentals</li>
                                        <li><i class="fas fa-check"></i> Keyframe Animation</li>
                                        <li><i class="fas fa-check"></i> Motion Design Principles</li>
                                        <li><i class="fas fa-check"></i> Video Compositing</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Career Development Training Section -->
                <div class="service-category">
                    <div class="category-header">
                        <h2 class="category-title">Career Development Programs</h2>
                        <p class="category-description">Complete programs designed to launch your design career</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Graphic Design Diploma" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">CAREER PROGRAM</div>
                                    <h3 class="training-name">Graphic Design Diploma</h3>
                                    <p>Comprehensive 6-month program covering all aspects of professional graphic design.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> Complete Design Foundation</li>
                                        <li><i class="fas fa-check"></i> Portfolio Development</li>
                                        <li><i class="fas fa-check"></i> Industry Mentorship</li>
                                        <li><i class="fas fa-check"></i> Career Placement Support</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Freelance Design Business" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">BUSINESS PROGRAM</div>
                                    <h3 class="training-name">Freelance Design Business</h3>
                                    <p>Learn how to build and manage a successful freelance design business.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> Client Acquisition</li>
                                        <li><i class="fas fa-check"></i> Pricing & Contracts</li>
                                        <li><i class="fas fa-check"></i> Business Management</li>
                                        <li><i class="fas fa-check"></i> Marketing Strategies</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="training-card">
                                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Corporate Training" class="training-img">
                                <div class="training-content">
                                    <div class="training-category">CORPORATE PROGRAM</div>
                                    <h3 class="training-name">Corporate Design Training</h3>
                                    <p>Customized training programs for teams and organizations.</p>
                                    <ul class="training-features">
                                        <li><i class="fas fa-check"></i> Team Skill Assessment</li>
                                        <li><i class="fas fa-check"></i> Custom Curriculum</li>
                                        <li><i class="fas fa-check"></i> On-site or Virtual Training</li>
                                        <li><i class="fas fa-check"></i> Ongoing Support</li>
                                    </ul>
                                    <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Work Section -->
        <section class="student-work-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Student Work Showcase</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">See the incredible work created by our students during their training programs</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="work-card">
                            <img src="https://images.unsplash.com/photo-1565689228866-1d7af8a1047d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Student Brand Project" class="work-img">
                            <div class="work-content">
                                <h4>Complete Brand Identity</h4>
                                <p class="text-muted">By Sarah M. - Brand Identity Course</p>
                                <p>Comprehensive brand system including logo, color palette, and brand guidelines.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="work-card">
                            <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Student UI Design" class="work-img">
                            <div class="work-content">
                                <h4>Mobile App UI Design</h4>
                                <p class="text-muted">By John K. - UI/UX Design Course</p>
                                <p>Complete mobile application interface with user flows and interactive prototypes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="work-card">
                            <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Student Packaging Design" class="work-img">
                            <div class="work-content">
                                <h4>Product Packaging Design</h4>
                                <p class="text-muted">By Maria L. - Packaging Design Course</p>
                                <p>Creative packaging solution for a local food product with die-line and mockups.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Instructors Section -->
        <section class="instructors-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Meet Our Expert Instructors</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Learn from industry professionals with years of experience in graphic design and education</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="instructor-card">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="David Chen" class="instructor-img">
                            <h3>David Chen</h3>
                            <p class="text-light-blue mb-2">Senior Brand Designer</p>
                            <p class="mb-3">10+ years experience in brand identity design for international clients. Specializes in Adobe Creative Suite and brand strategy.</p>
                            <div class="d-flex justify-content-center">
                                <span class="badge bg-light-blue me-2">Photoshop</span>
                                <span class="badge bg-light-blue me-2">Illustrator</span>
                                <span class="badge bg-light-blue">Branding</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="instructor-card">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Sarah Johnson" class="instructor-img">
                            <h3>Sarah Johnson</h3>
                            <p class="text-light-blue mb-2">UI/UX Design Lead</p>
                            <p class="mb-3">Former design lead at tech startups. Expert in user-centered design, prototyping, and design systems.</p>
                            <div class="d-flex justify-content-center">
                                <span class="badge bg-light-blue me-2">Figma</span>
                                <span class="badge bg-light-blue me-2">UI/UX</span>
                                <span class="badge bg-light-blue">Prototyping</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="instructor-card">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Michael Rodriguez" class="instructor-img">
                            <h3>Michael Rodriguez</h3>
                            <p class="text-light-blue mb-2">Motion Graphics Artist</p>
                            <p class="mb-3">Award-winning motion designer with work featured in international film festivals and advertising campaigns.</p>
                            <div class="d-flex justify-content-center">
                                <span class="badge bg-light-blue me-2">After Effects</span>
                                <span class="badge bg-light-blue me-2">Animation</span>
                                <span class="badge bg-light-blue">Cinema 4D</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Training Process Section -->
        <section class="process-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title" data-aos="fade-up">Our Training Methodology</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">We follow a proven approach to ensure you gain practical, industry-relevant skills</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                        <div class="process-step">
                            <div class="step-number">1</div>
                            <h3 class="step-title">Foundation Building</h3>
                            <p>Learn fundamental design principles, theory, and software basics.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="process-step">
                            <div class="step-number">2</div>
                            <h3 class="step-title">Hands-on Projects</h3>
                            <p>Apply your skills to real-world projects and build your portfolio.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="process-step">
                            <div class="step-number">3</div>
                            <h3 class="step-title">Expert Feedback</h3>
                            <p>Receive personalized feedback and guidance from industry professionals.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="process-step">
                            <div class="step-number">4</div>
                            <h3 class="step-title">Career Preparation</h3>
                            <p>Develop your portfolio and prepare for job opportunities or freelance work.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title text-white" data-aos="fade-up">What Our Students Say</h2>
                        <p class="lead text-white" data-aos="fade-up" data-aos-delay="100">Hear from graduates who transformed their careers through our training programs</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                "The graphic design diploma program completely changed my career trajectory. I went from having no design experience to landing a junior designer position in just 6 months!"
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-1">Lisa Thompson</h5>
                                    <p class="mb-0 text-light-blue">Junior Designer at Creative Studio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                "The instructors are incredibly knowledgeable and supportive. The hands-on projects gave me the confidence to start my freelance business while still completing the course."
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-1">James Wilson</h5>
                                    <p class="mb-0 text-light-blue">Freelance Graphic Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                "As a marketing professional, the specialized training helped me create better visual content for our campaigns. The practical skills I gained are directly applicable to my work."
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-1">Maria Garcia</h5>
                                    <p class="mb-0 text-light-blue">Marketing Manager</p>
                                </div>
                            </div>
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
                        <h2 class="section-title" data-aos="fade-up">Training Program Pricing</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Flexible options to suit different learning needs and budgets</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Single Course</h3>
                                <div class="pricing-price">$299</div>
                                <div class="pricing-period">4-6 Weeks</div>
                            </div>
                            <ul class="pricing-features">
                                <li>One Specialized Course</li>
                                <li>Weekly Live Sessions</li>
                                <li>Project Feedback</li>
                                <li>Course Materials</li>
                                <li>Certificate of Completion</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card featured">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Career Track</h3>
                                <div class="pricing-price">$1,299</div>
                                <div class="pricing-period">6 Months</div>
                            </div>
                            <ul class="pricing-features">
                                <li>4 Core Courses</li>
                                <li>Personal Mentorship</li>
                                <li>Portfolio Development</li>
                                <li>Career Coaching</li>
                                <li>Job Placement Support</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Enroll Now</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h3 class="pricing-name">Corporate Training</h3>
                                <div class="pricing-price">Custom</div>
                                <div class="pricing-period">Team Packages</div>
                            </div>
                            <ul class="pricing-features">
                                <li>Customized Curriculum</li>
                                <li>Team Skill Assessment</li>
                                <li>Flexible Scheduling</li>
                                <li>Progress Reporting</li>
                                <li>Ongoing Support</li>
                            </ul>
                            <a href="contact.php" class="btn cta-btn-primary w-100">Get Quote</a>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted">*Payment plans and scholarships available. Contact us for more information.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Stamps Section -->
        <section class="stamps-section">
            <div class="container">
                <h2 class="text-4xl font-bold mb-4 text-primary-color">Why Choose AMATETA for Design Training?</h2>
                <p class="text-xl max-w-2xl mx-auto mb-8">We provide industry-relevant training that prepares you for real-world design challenges</p>
                
                <div class="stamps-grid">
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Industry-Relevant Curriculum</h3>
                        <p>Courses designed based on current industry needs and trends</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Expert Instructors</h3>
                        <p>Learn from professionals with real-world design experience</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Hands-on Learning</h3>
                        <p>Practical projects that build your portfolio and skills</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Small Class Sizes</h3>
                        <p>Personalized attention and feedback for each student</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Career Support</h3>
                        <p>Portfolio reviews, job preparation, and career guidance</p>
                    </div>
                    
                    <div class="stamp-item">
                        <div class="stamp-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Flexible Learning</h3>
                        <p>Online and in-person options to fit your schedule</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 text-center text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
            <div class="container" data-aos="zoom-in">
                <h2 class="fw-bold mb-3">Ready to Start Your Design Journey?</h2>
                <p class="lead mb-4">Join our next cohort and transform your creative skills into a rewarding career.</p>
                <a href="contact.php" class="btn cta-btn-primary btn-lg me-3">
                    <i class="fas fa-graduation-cap me-2"></i> ENROLL NOW
                </a>
                <a href="tel:+264853441248" class="btn cta-btn-secondary btn-lg">
                    <i class="fas fa-phone me-2"></i> CALL FOR INFO
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