<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compras;

class comprasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return compras::where('user_id', auth()->id())->get()->map(function($compra){
            $compra->fecha_registro = $compra->created_at->toDateTimeString();
            $compra->fecha_modificacion = $compra->created_at->toDateTimeString();
            return $compra;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $compra = new compras;
            $compra->titulo = $request->titulo;
            $compra->descripcion = $request->descripcion;
            $compra->user_id =auth()->id();
            $compra->save();
            return "Se ha guardado correctamente la compra.";
        } catch (Exception $e) {
            return $e->message();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $compra = compras::find($id);
            $compra->titulo = $request->titulo;
            $compra->descripcion = $request->descripcion;
            $compra->save();
        } catch (Exception $e) {

        }
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
        try {
            $compra = Compras::findOrFail($id);
            if($compra){
                $compra->titulo = $request->titulo;
                $compra->descripcion = $request->descripcion;
                $compra->save();
                return "se ha editado la compra correctamente.";
            }else{
                return "No se logró encontrar la compra.";
            }
        } catch (Exception $e) {
            return $e->message();
        }
    }

    /**
     * Remove the specifiedb resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try {
            Compras::find($id)->delete();
            return "se ha editado la compra correctamente.";
        } catch (Exception $e) {
            return $e->message();
        }
    }
}
