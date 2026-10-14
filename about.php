<?php require_once __DIR__ . "/config/config.php"; track_visitor($_SERVER["REQUEST_URI"] ?? "/about.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>About Us – AMATETA Techs & Designs | Technology & Graphics Company, Windhoek Namibia</title>
    <meta name="description" content="Learn about AMATETA Techs & Designs — our story, mission, vision, values, team and journey as Windhoek's premier technology and graphics company in Namibia.">
    <meta name="keywords" content="about AMATETA, technology company Namibia, graphics company Windhoek, IT services Namibia, web development company Windhoek, AMATETA story, AMATETA mission vision">
    <meta name="author" content="AMATETA Techs & Designs">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="About Us – AMATETA Techs & Designs | Windhoek, Namibia">
    <meta property="og:description" content="Discover the journey, values, and mission that drive AMATETA Techs & Designs — Windhoek's premier technology and graphics company.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.amateta.com/about.php">
    <link rel="canonical" href="https://www.amateta.com/about.php">
    <link rel="icon" href="images/fav.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ====== VARIABLES ====== */
        :root {
            --navy:    #0a2540;
            --navy2:   #03045e;
            --blue:    #00b4d8;
            --blue2:   #0077b6;
            --orange:  #f77f00;
            --orange2: #e36200;
            --purple:  #9c27b0;
            --purple2: #6a1b9a;
            --white:   #ffffff;
            --offwhite:#f4f8fc;
            --glass-bg: rgba(255,255,255,0.13);
            --glass-border: rgba(255,255,255,0.22);
            --glass-dark: rgba(10,37,64,0.55);
            --text-muted: #5a7a99;
            --shadow-card: 0 8px 32px rgba(10,37,64,0.13);
            --shadow-glass: 0 8px 32px rgba(0,0,0,0.18);
            --shadow-clean: 0 4px 20px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.05);
            --shadow-elevated: 0 10px 40px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.06);
            --radius: 16px;
            --radius-sm: 10px;
            --ff-head: 'Poppins', sans-serif;
            --ff-body: 'Inter', sans-serif;
            --transition: 0.3s cubic-bezier(.4,0,.2,1);
        }

        /* ====== RESET & BASE ====== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--ff-body);
            background: var(--offwhite);
            color: var(--navy);
            overflow-x: hidden;
            padding-top: 78px;
        }

        /* ====== BACKGROUND PATTERN ====== */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 900px 600px at 10% 20%, rgba(0,180,216,0.04) 0%, transparent 70%),
                radial-gradient(ellipse 700px 500px at 90% 80%, rgba(247,127,0,0.04) 0%, transparent 70%),
                linear-gradient(180deg, rgba(255,255,255,0.5) 0%, transparent 100%);
            pointer-events: none;
            z-index: 0;
        }
        body > * { position: relative; z-index: 1; }

        /* ====== SCROLLBAR ====== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--offwhite); }
        ::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 3px; }

        /* ====== UTILITY ====== */
        .container { width: 100%; max-width: 1220px; margin: 0 auto; padding: 0 20px; }
        .section-pad { padding: 88px 0; }
        .section-pad-sm { padding: 60px 0; }
        .text-center { text-align: center; }

        /* ====== SECTION LABEL ====== */
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--ff-head);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--orange);
            background: rgba(247,127,0,0.10);
            border: 1px solid rgba(247,127,0,0.22);
            border-radius: 50px;
            padding: 5px 14px;
            margin-bottom: 14px;
        }
        .section-title {
            font-family: var(--ff-head);
            font-size: clamp(1.7rem, 3.5vw, 2.6rem);
            font-weight: 800;
            color: var(--navy);
            line-height: 1.15;
            margin-bottom: 16px;
        }
        .section-title span { color: var(--blue); }
        .section-sub {
            font-size: 1.02rem;
            color: var(--text-muted);
            max-width: 560px;
            line-height: 1.7;
        }
        .text-center .section-sub { margin: 0 auto; }
        .divider {
            width: 52px;
            height: 4px;
            background: linear-gradient(90deg, var(--orange), var(--blue));
            border-radius: 4px;
            margin: 14px 0 28px;
        }
        .text-center .divider { margin: 14px auto 28px; }

        /* ====== BUTTONS ====== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-family: var(--ff-head);
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.4px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            white-space: nowrap;
            padding: 10px 22px;
            position: relative;
            z-index: 2;
            min-width: fit-content;
            box-shadow: var(--shadow-clean);
            line-height: 1.2;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--blue), var(--blue2));
            color: var(--white);
        }
        .btn-primary:hover { background: linear-gradient(135deg, var(--blue2), var(--navy)); transform: translateY(-2px); color: #fff; box-shadow: var(--shadow-elevated); }
        .btn-orange {
            background: linear-gradient(135deg, var(--orange), var(--orange2));
            color: var(--white);
        }
        .btn-orange:hover { background: linear-gradient(135deg, var(--orange2), #b94e00); transform: translateY(-2px); color: #fff; }
        .btn-outline-white {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.6);
            color: var(--white);
        }
        .btn-outline-white:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .btn-outline-navy {
            background: transparent;
            border: 2px solid var(--navy);
            color: var(--navy);
        }
        .btn-outline-navy:hover { background: var(--navy); color: #fff; }
        .btn-lg { padding: 13px 32px; font-size: 0.9rem; }
        .btn-sm { padding: 7px 16px; font-size: 0.75rem; }

        /* ====== NAVBAR - IDENTICAL TO INDEX ====== */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(10,37,64,0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,180,216,0.18);
            transition: var(--transition);
            height: 78px;
            display: flex;
            align-items: center;
        }
        .navbar.scrolled {
            height: 66px;
            background: rgba(3,4,94,0.97);
            box-shadow: 0 4px 32px rgba(0,0,0,0.25);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .nav-logo img {
            height: 54px;
            width: auto;
            transition: var(--transition);
        }
        .navbar.scrolled .nav-logo img { height: 44px; }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }
        .nav-links a {
            font-family: var(--ff-head);
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 7px 13px;
            border-radius: 8px;
            transition: var(--transition);
            letter-spacing: 0.3px;
            white-space: nowrap;
        }
        .nav-links a:hover, .nav-links a.active {
            color: var(--blue);
            background: rgba(0,180,216,0.1);
        }
        .nav-links a.stamps-link {
            color: #d580ff;
            border: 1px solid rgba(200,100,255,0.25);
        }
        .nav-links a.stamps-link:hover { background: rgba(200,100,255,0.12); }
        .nav-cta-wrap { display: flex; align-items: center; gap: 10px; }
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
            background: none;
            border: none;
        }
        .nav-hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: var(--transition);
        }

        /* Dropdown */
        .nav-dropdown { position: relative; }
        .nav-dropdown .dropdown-menu-nav {
            position: absolute;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%) translateY(8px);
            background: rgba(10,37,64,0.97);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0,180,216,0.2);
            border-radius: var(--radius-sm);
            min-width: 200px;
            padding: 8px;
            opacity: 0;
            pointer-events: none;
            transition: var(--transition);
            z-index: 100;
            list-style: none;
        }
        .nav-dropdown:hover .dropdown-menu-nav,
        .nav-dropdown.open .dropdown-menu-nav {
            opacity: 1;
            pointer-events: all;
            transform: translateX(-50%) translateY(0);
        }
        .dropdown-menu-nav a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border-radius: 8px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
        }
        .dropdown-menu-nav a i { width: 16px; color: var(--blue); }

        /* Mobile menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 78px; left: 0; right: 0;
            background: rgba(3,4,94,0.98);
            backdrop-filter: blur(20px);
            z-index: 999;
            padding: 20px;
            border-bottom: 1px solid rgba(0,180,216,0.2);
            transform: translateY(-10px);
            opacity: 0;
            transition: var(--transition);
        }
        .mobile-menu.open { display: block; transform: translateY(0); opacity: 1; }
        .mobile-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-family: var(--ff-head);
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px 8px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            transition: var(--transition);
        }
        .mobile-menu a:hover { color: var(--blue); }
        .mobile-menu a.stamps-link { color: #d580ff; }

        /* ====== ABOUT HERO ====== */
        .about-hero {
            background: linear-gradient(135deg, var(--navy2) 0%, #021a35 40%, var(--navy) 100%);
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }
        .about-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 800px 500px at 60% 40%, rgba(0,180,216,0.12) 0%, transparent 70%);
            z-index: 1;
        }
        .about-hero-inner {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }
        .about-hero-text { flex: 1; max-width: 600px; }
        .hero-badge-about {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(247,127,0,0.18);
            border: 1px solid rgba(247,127,0,0.35);
            border-radius: 50px;
            padding: 6px 16px;
            font-family: var(--ff-head);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #ffb347;
            margin-bottom: 20px;
        }
        .about-hero-text h1 {
            font-family: var(--ff-head);
            font-size: clamp(2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 18px;
        }
        .about-hero-text h1 span { color: var(--blue); }
        .about-hero-text .hero-desc {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.72);
            line-height: 1.75;
            margin-bottom: 28px;
        }
        .hero-btns-about { display: flex; gap: 12px; flex-wrap: wrap; }
        .about-hero-visual {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .about-floating-badge {
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(14px);
            border: 2px solid rgba(0,180,216,0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: floatBadge 4s ease-in-out infinite;
            position: relative;
        }
        .about-floating-badge .badge-icon {
            font-size: 3rem;
            color: var(--blue);
            margin-bottom: 10px;
        }
        .about-floating-badge .badge-num {
            font-family: var(--ff-head);
            font-size: 2.8rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }
        .about-floating-badge .badge-lbl {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.6);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .badge-edge-dot {
            position: absolute;
            width: 14px; height: 14px;
            border-radius: 50%;
            background: var(--blue);
            box-shadow: 0 0 12px rgba(0,180,216,0.6);
        }
        .badge-edge-dot:nth-child(4) { top: 20px; right: 25px; }
        .badge-edge-dot:nth-child(5) { bottom: 30px; right: 20px; }
        .badge-edge-dot:nth-child(6) { bottom: 20px; left: 30px; }
        .badge-edge-dot:nth-child(7) { top: 30px; left: 20px; }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-18px); }
        }

        /* ====== STORY CARDS ====== */
        .story-section { background: transparent; }
        .story-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 10px;
        }
        .story-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(0,119,182,0.1);
            border-radius: var(--radius);
            padding: 36px 28px;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow-clean);
            position: relative;
            overflow: hidden;
        }
        .story-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--blue), var(--orange));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        .story-card:hover::before { transform: scaleX(1); }
        .story-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-elevated);
        }
        .story-card .story-icon {
            width: 70px; height: 70px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--blue), var(--blue2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 20px;
        }
        .story-card h3 {
            font-family: var(--ff-head);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 12px;
        }
        .story-card p {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.7;
        }
        .story-card .story-year {
            display: inline-block;
            margin-top: 14px;
            background: rgba(0,180,216,0.1);
            border: 1px solid rgba(0,180,216,0.2);
            border-radius: 50px;
            padding: 4px 16px;
            font-family: var(--ff-head);
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--blue2);
            letter-spacing: 1px;
        }

        /* ====== MISSION & VISION ====== */
        .mission-vision-section {
            background: linear-gradient(135deg, var(--navy2), var(--navy));
            position: relative;
            overflow: hidden;
        }
        .mission-vision-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 600px 400px at 70% 50%, rgba(0,180,216,0.15), transparent);
        }
        .mv-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            position: relative;
            z-index: 1;
        }
        .mv-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: var(--radius);
            padding: 40px 32px;
            text-align: center;
            transition: var(--transition);
        }
        .mv-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.25); }
        .mv-card .mv-icon {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px;
        }
        .mv-card h3 {
            font-family: var(--ff-head);
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
        }
        .mv-card p {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.7);
            line-height: 1.75;
        }

        /* ====== VALUES GRID ====== */
        .values-section { background: var(--offwhite); }
        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 10px;
        }
        .value-card {
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(0,119,182,0.1);
            border-radius: var(--radius);
            padding: 32px 24px;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow-clean);
        }
        .value-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-elevated); }
        .value-card .value-icon-wrap {
            width: 70px; height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--orange), var(--orange2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 18px;
        }
        .value-card h3 {
            font-family: var(--ff-head);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 10px;
        }
        .value-card p {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.65;
        }

        /* ====== TIMELINE ====== */
        .timeline-section { background: transparent; }
        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 0;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, var(--blue), var(--orange));
            border-radius: 3px;
        }
        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 40px;
            position: relative;
        }
        .timeline-item:nth-child(odd) { flex-direction: row; }
        .timeline-item:nth-child(even) { flex-direction: row-reverse; }
        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px; height: 20px;
            border-radius: 50%;
            background: var(--white);
            border: 4px solid var(--blue);
            z-index: 1;
            box-shadow: 0 0 12px rgba(0,180,216,0.4);
        }
        .timeline-content {
            width: 45%;
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(0,119,182,0.1);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow-clean);
            transition: var(--transition);
        }
        .timeline-content:hover { box-shadow: var(--shadow-elevated); transform: translateY(-3px); }
        .timeline-content .t-year {
            font-family: var(--ff-head);
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--blue);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .timeline-content h4 {
            font-family: var(--ff-head);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 8px;
        }
        .timeline-content p {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ====== STATS ====== */
        .stats-bar-about {
            background: linear-gradient(135deg, var(--navy2), var(--navy));
            padding: 0;
        }
        .stats-grid-about {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-left: 1px solid rgba(255,255,255,0.08);
        }
        .stat-item-about {
            padding: 32px 20px;
            text-align: center;
            border-right: 1px solid rgba(255,255,255,0.08);
            border-top: 1px solid rgba(255,255,255,0.08);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            position: relative;
            transition: var(--transition);
        }
        .stat-item-about:hover { background: rgba(0,180,216,0.05); }
        .stat-item-about .stat-num-about {
            font-family: var(--ff-head);
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1;
        }
        .stat-item-about .stat-lbl-about {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.55);
            margin-top: 5px;
            font-family: var(--ff-head);
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* ====== TEAM PREVIEW ====== */
        .team-preview-section { background: var(--offwhite); }
        .team-preview-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 10px;
        }
        .team-preview-card {
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(0,119,182,0.1);
            border-radius: var(--radius);
            overflow: hidden;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow-clean);
        }
        .team-preview-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-elevated); }
        .team-preview-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .team-preview-card .tp-placeholder {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            background: linear-gradient(135deg, #e0f4fd, #b3e5fa);
            color: var(--blue2);
        }
        .team-preview-card .tp-body { padding: 18px; }
        .team-preview-card .tp-body h4 {
            font-family: var(--ff-head);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 4px;
        }
        .team-preview-card .tp-body span {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* ====== CTA ====== */
        .about-cta {
            background: linear-gradient(135deg, var(--navy2), #1a003a, var(--navy));
            padding: 70px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .about-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 600px 400px at 50% 50%, rgba(0,180,216,0.18), transparent);
        }
        .about-cta-inner { position: relative; z-index: 1; }
        .about-cta h2 {
            font-family: var(--ff-head);
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
        }
        .about-cta p {
            font-size: 1rem;
            color: rgba(255,255,255,0.65);
            margin-bottom: 30px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }
        .cta-row { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

        /* ====== FOOTER - IDENTICAL TO INDEX ====== */
        footer {
            background: linear-gradient(180deg, var(--navy2) 0%, #020317 100%);
            color: rgba(255,255,255,0.75);
            padding: 70px 0 0;
            border-top: 1px solid rgba(0,180,216,0.15);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1.2fr 1.3fr;
            gap: 48px;
            text-align: left;
        }
        .footer-logo { margin-bottom: 18px; }
        .footer-logo img { height: 62px; width: auto; }
        .footer-desc { font-size: 0.84rem; line-height: 1.7; color: rgba(255,255,255,0.55); margin-bottom: 20px; }
        .social-row { display: flex; gap: 10px; }
        .social-btn {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.85rem;
            transition: var(--transition);
        }
        .social-btn:hover { background: var(--blue); border-color: var(--blue); color: #fff; }
        .footer-col h5 {
            font-family: var(--ff-head);
            font-size: 0.85rem;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0,180,216,0.2);
        }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 9px; }
        .footer-links a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.83rem;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: var(--transition);
        }
        .footer-links a i { font-size: 0.65rem; color: var(--blue); flex-shrink: 0; }
        .footer-links a:hover { color: var(--blue); transform: translateX(4px); }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 0.83rem;
            color: rgba(255,255,255,0.55);
        }
        .footer-contact-item i { color: var(--blue); font-size: 0.85rem; margin-top: 2px; flex-shrink: 0; }
        .footer-contact-item a { color: rgba(255,255,255,0.55); text-decoration: none; transition: color 0.2s; }
        .footer-contact-item a:hover { color: var(--blue); }
        .footer-bottom {
            margin-top: 50px;
            padding: 20px 0;
            border-top: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-bottom p { font-size: 0.78rem; color: rgba(255,255,255,0.35); }
        .footer-bottom-links { display: flex; gap: 20px; }
        .footer-bottom-links a { font-size: 0.78rem; color: rgba(255,255,255,0.35); text-decoration: none; transition: color 0.2s; }
        .footer-bottom-links a:hover { color: var(--blue); }

        /* ====== FLOATING BUTTONS ====== */
        .float-wa {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 999;
            background: linear-gradient(135deg, #25d366, #128c7e);
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            padding: 11px 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--ff-head);
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 6px 24px rgba(37,211,102,0.45);
            animation: floatPulse 2.5s infinite;
        }
        .float-wa:hover { transform: translateY(-3px) scale(1.04); color: #fff; }
        .float-wa i { font-size: 1rem; }
        @keyframes floatPulse {
            0%, 100% { box-shadow: 0 6px 24px rgba(37,211,102,0.45); }
            50% { box-shadow: 0 6px 32px rgba(37,211,102,0.7); }
        }
        .float-chat {
            position: fixed;
            bottom: 28px;
            left: 28px;
            z-index: 999;
            width: 52px; height: 52px;
            background: linear-gradient(135deg, var(--blue), var(--blue2));
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 6px 24px rgba(0,180,216,0.45);
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
        }
        .float-chat:hover { transform: scale(1.1); color: #fff; }
        .float-chat-tooltip {
            position: absolute;
            left: 62px;
            background: var(--navy);
            color: #fff;
            font-size: 0.74rem;
            font-family: var(--ff-head);
            font-weight: 600;
            padding: 5px 11px;
            border-radius: 6px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: var(--transition);
        }
        .float-chat:hover .float-chat-tooltip { opacity: 1; }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 1100px) {
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 36px; }
            .story-grid { grid-template-columns: repeat(2, 1fr); }
            .values-grid { grid-template-columns: repeat(2, 1fr); }
            .team-preview-grid { grid-template-columns: repeat(2, 1fr); }
            .stats-grid-about { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .about-hero-inner { flex-direction: column; }
            .about-hero-visual { order: -1; }
            .mv-grid { grid-template-columns: 1fr; }
            .timeline::before { left: 30px; }
            .timeline-item, .timeline-item:nth-child(even) { flex-direction: row; }
            .timeline-dot { left: 30px; }
            .timeline-content { width: calc(100% - 60px); margin-left: 60px; }
        }
        @media (max-width: 768px) {
            body { padding-top: 70px; }
            .nav-links, .nav-cta-wrap { display: none; }
            .nav-hamburger { display: flex; }
            .navbar { height: 70px; }
            .story-grid { grid-template-columns: 1fr; }
            .values-grid { grid-template-columns: 1fr; }
            .team-preview-grid { grid-template-columns: 1fr; }
            .stats-grid-about { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr; gap: 28px; }
            .timeline-content { width: calc(100% - 50px); margin-left: 50px; }
            .float-wa span { display: none; }
            .float-wa { padding: 12px; border-radius: 50%; }
            .footer-bottom { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 480px) {
            .section-pad { padding: 60px 0; }
            .stats-grid-about { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<!-- ========== NAVBAR (IDENTICAL TO INDEX) ========== -->
<?php render_nav('about'); ?>

<!-- Mobile Menu -->


<!-- ========== ABOUT HERO ========== -->
<section class="about-hero">
    <div class="container">
        <div class="about-hero-inner">
            <div class="about-hero-text">
                <div class="hero-badge-about"><i class="fas fa-star" style="font-size:0.65rem;"></i> Our Story & Vision – Windhoek, Namibia</div>
                <h1>Transforming Businesses Through <span>Technology</span> & Design</h1>
                <p class="hero-desc">Discover the journey, values, and mission that drive AMATETA Techs & Designs — Windhoek's premier one-stop technology and graphics company.</p>
                <div class="hero-btns-about">
                    <a href="#story" class="btn btn-primary btn-lg"><i class="fas fa-book-open"></i>Our Journey</a>
                    <a href="contact.php" class="btn btn-outline-white btn-lg"><i class="fas fa-comments"></i>Get In Touch</a>
                </div>
            </div>
            <div class="about-hero-visual">
                <div class="about-floating-badge">
                    <i class="fas fa-trophy badge-icon"></i>
                    <div class="badge-num">5+</div>
                    <div class="badge-lbl">Years of<br>Excellence</div>
                    <span class="badge-edge-dot"></span>
                    <span class="badge-edge-dot"></span>
                    <span class="badge-edge-dot"></span>
                    <span class="badge-edge-dot"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== COMPANY STORY ========== -->
<section id="story" class="story-section section-pad">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label"><i class="fas fa-history"></i>Our Journey</span>
            <h2 class="section-title">Our Humble <span>Beginnings</span></h2>
            <div class="divider"></div>
            <p class="section-sub">From a small startup to a comprehensive technology solutions provider serving businesses across Namibia.</p>
        </div>

        <div class="story-grid">
            <div class="story-card">
                <div class="story-icon"><i class="fas fa-seedling"></i></div>
                <h3>The Foundation</h3>
                <p>AMATETA Techs & Designs was founded with a vision to bridge the gap between technology and business needs in Namibia. We started by offering essential IT support services to local businesses, quickly earning a reputation for reliability and expertise.</p>
                <span class="story-year">2020</span>
            </div>
            <div class="story-card">
                <div class="story-icon" style="background:linear-gradient(135deg,var(--orange),var(--orange2));"><i class="fas fa-rocket"></i></div>
                <h3>Rapid Growth</h3>
                <p>As client needs evolved, we expanded our expertise to encompass digital marketing, web development, and creative design services. Our team grew to include specialists across multiple domains, allowing us to offer truly comprehensive solutions under one roof.</p>
                <span class="story-year">2022</span>
            </div>
            <div class="story-card">
                <div class="story-icon" style="background:linear-gradient(135deg,var(--purple),var(--purple2));"><i class="fas fa-chart-line"></i></div>
                <h3>Today & Beyond</h3>
                <p>Today, we're a trusted partner for businesses across Namibia, delivering comprehensive technology solutions that drive growth, efficiency, and digital transformation. Our commitment to innovation and quality continues to push us forward into new frontiers.</p>
                <span class="story-year">2025</span>
            </div>
        </div>
    </div>
</section>

<!-- ========== MISSION & VISION ========== -->
<section class="mission-vision-section section-pad">
    <div class="container">
        <div class="mv-grid">
            <div class="mv-card">
                <div class="mv-icon"><i class="fas fa-bullseye"></i></div>
                <h3>Our Mission</h3>
                <p>To empower businesses with innovative technology solutions that drive growth, enhance efficiency, and create meaningful digital experiences. We strive to be the trusted partner that helps our clients navigate the digital landscape with confidence and achieve their full potential.</p>
            </div>
            <div class="mv-card">
                <div class="mv-icon" style="background:linear-gradient(135deg,var(--orange),var(--orange2));"><i class="fas fa-eye"></i></div>
                <h3>Our Vision</h3>
                <p>To be Namibia's leading technology partner, recognized for excellence in delivering comprehensive digital solutions that transform businesses and contribute to the growth of the local economy through innovation, expertise, and unwavering commitment to quality.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CORE VALUES ========== -->
<section class="values-section section-pad" id="values">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label"><i class="fas fa-heart"></i>What We Stand For</span>
            <h2 class="section-title">Our Core <span>Values</span></h2>
            <div class="divider"></div>
            <p class="section-sub">The principles that guide everything we do — every project, every client, every day.</p>
        </div>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon-wrap"><i class="fas fa-lightbulb"></i></div>
                <h3>Innovation</h3>
                <p>We constantly explore new technologies and creative approaches to deliver cutting-edge solutions that keep our clients ahead of the curve.</p>
            </div>
            <div class="value-card">
                <div class="value-icon-wrap" style="background:linear-gradient(135deg,var(--blue),var(--blue2));"><i class="fas fa-handshake"></i></div>
                <h3>Integrity</h3>
                <p>We build trust through transparency, honesty, and ethical business practices in all our client relationships and project deliveries.</p>
            </div>
            <div class="value-card">
                <div class="value-icon-wrap" style="background:linear-gradient(135deg,var(--purple),var(--purple2));"><i class="fas fa-users"></i></div>
                <h3>Collaboration</h3>
                <p>We believe in the power of teamwork and partnership, working closely with our clients to understand their unique needs and goals.</p>
            </div>
            <div class="value-card">
                <div class="value-icon-wrap" style="background:linear-gradient(135deg,#00897b,#00695c);"><i class="fas fa-award"></i></div>
                <h3>Excellence</h3>
                <p>We are committed to delivering the highest quality work, paying attention to every detail and exceeding client expectations consistently.</p>
            </div>
            <div class="value-card">
                <div class="value-icon-wrap" style="background:linear-gradient(135deg,#c2185b,#880e4f);"><i class="fas fa-heart"></i></div>
                <h3>Passion</h3>
                <p>We are genuinely passionate about technology and design, and this enthusiasm translates into exceptional results for our clients.</p>
            </div>
            <div class="value-card">
                <div class="value-icon-wrap" style="background:linear-gradient(135deg,#3949ab,#283593);"><i class="fas fa-graduation-cap"></i></div>
                <h3>Growth</h3>
                <p>We are committed to continuous learning and improvement, both for our team and for the businesses we serve across Namibia.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== TIMELINE ========== -->
<section class="timeline-section section-pad">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label"><i class="fas fa-road"></i>Milestones</span>
            <h2 class="section-title">Our <span>Journey</span> So Far</h2>
            <div class="divider"></div>
        </div>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="t-year">2020</div>
                    <h4>Company Founded</h4>
                    <p>AMATETA Techs & Designs was established in Windhoek, Namibia with a focus on IT support and basic design services for local businesses.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="t-year">2021</div>
                    <h4>Expanded to Web Development</h4>
                    <p>Launched our web development division, offering custom website design and development services to clients across Namibia.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="t-year">2022</div>
                    <h4>Added Digital Marketing & Printing</h4>
                    <p>Expanded service offerings to include digital marketing, SEO, social media management, and corporate printing services.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="t-year">2023</div>
                    <h4>CCTV & Company Stamps Division</h4>
                    <p>Added professional CCTV installation services and launched our company stamps division — now one of Windhoek's leading stamp providers.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="t-year">2024</div>
                    <h4>Book Publishing & Partnerships</h4>
                    <p>Launched book publishing services and formed strategic partnerships with SP Media and Astuteness Technology for expanded offerings.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="t-year">2025</div>
                    <h4>Continued Growth & Innovation</h4>
                    <p>Expanding our team, enhancing our technology stack, and continuing to serve Namibian businesses with comprehensive, integrated solutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== STATS BAR ========== -->
<div class="stats-bar-about">
    <div class="container" style="padding:0;">
        <div class="stats-grid-about">
            <div class="stat-item-about">
                <div class="stat-num-about">150<span style="color:var(--orange);">+</span></div>
                <div class="stat-lbl-about">Projects Completed</div>
            </div>
            <div class="stat-item-about">
                <div class="stat-num-about">50<span style="color:var(--orange);">+</span></div>
                <div class="stat-lbl-about">Happy Clients</div>
            </div>
            <div class="stat-item-about">
                <div class="stat-num-about">5<span style="color:var(--orange);">+</span></div>
                <div class="stat-lbl-about">Years Experience</div>
            </div>
            <div class="stat-item-about">
                <div class="stat-num-about" style="color:var(--blue);">10<span style="color:var(--blue);">+</span></div>
                <div class="stat-lbl-about">Team Members</div>
            </div>
        </div>
    </div>
</div>

<!-- ========== TEAM PREVIEW ========== -->
<section class="team-preview-section section-pad" id="team-preview">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label"><i class="fas fa-users"></i>Our People</span>
            <h2 class="section-title">Meet Our <span>Leadership</span></h2>
            <div class="divider"></div>
            <p class="section-sub">The dedicated team behind AMATETA Techs & Designs — passionate about technology, design, and your success.</p>
        </div>

        <div class="team-preview-grid">
            <?php
            // Driven by Admin → Team, so photos and names stay in one place
            // (the old hard-coded images/team1-4.jpg files did not exist).
            $aboutTeam = fetch_all('SELECT name, role, photo FROM team WHERE active=1 ORDER BY sort_order, id LIMIT 4');
            foreach ($aboutTeam as $tm): ?>
            <div class="team-preview-card">
                <?php if (trim((string) $tm['photo']) !== ''): ?>
                    <img src="<?= e(img_src($tm['photo'])) ?>" alt="<?= e($tm['name']) ?>" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="tp-placeholder" style="display:none;"><i class="fas fa-user-tie"></i></div>
                <?php else: ?>
                    <div class="tp-placeholder" style="display:flex;"><i class="fas fa-user-tie"></i></div>
                <?php endif; ?>
                <div class="tp-body">
                    <h4><?= e($tm['name']) ?></h4>
                    <span><?= e($tm['role']) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center" style="margin-top:36px;">
            <a href="team.php" class="btn btn-primary btn-lg"><i class="fas fa-users"></i>View Full Team</a>
        </div>
    </div>
</section>

<!-- ========== CTA ========== -->
<section class="about-cta">
    <div class="about-cta-inner container">
        <span class="section-label" style="background:rgba(247,127,0,0.15);border-color:rgba(247,127,0,0.3);color:var(--orange);margin-bottom:18px;"><i class="fas fa-rocket"></i>Ready to Start?</span>
        <h2>Ready to Work With Us?</h2>
        <p>Let's discuss how our technology and design solutions can drive real growth for your business. Free consultation — no obligations.</p>
        <div class="cta-row">
            <a href="contact.php" class="btn btn-primary btn-lg"><i class="far fa-calendar-check"></i>Get Free Consultation</a>
            <a href="services.php" class="btn btn-orange btn-lg"><i class="fas fa-th"></i>View All Services</a>
        </div>
    </div>
</section>

<!-- ========== FOOTER (IDENTICAL TO INDEX) ========== -->
<?php render_footer(); ?>

<!-- ========== FLOATING BUTTONS ========== -->




<!-- ========== JS ========== -->


<!-- Schema.org structured data for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "About AMATETA Techs & Designs",
  "description": "Learn about AMATETA Techs & Designs — our story, mission, vision, values, team and journey as Windhoek's premier technology and graphics company in Namibia.",
  "about": {
    "@type": "Organization",
    "name": "AMATETA Techs & Designs",
    "foundingDate": "2020",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Eluwa Building, Shop No.2, Independence Avenue",
      "addressLocality": "Windhoek",
      "addressCountry": "NA"
    },
    "numberOfEmployees": "10+",
    "telephone": "+264853441248",
    "email": "info@amateta.com",
    "url": "https://www.amateta.com"
  }
}
</script>

</body>
</html>