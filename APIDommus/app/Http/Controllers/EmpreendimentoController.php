<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empreendimento;
use App\Models\Unidade;

class EmpreendimentoController extends Controller
{
    public function getEmpreendimentos(Request $request)
    {
        $query = Empreendimento::query();

        $termos = $request->only('nome', 'localizacao');

        foreach ($termos as $nome => $valor) {
            if($valor){
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        $data = $request->only('previsaoEntrega');

        foreach ($data as $nome => $valor) {
            if($valor){
                $query->where('previsao_entrega', '<', $valor);
            }
        }

        if($query->get() != null)
            $empreendimentos = $query->get();
        else
            $empreendimentos = Empreendimento::get();

        for($i = 0; $i < sizeOf($empreendimentos); $i++){
            $empreendimentos[$i]['reservado'] = UnidadeController::valorReservado($empreendimentos[$i]['id']);
            $empreendimentos[$i]['vendido'] = UnidadeController::valorVendido($empreendimentos[$i]['id']);
            $empreendimentos[$i]['estoqueDisponivel'] = UnidadeController::estoqueDisponivel($empreendimentos[$i]['id']);
        }
        
            return response()->json(['empreendimentos' => $empreendimentos]);
    }

    public function create()
    {  
        $json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['empreendimento'])){
			$json = $json['empreendimento'];
		}
        try{
            $novoEmpreendimento = Empreendimento::create([
            'nome' => $json['nome'],
            'localizacao' => $json['localizacao'],
            'previsao_entrega' => $json['previsaoEntrega']
        ]);
        return response()->json(['empreendimento' => $novoEmpreendimento]);
    }
    catch (Exception $ex)
    {
        return response()->json($ex);
    }
    }

    public function update($id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['empreendimento'])){
			$json = $json['empreendimento'];
		}
        $empreendimento = Empreendimento::findOrFail($id);
        $empreendimento->update([
            'nome' => $json['nome'],
            'localizacao' => $json['localizacao'],
            'previsao_entrega' => $json['previsaoEntrega']
        ]);
        return response()->json(['empreendimento' => $empreendimento]);
    }

    public function delete($id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['empreendimento'])){
			$json = $json['empreendimento'];
		}
		$empreendimento = Empreendimento::findOrFail($id);
        $empreendimento->delete();
        return response()->json(['empreendimento' => $empreendimento]);
    }
	
	public function getEmpreendimento($id)
    {
		$empreendimento = Empreendimento::findOrFail($id);
        $empreendimento->get();
        return response()->json(['empreendimento' => $empreendimento]);
    }

}
