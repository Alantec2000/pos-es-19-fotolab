<template>
    <div class="modal-backdrop" v-show="isModalOpen">
        <div class="modal">
            <div class="modal-header">
                <slot name="header">
                </slot>
                <button class="btn-fechar-modal" @click="closeModal">X</button>
            </div>
            <div class="modal-body">
                <slot name="body">
                </slot>
            </div>
            <div class="modal-footer">
                <slot name="footer">
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isModalOpen: false,
        } 
    },
    emits: [
        'close-modal'
    ],
    methods: {
        showModal() {
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        }
    }
}
</script>

<style>
    .modal-backdrop {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal {
        background: #FFFFFF;
        box-shadow: 2px 2px 20px 1px;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        padding: 10px;
    }

    .modal-header {
        border-bottom: 1px solid lightgray;
        margin-bottom: 1rem;
        padding-bottom: 0.4rem;
    }

    .modal-footer {
        border-top: 1px solid lightgray;
        margin-top: 1rem;
        padding-top: 0.7rem;
    }

    .btn-fechar-modal {
        float: right;
        background-color: white;
        border-style: solid;
        border-radius: 100%;
        width: 25px;
        height: 25px;
        font-weight: 700;
    }
</style>