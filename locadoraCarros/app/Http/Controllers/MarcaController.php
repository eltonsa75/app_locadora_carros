<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$marcas = Marca::all();
        $marcas = $this->marca->all();
        return response()->json($marca, 200); 

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //$marca = Marca::create($request->all());
      $marca = $this->marca->create($request->all());
      return response()->json($marca, 201); 
    }

    /**
     * Display the specified resource.
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);
        if($marca === null){
            return response()->json(['msg' => 'Marca não encontrada'], 404);
        }
        return response()->json($marca, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $marca = $this->marca->find($id);
       if($marca === null){
           return response()->json(['msg' => 'Impossível realizar a atualização. O recusro solicitado não existe'], 404);
       }
       $marca->update($request->all());
       return  response()->json(['msg' => 'A marca foi atualizada com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Integer
     * @param  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $marca = $this->marca->find($id);
         if($marca === null){
              return response()->json(['msg' => 'Impossível realizar a exclusão. O recusro solicitado não existe'], 404);
         }
        $marca->delete();
       return response()->json(['msg' => 'A marca foi excluída com sucesso'], 200);

    }
}
