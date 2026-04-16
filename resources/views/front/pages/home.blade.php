<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADT Sports — Where Kabaddi Lives</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #080808;
            --charcoal: #111111;
            --surface: #161616;
            --surface2: #1e1e1e;
            --orange: #FF5A1F;
            --saffron: #FF8C00;
            --green: #2ECC40;
            --white: #F5F5F0;
            --muted: #888888;
            --border: rgba(255,255,255,0.07);
            --glow-orange: rgba(255,90,31,0.3);
            --glow-green: rgba(46,204,64,0.2);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            background: var(--black);
            color: var(--white);
            font-family: 'Barlow', sans-serif;
            overflow-x: hidden;
            cursor: none;
        }

        /* CUSTOM CURSOR */
        .cursor {
            position: fixed;
            width: 12px; height: 12px;
            background: var(--orange);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s, width 0.2s, height 0.2s, background 0.2s;
            mix-blend-mode: normal;
        }
        .cursor-ring {
            position: fixed;
            width: 40px; height: 40px;
            border: 1px solid rgba(255,90,31,0.5);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease-out, width 0.3s, height 0.3s, border-color 0.3s;
        }
        body:hover .cursor { opacity: 1; }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: var(--black); }
        ::-webkit-scrollbar-thumb { background: var(--orange); border-radius: 2px; }

        /* NAV */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 20px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background 0.4s, padding 0.4s;
        }
        nav.scrolled {
            background: rgba(8,8,8,0.95);
            backdrop-filter: blur(20px);
            padding: 14px 60px;
            border-bottom: 1px solid var(--border);
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-logo img {
            width: 44px; height: 44px;
            border-radius: 50%;
            object-fit: cover;
        }
        .nav-logo-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1px;
            color: var(--white);
        }
        .nav-logo-text span { color: var(--orange); }
        .nav-links {
            display: flex;
            gap: 36px;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--white); }
        .nav-cta {
            background: var(--orange);
            color: var(--black) !important;
            padding: 10px 22px;
            border-radius: 3px;
            font-weight: 700 !important;
            letter-spacing: 1px;
            transition: background 0.2s, transform 0.2s !important;
        }
        .nav-cta:hover { background: #ff7040 !important; transform: translateY(-1px); }

        /* HERO */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 700px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--black);
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 30% 50%, rgba(255,90,31,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 80% 30%, rgba(46,204,64,0.05) 0%, transparent 60%);
        }
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(ellipse at center, black 20%, transparent 80%);
        }
        .hero-particles {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            animation: float linear infinite;
            opacity: 0;
        }
        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 0.6; }
            100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
        }
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 900px;
            padding: 0 40px;
        }
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 28px;
            opacity: 0;
            animation: fadeUp 0.8s 0.3s forwards;
        }
        .hero-eyebrow::before, .hero-eyebrow::after {
            content: '';
            width: 30px; height: 1px;
            background: var(--orange);
            opacity: 0.5;
        }
        .hero-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(72px, 12vw, 140px);
            font-weight: 900;
            line-height: 0.9;
            letter-spacing: -2px;
            text-transform: uppercase;
            margin-bottom: 28px;
            opacity: 0;
            animation: fadeUp 0.9s 0.5s forwards;
        }
        .hero-title .line1 { display: block; color: var(--white); }
        .hero-title .line2 {
            display: block;
            background: linear-gradient(135deg, var(--orange) 0%, var(--saffron) 50%, var(--green) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-sub {
            font-size: 17px;
            font-weight: 300;
            color: rgba(245,245,240,0.6);
            line-height: 1.6;
            max-width: 540px;
            margin: 0 auto 44px;
            letter-spacing: 0.2px;
            opacity: 0;
            animation: fadeUp 0.9s 0.7s forwards;
        }
        .hero-btns {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp 0.9s 0.9s forwards;
        }
        .btn-primary {
            background: var(--orange);
            color: var(--black);
            padding: 16px 36px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            border-radius: 3px;
            cursor: none;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            background: #ff7040;
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(255,90,31,0.35);
        }
        .btn-secondary {
            background: transparent;
            color: var(--white);
            padding: 16px 36px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 3px;
            cursor: none;
            text-decoration: none;
            display: inline-block;
            transition: border-color 0.2s, color 0.2s, transform 0.2s;
        }
        .btn-secondary:hover {
            border-color: var(--orange);
            color: var(--orange);
            transform: translateY(-2px);
        }
        .hero-stats {
            position: absolute;
            bottom: 50px;
            left: 0; right: 0;
            display: flex;
            justify-content: center;
            gap: 60px;
            opacity: 0;
            animation: fadeUp 0.9s 1.2s forwards;
        }
        .stat-item { text-align: center; }
        .stat-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 36px;
            font-weight: 900;
            color: var(--orange);
            letter-spacing: -1px;
            line-height: 1;
        }
        .stat-label {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 4px;
        }
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            right: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            opacity: 0;
            animation: fadeIn 1s 1.5s forwards;
        }
        .scroll-line {
            width: 1px; height: 50px;
            background: linear-gradient(to bottom, var(--orange), transparent);
            animation: scrollLine 1.5s ease-in-out infinite;
        }
        @keyframes scrollLine {
            0%, 100% { transform: scaleY(1); opacity: 1; }
            50% { transform: scaleY(0.5); opacity: 0.3; }
        }
        .scroll-text {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--muted);
            writing-mode: vertical-rl;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* SECTION COMMON */
        section { padding: 120px 60px; }
        .section-label {
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-label::after {
            content: '';
            flex: 1;
            max-width: 40px;
            height: 1px;
            background: var(--orange);
            opacity: 0.5;
        }
        .section-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(42px, 6vw, 72px);
            font-weight: 900;
            line-height: 1;
            letter-spacing: -1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .section-title em {
            font-style: normal;
            background: linear-gradient(135deg, var(--orange), var(--saffron));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* TICKER */
        .ticker {
            background: var(--orange);
            padding: 12px 0;
            overflow: hidden;
            white-space: nowrap;
        }
        .ticker-inner {
            display: inline-flex;
            gap: 0;
            animation: ticker 20s linear infinite;
        }
        .ticker-item {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--black);
            padding: 0 40px;
        }
        .ticker-dot {
            color: rgba(0,0,0,0.4);
        }
        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ABOUT */
        .about-wrap {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 100px;
            align-items: center;
        }
        .about-visual {
            position: relative;
        }
        .about-img-main {
            width: 100%;
            aspect-ratio: 4/5;
            background: var(--surface);
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border);
        }
        .about-img-main::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,90,31,0.15) 0%, rgba(46,204,64,0.1) 100%);
        }
        .about-img-accent {
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 55%;
            aspect-ratio: 1;
            background: var(--surface2);
            border-radius: 4px;
            border: 1px solid var(--border);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .about-kabaddi-visual {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, var(--surface) 0%, rgba(255,90,31,0.08) 100%);
        }
        .about-kabaddi-raider {
            font-size: 80px;
            line-height: 1;
        }
        .about-badge {
            position: absolute;
            top: 30px;
            right: -15px;
            background: var(--orange);
            color: var(--black);
            padding: 16px 20px;
            border-radius: 4px;
            text-align: center;
        }
        .about-badge-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 32px;
            font-weight: 900;
            line-height: 1;
        }
        .about-badge-text {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            opacity: 0.8;
        }
        .about-text p {
            font-size: 17px;
            line-height: 1.7;
            color: rgba(245,245,240,0.65);
            margin-bottom: 20px;
        }
        .about-text p strong { color: var(--white); }
        .about-pillars {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
            margin-top: 40px;
        }
        .pillar {
            background: var(--surface);
            padding: 20px;
            border: 1px solid var(--border);
            transition: border-color 0.2s, background 0.2s;
        }
        .pillar:hover {
            border-color: rgba(255,90,31,0.3);
            background: rgba(255,90,31,0.05);
        }
        .pillar-icon { font-size: 24px; margin-bottom: 8px; }
        .pillar-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .pillar-desc { font-size: 13px; color: var(--muted); line-height: 1.5; }

        /* SERVICES */
        .services-section {
            background: var(--charcoal);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .services-header {
            max-width: 1200px;
            margin: 0 auto 70px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }
        .services-intro {
            font-size: 17px;
            color: rgba(245,245,240,0.55);
            max-width: 360px;
            line-height: 1.6;
        }
        .services-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2px;
        }
        .service-card {
            background: var(--surface);
            padding: 40px 32px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, border-color 0.3s;
            cursor: none;
        }
        .service-card::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--orange), var(--saffron));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s;
        }
        .service-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,90,31,0.04) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .service-card:hover {
            transform: translateY(-6px);
            border-color: rgba(255,90,31,0.25);
        }
        .service-card:hover::before { transform: scaleX(1); }
        .service-card:hover::after { opacity: 1; }
        .service-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
            color: var(--orange);
            margin-bottom: 24px;
            opacity: 0.6;
        }
        .service-icon {
            font-size: 36px;
            margin-bottom: 20px;
            display: block;
        }
        .service-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
            color: var(--white);
        }
        .service-tag {
            font-size: 13px;
            color: var(--orange);
            font-style: italic;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .service-features {
            list-style: none;
            margin-top: 20px;
        }
        .service-features li {
            font-size: 13px;
            color: var(--muted);
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .service-features li::before {
            content: '→';
            color: var(--orange);
            font-size: 12px;
            flex-shrink: 0;
        }
        .service-features li:last-child { border-bottom: none; }

        /* NEWS */
        .news-section { max-width: 1200px; margin: 0 auto; }
        .news-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 50px;
        }
        .news-filter {
            display: flex;
            gap: 4px;
        }
        .filter-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 8px 18px;
            font-family: 'Barlow', sans-serif;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: none;
            border-radius: 2px;
            transition: all 0.2s;
        }
        .filter-btn.active, .filter-btn:hover {
            background: var(--orange);
            border-color: var(--orange);
            color: var(--black);
        }
        .news-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 2px;
        }
        .news-card {
            background: var(--surface);
            border: 1px solid var(--border);
            overflow: hidden;
            cursor: none;
            transition: border-color 0.2s;
        }
        .news-card:hover { border-color: rgba(255,90,31,0.3); }
        .news-card.featured { grid-row: span 2; }
        .news-thumb {
            aspect-ratio: 16/9;
            background: var(--surface2);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }
        .news-card.featured .news-thumb { aspect-ratio: 3/2; font-size: 100px; }
        .news-thumb-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.7));
        }
        .news-cat {
            position: absolute;
            top: 16px; left: 16px;
            background: var(--orange);
            color: var(--black);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 2px;
        }
        .news-body { padding: 20px; }
        .news-card.featured .news-body { padding: 28px; }
        .news-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.3px;
            line-height: 1.2;
            margin-bottom: 8px;
            color: var(--white);
        }
        .news-card.featured .news-title { font-size: 26px; }
        .news-summary { font-size: 13px; color: var(--muted); line-height: 1.5; margin-bottom: 16px; }
        .news-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            letter-spacing: 1px;
        }
        .news-meta span { text-transform: uppercase; }
        .news-meta-dot { width: 3px; height: 3px; background: var(--orange); border-radius: 50%; }

        /* SPONSOR */
        .sponsor-section {
            background: var(--charcoal);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            text-align: center;
        }
        .sponsor-inner { max-width: 900px; margin: 0 auto; }
        .sponsor-tagline {
            font-size: 18px;
            color: rgba(245,245,240,0.5);
            margin-bottom: 60px;
            line-height: 1.6;
            font-weight: 300;
        }
        .sponsor-tagline strong { color: var(--white); }
        .sponsor-stats {
            display: flex;
            justify-content: center;
            gap: 0;
            margin-bottom: 60px;
            border: 1px solid var(--border);
        }
        .sponsor-stat {
            flex: 1;
            padding: 32px 20px;
            border-right: 1px solid var(--border);
            position: relative;
        }
        .sponsor-stat:last-child { border-right: none; }
        .sponsor-stat-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 48px;
            font-weight: 900;
            background: linear-gradient(135deg, var(--orange), var(--saffron));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 6px;
        }
        .sponsor-stat-label { font-size: 12px; color: var(--muted); letter-spacing: 2px; text-transform: uppercase; }
        .sponsor-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }

        /* WHY */
        .why-wrap { max-width: 1200px; margin: 0 auto; }
        .why-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
            margin-top: 60px;
        }
        .why-item {
            background: var(--surface);
            padding: 36px;
            border: 1px solid var(--border);
            display: flex;
            gap: 24px;
            transition: border-color 0.2s, background 0.2s;
        }
        .why-item:hover {
            border-color: rgba(255,90,31,0.2);
            background: rgba(255,90,31,0.03);
        }
        .why-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 48px;
            font-weight: 900;
            color: rgba(255,90,31,0.15);
            line-height: 1;
            flex-shrink: 0;
        }
        .why-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .why-desc { font-size: 14px; color: var(--muted); line-height: 1.6; }

        /* VIDEO STRIP */
        .video-strip {
            padding: 80px 0;
            overflow: hidden;
            background: var(--charcoal);
            border-top: 1px solid var(--border);
        }
        .video-strip-label {
            padding: 0 60px;
            margin-bottom: 30px;
        }
        .video-scroll {
            display: flex;
            gap: 16px;
            padding: 0 60px;
            overflow-x: auto;
            scrollbar-width: none;
            cursor: grab;
        }
        .video-scroll::-webkit-scrollbar { display: none; }
        .video-reel {
            flex-shrink: 0;
            width: 220px;
            aspect-ratio: 9/16;
            background: var(--surface);
            border-radius: 6px;
            border: 1px solid var(--border);
            overflow: hidden;
            position: relative;
            transition: transform 0.2s, border-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
        }
        .video-reel:hover {
            transform: scale(1.03);
            border-color: rgba(255,90,31,0.3);
        }
        .video-reel-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.8));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .video-reel:hover .video-reel-overlay { opacity: 1; }
        .play-btn {
            width: 44px; height: 44px;
            background: var(--orange);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .video-reel-bg {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .reel-emoji { font-size: 60px; opacity: 0.6; }

        /* CTA FINAL */
        .final-cta {
            text-align: center;
            padding: 140px 60px;
            position: relative;
            overflow: hidden;
        }
        .final-cta-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 70% at 50% 50%, rgba(255,90,31,0.08) 0%, transparent 70%);
        }
        .final-cta-content { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
        .final-cta-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(52px, 8vw, 96px);
            font-weight: 900;
            text-transform: uppercase;
            line-height: 0.95;
            letter-spacing: -2px;
            margin-bottom: 28px;
        }
        .final-cta-title em {
            font-style: normal;
            -webkit-text-stroke: 2px var(--orange);
            -webkit-text-fill-color: transparent;
            color: transparent;
        }
        .final-cta-sub {
            font-size: 17px;
            color: rgba(245,245,240,0.5);
            margin-bottom: 44px;
            line-height: 1.6;
        }

        /* FOOTER */
        footer {
            background: var(--charcoal);
            border-top: 1px solid var(--border);
            padding: 60px;
        }
        .footer-top {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto 50px;
        }
        .footer-brand {}
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .footer-logo img { width: 40px; height: 40px; border-radius: 50%; }
        .footer-logo-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
        }
        .footer-logo-text span { color: var(--orange); }
        .footer-brand p {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 24px;
        }
        .footer-socials {
            display: flex;
            gap: 12px;
        }
        .social-link {
            width: 38px; height: 38px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
        }
        .social-link:hover { background: var(--orange); border-color: var(--orange); }
        .footer-col h4 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--white);
            margin-bottom: 20px;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li {
            margin-bottom: 10px;
        }
        .footer-col ul li a {
            text-decoration: none;
            color: var(--muted);
            font-size: 14px;
            transition: color 0.2s;
        }
        .footer-col ul li a:hover { color: var(--orange); }
        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 12px;
        }
        .footer-contact-item span:first-child { color: var(--orange); font-size: 16px; }
        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 30px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .footer-bottom p { font-size: 13px; color: rgba(255,255,255,0.25); }
        .footer-tagline {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--orange);
            opacity: 0.7;
        }

        /* REVEAL ANIMATIONS */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            nav { padding: 18px 30px; }
            nav.scrolled { padding: 12px 30px; }
            .nav-links { display: none; }
            section { padding: 80px 30px; }
            .about-wrap { grid-template-columns: 1fr; gap: 50px; }
            .about-img-main { aspect-ratio: 16/9; }
            .about-img-accent { display: none; }
            .about-badge { display: none; }
            .services-grid { grid-template-columns: 1fr 1fr; }
            .news-grid { grid-template-columns: 1fr; }
            .news-card.featured { grid-row: auto; }
            .footer-top { grid-template-columns: 1fr 1fr; gap: 40px; }
            .why-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .hero-stats { gap: 30px; }
            .services-grid { grid-template-columns: 1fr; }
            .sponsor-stats { flex-direction: column; }
            .sponsor-stat { border-right: none; border-bottom: 1px solid var(--border); }
            .footer-top { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
            .services-header { flex-direction: column; align-items: flex-start; gap: 20px; }
            .news-header { flex-direction: column; align-items: flex-start; gap: 20px; }
        }
    </style>
