<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'api/*', // Menonaktifkan CSRF untuk semua API routes
        'update-scan-status', // Menonaktifkan CSRF untuk route tertentu
    ];
}

