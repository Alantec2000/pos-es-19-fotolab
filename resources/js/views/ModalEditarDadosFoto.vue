<template>
    <Modal id="modal-editar-dados-fotos" ref="modal">
        <template v-slot:body>
            <label for="legenda-foto">Mostrar na sua página:</label>
            <input id="legenda-foto" name="mostrar_galeria" ref="mostrar_galeria" type="checkbox">
            <p/>
            <label for="legenda-foto">Legenda:</label><br>
            <input id="legenda-foto" name="legenda" ref="legenda" type="text" placeholder="legenda">
            <p/>
        </template>
        <template v-slot:footer>
            <button id="botao_salvar_dados_foto" :disabled="salvando" ref="botao_salvar" @click="salvarDados" class="btn bg-yellow">
                Salvar
            </button>
        </template>
    </Modal>
</template>

<script>
import Modal from './Modal';

export default {
    data() {
        return {
            salvando: false,
            imagem: {
            },
        }
    },
    props: [
        'imagem'
    ],
    components: {
        Modal
    },
    methods: {
        editar(imagem) {
            this.imagem = imagem;
            this.$refs.legenda.value = imagem.meta_data.legenda || '';
            this.$refs.mostrar_galeria.checked = imagem.meta_data.mostrar_galeria;
            this.$refs.modal.showModal();
        },
        fechar() {
            this.$refs.legenda.value = '';
            this.$refs.mostrar_galeria.checked = false;
            this.$refs.modal.closeModal();
        },
        salvarDados() {
            let dados = new FormData();
            dados.append('mostrar_galeria', this.$refs.mostrar_galeria.checked);
            dados.append('legenda', this.$refs.legenda.value);
            
            this.salvando = true;
            axios.post('/api/fotografo/portfolio/' + this.imagem.id, dados)
            .then((resposta) => {
                this.salvando = false;
                this.imagem.metadata = resposta.data;  
                this.fechar();
                this.$toast.success('Dados da foto foram atualizados com sucesso!');
            })
            .catch((error) => {
                this.salvando = false;
                console.error(error);
                this.$toast.error("Ocorreu um erro ao tentar atualizar os dados dessa foto!");
            });
        }
    }
}
</script>

<style>
    #modal-editar-dados-fotos > .modal {
        width: 40vw;
    }

    #botao_salvar_dados_foto {
        float: right;
    }
</style>