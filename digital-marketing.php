<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/digital-marketing.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Marketing - AMATETA Techs & Designs</title>
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
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--white);
            color: var(--primary-blue);
            padding-top: 80px;
        }

        /* Navigation */
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

        /* Service Hero Section */
        .service-hero {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .service-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%2300b4d8" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center;
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

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

        /* Service Features */
        .service-feature-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            border-top: 4px solid var(--light-blue);
        }

        .service-feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--light-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon i {
            font-size: 1.8rem;
            color: var(--white);
        }

        /* Marketing Services */
        .marketing-service {
            border-left: 4px solid var(--light-blue);
            transition: all 0.3s ease;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background: var(--light-gray);
            border-radius: 8px;
        }

        .marketing-service:hover {
            transform: translateX(5px);
            background: var(--white);
        }

        /* Results Section */
        .results-card {
            text-align: center;
            padding: 2rem;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .results-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .result-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--light-blue);
            margin-bottom: 0.5rem;
        }

        /* Pricing Tables */
        .pricing-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .pricing-card.featured {
            border: 2px solid var(--light-blue);
            transform: scale(1.05);
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
            padding: 0;
            margin: 2rem 0;
        }

        .pricing-features li {
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--medium-gray);
        }

        .pricing-features li:last-child {
            border-bottom: none;
        }

        /* Footer */
        .amateta-footer {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 60px 0 20px;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .service-hero {
                padding: 60px 0;
            }
            
            .pricing-card.featured {
                transform: none;
                margin: 1rem 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Header -->
    <?php render_nav('services'); ?>

    <main>
        <!-- Hero Section -->
        <section class="service-hero">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8" data-aos="fade-right">
                        <h1 class="display-4 fw-bold mb-4">Digital Marketing Solutions</h1>
                        <p class="lead mb-4">Drive growth, increase visibility, and generate qualified leads with our comprehensive digital marketing strategies. We combine data-driven insights with creative execution to deliver measurable results.</p>
                        <div class="hero-features mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>SEO & Search Engine Optimization</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>Social Media Marketing</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>Content Marketing Strategy</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-light-blue me-2"></i>
                                        <span>PPC & Paid Advertising</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#contact" class="btn cta-btn-primary btn-lg me-3">Start Your Campaign</a>
                        <a href="#pricing" class="btn cta-btn-secondary btn-lg">View Packages</a>
                    </div>
                    <div class="col-lg-4" data-aos="fade-left">
                        <img src="images/Ads.jpg" alt="Digital Marketing" class="img-fluid" loading="lazy" style="border-radius:16px;">
                    </div>
                </div>
            </div>
        </section>

        <!-- Marketing Services Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Our Digital Marketing Services</h2>
                    <p class="lead">Comprehensive strategies to grow your online presence and drive business results</p>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4" data-aos="fade-up">
                        <div class="marketing-service">
                            <div class="feature-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h4>SEO Optimization</h4>
                            <p>Improve your search engine rankings and drive organic traffic with our comprehensive SEO strategies.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-light-blue me-2"></i> Keyword Research & Analysis</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> On-Page Optimization</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Technical SEO Audits</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Local SEO Optimization</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Content Strategy Development</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="marketing-service">
                            <div class="feature-icon">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <h4>Social Media Marketing</h4>
                            <p>Engage your audience and build brand loyalty across all major social media platforms.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-light-blue me-2"></i> Social Media Strategy</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Content Creation & Scheduling</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Community Management</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Social Media Advertising</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Performance Analytics</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4" data-aos="fade-up">
                        <div class="marketing-service">
                            <div class="feature-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <h4>Content Marketing</h4>
                            <p>Create valuable, relevant content that attracts and retains your target audience.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-light-blue me-2"></i> Content Strategy Development</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Blog Writing & Management</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Email Marketing Campaigns</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Video Content Production</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Content Distribution</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="marketing-service">
                            <div class="feature-icon">
                                <i class="fas fa-ad"></i>
                            </div>
                            <h4>PPC & Paid Advertising</h4>
                            <p>Drive immediate results with targeted paid advertising campaigns across multiple platforms.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-light-blue me-2"></i> Google Ads Management</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Social Media Advertising</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Display Network Campaigns</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Remarketing Strategies</li>
                                <li><i class="fas fa-check text-light-blue me-2"></i> Conversion Rate Optimization</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Results Section -->
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Proven Results</h2>
                    <p class="lead">We deliver measurable outcomes that drive business growth</p>
                </div>
                <div class="row">
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up">
                        <div class="results-card">
                            <div class="result-number">150%</div>
                            <p>Average Increase in Organic Traffic</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="results-card">
                            <div class="result-number">85%</div>
                            <p>Improvement in Search Rankings</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="results-card">
                            <div class="result-number">300%</div>
                            <p>ROI on PPC Campaigns</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="results-card">
                            <div class="result-number">200%</div>
                            <p>Growth in Social Engagement</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Digital Marketing Packages</h2>
                    <p class="lead">Choose the perfect package for your business growth goals</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-up">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h4>Starter Package</h4>
                                <div class="pricing-price">N$999<span>/mo</span></div>
                                <p>Perfect for small businesses</p>
                            </div>
                            <div class="pricing-body p-4">
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Basic SEO Optimization</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Social Media Management (2 platforms)</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> 4 Blog Posts Monthly</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Monthly Performance Report</li>
                                    <li><i class="fas fa-times text-danger me-2"></i> PPC Management</li>
                                    <li><i class="fas fa-times text-danger me-2"></i> Email Marketing</li>
                                </ul>
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="pricing-card featured">
                            <div class="pricing-header">
                                <h4>Growth Package</h4>
                                <div class="pricing-price">N$1699<span>/mo</span></div>
                                <p>Most Popular</p>
                            </div>
                            <div class="pricing-body p-4">
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Comprehensive SEO Strategy</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Social Media Management (4 platforms)</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> 8 Blog Posts Monthly</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Google Ads Management</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Email Marketing Campaigns</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Bi-weekly Performance Reports</li>
                                </ul>
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h4>Enterprise Package</h4>
                                <div class="pricing-price">N$2,499<span>/mo</span></div>
                                <p>For maximum growth</p>
                            </div>
                            <div class="pricing-body p-4">
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Advanced SEO & Content Strategy</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Full Social Media Management</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> 12 Blog Posts Monthly</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Multi-platform PPC Management</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Advanced Email Marketing</li>
                                    <li><i class="fas fa-check text-light-blue me-2"></i> Weekly Strategy Calls</li>
                                </ul>
                                <a href="contact.php" class="btn cta-btn-primary w-100">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Our Marketing Process</h2>
                    <p class="lead">A structured approach to delivering exceptional results</p>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-4" data-aos="fade-up">
                        <div class="service-feature-card text-center">
                            <div class="feature-icon mx-auto">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h5>Analysis & Planning</h5>
                            <p>Comprehensive audit of your current digital presence and competitor analysis</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-feature-card text-center">
                            <div class="feature-icon mx-auto">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h5>Strategy Development</h5>
                            <p>Customized marketing strategy tailored to your business goals and target audience</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-feature-card text-center">
                            <div class="feature-icon mx-auto">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h5>Implementation</h5>
                            <p>Execution of marketing campaigns across all selected channels and platforms</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-feature-card text-center">
                            <div class="feature-icon mx-auto">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h5>Optimization</h5>
                            <p>Continuous monitoring, analysis, and optimization based on performance data</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5 text-white" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);">
            <div class="container text-center">
                <h2 class="fw-bold mb-3">Ready to Grow Your Business?</h2>
                <p class="lead mb-4">Let's create a digital marketing strategy that drives real results and accelerates your growth.</p>
                <a href="contact.php" class="btn cta-btn-primary btn-lg me-3">
                    <i class="far fa-calendar-check me-2"></i> Get Free Marketing Audit
                </a>
                <a href="tel:+264853441248" class="btn cta-btn-secondary btn-lg">
                    <i class="fas fa-phone me-2"></i> Call Us Now
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