</head>
<body>

<!-- CURSOR -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAV -->
<nav id="navbar">
    <a href="#" class="nav-logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="ADT Sports Logo" style="background:#111; padding:4px;">
        <div class="nav-logo-text"><span>ADT</span> SPORTS</div>
    </a>
    <ul class="nav-links">
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#news">News</a></li>
        <li><a href="#partner">Partner</a></li>
        <li><a href="#contact" class="nav-cta">Contact</a></li>
    </ul>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="hero-particles" id="particles"></div>

    <div class="hero-content">
        <div class="hero-eyebrow">India's #1 Kabaddi Media Platform</div>
        <h1 class="hero-title">
            <span class="line1">Where</span>
            <span class="line2">Kabaddi Lives.</span>
        </h1>
        <p class="hero-sub">Covering, Creating & Broadcasting the Sport Globally — From grassroots mats to international arenas.</p>
        <div class="hero-btns">
            <a href="#services" class="btn-primary">Explore Services</a>
            <a href="#news" class="btn-secondary">Latest Updates</a>
        </div>
    </div>

    <div class="hero-stats">
        <div class="stat-item">
            <div class="stat-num">2M+</div>
            <div class="stat-label">Followers</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">#1</div>
            <div class="stat-label">Kabaddi Page</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">500+</div>
            <div class="stat-label">Matches Covered</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">10+</div>
            <div class="stat-label">League Partners</div>
        </div>
    </div>

    <div class="scroll-indicator">
        <div class="scroll-line"></div>
        <div class="scroll-text">Scroll</div>
    </div>
