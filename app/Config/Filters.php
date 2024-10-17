<?php

namespace Config;

use App\Filters\PengajaranFilter;
use App\Filters\KerjasamaFilter;
use App\Filters\SuratKeputusanFilter;
use App\Filters\SuratTugasFilter;
use App\Filters\HakiFilter;
use App\Filters\KegiatanFilter;
use App\Filters\KepanitiaanFilter;
use App\Filters\LoginFilter;
use App\Filters\MahasiswaRecordFilter;
use App\Filters\PenelitianFilter;
use App\Filters\PengabdianFilter;
use App\Filters\SertifikatFilter;
use App\Filters\SurveyFilter;
use App\Filters\UserControlFilter;
use App\Filters\MediaFilter;
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
        'featPengajaran'    => PengajaranFilter::class,
        'featPenelitian'    => PenelitianFilter::class,
        'featPengabdian'    => PengabdianFilter::class,
        'featSertifikat'    => SertifikatFilter::class,
        'featHaki'          => HakiFilter::class,
        'featMahasiswa'     => MahasiswaRecordFilter::class,
        'featKerjasama'     => KerjasamaFilter::class,
        'featSK'            => SuratKeputusanFilter::class,
        'featST'            => SuratTugasFilter::class,
        'featKegiatan'      => KegiatanFilter::class,
        'featKepanitiaan'   => KepanitiaanFilter::class,
        'featSurvey'        => SurveyFilter::class,
        'featUserControl'   => UserControlFilter::class,
        'featMedia'         => MediaFilter::class,
        'taskforceOnly'     => TaskforceFilter::class,
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
