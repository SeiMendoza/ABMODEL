<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{

    public function updateB(Request $request, $id){

        $request->validate([
            'tipo' => 'required|in:3,2,1',
            'nombre' => 'required|max:100|min:3|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/',
            'descripcion' => 'required|max:100|min:3',
            'precio' => 'required|min:1|max:1000|numeric',
            'tamanio' => 'required|max:100|min:3',
            'imagen' => '',
            'cantidad' => 'min:1|max:1000|numeric',
        ], [
            'tipo.required' => 'El tipo no puede estar vacío',
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'nombre.regex' => 'El nombre debe tener solo letras',
            'descripcion.required' => 'La descripcion no puede estar vacío',
            'descripcion.max' => 'La descripcion es muy extenso',
            'descripcion.min' => 'La descripcion es muy corto',
            'precio.required' => 'El precio no puede estar vacío',
            'precio.max' => 'El precio es muy grande',
            'precio.min' => 'El precio es muy pequeño',
            'precio.numeric' => 'El precio debe de ser numerico',
            'tamanio.required' => 'El tamanio no puede estar vacío',
            'tamanio.max' => 'El tamanio es muy extenso',
            'tamanio.min' => 'El tamanio es muy corto',
            'cantidad.max' => 'El numero de bebidas disponibles es muy grande',
            'cantidad.min' => 'El numero de bebidas disponibles es muy pequeño',
            'cantidad.numeric' => 'El numero de bebidas disponibles debe de ser numerico',
        ]);

        $actualizacion = Producto::FindOrFail($id);

        $actualizacion->nombre = $request->input('nombre');
        $actualizacion->descripcion = $request->input('descripcion');
        $actualizacion->precio = $request->input('precio');
        $actualizacion->tamanio = $request->input('tamanio');
        $actualizacion->disponible = $request->input('cantidad');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time() . '.' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $actualizacion->imagen = 'images/' . $filename;

        } else {
            unset($actualizacion['imagen']);
        }

        $creado = $actualizacion->save();

        if ($creado) {
            return redirect()->route('menuAdmon.bebidas')
                ->with('mensaje', "Bebida " . $actualizacion->nombre . " se actualizó correctamente");
        }
    }

    public function updateP(Request $request, $id){

        $request->validate([
            'tipo' => 'required|in:3,2,1',
            'nombre' => 'required|max:100|min:3|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/',
            'descripcion' => 'required|max:100|min:3',
            'precio' => 'required|min:1|max:1000|numeric',
            'tamanio' => 'required|max:100|min:3',
            'imagen' => '',
            'cantidad' => 'min:1|max:1000|numeric',
        ], [
            'tipo.required' => 'El tipo no puede estar vacío',
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'nombre.regex' => 'El nombre debe tener solo letras',
            'descripcion.required' => 'La descripcion no puede estar vacío',
            'descripcion.max' => 'La descripcion es muy extenso',
            'descripcion.min' => 'La descripcion es muy corto',
            'precio.required' => 'El precio no puede estar vacío',
            'precio.max' => 'El precio es muy grande',
            'precio.min' => 'El precio es muy pequeño',
            'precio.numeric' => 'El precio debe de ser numerico',
            'tamanio.required' => 'El tamanio no puede estar vacío',
            'tamanio.max' => 'El tamanio es muy extenso',
            'tamanio.min' => 'El tamanio es muy corto',
            'cantidad.max' => 'El numero de platillos disponibles es muy grande',
            'cantidad.min' => 'El numero de platillos disponibles es muy pequeño',
            'cantidad.numeric' => 'El numero de platillos disponibles debe de ser numerico',
        ]);


        $actualizacion = Producto::findOrFail($id);

        $actualizacion->nombre = $request->input('nombre');
        $actualizacion->descripcion = $request->input('descripcion');
        $actualizacion->precio = $request->input('precio');
        $actualizacion->tamanio = $request->input('tamanio');
        $actualizacion->disponible = $request->input('cantidad');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time() . '.' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $actualizacion->imagen = 'images/' . $filename;

        } else {
            unset($actualizacion['imagen']);
        }

        $creado = $actualizacion->save();

        if ($creado) {
            return redirect()->route('menuAdmon.platillos')
                ->with('mensaje', "Platillo " . $actualizacion->nombre . " se actualizó correctamente");
        }

    }

    public function updateC(Request $request, $id){

        $request->validate([
            'tipo' => 'required|in:3,2,1',
            'nombre' => 'required|max:100|min:3|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/',
            'descripcion' => 'required|max:100|min:3',
            'precio' => 'required|min:1|max:1000|numeric',
            'tamanio' => 'required|max:100|min:3',
            'imagen' => '',
            'cantidad' => 'min:1|max:1000|numeric',
        ]);


        $actualizacion = Producto::findOrFail($id);

        $actualizacion->nombre = $request->input('nombre');
        $actualizacion->descripcion = $request->input('descripcion');
        $actualizacion->precio = $request->input('precio');
        $actualizacion->tamanio = $request->input('tamanio');
        $actualizacion->disponible = $request->input('cantidad');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time() . '.' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $actualizacion->imagen = 'images/' . $filename;

        } else {
            unset($actualizacion['imagen']);
        }

        $creado = $actualizacion->save();

        if ($creado) {
            return redirect()->route('menuAdmon.complementos')
                ->with('mensaje', "Complemento " . $actualizacion->nombre . " se actualizó correctamente");
        }

    }

    public function activar(Request $request, $id)
    {
        $producto = Producto::findOrfail($id);
        $producto->estado = $request->input('activar');
        $create = $producto->save();

        $tipo = '';
        if ($producto->tipo == 0) {
            $tipo = 'Complemento ';
        } else if ($producto->tipo == 1) {
            $tipo = 'Bebida ';
        } else {
            $tipo = 'Platillo ';
        }

        if ($create) {
            if ($producto->estado == 1) {
                return back()->with('mensaje', $tipo . $producto->nombre . '  activado');
            } else {
                return back()->with('mensaje', $tipo . $producto->nombre . ' desactivado');
            }
        }

    }

    public function destroy($id)
    {

        $producto = Producto::findOrFail($id);

        $nombre = $producto->nombre;
        $tipo = '';
        if ($producto->tipo == 0) {
            $tipo = 'Complemento ';
        } else if ($producto->tipo == 1) {
            $tipo = 'Bebida ';
        } else {
            $tipo = 'Platillo ';
        }

        $producto->delete();

        return back()->with('mensaje', $tipo . $nombre . ' eliminado');

    }

    public function edit($id)
    {

        $producto = Producto::findOrFail($id);

        if ($producto->tipo == 0) {
            return view('Menu/Admon/edicion/editarComplemento')->with('producto', $producto);
        } else if ($producto->tipo == 1) {
            return view('Menu/Admon/edicion/editarBebida')->with('producto', $producto);
        } else {
            return view('Menu/Admon/edicion/editarPlatillo')->with('producto', $producto);
        }
    }
}