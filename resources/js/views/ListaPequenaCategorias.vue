<template>
    <ul class="lista-categorias" :key="categoria.id" v-for="categoria in categorias">
        <li>
            <a :href="'/fotografo?categorias[]=' + categoria.id" class="btn bg-yellow">
                {{categoria.nome}}
            </a>
        </li>
    </ul>
</template>

<script>

export default {
    data: () => {
        return {
            categorias: []
        }
    },

    props: ['categorias']
}
</script>

<style>

.lista-categorias ul {
    list-style: none;
}

.lista-categorias ul li {
    display: inline;
}
</style>