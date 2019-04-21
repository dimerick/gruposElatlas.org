<?php namespace App\Http\Controllers;

use \Eventviva\ImageResize;
use App\Actividad;
use App\Foto;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditReportRequest;
use Symfony\Component\HttpKernel\Tests\DataCollector\DumpDataCollectorTest;

class UserController extends Controller {
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{

		return view('user/upload_activity', compact('user'));
		//
	}

	public function uploadActivity(){
		$user = $this->datUser;
		$categorias = \DB::table('categoria')
			->select('id', 'nombre')
			->orderBy('id', 'ASC')
			->get();
		$tipos_act = \DB::table('tipo_actividad')
			->select('id', 'nombre')
			->orderBy('id', 'ASC')
			->get();
		return view('v2/upload_activity', compact('user', 'categorias', 'tipos_act'));

	}


	public function uploadActivityPost(Request $request){
		$user = $this->datUser;
		$email = $user['email'];
		$titulo = $request->get('titulo');
		$fecha = $request->get('fecha');
		$descripcion = $request->get('descripcion');
		$latitud = $request->get('latitud');
		$longitud = $request->get('longitud');
		$categoria = $request->get('categoria');
		$tipo = $request->get('tipo');

		$search = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", " ");
		$replace = array("a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "-");
		$search1 = array(":", " ");
		$replace1 = array("-", "_");
		$nomMod = str_replace($search, $replace, $titulo);


		$activity = Actividad::create([
			'grupo' => $email,
			'tipo' => $tipo,
			'titulo' => $titulo,
			'fecha' => $fecha,
			'descripcion' => $descripcion,
			'categoria' => $categoria,
			'latitud' => $latitud,
			'longitud' => $longitud,
			'confirmada' => 1
		]);
		if($activity){
			return view('v2/successful-activity-register', compact('user', 'activity'));
		}else{
			echo "Error al registrar la actividad";
		}
	}

	public function uploadPhotos($id){
		$user = $this->datUser;
		$actividad = Actividad::find($id);
		$datos = $actividad['attributes'];

		if($user['email'] == $datos['grupo']){
			return view('v2/upload-photos', compact('user', 'datos'));
		}else{
			return redirect("/v2/publications/$id")->with('message', "No tienes permiso para editar este reporte");
		}

	}

	public function publications(){
		$user = $this->datUser;
		$cuentas = DB::table('cuenta')
			->select('nombre', 'email')
			->get();
		$actividades = DB::table('actividad')
			->join('categoria', 'actividad.categoria', '=', 'categoria.id')
			->select('actividad.id', 'actividad.grupo', 'actividad.titulo', 'actividad.fecha', 'actividad.created_at', 'actividad.descripcion', 'actividad.latitud', 'actividad.longitud', 'actividad.confirmada', 'categoria.nombre as nomCat', 'categoria.icon')
			->where('actividad.confirmada', 1)
			->orderBy('actividad.id', 'DESC')
			->get();
		$fotos = DB::table('foto')
			->orderBy('actividad', 'DESC')
			->get();
		$newFotos = array();
		$actAnt = null;
		$num = 0;
		foreach ($fotos as $foto){
if($actAnt == null){
	$actAnt = $foto->actividad;
}
			if($actAnt == $foto->actividad){
				if($num < 2){
					$newFotos[] = $foto;
				}

			}else{
				$num=0;
				$actAnt = $foto->actividad;
				$newFotos[] = $foto;
			}
			$num++;
		}
		$fotos = $newFotos;
		return view('v2/publications', compact('user', 'actividades', 'fotos', 'cuentas'));
	}

	public function showPost($id){
	$user = $this->datUser;
	$datos = DB::table('cuenta')
			->join('actividad', 'cuenta.email', '=', 'actividad.grupo')
			->join('categoria', 'actividad.categoria', '=', 'categoria.id')
			->select('cuenta.nombre', 'cuenta.email', 'actividad.titulo', 'actividad.fecha', 'actividad.created_at', 'actividad.descripcion', 'actividad.latitud', 'actividad.longitud', 'actividad.confirmada', 'categoria.nombre as nomCat', 'categoria.icon')
			->where('actividad.id', $id)
			->get();
//		dd($datos);
		$descripcion = nl2br(htmlentities($datos[0]->descripcion));
	$fotos = DB::table('foto')
			->select('url')
			->where('actividad', $id)
			->get();

		if($datos[0]->confirmada == 0){
			if($user['email'] == $datos[0]->email){
				return view('v2/show-post', compact('user', 'descripcion', 'datos', 'fotos'));
			}else{
				return redirect()->back()->with('message', "No tienes permiso para visualizar este reporte");
			}
		}else{
			return view('v2/show-post', compact('user', 'descripcion', 'datos', 'fotos'));
		}

	}

	public function uploadCoordinates($id){
		$user = $this->datUser;
		$datos = DB::table('actividad')
			->select('id', 'grupo', 'titulo')
			->where('id', $id)
			->get();
		if(count($datos) > 0){
			if($datos[0]->grupo == $user['email']){
				return view('v2/upload-coordinates', compact('user', 'datos'));
			}else{
				return redirect()->back()->with('message', "No tienes permiso para agregar coordenadas a este recorrido");
			}
		}else{
			return redirect()->back()->with('message', "El recorrido no es valido");
		}
	}

	public function uploadCoordinatesPost($data){
		$item = explode(';', $data);
		if(count($item) == 3){
			$id = $item[0];
			$lat = $item[1];
			$long = $item[2];
			$success = DB::table('coordenada')->insert(
				['actividad' => $id, 'latitud' => $lat, 'longitud' => $long]
			);
			if($success){
				return response()->json(['success' => true, 'lat' => $lat, 'long' => $long]);
			}else{
				return response()->json(['success' => false, 'lat' => $lat, 'long' => $long]);
			}

		}

	}

	public function showAutor($id){
		$user = $this->datUser;
		$cuenta = DB::table('cuenta')
			->select('nombre', 'email', 'ciudad', 'latitud', 'longitud', 'num_int', 'descripcion', 'foto')
			->where('email', $id)
			->get();
		$descripcion = nl2br(htmlentities($cuenta[0]->descripcion));
		$actividades = DB::table('actividad')
			->join('categoria', 'actividad.categoria', '=', 'categoria.id')
			->where('actividad.grupo', $id)
			->where('confirmada', 1)
			->select('actividad.id', 'titulo', 'fecha', 'descripcion', 'latitud', 'longitud', 'categoria.nombre as nomCat', 'categoria.icon')
			->orderBy('id', 'DESC')
			->get();
		$fotos = DB::table('cuenta')
			->where('cuenta.email', $id)
			->where('actividad.confirmada', 1)
			->join('actividad', 'cuenta.email', '=', 'actividad.grupo')
			->join('foto', 'actividad.id', '=', 'foto.actividad')
			->select('foto.actividad', 'foto.url')
			->orderBy('foto.actividad', 'DESC')
			->get();
		$categorias = DB::table('grupoxcategoria')
			->where('grupoxcategoria.grupo', $id)
			->join('categoria', 'grupoxcategoria.categoria', '=', 'categoria.id')
			->select('categoria.nombre', 'categoria.icon')
			->orderBy('grupoxcategoria.tipo', 'ASC')
			->get();
		return view('v2/show-autor', compact('user', 'descripcion', 'cuenta', 'actividades', 'categorias', 'fotos'));
	}

	public function search(Request $request){
		$cadena = $request->inputSearch;
		$user = $this->datUser;
		$grupos = DB::table('cuenta')
			->select('nombre', 'email', 'ciudad', 'num_int', 'descripcion', 'foto')
			->where('nombre', 'LIKE', "%$cadena%")
			->orwhere('descripcion', 'LIKE', "%$cadena%")
			->where('confirmada', 1)
			->orderBy('nombre', 'ASC')
			->get();

		$actividades = DB::table('actividad')
			->join('cuenta', 'actividad.grupo', '=', 'cuenta.email')
			->where('actividad.confirmada', 1)
			->where('actividad.titulo', 'LIKE', "%$cadena%")
			->orwhere('actividad.descripcion', 'LIKE', "%$cadena%")
			->select('cuenta.nombre', 'cuenta.email', 'actividad.id', 'actividad.titulo', 'actividad.fecha', 'actividad.descripcion')
			->orderBy('id', 'DESC')
			->get();

		$fotos = DB::table('actividad')
			->join('foto', 'actividad.id', '=', 'foto.actividad')
			->where('actividad.titulo', 'LIKE', "%$cadena%")
			->orwhere('actividad.descripcion', 'LIKE', "%$cadena%")
			->where('actividad.confirmada', 1)
			->select('foto.actividad', 'foto.url')
			->get();

		return view('v2/search', compact('cadena', 'user', 'grupos', 'actividades', 'fotos'));
	}

	public function searchPost(Request $request){
		$cadena = $request->post;
		$user = $this->datUser;
		return view('user/result-post', compact('cadena', 'user', 'actividades', 'fotos'));

	}

	public function myPublications(){
		$user = $this->datUser;
		$email = $user['email'];
		$actividades = DB::table('actividad')
			->where('grupo', $email)
			->select('id', 'tipo', 'titulo', 'fecha', 'created_at', 'descripcion', 'confirmada')
			->orderBy('id', 'DESC')
			->get();
		$num = count($actividades);
		return view('v2/my-publications', compact('user', 'num', 'actividades'));
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
		return redirect("/user/my-publications")->with('message', "Se elimino el reporte $titulo exitosamente");

	}

	public function editReport($id){
		$user = $this->datUser;
		$actividad = Actividad::find($id);
		$categorias = \DB::table('categoria')
			->orderBy('id', 'ASC')
			->get();
		$datos = $actividad['attributes'];
		return view('v2/edit-report', compact('datos', 'categorias', 'user'));
	}

	public function updateReport(EditReportRequest $request){
		$id = $request['id'];

		$actividad = Actividad::find($id);
		$titulo = $actividad->titulo;
		$actividad->titulo = $request['titulo'];
		$actividad->fecha = $request['fecha'];
		$actividad->categoria = $request['categoria'];
		$actividad->descripcion = $request['descripcion'];
		$actividad->latitud = $request['latitud'];
		$actividad->longitud = $request['longitud'];
		$actividad->save();

		return redirect("/user/my-publications")->with('success', "Se actualizo el reporte exitosamente");
	}

	public function editPhotoProfile(){
		$user = $this->datUser;
		if($user != null){
			return view('v2/edit-photo-profile', compact('user'));
		}else{
			return view('auth.login', compact('user'));
		}
		
	}

	public function getPhotoProfile(){
		$user = $this->datUser;
		$foto = $user['foto_peq'];
		return $foto;
	}
	
}
