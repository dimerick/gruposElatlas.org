<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin {

	private $datUser;

	/**
	 * UserController constructor.
	 * @param $user
	 */
	public function __construct()
	{
		$user = Auth::user();
		$this->datUser = $user;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = $this->datUser;

		if($user['attributes']['tipo'] == 'user'){
			Auth::logout();
return redirect("/auth/login")->with('message', "Debes loguearte como administrador para acceder a esta seccion");
//return redirect("/admin/show-report/$id")->with('message', "Se actualizo el reporte $titulo exitosamente");
		}
		return $next($request);
	}

}
