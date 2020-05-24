<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::paginate(6);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string|min:5|unique:permissions,name',
            'slug' => 'required|string|max:255',
            'description' => 'string|max:255',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del Permiso',
            'name.string' => 'El nombre del permiso debe contener solo caracteres',
            'name.min' => 'El nombre del permiso debe contener 5 caracteres como minimo',
            'name.unique' => 'El permiso ya existe en la base de datos',
            'slug.required' => 'Es necesario ingresar la url',
            'slug.string' => 'La url debe contener solo caracteres',
            'slug.max' => 'La url debe contener 255 caracteres como maximo',
            'description.string' => 'La descripción debe contener solo caracteres',
            'description.max' => 'La descripción debe contener 255 caracteres como maximo',

        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            //guardamos el permiso
            $permissions = Permission::create([
                'name'=>$request->get('name'),
                'slug'=>$request->get('slug'),
                'description'=>$request->get('description')
            ]);
            $permissions->save();

        }

        return response()->json($validator->messages(),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required|string|min:5|unique:permissions,name',
            'slug' => 'required|string|max:255',
            'description' => 'string|max:255',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del Permiso',
            'name.string' => 'El nombre del permiso debe contener solo caracteres',
            'name.min' => 'El nombre del permiso debe contener 5 caracteres como minimo',
            'name.unique' => 'El permiso ya existe en la base de datos',
            'slug.required' => 'Es necesario ingresar la url',
            'slug.string' => 'La url debe contener solo caracteres',
            'slug.max' => 'La url debe contener 255 caracteres como maximo',
            'description.string' => 'La descripción debe contener solo caracteres',
            'description.max' => 'La descripción debe contener 255 caracteres como maximo',

        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            //guardamos el permiso
                $permissions = Permission::find($request->get('id'));
                $permissions->name = $request->get('name');
                $permissions->slug = $request->get('slug');
                $permissions->description = $request->get('description');
                $permissions->save();

        }

        return response()->json($validator->messages(),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($request,$id)
    {
        $rules = array(
            'id' => 'required|exists:permissions,id',
        );
        $mensajes = array(
            'id.required' => 'Es necesario enviar el id del permiso',
            'id.exists' => 'El permiso no existe en la base de datos',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            $permission = Permission::find($id);
            $permission->delete();
        }

        return response()->json($validator->messages(),200);

    }


}
