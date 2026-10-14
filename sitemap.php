<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/sitemap.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - Sitemap</title>
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
            line-height: 1.6;
        }

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

        .page-hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
            padding: 80px 0;
            text-align: center;
        }

        .sitemap-content {
            padding: 80px 0;
            background-color: var(--light-gray);
        }

        .sitemap-section {
            background-color: var(--white);
            padding: 3rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .sitemap-section h2 {
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 0.5rem;
        }

        .sitemap-section h3 {
            color: var(--primary-blue);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .sitemap-list {
            list-style: none;
            padding: 0;
        }

        .sitemap-list li {
            margin-bottom: 0.75rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .sitemap-list li:before {
            content: "•";
            color: var(--light-blue);
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        .sitemap-list a {
            color: var(--primary-blue);
            text-decoration: none;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .sitemap-list a:hover {
            color: var(--light-blue);
        }

        .sitemap-list a i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }

        .service-category {
            background-color: var(--light-gray);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--light-blue);
        }

        .service-category h4 {
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

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

        @media (max-width: 768px) {
            .sitemap-section {
                padding: 2rem 1.5rem;
            }
            
            body {
                padding-top: 70px;
            }
        }
    </style>
</head>
<body>

    <?php render_nav(''); ?>

    <main>
        
        <section class="page-hero-section">
            <div class="container">
                <h1 class="display-4 fw-bold mb-4">Sitemap</h1>
                <p class="lead mb-4">Complete overview of our website structure and pages</p>
                <p class="mb-0">Find everything you're looking for with our comprehensive sitemap</p>
            </div>
        </section>

        <section class="sitemap-content">
            <div class="container">
                <div class="sitemap-section">
                    <h2>Website Navigation</h2>
                    <p>Use this sitemap to easily navigate through all sections of our website. This comprehensive overview includes all our main pages and services.</p>

                    <h3>Main Pages</h3>
                    <ul class="sitemap-list">
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                        <li><a href="services.php"><i class="fas fa-concierge-bell"></i> Services</a></li>
                        <li><a href="portfolio.php"><i class="fas fa-briefcase"></i> Portfolio</a></li>
                        <li><a href="team.php"><i class="fas fa-users"></i> Our Team</a></li>
                        <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    </ul>

                    <h3>Service Pages</h3>
                    <ul class="sitemap-list">
                        <li><a href="web-development.php"><i class="fas fa-code"></i> Website Development</a></li>
                        <li><a href="digital-marketing.php"><i class="fas fa-bullhorn"></i> Digital Marketing</a></li>
                        <li><a href="graphic-design.php"><i class="fas fa-palette"></i> Graphic Design</a></li>
                        <li><a href="it-support.php"><i class="fas fa-headset"></i> IT Support</a></li>
                        <li><a href="it-equipment.php"><i class="fas fa-laptop"></i> IT Equipment Supply</a></li>
                        <li><a href="printing-services.php"><i class="fas fa-print"></i> Printing Services</a></li>
                        <li><a href="corporate-printing.php"><i class="fas fa-building"></i> Corporate Printing</a></li>
                        <li><a href="business-cards.php"><i class="fas fa-id-card"></i> Business Cards Printing</a></li>
                        <li><a href="pos-systems.php"><i class="fas fa-cash-register"></i> POS Systems</a></li>
                        <li><a href="graphic-design-training.php"><i class="fas fa-graduation-cap"></i> Graphic Design Training</a></li>
                        <li><a href="it-consulting.php"><i class="fas fa-laptop-code"></i> IT Consulting</a></li>
                    </ul>

                    <h3>Additional Pages</h3>
                    <ul class="sitemap-list">
                        <li><a href="launched-websites.php"><i class="fas fa-rocket"></i> Launched Websites</a></li>
                        <li><a href="portfolio.php"><i class="fas fa-briefcase"></i> Portfolio</a></li>
                        <li><a href="team.php"><i class="fas fa-users"></i> Our Team</a></li>
                        <li><a href="hosting-domains.php"><i class="fas fa-server"></i> Hosting &amp; Domains</a></li>
                        <li><a href="stamps.php"><i class="fas fa-stamp"></i> Company Stamps</a></li>
                    </ul>

                    <h3>Legal Pages</h3>
                    <ul class="sitemap-list">
                        <li><a href="privacy-policy.php"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                        <li><a href="terms-of-service.php"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="cookie-policy.php"><i class="fas fa-cookie"></i> Cookie Policy</a></li>
                        <li><a href="sitemap.php"><i class="fas fa-sitemap"></i> Sitemap</a></li>
                    </ul>

                    <h3>Contact Information</h3>
                    <ul class="sitemap-list">
                        <li><a href="contact.php"><i class="fas fa-map-marker-alt"></i> Our Location</a></li>
                        <li><a href="tel:+264853441248"><i class="fas fa-phone"></i> Call Us: +264 85 344 1248</a></li>
                        <li><a href="mailto:info@amateta.com"><i class="fas fa-envelope"></i> Email: info@amateta.com</a></li>
                        <li><a href="mailto:support@amateta.com"><i class="fas fa-headset"></i> Support: support@amateta.com</a></li>
                        <li><a href="mailto:order@amateta.com"><i class="fas fa-shopping-cart"></i> Orders: order@amateta.com</a></li>
                    </ul>

                    <h3>Service Categories</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="service-category">
                                <h4>Digital Solutions</h4>
                                <ul class="sitemap-list">
                                    <li>Website Design & Development</li>
                                    <li>E-commerce Solutions</li>
                                    <li>Mobile App Development</li>
                                    <li>UI/UX Design</li>
                                    <li>Search Engine Optimization (SEO)</li>
                                    <li>Social Media Marketing</li>
                                    <li>Content Marketing</li>
                                    <li>Email Marketing</li>
                                    <li>Pay-Per-Click Advertising</li>
                                    <li>Google Analytics Setup</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-category">
                                <h4>IT Services</h4>
                                <ul class="sitemap-list">
                                    <li>IT Support & Maintenance</li>
                                    <li>Network Setup & Security</li>
                                    <li>Hardware & Software Supply</li>
                                    <li>Cloud Solutions</li>
                                    <li>Data Backup & Recovery</li>
                                    <li>Cybersecurity Services</li>
                                    <li>Server Management</li>
                                    <li>IT Consulting</li>
                                    <li>System Integration</li>
                                    <li>IT Infrastructure Planning</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="service-category">
                                <h4>Design & Printing</h4>
                                <ul class="sitemap-list">
                                    <li>Logo Design & Branding</li>
                                    <li>Business Card Design</li>
                                    <li>Brochure & Flyer Design</li>
                                    <li>Corporate Identity Design</li>
                                    <li>Packaging Design</li>
                                    <li>Large Format Printing</li>
                                    <li>Banner & Signage Printing</li>
                                    <li>Photo Printing Services</li>
                                    <li>Document Printing & Binding</li>
                                    <li>Promotional Material Design</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-category">
                                <h4>Training & Support</h4>
                                <ul class="sitemap-list">
                                    <li>Graphic Design Training</li>
                                    <li>Web Development Courses</li>
                                    <li>Digital Marketing Workshops</li>
                                    <li>Software Training</li>
                                    <li>IT Skills Development</li>
                                    <li>24/7 Technical Support</li>
                                    <li>Remote Assistance</li>
                                    <li>On-site Support Services</li>
                                    <li>Managed IT Services</li>
                                    <li>Consultation & Planning</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <h3>Quick Links by Category</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-desktop text-primary"></i> Web Services</h5>
                                    <ul class="sitemap-list">
                                        <li><a href="web-development.php">Website Development</a></li>
                                        <li><a href="digital-marketing.php">Digital Marketing</a></li>
                                        <li><a href="hosting-domains.php">Hosting &amp; Domains</a></li>
                                        <li><a href="launched-websites.php">E-commerce Solutions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-paint-brush text-success"></i> Design Services</h5>
                                    <ul class="sitemap-list">
                                        <li><a href="graphic-design.php">Graphic Design</a></li>
                                        <li><a href="graphic-design.php">Logo Design &amp; Branding</a></li>
                                        <li><a href="graphic-design-training.php">Graphic Design Training</a></li>
                                        <li><a href="business-cards.php">Business Card Design</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-print text-info"></i> Printing Services</h5>
                                    <ul class="sitemap-list">
                                        <li><a href="printing-services.php">General Printing</a></li>
                                        <li><a href="corporate-printing.php">Corporate Printing</a></li>
                                        <li><a href="business-cards.php">Business Cards</a></li>
                                        <li><a href="stamps.php">Company Stamps</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4">
                        <h4><i class="fas fa-info-circle"></i> Need Help Navigating?</h4>
                        <p class="mb-0">If you can't find what you're looking for, please don't hesitate to <a href="contact.php" class="alert-link">contact us</a>. Our team is always ready to assist you in finding the information or services you need.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php render_footer(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

        // Add smooth scrolling to all links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>
</html>