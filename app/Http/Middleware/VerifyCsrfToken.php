<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'http://localhost:8000/users/add',
        'http://localhost:8000/users/update/5',
        'http://localhost:8000/users/5',
        'http://127.0.0.1:8000/clients/search',
        'http://127.0.0.1:8000/maintenance/1',
        'http://127.0.0.1:8000/brands',
        'http://127.0.0.1:8000/brands/99',
        'http://127.0.0.1:8000/brands/999',
        'http://127.0.0.1:8000/offer',
        'http://127.0.0.1:8000/offer/8',
        'http://127.0.0.1:8000/consultant',
        'http://127.0.0.1:8000/consultant/4',
        'http://127.0.0.1:8000/reviews/8',
        'http://127.0.0.1:8000/pricing',
        'http://127.0.0.1:8000/pricing/4',
        'http://127.0.0.1:8000/customer-service/reply/1',
        'http://127.0.0.1:8000/customer-service/1',
        'http://127.0.0.1:8000/technician',
        'http://127.0.0.1:8000/usingfloor',
        'http://127.0.0.1:8000/import',
        'http://127.0.0.1:8000/loadCalculation',
        'http://127.0.0.1:8000/usingFloors',
        'http://127.0.0.1:8000/dataSheet',
        'http://127.0.0.1:8000/search',
        'http://127.0.0.1:8000/main-dashboard/maintenance/1',
        'http://127.0.0.1:8000/main-dashboard/maintenance/assign/18',
        'http://127.0.0.1:8000/main-dashboard/reviews/search/LDW4',
        'http://127.0.0.1:8000/company-dashboard/technician/store/2',
        'http://127.0.0.1:8000/en/main-dashboard/notification'
    ];
}
