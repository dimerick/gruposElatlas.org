<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	 
	/*rutas excluidas de Csrf token para pruebas proyecto angular*/
	
	protected $except = [
	'inventario/*'
	];
	
	public function handle($request, Closure $next)
	{
		return parent::handle($request, $next);
	}

}
