<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unidade;

class Empreendimento extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'localizacao',  'previsao_entrega'];

    public function Unidade()
    {
        return $this->hasMany(Unidade::class, 'id_empreendimento');
    }
}
