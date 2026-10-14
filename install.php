<?php
/**
 * One-click installer / updater.
 * Creates the database, all tables and seed data. Safe to re-run (idempotent).
 */
define('AMATETA_INSTALLER', true);
require_once __DIR__ . '/config/config.php';

/* ----------  Access control  ----------
 * The first run is open (there is nothing to protect yet). Once the site is
 * installed a lock file is written, and from then on only a signed-in admin
 * may re-run the installer — otherwise anyone on the internet could rebuild
 * the database. Delete config/installed.lock to unlock a fresh install. */
define('INSTALL_LOCK', APP_ROOT . '/config/installed.lock');

// A site is "already installed" if the lock file exists OR an admin account is
// already in the database — the second test protects an existing live site the
// moment these files are uploaded, before the lock file has ever been written.
$__installed = file_exists(INSTALL_LOCK);
if (!$__installed) {
    try {
        $__installed = (int) db()->query('SELECT COUNT(*) FROM admins')->fetchColumn() > 0;
    } catch (Throwable $e) {
        $__installed = false; // no database yet — genuine first run
    }
}

if ($__installed && empty($_SESSION['admin'])) {
    http_response_code(403);
    exit('<!DOCTYPE html><html><head><meta charset="UTF-8">'
       . '<meta name="viewport" content="width=device-width,initial-scale=1">'
       . '<title>Installer locked</title></head>'
       . '<body style="font-family:Segoe UI,Arial,sans-serif;background:#eef3f8;color:#0a2540;padding:60px 20px;text-align:center;">'
       . '<h2>🔒 The installer is locked</h2>'
       . '<p>This website is already installed. Sign in to the admin panel first if you need to run the updater.</p>'
       . '<p><a href="' . e(url('admin/login.php')) . '" style="color:#0077b6;">Go to admin login</a> &nbsp;·&nbsp; '
       . '<a href="' . e(url('index.php')) . '" style="color:#0077b6;">Back to website</a></p>'
       . '</body></html>');
}

$log = [];
$ok  = true;
$newAdminPassword = null;

