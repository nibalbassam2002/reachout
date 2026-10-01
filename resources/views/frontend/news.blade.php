@extends('frontend.layouts.main')

@section('title', 'News - Mental Health Frontline')

@section('content')
<main class="news-page">
    <div class="container">
        <!-- Modern News Header -->
        <div class="news-page-header">
            <h1 class="page-title font-display">Updates & Frontline Coverage</h1>
            <p class="news-page-sub">
                Live news covering Gaza and Palestine directly from Al Jazeera, Middle East Eye, and verified frontline humanitarian updates.
            </p>
        </div>

        <div class="articles-list">
            @forelse($articles as $article)
                <article class="article-card">
                    <div class="article-image">
                        @php
                            $fallbacks = [
                                asset('reachout/img/default-news-1.webp'),
                                asset('reachout/img/default-news-2.jpg'),
                                asset('reachout/img/default-news-3.webp'),
                            ];
                            $fallback = $fallbacks[$loop->index % 3];
                        @endphp
                        <img src="{{ $article->image_url ?? $fallback }}" 
                             alt="{{ $article->title }}"
                             loading="lazy"
                             onerror="this.src='{{ $fallback }}'">

                    </div>

                    <div class="article-content">
                        @php
                            $titleText = strtolower($article->title . ' ' . $article->description);
                            $isChildArticle = str_contains($titleText, 'child') || str_contains($titleText, 'kid') || str_contains($titleText, 'orphan') || str_contains($titleText, 'infant') || str_contains($titleText, 'baby') || str_contains($titleText, 'pediatric') || str_contains($titleText, 'school') || str_contains($titleText, 'student');
                        @endphp
                        <div class="article-meta-header">
                            <span class="article-date">
                                <i class="far fa-calendar-alt"></i> {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Recent' }}
                            </span>
                        </div>

                        <h2 class="article-header">
                            <a href="{{ $article->url }}" target="_blank" rel="noopener noreferrer">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="article-description">
                            {{ Str::limit($article->description, 160) }}
                        </p>

                        <div class="article-footer">
                            <a href="{{ $article->url }}" target="_blank" rel="noopener noreferrer" class="read-more-btn">
                                <span>Read Full Story</span>
                                <i class="fas fa-arrow-up-right-from-square"></i>
                            </a>
                            <span class="article-time-ago">
                                <i class="far fa-clock"></i> {{ $article->published_at ? $article->published_at->diffForHumans() : '' }}
                            </span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="no-news-box">
                    <div class="no-news-icon"><i class="fas fa-newspaper"></i></div>
                    <h3>Connecting to live news feeds...</h3>
                    <p>Fetching the latest updates from Al Jazeera and verified sources. Please refresh in a moment.</p>
                </div>
            @endforelse
        </div>

        {{-- Professional Pagination Bar --}}
        <div class="news-pagination-bar">
            {{-- Previous Button --}}
            @if ($articles->onFirstPage())
                <span class="p-nav-btn disabled" aria-disabled="true">
                    <i class="fas fa-chevron-left"></i>
                    <span>Previous</span>
                </span>
            @else
                <a href="{{ $articles->previousPageUrl() }}" class="p-nav-btn">
                    <i class="fas fa-chevron-left"></i>
                    <span>Previous</span>
                </a>
            @endif

            {{-- Current Page Chip --}}
            <div class="p-page-chip">
                <span>Page {{ $articles->currentPage() }}</span>
            </div>

            {{-- Next Button --}}
            @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}" class="p-nav-btn next">
                    <span>Next</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="p-nav-btn next disabled" aria-disabled="true">
                    <span>Next</span>
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>
    </div>
</main>

