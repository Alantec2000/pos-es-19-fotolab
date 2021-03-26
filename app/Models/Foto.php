<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    const TABLE_NAME = 'fl_fotos';

    protected $table = self::TABLE_NAME;

    protected $casts = [
        'meta_data' => 'json'
    ];

    public $attributes = [
        'titulo' => '',
        'descricao' => '',
        'meta_data' => '{}'
    ];

    protected $fillable = ['nome_arquivo', 'fotografo_id', 'titulo', 'descricao', 'meta_data'];

    public function fotografo()
    {
        return $this->belongsTo(Fotografo::class);
    }
}
