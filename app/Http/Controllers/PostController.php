<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // ruta segura
    public function __construct(){
        $this->middleware('auth')->except(['show','index']);
    }

    //enviando ala URL el user
    public function index(User $user)
    {       
        // para comprobar el user ID //// tambien se puede usar simplePaginate
        $posts = Post::where('user_id',$user->id)->latest()->Paginate(4);

        return view('dashboard',
        [
            'user'=>$user,
            'posts' =>$posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }
    
// validar y guardar en la bdd
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'=>'required|max:255',
            'descripcion'=>'required',
            'imagen'=>'required',
        
        ]);

/*         Post::create([
            'titulo' => $request ->titulo,
            'descripcion' => $request ->descripcion,
            'imagen' => $request ->imagen,
            'user_id' => auth()->user()->id
        ]); */

        // otra forma
/*      $post = new Post;
        $post->titulo = $request ->titulo;
        $post->descripcion = $request ->descripcion;
        $post->imagen = $request ->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); 
*/
        // fin forma

        $request ->user()->posts()->create([
            'titulo' => $request ->titulo,
            'descripcion' => $request ->descripcion,
            'imagen' => $request ->imagen,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('posts.index',auth()->user()->username);
    }

    public function show(User $user,Post $post)
    {
        return view('posts.show',
        [
            'post' =>$post,
            'user'=>$user
        ]);
    }

    public function destroy(Post $post){

       $this->authorize('delete', $post);

        // Eliminar el post
        $post->delete();

        // eliminar la imagen
        $imagen_path = public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);

        }

        return redirect()->route('posts.index',auth()->user()->username);

        
        $this->authorize('delete', $post);

    }
}
