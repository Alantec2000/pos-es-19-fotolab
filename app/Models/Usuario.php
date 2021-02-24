<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Usuario extends User
{
    use HasFactory;

    const TABLE_NAME = 'fl_usuarios';

    protected $table = self::TABLE_NAME;

    protected $fillable = ['nome', 'sobrenome', 'email', 'senha'];

    protected $guarded = ['id', 'password'];

    public function tipoPerfil()
    {
        return $this->hasOne(TipoPerfil::class, 'id', 'id_tipo_perfil');
    }

    public function fotografo()
    {
        return $this->hasOne(Fotografo::class, 'id_usuario');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id_usuario');
    }

    public function contato()
    {
        return $this->hasMany(Usuario::class, 'id_usuario');
    }

    public function fotoPerfil()
    {
        return $this->belongsTo(Imagem::class, 'id_foto_perfil');
    }

    public function servico()
    {
        return $this->hasMany(Servico::class, 'id', 'fotografo_id');
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function setPasswordAttribute($value)
    {
        if (Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }

    public function temEmailUnico()
    {
     return $this->senha;
    }
}
