<template>
    <div id="portfolio-container">
        <div id="portfolio-header">
            <h1>Seu Portfólio:</h1>
            <div id="container-botao-adicionar-fotos">
                <button class="btn bg-yellow" @click="abrirModal">Adicionar Fotos</button>
            </div>
        </div>

        <div id="portfolio-body">
            <div id="portfolio-imagens" v-show="imagens.length !== 0">
                <img
                    :src="imagem.caminho + 'thumbnail-' + imagem.nome_arquivo" 
                    :alt="'Previa da imagem ' + i" 
                    :key="i" v-for="(imagem, i) in imagens"
                    @click="abrirDetalhesImagem(imagem)"
                    @error="colocarImagemDeErro"
                />
            </div>
            <detalhes-foto ref="modalDetalhesFoto" @imageError="colocarImagemDeErro" @recarregarPortfolio="buscarImagens"></detalhes-foto>
            <div id="container-mensagem-sem-fotos" v-show="semFotos">
                Você ainda não tem fotos no seu portfólio. 
                Adicione novas fotos usando o botão "<em>Adicionar Fotos</em>" acima.
            </div>
            <loading ref="loading"></loading>
        </div>
    </div>
    <modal-adicionar-fotos ref="modalAdicionarFotos" @recarregarPortfolio="buscarImagens"></modal-adicionar-fotos>
</template>

<script>
import ModalAdicionarFotos from './ModalAdicionarFotos';
import DetalhesFoto from './DetalhesFoto';
import Loading from './Loading';

export default {
    data: function () {
        return {
            imagens: [],
            semFotos: false,
            intervalo: setInterval(this.buscarImagens.bind(this), 60000)
        };
    },
    mounted() {
        this.buscarImagens();
    },
    components: {
        'modal-adicionar-fotos': ModalAdicionarFotos,
        'detalhes-foto': DetalhesFoto,
        Loading
    },
    methods: {
        abrirModal() {
            this.$refs.modalAdicionarFotos.$refs.modal.showModal();
        },
        buscarImagens() {
            this.imagens = [];
            this.$refs.loading.showLoading();
            this.semFotos = false;

            axios.get('/api/fotografo/portfolio')
            .then((response) => {
                this.imagens = response.data.data;
                this.semFotos = this.imagens.length === 0;
                this.$refs.loading.hideLoading();
            })
            .catch((error) => {
                if (typeof error.data !== 'undefined') {
                    this.$toast.e(error.data.message)
                    return false;
                }
                
                this.$refs.loading.hideLoading();

                this.$toast.error('Ocorreu um erro ao carregar suas fotos. Tente recarregar a página...');
                console.log(error);
            });
        },
        abrirDetalhesImagem(imagem) {
            this.$refs.modalDetalhesFoto.abrirDetalhesImagem(imagem);
        },
        colocarImagemDeErro(event) {
            event.target.src = '/imgs/no-image.png';
            event.target.title = 'Imagem não encontrada!';
        }
    }
}
</script>

<style>
    #container-mensagem-sem-fotos {
        text-align: center;
    }

    #portfolio-container {
        height: inherit;
        width: 80vw;
    }

    #portfolio-header {
        overflow: auto;
        padding: 0 1rem;
        border-bottom: 1px solid lightgrey;
        height: fit-content;
        margin-bottom: 2rem;
    }

    #portfolio-header > h1 {
        float: left;
        font-weight: 300;
    }

    #container-botao-adicionar-fotos {
        position: relative;
        transform: translateY(80%);
        float: right;
    }

    #portfolio-imagens {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));
        grid-gap: 1rem;
        max-width: 80rem;
        margin: 5rem auto;
        padding: 0 5rem;
    }

    #portfolio-imagens > img {
        width: 100%;
        height: 22vw;
        object-fit: cover;
        border-radius: 0.75rem;
    }

    #portfolio-imagens > img:hover {
        transform: scale(1.02);
        opacity: 0.9;
        box-shadow: 15px 15px 11px -5px rgb(0 0 0 / 30%);
        transition: 50ms ease-out;
    }

    #portfolio-imagens > img:active {
        transform: scale(0.98);
        box-shadow: 15px 15px 11px -5px rgb(0 0 0 / 30%);
        transition: 50ms ease-out;
    }
</style>