@extends('templates.master')

@section('css-view')
    <style type="text/css">
        #conheca-outros-fotografos {
            text-align: center;
            margin: 40px;
        }

        #conheca-outros-fotografos a {
            font-size: 2.5rem;
            font-weight: 400;
        }

        #lista_fotografos {
            margin-top: 2rem 0.6rem;
        }

        #lista_fotografos h1 {
            font-weight: 300;
        }
    </style>
@endsection

@section('conteudo-view')
    <div id="home">
        <div id="app">
            <vueper-slides autoplay>
                <vueper-slide v-for="(image, i) in ['/imgs/banner.jpg', '/imgs/banner-2.jpg', '/imgs/banner-3.jpg']"
                  :key="i"
                  :title=""
                  :image="image"
                  :content=""
                  />
                <template v-slot:pause>
                  <i class="icon pause_circle_outline"></i>
                </template>
            </vueper-slides>
            <hr>
            <h1>Conheça alguns de nossos fotógrafos:</h1>
            <lista-fotografos></lista-fotografos>
        </div>
        <div id="conheca-outros-fotografos">
            <a href="/fotografo" class="btn bg-yellow">Conheça outros</a>
        </div>
    </div>
@endsection
