@extends('frontend.layouts.main')

@section('title', 'News - Mental Health Frontline')

@section('content')
<main class="news-page">
    <div class="container">
        <h1 class="page-title">Voices from the Ground</h1>

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
                             onerror="this.src='{{ $fallback }}'">
                    </div>
                    <div class="article-content">
                        <h2 class="article-header">{{ $article->title }}</h2>
                        <p class="article-description">
                            {{ Str::limit($article->description, 160) }}
                        </p>
                        <div class="article-footer">
                            <a href="{{ $article->url }}" target="_blank" class="read-more-btn">Read More...</a>
                            <span class="article-date">{{ $article->published_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="no-news">
                    <p>No news articles found. Please run "php artisan news:fetch".</p>
                </div>
            @endforelse
        </div>

        {{-- منطقة أزرار الانتقال الاحترافية الحديثة --}}
        <div class="news-pagination-bar">
            {{-- زر السابق --}}
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

            {{-- عداد الصفحة الأنيق --}}
            <div class="p-page-chip">
                <span>Page {{ $articles->currentPage() }}</span>
            </div>

            {{-- زر التالي --}}
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
       PROFESSIONAL PAGINATION BAR
    ═══════════════════════════════════════════════════════════════ */
    .news-pagination-bar {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 12px !important;
        margin: 50px auto 20px auto !important;
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
        padding: 10px 18px !important;
        border-radius: 30px !important;
        background: #f8fafc !important;
        color: #002b5c !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        border: 1px solid #e2e8f0 !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        cursor: pointer !important;
    }

    .p-nav-btn i {
        font-size: 12px !important;
        transition: transform 0.25s ease !important;
    }

    /* Hover effect */
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

    /* Disabled State */
    .p-nav-btn.disabled {
        background: #f8fafc !important;
        color: #cbd5e1 !important;
        border-color: #edf2f7 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
        box-shadow: none !important;
    }

    /* Page chip in the middle */
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
            width: 40px !important;
            height: 40px !important;
            padding: 0 !important;
            justify-content: center !important;
            border-radius: 50% !important;
        }
    }
</style>
@endsection