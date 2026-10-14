<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/terms-of-service.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - Terms of Service</title>
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

        .terms-content {
            padding: 80px 0;
            background-color: var(--light-gray);
        }

        .terms-section {
            background-color: var(--white);
            padding: 3rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .terms-section h2 {
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 0.5rem;
        }

        .terms-section h3 {
            color: var(--primary-blue);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .terms-section ul {
            padding-left: 1.5rem;
        }

        .terms-section li {
            margin-bottom: 0.5rem;
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
            .terms-section {
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
                <h1 class="display-4 fw-bold mb-4">Terms of Service</h1>
                <p class="lead mb-4">The rules and guidelines for using our services</p>
                <p class="mb-0">Last updated: <strong id="current-date"></strong></p>
            </div>
        </section>

        <section class="terms-content">
            <div class="container">
                <div class="terms-section">
                    <h2>Agreement to Terms</h2>
                    <p>By accessing or using the services provided by AMATETA Techs & Designs ("we," "us," or "our"), you agree to be bound by these Terms of Service. If you disagree with any part of the terms, you may not access our services.</p>

                    <h3>Services Description</h3>
                    <p>AMATETA Techs & Designs provides various technology services including but not limited to:</p>
                    <ul>
                        <li>Website development and design</li>
                        <li>Digital marketing services</li>
                        <li>Graphic design</li>
                        <li>IT support and consulting</li>
                        <li>Printing services</li>
                        <li>IT equipment supply</li>
                    </ul>

                    <h3>User Responsibilities</h3>
                    <p>When using our services, you agree to:</p>
                    <ul>
                        <li>Provide accurate and complete information</li>
                        <li>Maintain the security of your account credentials</li>
                        <li>Use our services in compliance with applicable laws</li>
                        <li>Not engage in any illegal or unauthorized activities</li>
                        <li>Respect intellectual property rights</li>
                    </ul>

                    <h3>Payment Terms</h3>
                    <p>For paid services, the following terms apply:</p>
                    <ul>
                        <li>Payment is due according to the terms specified in your service agreement</li>
                        <li>We reserve the right to suspend services for non-payment</li>
                        <li>All fees are quoted in Namibian Dollars (NAD) unless otherwise specified</li>
                        <li>Prices are subject to change with 30 days' notice</li>
                    </ul>

                    <h3>Intellectual Property</h3>
                    <p>All content, features, and functionality of our services are owned by AMATETA Techs & Designs and are protected by international copyright, trademark, and other intellectual property laws.</p>
                    <p>For creative works developed for clients, intellectual property rights will be transferred upon full payment, unless otherwise specified in the service agreement.</p>

                    <h3>Project Timelines and Deliverables</h3>
                    <p>We strive to meet all project deadlines as specified in project proposals. However:</p>
                    <ul>
                        <li>Timelines may be affected by client responsiveness and feedback delays</li>
                        <li>We are not liable for delays caused by third-party services or factors beyond our control</li>
                        <li>Project scope changes may require timeline adjustments</li>
                    </ul>

                    <h3>Warranties and Limitations</h3>
                    <p>Our services are provided "as is" without any warranties, express or implied. We do not guarantee that:</p>
                    <ul>
                        <li>Our services will be uninterrupted or error-free</li>
                        <li>Results from digital marketing services will meet specific performance metrics</li>
                        <li>All errors will be corrected</li>
                    </ul>

                    <h3>Limitation of Liability</h3>
                    <p>To the maximum extent permitted by law, AMATETA Techs & Designs shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from:</p>
                    <ul>
                        <li>Your access to or use of or inability to access or use the services</li>
                        <li>Any conduct or content of any third party on the services</li>
                        <li>Any content obtained from the services</li>
                        <li>Unauthorized access, use, or alteration of your transmissions or content</li>
                    </ul>

                    <h3>Termination</h3>
                    <p>We may terminate or suspend your access to our services immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
                    <p>Upon termination, your right to use our services will immediately cease.</p>

                    <h3>Governing Law</h3>
                    <p>These Terms shall be governed and construed in accordance with the laws of Namibia, without regard to its conflict of law provisions.</p>

                    <h3>Changes to Terms</h3>
                    <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

                    <h3>Contact Information</h3>
                    <p>If you have any questions about these Terms, please contact us:</p>
                    <ul>
                        <li>By email: <a href="mailto:legal@amateta.com">legal@amateta.com</a></li>
                        <li>By phone: <a href="tel:+264853441248">+264 85 344 1248</a></li>
                        <li>By mail: AMATETA Techs & Designs, Windhoek, Namibia</li>
                    </ul>
                </div>
            </div>
        </section>

    </main>

    <?php render_footer(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set current year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
        
        // Set current date in terms
        const currentDate = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('current-date').textContent = currentDate;

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