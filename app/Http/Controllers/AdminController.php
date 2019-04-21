<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actividad;
use App\Http\Requests\EditReportRequest;
class AdminController extends Controller {

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

	public function index(){

	}

	public function reports(){
		$user = $this->datUser;
		$actividades = DB::table('actividad')
			->join('cuenta', 'actividad.grupo', '=', 'cuenta.email')
			->select('cuenta.nombre', 'cuenta.email', 'actividad.id', 'actividad.titulo', 'actividad.fecha', 'actividad.created_at', 'actividad.descripcion', 'actividad.confirmada')
			->orderBy('actividad.id', 'DESC')
			->get();
		$num = DB::table('actividad')
			->count();
		$numApr = DB::table('actividad')
			->where('confirmada', 1)
			->count();
		return view('v2/admin/reports', compact('user','actividades', 'num', 'numApr'));
	}

	public function showReport($id){
		$user = $this->datUser;
		$reporte = DB::table('cuenta')
			->join('actividad', 'cuenta.email', '=', 'actividad.grupo')
			->select('cuenta.nombre', 'cuenta.email', 'actividad.id', 'actividad.titulo', 'actividad.fecha', 'actividad.created_at', 'actividad.descripcion', 'actividad.latitud', 'actividad.longitud', 'actividad.confirmada')
			->where('actividad.id', $id)
			->get();

		$fotos = DB::table('cuenta')
			->join('actividad', 'cuenta.email', '=', 'actividad.grupo')
			->join('foto', 'actividad.id', '=', 'foto.actividad')
			->select('foto.url')
			->where('actividad.id', $id)
			->get();


		return view('v2/admin/show-report', compact('user', 'reporte', 'fotos'));

}
	public function approveReport($id){
		$actividad = Actividad::find($id);
		$estado = $actividad['attributes']['confirmada'];
		$titulo = $actividad['attributes']['titulo'];

		if($estado == 0){
			$actividad->confirmada = 1;
			$actividad->save();
			return redirect("/admin/show-report/$id")->with('message', "El reporte $titulo fue aprobado exitosamente");
		}else{
			return redirect("/admin/show-report/$id")->with('message', 'Este reporte ya fue aprobado');
		}
//		dd($actividad);

	}

	public function desapproveReport($id){
		$actividad = Actividad::find($id);
		$estado = $actividad['attributes']['confirmada'];
		$titulo = $actividad['attributes']['titulo'];

		if($estado == 1){
			$actividad->confirmada = 0;
			$actividad->save();
			return redirect("/admin/show-report/$id")->with('message', "El reporte $titulo se ha desaprobado exitosamente");
		}else{
			return redirect("/admin/show-report/$id")->with('message', 'Este reporte ya fue desaprobado');
		}
//		dd($actividad);

	}

	public function deleteReport($id){
		$fotos = DB::table('foto')
			->where('actividad', $id)
			->select('url')
			->get();
		foreach($fotos as $foto){
			\Storage::delete("actividades/$foto->url");
		}

		DB::table('foto')
			->where('actividad', $id)
			->delete();

		$actividad = Actividad::find($id);
		$titulo = $actividad['attributes']['titulo'];
		$actividad->delete();
		return redirect("/admin/reports")->with('message', "Se elimino el reporte $titulo exitosamente");

	}

	public function editReport($id){
		$user = $this->datUser;
		$actividad = Actividad::find($id);
		$datos = $actividad['attributes'];
		return view('v2/admin/edit-report', compact('datos', 'user'));
	}

	public function updateReport(EditReportRequest $request){
		$id = $request['id'];

		$actividad = Actividad::find($id);
		$titulo = $actividad->titulo;
		$actividad->titulo = $request['titulo'];
		$actividad->fecha = $request['fecha'];
		$actividad->descripcion = $request['descripcion'];
		$actividad->latitud = $request['latitud'];
		$actividad->longitud = $request['longitud'];
		$actividad->save();

		return redirect("/admin/show-report/$id")->with('message', "Se actualizo el reporte $titulo exitosamente");
	}
}
