<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventoController extends Controller
{
    public function index()
    {
        return view("evento.index");
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $evento = [
            'title' => $request->title,
            'descripcion' => $request->descripcion,
            'start' => $request->start,
            'end' => $request->end,
            'updated_at' => null
        ];
        
        try
        {
            Evento::create($evento);
            return json_encode(['Creo']);
        }
        catch(\Exception $ex)
        {
            return json_encode(['Error' => $ex->getMessage()]);
        }
        
    }

    public function show(Evento $evento)
    {
        $eventos = Evento::all();
        return response()->json($eventos);
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        //Con carbón sobreescribe las fechas a formato Mes|Día|Año
        $evento->start = Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d');
        $evento->end = Carbon::createFromFormat('Y-m-d H:i:s', $evento->end)->format('Y-m-d');
        return response()->json($evento);
    }

    public function update(Request $request, Evento $evento)
    {
        try
        {
            $datos = [
                'title' => $request->title,
                'descripcion' => $request->descripcion,
                'start' => $request->start,
                'end' => $request->end,
            ];
            $evento->update($datos);
            return json_encode(['Edito']);
        }
        catch(\Exception $ex)
        {
            return json_encode(['Error' => $ex->getMessage()]);
        }

       
    }

    public function destroy($id)
    {
        try
        {
            $evento = Evento::find($id);
            $evento->delete();
            return json_encode(['Elimino']);
        }
        catch(\Exception $ex)
        {
            return json_encode(['Error' => $ex->getMessage()]);
        }
    }
}
