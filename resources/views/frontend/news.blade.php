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

        {{-- منطقة أزرار الانتقال المبسطة على شكل أسهم ناعمة --}}
        <div class="pagination-wrapper">
            {{-- زر السابق --}}
            @if ($articles->onFirstPage())
                <span class="nav-icon disabled">←</span>
            @else
                <a href="{{ $articles->previousPageUrl() }}" class="nav-icon">←</a>
            @endif

            {{-- زر التالي --}}
            @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}" class="nav-icon">→</a>
            @else
                <span class="nav-icon disabled">→</span>
            @endif
        </div>
    </div>
</main>

{{-- الأناقة والترتيب ضفناهم هان مباشرة عشان يظبطوا فوراً --}}
<style>
    .pagination-wrapper {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 15px !important;
        margin: 40px 0 !important;
        width: 100% !important;
    }

    .pagination-wrapper .nav-icon {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        background-color: #1a446c !important; /* الكحلي الأنيق للـ Navbar */
        color: #ffffff !important;
        font-size: 18px !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
    }

    /* تأثير تمرير الماوس ليتحول للون الأحمر الهادئ مثل زر الدعم */
    .pagination-wrapper .nav-icon:not(.disabled):hover {
        background-color: #b32d2e !important;
    }

    /* شكل السهم المعطل المفاتيح الهادئة */
    .pagination-wrapper .nav-icon.disabled {
        background-color: #f1f5f9 !important;
        color: #cbd5e1 !important;
        cursor: not-allowed !important;
    }
</style>
@endsection