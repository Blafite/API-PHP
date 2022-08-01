<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empreendimento;
use App\Models\Unidade;
use App\Models\Log;

class UnidadeController extends Controller
{
    public function getUnidades(Request $request)
    {
        $query = Unidade::query();

        $termos = $request->only('bloco', 'status', 'id_empreendimento');

        foreach ($termos as $nome => $valor) {
            if($valor){
                $query->where($nome, 'like', '%'.$valor.'%');
            }
        }

        $valorUnidade = $request->only('valor');

        foreach ($valorUnidade as $nome => $valor) {
            if($valor){
                $query->where($nome, '<', $valor);
            }
        }

        if($query->get() != null)
            $unidades = $query->join('empreendimentos','unidades.id_empreendimento', '=', 'empreendimentos.id')
            ->select('unidades.*', 'empreendimentos.nome')
            ->get();
        else
            $unidades = Unidade::
            join('empreendimentos','unidades.id_empreendimento', '=', 'empreendimentos.id')
            ->get();
        
        return response()->json(['unidades' => $unidades]);
    }

    public function create()
    {  
        $json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['unidade'])){
			$json = $json['unidade'];
		}
            $novaUnidade = Unidade::create([
            'bloco' => $json['bloco'],
            'valor' => $json['valor'],
            'status' => 'DISPONIVEL',
            'id_empreendimento' => $json['idEmpreendimento']
        ]);
        return response()->json(['unidade' => $novaUnidade]);

    }

    public function update($id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        $unidade = Unidade::findOrFail($id);
        $unidade->update([
            'bloco' => $json['bloco'],
            'valor' => $json['valor'],
            'status' => $json['status'],
            'id_empreendimento' => $json['idEmpreendimento']
        ]);
        return response()->json(['unidade' => $unidade]);
    }

    public function delete($id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        $unidade = Unidade::findOrFail($id);
        $unidade->delete();
        return response()->json(['unidade' => $unidade]);
    }

    public function cadastroUnidades(Request $request)
    {
        $json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['unidade'])){
			$json = $json['unidade'];
		}
        $empreendimento = $json['idEmpreendimento'];
        $quantidadeBlocos = $json['quantidadeBlocos'];
        $unidadesBloco = $json['unidadesBloco'];
        $valor = $json['valor'];

        for($i = 1; $i < $quantidadeBlocos + 1; $i++){
            for($aux = 0; $aux < $unidadesBloco; $aux++){
                Unidade::create([
                    'bloco' => $i,
                    'valor' => $valor,
                    'status' => 'DISPONIVEL',
                    'id_empreendimento' => $empreendimento
                ]);
            }
        }

        return response()->json(['message' => 'Criado com sucesso']);
    }

    public function estoqueDisponivel($id)
    {
        $unidades = Unidade::where('status', '=', 'DISPONIVEL')
        ->where('id_empreendimento', '=', $id)
        ->get()
        ->count();

        return $unidades;
    }

    public function valorVendido($id)
    {
        $unidades = Unidade::where('status', '=', 'VENDIDA')
        ->where('id_empreendimento', '=', $id)
        ->get()
        ->sum('valor');

        return $unidades;
    }

    public function valorReservado($id)
    {
        $unidades = Unidade::where('status', '=', 'RESERVADA')
        ->where('id_empreendimento', '=', $id)
        ->get()
        ->sum('valor');

        return $unidades;
    }

    public function reajustarValor(Request $request)
    {
        $json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['unidade'])){
			$json = $json['unidade'];
		}
        $empreendimento = $json['idEmpreendimento'];
        $percentualReajuste = $json['percentualReajuste'];
        
        $unidades = Unidade::where('status', '=', 'DISPONIVEL')
        ->where('id_empreendimento', '=', $empreendimento)
        ->get();
        
        for($i = 0; $i < sizeOf($unidades); $i++){
            Unidade::where('id', '=', $unidades[$i]['id'])
            ->update([
                'valor' => $unidades[$i]['valor'] + ($unidades[$i]['valor'] * $percentualReajuste)
            ]);
        }

        Log::create([
            'percentual_reajuste' => $percentualReajuste,
            'data_reajuste' => date('Y-m-d H:i:s')
        ]);
        
        
        return response()->json(['message' => 'Preços reajustados com sucesso']);
    }
	
		public function getUnidade($id)
    {
		$unidade = Unidade::findOrFail($id);
        $unidade->get();
        return response()->json(['unidade' => $unidade]);
    }
}
