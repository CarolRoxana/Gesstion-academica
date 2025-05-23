<?php

namespace App\Http\Controllers;

use App\Models\CuerpoHorario;
use Illuminate\Http\Request;

class CuerpoHorarioController extends Controller
{
    public function index()
    {
        $cuerpo_horario = CuerpoHorario::latest()->first();

        return view('admin\cuerpo_horario\index', compact('cuerpo_horario'));
    }


    public function edit($id)
    {

        $cuerpo_horario = CuerpoHorario::where('id', ($id))->first();
        return view('admin.cuerpo_horario.edit', compact('cuerpo_horario',));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required',

        ]);

        $cuerpo_horario = CuerpoHorario::findOrFail($id);
        $cuerpo_horario->update([
            'descripcion' => $request->descripcion,
        ])->save();


        return redirect()->route('admin.cuerpo_horario.index')->with('success', 'Cuerpo de horario actualizado exitosamente.');
    }
}
