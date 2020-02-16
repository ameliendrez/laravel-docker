<?php

use Illuminate\Http\Request;
use App\Empleado;

// Obtener empleados
Route::get('empleados', function () {
    $empleados = Empleado::get();
    return $empleados;
});

// Obtener empleados
Route::get('empleados/{id}', function ($id) {
    $empleado = Empleado::findOrFail($id);
    return $empleado;
});

// Guardar empleado
Route::post('empleados', function (Request $request) {
    $request->validate([
        'nombres' => 'required|max:50',
        'apellido' => 'required|max:50',
        'cedula' => 'required|max:50',
        'email' => 'required|max:50|email|unique:empleados',
        'telefono' => 'required|numeric'
    ]);
    $empleado = new Empleado;
    $empleado->nombres = $request->input('nombres');
    $empleado->apellido = $request->input('apellido');
    $empleado->cedula = $request->input('cedula');
    $empleado->email = $request->input('email');
    $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado->sexo = $request->input('sexo');
    $empleado->estado_civil = $request->input('estado_civil');
    $empleado->telefono = $request->input('telefono');
    $empleado->save();
    return 'Empleado Creado';
});

// Actualizar empleado
Route::put('empleados/{id}', function (Request $request, $id) {
    $request->validate([
        'nombres' => 'required|max:50',
        'apellido' => 'required|max:50',
        'cedula' => 'required|max:50',
        'email' => 'required|max:50|email|unique:empleados,email,' . $id, //con email, $id se indica que cuando haga update no tenga en cuenta el email propio duplicado
        'telefono' => 'required|numeric'
    ]);
    $empleado = Empleado::findOrFail($id);
    $empleado->nombres = $request->input('nombres');
    $empleado->apellido = $request->input('apellido');
    $empleado->cedula = $request->input('cedula');
    $empleado->email = $request->input('email');
    $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado->sexo = $request->input('sexo');
    $empleado->estado_civil = $request->input('estado_civil');
    $empleado->telefono = $request->input('telefono');
    $empleado->save();
    return 'Empleado Actualizado';

});

// Eliminar empleado
Route::delete('empleados/{id}', function ($id) {
    $empleado = Empleado::findOrFail($id);
    $empleado->delete();
    return 'Empleado eliminado exitosamente';
});