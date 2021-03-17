<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

/**
 * @method static whereEmail(string $email)
 * @method static make(array $toArray)
 */
class Usuario extends User
{
    use HasFactory;

    const TABLE_NAME = 'fl_usuarios';

    protected $table = self::TABLE_NAME;

    protected $fillable = ['nome', 'sobrenome', 'email', 'senha', 'tipo_perfil_id', 'data_nascimento'];

    protected $guarded = ['id', 'senha'];

    protected $appends = ['nomeCompleto'];

    public function tipoPerfil()
    {
        return $this->belongsTo(TipoPerfil::class);
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

    public function definirUrlFotoPerfil(UploadedFile $fotoPerfil): void
    {
        $fotoPerfil->storeAs('\\', $fotoPerfil->hashName(), [
            'disk' => 'imgs_foto_perfil'
        ]);
        $this->url_foto_perfil = $fotoPerfil->hashName();
    }

    public function definirUrlFotoCapa(UploadedFile $fotoCapa): void
    {
        $fotoCapa->storeAs('\\', $fotoCapa->hashName(), [
            'disk' => 'imgs_foto_capa'
        ]);
        $this->url_foto_capa = $fotoCapa->hashName();
    }

    public function temEmailUnico()
    {
        return self::whereEmail($this->email)->count() > 0;
    }

    public function temPerfilFotografo(): bool
    {
        return $this->tipoPerfil->nome === TipoPerfil::FOTOGRAFO;
    }

    public function temPerfilCliente(): bool
    {
        return $this->tipoPerfil->nome === TipoPerfil::CLIENTE;
    }
}