</section>

<!-- TICKER -->
<div class="ticker">
    <div class="ticker-inner" id="tickerInner">
        <span class="ticker-item">Pro Kabaddi League</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Live Coverage</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Player Interviews</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Match Analytics</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Grassroots Kabaddi</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Global Broadcast</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Athlete Branding</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">TSR Live Scoring</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Pro Kabaddi League</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Live Coverage</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Player Interviews</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Match Analytics</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Grassroots Kabaddi</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Global Broadcast</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">Athlete Branding</span>
        <span class="ticker-item ticker-dot">◆</span>
        <span class="ticker-item">TSR Live Scoring</span>
        <span class="ticker-item ticker-dot">◆</span>
    </div>
</div>

<!-- ABOUT -->
<section id="about" style="padding-top: 120px; padding-bottom: 120px;">
    <div class="about-wrap">
        <div class="about-visual reveal">
            <div class="about-img-main">
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:16px;">
                    <div style="font-size:120px;line-height:1;opacity:0.5;">🤸</div>
                    <div style="font-family:'Barlow Condensed',sans-serif;font-size:14px;letter-spacing:3px;text-transform:uppercase;color:var(--muted);">ADT Sports Coverage</div>
                </div>
            </div>
            <div class="about-img-accent">
                <div class="about-kabaddi-visual">
                    <div class="reel-emoji">🏆</div>
                </div>
            </div>
            <div class="about-badge">
                <div class="about-badge-num">#1</div>
                <div class="about-badge-text">Globally</div>
            </div>
        </div>

        <div class="about-text reveal">
            <div class="section-label">Our Story</div>
            <h2 class="section-title">Built For Kabaddi.<br><em>Built For Impact.</em></h2>
            <p>ADT Sports isn't just a media page. It's a <strong>movement built from the ground up</strong> — born from a deep passion for Kabaddi and a vision to take this ancient sport to every corner of the globe.</p>
            <p>From <strong>Star Sports collaborations</strong> to grassroots league coverage, we've embedded ourselves in the Kabaddi ecosystem like no other platform. We don't just report — we shape the narrative.</p>
            <p style="color:var(--orange);font-style:italic;font-size:16px;font-weight:500;border-left:3px solid var(--orange);padding-left:20px;">"ADT Sports is not covering Kabaddi. It is building its future."</p>

            <div class="about-pillars">
                <div class="pillar">
                    <div class="pillar-icon">📡</div>
                    <div class="pillar-title">Coverage</div>
                    <div class="pillar-desc">Every mat, every raid, every moment.</div>
                </div>
                <div class="pillar">
                    <div class="pillar-icon">🎬</div>
                    <div class="pillar-title">Creation</div>
                    <div class="pillar-desc">Cinematic storytelling for the sport.</div>
                </div>
                <div class="pillar">
                    <div class="pillar-icon">📺</div>
                    <div class="pillar-title">Broadcast</div>
                    <div class="pillar-desc">Taking Kabaddi to global screens.</div>
                </div>
                <div class="pillar">
                    <div class="pillar-icon">📊</div>
                    <div class="pillar-title">Analytics</div>
                    <div class="pillar-desc">Data that powers the sport's growth.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="services-section" id="services">
    <div class="services-header reveal">
        <div>
            <div class="section-label">What We Do</div>
            <h2 class="section-title">Our <em>Services</em></h2>
        </div>
        <p class="services-intro">From viral social content to live broadcasting infrastructure — we are the complete Kabaddi media ecosystem.</p>
    </div>
    <div class="services-grid">
        <div class="service-card reveal">
            <div class="service-num">01</div>
            <span class="service-icon">📱</span>
            <div class="service-title">Social Media Management</div>
            <div class="service-tag">"We don't just post. We create impact."</div>
            <ul class="service-features">
                <li>Athlete branding & fan connection</li>
                <li>League promotions & campaigns</li>
                <li>Viral content strategy</li>
                <li>Community building</li>
            </ul>
        </div>
        <div class="service-card reveal">
            <div class="service-num">02</div>
            <span class="service-icon">🎥</span>
            <div class="service-title">Live Broadcasting</div>
            <div class="service-tag">"From local mats to global screens."</div>
            <ul class="service-features">
                <li>Multi-cam production</li>
                <li>Live streaming (YouTube / WAVE)</li>
                <li>Real-time engagement</li>
                <li>Commentary & analysis</li>
            </ul>
        </div>
        <div class="service-card reveal">
            <div class="service-num">03</div>
            <span class="service-icon">🎞️</span>
            <div class="service-title">Content Creation</div>
            <div class="service-tag">"Stories that make players unforgettable."</div>
            <ul class="service-features">
                <li>Reels, docs, interviews</li>
                <li>High-end cinematic shoots</li>
                <li>Athlete storytelling</li>
                <li>Brand integration</li>
            </ul>
        </div>
        <div class="service-card reveal">
            <div class="service-num">04</div>
            <span class="service-icon">📊</span>
            <div class="service-title">TSR System</div>
            <div class="service-tag">"Data that powers Kabaddi."</div>
            <ul class="service-features">
                <li>Player stats tracking</li>
                <li>Live scoring dashboard</li>
                <li>League analytics</li>
                <li>Performance reports</li>
            </ul>
        </div>
    </div>
