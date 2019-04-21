<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class email_confController extends Controller {
    public function index()
    {
        $nombre = "Erick Saenz";
        $cod_act = "232emkwldkfokwpor2i4302irjwfijwrk2i0i";
        return view('v2/email_conf', compact('nombre', 'cod_act'));

        //
    }
	//

}
