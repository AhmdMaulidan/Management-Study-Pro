<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    // ... (properti lain)

    /**
     * --------------------------------------------------------------------------
     * Pager Templates
     * --------------------------------------------------------------------------
     *
     * This file contains the templates that are used to display the pagination
     * links.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',

        // --- TAMBAHKAN BARIS INI ---
        'bootstrap_5_pagination' => 'App\Views\Pagers\bootstrap_5_pagination',
    ];

    /**
     * --------------------------------------------------------------------------
     * Items Per Page
     * --------------------------------------------------------------------------
     *
     * The default number of results shown in a single page.
     *
     * @var int
     */
    public int $perPage = 20;
}