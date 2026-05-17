<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // استخدمنا simplePaginate لعرض أزرار (التالي والسابق) فقط
        $articles = Article::where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc')
                    ->simplePaginate(7); 

        return view('frontend.news', compact('articles'));
    }
}