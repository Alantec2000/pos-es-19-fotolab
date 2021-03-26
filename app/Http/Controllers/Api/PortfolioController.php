<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdicionarFotosRequest;
use App\Http\Requests\AtualizarDadosFotoRequest;
use App\Http\Resources\FotoResource;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function index()
    {
        return FotoResource::collection(Foto::whereFotografoId(Auth::id())->get());
    }

    public function create(AdicionarFotosRequest $request)
    {
        $dados = $request->validated();
        $disco = Storage::disk('imgs_portfolio');
        $caminho = $disco->path(Auth::id());
        
        $resultado = [];
        DB::transaction(function () use ($caminho, $dados, &$resultado) {
            foreach($dados['fotos'] as $foto) {
                $nomeArquivo = $foto->hashName();
                $foto->storeAs('\\' . Auth::id(), $nomeArquivo, [
                    'disk' => 'imgs_portfolio'
                ]);
    
                $novaFoto = Foto::create([
                    'nome_arquivo' => $nomeArquivo,
                    'fotografo_id' => Auth::id()
                ]);

                // gerar thumbnail
                $editarFoto = Image::make("$caminho\\$nomeArquivo");
                $editarFoto->resize($editarFoto->width()/2, $editarFoto->height()/2);
                $editarFoto->save("$caminho\\thumbnail-{$nomeArquivo}");
    
                $resultado[] = $novaFoto->toArray();
            }
        });
        
        return response()->json($resultado);
    }

    public function update(Foto $foto, AtualizarDadosFotoRequest $request)
    {
        $dados = request()->all();

        $foto->meta_data = $dados;
        $foto->save();

        return response()->json($foto->meta_data);
    }

    public function delete(Foto $foto)
    {
        $foto->delete();

        return response('');
    }
}
