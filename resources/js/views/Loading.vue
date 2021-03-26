<template>
    <div v-show="isLoading" id="loading-container">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'isLoading'
    ],
    data() {
        return {
            isLoading: false
        }
    },
    methods: {
        showLoading() {
            this.isLoading = true;
        },
        hideLoading() {
            this.isLoading = false;
        },
    }
}
</script>

<style>
    #loading-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
</style>