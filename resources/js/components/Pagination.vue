<template>
    <div v-if="links.length > 2" class="flex flex-wrap mb-1">
        <template v-for="link in links" :key="link.id">
            <a class="mr-1 mb-1 px-4 py-3 text-md leading-4 border rounded hover:bg-primary"
            :class="{ 'bg-primary text-white': link.active }"
           :href="link.url" v-html="link.label"
        ></a>

        </template>
    </div>
</template>

<script>

export default {
    props: ['links']
}
</script>
