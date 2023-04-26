<template>
    <div class="wrapper">
       <Nav/>
       <Header/>

        <div class="content-wrapper">

            <slot/>

        </div>


        <aside class="control-sidebar control-sidebar-dark">
            <div class="card-body bg-dark box-profile">
                <div class="text-center">
                    <i class="fas fa-user"></i>
                </div>

                <h3 class="profile-username text-center ellipsis">{{user.nom}} {{user.prenom}}</h3>
                <p class="text-muted text-center"></p>
                <p class="text-muted text-center"></p>
                <ul class="list-group bg-dark mb-3">
                    <li class="list-group-item">
                    <i class="fa fa-lock pr-2"></i><b>Mot de passe</b>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-lock pr-2"></i><b>Mon profile</b>
                    </li>
                </ul>

                <Link class="btn btn-primary btn-block" href="/logout"  method="post" type="button">
                    Déconnexion
                </Link>

            </div>


        </aside>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
               
            </div>

            <strong>Copyright &copy; 2023  .</strong> All rights
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
