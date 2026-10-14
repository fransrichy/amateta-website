<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/privacy-policy.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - Privacy Policy</title>
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

        .policy-content {
            padding: 80px 0;
            background-color: var(--light-gray);
        }

        .policy-section {
            background-color: var(--white);
            padding: 3rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .policy-section h2 {
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 0.5rem;
        }

        .policy-section h3 {
            color: var(--primary-blue);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .policy-section ul {
            padding-left: 1.5rem;
        }

        .policy-section li {
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
            .policy-section {
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
                <h1 class="display-4 fw-bold mb-4">Privacy Policy</h1>
                <p class="lead mb-4">How we protect and handle your personal information</p>
                <p class="mb-0">Last updated: <strong id="current-date"></strong></p>
            </div>
        </section>

        <section class="policy-content">
            <div class="container">
                <div class="policy-section">
                    <h2>Introduction</h2>
                    <p>AMATETA Techs & Designs ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website <a href="index.php">amateta.com</a> and use our services.</p>
                    <p>Please read this Privacy Policy carefully. By accessing or using our services, you agree to the collection and use of information in accordance with this policy.</p>

                    <h3>Information We Collect</h3>
                    <h4>Personal Information</h4>
                    <p>We may collect personal information that you voluntarily provide to us when you:</p>
                    <ul>
                        <li>Register on our website</li>
                        <li>Place an order for our services</li>
                        <li>Subscribe to our newsletter</li>
                        <li>Fill out a contact form</li>
                        <li>Participate in surveys or promotions</li>
                    </ul>
                    <p>This information may include:</p>
                    <ul>
                        <li>Name and contact details (email address, phone number)</li>
                        <li>Company information</li>
                        <li>Billing and payment information</li>
                        <li>Project requirements and specifications</li>
                    </ul>

                    <h4>Automatically Collected Information</h4>
                    <p>When you visit our website, we automatically collect certain information about your device, including:</p>
                    <ul>
                        <li>IP address</li>
                        <li>Browser type and version</li>
                        <li>Pages you visit and time spent</li>
                        <li>Referring website addresses</li>
                        <li>Operating system and device information</li>
                    </ul>

                    <h3>How We Use Your Information</h3>
                    <p>We use the information we collect for various purposes, including:</p>
                    <ul>
                        <li>To provide and maintain our services</li>
                        <li>To process your orders and transactions</li>
                        <li>To communicate with you about our services</li>
                        <li>To send you marketing and promotional communications (with your consent)</li>
                        <li>To improve our website and services</li>
                        <li>To prevent fraud and enhance security</li>
                        <li>To comply with legal obligations</li>
                    </ul>

                    <h3>Information Sharing and Disclosure</h3>
                    <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except in the following circumstances:</p>
                    <ul>
                        <li><strong>Service Providers:</strong> We may share information with third-party vendors who perform services on our behalf, such as payment processing, data analysis, email delivery, and hosting services.</li>
                        <li><strong>Legal Requirements:</strong> We may disclose your information if required to do so by law or in response to valid requests by public authorities.</li>
                        <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of all or a portion of our assets, your information may be transferred to the acquiring entity.</li>
                    </ul>

                    <h3>Data Security</h3>
                    <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</p>

                    <h3>Your Data Protection Rights</h3>
                    <p>Depending on your location, you may have the following rights regarding your personal information:</p>
                    <ul>
                        <li><strong>Access:</strong> The right to request copies of your personal data</li>
                        <li><strong>Rectification:</strong> The right to request correction of inaccurate information</li>
                        <li><strong>Erasure:</strong> The right to request deletion of your personal data</li>
                        <li><strong>Restriction:</strong> The right to request限制 of processing of your personal data</li>
                        <li><strong>Objection:</strong> The right to object to our processing of your personal data</li>
                        <li><strong>Data Portability:</strong> The right to request transfer of your data to another organization</li>
                    </ul>
                    <p>To exercise these rights, please contact us using the information provided in the "Contact Us" section.</p>

                    <h3>Cookies and Tracking Technologies</h3>
                    <p>We use cookies and similar tracking technologies to track activity on our website and store certain information. Cookies are files with a small amount of data that may include an anonymous unique identifier. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>

                    <h3>Third-Party Links</h3>
                    <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policies of any third-party sites you visit.</p>

                    <h3>Children's Privacy</h3>
                    <p>Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with personal information, please contact us immediately.</p>

                    <h3>Changes to This Privacy Policy</h3>
                    <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date. You are advised to review this Privacy Policy periodically for any changes.</p>

                    <h3>Contact Us</h3>
                    <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                    <ul>
                        <li>By email: <a href="mailto:privacy@amateta.com">privacy@amateta.com</a></li>
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
        
        // Set current date in privacy policy
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