
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NOT NULL,
  `email` varchar(160) NOT NULL,
  `phone` varchar(60) DEFAULT '',
  `service` varchar(160) DEFAULT '',
  `subject` varchar(200) DEFAULT '',
  `message` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT '',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `body` mediumtext DEFAULT NULL,
  `sent_count` int(11) DEFAULT 0,
  `fail_count` int(11) DEFAULT 0,
  `sent_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `portfolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(180) NOT NULL,
  `url` varchar(255) DEFAULT '',
  `category` varchar(120) DEFAULT '',
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `portfolio` WRITE;
/*!40000 ALTER TABLE `portfolio` DISABLE KEYS */;
INSERT INTO `portfolio` (`id`, `title`, `url`, `category`, `description`, `image`, `sort_order`, `active`, `created_at`, `category_id`) VALUES (1,'Amateta Technology Solutions','https://www.amateta.com','Corporate Websites','Flagship technology & graphics company website.','uploads/portfolio/portfolio_20260621165931_dd80fb2f.png',0,1,'2026-06-21 13:29:17',1),(2,'Amateta Online Shop','https://shop.amateta.com','E-Commerce','Full online store with cart, checkout and product management.','uploads/portfolio/portfolio_20260621170155_05d24d7c.png',1,1,'2026-06-21 13:29:17',2),(3,'Astuteness Technologies','https://www.astutenesstechs.com','Corporate Websites','IT & hardware solutions company website.','uploads/portfolio/portfolio_20260621170242_5b2168bb.png',2,1,'2026-06-21 13:29:17',1),(4,'City Wing Shuttles','https://www.citywingshuttles.com','Web Apps & Systems','Shuttle booking and transport platform.','uploads/portfolio/portfolio_20260621170356_011cbaac.png',3,1,'2026-06-21 13:29:17',3),(5,'Amateta Invoice System','https://invoice.amateta.com','Web Apps & Systems','Free online invoice generator for businesses.','uploads/portfolio/portfolio_20260621170434_a49c33ad.png',4,1,'2026-06-21 13:29:17',3),(6,'ATL Home Décor','https://www.atlhomedec.com','E-Commerce','Home décor online store and catalogue.','uploads/portfolio/portfolio_20260621170530_05e17206.png',5,1,'2026-06-21 13:29:17',2),(7,'Africa College of Technology','https://www.africacollegetech.com','Education','College website with courses and applications.','uploads/portfolio/portfolio_20260621170552_91e629b0.png',6,1,'2026-06-21 13:29:17',4),(8,'Hunting Namibia Safaris','https://huntingnamibiasafaris.com','Tourism & Travel','Safari & hunting tours booking website.','uploads/portfolio/portfolio_20260621170617_b38df7bb.png',7,1,'2026-06-21 13:29:17',5);
/*!40000 ALTER TABLE `portfolio` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `portfolio_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NOT NULL,
  `slug` varchar(160) DEFAULT '',
  `icon` varchar(60) DEFAULT 'fas fa-folder',
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `portfolio_categories` WRITE;
/*!40000 ALTER TABLE `portfolio_categories` DISABLE KEYS */;
INSERT INTO `portfolio_categories` (`id`, `name`, `slug`, `icon`, `description`, `sort_order`, `active`, `created_at`) VALUES (1,'Corporate Websites','corporate-websites','fas fa-globe','Business and company websites.',0,1,'2026-06-21 15:25:01'),(2,'E-Commerce','e-commerce','fas fa-cart-shopping','Online shops and stores.',1,1,'2026-06-21 15:25:01'),(3,'Web Apps & Systems','web-apps','fas fa-gears','Booking systems, invoicing and custom software.',2,1,'2026-06-21 15:25:01'),(4,'Education','education','fas fa-graduation-cap','College and school platforms.',3,1,'2026-06-21 15:25:01'),(5,'Tourism & Travel','tourism','fas fa-plane','Safari, shuttle and travel websites.',4,1,'2026-06-21 15:25:01');
/*!40000 ALTER TABLE `portfolio_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(180) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT '',
  `badge` varchar(60) DEFAULT 'SALE',
  `old_price` varchar(60) DEFAULT '',
  `new_price` varchar(60) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`id`, `title`, `description`, `image`, `badge`, `old_price`, `new_price`, `link`, `sort_order`, `active`, `created_at`) VALUES (1,'Website Starter Special','A professional 5-page business website with hosting for your first year. Limited-time launch offer!','uploads/sales/sales_20260621182417_3e9026c0.png','HOT DEAL','N$4500','N$2999','contact.php',0,1,'2026-06-21 18:00:47'),(2,'Company Stamp Combo','Self-inking company stamp + official round seal bundle. Same-day service.','uploads/sales/sales_20260621182553_9a8b54f5.png','20% OFF','N$650','N$520','stamps.php',1,1,'2026-06-21 18:00:48'),(3,'Pull Up Banner','Fast Printing, One Day Delivery, Free Design','uploads/sales/sales_20260621182833_7af213c3.png','SAVE','N$1400','N$1050','Services.php',2,1,'2026-06-21 18:00:48');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NOT NULL,
  `slug` varchar(160) DEFAULT '',
  `icon` varchar(60) DEFAULT 'fas fa-layer-group',
  `image` varchar(255) DEFAULT '',
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` (`id`, `name`, `slug`, `icon`, `image`, `description`, `sort_order`, `active`, `created_at`) VALUES (1,'Web & Hosting','web-hosting','fas fa-code','','Websites, e-commerce, hosting, domains and web applications.',0,1,'2026-06-21 15:13:45'),(2,'Digital Marketing','digital-marketing','fas fa-bullhorn','','SEO, social media, ads and brand growth.',1,1,'2026-06-21 15:13:45'),(3,'Graphic Design','graphic-design','fas fa-palette','','Logos, branding and creative design.',2,1,'2026-06-21 15:13:45'),(4,'Printing','printing','fas fa-print','','Corporate printing, apparel, booklets and stationery.',3,1,'2026-06-21 15:13:45'),(5,'Company Stamps','stamps','fas fa-stamp','','All types of company and personal stamps.',4,1,'2026-06-21 15:13:45'),(6,'IT & Networks','it-networks','fas fa-network-wired','','CCTV, WiFi, IT support and equipment.',5,1,'2026-06-21 15:13:45');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(160) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(60) DEFAULT 'fas fa-star',
  `color` varchar(60) DEFAULT 'linear-gradient(135deg,#00b4d8,#0077b6)',
  `image` varchar(255) DEFAULT '',
  `tag` varchar(160) DEFAULT '',
  `wa_text` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `featured` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT 0,
  `link` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `color`, `image`, `tag`, `wa_text`, `sort_order`, `featured`, `active`, `created_at`, `category_id`, `link`) VALUES (1,'Website Development','Custom, responsive websites, e-commerce stores and web applications built with modern technology for exceptional performance.','fas fa-code','linear-gradient(135deg,#00b4d8,#0077b6)','images/astuteness.png','HTML · PHP · React · WordPress','I would like a quote for Website Development',0,1,1,'2026-06-21 13:29:17',1,'web-development.php'),(2,'Hosting & Domain Registration','Reliable web hosting, domain registration, SSL certificates and domain transfers with 99.9% uptime guarantee and expert support.','fas fa-server','linear-gradient(135deg,#f77f00,#e36200)','images/web-development-hero.jpg','.com · .na · .co.na · SSL','I would like Hosting / Domain registration',1,1,1,'2026-06-21 13:29:17',1,'hosting-domains.php'),(3,'Website Management','Ongoing maintenance, security updates, content updates, performance optimization and backups to keep your website running perfectly.','fas fa-tools','linear-gradient(135deg,#3949ab,#283593)','images/web management.avif','Security · Updates · Backups','I need Website Management / Maintenance',2,0,1,'2026-06-21 13:29:17',1,'web-development.php'),(4,'24/7 IT Support','Round-the-clock technical support for all IT infrastructure, networks, hardware troubleshooting and software issues.','fas fa-headset','linear-gradient(135deg,#00897b,#004d40)','images/Network Suport.jpg','Hardware · Software · Network','I need IT Support',3,0,1,'2026-06-21 13:29:17',6,'it-support.php'),(5,'Digital Marketing','SEO, social media marketing, Google Ads, Facebook Ads, content marketing and brand strategy to grow your online presence and drive sales.','fas fa-bullhorn','linear-gradient(135deg,#c2185b,#880e4f)','images/Ads.jpg','SEO · Social · PPC · Content','I want Digital Marketing services',4,0,1,'2026-06-21 13:29:17',2,'digital-marketing.php'),(6,'Graphic Design & Branding','Logos, brand identity, marketing materials, social media graphics, corporate branding and full visual design for your business.','fas fa-palette','linear-gradient(135deg,#7b1fa2,#4a148c)','images/branding.png','Logo · Brand · Print Design','I need Graphic Design / Branding',5,0,1,'2026-06-21 13:29:17',3,'graphic-design.php'),(7,'Corporate Printing & Apparel','Custom T-shirt printing, uniforms, branded polo shirts, workwear and promotional merchandise for corporate events and teams.','fas fa-tshirt','linear-gradient(135deg,#00b4d8,#0077b6)','images/office.jpg','T-Shirts · Uniforms · Promo Wear','I want Corporate Printing / Apparel',6,0,1,'2026-06-21 13:29:17',4,'printing-services.php'),(8,'Booklets, Brochures & Stationery','Professional printing of booklets, brochures, flyers, business cards, letterheads, envelopes and all corporate stationery.','fas fa-print','linear-gradient(135deg,#f77f00,#e36200)','images/books.JPG','Booklets · Flyers · Business Cards','I need Printing / Stationery',7,0,1,'2026-06-21 13:29:17',4,'printing-services.php'),(9,'Company Stamps','All stamp types — self-inking, pre-inked, round company seals, signature and date stamps. Same-day service available.','fas fa-stamp','linear-gradient(135deg,#9c27b0,#6a1b9a)','images/Self-Inking Stamps.jpg','Self-Inking · Pre-Inked · Round','I would like to order a Company Stamp',8,1,1,'2026-06-21 13:29:17',5,'stamps.php'),(10,'CCTV Camera Installation','Complete CCTV security systems — HD, 4K, PTZ, dome, bullet and wireless cameras with remote viewing and professional installation.','fas fa-video','linear-gradient(135deg,#00b4d8,#0077b6)','images/cctv.png','HD / 4K · Night Vision · Remote','I need CCTV installation',9,0,1,'2026-06-21 13:29:17',6,'it-support.php'),(11,'Network & WiFi Setup','Network infrastructure design and professional WiFi installation — fast, secure and reliable connectivity for business and home.','fas fa-wifi','linear-gradient(135deg,#f77f00,#e36200)','images/WIFI.avif','Mesh · Security · Cabling','I need Network / WiFi setup',10,0,1,'2026-06-21 13:29:17',6,'it-support.php'),(12,'Book Publishing','From manuscript to finished book — ghostwriting, editing, ISBN registration, cover design, printing and distribution.','fas fa-book-open','linear-gradient(135deg,#3949ab,#283593)','images/books.JPG','Writing · Editing · Publishing','I am interested in Book Publishing',11,0,1,'2026-06-21 13:29:17',1,'');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skey` varchar(120) NOT NULL,
  `svalue` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skey` (`skey`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `skey`, `svalue`) VALUES (1,'company_name','AMATETA Techs & Designs'),(2,'site_url','https://www.amateta.com'),(3,'tagline','Premium Technology & Graphics Solutions in Namibia'),(4,'whatsapp_number','264853441248'),(5,'contact_email','info@amateta.com'),(6,'support_email','support@amateta.com'),(7,'order_email','order@amateta.com'),(8,'contact_phone','+264 85 344 1248'),(9,'address_main','Bismark Street 36, Windhoek West, Simeone Shihungileni Road, Windhoek, Namibia'),(10,'address_shop',''),(11,'social_facebook','https://www.facebook.com/profile.php?id=61565523041653'),(12,'social_linkedin','https://www.linkedin.com/in/frans-haufiku-91587a241'),(13,'social_instagram','https://www.instagram.com/a.techs.designs'),(14,'stat_projects','240'),(15,'stat_clients','500'),(16,'stat_years','4'),(17,'hero_title','Premium <span>Technology</span> & Graphics Solutions in Namibia'),(18,'hero_desc','Web development, hosting & domains, graphic design, printing, CCTV, company stamps, digital marketing and IT support — all under one roof in Windhoek.'),(19,'email_logo','https://www.amateta.com/images/OUR%20LOGO%20WHITE.png'),(20,'from_email','info@amateta.com'),(21,'from_name','AMATETA Techs & Designs'),(22,'smtp_host',''),(23,'smtp_port','587'),(24,'smtp_user',''),(25,'smtp_pass',''),(26,'smtp_secure','tls'),(27,'logo','images/OUR LOGO REVISED.png'),(28,'logo_white','images/OUR LOGO WHITE.png');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT '',
  `subtitle` varchar(300) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `button_text` varchar(80) DEFAULT '',
  `button_link` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` (`id`, `title`, `subtitle`, `image`, `button_text`, `button_link`, `sort_order`, `active`, `created_at`) VALUES (1,'Premium Web Development','Custom, responsive websites & e-commerce platforms','images/slide1.avif','Explore Services','services.php',0,1,'2026-06-21 13:29:17'),(2,'Hosting & Domain Registration','Reliable hosting, .com & .na domains, SSL certificates','images/slide2.webp','Get Hosting','services.php#hosting',1,1,'2026-06-21 13:29:17'),(3,'CCTV & Network Installation','Secure your home & business with HD/4K systems','images/slide3.jpeg','Secure Now','contact.php',2,1,'2026-06-21 13:29:17'),(4,'Graphic Design & Branding','Logos, brand identity and full corporate design','images/slide4.jpeg','Start a Brand','contact.php',3,1,'2026-06-21 13:29:17'),(5,'Company Stamps & Printing','All stamp types and corporate printing — same-day service','images/slide5.jpg','Order Stamps','stamps.php',4,1,'2026-06-21 13:29:17');
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `stamp_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stamp_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) NOT NULL,
  `description` varchar(300) DEFAULT '',
  `icon` varchar(60) DEFAULT 'fas fa-stamp',
  `image` varchar(255) DEFAULT '',
  `wa_text` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `stamp_services` WRITE;
/*!40000 ALTER TABLE `stamp_services` DISABLE KEYS */;
INSERT INTO `stamp_services` (`id`, `name`, `description`, `icon`, `image`, `wa_text`, `sort_order`, `active`, `created_at`) VALUES (1,'Self-Inking Stamps','No ink pad needed — thousands of clean impressions.','fas fa-stamp','','I would like to order: Self-Inking Stamps',0,1,'2026-06-21 18:00:47'),(2,'Pre-Inked Stamps','Crisp, professional detail for official use.','fas fa-circle','','I would like to order: Pre-Inked Stamps',1,1,'2026-06-21 18:00:47'),(3,'Company Round Stamps','Official seal for documents & certificates.','fas fa-building','','I would like to order: Company Round Stamps',2,1,'2026-06-21 18:00:47'),(4,'Signature Stamps','Personalised stamps for officials & managers.','fas fa-user-tie','','I would like to order: Signature Stamps',3,1,'2026-06-21 18:00:47'),(5,'School & Institution Stamps','For schools, churches, NGOs & more.','fas fa-graduation-cap','','I would like to order: School & Institution Stamps',4,1,'2026-06-21 18:00:47'),(6,'Date & Received Stamps','Date-adjustable: received, paid, approved.','fas fa-calendar-check','','I would like to order: Date & Received Stamps',5,1,'2026-06-21 18:00:47');
/*!40000 ALTER TABLE `stamp_services` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(160) NOT NULL,
  `name` varchar(160) DEFAULT '',
  `ip` varchar(45) DEFAULT '',
  `status` enum('active','unsubscribed') DEFAULT 'active',
  `token` varchar(64) DEFAULT '',
  `subscribed_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NOT NULL,
  `role` varchar(160) DEFAULT '',
  `photo` varchar(255) DEFAULT '',
  `bio` text DEFAULT NULL,
  `email` varchar(160) DEFAULT '',
  `phone` varchar(60) DEFAULT '',
  `facebook` varchar(255) DEFAULT '',
  `linkedin` varchar(255) DEFAULT '',
  `instagram` varchar(255) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` (`id`, `name`, `role`, `photo`, `bio`, `email`, `phone`, `facebook`, `linkedin`, `instagram`, `sort_order`, `active`, `created_at`) VALUES (1,'Frans Haufiku','Founder & Lead Developer','images/Frans.jpeg','Full-stack developer leading AMATETA\'s web, hosting and software projects across Namibia.','','','','','',0,1,'2026-06-21 13:29:17'),(2,'AMATETA Creative','Design & Branding Team','','Our in-house designers craft logos, brand identities and print-ready corporate materials.','','','','','',1,1,'2026-06-21 13:29:17'),(3,'AMATETA Tech Support','IT & Networks Team','','Certified technicians handling CCTV, networking, hardware and 24/7 IT support.','','','','','',2,1,'2026-06-21 13:29:17');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) DEFAULT '',
  `page` varchar(191) DEFAULT '',
  `referrer` varchar(255) DEFAULT '',
  `user_agent` varchar(255) DEFAULT '',
  `device` varchar(20) DEFAULT '',
  `visited_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `visited_at` (`visited_at`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `visitors` WRITE;
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

