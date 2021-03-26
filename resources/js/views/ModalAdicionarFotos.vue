<template>
    <Modal ref="modal">
        <template v-slot:header>
            <h3 id="modal-adicionar-fotos-header">
                Adicionar fotos
            </h3>
        </template>
        <template v-slot:body>
            <form action="fotografo/portfolio/adicionar">
                <input id="fotosParaAdicionar" ref="fotos" multiple type="file" name="fotosParaAdicionar"/>
            </form>
        </template>
        <template v-slot:footer>
            <button id="btn-salvar-fotos" :disabled="salvandoFotos" class="btn bg-yellow" @click.prevent="salvarFotos">
                Salvar
            </button>
        </template>
    </Modal>
</template>

<script>
import Modal from './Modal';

export default {
    data: () => {
        return {
            salvandoFotos: false
        }
    },
    emits: [
        'recarregarPortfolio'
    ],
    components: {
        Modal
    },
    methods: {
        salvarFotos() {
            if (this.$refs.fotos.files.length === 0) {
                this.$toast.error('Nenhum arquivo informado!');
                return false;
            }

            this.disableSubmitButton();

            let formData = new FormData();
            for( var i = 0; i < this.$refs.fotos.files.length; i++ ){
                let foto = this.$refs.fotos.files[i];

                formData.append('fotos[' + i + ']', foto);
            }

            axios.post(
                "/api/fotografo/portfolio/atualizar",
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then((response) => {
                this.enableSubmitButton();
                this.$refs.modal.closeModal();
                this.$refs.fotos.value = '';
                this.$emit('recarregarPortfolio');
                this.$toast.success('Fotos adicionadas com sucesso!');
            }).catch ((error) => {
                console.log(error);
                this.enableSubmitButton();
            });
        },
        disableSubmitButton() {
            this.salvandoFotos = true;
        },
        enableSubmitButton() {
            this.salvandoFotos = false;
        },
    },
}
</script>

<style scoped>
    #modal-adicionar-fotos-header {
        margin: 0;
        display: inline-block;
    }

    #btn-salvar-fotos {
        float: right;
    }
</style>