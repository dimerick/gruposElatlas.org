<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class EditGrupoRequest extends Request {

	private $datUser;

	/**
	 * UserController constructor.
	 * @param $user
	 */
	public function __construct()
	{
		$user = Auth::user();
		$this->datUser = $user['attributes'];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$user = $this->datUser;
		$email = $user['email'];
		$rule = "'required|unique:cuenta,email,".$user['email']."'";
//		dd($rule);
		return [
			'nombre' => 'required',
			'nom_repre' => 'required',
			'telefono' => 'required',
			//'email' => "required|unique:cuenta,email,$email,email",
			'ciudad' => 'required',
			'latitud' => 'required',
			'longitud' => 'required',
			'num_int' => 'required',
			'descripcion' => 'required',
//			'password' => 'confirmed|min:6',
		];
	}

}
