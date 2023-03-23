<template>
    <div class="wrapper">
       <Nav/>
       <Header/>

        <div class="content-wrapper">

            <slot/>

        </div>


        <aside class="control-sidebar control-sidebar-dark">

            <div class="p-3">
                <h5>{{user.nom}} {{user.prenom}}</h5>
               
            </div>
        </aside>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
</template>

<script setup>
    import Header from '../components/NavBar.vue'
    import Nav from '../components/TopNav.vue'
    import {usePage} from '@inertiajs/vue3'
    import {computed} from 'vue'
    const user = computed(() =>{
        return usePage().props.auth.user
    })
</script>
