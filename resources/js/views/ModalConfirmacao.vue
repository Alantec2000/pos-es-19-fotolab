<template>
    <Modal ref="modal">
        <template v-slot:body>
            <span>
                Você deseja realmente fazer isso?
            </span>
        </template>
        <template v-slot:footer>
            <div id="botoes-confirmacao">
                <button class="btn bg-green" @click="fecharModal($event, 'confirmar')">Sim</button>
                <button class="btn bg-red" @click="fecharModal($event, 'negar')">Não</button>
            </div>
        </template>
    </Modal>
</template>

<script>
import Modal from './Modal';

export default {
    components: {
        Modal
    },
    emits: [
        'confirmar',
        'negar'
    ],
    methods: {
        fecharModal($event, estado) {
            this.$refs.modal.closeModal();
            this.$emit(estado, $event);
        }
    }
}
</script>

<style>
    #botoes-confirmacao {
        float: right;
    }
</style>