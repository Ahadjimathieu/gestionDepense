<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE </span>
        </a>
        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <Link href=""  class="nav-link" :class="{ 'active': $page.url === '' }"  >
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                               Clients
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </Link>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <Link href="/client/create" class="nav-link" :class="{ 'active': $page.url === '/client/create' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveau client</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/client" class="nav-link" :class="{ 'active': $page.url === '/client' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des clients</p>
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <Link href="" class="nav-link " :class="{ 'active': $page.url === '' }">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                               Agents
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </Link>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <Link href="/agent/create" class="nav-link" :class="{ 'active': $page.url === '/agent/create' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouvel agent</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/agent" class="nav-link" :class="{ 'active': $page.url === '/agent' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des agents</p>
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <Link href="" class="nav-link " :class="{ 'active': $page.url === '' }">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                               Facture
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </Link>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <Link href="/facture/create" class="nav-link" :class="{ 'active': $page.url === '/facture/create' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouvel facture</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/facture" class="nav-link" :class="{ 'active': $page.url === '/facture' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des agents</p>
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                               Caisse
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Paiement de salaire</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reglement de facture</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>autre depense</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                               Banque
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Paiement de salaire</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reglement de facture</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>autre depense</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                               Clients
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveau client</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des clients</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>

    </aside>
</template>
<script setup>
    import {
        usePage
    } from '@inertiajs/vue3'
    import {
        computed
    } from 'vue'
    const user = computed(() => {
        return usePage().props.auth.user
    })
</script>
