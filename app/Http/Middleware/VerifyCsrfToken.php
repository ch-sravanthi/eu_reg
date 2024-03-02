<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/field_staff_report/sub_menu',
		'/project_partner_bill/create/{model_name}',
		'/project_partner_bill/save/{model_name}',
		'/project_partner_bill/sendAcknowledgment/{id}',
    ];
}