</section>

<!-- NEWS -->
<section id="news" style="padding: 120px 60px; max-width: 1320px; margin: 0 auto;">
    <div class="news-header reveal">
        <div>
            <div class="section-label">Stay Informed</div>
            <h2 class="section-title">Kabaddi <em>News</em></h2>
        </div>
        <div class="news-filter">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Matches</button>
            <button class="filter-btn">Players</button>
            <button class="filter-btn">Leagues</button>
        </div>
    </div>
    <div class="news-grid reveal">
        <div class="news-card featured">
            <div class="news-thumb" style="background: linear-gradient(135deg, #1a1a1a, #2a1a0a);">
                <div class="reel-emoji">🏅</div>
                <div class="news-thumb-overlay"></div>
                <div class="news-cat">Match Update</div>
            </div>
            <div class="news-body">
                <div class="news-title">Pro Kabaddi Season 11: The Ultimate Showdown Begins — Everything You Need to Know</div>
                <div class="news-summary">The most anticipated Kabaddi season returns with 12 teams, new player transfers, and upgraded broadcasting partnerships. ADT Sports brings you complete coverage from every match.</div>
                <div class="news-meta">
                    <span>Apr 2025</span>
                    <div class="news-meta-dot"></div>
                    <span>5 min read</span>
                </div>
            </div>
        </div>
        <div class="news-card">
            <div class="news-thumb" style="background: linear-gradient(135deg, #0a1a2a, #1a2a1a); font-size:40px;">🤸</div>
            <div class="news-body">
                <div class="news-cat" style="position:static;display:inline-block;margin-bottom:8px;">Player Story</div>
                <div class="news-title">Rising Raider: The Story of India's Next Kabaddi Superstar</div>
                <div class="news-meta"><span>Mar 2025</span><div class="news-meta-dot"></div><span>3 min read</span></div>
            </div>
        </div>
        <div class="news-card">
            <div class="news-thumb" style="background: linear-gradient(135deg, #1a0a2a, #0a1a1a); font-size:40px;">🌐</div>
            <div class="news-body">
                <div class="news-cat" style="position:static;display:inline-block;margin-bottom:8px;background:var(--green);color:var(--black);">Global</div>
                <div class="news-title">Kabaddi Goes International: New Leagues Launch Across 5 Countries</div>
                <div class="news-meta"><span>Mar 2025</span><div class="news-meta-dot"></div><span>4 min read</span></div>
            </div>
        </div>
        <div class="news-card">
            <div class="news-thumb" style="background: linear-gradient(135deg, #2a1a0a, #0a2a1a); font-size:40px;">📊</div>
            <div class="news-body">
                <div class="news-cat" style="position:static;display:inline-block;margin-bottom:8px;">Insights</div>
                <div class="news-title">TSR Analytics: Which Teams Have the Best Raid Success Rate in 2025?</div>
                <div class="news-meta"><span>Feb 2025</span><div class="news-meta-dot"></div><span>6 min read</span></div>
            </div>
        </div>
        <div class="news-card">
            <div class="news-thumb" style="background: linear-gradient(135deg, #0a2a0a, #2a2a0a); font-size:40px;">🏆</div>
            <div class="news-body">
                <div class="news-cat" style="position:static;display:inline-block;margin-bottom:8px;background:var(--saffron);color:var(--black);">League</div>
                <div class="news-title">National Kabaddi Championship 2025: Schedule, Squads & Live Stream Details</div>
                <div class="news-meta"><span>Feb 2025</span><div class="news-meta-dot"></div><span>4 min read</span></div>
            </div>
        </div>
    </div>
