<template>
    <Modal ref="modal">
        <template v-slot:header>
        </template>
        <template v-slot:body>
            <div id="container-foto-selecionada">
                <img src="" alt="Imagem" ref="imagem_em_destaque" @error="$emit('imageError', $event)">
            </div>
        </template>
        <template v-slot:footer>
            <div id="container-botoes-manipulacao-dados-foto">
                <button id="botao-editar-foto" class="btn bg-dark" @click="editarFoto">Editar dados da Foto</button>
                <button id="botao-apagar-foto" class="btn bg-red" @click="confirmarApagarFoto">Apagar Foto</button>
            </div>
        </template>
    </Modal>
    <ModalConfirmacao ref="modalConfirmacao" @confirmar="apagarFoto"></ModalConfirmacao>
    <modal-editar-dados-foto ref="modalEdicaoFotos"></modal-editar-dados-foto>
</template>

<script>
import Modal from './Modal';
import ModalConfirmacao from './ModalConfirmacao';
import ModalEditarFoto from './ModalEditarDadosFoto';
import ModalEditarDadosFoto from './ModalEditarDadosFoto.vue';

export default {
    data() {
        return {
            imagem: null
        };
    },
    emits: [
        'imageError',
        'recarregarPortfolio'
    ],
    components: {
        Modal,
        ModalConfirmacao,
        ModalEditarFoto,
        ModalEditarDadosFoto
    },
    methods: {
        abrirDetalhesImagem(imagem) {
            this.imagem = imagem;
            this.$refs.imagem_em_destaque.src = imagem.caminho + imagem.nome_arquivo;
            this.$refs.modal.showModal();
        },
        confirmarApagarFoto() {
            this.$refs.modalConfirmacao.$refs.modal.showModal();
        },
        apagarFoto() {
            axios.delete('/api/fotografo/portfolio/' + this.imagem.id)
            .then(() => {
                this.$toast.success('Foto removida com sucesso!');
                this.imagem = null;
                this.$refs.modal.closeModal();
                this.$emit('recarregarPortfolio');
            })
            .catch((erro) => {
                this.$toast.error('Ocorreu um erro ao tentar remover essa foto!');
                console.error(erro);
            });
        },
        editarFoto() {
            this.$refs.modalEdicaoFotos.editar(this.imagem);
        }
    }
}
</script>

<style>
    #container-foto-selecionada > img {
        max-width: 80vw;
        border-radius: 10px;
    }
    #container-botoes-manipulacao-dados-foto {
        float: right;
    }

    #container-botoes-manipulacao-dados-foto > button {
        margin: 0 0.5rem;
    }
</style>