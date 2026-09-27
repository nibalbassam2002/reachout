<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NewsFeedService
{
    /**
     * Fetch latest news directly from Al Jazeera English, Middle East Eye, BBC Middle East, and UN/UNICEF.
     * All articles are English with 100% authentic field photography from the original news sites (No Google logos).
     *
     * @return int Number of articles fetched and saved.
     */
    public function fetchLatestNews(): int
    {
        $articles = [];

        // 1. Al Jazeera English Official RSS (Field photojournalism from Gaza)
        $this->fetchAlJazeera($articles);

        // 2. Middle East Eye Official RSS (Field reporting from Palestine)
        $this->fetchMiddleEastEye($articles);

        // 3. BBC World Middle East RSS (Palestine & Gaza filtered)
        $this->fetchBbcMiddleEast($articles);

        // 4. UN News & UNICEF Palestine Humanitarian & Children Feed
        $this->fetchUnHumanitarian($articles);

        $savedCount = 0;
        foreach ($articles as $item) {
            if (empty($item['title']) || empty($item['url'])) {
                continue;
            }

            // Strictly require an authentic news image from the original agency
            if (empty($item['image_url']) || $this->isBlockedImage($item['image_url'])) {
                continue;
            }

            try {
                Article::updateOrCreate(
                    ['url' => $item['url']],
                    [
                        'title'        => $item['title'],
                        'description'  => $item['description'] ?? 'No description available.',
                        'image_url'    => $item['image_url'],
                        'source'       => $item['source'] ?? 'Al Jazeera English',
                        'published_at' => $item['published_at'] ?? now(),
                    ]
                );
                $savedCount++;
            } catch (\Exception $e) {
                Log::warning('Failed to save article: ' . $e->getMessage());
            }
        }

        return $savedCount;
    }

    /**
     * 1. Al Jazeera English Official RSS
     */
    protected function fetchAlJazeera(array &$articles): void
    {
        $url = 'https://www.aljazeera.com/xml/rss/all.xml';
        $xmlContent = $this->fetchUrl($url);

        if (!$xmlContent) return;

        $xml = @simplexml_load_string($xmlContent);
        if (!$xml || !isset($xml->channel->item)) return;

        $keywords = [
            'gaza', 'palestin', 'west bank', 'rafah', 'khan younis', 
            'unrwa', 'ceasefire', 'aid', 'hospital', 'children', 'child',
            'mental health', 'psychological', 'crisis', 'displacement', 'school'
        ];

        $count = 0;
        foreach ($xml->channel->item as $item) {
            $title = (string)$item->title;
            $desc = strip_tags((string)$item->description);
            $link = (string)$item->link;
            $haystack = strtolower($title . ' ' . $desc);

            $isRelevant = false;
            foreach ($keywords as $kw) {
                if (str_contains($haystack, $kw)) {
                    $isRelevant = true;
                    break;
                }
            }

            if (!$isRelevant) continue;

            // Extract original image directly from Al Jazeera article page
            $imageUrl = $this->extractArticleImage($link);
            if (!$imageUrl || $this->isBlockedImage($imageUrl)) continue;

            $articles[$link] = [
                'title'        => html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'description'  => html_entity_decode($desc, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'url'          => $link,
                'image_url'    => $imageUrl,
                'source'       => 'Al Jazeera English',
                'published_at' => !empty($item->pubDate) ? Carbon::parse((string)$item->pubDate) : now(),
            ];

            $count++;
            if ($count >= 10) break;
        }
    }

    /**
     * 2. Middle East Eye Official RSS
     */
    protected function fetchMiddleEastEye(array &$articles): void
    {
        $url = 'https://www.middleeasteye.net/rss';
        $xmlContent = $this->fetchUrl($url);

        if (!$xmlContent) return;

        $xml = @simplexml_load_string($xmlContent);
        if (!$xml || !isset($xml->channel->item)) return;

        $keywords = ['gaza', 'palestin', 'west bank', 'child', 'children', 'rafah', 'hospital', 'unrwa', 'aid', 'settler'];

        $count = 0;
        foreach ($xml->channel->item as $item) {
            $title = (string)$item->title;
            $rawDesc = (string)$item->description;
            $link = (string)$item->link;
            $haystack = strtolower($title . ' ' . $rawDesc);

            $isRelevant = false;
            foreach ($keywords as $kw) {
                if (str_contains($haystack, $kw)) {
                    $isRelevant = true;
                    break;
                }
            }

            if (!$isRelevant) continue;

            // Extract image from description HTML
            $imageUrl = null;
            if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $rawDesc, $m)) {
                $imageUrl = $m[1];
            }

            // Fallback to og:image from the MEE article page
            if (!$imageUrl || $this->isBlockedImage($imageUrl)) {
                $imageUrl = $this->extractArticleImage($link);
            }

            if (!$imageUrl || $this->isBlockedImage($imageUrl)) {
                continue;
            }

            $cleanDesc = strip_tags($rawDesc);
            $cleanDesc = preg_replace('/\s+/', ' ', $cleanDesc);
            $cleanDesc = trim(substr($cleanDesc, 0, 220));

            $articles[$link] = [
                'title'        => html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'description'  => html_entity_decode($cleanDesc, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'url'          => $link,
                'image_url'    => $imageUrl,
                'source'       => 'Middle East Eye',
                'published_at' => !empty($item->pubDate) ? Carbon::parse((string)$item->pubDate) : now(),
            ];

            $count++;
            if ($count >= 8) break;
        }
    }

    /**
     * 3. BBC World Middle East RSS (Palestine & Gaza Filtered)
     */
    protected function fetchBbcMiddleEast(array &$articles): void
    {
        $url = 'https://feeds.bbci.co.uk/news/world/middle_east/rss.xml';
        $xmlContent = $this->fetchUrl($url);

        if (!$xmlContent) return;

        $xml = @simplexml_load_string($xmlContent);
        if (!$xml || !isset($xml->channel->item)) return;

        $keywords = ['gaza', 'palestin', 'west bank', 'child', 'children', 'rafah', 'israel', 'unrwa', 'hospital'];

        $count = 0;
        foreach ($xml->channel->item as $item) {
            $title = (string)$item->title;
            $desc = strip_tags((string)$item->description);
            $link = (string)$item->link;
            $haystack = strtolower($title . ' ' . $desc);

            $isRelevant = false;
            foreach ($keywords as $kw) {
                if (str_contains($haystack, $kw)) {
                    $isRelevant = true;
                    break;
                }
            }

            if (!$isRelevant) continue;

            $imageUrl = null;
            $namespaces = $item->getNamespaces(true);
            if (isset($namespaces['media'])) {
                $media = $item->children($namespaces['media']);
                if (isset($media->thumbnail)) {
                    $imageUrl = (string)$media->thumbnail->attributes()['url'];
                    // Upgrade BBC thumbnail from 240px to 976px high resolution
                    $imageUrl = str_replace('/240/', '/976/', $imageUrl);
                } elseif (isset($media->content)) {
                    $imageUrl = (string)$media->content->attributes()['url'];
                }
            }

            if (!$imageUrl) {
                $imageUrl = $this->extractArticleImage($link);
            }

            if (!$imageUrl || $this->isBlockedImage($imageUrl)) continue;

            $articles[$link] = [
                'title'        => html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'description'  => html_entity_decode($desc, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'url'          => $link,
                'image_url'    => $imageUrl,
                'source'       => 'BBC News',
                'published_at' => !empty($item->pubDate) ? Carbon::parse((string)$item->pubDate) : now(),
            ];

            $count++;
            if ($count >= 8) break;
        }
    }

    /**
     * 4. UN News & UNICEF Humanitarian News Feed (Palestine & Gaza Filtered)
     */
    protected function fetchUnHumanitarian(array &$articles): void
    {
        $url = 'https://news.un.org/feed/subscribe/en/news/topic/humanitarian-aid/feed/rss.xml';
        $xmlContent = $this->fetchUrl($url);

        if (!$xmlContent) return;

        $xml = @simplexml_load_string($xmlContent);
        if (!$xml || !isset($xml->channel->item)) return;

        $keywords = ['gaza', 'palestin', 'west bank', 'rafah', 'unrwa'];

        $count = 0;
        foreach ($xml->channel->item as $item) {
            $title = (string)$item->title;
            $desc = strip_tags((string)$item->description);
            $link = (string)$item->link;
            $haystack = strtolower($title . ' ' . $desc);

            $isPalestine = false;
            foreach ($keywords as $kw) {
                if (str_contains($haystack, $kw)) {
                    $isPalestine = true;
                    break;
                }
            }

            if (!$isPalestine) continue;

            $imageUrl = null;
            if (isset($item->enclosure) && !empty($item->enclosure['url'])) {
                $imageUrl = (string)$item->enclosure['url'];
            }

            if (!$imageUrl) {
                $imageUrl = $this->extractArticleImage($link);
            }

            if (!$imageUrl || $this->isBlockedImage($imageUrl)) continue;

            $articles[$link] = [
                'title'        => html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'description'  => html_entity_decode($desc, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'url'          => $link,
                'image_url'    => $imageUrl,
                'source'       => 'UN News / Humanitarian',
                'published_at' => !empty($item->pubDate) ? Carbon::parse((string)$item->pubDate) : now(),
            ];

            $count++;
            if ($count >= 5) break;
        }
    }

    /**
     * Block Google News logos and generic website placeholders
     */
    protected function isBlockedImage(string $url): bool
    {
        $blockedPatterns = [
            'googleusercontent.com',
            'google.com/logos',
            'J6_coFbog',
            'People%20walk%20past',
            'default-logo',
            'placeholder'
        ];

        foreach ($blockedPatterns as $pattern) {
            if (str_contains($url, $pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Extract the authentic og:image or high-resolution thumbnail from the article webpage.
     */
    protected function extractArticleImage(string $url): ?string
    {
        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            // Fetch first 40KB to capture <meta> tags in <head>
            curl_setopt($ch, CURLOPT_RANGE, '0-40000');
            $html = curl_exec($ch);
            curl_close($ch);

            if ($html) {
                if (preg_match('/<meta[^>]*property=["\']og:image(?::url)?["\'][^>]*content=["\']([^"\']+)["\']/i', $html, $m)) {
                    $img = $m[1];
                    if (!$this->isBlockedImage($img)) {
                        return $img;
                    }
                }

                if (preg_match('/<meta[^>]*name=["\'](?:twitter:image|image)["\'][^>]*content=["\']([^"\']+)["\']/i', $html, $m)) {
                    $img = $m[1];
                    if (!$this->isBlockedImage($img)) {
                        return $img;
                    }
                }
            }
        } catch (\Exception $e) {
            // Safe fallback
        }

        return null;
    }

    /**
     * Safe cURL helper
     */
    protected function fetchUrl(string $url): ?string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        $data = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($statusCode === 200 && !empty($data)) {
            return $data;
        }

        return null;
    }
}
