<?php namespace App\Http\Controllers;

use \Eventviva\ImageResize;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Actividad;
use App\Foto;

class FilesController extends Controller {
    private $datUser;

    public function __construct()
    {
        $user = Auth::user();
        $this->datUser = $user['attributes'];
    }

    public function updatePhotoProfile(Request $request){
        $user = $this->datUser;
        $nombre = $user['nombre'];
        $email = $user['email'];
        //$path = public_path().'/files/fotos_perfil/'; //comentar en servidor
        $path = 'files/fotos_perfil/'; //descomentar en servidor

        $search = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", " ", '"');
        $replace = array("a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "-", "");
        $search1 = array(":", " ");
        $replace1 = array("-", "_");
        $file = \Request::file('file');
        $nomMod = str_replace($search, $replace, $nombre);
        $num = 1;
            $originalName = $file->getClientOriginalName();
            $arrayName = explode('.', $originalName);
            $ext = end($arrayName);

            $ruta = $nomMod."_".$num.".".$ext;
            $rutaPeq = $nomMod."_peq_".$num.".".$ext;
            $rutaComp = $path.$ruta;

            while(file_exists($rutaComp)){
                $num++;
                $ruta = $nomMod."_".$num.".".$ext;
                $rutaPeq = $nomMod."_peq_".$num.".".$ext;
                $rutaComp = $path.$ruta;
            }

            $rutaCompPeq = $path.$rutaPeq;
        \Request::file('file')->move($path, $ruta);

            if(file_exists($rutaComp)){
                $image = new ImageResize($rutaComp);
                $image
                    ->resizeToWidth(1024)
                    ->save($rutaComp, null, 90)
                    ->crop(28, 28)
                    ->save($rutaCompPeq, null, 100)

                ;

                $succes = \DB::table('cuenta')
                    ->where('email', $email)
                    ->update(['foto' => $ruta, 'foto_peq' => $rutaPeq]);
                if($succes){
                    return 'Se ha actualizado la foto de perfil exitosamente';
                }
            }
    }

    public function uploadPhotosPost(Request $request){

        $id = $request->get('id');
        $actividad = Actividad::find($id);
        $datos = $actividad['attributes'];
        $titulo = $datos['titulo'];


        //$path = public_path().'/files/actividades/';//comentar en servidor
        $path = 'files/actividades/';//Descomentar en servidor
        $files = \Request::file('file');

        $search = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", " ", '"', "ñ", "Ñ");
        $replace = array("a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "-", "", "n", "n");

        $nomMod = str_replace($search, $replace, $titulo);
        $num = 1;

        if($files != null){
            foreach($files as $file){
                $originalName = $file->getClientOriginalName();
                $arrayName = explode('.', $originalName);
                $ext = end($arrayName);

                $ruta = $nomMod."_".$num.".".$ext;
                $rutaComp = $path.$ruta;

                while(file_exists($rutaComp)){
                    $num++;
                    $ruta = $nomMod."_".$num.".".$ext;
                    $rutaComp = $path.$ruta;
                }

                $file->move($path, $ruta);

                if(file_exists($rutaComp)){
                    $image = new ImageResize($rutaComp);
                    $image->resizeToWidth(1200);
                    $image->save($rutaComp);

                    Foto::create([
                        'actividad' => $id,
                        'url' => $ruta
                    ]);
                }
            }
        }
    }
//    public function reescalarPerfil(){
////        return "Reescalando imagenes de perfil";
////        $directorio = '/files/fotos_perfil';
//        $path = public_path().'/files/actividades/';
//        $ficheros  = scandir($path);
////        foreach ($ficheros as $file){
//////            $rutaComp = $path.$file;
////            echo $file.'<br>';
//////            $image = new ImageResize($rutaComp);
//////            $image->resizeToWidth(1200);
//////            $image->save($rutaComp);
////        }
//        for($i=2;$i<count($ficheros);$i++){
//            echo $ficheros[$i].'<br>';
//            $rutaComp = $path.$ficheros[$i];
//            $image = new ImageResize($rutaComp);
//            $image->resizeToWidth(1200);
//            $image->save($rutaComp);
//        }
//
//    }
//
//    public function reescalarActi(){
////        return "Reescalando imagenes de actividades";
//    }
}
