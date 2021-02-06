<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereNome(string $ucfirst)
 */
class TipoPerfil extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'fl_tipos_perfil';

    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