</section>

<!-- SPONSOR -->
<section class="sponsor-section" id="partner">
    <div class="sponsor-inner reveal">
        <div class="section-label" style="justify-content:center;">Partner With Us</div>
        <h2 class="section-title">Partner With The<br><em>Pulse of Kabaddi.</em></h2>
        <p class="sponsor-tagline">
            Reach <strong>millions of passionate Kabaddi fans</strong> through India's most trusted and widely followed Kabaddi media brand. Your brand, amplified.
        </p>
        <div class="sponsor-stats">
            <div class="sponsor-stat">
                <div class="sponsor-stat-num">2M+</div>
                <div class="sponsor-stat-label">Total Reach</div>
            </div>
            <div class="sponsor-stat">
                <div class="sponsor-stat-num">8%+</div>
                <div class="sponsor-stat-label">Engagement Rate</div>
            </div>
            <div class="sponsor-stat">
                <div class="sponsor-stat-num">50M+</div>
                <div class="sponsor-stat-label">Video Views</div>
            </div>
            <div class="sponsor-stat">
                <div class="sponsor-stat-num">10+</div>
                <div class="sponsor-stat-label">Brand Partners</div>
            </div>
        </div>
        <div class="sponsor-btns">
            <a href="mailto:aditya03091995@gmail.com" class="btn-primary">Become a Partner</a>
            <a href="#" class="btn-secondary">Download Media Kit</a>
        </div>
    </div>
