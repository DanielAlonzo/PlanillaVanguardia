<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Empleado;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Empleado::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'identidad'=>'required|numeric|max:13|min:13|unique:empleados,identidad',
            'nombre'=>'required|string',
            'fecha_ingreso'=>'required',
            'fecha_salida'=>'required',
            'salario_base'=>'required|numeric',
            'id_departamento'=>'required',
            'id_puesto'=>'required',
            'id_horario'=>'required'
        ]);
        return Empleado::create([
            'identidad'=>$request['identidad'],
             'nombre'=>$request['nombre'],
             'fecha_ingreso'=>$request['fecha_ingreso'],
             'fecha_salida'=>$request['fecha_salida'],
             'salario_base'=>$request['salario_base'],
             'id_departamento'=>$request['id_departamento'],
             'id_puesto'=>$request['id_puesto'],
             'id_horario'=>$request['id_horario'],
              
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
