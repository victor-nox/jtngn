<?php

/**
 * Custom Helper Functions for Jettingen.fr
 */

if (!function_exists('excerpt')) {
    /**
     * Truncate text to specified length
     *
     * @param string $text Input text
     * @param int $length Max length
     * @param string $suffix Suffix for truncated text
     * @return string
     */
    function excerpt($text, $length = 150, $suffix = '…')
    {
        if (empty($text)) {
            return '';
        }

        // Remove HTML tags
        $text = strip_tags($text);

        // Remove extra whitespace
        $text = preg_replace('/\s+/', ' ', trim($text));

        if (strlen($text) <= $length) {
            return $text;
        }

        return substr($text, 0, $length) . $suffix;
    }
}

if (!function_exists('icon')) {
    /**
     * Return an icon emoji or character
     *
     * @param string $name Icon name
     * @return string
     */
    function icon($name)
    {
        $icons = [
            'document' => '📄',
            'calendar' => '📅',
            'users' => '👥',
            'home' => '🏠',
            'info' => 'ℹ️',
            'phone' => '☎️',
            'email' => '✉️',
            'location' => '📍',
            'clock' => '🕐',
            'link' => '🔗',
            'external' => '↗️',
            'arrow-right' => '→',
            'arrow-left' => '←',
            'success' => '✓',
            'error' => '✕',
            'search' => '🔍',
            'menu' => '☰',
            'close' => '✕',
        ];

        return $icons[$name] ?? '🔗';
    }
}

if (!function_exists('formatDate')) {
    /**
     * Format a date in French
     *
     * @param mixed $date Date string or object
     * @param string $format Format (e.g., 'd F Y')
     * @return string
     */
    function formatDate($date, $format = 'd F Y')
    {
        if (empty($date)) {
            return '';
        }

        try {
            $timestamp = strtotime((string) $date);
            if (!$timestamp) {
                return (string) $date;
            }

            return strftime($format, $timestamp);
        } catch (Exception $e) {
            return (string) $date;
        }
    }
}

if (!function_exists('readingTime')) {
    /**
     * Calculate reading time for an article
     *
     * @param string $text Text content
     * @param int $wordsPerMinute Average words per minute
     * @return int
     */
    function readingTime($text, $wordsPerMinute = 200)
    {
        $text = strip_tags($text);
        $wordCount = str_word_count($text);

        return (int) ceil($wordCount / $wordsPerMinute);
    }
}

if (!function_exists('categoryBadge')) {
    /**
     * Get a readable label and color for article categories
     *
     * @param string $category Category slug
     * @return array
     */
    function categoryBadge($category)
    {
        $badges = [
            'mairie' => [
                'label' => 'Mairie',
                'color' => '#5B7F3B',
            ],
            'travaux' => [
                'label' => 'Travaux',
                'color' => '#F39C12',
            ],
            'vie-locale' => [
                'label' => 'Vie locale',
                'color' => '#3498DB',
            ],
            'ecole' => [
                'label' => 'École',
                'color' => '#8B6F47',
            ],
            'environnement' => [
                'label' => 'Environnement',
                'color' => '#27AE60',
            ],
        ];

        return $badges[$category] ?? [
            'label' => ucfirst($category),
            'color' => '#2C2C2C',
        ];
    }
}

if (!function_exists('getPageNav')) {
    /**
     * Get previous and next pages in a collection
     *
     * @param Kirby\Cms\Page $page Current page
     * @param Kirby\Cms\Pages $pages Collection of pages
     * @param string $orderBy Order field
     * @param string $direction 'asc' or 'desc'
     * @return array
     */
    function getPageNav($page, $pages, $orderBy = 'date', $direction = 'desc')
    {
        $ordered = $pages->sortBy($orderBy, $direction);
        $current = $ordered->findBy('id', $page->id());

        if (!$current) {
            return ['prev' => null, 'next' => null];
        }

        $position = $ordered->indexOf($current);

        return [
            'prev' => $position > 0 ? $ordered->nth($position - 1) : null,
            'next' => $position < $ordered->count() - 1 ? $ordered->nth($position + 1) : null,
        ];
    }
}

if (!function_exists('socialURL')) {
    /**
     * Generate URL for social media links with proper parameters
     *
     * @param string $platform Social platform name
     * @param string $handle User handle/ID
     * @return string
     */
    function socialURL($platform, $handle)
    {
        $urls = [
            'facebook' => 'https://facebook.com/{handle}',
            'twitter' => 'https://twitter.com/{handle}',
            'instagram' => 'https://instagram.com/{handle}',
            'linkedin' => 'https://linkedin.com/company/{handle}',
            'youtube' => 'https://youtube.com/@{handle}',
            'mastodon' => 'https://mastodon.social/{handle}',
        ];

        if (!isset($urls[$platform])) {
            return '';
        }

        return str_replace('{handle}', urlencode($handle), $urls[$platform]);
    }
}

if (!function_exists('breadcrumbs')) {
    /**
     * Generate breadcrumb trail for a page
     *
     * @param Kirby\Cms\Page $page Current page
     * @return array
     */
    function breadcrumbs($page)
    {
        $crumbs = [
            [
                'title' => 'Accueil',
                'url' => site()->url(),
            ],
        ];

        foreach ($page->parents()->flip() as $parent) {
            if ($parent->depth() > 0) {
                $crumbs[] = [
                    'title' => $parent->title(),
                    'url' => $parent->url(),
                ];
            }
        }

        $crumbs[] = [
            'title' => $page->title(),
            'url' => $page->url(),
            'current' => true,
        ];

        return $crumbs;
    }
}

if (!function_exists('isActive')) {
    /**
     * Check if a page is active/current
     *
     * @param Kirby\Cms\Page $page Page to check
     * @param Kirby\Cms\Page $current Current page
     * @return bool
     */
    function isActive($page, $current = null)
    {
        $current = $current ?? page();

        return $page->id() === $current->id();
    }
}

if (!function_exists('niceSize')) {
    /**
     * Convert bytes to human-readable format
     *
     * @param int $bytes Bytes
     * @return string
     */
    function niceSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}

if (!function_exists('randomArticles')) {
    /**
     * Get random articles (for "read also" sections)
     *
     * @param int $limit Number of articles to return
     * @param Kirby\Cms\Page $exclude Page to exclude
     * @return Kirby\Cms\Pages
     */
    function randomArticles($limit = 3, $exclude = null)
    {
        $articles = page('articles')?->children()->listed();

        if (!$articles || $articles->count() === 0) {
            return site()->children();
        }

        if ($exclude) {
            $articles = $articles->filterBy('id', '!=', $exclude->id());
        }

        // Simple shuffle
        $array = $articles->toArray();
        shuffle($array);

        return new \Kirby\Cms\Pages($array);
    }
}
