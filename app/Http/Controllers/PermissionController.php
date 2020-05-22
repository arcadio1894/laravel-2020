<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
   
    public function index()
    {
        $permissions = Permission::paginate(5);
        return view('permission.index', compact('permissions'));
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'string',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del permiso',
            'name.string' => 'El nombre del permiso debe contener solo caracteres',
            'slug.required' => 'Es necesario ingresar el Slug',
            'slug.string' => 'El Slug debe contener solo caracteres',
            'description.string' => 'La descripcion debe contener solo caracteres',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            // Guardar el curso
            $permission = Permission::create([
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'description' => $request->get('description'),
            ]);
        }

        return response()->json($validator->messages(),200);
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $permissions = Permission::find($id);
        return $permissions;
    }

   
    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'string',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del permiso',
            'name.string' => 'El nombre del permiso debe contener solo caracteres',
            'slug.required' => 'Es necesario ingresar el Slug',
            'slug.string' => 'El Slug debe contener solo caracteres',
            'description.string' => 'La descripcion debe contener solo caracteres',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            // Guardar el curso
            $permission = Permission::find($request->get('id'));
            $permission->name = $request->get('name');
            $permission->slug = $request->get('slug');
            $permission->description = $request->get('description');
            $permission->save();

        }

        return response()->json($validator->messages(),200);
    }

    
    public function destroy(Request $request, $id)
    {
        $rules = array(
            'id' => 'required|exists:courses,id',
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
}
