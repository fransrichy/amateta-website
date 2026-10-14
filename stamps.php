<?php require_once __DIR__ . '/config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Company Stamps – All Types | AMATETA Techs & Designs, Windhoek Namibia</title>
    <meta name="description" content="Order all types of professional company stamps in Namibia. Self-inking stamps, pre-inked stamps, company round stamps, signature stamps, date stamps, school stamps and more. Fast delivery in Windhoek.">
    <meta name="keywords" content="company stamps Namibia, self-inking stamps Windhoek, rubber stamps Namibia, company seal Namibia, round stamps Windhoek, date stamps Namibia, pre-inked stamps Namibia">
    <meta name="author" content="AMATETA Techs & Designs">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Company Stamps – All Types | AMATETA Techs & Designs">
    <meta property="og:description" content="Order all types of professional company stamps in Namibia. Fast delivery, premium quality.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.amateta.com/stamps.php">
    <link rel="canonical" href="https://www.amateta.com/stamps.php">
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
                radial-gradient(ellipse 900px 600px at 10% 20%, rgba(156,39,176,0.04) 0%, transparent 70%),
                radial-gradient(ellipse 700px 500px at 90% 80%, rgba(0,180,216,0.04) 0%, transparent 70%),
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
            color: var(--purple);
            background: rgba(156,39,176,0.10);
            border: 1px solid rgba(156,39,176,0.25);
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
        .section-title span { color: var(--purple); }
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
            background: linear-gradient(90deg, var(--purple), var(--blue));
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
        .btn-stamps {
            background: linear-gradient(135deg, var(--purple), var(--purple2));
            color: var(--white);
        }
        .btn-stamps:hover { background: linear-gradient(135deg, var(--purple2), #38006b); transform: translateY(-2px); color: #fff; }
        .btn-outline-navy {
            background: transparent;
            border: 2px solid var(--navy);
            color: var(--navy);
        }
        .btn-outline-navy:hover { background: var(--navy); color: #fff; }
        .btn-outline-white {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.6);
            color: var(--white);
        }
        .btn-outline-white:hover { background: rgba(255,255,255,0.15); color: #fff; }
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

        /* ====== STAMPS HERO ====== */
        .stamps-hero {
            background: linear-gradient(135deg, var(--navy2) 0%, #2e003e 50%, var(--navy) 100%);
            padding: 90px 0 70px;
            position: relative;
            overflow: hidden;
        }
        .stamps-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 50%, rgba(156,39,176,0.12) 0%, transparent 60%);
            z-index: 1;
        }
        .stamps-hero-inner {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }
        .stamps-hero-text { flex: 1; max-width: 620px; }
        .hero-badge-stamps {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(156,39,176,0.18);
            border: 1px solid rgba(156,39,176,0.35);
            border-radius: 50px;
            padding: 6px 16px;
            font-family: var(--ff-head);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #e040fb;
            margin-bottom: 20px;
        }
        .stamps-hero-text h1 {
            font-family: var(--ff-head);
            font-size: clamp(2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 18px;
        }
        .stamps-hero-text h1 span { color: #e040fb; }
        .stamps-hero-text .hero-desc {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.72);
            line-height: 1.75;
            margin-bottom: 28px;
        }
        .hero-btns-stamps { display: flex; gap: 12px; flex-wrap: wrap; }

        /* ====== LARGE FLOATING STAMP IMAGE (LEFT UP) ====== */
        .stamps-hero-visual {
            flex: 0 0 auto;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            position: relative;
            z-index: 2;
        }
        .floating-large-stamp {
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(14px);
            border: 2px solid rgba(224,64,251,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(156,39,176,0.3);
            animation: floatStampLarge 4s ease-in-out infinite;
            position: relative;
        }
        .floating-large-stamp img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .floating-large-stamp .stamp-fallback-large {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--purple2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            position: absolute;
            top: 0;
            left: 0;
        }
        .stamp-edge-decor {
            position: absolute;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: var(--purple);
            box-shadow: var(--shadow-clean);
            border: 1px solid rgba(156,39,176,0.2);
            z-index: 3;
        }
        .stamp-edge-decor.n { top: -15px; left: 50%; transform: translateX(-50%); }
        .stamp-edge-decor.s { bottom: -15px; left: 50%; transform: translateX(-50%); }
        .stamp-edge-decor.e { right: -15px; top: 50%; transform: translateY(-50%); }
        .stamp-edge-decor.w { left: -15px; top: 50%; transform: translateY(-50%); }
        .stamp-edge-decor.ne { top: 10px; right: 10px; }
        .stamp-edge-decor.nw { top: 10px; left: 10px; }
        .stamp-edge-decor.se { bottom: 10px; right: 10px; }
        .stamp-edge-decor.sw { bottom: 10px; left: 10px; }

        @keyframes floatStampLarge {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        /* ====== STAMP TYPES GRID ====== */
        .stamp-types-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 10px;
        }
        .stamp-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(156,39,176,0.12);
            border-radius: var(--radius);
            padding: 0 0 24px 0;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow-clean);
            position: relative;
            overflow: hidden;
        }
        .stamp-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--purple), var(--blue));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
            z-index: 1;
        }
        .stamp-card:hover::before { transform: scaleX(1); }
        .stamp-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-elevated);
        }
        .stamp-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            border-radius: var(--radius) var(--radius) 0 0;
        }
        .stamp-card-image-placeholder {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            border-radius: var(--radius) var(--radius) 0 0;
        }
        .scip-1 { background: linear-gradient(135deg, #f3e5f5, #e1bee7); color: var(--purple); }
        .scip-2 { background: linear-gradient(135deg, #ede7f6, #d1c4e9); color: #5e35b1; }
        .scip-3 { background: linear-gradient(135deg, #e8eaf6, #c5cae9); color: #283593; }
        .scip-4 { background: linear-gradient(135deg, #fff3e0, #ffe0b2); color: var(--orange); }
        .scip-5 { background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #ad1457; }
        .scip-6 { background: linear-gradient(135deg, #e0f2f1, #b2dfdb); color: #00695c; }
        .stamp-card-body { padding: 20px 24px 0; }
        .stamp-card-icon {
            width: 50px; height: 50px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--purple), var(--purple2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin: 0 auto 14px;
        }
        .stamp-card h3 {
            font-family: var(--ff-head);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 10px;
        }
        .stamp-card p {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 16px;
        }
        .stamp-features {
            list-style: none;
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 7px;
            padding: 0 8px;
        }
        .stamp-features li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.82rem;
            color: #3a5472;
        }
        .stamp-features li i {
            color: var(--purple);
            font-size: 0.7rem;
            margin-top: 3px;
            flex-shrink: 0;
        }

        /* ====== PROMOTIONS TABLE ====== */
        .promo-section {
            background: linear-gradient(135deg, rgba(156,39,176,0.04), rgba(0,180,216,0.04));
        }
        .promo-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 10px;
        }
        .promo-card {
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(156,39,176,0.15);
            border-radius: var(--radius);
            padding: 22px;
            transition: var(--transition);
            box-shadow: var(--shadow-clean);
            text-align: center;
            border-left: 4px solid var(--purple);
        }
        .promo-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-elevated); }
        .promo-card h4 {
            font-family: var(--ff-head);
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
        }
        .promo-card .promo-price {
            font-family: var(--ff-head);
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--purple);
            margin-bottom: 4px;
        }
        .promo-card .promo-size {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        .promo-card .promo-note {
            font-size: 0.74rem;
            color: var(--orange);
            font-weight: 600;
        }
        .promo-validity {
            text-align: center;
            margin-top: 30px;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
        }
        .promo-validity i { color: var(--orange); margin-right: 6px; }

        /* ====== ORDERING INSTRUCTIONS ====== */
        .instructions-section {
            background: linear-gradient(135deg, #f9f0ff 0%, #fff3f9 50%, #f0f4ff 100%);
        }
        .instructions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 10px;
        }
        .instruction-card {
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(156,39,176,0.1);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow-clean);
            transition: var(--transition);
        }
        .instruction-card:hover { box-shadow: var(--shadow-elevated); transform: translateY(-3px); }
        .instruction-card h3 {
            font-family: var(--ff-head);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .instruction-card h3 i { color: var(--purple); }
        .instruction-card ol, .instruction-card ul {
            padding-left: 20px;
            color: var(--text-muted);
            font-size: 0.86rem;
            line-height: 1.9;
        }
        .instruction-card ol li, .instruction-card ul li { margin-bottom: 4px; }
        .instruction-card .note {
            background: rgba(247,127,0,0.08);
            border: 1px solid rgba(247,127,0,0.2);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.78rem;
            color: var(--orange);
            font-weight: 600;
            margin-top: 12px;
        }

        /* ====== PROCESS ====== */
        .process-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            position: relative;
        }
        .process-grid::before {
            content: '';
            position: absolute;
            top: 40px; left: 12%; right: 12%;
            height: 2px;
            background: linear-gradient(90deg, var(--purple), var(--blue));
            z-index: 0;
        }
        .process-step {
            text-align: center;
            padding: 0 16px;
            position: relative;
            z-index: 1;
        }
        .process-num {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--purple2));
            color: #fff;
            font-family: var(--ff-head);
            font-size: 1.4rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            box-shadow: 0 6px 20px rgba(156,39,176,0.35);
        }
        .process-step h4 {
            font-family: var(--ff-head);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 8px;
        }
        .process-step p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ====== CORPORATE PRINTING ====== */
        .printing-section {
            background: var(--offwhite);
        }
        .printing-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 14px;
        }
        .printing-pill {
            background: rgba(0,180,216,0.08);
            border: 1px solid rgba(0,180,216,0.2);
            border-radius: 50px;
            padding: 8px 18px;
            font-size: 0.8rem;
            font-family: var(--ff-head);
            font-weight: 600;
            color: var(--blue2);
        }

        /* ====== CTA ====== */
        .stamps-cta {
            background: linear-gradient(135deg, var(--navy2), #1a003a, var(--navy));
            padding: 70px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .stamps-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 600px 400px at 50% 50%, rgba(156,39,176,0.2), transparent);
        }
        .stamps-cta-inner {
            position: relative;
            z-index: 1;
        }
        .stamps-cta h2 {
            font-family: var(--ff-head);
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
        }
        .stamps-cta p {
            font-size: 1rem;
            color: rgba(255,255,255,0.65);
            margin-bottom: 30px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }
        .cta-row {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* ====== CONTACT BAR ====== */
        .contact-bar {
            background: linear-gradient(135deg, var(--navy2), var(--navy));
            padding: 28px 0;
            border-top: 1px solid rgba(0,180,216,0.15);
            border-bottom: 1px solid rgba(0,180,216,0.15);
        }
        .contact-bar-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }
        .contact-bar-inner a {
            color: var(--blue);
            text-decoration: none;
            font-weight: 600;
        }
        .contact-bar-inner a:hover { text-decoration: underline; }

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
            .stamp-types-grid { grid-template-columns: repeat(2, 1fr); }
            .promo-grid { grid-template-columns: repeat(2, 1fr); }
            .instructions-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 900px) {
            .stamps-hero-inner { flex-direction: column; }
            .stamps-hero-visual { order: -1; }
            .floating-large-stamp { width: 220px; height: 220px; }
            .process-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
            .process-grid::before { display: none; }
        }
        @media (max-width: 768px) {
            body { padding-top: 70px; }
            .nav-links, .nav-cta-wrap { display: none; }
            .nav-hamburger { display: flex; }
            .navbar { height: 70px; }
            .stamp-types-grid { grid-template-columns: 1fr; }
            .promo-grid { grid-template-columns: 1fr; }
            .process-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 28px; }
            .float-wa span { display: none; }
            .float-wa { padding: 12px; border-radius: 50%; }
            .footer-bottom { flex-direction: column; align-items: flex-start; }
            .contact-bar-inner { flex-direction: column; gap: 12px; text-align: center; }
        }
        @media (max-width: 480px) {
            .section-pad { padding: 60px 0; }
            .floating-large-stamp { width: 180px; height: 180px; }
            .stamp-edge-decor { width: 28px; height: 28px; font-size: 0.65rem; }
        }
    </style>
</head>
<body>

<!-- ========== NAVBAR (IDENTICAL TO INDEX) ========== -->
<?php render_nav('stamps'); ?>

<!-- Mobile Menu -->


<!-- ========== STAMPS HERO ========== -->
<section class="stamps-hero">
    <div class="container">
        <div class="stamps-hero-inner">
            <div class="stamps-hero-text">
                <div class="hero-badge-stamps"><i class="fas fa-stamp" style="font-size:0.65rem;"></i> Professional Stamp Services – Windhoek</div>
                <h1>Company <span>Stamps</span> —<br>Every Type, Fast Delivery</h1>
                <p class="hero-desc">We produce all types of professional company stamps for businesses, law firms, schools, government offices and individuals in Namibia. Premium quality, sharp impressions, fast turnaround.</p>
                <div class="hero-btns-stamps">
                    <a href="contact.html" class="btn btn-stamps btn-lg"><i class="fas fa-stamp"></i>Order Your Stamp</a>
                    <a href="https://wa.me/264853441248?text=Hello,%20I%20would%20like%20to%20order%20a%20company%20stamp" class="btn btn-orange btn-lg" target="_blank"><i class="fab fa-whatsapp"></i>WhatsApp Order</a>
                    <a href="index.php" class="btn btn-outline-white btn-lg"><i class="fas fa-arrow-left"></i>Back to Home</a>
                </div>
            </div>
            <!-- LARGE FLOATING STAMP IMAGE LEFT UP -->
            <div class="stamps-hero-visual">
                <div class="floating-large-stamp">
                    <img src="images/stamp float.png" alt="AMATETA Stamp" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="stamp-fallback-large" style="display:none;"><i class="fas fa-stamp"></i></div>
                    <span class="stamp-edge-decor n"><i class="fas fa-check"></i></span>
                    <span class="stamp-edge-decor s"><i class="fas fa-star"></i></span>
                    <span class="stamp-edge-decor e"><i class="fas fa-certificate"></i></span>
                    <span class="stamp-edge-decor w"><i class="fas fa-stamp"></i></span>
                    <span class="stamp-edge-decor ne"><i class="fas fa-crown"></i></span>
                    <span class="stamp-edge-decor nw"><i class="fas fa-gem"></i></span>
                    <span class="stamp-edge-decor se"><i class="fas fa-shield-alt"></i></span>
                    <span class="stamp-edge-decor sw"><i class="fas fa-award"></i></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== STAMP TYPES ========== -->
<section class="section-pad" id="stamp-types">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label"><i class="fas fa-th"></i>What We Offer</span>
            <h2 class="section-title">All Types of <span>Company Stamps</span></h2>
            <div class="divider"></div>
            <p class="section-sub">From simple text stamps to complex round seals — we produce every stamp type with precision and quality for Namibian businesses.</p>
        </div>

        <?php
        $stampServices = fetch_all('SELECT * FROM stamp_services WHERE active=1 ORDER BY sort_order, id');
        $scips = ['scip-1','scip-2','scip-3','scip-4','scip-5','scip-6'];
        ?>
        <div class="stamp-types-grid">
            <?php foreach ($stampServices as $i => $st): ?>
            <div class="stamp-card">
                <?php if (!empty($st['image'])): ?>
                    <img src="<?= e(img_src($st['image'])) ?>" alt="<?= e($st['name']) ?>" class="stamp-card-image" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="stamp-card-image-placeholder <?= $scips[$i % 6] ?>" style="display:none;"><i class="<?= e($st['icon']) ?>"></i></div>
                <?php else: ?>
                    <div class="stamp-card-image-placeholder <?= $scips[$i % 6] ?>" style="display:flex;"><i class="<?= e($st['icon']) ?>"></i></div>
                <?php endif; ?>
                <div class="stamp-card-body">
                    <div class="stamp-card-icon"><i class="<?= e($st['icon']) ?>"></i></div>
                    <h3><?= e($st['name']) ?></h3>
                    <p><?= e($st['description']) ?></p>
                    <a href="<?= e(wa_link($st['wa_text'] ?: ('I would like to order: ' . $st['name']))) ?>" target="_blank" class="btn btn-wa btn-sm" style="width:100%;margin-top:8px;"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== CURRENT PROMOTIONS ========== -->
<section class="promo-section section-pad" id="promotions">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label" style="background:rgba(247,127,0,0.1);border-color:rgba(247,127,0,0.25);color:var(--orange);"><i class="fas fa-fire"></i>Stamp Specials</span>
            <h2 class="section-title">Current <span style="color:var(--orange);">Promotion</span> (Incl. VAT)</h2>
            <div class="divider" style="background:linear-gradient(90deg,var(--orange),var(--purple));"></div>
            <p class="section-sub">Get your custom-made stamps designed with quality, precision, and fast delivery!</p>
        </div>

        <div class="promo-grid">
            <div class="promo-card">
                <h4>COLOP Pocket Stamp</h4>
                <div class="promo-price">N$380</div>
                <div class="promo-size">14×38mm</div>
            </div>
            <div class="promo-card">
                <h4>COLOP C30</h4>
                <div class="promo-price">N$450</div>
                <div class="promo-size">18×47mm</div>
            </div>
            <div class="promo-card">
                <h4>COLOP C40 Standard</h4>
                <div class="promo-price">N$515</div>
                <div class="promo-size">23×59mm (without date)</div>
            </div>
            <div class="promo-card">
                <h4>COLOP Dater 55</h4>
                <div class="promo-price">N$850</div>
                <div class="promo-size">With adjustable date</div>
            </div>
            <div class="promo-card">
                <h4>COLOP Signature Stamp</h4>
                <div class="promo-price">N$360</div>
                <div class="promo-size">Personalised name & signature</div>
            </div>
            <div class="promo-card">
                <h4>COLOP Circle Dated</h4>
                <div class="promo-price">N$1000</div>
                <div class="promo-size">Round with adjustable date</div>
            </div>
        </div>
        <p class="promo-validity"><i class="fas fa-exclamation-circle"></i> ⚠️ Please indicate if you'd like your stamp with or without the adjustable date feature.</p>
        <p class="promo-validity"><i class="fas fa-calendar-check"></i> 📅 Winder Sales 2026 — or while stock lasts! | 💻 Visit: www.amateta.com</p>
        <p class="promo-validity" style="color:var(--purple);">✨ Quality Stamps | Fast Service | Professional Results</p>
    </div>
</section>

<!-- ========== HOW TO ORDER ========== -->
<section class="instructions-section section-pad" id="how-to-order">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label"><i class="fas fa-shopping-cart"></i>Ordering</span>
            <h2 class="section-title">How to Place <span>Your Order</span></h2>
            <div class="divider"></div>
        </div>

        <div class="instructions-grid">
            <!-- Step 1: Send Details -->
            <div class="instruction-card">
                <h3><i class="fas fa-paper-plane"></i> 1. Send Us Your Details</h3>
                <p style="color:var(--text-muted);font-size:0.9rem;line-height:1.7;margin-bottom:12px;">Send us all details you want on your stamp (name, logo, contact info, etc.).</p>
                <p style="color:var(--text-muted);font-size:0.9rem;line-height:1.7;">We'll design a layout preview and send it to you for approval.</p>
            </div>

            <!-- Step 2: Layout Approval & Payment -->
            <div class="instruction-card">
                <h3><i class="fas fa-check-circle"></i> 2. Layout Approval & Payment</h3>
                <ol style="color:var(--text-muted);font-size:0.86rem;line-height:2;">
                    <li>Approve your layout.</li>
                    <li>Make acos full payment.</li>
                    <li>Production starts once proof of payment is received. <strong>(No production starts without a deposit.)</strong></li>
                    <li>Payment methods: EasyWallet, E-wallet, EFT, or Cash Deposit <em>(All banks except NEDBANK)</em></li>
                    <li style="color:var(--orange);">*No pay to cell please*</li>
                    <li>Parcels are dispatched only after full payment is confirmed.</li>
                </ol>
                <div class="note"><i class="fas fa-exclamation-triangle"></i> No production starts without a deposit.</div>
            </div>
        </div>
    </div>
</section>

<!-- ========== ORDER PROCESS ========== -->
<section style="background:linear-gradient(135deg,rgba(156,39,176,0.04),rgba(0,180,216,0.04));" class="section-pad">
    <div class="container">
        <div class="text-center" style="margin-bottom:56px;">
            <span class="section-label" style="background:rgba(156,39,176,0.1);border-color:rgba(156,39,176,0.25);color:var(--purple);"><i class="fas fa-list-ol"></i>How It Works</span>
            <h2 class="section-title">Order Your <span>Stamp in 4 Steps</span></h2>
            <div class="divider"></div>
        </div>
        <div class="process-grid">
            <div class="process-step">
                <div class="process-num">1</div>
                <h4>Contact Us</h4>
                <p>WhatsApp, call or email us with your stamp requirements, company name and contact details.</p>
            </div>
            <div class="process-step">
                <div class="process-num">2</div>
                <h4>Design Approval</h4>
                <p>We send you a digital proof of your stamp design for review and approval before production.</p>
            </div>
            <div class="process-step">
                <div class="process-num">3</div>
                <h4>Production</h4>
                <p>Once approved, we produce your stamp with precision and premium quality materials.</p>
            </div>
            <div class="process-step">
                <div class="process-num">4</div>
                <h4>Collect or Deliver</h4>
                <p>Collect from our Windhoek office or arrange delivery. Fast turnaround guaranteed.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CORPORATE PRINTING ========== -->
<section class="printing-section section-pad" id="printing-services">
    <div class="container">
        <div class="text-center" style="margin-bottom:48px;">
            <span class="section-label"><i class="fas fa-print"></i>Printing</span>
            <h2 class="section-title">Corporate <span>Printing Services</span></h2>
            <div class="divider"></div>
            <p class="section-sub">Complete corporate printing solutions alongside our stamp services.</p>
        </div>
        <div class="printing-pills">
            <span class="printing-pill">📇 Business Cards</span>
            <span class="printing-pill">📄 Company Profiles</span>
            <span class="printing-pill">📰 Flyers & Brochures</span>
            <span class="printing-pill">🖼️ Posters & Banners</span>
            <span class="printing-pill">🎨 Logo Design & Branding</span>
            <span class="printing-pill">🏆 Certificates & Invitations</span>
        </div>
    </div>
</section>

<!-- ========== CTA ========== -->
<section class="stamps-cta">
    <div class="stamps-cta-inner container">
        <div class="section-label" style="background:rgba(156,39,176,0.15);border-color:rgba(156,39,176,0.3);color:#e040fb;margin-bottom:18px;"><i class="fas fa-stamp"></i>Ready to Order?</div>
        <h2>Order Your Professional<br>Company Stamp Today</h2>
        <p>Fast turnaround, premium quality, competitive pricing. All types of stamps produced right here in Windhoek, Namibia.</p>
        <div class="cta-row">
            <a href="contact.html" class="btn btn-stamps btn-lg"><i class="fas fa-stamp"></i>Order Now</a>
            <a href="https://wa.me/264853441248?text=Hello,%20I%20would%20like%20to%20order%20a%20company%20stamp" class="btn btn-orange btn-lg" target="_blank"><i class="fab fa-whatsapp"></i>WhatsApp Order</a>
            <a href="services.php" class="btn btn-primary btn-lg"><i class="fas fa-arrow-right"></i>View All Services</a>
        </div>
    </div>
</section>

<!-- ========== CONTACT BAR ========== -->
<div class="contact-bar">
    <div class="container">
        <div class="contact-bar-inner">
            <span><i class="fas fa-phone" style="color:var(--blue);margin-right:6px;"></i> <strong>Call Us:</strong> <a href="tel:+264813441248">+264 81 344 1248</a></span>
            <span><i class="fas fa-envelope" style="color:var(--blue);margin-right:6px;"></i> <strong>Email:</strong> <a href="mailto:stamps@amateta.com">stamps@amateta.com</a></span>
            <span><i class="fas fa-globe" style="color:var(--blue);margin-right:6px;"></i> <strong>Website:</strong> <a href="https://www.amateta.com">www.amateta.com</a></span>
        </div>
    </div>
</div>

<!-- ========== FOOTER (IDENTICAL TO INDEX) ========== -->
<?php render_footer(); ?>

<!-- ========== FLOATING BUTTONS ========== -->




<!-- ========== JS ========== -->


<!-- Schema.org structured data for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Company Stamps Namibia",
  "provider": {
    "@type": "LocalBusiness",
    "name": "AMATETA Techs & Designs",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Windhoek",
      "addressCountry": "NA"
    },
    "telephone": "+264853441248"
  },
  "description": "All types of professional company stamps in Namibia — self-inking, pre-inked, round seals, signature stamps, date stamps and more.",
  "areaServed": "Namibia",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "NAD",
    "availability": "https://schema.org/InStock",
    "validThrough": "2026-06-30"
  }
}
</script>

</body>
</html>