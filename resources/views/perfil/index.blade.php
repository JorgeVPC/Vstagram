@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" 
                action="{{ route('perfil.store' )}}" enctype="multipart/form-data" method="post" >
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        placeholder="Tu Nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-400 @enderror"
                        value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen  Perfil
                    </label>
                    <input 
                        type="file" 
                        name="imagen" 
                        id="imagen" 
                        class="border p-3 w-full rounded-lg"
                        value=
                        accept=".jpg, .jpeg, .png">
                        
                </div>
                <input 
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg"
                >
            </form>

        </div>

    </div>


@endsection