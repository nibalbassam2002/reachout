<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http; // مهم جداً لجلب البيانات
use App\Models\Article; // تأكد من إنشاء الموديل أولاً
use Carbon\Carbon;
use Illuminate\Support\Str;

class FetchGazaNews extends Command
{
    /**
     * الاسم الذي ستكتبه في التيرمينال لتشغيل الأمر
     */
    protected $signature = 'news:fetch';

    /**
     * وصف الأمر
     */
    protected $description = 'Fetch latest news about Gaza children from NewsAPI';

    /**
     * تنفيذ الأمر
     */
    public function handle()
    {
        $this->info('Starting to fetch news...');

        $apiKey = env('NEWS_API_KEY'); 
        
        $url = "https://newsapi.org/v2/everything";

        try {
            $response = Http::withoutVerifying()->get($url, [
                'q' => '"Gaza children" OR "Gaza orphans"',
                'language' => 'en',
                'sortBy' => 'publishedAt',
                'pageSize' => 20, // جلب 20 خبر فقط ليكون البحث أدق في البداية
                'apiKey' => $apiKey,
            ]);

            if ($response->successful()) {
                $articles = $response->json()['articles'];
                $count = 0;

                foreach ($articles as $item) {
                    // تجنب العناوين المحذوفة أو الفارغة
                    if ($item['title'] === '[Removed]' || empty($item['title'])) continue;

                    Article::updateOrCreate(
                        ['title' => $item['title']], // إذا وجد نفس العنوان لا يكرره
                        [
                            'description' => $item['description'] ?? 'No description available',
                            'url'         => $item['url'],
                            'image_url'   => $item['urlToImage'], // قد يكون نل (null)
                            'source'      => $item['source']['name'] ?? 'Unknown Source',
                            'published_at'=> Carbon::parse($item['publishedAt']),
                        ]
                    );
                    $count++;
                }

                $this->info("Successfully fetched {$count} articles.");
            } else {
                $this->error('Failed to fetch news. Check your API key or connection.');
            }
        } catch (\Exception $e) {
            $this->error('Error occurred: ' . $e->getMessage());
        }
    }
}