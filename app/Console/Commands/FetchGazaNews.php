<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsFeedService;

class FetchGazaNews extends Command
{
    protected $signature = 'news:fetch';
    protected $description = 'Fetch latest English news about Gaza and Palestine from Al Jazeera, Middle East Eye, and verified sources';

    public function handle(NewsFeedService $newsService)
    {
        $this->info('Starting to fetch live news from Al Jazeera and verified sources...');

        try {
            $count = $newsService->fetchLatestNews();
            $this->info("Successfully fetched and synced {$count} articles.");
        } catch (\Exception $e) {
            $this->error('Error occurred while fetching news: ' . $e->getMessage());
        }
    }
}