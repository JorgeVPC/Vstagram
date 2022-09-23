<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

       // modificar el request
       $request -> request -> add(['username'=>Str::slug($request->username),]);

        $this->validate($request,[
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'/* , 'in:CLIENTE' */],
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');
            // generando un ID unico para las imagenes y evitar que se repita los nombres
            $nombreImagen = Str::uuid().".".$imagen->extension();
                $imagenServidor = Image::make($imagen);
                // usando la funcion fit de interventionImage(ver documentacion)
            $imagenServidor->fit(1000,1000);
                // moviendo la imagen al servidor
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);    
        }
        //guardar cambios
        $usuario =User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null ;
        $usuario->save();

      /* redireccionar */ 
      return redirect()->route('posts.index',$usuario->username);


    }
}