</section>

<!-- WHY ADT -->
<section>
    <div class="why-wrap">
        <div class="reveal">
            <div class="section-label">The Differentiator</div>
            <h2 class="section-title">Why Choose <em>ADT Sports</em></h2>
        </div>
        <div class="why-grid">
            <div class="why-item reveal">
                <div class="why-num">01</div>
                <div>
                    <div class="why-title">Deep Ecosystem Access</div>
                    <div class="why-desc">We have relationships inside Kabaddi's ecosystem that no other media brand can match — from national federations to grassroots organizers.</div>
                </div>
            </div>
            <div class="why-item reveal">
                <div class="why-num">02</div>
                <div>
                    <div class="why-title">Creator + Broadcaster + Tech</div>
                    <div class="why-desc">We are the only platform that combines content creation, live broadcasting, and proprietary TSR analytics under one roof.</div>
                </div>
            </div>
            <div class="why-item reveal">
                <div class="why-num">03</div>
                <div>
                    <div class="why-title">Youth to Pro Coverage</div>
                    <div class="why-desc">From school-level tournaments to Pro Kabaddi League, we cover every tier of the game — delivering complete sport lifecycle coverage.</div>
                </div>
            </div>
            <div class="why-item reveal">
                <div class="why-num">04</div>
                <div>
                    <div class="why-title">Proven Reach & Engagement</div>
                    <div class="why-desc">Over 2 million followers and industry-leading engagement rates prove our content doesn't just get seen — it drives action.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VIDEO STRIP -->
