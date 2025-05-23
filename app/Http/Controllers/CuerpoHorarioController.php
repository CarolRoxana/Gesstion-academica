<?php

namespace App\Http\Controllers;

use App\Models\CuerpoHorario;
use Illuminate\Http\Request;

class CuerpoHorarioController extends Controller
{
 

    public function edit($id)
    {

        $cuerpo_horario = CuerpoHorario::where('id', ($id))->first();
        return view('admin.cuerpo_horario.edit', compact('cuerpo_horario',));
    }



    public function update(Request $request, $id)
    {

        //dd($request->all());
        $request->validate([
            'descripcion' => 'required',

        ]);

        $cuerpo_horario = CuerpoHorario::find($id);

        if ($cuerpo_horario) {
            $cuerpo_horario->update([
                'descripcion' => $request->descripcion,
            ]);
        } else {
            // Si no existe, crea uno nuevo
            CuerpoHorario::create([
                'descripcion' => $request->descripcion,
            ]);
        }


         return redirect()->route('admin.horario.index')->with('message', 'Cuerpo Horario registrado correctamente');
    }
}
