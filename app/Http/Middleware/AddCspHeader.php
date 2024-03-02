<?php

namespace App\Http\Middleware;

use Closure;

class AddCspHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
	{
		$response =  $next($request);

		$response->headers->set('Content-Security-Policy', 'default-src none');
		/*$response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'unsafe-inline'");
		$response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'unsafe-inline' fonts.googleapis.com; font-src fonts.googleapis.com fonts.gstatic.com");
		$response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'unsafe-inline' fonts.googleapis.com; font-src fonts.googleapis.com data: fonts.gstatic.com");
		$response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'unsafe-inline' fonts.googleapis.com; font-src fonts.googleapis.com data: fonts.gstatic.com; script-src 'self' https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");*/

		return $response;
	}
}
