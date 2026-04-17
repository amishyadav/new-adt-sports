<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} | ADT Sports</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #080808;
            --charcoal: #111111;
            --surface: #161616;
            --orange: #FF5A1F;
            --white: #F5F5F0;
            --muted: #888888;
            --border: rgba(255,255,255,0.07);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: var(--black);
            color: var(--white);
            font-family: 'Barlow', sans-serif;
            overflow-x: hidden;
        }
        a { color: inherit; }

        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(8,8,8,0.94);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 16px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-logo img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
        }
        .nav-logo-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1px;
        }
        .nav-logo-text span { color: var(--orange); }
        .nav-links {
            display: flex;
            gap: 28px;
            list-style: none;
            align-items: center;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }
        .nav-links a.active,
        .nav-links a:hover { color: var(--white); }
        .nav-cta {
            background: var(--orange);
            color: var(--black) !important;
            padding: 10px 20px;
            border-radius: 3px;
        }

        .hero {
            position: relative;
            min-height: 76vh;
            display: flex;
            align-items: end;
            padding: 180px 60px 70px;
            background:
                linear-gradient(180deg, rgba(8,8,8,0.18), rgba(8,8,8,0.92)),
                radial-gradient(circle at top right, rgba(255,90,31,0.18), transparent 30%),
                url('{{ $blog->blog_image }}') center/cover no-repeat;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(circle at center, black 25%, transparent 85%);
        }
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 980px;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 24px;
        }
        .eyebrow::before,
        .eyebrow::after {
            content: '';
            width: 28px;
            height: 1px;
            background: var(--orange);
            opacity: 0.5;
        }
        h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(52px, 8vw, 104px);
            line-height: 0.95;
            text-transform: uppercase;
            letter-spacing: -1.6px;
            margin-bottom: 24px;
        }
        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
            color: rgba(245,245,240,0.74);
            text-transform: uppercase;
            letter-spacing: 1.3px;
            font-size: 12px;
        }
        .meta-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--orange);
        }

        .page-wrap {
            max-width: 1320px;
            margin: 0 auto;
            padding: 70px 60px 120px;
        }
        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 36px;
            align-items: start;
        }
        .article-card,
        .sidebar-card {
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border: 1px solid var(--border);
            border-radius: 6px;
            overflow: hidden;
        }
        .article-inner {
            padding: 40px;
        }
        .lead {
            font-size: 18px;
            line-height: 1.8;
            color: rgba(245,245,240,0.74);
            margin-bottom: 28px;
        }
        .article-body {
            color: rgba(245,245,240,0.82);
            line-height: 1.8;
            font-size: 16px;
        }
        .article-body h1,
        .article-body h2,
        .article-body h3,
        .article-body h4 {
            font-family: 'Barlow Condensed', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 28px 0 14px;
            line-height: 1.1;
            font-size: clamp(28px, 4vw, 44px);
        }
        .article-body p,
        .article-body ul,
        .article-body ol,
        .article-body blockquote {
            margin-bottom: 18px;
        }
        .article-body ul,
        .article-body ol {
            padding-left: 20px;
        }
        .article-body a { color: var(--orange); }
        .article-body img,
        .article-body iframe {
            max-width: 100%;
            border-radius: 4px;
        }
        .sidebar-card {
            padding: 28px;
        }
        .sidebar-card + .sidebar-card {
            margin-top: 24px;
        }
        .sidebar-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 26px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }
        .tag-pill {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,90,31,0.12);
            border: 1px solid rgba(255,90,31,0.25);
            color: var(--orange);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }
        .related-item {
            display: block;
            text-decoration: none;
            padding: 18px 0;
            border-top: 1px solid var(--border);
        }
        .related-item:first-of-type {
            border-top: 0;
            padding-top: 0;
        }
        .related-tag {
            color: var(--orange);
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .related-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            line-height: 1.05;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .related-date {
            color: var(--muted);
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .btn-row {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 22px;
        }
        .btn-primary,
        .btn-secondary {
            display: inline-block;
            text-decoration: none;
            padding: 14px 24px;
            border-radius: 3px;
            font-family: 'Barlow Condensed', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
        }
        .btn-primary {
            background: var(--orange);
            color: var(--black);
        }
        .btn-secondary {
            border: 1px solid rgba(255,255,255,0.18);
            color: var(--white);
        }
        footer {
            border-top: 1px solid var(--border);
            padding: 28px 60px;
            color: var(--muted);
            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: flex;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        @media (max-width: 980px) {
            nav,
            .hero,
            .page-wrap,
            footer {
                padding-left: 24px;
                padding-right: 24px;
            }
            .content-grid {
                grid-template-columns: 1fr;
            }
            .nav-links {
                display: none;
            }
            .article-inner {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('front.index') }}" class="nav-logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="ADT Sports Logo" style="background:#111; padding:4px;">
        <div class="nav-logo-text"><span>ADT</span> SPORTS</div>
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('front.index') }}">Home</a></li>
        <li><a href="{{ route('front.index') }}#services">Services</a></li>
        <li><a href="{{ route('front.blogs') }}" class="active">Blogs</a></li>
        <li><a href="{{ route('front.index') }}#partner">Partner</a></li>
        <li><a href="{{ route('front.contact') }}" class="nav-cta">Contact</a></li>
    </ul>
</nav>

<section class="hero">
    <div class="hero-content">
        <div class="eyebrow">{{ $blog->tag }}</div>
        <h1>{{ $blog->title }}</h1>
        <div class="meta">
            <span>ADT Sports</span>
            <div class="meta-dot"></div>
            <span>{{ $blog->created_at->format('F d, Y') }}</span>
            <div class="meta-dot"></div>
            <span>{{ max(1, (int) ceil(max(1, str_word_count(strip_tags($blog->description))) / 200)) }} min read</span>
        </div>
    </div>
</section>

<main class="page-wrap">
    <div class="content-grid">
        <article class="article-card">
            <div class="article-inner">
                <p class="lead">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 220) }}</p>
                <div class="article-body">{!! $blog->description !!}</div>
            </div>
        </article>

        <aside>
            <div class="sidebar-card">
                <div class="sidebar-title">Article Info</div>
                <div class="tag-pill">{{ $blog->tag }}</div>
                <div class="btn-row">
                    <a href="{{ route('front.blogs') }}" class="btn-primary">All Blogs</a>
                    <a href="{{ route('front.index') }}#news" class="btn-secondary">Back Home</a>
                </div>
            </div>

            @if($relatedBlogs->isNotEmpty())
                <div class="sidebar-card">
                    <div class="sidebar-title">More Stories</div>
                    @foreach($relatedBlogs as $relatedBlog)
                        <a href="{{ route('front.blog.detail', [$relatedBlog->slug, $relatedBlog->id]) }}" class="related-item">
                            <div class="related-tag">{{ $relatedBlog->tag }}</div>
                            <div class="related-title">{{ $relatedBlog->title }}</div>
                            <div class="related-date">{{ $relatedBlog->created_at->format('M d, Y') }}</div>
                        </a>
                    @endforeach
                </div>
            @endif
        </aside>
    </div>
</main>

<footer>
    <div>© {{ date('Y') }} ADT Sports. All rights reserved.</div>
    <div>Built For Kabaddi. Built For Impact.</div>
</footer>
</body>
</html>
