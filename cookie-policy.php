<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/cookie-policy.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMATETA Techs & Designs - Cookie Policy</title>
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

        .cookie-content {
            padding: 80px 0;
            background-color: var(--light-gray);
        }

        .cookie-section {
            background-color: var(--white);
            padding: 3rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .cookie-section h2 {
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 0.5rem;
        }

        .cookie-section h3 {
            color: var(--primary-blue);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .cookie-section ul {
            padding-left: 1.5rem;
        }

        .cookie-section li {
            margin-bottom: 0.5rem;
        }

        .cookie-table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
        }

        .cookie-table th, .cookie-table td {
            border: 1px solid var(--medium-gray);
            padding: 12px;
            text-align: left;
        }

        .cookie-table th {
            background-color: var(--light-gray);
            font-weight: 600;
        }

        .cookie-table tr:nth-child(even) {
            background-color: var(--light-gray);
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
            .cookie-section {
                padding: 2rem 1.5rem;
            }
            
            .cookie-table {
                display: block;
                overflow-x: auto;
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
                <h1 class="display-4 fw-bold mb-4">Cookie Policy</h1>
                <p class="lead mb-4">How we use cookies and similar technologies</p>
                <p class="mb-0">Last updated: <strong id="current-date"></strong></p>
            </div>
        </section>

        <section class="cookie-content">
            <div class="container">
                <div class="cookie-section">
                    <h2>What Are Cookies</h2>
                    <p>Cookies are small text files that are placed on your computer or mobile device when you visit our website. They are widely used to make websites work more efficiently and provide information to the website owners.</p>

                    <h3>How We Use Cookies</h3>
                    <p>AMATETA Techs & Designs uses cookies for several purposes, including:</p>
                    <ul>
                        <li>To enable certain functions of the website</li>
                        <li>To provide analytics about how visitors use our site</li>
                        <li>To store your preferences and improve user experience</li>
                        <li>To deliver targeted advertisements where applicable</li>
                        <li>To understand how visitors interact with our content</li>
                    </ul>

                    <h3>Types of Cookies We Use</h3>
                    <table class="cookie-table">
                        <thead>
                            <tr>
                                <th>Cookie Type</th>
                                <th>Purpose</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Essential Cookies</strong></td>
                                <td>These cookies are necessary for the website to function properly. They enable basic functions like page navigation and access to secure areas of the website.</td>
                                <td>Session or up to 1 year</td>
                            </tr>
                            <tr>
                                <td><strong>Performance Cookies</strong></td>
                                <td>These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously.</td>
                                <td>Up to 2 years</td>
                            </tr>
                            <tr>
                                <td><strong>Functionality Cookies</strong></td>
                                <td>These cookies allow the website to remember choices you make and provide enhanced, more personal features.</td>
                                <td>Up to 1 year</td>
                            </tr>
                            <tr>
                                <td><strong>Targeting Cookies</strong></td>
                                <td>These cookies may be set through our site by our advertising partners to build a profile of your interests.</td>
                                <td>Up to 1 year</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Third-Party Cookies</h3>
                    <p>In addition to our own cookies, we may also use various third-party cookies to report usage statistics of the website, deliver advertisements on and through the website, and so on. These may include:</p>
                    <ul>
                        <li><strong>Google Analytics:</strong> For understanding how visitors use our site</li>
                        <li><strong>Facebook Pixel:</strong> For measuring the effectiveness of our advertising</li>
                        <li><strong>Hotjar:</strong> For understanding user behavior through heatmaps and session recordings</li>
                    </ul>

                    <h3>Managing Cookies</h3>
                    <p>You can control and/or delete cookies as you wish. You can delete all cookies that are already on your computer and you can set most browsers to prevent them from being placed. However, if you do this, you may have to manually adjust some preferences every time you visit a site and some services and functionalities may not work.</p>
                    
                    <h4>Browser Settings</h4>
                    <p>Most web browsers allow some control of most cookies through the browser settings. To find out more about cookies, including how to see what cookies have been set and how to manage and delete them, visit <a href="https://www.aboutcookies.org" target="_blank">www.aboutcookies.org</a> or <a href="https://www.allaboutcookies.org" target="_blank">www.allaboutcookies.org</a>.</p>

                    <h4>Opt-Out Tools</h4>
                    <p>You can opt out of tracking by Google Analytics by installing the Google Analytics opt-out browser add-on, available at: <a href="https://tools.google.com/dlpage/gaoptout" target="_blank">https://tools.google.com/dlpage/gaoptout</a></p>

                    <h3>Your Choices Regarding Cookies</h3>
                    <p>When you first visit our website, you will be presented with a cookie banner that allows you to:</p>
                    <ul>
                        <li>Accept all cookies</li>
                        <li>Reject non-essential cookies</li>
                        <li>Customize your cookie preferences</li>
                    </ul>
                    <p>You can change your cookie preferences at any time by clicking on the "Cookie Settings" link in the footer of our website.</p>

                    <h3>Changes to This Cookie Policy</h3>
                    <p>We may update our Cookie Policy from time to time. We will notify you of any changes by posting the new Cookie Policy on this page and updating the "Last updated" date.</p>

                    <h3>Contact Us</h3>
                    <p>If you have any questions about our use of cookies, please contact us:</p>
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
        
        // Set current date in cookie policy
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