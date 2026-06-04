<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // 1. جلب الأخبار مرتبة حسب التاريخ
        $articles = Article::where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc')
                    ->simplePaginate(7); 

        // 2. إعادة ترتيب الأخبار في الصفحة لتعطي الأولوية القصوى لأطفال غزة وقضاياهم
        $articles->setCollection(
            $articles->getCollection()->sortByDesc(function ($article) {
                $titleLower = strtolower($article->title);
                
                // الكلمات المفتاحية لأطفال غزة وقضاياهم المهمشة لرفعها أول الصفحة
                if (
                    str_contains($titleLower, 'gaza children') || 
                    str_contains($titleLower, 'palestinian children') || 
                    str_contains($titleLower, 'gaza orphans') || 
                    str_contains($titleLower, 'mental health')
                ) {
                    return 1; // أعلى أولوية (تظهر في أول الصفحة فوق)
                }
                
                return 0; // الأخبار الأخرى تظهر تالياً
            })
        );

        return view('frontend.news', compact('articles'));
    }
}