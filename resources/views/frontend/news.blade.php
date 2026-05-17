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
                        <img src="{{ $article->image_url ?? asset('reachout/img/default-news.png') }}" 
                             alt="{{ $article->title }}"
                             onerror="this.src='{{ asset('reachout/img/default-news.png') }}'">
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

        {{-- منطقة أزرار الانتقال --}}
        <div class="pagination-wrapper">
            {{ $articles->links() }}
        </div>
    </div>
</main>
@endsection