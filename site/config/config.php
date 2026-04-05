<?php

/**
 * Kirby Configuration - Jettingen.fr
 * Small commune website configuration with French locale
 */

return [
    // Site basics
    'debug' => false, // Set to true for development
    'locale' => 'fr_FR',

    // Panel settings
    'panel' => [
        'language' => 'fr',
        'css' => '/assets/css/panel-custom.css',
    ],

    // User settings
    'users' => [
        'defaults' => [
            'language' => 'fr',
            'role' => 'editor',
        ],
    ],

    // Cache configuration
    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => [
                'error',
                'sitemap',
            ],
        ],
    ],

    // File settings
    'files' => [
        'maxSize' => 52428800, // 50 MB
    ],

    // Image handling
    'thumbs' => [
        'srcsets' => [
            'default' => [320, 768, 1024, 1280, 1920],
        ],
        'quality' => 80,
        'format' => 'webp',
        'autoOrient' => true,
    ],

    // Security
    'headers' => [
        'X-Frame-Options' => 'SAMEORIGIN',
        'X-Content-Type-Options' => 'nosniff',
        'X-XSS-Protection' => '1; mode=block',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
    ],

    // Markdown settings
    'markdown' => [
        'breaks' => true,
        'extra' => true,
    ],

    // Custom routes
    'routes' => [
        // Example custom route for RSS feed
        [
            'pattern' => 'feed.xml',
            'action' => function () {
                $articles = page('articles')->children()->listed();

                header('Content-Type: application/rss+xml; charset=utf-8');

                return view('feed', ['articles' => $articles]);
            },
        ],
    ],

    // Default field settings
    'fields' => [
        'text' => [
            'minlength' => 3,
        ],
    ],

    // Date formatting
    'date' => [
        'handler' => 'intl',
    ],

    // Load custom helpers on Kirby load
    'hooks' => [
        'kirby.load' => function ($kirby) {
            require __DIR__ . '/helpers.php';
        },
    ],

    // Plugins configuration
    'tobimori.seo' => [
        'canonical' => true,
        'sitemap' => true,
        'robots' => true,
        'jpegquality' => 80,
    ],

    'bnomei.uniform' => [
        'log' => true,
        'honeypot' => 'website',
    ],
];