<div class="video-strip">
    <div class="video-strip-label">
        <div class="section-label">Content Reel</div>
        <h3 style="font-family:'Barlow Condensed',sans-serif;font-size:32px;font-weight:900;text-transform:uppercase;letter-spacing:-0.5px;">Watch <em style="font-style:normal;color:var(--orange);">Our Work</em></h3>
    </div>
    <div class="video-scroll" id="videoScroll">
        <div class="video-reel" style="background:linear-gradient(135deg,#1a0a0a,#2a1010);">
            <div class="video-reel-bg"><span class="reel-emoji">🤸</span></div>
            <div class="video-reel-overlay"><div class="play-btn">▶</div></div>
        </div>
        <div class="video-reel" style="background:linear-gradient(135deg,#0a1a0a,#102a10);">
            <div class="video-reel-bg"><span class="reel-emoji">🏟️</span></div>
            <div class="video-reel-overlay"><div class="play-btn">▶</div></div>
        </div>
        <div class="video-reel" style="background:linear-gradient(135deg,#0a0a1a,#10102a);">
            <div class="video-reel-bg"><span class="reel-emoji">🏆</span></div>
            <div class="video-reel-overlay"><div class="play-btn">▶</div></div>
        </div>
        <div class="video-reel" style="background:linear-gradient(135deg,#1a1a0a,#2a2a10);">
            <div class="video-reel-bg"><span class="reel-emoji">🎯</span></div>
            <div class="video-reel-overlay"><div class="play-btn">▶</div></div>
        </div>
        <div class="video-reel" style="background:linear-gradient(135deg,#1a0a1a,#2a102a);">
            <div class="video-reel-bg"><span class="reel-emoji">🎬</span></div>
            <div class="video-reel-overlay"><div class="play-btn">▶</div></div>
        </div>
        <div class="video-reel" style="background:linear-gradient(135deg,#0a1a1a,#102a2a);">
            <div class="video-reel-bg"><span class="reel-emoji">📊</span></div>
            <div class="video-reel-overlay"><div class="play-btn">▶</div></div>
        </div>
        <div class="video-reel" style="background:linear-gradient(135deg,#1a0a0a,#2a1010);">
            <div class="video-reel-bg"><span class="reel-emoji">⚡</span></div>
            <div class="video-reel-overlay"><div class="play-btn">▶</div></div>
        </div>
    </div>
</div>

<!-- FINAL CTA -->
<section class="final-cta" id="contact">
    <div class="final-cta-bg"></div>
    <div class="final-cta-content reveal">
        <div class="section-label" style="justify-content:center;">Get In Touch</div>
        <h2 class="final-cta-title">Let's Build<br><em>Kabaddi</em><br>Together.</h2>
        <p class="final-cta-sub">Whether you're a brand, league, athlete, or collaborator — if you believe in Kabaddi's global future, we want to talk.</p>
        <div class="hero-btns">
            <a href="mailto:aditya03091995@gmail.com" class="btn-primary">Contact Us</a>
            <a href="mailto:aditya03091995@gmail.com" class="btn-secondary">Work With Us</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-top">
        <div class="footer-brand">
            <div class="footer-logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="ADT Sports" style="background:#222;padding:3px;">
                <div class="footer-logo-text"><span>ADT</span> SPORTS</div>
            </div>
            <p>India's #1 Kabaddi-focused digital media brand. We are not covering Kabaddi — we are building its future.</p>
            <div class="footer-socials">
                <a href="#" class="social-link">📘</a>
                <a href="#" class="social-link">📸</a>
                <a href="#" class="social-link">▶️</a>
                <a href="#" class="social-link">🐦</a>
            </div>
        </div>
        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#about">About ADT Sports</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#news">Kabaddi News</a></li>
                <li><a href="#partner">Partner With Us</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Services</h4>
            <ul>
                <li><a href="#">Social Media Management</a></li>
                <li><a href="#">Live Broadcasting</a></li>
                <li><a href="#">Content Production</a></li>
                <li><a href="#">TSR System</a></li>
                <li><a href="#">Media Kit</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contact</h4>
            <div class="footer-contact-item">
                <span>📞</span>
                <span>+91 9979269732</span>
            </div>
            <div class="footer-contact-item">
                <span>✉️</span>
                <span>aditya03091995@gmail.com</span>
            </div>
            <div class="footer-contact-item">
                <span>📍</span>
                <span>India — Covering the World</span>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025 ADT Sports. All rights reserved.</p>
        <div class="footer-tagline">Built For Kabaddi. Built For Impact.</div>
    </div>
