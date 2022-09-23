<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        // generando un ID unico para las imagenes y evitar que se repita los nombres
        $nombreImagen = Str::uuid().".".$imagen->extension();

        $imagenServidor = Image::make($imagen);

        // usando la funcion fit de interventionImage(ver documentacion)
        $imagenServidor->fit(1000,1000);

        // moviendo la imagen al servidor
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);


        return response()->json(['imagen' =>$nombreImagen]);
    }
}
