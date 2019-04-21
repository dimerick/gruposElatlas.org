<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Actividad;
use App\Http\Requests\EditReportRequest;
class LegionController extends Controller {

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
		return view('mobirirse/form_search', compact('user'));
	}

	public function searchDoc($keyWord){
		$keyWord2 = "%".$keyWord."%";
		$docs = \DB::table('documento')
			->join('tipo', 'documento.tipo', '=', 'tipo.id')
			->select('documento.id', 'documento.titulo', 'documento.fecha', 'documento.autor', 'tipo.nombre as tipo', 'documento.texto')
			->where('documento.texto', 'LIKE', $keyWord2)
			->orderBy('documento.fecha', 'DESC')
			->paginate(10);

		$search = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú");
		$replace = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");

		$searchSpecial = array("Legion del Afecto");
		$replaceSpecial = array("Legion Del Afecto");

		$keyWordSinAcento = str_replace($search, $replace, $keyWord);
		$keyWordMinus = strtolower($keyWordSinAcento);
		$keyWordMayus = strtoupper($keyWordSinAcento);
		$keyWordMayusFirstLetterAll = ucwords($keyWordSinAcento);
		$keyWordMayusFirstLetter = ucfirst($keyWordSinAcento);


		foreach ($docs as $doc){
			$textSinAcento = str_replace($search, $replace, $doc->texto);
			$textSinAcento = str_replace($searchSpecial, $replaceSpecial, $textSinAcento);
			$textMinus = strtolower($textSinAcento);
			$oracionesMinus = explode(".", $textMinus);
			$oracionesNormal = explode(".", $textSinAcento);

			$validas = array();


			for($i=0;$i < count($oracionesMinus);$i++){
				if(substr_count($oracionesMinus[$i], $keyWordMinus) > 0){
					$validas[] = $oracionesNormal[$i];
				}
			}

			for($i=0;$i < count($validas);$i++){
				if(substr_count($validas[$i], $keyWordMinus) > 0){
					$keyReplace = "<span class=\"key-word\">".$keyWordMinus."</span>";
					$validas[$i] = str_replace($keyWordMinus, $keyReplace, $validas[$i]);
				}
				if(substr_count($validas[$i], $keyWordMayus) > 0){
					$keyReplace = "<span class='key-word'>$keyWordMayus</span>";
					$validas[$i] = str_replace($keyWordMayus, $keyReplace, $validas[$i]);
				}
				if(substr_count($validas[$i], $keyWordMayusFirstLetter) > 0){
					$keyReplace = "<span class='key-word'>$keyWordMayusFirstLetter</span>";
					$validas[$i] = str_replace($keyWordMayusFirstLetter, $keyReplace, $validas[$i]);
				}
				if(substr_count($validas[$i], $keyWordMayusFirstLetterAll) > 0){
					$keyReplace = "<span class='key-word'>$keyWordMayusFirstLetterAll</span>";
					$validas[$i] = str_replace($keyWordMayusFirstLetterAll, $keyReplace, $validas[$i]);
				}
			}


$newText = implode(".", $validas);
			$newText = nl2br($newText, false);
			$doc->texto = $newText;
		}

			return view('mobirirse/result-search', compact('docs','keyWord'));

	}

	public function getDoc($string){
		$url = explode("&", $string);
		$s1 = explode("=", $url[0]);
		$s2 = explode("=", $url[1]);
		$id=$s1[1];
		$keyWord = $s2[1];
				
		$docs = \DB::table('documento')
			->join('tipo', 'documento.tipo', '=', 'tipo.id')
			->select('documento.id', 'documento.titulo', 'documento.fecha', 'documento.autor', 'tipo.nombre as tipo', 'documento.texto')
			->where('documento.id', $id)
			->get();

		$search = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú");
		$replace = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");

		$searchSpecial = array("Legion del Afecto");
		$replaceSpecial = array("Legion Del Afecto");

		$keyWordSinAcento = str_replace($search, $replace, $keyWord);
		$keyWordMinus = strtolower($keyWordSinAcento);
		$keyWordMayus = strtoupper($keyWordSinAcento);
		$keyWordMayusFirstLetterAll = ucwords($keyWordSinAcento);
		$keyWordMayusFirstLetter = ucfirst($keyWordSinAcento);

		for($i=0;$i < count($docs);$i++){
			$textSinAcento = str_replace($search, $replace, $docs[$i]->texto);
			$textSinAcento = str_replace($searchSpecial, $replaceSpecial, $textSinAcento);
			if(substr_count($textSinAcento, $keyWordMinus) > 0){
				$keyReplace = "<span class=\"key-word\">".$keyWordMinus."</span>";
				$textSinAcento = str_replace($keyWordMinus, $keyReplace, $textSinAcento);
			}
			if(substr_count($textSinAcento, $keyWordMayus) > 0){
				$keyReplace = "<span class='key-word'>$keyWordMayus</span>";
				$textSinAcento = str_replace($keyWordMayus, $keyReplace, $textSinAcento);
			}
			if(substr_count($textSinAcento, $keyWordMayusFirstLetter) > 0){
				$keyReplace = "<span class='key-word'>$keyWordMayusFirstLetter</span>";
				$textSinAcento = str_replace($keyWordMayusFirstLetter, $keyReplace, $textSinAcento);
			}
			if(substr_count($textSinAcento, $keyWordMayusFirstLetterAll) > 0){
				$keyReplace = "<span class='key-word'>$keyWordMayusFirstLetterAll</span>";
				$textSinAcento = str_replace($keyWordMayusFirstLetterAll, $keyReplace, $textSinAcento);
			}
			$docs[$i]->texto = $textSinAcento;
			$docs[$i]->texto = nl2br($docs[$i]->texto, false);
		}

		return view('mobirirse/doc', compact('docs'));

	}

	/*Funciones anteriores*/
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