</footer>

<script>
    // CURSOR
    const cursor = document.getElementById('cursor');
    const ring = document.getElementById('cursorRing');
    let mx = 0, my = 0, rx = 0, ry = 0;
    document.addEventListener('mousemove', e => {
        mx = e.clientX; my = e.clientY;
        cursor.style.left = mx + 'px';
        cursor.style.top = my + 'px';
    });
    function animateRing() {
        rx += (mx - rx) * 0.12;
        ry += (my - ry) * 0.12;
        ring.style.left = rx + 'px';
        ring.style.top = ry + 'px';
        requestAnimationFrame(animateRing);
    }
    animateRing();
    document.querySelectorAll('a, button, .service-card, .news-card').forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.width = '20px';
            cursor.style.height = '20px';
            ring.style.width = '60px';
            ring.style.height = '60px';
            ring.style.borderColor = 'rgba(255,90,31,0.8)';
        });
        el.addEventListener('mouseleave', () => {
            cursor.style.width = '12px';
            cursor.style.height = '12px';
            ring.style.width = '40px';
            ring.style.height = '40px';
            ring.style.borderColor = 'rgba(255,90,31,0.5)';
        });
    });

    // NAV SCROLL
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 50);
    });

    // PARTICLES
    const particlesContainer = document.getElementById('particles');
    const colors = ['#FF5A1F', '#FF8C00', '#2ECC40', 'rgba(255,255,255,0.4)'];
    for (let i = 0; i < 20; i++) {
        const p = document.createElement('div');
        p.classList.add('particle');
        const size = Math.random() * 4 + 2;
        p.style.cssText = `
      width: ${size}px; height: ${size}px;
      left: ${Math.random() * 100}%;
      background: ${colors[Math.floor(Math.random() * colors.length)]};
      animation-duration: ${Math.random() * 15 + 10}s;
      animation-delay: ${Math.random() * 10}s;
    `;
        particlesContainer.appendChild(p);
    }

    // REVEAL ON SCROLL
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(entries => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
            }
        });
    }, { threshold: 0.1 });
    reveals.forEach(el => observer.observe(el));

    // NEWS FILTER
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // VIDEO SCROLL DRAG
    const vs = document.getElementById('videoScroll');
    let isDown = false, startX, scrollLeft;
    vs.addEventListener('mousedown', e => { isDown = true; vs.style.cursor = 'grabbing'; startX = e.pageX - vs.offsetLeft; scrollLeft = vs.scrollLeft; });
    vs.addEventListener('mouseleave', () => { isDown = false; vs.style.cursor = 'grab'; });
    vs.addEventListener('mouseup', () => { isDown = false; vs.style.cursor = 'grab'; });
    vs.addEventListener('mousemove', e => { if (!isDown) return; e.preventDefault(); const x = e.pageX - vs.offsetLeft; const walk = (x - startX) * 2; vs.scrollLeft = scrollLeft - walk; });

    // COUNTER ANIMATION
    function animateCounter(el, target, suffix = '') {
        let current = 0;
        const step = target / 60;
        const timer = setInterval(() => {
            current += step;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = Math.floor(current) + suffix;
        }, 16);
    }
    const statsObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                document.querySelector('.sponsor-stats') && document.querySelectorAll('.sponsor-stat-num').forEach(el => {
                    const text = el.textContent;
                    if (text.includes('2M')) animateCounter(el, 2, 'M+');
                    else if (text.includes('8%')) { el.textContent = '0%+'; setTimeout(() => { let n=0; const t=setInterval(()=>{n+=0.2;if(n>=8){clearInterval(t);el.textContent='8%+';}else el.textContent=n.toFixed(1)+'%+';},40); }, 0); }
                    else if (text.includes('50M')) animateCounter(el, 50, 'M+');
                    else if (text.includes('10')) animateCounter(el, 10, '+');
                });
                statsObserver.disconnect();
            }
        });
    }, { threshold: 0.5 });
    const sponsorSec = document.querySelector('.sponsor-section');
    if (sponsorSec) statsObserver.observe(sponsorSec);
</script>
</body>
</html>
