<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Article;
use Carbon\Carbon;

class FetchGazaNews extends Command
{
    protected $signature = 'news:fetch';
    protected $description = 'Fetch latest news about Gaza children from NewsAPI';

    public function handle()
    {
        $this->info('Starting to fetch news...');

        $apiKey = env('NEWS_API_KEY');
        $url = "https://newsapi.org/v2/everything";

        try {
            $response = Http::withoutVerifying()->get($url, [
                'q' => '"Gaza children"  OR "Gaza orphans" OR "children of Palestine" OR "Gaza families" OR "Palestinian children" OR "Palestine children" OR "Gaza mental health"',
                'language' => 'en',
                'sortBy'   => 'publishedAt',
                'pageSize' => 20,
                'apiKey'   => $apiKey,
            ]);

            if ($response->successful()) {
                $articles = $response->json()['articles'];
                $count = 0;

                $blockedKeywords = [
                    'israel', 'israeli', 'idf',
                    'hostage', 'bomb', 'rocket',
                    'netanyahu', 'trump', 'biden',
                    'michael jackson', 'election',
                ];

                foreach ($articles as $item) {
                    if ($item['title'] === '[Removed]' || empty($item['title'])) continue;

                    $titleLower = strtolower($item['title'] . ' ' . ($item['description'] ?? ''));
                    $blocked = false;
                    foreach ($blockedKeywords as $keyword) {
                        if (str_contains($titleLower, $keyword)) {
                            $blocked = true;
                            break;
                        }
                    }
                    if ($blocked) continue;

                    Article::updateOrCreate(
                        ['title' => $item['title']],
                        [
                            'description'  => $item['description'] ?? 'No description available',
                            'url'          => $item['url'],
                            'image_url'    => $item['urlToImage'],
                            'source'       => $item['source']['name'] ?? 'Unknown Source',
                            'published_at' => Carbon::parse($item['publishedAt']),
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