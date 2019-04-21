<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Cuenta;
use App\Http\Requests\CreateGrupoRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class BasicController extends Controller {
    private $datUser;

    public function __construct()
    {
        $user = Auth::user();
        $this->datUser = $user['attributes'];
    }

    public function index(){
        $user = $this->datUser;
        return view('index', compact('user'));

    }

    public function mapGroups(){

        $user = $this->datUser;
        return view('map-groups', compact('user'));
    }

    public function groupsRegister(Request $request){
//        \Storage::makeDirectory("ajax");
        $grupos = \DB::table('cuenta')
            ->select('nombre', 'email', 'latitud', 'longitud', 'foto')
            ->where('confirmada', 1)
            ->where('tipo', '<>', 'admin')
            ->get();
        return response()->json($grupos);
    }

    public function activities(){
        $actividades = \DB::table('actividad')
            ->join('cuenta', 'actividad.grupo', '=', 'cuenta.email')
            ->join('foto', 'actividad.id', '=', 'foto.actividad')
            ->select('cuenta.nombre', 'cuenta.email', 'actividad.id', 'actividad.titulo', 'actividad.fecha', 'actividad.created_at', 'actividad.descripcion', 'actividad.latitud', 'actividad.longitud', 'foto.url')
            ->where('actividad.confirmada', 1)
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json($actividades);
    }

    public function mapActivities(){
        $user = $this->datUser;
        return view('activities', compact('user'));
    }

    public function indexAlexis(){
        return view('alexis/index');
    }

    public function newIndex(){
        $user = $this->datUser;
        return view('new/index', compact('user'));
    }

    public function retorno(){
        return view('alexis/retorno');
    }

    public function newInterfaz(){
        return view('new/template');
    }
    public function termsConditions(){
        $user = $this->datUser;
        return view('v2/terms-conditions', compact('user'));
    }

    public function daPage(){
        return view('alexis/da-page');
    }
    public function categories(){
        $categories = \DB::table('categoria')
            ->select('id', 'nombre')
            ->get();
        return response()->json($categories);
    }

    public function allGroupsAjax(){
        $grupos = \DB::table('cuenta')
            ->select('nombre', 'email', 'ciudad', 'num_int', 'descripcion', 'foto')
            ->where('cuenta.tipo', 'user')
            ->orderBy('nombre', 'ASC')
            ->get();
        return response()->json($grupos);
    }

    public function searchAjax($cadena){
        $grupos = \DB::table('cuenta')
            ->select('nombre', 'email', 'ciudad', 'num_int', 'descripcion', 'foto')
            ->where('nombre', 'LIKE', "%$cadena%")
            ->where('cuenta.tipo', 'user')
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($grupos);
    }

    public function searchCategories($cadena){
        $categories = explode(';', $cadena);
        $data = [];
        foreach ($categories as $cat){
            if($cat != null){
                $grupos = \DB::table('cuenta')
                    ->join('grupoxcategoria', 'cuenta.email', '=', 'grupoxcategoria.grupo')
                    ->join('categoria', 'grupoxcategoria.categoria', '=', 'categoria.id')
                    ->select('cuenta.nombre', 'cuenta.email', 'cuenta.ciudad', 'cuenta.num_int', 'cuenta.descripcion', 'cuenta.foto', 'categoria.nombre as nomcat', 'categoria.icon')
                    ->where('grupoxcategoria.categoria', $cat)
                    ->where('cuenta.tipo', 'user')
                    ->orderBy('cuenta.nombre', 'ASC')
                    ->get();
                $data[] = $grupos;
            }
        }
//dd($data);
//        return $data;
        return response()->json($data);
    }
    public function groupsxcat(){
        $user = $this->datUser;
        return view('new/groupsxcat', compact('user'));
    }

}