try {
    /* 1. Connect without a database and create it */
    $root = new PDO('mysql:host=' . DB_HOST . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $root->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    $log[] = 'Database `' . DB_NAME . '` ready.';

    $pdo = db(); // now connects to the database

    /* 2. Tables */
    $tables = [
        'admins' => "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(120) NOT NULL,
            email VARCHAR(160) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'settings' => "CREATE TABLE IF NOT EXISTS settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            skey VARCHAR(120) NOT NULL UNIQUE,
            svalue TEXT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'slides' => "CREATE TABLE IF NOT EXISTS slides (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(200) DEFAULT '',
            subtitle VARCHAR(300) DEFAULT '',
            image VARCHAR(255) DEFAULT '',
            button_text VARCHAR(80) DEFAULT '',
            button_link VARCHAR(255) DEFAULT '',
            sort_order INT DEFAULT 0,
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'service_categories' => "CREATE TABLE IF NOT EXISTS service_categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(160) NOT NULL,
            slug VARCHAR(160) DEFAULT '',
            icon VARCHAR(60) DEFAULT 'fas fa-layer-group',
            image VARCHAR(255) DEFAULT '',
            description TEXT,
            sort_order INT DEFAULT 0,
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'services' => "CREATE TABLE IF NOT EXISTS services (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(160) NOT NULL,
            description TEXT,
            icon VARCHAR(60) DEFAULT 'fas fa-star',
            color VARCHAR(60) DEFAULT 'linear-gradient(135deg,#00b4d8,#0077b6)',
            image VARCHAR(255) DEFAULT '',
            tag VARCHAR(160) DEFAULT '',
            wa_text VARCHAR(255) DEFAULT '',
            sort_order INT DEFAULT 0,
            featured TINYINT(1) DEFAULT 0,
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'team' => "CREATE TABLE IF NOT EXISTS team (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(160) NOT NULL,
            role VARCHAR(160) DEFAULT '',
            photo VARCHAR(255) DEFAULT '',
            bio TEXT,
            email VARCHAR(160) DEFAULT '',
            phone VARCHAR(60) DEFAULT '',
            facebook VARCHAR(255) DEFAULT '',
            linkedin VARCHAR(255) DEFAULT '',
            instagram VARCHAR(255) DEFAULT '',
            sort_order INT DEFAULT 0,
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'portfolio' => "CREATE TABLE IF NOT EXISTS portfolio (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(180) NOT NULL,
            url VARCHAR(255) DEFAULT '',
            category VARCHAR(120) DEFAULT '',
            description TEXT,
            image VARCHAR(255) DEFAULT '',
            sort_order INT DEFAULT 0,
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'subscribers' => "CREATE TABLE IF NOT EXISTS subscribers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(160) NOT NULL UNIQUE,
            name VARCHAR(160) DEFAULT '',
            ip VARCHAR(45) DEFAULT '',
            status ENUM('active','unsubscribed') DEFAULT 'active',
            token VARCHAR(64) DEFAULT '',
            subscribed_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'messages' => "CREATE TABLE IF NOT EXISTS messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(160) NOT NULL,
            email VARCHAR(160) NOT NULL,
            phone VARCHAR(60) DEFAULT '',
            service VARCHAR(160) DEFAULT '',
            subject VARCHAR(200) DEFAULT '',
            message TEXT,
            ip VARCHAR(45) DEFAULT '',
            is_read TINYINT(1) DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'visitors' => "CREATE TABLE IF NOT EXISTS visitors (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ip VARCHAR(45) DEFAULT '',
            page VARCHAR(191) DEFAULT '',
            referrer VARCHAR(255) DEFAULT '',
            user_agent VARCHAR(255) DEFAULT '',
            device VARCHAR(20) DEFAULT '',
            visited_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX(visited_at), INDEX(ip)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'sales' => "CREATE TABLE IF NOT EXISTS sales (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(180) NOT NULL,
            description TEXT,
            image VARCHAR(255) DEFAULT '',
            badge VARCHAR(60) DEFAULT 'SALE',
            old_price VARCHAR(60) DEFAULT '',
            new_price VARCHAR(60) DEFAULT '',
            link VARCHAR(255) DEFAULT '',
            sort_order INT DEFAULT 0,
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'stamp_services' => "CREATE TABLE IF NOT EXISTS stamp_services (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(180) NOT NULL,
            description VARCHAR(300) DEFAULT '',
            icon VARCHAR(60) DEFAULT 'fas fa-stamp',
            image VARCHAR(255) DEFAULT '',
            wa_text VARCHAR(255) DEFAULT '',
            sort_order INT DEFAULT 0,
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        'newsletters' => "CREATE TABLE IF NOT EXISTS newsletters (
            id INT AUTO_INCREMENT PRIMARY KEY,
            subject VARCHAR(200) NOT NULL,
            body MEDIUMTEXT,
            sent_count INT DEFAULT 0,
            fail_count INT DEFAULT 0,
            sent_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    ];

    foreach ($tables as $name => $sql) {
        $pdo->exec($sql);
        $log[] = "Table `$name` ready.";
    }

    // Link services to a category + a detail-page link (idempotent)
    try { $pdo->exec('ALTER TABLE services ADD COLUMN IF NOT EXISTS category_id INT DEFAULT 0'); } catch (Throwable $e) {}
    try { $pdo->exec("ALTER TABLE services ADD COLUMN IF NOT EXISTS link VARCHAR(255) DEFAULT ''"); } catch (Throwable $e) {}
    // Portfolio category support
    $pdo->exec("CREATE TABLE IF NOT EXISTS portfolio_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(160) NOT NULL,
        slug VARCHAR(160) DEFAULT '',
        icon VARCHAR(60) DEFAULT 'fas fa-folder',
        description TEXT,
        sort_order INT DEFAULT 0,
        active TINYINT(1) DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    try { $pdo->exec('ALTER TABLE portfolio ADD COLUMN IF NOT EXISTS category_id INT DEFAULT 0'); } catch (Throwable $e) {}

    // Admin brute-force throttle log
    $pdo->exec("CREATE TABLE IF NOT EXISTS login_attempts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip VARCHAR(45) NOT NULL,
        email VARCHAR(160) DEFAULT '',
        attempted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_ip (ip),
        INDEX idx_time (attempted_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    /* 3. Seed admin */
    $exists = (int) $pdo->query('SELECT COUNT(*) FROM admins')->fetchColumn();
    if ($exists === 0) {
        $newAdminPassword = bin2hex(random_bytes(8));
        $stmt = $pdo->prepare('INSERT INTO admins (name, email, password) VALUES (?,?,?)');
        $stmt->execute(['AMATETA Admin', 'admin@amateta.com', password_hash($newAdminPassword, PASSWORD_DEFAULT)]);
        $log[] = 'Admin account created → admin@amateta.com';
    } else {
        $log[] = 'Admin account already exists (skipped).';
    }

    /* 4. Seed settings (only missing keys) */
    $defaults = [
        'company_name'     => COMPANY_NAME,
        'site_url'         => 'https://www.amateta.com',
        'tagline'          => 'Premium Technology & Graphics Solutions in Namibia',
        'logo'             => 'images/OUR LOGO REVISED.png',
        'logo_white'       => 'images/OUR LOGO WHITE.png',
        'whatsapp_number'  => DEFAULT_WHATSAPP,
        'contact_email'    => 'info@amateta.com',
        'support_email'    => 'support@amateta.com',
        'order_email'      => 'order@amateta.com',
        'contact_phone'    => '+264 85 344 1248',
        'address_main'     => 'Bismark Street 36, Windhoek West, Simeone Shihungileni Road, Windhoek, Namibia',
        'address_shop'     => '',
        'social_facebook'  => 'https://www.facebook.com/profile.php?id=61565523041653',
        'social_linkedin'  => 'https://www.linkedin.com/in/frans-haufiku-91587a241',
        'social_instagram' => 'https://www.instagram.com/a.techs.designs',
        'stat_projects'    => '240',
        'stat_clients'     => '500',
        'stat_years'       => '4',
        'hero_title'       => 'Premium <span>Technology</span> & Graphics Solutions in Namibia',
        'hero_desc'        => 'Web development, hosting & domains, graphic design, printing, CCTV, company stamps, digital marketing and IT support — all under one roof in Windhoek.',
        'email_logo'       => 'https://www.amateta.com/images/OUR%20LOGO%20WHITE.png',
        // Must be a real mailbox on our own domain or Gmail/Outlook reject
        // the confirmation emails we send to visitors.
        'from_email'       => ORDER_EMAIL,
        'from_name'        => COMPANY_NAME,
        // SMTP — left blank; admin fills in to enable real sending
        'smtp_host'        => '',
        'smtp_port'        => '587',
        'smtp_user'        => '',
        'smtp_pass'        => '',
        'smtp_secure'      => 'tls',
    ];
    // Existing installs: move the sending address onto the orders mailbox.
    // Sending as info@ while authenticating elsewhere made Gmail/Outlook drop
    // the confirmation emails addressed to visitors.
    $pdo->prepare("UPDATE settings SET svalue = ? WHERE skey = 'from_email' AND svalue IN ('info@amateta.com','')")
        ->execute([ORDER_EMAIL]);

    $insSetting = $pdo->prepare('INSERT IGNORE INTO settings (skey, svalue) VALUES (?,?)');
    foreach ($defaults as $k => $v) {
        $insSetting->execute([$k, $v]);
    }
    $log[] = 'Default settings seeded.';

    /* 5. Seed slides */
    if ((int) $pdo->query('SELECT COUNT(*) FROM slides')->fetchColumn() === 0) {
        $slides = [
            ['Premium Web Development', 'Custom, responsive websites & e-commerce platforms', 'images/slide1.avif', 'Explore Services', 'services.php'],
            ['Hosting & Domain Registration', 'Reliable hosting, .com & .na domains, SSL certificates', 'images/slide2.webp', 'Get Hosting', 'services.php#hosting'],
            ['CCTV & Network Installation', 'Secure your home & business with HD/4K systems', 'images/slide3.jpeg', 'Secure Now', 'contact.php'],
            ['Graphic Design & Branding', 'Logos, brand identity and full corporate design', 'images/slide4.jpeg', 'Start a Brand', 'contact.php'],
            ['Company Stamps & Printing', 'All stamp types and corporate printing — same-day service', 'images/slide5.jpg', 'Order Stamps', 'stamps.php'],
        ];
        $s = $pdo->prepare('INSERT INTO slides (title, subtitle, image, button_text, button_link, sort_order) VALUES (?,?,?,?,?,?)');
        foreach ($slides as $i => $row) {
            $s->execute([$row[0], $row[1], $row[2], $row[3], $row[4], $i]);
        }
        $log[] = '5 home-page slides seeded.';
    }

    /* 6. Seed services */
    if ((int) $pdo->query('SELECT COUNT(*) FROM services')->fetchColumn() === 0) {
        $services = [
            ['Mobile & Web App Development', 'Custom Android, iOS and web applications, customer portals and business systems—from product planning and UX design to launch and ongoing support.', 'fas fa-mobile-screen-button', 'linear-gradient(135deg,#00b4d8,#0077b6)', 'images/app-development-studio.webp', 'Android · iOS · Web Apps', 'I would like a quote for App Development', 1],
            ['Website Development', 'Custom, responsive websites, e-commerce stores and web applications built with modern technology for exceptional performance.', 'fas fa-code', 'linear-gradient(135deg,#00b4d8,#0077b6)', 'images/astuteness.png', 'HTML · PHP · React · WordPress', 'I would like a quote for Website Development', 1],
            ['Hosting & Domain Registration', 'Reliable web hosting, domain registration, SSL certificates and domain transfers with 99.9% uptime guarantee and expert support.', 'fas fa-server', 'linear-gradient(135deg,#f77f00,#e36200)', 'images/web-development-hero.jpg', '.com · .na · .co.na · SSL', 'I would like Hosting / Domain registration', 1],
            ['Website Management', 'Ongoing maintenance, security updates, content updates, performance optimization and backups to keep your website running perfectly.', 'fas fa-tools', 'linear-gradient(135deg,#3949ab,#283593)', 'images/web management.avif', 'Security · Updates · Backups', 'I need Website Management / Maintenance', 0],
            ['24/7 IT Support', 'Round-the-clock technical support for all IT infrastructure, networks, hardware troubleshooting and software issues.', 'fas fa-headset', 'linear-gradient(135deg,#00897b,#004d40)', 'images/Network Suport.jpg', 'Hardware · Software · Network', 'I need IT Support', 0],
            ['Digital Marketing', 'SEO, social media marketing, Google Ads, Facebook Ads, content marketing and brand strategy to grow your online presence and drive sales.', 'fas fa-bullhorn', 'linear-gradient(135deg,#c2185b,#880e4f)', 'images/Ads.jpg', 'SEO · Social · PPC · Content', 'I want Digital Marketing services', 0],
            ['Graphic Design & Branding', 'Logos, brand identity, marketing materials, social media graphics, corporate branding and full visual design for your business.', 'fas fa-palette', 'linear-gradient(135deg,#7b1fa2,#4a148c)', 'images/branding.png', 'Logo · Brand · Print Design', 'I need Graphic Design / Branding', 0],
            ['Corporate Printing & Apparel', 'Custom T-shirt printing, uniforms, branded polo shirts, workwear and promotional merchandise for corporate events and teams.', 'fas fa-tshirt', 'linear-gradient(135deg,#00b4d8,#0077b6)', 'images/office.jpg', 'T-Shirts · Uniforms · Promo Wear', 'I want Corporate Printing / Apparel', 0],
            ['Booklets, Brochures & Stationery', 'Professional printing of booklets, brochures, flyers, business cards, letterheads, envelopes and all corporate stationery.', 'fas fa-print', 'linear-gradient(135deg,#f77f00,#e36200)', 'images/books.JPG', 'Booklets · Flyers · Business Cards', 'I need Printing / Stationery', 0],
            ['Company Stamps', 'All stamp types — self-inking, pre-inked, round company seals, signature and date stamps. Same-day service available.', 'fas fa-stamp', 'linear-gradient(135deg,#9c27b0,#6a1b9a)', 'images/Self-Inking Stamps.jpg', 'Self-Inking · Pre-Inked · Round', 'I would like to order a Company Stamp', 1],
            ['CCTV Camera Installation', 'Complete CCTV security systems — HD, 4K, PTZ, dome, bullet and wireless cameras with remote viewing and professional installation.', 'fas fa-video', 'linear-gradient(135deg,#00b4d8,#0077b6)', 'images/cctv.png', 'HD / 4K · Night Vision · Remote', 'I need CCTV installation', 0],
            ['Network & WiFi Setup', 'Network infrastructure design and professional WiFi installation — fast, secure and reliable connectivity for business and home.', 'fas fa-wifi', 'linear-gradient(135deg,#f77f00,#e36200)', 'images/WIFI.avif', 'Mesh · Security · Cabling', 'I need Network / WiFi setup', 0],
            ['Book Publishing', 'From manuscript to finished book — ghostwriting, editing, ISBN registration, cover design, printing and distribution.', 'fas fa-book-open', 'linear-gradient(135deg,#3949ab,#283593)', 'images/books.JPG', 'Writing · Editing · Publishing', 'I am interested in Book Publishing', 0],
        ];
        $sv = $pdo->prepare('INSERT INTO services (title, description, icon, color, image, tag, wa_text, featured, sort_order) VALUES (?,?,?,?,?,?,?,?,?)');
        foreach ($services as $i => $row) {
            $sv->execute([$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $i]);
        }
        $log[] = count($services) . ' services seeded.';
    }
    // Existing installations receive the new app-development service once.
    if (!(int) $pdo->query("SELECT COUNT(*) FROM services WHERE title='Mobile & Web App Development'")->fetchColumn()) {
        $pdo->prepare('INSERT INTO services (title,description,icon,color,image,tag,wa_text,featured,sort_order,active) VALUES (?,?,?,?,?,?,?,?,?,1)')
            ->execute(['Mobile & Web App Development', 'Custom Android, iOS and web applications, customer portals and business systems—from product planning and UX design to launch and ongoing support.', 'fas fa-mobile-screen-button', 'linear-gradient(135deg,#00b4d8,#0077b6)', 'images/app-development-studio.webp', 'Android · iOS · Web Apps', 'I would like a quote for App Development', 1, 0]);
        $log[] = 'App development service added.';
    }

    /* 6b. Seed service categories (Printing & Stamps kept separate) */
    if ((int) $pdo->query('SELECT COUNT(*) FROM service_categories')->fetchColumn() === 0) {
        $cats = [
            ['Web & Hosting', 'web-hosting', 'fas fa-code', 'Websites, e-commerce, hosting, domains and web applications.'],
            ['Digital Marketing', 'digital-marketing', 'fas fa-bullhorn', 'SEO, social media, ads and brand growth.'],
            ['Graphic Design', 'graphic-design', 'fas fa-palette', 'Logos, branding and creative design.'],
            ['Printing', 'printing', 'fas fa-print', 'Corporate printing, apparel, booklets and stationery.'],
            ['Company Stamps', 'stamps', 'fas fa-stamp', 'All types of company and personal stamps.'],
            ['IT & Networks', 'it-networks', 'fas fa-network-wired', 'CCTV, WiFi, IT support and equipment.'],
        ];
        $ci = $pdo->prepare('INSERT INTO service_categories (name,slug,icon,description,sort_order) VALUES (?,?,?,?,?)');
        foreach ($cats as $i => $c) { $ci->execute([$c[0], $c[1], $c[2], $c[3], $i]); }
        $log[] = count($cats) . ' service categories seeded.';
    }
    // Assign services to categories by keyword (only those not yet assigned)
    $catMap = [];
    foreach ($pdo->query('SELECT id, slug FROM service_categories') as $r) { $catMap[$r['slug']] = $r['id']; }
    $assign = [
        'web-hosting'      => ['Mobile & Web App Development', 'Website Development', 'Hosting', 'Website Management', 'Book Publishing'],
        'digital-marketing' => ['Digital Marketing'],
        'graphic-design'   => ['Graphic Design'],
        'printing'         => ['Corporate Printing', 'Booklets'],
        'stamps'           => ['Company Stamps'],
        'it-networks'      => ['IT Support', 'CCTV', 'Network'],
    ];
    foreach ($assign as $slug => $keywords) {
        if (empty($catMap[$slug])) continue;
        foreach ($keywords as $kw) {
            $pdo->prepare('UPDATE services SET category_id=? WHERE category_id=0 AND title LIKE ?')->execute([$catMap[$slug], "%$kw%"]);
        }
    }
    $log[] = 'Services assigned to categories.';

    /* 6c. Link main services to their detail pages (only if not already set) */
    $links = [
        'Website Development'  => 'web-development.php',
        'Mobile & Web App Development' => 'app-development.php',
        'Website Management'   => 'web-development.php',
        'Hosting'              => 'hosting-domains.php',
        'Digital Marketing'    => 'digital-marketing.php',
        'Graphic Design'       => 'graphic-design.php',
        'Corporate Printing'   => 'printing-services.php',
        'Booklets'             => 'printing-services.php',
        'Company Stamps'       => 'stamps.php',
        'IT Support'           => 'it-support.php',
        'CCTV'                 => 'it-support.php',
        'Network'              => 'it-support.php',
    ];
    foreach ($links as $kw => $url) {
        $pdo->prepare("UPDATE services SET link=? WHERE (link='' OR link IS NULL) AND title LIKE ?")->execute([$url, "%$kw%"]);
    }
    // Migrate any old Hosting link to the new dedicated page
    $pdo->exec("UPDATE services SET link='hosting-domains.php' WHERE title LIKE '%Hosting%' AND link IN ('web-development.php','services.php','')");
    $log[] = 'Service detail-page links set.';

    /* 6d. Seed stamp services (shown on the Stamps page, admin-managed) */
    if ((int) $pdo->query('SELECT COUNT(*) FROM stamp_services')->fetchColumn() === 0) {
        $st = [
            ['Self-Inking Stamps', 'No ink pad needed — thousands of clean impressions.', 'fas fa-stamp'],
            ['Pre-Inked Stamps', 'Crisp, professional detail for official use.', 'fas fa-circle'],
            ['Company Round Stamps', 'Official seal for documents & certificates.', 'fas fa-building'],
            ['Signature Stamps', 'Personalised stamps for officials & managers.', 'fas fa-user-tie'],
            ['School & Institution Stamps', 'For schools, churches, NGOs & more.', 'fas fa-graduation-cap'],
            ['Date & Received Stamps', 'Date-adjustable: received, paid, approved.', 'fas fa-calendar-check'],
        ];
        $si = $pdo->prepare('INSERT INTO stamp_services (name,description,icon,wa_text,sort_order) VALUES (?,?,?,?,?)');
        foreach ($st as $i => $s) { $si->execute([$s[0], $s[1], $s[2], 'I would like to order: ' . $s[0], $i]); }
        $log[] = count($st) . ' stamp services seeded.';
    }

    /* 6e. Seed starter promos for the Home "On Sale" section (admin can edit/delete) */
    if ((int) $pdo->query('SELECT COUNT(*) FROM sales')->fetchColumn() === 0) {
        $promos = [
            ['Website Starter Special', 'A professional 5-page business website with hosting for your first year. Limited-time launch offer!', 'HOT DEAL', 'N$4500', 'N$2999', 'contact.php'],
            ['Company Stamp Combo', 'Self-inking company stamp + official round seal bundle. Same-day service.', '20% OFF', 'N$650', 'N$520', 'stamps.php'],
            ['Annual Hosting + Free Domain', 'Fast, secure hosting for one year and a FREE .com or .na domain.', 'SAVE', 'N$1800', 'N$1299', 'hosting-domains.php'],
        ];
        $sp = $pdo->prepare('INSERT INTO sales (title,description,badge,old_price,new_price,link,sort_order) VALUES (?,?,?,?,?,?,?)');
        foreach ($promos as $i => $p) { $sp->execute([$p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $i]); }
        $log[] = count($promos) . ' starter sale promos seeded.';
    }

    /* 7. Seed team */
    if ((int) $pdo->query('SELECT COUNT(*) FROM team')->fetchColumn() === 0) {
        $team = [
            ['Frans Haufiku', 'Founder & Lead Developer', 'images/Frans.jpeg', 'Full-stack developer leading AMATETA\'s web, hosting and software projects across Namibia.'],
            ['AMATETA Creative', 'Design & Branding Team', '', 'Our in-house designers craft logos, brand identities and print-ready corporate materials.'],
            ['AMATETA Tech Support', 'IT & Networks Team', '', 'Certified technicians handling CCTV, networking, hardware and 24/7 IT support.'],
        ];
        $tm = $pdo->prepare('INSERT INTO team (name, role, photo, bio, sort_order) VALUES (?,?,?,?,?)');
        foreach ($team as $i => $row) {
            $tm->execute([$row[0], $row[1], $row[2], $row[3], $i]);
        }
        $log[] = count($team) . ' team members seeded.';
    }

    /* 8. Seed portfolio (recently launched platforms) */
    if ((int) $pdo->query('SELECT COUNT(*) FROM portfolio')->fetchColumn() === 0) {
        $portfolio = [
            ['Amateta Technology Solutions', 'https://www.amateta.com', 'Corporate Website', 'Flagship technology & graphics company website.'],
            ['Amateta Online Shop', 'https://shop.amateta.com', 'E-Commerce', 'Full online store with cart, checkout and product management.'],
            ['Astuteness Technologies', 'https://www.astutenesstechs.com', 'Corporate Website', 'IT & hardware solutions company website.'],
            ['City Wing Shuttles', 'https://www.citywingshuttles.com', 'Booking System', 'Shuttle booking and transport platform.'],
            ['Amateta Invoice System', 'https://invoice.amateta.com', 'Web App', 'Free online invoice generator for businesses.'],
            ['ATL Home Décor', 'https://www.atlhomedec.com', 'E-Commerce', 'Home décor online store and catalogue.'],
            ['Africa College of Technology', 'https://www.africacollegetech.com', 'Education Portal', 'College website with courses and applications.'],
            ['Hunting Namibia Safaris', 'https://huntingnamibiasafaris.com', 'Tourism Website', 'Safari & hunting tours booking website.'],
        ];
        $pf = $pdo->prepare('INSERT INTO portfolio (title, url, category, description, sort_order) VALUES (?,?,?,?,?)');
        foreach ($portfolio as $i => $row) {
            $pf->execute([$row[0], $row[1], $row[2], $row[3], $i]);
        }
        $log[] = count($portfolio) . ' portfolio projects seeded.';
    }

    /* 8b. Portfolio categories — seed from existing project types and assign */
    if ((int) $pdo->query('SELECT COUNT(*) FROM portfolio_categories')->fetchColumn() === 0) {
        $pcats = [
            ['Corporate Websites', 'corporate-websites', 'fas fa-globe', 'Business and company websites.'],
            ['E-Commerce', 'e-commerce', 'fas fa-cart-shopping', 'Online shops and stores.'],
            ['Web Apps & Systems', 'web-apps', 'fas fa-gears', 'Booking systems, invoicing and custom software.'],
            ['Education', 'education', 'fas fa-graduation-cap', 'College and school platforms.'],
            ['Tourism & Travel', 'tourism', 'fas fa-plane', 'Safari, shuttle and travel websites.'],
        ];
        $pc = $pdo->prepare('INSERT INTO portfolio_categories (name,slug,icon,description,sort_order) VALUES (?,?,?,?,?)');
        foreach ($pcats as $i => $c) { $pc->execute([$c[0], $c[1], $c[2], $c[3], $i]); }
        $log[] = count($pcats) . ' portfolio categories seeded.';
    }
    // Map existing free-text project categories -> new category ids
    $pmap = [];
    foreach ($pdo->query('SELECT id, slug FROM portfolio_categories') as $r) { $pmap[$r['slug']] = $r['id']; }
    $passign = [
        'corporate-websites' => ['Corporate Website', 'Amateta Technology', 'Astuteness'],
        'e-commerce'         => ['E-Commerce', 'Shop', 'Home Décor', 'Home Decor'],
        'web-apps'           => ['Web App', 'Booking System', 'Invoice', 'System'],
        'education'          => ['Education', 'College'],
        'tourism'            => ['Tourism', 'Safari', 'Shuttle', 'Wing'],
    ];
    foreach ($passign as $slug => $keywords) {
        if (empty($pmap[$slug])) continue;
        foreach ($keywords as $kw) {
            $pdo->prepare('UPDATE portfolio SET category_id=? WHERE category_id=0 AND (category LIKE ? OR title LIKE ?)')
                ->execute([$pmap[$slug], "%$kw%", "%$kw%"]);
        }
    }
    $log[] = 'Portfolio projects assigned to categories.';

    /* 10. Lock the installer so it can never be re-run by the public. */
    if (@file_put_contents(INSTALL_LOCK, 'Installed ' . date('c') . "\n") !== false) {
        $log[] = 'Installer locked (config/installed.lock written).';
    } else {
        $log[] = 'WARNING: could not write config/installed.lock — delete install.php from the server manually.';
    }

} catch (Throwable $e) {
    $ok = false;
    $log[] = 'ERROR: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>AMATETA — Installer</title>
<style>
  body{margin:0;font-family:'Segoe UI',Arial,sans-serif;background:#0a2540;color:#fff;display:flex;min-height:100vh;align-items:center;justify-content:center;padding:24px;}
  .card{background:#fff;color:#0a2540;max-width:620px;width:100%;border-radius:18px;padding:38px;box-shadow:0 20px 60px rgba(0,0,0,.4);}
  h1{margin:0 0 6px;font-size:24px;}
  .sub{color:#5a7a99;margin:0 0 22px;font-size:14px;}
  .badge{display:inline-block;padding:6px 14px;border-radius:50px;font-size:13px;font-weight:700;margin-bottom:18px;}
  .ok{background:#e7f7ee;color:#1b8a4b;} .bad{background:#fdeaea;color:#c0392b;}
  ul{list-style:none;padding:0;margin:0 0 24px;}
  li{padding:9px 12px;border-bottom:1px solid #eef3f8;font-size:13.5px;display:flex;gap:8px;}
  li::before{content:'✓';color:#00b4d8;font-weight:800;}
  li.err::before{content:'✕';color:#c0392b;}
  .btns{display:flex;gap:12px;flex-wrap:wrap;}
  a.btn{flex:1;text-align:center;text-decoration:none;padding:13px;border-radius:50px;font-weight:700;font-size:14px;}
  .b1{background:linear-gradient(135deg,#00b4d8,#0077b6);color:#fff;}
  .b2{background:linear-gradient(135deg,#f77f00,#e36200);color:#fff;}
  .cred{background:#f4f8fc;border:1px solid #e1ebf5;border-radius:12px;padding:14px 16px;margin-bottom:22px;font-size:13.5px;}
  code{background:#0a2540;color:#00e0a4;padding:2px 7px;border-radius:5px;}
</style>
</head>
<body>
  <div class="card">
    <h1>AMATETA Installer</h1>
    <p class="sub">Database setup &amp; seed for <strong><?= e(COMPANY_NAME) ?></strong></p>
    <span class="badge <?= $ok ? 'ok' : 'bad' ?>"><?= $ok ? 'Installation successful' : 'Installation failed' ?></span>

    <?php if ($ok): ?>
      <div class="cred">
        <strong>Admin login</strong><br>
        URL: <code><?= e(url('admin/login.php')) ?></code><br>
        Email: <code>admin@amateta.com</code>
        <?php if ($newAdminPassword): ?>&nbsp; Temporary password: <code><?= e($newAdminPassword) ?></code><br><small>Save it now and change it immediately in Admin → Settings. It will not be shown again.</small><?php else: ?><br><small>Your existing password was preserved.</small><?php endif; ?>
      </div>
    <?php endif; ?>

    <ul>
      <?php foreach ($log as $line): ?>
        <li class="<?= str_starts_with($line, 'ERROR') ? 'err' : '' ?>"><?= e($line) ?></li>
      <?php endforeach; ?>
    </ul>

    <div class="btns">
      <a class="btn b1" href="<?= e(url('index.php')) ?>">View Website</a>
      <a class="btn b2" href="<?= e(url('admin/login.php')) ?>">Admin Panel</a>
    </div>
  </div>
</body>
</html>
