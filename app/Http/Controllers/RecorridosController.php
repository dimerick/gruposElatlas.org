<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class RecorridosController extends Controller {

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
        $user = $this->datUser;
        return view('recorridos', compact('user'));
    }

	public function recorridoDerechoAlaCiudad($id){
        $user = $this->datUser;
        switch($id){
            case 1:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page1', compact('user'));
            break;
            case 2:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page2', compact('user'));
                break;
            case 3:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page3', compact('user'));
                break;
            case 4:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page4', compact('user'));
                break;
            case 5:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page5', compact('user'));
                break;
            case 6:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page6', compact('user'));
                break;
            case 7:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page7', compact('user'));
                break;
            case 8:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page8', compact('user'));
                break;
            case 9:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page9', compact('user'));
                break;
            case 10:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page10', compact('user'));
                break;
            case 11:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page11', compact('user'));
                break;
            case 12:
                return view('recorridos/recorrido-derecho-a-la-ciudad-page12', compact('user'));
                break;
            default:
                return ('La pagina solicitada no existe');
        }

    }

}
