<?php

namespace Config;

use App\Controllers\Back\Pengajaran;
use App\Filters\AlumniFilter;
use App\Filters\DekanFilter;
use App\Filters\PengajaranFilter;
use App\Filters\KerjasamaFilter;
use App\Filters\KegiatanFilter;
use App\Filters\KepanitiaanFilter;
use App\Filters\KetuaJurusanFilter;
use App\Filters\KoorFilter;
use App\Filters\LoginFilter;
use App\Filters\MahasiswaFilter;
use App\Filters\PenelitianFilter;
use App\Filters\TaskforceFilter;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, array<int, string>|string> [filter_name => classname]
     *                                               or [filter_name => [classname1, classname2, ...]]
     * @phpstan-var array<string, class-string|list<class-string>>
     */
    public array $aliases = [
        'isLoggedIn'    => LoginFilter::class,
        'isDekan'           => DekanFilter::class,
        'isKajur'           => KetuaJurusanFilter::class,
        'isKoor'            => KoorFilter::class,
        'isTaskforce'       => TaskforceFilter::class,
        'featPengajaran'    => PengajaranFilter::class,
        'featPenelitian'    => PenelitianFilter::class,
        'isMahasiswa'       => MahasiswaFilter::class,
        'isAlumni'          => AlumniFilter::class,
        'featKerjasama'     => KerjasamaFilter::class,
        'featKegiatan'      => KegiatanFilter::class,
        'featKepanitiaan'   => KepanitiaanFilter::class,
        'csrf'              => CSRF::class,
        'toolbar'           => DebugToolbar::class,
        'honeypot'          => Honeypot::class,
        'invalidchars'      => InvalidChars::class,
        'secureheaders'     => SecureHeaders::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, array<string>>
     * @phpstan-var array<string, list<string>>|array<string, array<string, array<string, string>>>
     */
    public array $globals = [
        'before' => [
            // 'isDekan'=>['except' => ['kerjasama  ']],
            // 'honeypot',
            'csrf',
            // 'invalidchars',
        ],
        'after' => [
            // 'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}
