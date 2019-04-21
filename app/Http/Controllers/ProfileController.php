<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller {

    public function index(){

        return view('user/profile');
    }

    public function index2(){

        return view('user/profile2');
    }

    public function index3(){

        $user = Auth::user();
        $email = $user['attributes']['email'];
        if($user['attributes']['confirmada'] == 1){
            return view('user/index');
        }else{

            return view('activate_solic', compact('email'));
        }


    }
    //

}
