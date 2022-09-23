@extends('layouts.app')

@section('titulo')
    Crea una nueva publicacion
@endsection

{{-- solo cargar los estilos en esta seccion  999 --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="post" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>

        </div>
        <div class="md:w-1/2 p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action=" {{ route('posts.store') }} " method="post" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo de la publicación"
                        class="border p-3 w-full rounded-lg @error('name') border-red-400 @enderror"
                        value={{ old('titulo') }}>
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripcion
                    </label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripcion de la publicación"
                        class="border p-3 w-full rounded-lg @error('descripcion') border-red-400 @enderror">
                        {{ old('titulo') }}
                    </textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input 
                        name="imagen" 
                        type="hidden"
                        value="{{old('imagen')}}"
                    />
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <input 
                    type="submit" 
                    value="Crear Publicacion"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg"
                />

            </form>

        </div>

    </div>
@endsection
