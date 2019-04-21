<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class EmailConfirmed {
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
		$email = $user['attributes']['email'];
		if($user['attributes']['confirmada'] == 0){
			Auth::logout();
			$user = null;
			return view('v2/activate_solic', compact('email', 'user'));
		}
		return $next($request);
	}

}