<style>
    /* ═══════════════════════════════════════════════════════════════
       NEWS PAGE ENHANCEMENTS & BRAND STYLING
    ═══════════════════════════════════════════════════════════════ */
    .news-page {
        padding: 115px 0 70px 0;
        background: #fbfcfe;
    }

    .news-page-header {
        text-align: center;
        max-width: 760px;
        margin: 0 auto 40px auto;
        padding: 0 16px;
    }

    .news-live-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .live-pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ef4444;
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        animation: pulseRed 1.8s infinite;
    }

    @keyframes pulseRed {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }

    .news-page-header .page-title {
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 800;
        color: #0a2a4a;
        margin-bottom: 12px;
        letter-spacing: -0.01em;
    }

    .news-page-sub {
        font-size: 15px;
        line-height: 1.6;
        color: #64748b;
        margin: 0 auto;
    }

    /* Articles List & Cards */
    /* Articles List & Cards */
    .articles-list {
        display: flex;
        flex-direction: column;
        gap: 24px;
        max-width: 1060px;
        margin: 0 auto;
        padding: 0 16px;
    }

    .article-card {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        gap: 26px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 4px 18px rgba(10, 42, 74, 0.04);
        transition: all 0.25s ease;
    }

    .article-card:hover {
        transform: translateY(-3px);
        border-color: #93c5fd;
        box-shadow: 0 10px 28px rgba(10, 42, 74, 0.08);
    }

    .article-image {
        position: relative;
        width: 280px;
        min-width: 280px;
        max-width: 280px;
        height: 195px;
        border-radius: 14px;
        overflow: hidden;
        background: #f1f5f9;
        flex-shrink: 0;
    }

    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .article-card:hover .article-image img {
        transform: scale(1.04);
    }

    .article-source-overlay {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(10, 42, 74, 0.85);
        backdrop-filter: blur(6px);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
        letter-spacing: 0.2px;
    }

    .article-content {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .article-meta-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }

    .meta-badges {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .article-source-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .article-source-pill.child-badge {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }

    .article-source-pill.source-badge {
        background: #eff6ff;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }

    .article-date {
        font-size: 12.5px;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
        white-space: nowrap;
    }

    .article-header {
        font-size: 19px;
        font-weight: 800;
        color: #0a2a4a;
        margin: 0 0 10px 0;
        line-height: 1.4;
    }

    .article-header a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s;
    }

    .article-header a:hover {
        color: #184B89;
    }

    .article-description {
        font-size: 14.5px;
        line-height: 1.6;
        color: #475569;
        margin-bottom: 16px;
        flex-grow: 1;
    }

    .article-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
        gap: 12px;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #002b5c;
        color: #ffffff;
        padding: 9px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .read-more-btn:hover {
        background: #0a2a4a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 43, 92, 0.25);
        color: #ffffff;
    }

    .read-more-btn i {
        font-size: 11px;
    }

    .article-time-ago {
        font-size: 12.5px;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
        white-space: nowrap;
    }

    /* Empty state */
    .no-news-box {
        text-align: center;
        padding: 60px 20px;
        background: #ffffff;
        border: 1.5px dashed #cbd5e1;
        border-radius: 18px;
    }

    .no-news-icon {
        font-size: 40px;
        color: #94a3b8;
        margin-bottom: 14px;
    }

    .no-news-box h3 {
        font-size: 18px;
        color: #0a2a4a;
        margin-bottom: 6px;
    }

    .no-news-box p {
        font-size: 14px;
        color: #64748b;
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .article-card {
            gap: 20px;
            padding: 18px;
        }

        .article-image {
            width: 240px;
            min-width: 240px;
            max-width: 240px;
            height: 180px;
        }

        .article-header {
            font-size: 17.5px;
        }
    }

    @media (max-width: 768px) {
        .news-page {
            padding: 95px 0 50px 0 !important;
            background: #f8fafc;
        }

        .news-page-header {
            margin-bottom: 22px;
            padding: 0 16px;
        }

        .news-page-header .page-title {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .news-page-sub {
            font-size: 13.5px;
            line-height: 1.5;
        }

        .articles-list {
            padding: 0 14px;
            gap: 16px;
        }

        .article-card {
            flex-direction: column !important;
            padding: 0 !important;
            border-radius: 16px !important;
            overflow: hidden !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 14px rgba(10, 42, 74, 0.05) !important;
            gap: 0 !important;
            background: #ffffff !important;
        }

        .article-card:hover {
            transform: none !important;
        }

        .article-image {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
            height: 185px !important;
            border-radius: 0 !important;
        }

        .article-content {
            padding: 14px 16px 16px 16px !important;
            width: 100% !important;
            gap: 8px !important;
        }

        .article-meta-header {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 6px !important;
            margin-bottom: 6px !important;
        }

        .meta-badges {
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
            flex-wrap: wrap !important;
        }

        .article-source-pill {
            font-size: 11px !important;
            padding: 3px 8px !important;
            border-radius: 6px !important;
        }

        .article-date {
            font-size: 11.5px !important;
            color: #94a3b8 !important;
        }

        .article-header {
            font-size: 16px !important;
            font-weight: 700 !important;
            line-height: 1.38 !important;
            margin: 0 0 6px 0 !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }

        .article-description {
            font-size: 13px !important;
            line-height: 1.5 !important;
            color: #64748b !important;
            margin-bottom: 12px !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }

        .article-footer {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding-top: 10px !important;
            border-top: 1px solid #f1f5f9 !important;
            margin-top: auto !important;
        }

        .read-more-btn {
            padding: 7px 14px !important;
            font-size: 12px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
        }

        .article-time-ago {
            font-size: 11.5px !important;
            color: #94a3b8 !important;
        }
    }

    @media (max-width: 480px) {
        .news-page {
            padding: 88px 0 40px 0 !important;
        }

        .news-page-header .page-title {
            font-size: 21px;
        }

        .news-page-sub {
            font-size: 13px;
        }

        .articles-list {
            padding: 0 12px;
            gap: 14px;
        }

        .article-image {
            height: 170px !important;
        }

        .article-content {
            padding: 12px 14px 14px 14px !important;
        }

        .article-header {
            font-size: 15px !important;
        }

        .article-description {
            font-size: 12.5px !important;
            line-height: 1.45 !important;
        }

        .read-more-btn {
            padding: 6px 12px !important;
            font-size: 11.5px !important;
        }

        .article-time-ago {
            font-size: 11px !important;
        }
    }

    /* ═══════════════════════════════════════════════════════════════
       PROFESSIONAL PAGINATION BAR
    ═══════════════════════════════════════════════════════════════ */
    .news-pagination-bar {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 12px !important;
        margin: 45px auto 20px auto !important;
        padding: 8px 14px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 50px !important;
        box-shadow: 0 4px 20px rgba(0, 43, 92, 0.07) !important;
        width: fit-content !important;
        max-width: 90% !important;
    }

    .p-nav-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 9px 18px !important;
        border-radius: 30px !important;
        background: #f8fafc !important;
        color: #002b5c !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        border: 1px solid #e2e8f0 !important;
        transition: all 0.25s ease !important;
        cursor: pointer !important;
    }

    .p-nav-btn i {
        font-size: 12px !important;
        transition: transform 0.25s ease !important;
    }

    .p-nav-btn:not(.disabled):hover {
        background: #002b5c !important;
        color: #ffffff !important;
        border-color: #002b5c !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(0, 43, 92, 0.2) !important;
    }

    .p-nav-btn:not(.disabled):hover i {
        transform: translateX(-3px) !important;
    }

    .p-nav-btn.next:not(.disabled):hover i {
        transform: translateX(3px) !important;
    }

    .p-nav-btn.disabled {
        background: #f8fafc !important;
        color: #cbd5e1 !important;
        border-color: #edf2f7 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
        box-shadow: none !important;
    }

    .p-page-chip {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 6px 14px !important;
        background: rgba(0, 43, 92, 0.05) !important;
        border-radius: 20px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #002b5c !important;
        letter-spacing: 0.3px !important;
    }

    @media (max-width: 576px) {
        .p-nav-btn span {
            display: none !important;
        }
        .p-nav-btn {
            width: 38px !important;
            height: 38px !important;
            padding: 0 !important;
            justify-content: center !important;
            border-radius: 50% !important;
        }
    }
</style>
@endsection