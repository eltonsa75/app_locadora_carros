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
        return response()->json($marcas, 200); 

    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //nome
     //imagem
        $request->validate($this->marca->rules(), $this->marca->feedback());   
        
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

      $marca = $this->marca->create([
          'nome' => $request->nome,
          'imagem' => $imagem_urn
      ]);
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
            return response()->json(['msg' => 'A Marca pesquisada não existe'], 404);
        }
        return response()->json($marca, 200);
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

         //se o método for PATCH, então é uma atualização parcial
       if($request->method() === 'PATCH'){
           $regrasDinamicas = array();

           //percorrendo todas as regras definidas no Model
           foreach($marca->rules() as $input => $regra){
               //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
               if(array_key_exists($input, $request->all())){
                   $regrasDinamicas[$input] = $regra;
               }
           }
           $request->validate($regrasDinamicas, $marca->feedback());

       $request->validate($marca->rules(), $marca->feedback());

       $marca->update($request->all());
       return  response()->json(['msg' => 'A marca foi atualizada com sucesso'], 200);
    }
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
