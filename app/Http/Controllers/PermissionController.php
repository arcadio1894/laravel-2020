<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(5);
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string|min:5|unique:permissions,name',
            'description' => 'string|max:255',
            'slug' => 'required|string|unique:permissions,slug'
        );
        $mensajes = array(
          'name.required' => 'Es necesario ingresar el nombre del curso',
          'name.string' => 'El nombre del permiso debe contener solo caracteres',
          'name.min' => 'El nombre del permiso debe contener 5 caracteres como mínimo',
          'name.unique' => 'El permiso ya existe en la base de datos',
          'description.string' => 'La descripcion debe contener solo caracteres',
          'description.max' => 'La descripcion debe contener 255 caracteres como maximo',
          'slug.required' => 'Es necesario ingresar el url amigable nombre del curso',
          'slug.string' => 'El url amigable del permiso debe contener solo caracteres',
          'slug.unique' => 'El url amigable ya existe en la base de datos'
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            // Guardar el permiso
            $permission = Permission::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'slug' => $request->get('slug'),
            ]);
            $permission->save();
        }

        return response()->json($validator->messages(),200);
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        //
    }

    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required|string|min:5',
            'description' => 'string|max:255',
            'slug' => 'required|string'
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del curso',
            'name.string' => 'El nombre del curso debe contener solo caracteres',
            'name.min' => 'El nombre del curso debe contener 5 caracteres como mínimo',
            'description.string' => 'La descripcion debe contener solo caracteres',
            'description.max' => 'La descripcion debe contener 255 caracteres como maximo',
            'slug.required' => 'Es necesario ingresar el precio del curso',
            'slug.string' => 'El precio del curso debe contener solo letras'
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            // Guardar el curso
            $permission = Permission::find($request->get('id'));
            $permission->name = $request->get('name');
            $permission->description = $request->get('description');
            $permission->slug = $request->get('slug');
            $permission->save();
        }

        return response()->json($validator->messages(),200);
    }

    public function destroy(Request $request, $id)
    {
        $rules = array(
            'id' => 'required|exists:permissions,id',
        );

        $mensajes = array(
            'id.required' => 'Es necesario enviar el id del curso',
            'id.exists' => 'El curso no existe en la base de datos',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            $permission = Permission::find($id);
            $permission->delete();
        }

        return response()->json($validator->messages(),200);
    }

    public function getPermission($id)
    {
        $permission = Permission::find($id);
        return $permission;
    }
}
