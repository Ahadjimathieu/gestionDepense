<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <Link href="/" class="brand-link">
            <img src=""  class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE </span>
        </Link>
        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="btn btn-icon btn-info">
                    <i class="fas fa-user"></i>
                </div>
                <div class="info">
                    <div  class="d-block text-light fw-bold">{{user.nom}} {{user.prenom}}</div>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
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
                                <Link href="/client/create" class="nav-link"
                                    :class="{ 'active': $page.url === '/client/create' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nouveau client / Liste</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/facture/create" class="nav-link" :class="{ 'active': $page.url === '/facture/create' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nouvelle facture</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/facture" class="nav-link" :class="{ 'active': $page.url === '/facture' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des factures</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/paiement/regler" class="nav-link" :class="{ 'active': $page.url === '/paiement/regler' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Régler une facture</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/paiement" class="nav-link" :class="{ 'active': $page.url === '/paiement' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des paiements</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/banque" class="nav-link" :class="{ 'active': $page.url === '/banque' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nouvelle banque / Liste</p>
                                </Link>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Depense
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="/caisse" class="nav-link" :class="{ 'active': $page.url === '/caisse' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Initialiser la caisse</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <Link href="/agent/create" class="nav-link" :class="{ 'active': $page.url === '/agent/create' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nouvel  agent /Liste</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/depense/create" class="nav-link" :class="{ 'active': $page.url === '/depense/create' }" >
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouvelle depense</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link  href="/depense" class="nav-link" :class="{ 'active': $page.url === '/depense' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des depense</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/prestataire" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveau prestataire / Liste</p>
                                </Link>
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
                                <a href="/virement/create" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveau virement</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/virement" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des virements</p>
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
