<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,

        // Custom filters
        'auth'     => \App\Filters\AuthFilter::class,
        'guest'    => \App\Filters\GuestFilter::class,
        'admin'    => \App\Filters\AdminFilter::class,
        'customer' => \App\Filters\CustomerFilter::class,
    ];

    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
            // 'forcehttps',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        'guest' => [
            'before' => [
                'login',
                'register',
                'auth/login_process',
                'auth/register_process',
            ],
        ],

        'auth' => [
            'before' => [
                'logout',
                'dashboard',
                'dashboard/*',
                'admin',
                'admin/*',
                'order',
                'order/*',
                'my-orders',
            ],
        ],

        'admin' => [
            'before' => [
                'dashboard',
                'dashboard/*',
                'admin',
                'admin/*',
            ],
        ],

        'customer' => [
            'before' => [
                'order',
                'order/*',
                'my-orders',
            ],
        ],
    ];
}