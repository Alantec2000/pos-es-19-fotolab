<template>
    <div id="lista-fotografos">
        <loading ref="loading" :isLoading="true"></loading>
        <div 
            v-show="!this.$refs.loading.isLoading" 
            class="panel-perfil bg-dark" 
            :key="fotografo.id" 
            v-for="fotografo in this.fotografos" 
            @click="verPerfil(fotografo)"
        >
            <div class="banner">
                <img alt="foto de capa" :src="fotografo.url_foto_perfil || '/imgs/banner.jpg'">
            </div>
            <div class="informacao">
                <div class="usuario">
                    <img :src="fotografo.url_foto_perfil || '/imgs/foto.jpg'" alt="foto de perfil">
                    <h3 class="bg-yellow">{{fotografo.nome + " " + fotografo.sobrenome[0] + "."}}</h3>
                </div>
                <div class="lista-pequena-categoria">
                    <lista-pequena-categorias :categorias="fotografo.categorias">
                    </lista-pequena-categorias>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ListaPequenaCategorias from './ListaPequenaCategorias.vue';
import Loading from './Loading';

export default {
    data: () => {
        return {
            fotografos: [],
        }
    },

    mounted() {
        this.carregarFotografos();
    },

    components: {
        ListaPequenaCategorias,
        Loading
    },

    methods: {
        carregarFotografos: function () {
            this.$refs.loading.isLoading = true;

            axios.get('/api/fotografo')
            .then((response) => {
                this.fotografos = response.data.data;
                this.$refs.loading.isLoading = false;
            })
            .catch((erro) => {
                console.log(erro);
            });
        },
        verPerfil: (fotografo) => {
            window.location = '/fotografo/' + fotografo.id;
        }
    }
}
</script>

<style>

#lista-fotografos #loading {
    text-align: center;
}

#lista-fotografos .panel-perfil .informacao .usuario img {
    border-radius: 100%;
    width: 6rem;
    height: 6rem;
    -o-object-fit: cover;
    object-fit: cover;
    z-index: 2;
    position: relative;
}

#lista-fotografos .usuario h3 {
    width: 7rem;
    padding: 0.4rem;
    padding-left: 0.9rem;
    border-radius: 20px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    position: relative;
    bottom: 90px;
    left: 87px;
}

#lista-fotografos {
    display: flex;
    flex-flow: wrap;
}

#lista-fotografos .panel-perfil {
    margin: 10px;
    width: 22rem;
    min-width: 22rem;
    height: 28rem;
    border-radius: 5px;
}

.panel-perfil.bg-dark:active {
    background-color: #494e92;
    transition: 75ms;
}

.panel-perfil.bg-dark:hover {
    background-color: #7178dc;
    transition: 75ms;
    cursor: pointer;
}


#lista-fotografos .panel-perfil .banner img {
    height: 300px;
    width: 100%;
}

#lista-fotografos .panel-perfil .informacao {
    padding: 15px;
}

#lista-fotografos .panel-perfil .informacao .usuario {
    top: -57px;
    height: 6rem;
    position: relative;
}

.lista-pequena-categoria {
    position: relative;
    bottom: 57px;
}

#lista-fotografos .panel-perfil .banner img {
    height: 300px;
    width: 100%;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

#lista-fotografos .panel-perfil .informacao .categoria .saiba-mais {
    text-align: end;
    color: #FFC82C;
}
</style>