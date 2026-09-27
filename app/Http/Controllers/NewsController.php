<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\NewsFeedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index(NewsFeedService $newsService)
    {
        // 1. التحديث التلقائي الذكي كل 30 دقيقة من الجزيرة والمصادر الموثوقة (English Feeds)
        $lastSync = Cache::get('last_news_sync');
        $articlesCount = Article::count();
        $needsSync = false;

        if (!$lastSync || !is_numeric($lastSync) || (time() - (int)$lastSync) >= 1800 || $articlesCount === 0) {
            $needsSync = true;
        }

        if ($needsSync) {
            try {
                $newsService->fetchLatestNews();
                Cache::put('last_news_sync', time(), 21600); // 6 hours
            } catch (\Exception $e) {
                Log::warning('Auto news sync failed: ' . $e->getMessage());
            }
        }

        // 2. جلب الأخبار مع جعل أخبار الأطفال دائماً في الصدارة (Children & Trauma Priority First)
        $articles = Article::where('published_at', '<=', now())
                    ->whereNotNull('image_url')
                    ->where('image_url', '!=', '')
                    ->orderByRaw("
                        CASE 
                            WHEN LOWER(title) LIKE '%child%' 
                              OR LOWER(title) LIKE '%children%' 
                              OR LOWER(title) LIKE '%kid%' 
                              OR LOWER(title) LIKE '%kids%' 
                              OR LOWER(title) LIKE '%orphan%' 
                              OR LOWER(title) LIKE '%infant%' 
                              OR LOWER(title) LIKE '%baby%' 
                              OR LOWER(title) LIKE '%babies%' 
                              OR LOWER(title) LIKE '%girl%' 
                              OR LOWER(title) LIKE '%boy%' 
                              OR LOWER(title) LIKE '%pediatric%' 
                              OR LOWER(description) LIKE '%child%' 
                              OR LOWER(description) LIKE '%children%' 
                            THEN 4

                            WHEN LOWER(title) LIKE '%school%' 
                              OR LOWER(title) LIKE '%student%' 
                              OR LOWER(title) LIKE '%education%' 
                              OR LOWER(description) LIKE '%school%' 
                            THEN 3

                            WHEN LOWER(title) LIKE '%mental%' 
                              OR LOWER(title) LIKE '%psychol%' 
                              OR LOWER(title) LIKE '%trauma%' 
                              OR LOWER(description) LIKE '%mental health%' 
                            THEN 2

                            WHEN LOWER(title) LIKE '%aid%' 
                              OR LOWER(title) LIKE '%relief%' 
                              OR LOWER(title) LIKE '%unicef%' 
                              OR LOWER(title) LIKE '%unrwa%' 
                              OR LOWER(title) LIKE '%hospital%' 
                            THEN 1

                            ELSE 0
                        END DESC
                    ")
                    ->orderBy('published_at', 'desc')
                    ->simplePaginate(8);

        return view('frontend.news', compact('articles'));
    }
}