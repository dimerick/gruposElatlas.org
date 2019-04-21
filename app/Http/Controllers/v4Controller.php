<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class v4Controller extends Controller {

    public function __construct()
    {
        
    }
    public function index(){
        return view('v4/index');
    }
    
}
