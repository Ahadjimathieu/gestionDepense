<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <Link href="/" class="brand-link">
        <img src="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE </span>
        </Link>
        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="btn btn-icon btn-info">
                    <i class="fas fa-user"></i>
                </div>
                <div class="info">
                    <div class="d-block text-light fw-bold">{{ user . nom }} {{ user . prenom }}</div>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <Link href="/" class="nav-link" :class="{ 'active': $page.url === '/' }">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Tableau de bord</p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link href="" class="nav-link" :class="{ 'active': $page.url === '/client/create' || $page.url === '/facture/create' || $page.url === '/facture' || $page.url === '/paiement/regler' || $page.url === '/paiement' || $page.url === '/banque' }">
                        <i class="nav-icon fas fa-file-invoice fa-xl"></i>
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
                                <Link href="/facture/create" class="nav-link"
                                    :class="{ 'active': $page.url === '/facture/create' }">
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
                                <Link href="/paiement/regler" class="nav-link"
                                    :class="{ 'active': $page.url === '/paiement/regler' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Régler une facture</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/paiement" class="nav-link"
                                    :class="{ 'active': $page.url === '/paiement' }">
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
                        <Link href="" class="nav-link"  :class="{ 'active': $page.url === '/caisse' || $page.url === '/agent/create' || $page.url === '/depense'|| $page.url === '/depense/create' || $page.url === '/prestataire' }">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Depense
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </Link>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <Link href="/caisse" class="nav-link" :class="{ 'active': $page.url === '/caisse' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Initialiser la caisse</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/agent/create" class="nav-link"
                                    :class="{ 'active': $page.url === '/agent/create' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nouvel agent /Liste</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/depense/create" class="nav-link"
                                    :class="{ 'active': $page.url === '/depense/create' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nouvelle depense</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/depense" class="nav-link" :class="{ 'active': $page.url === '/depense' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des depense</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/prestataire" class="nav-link"
                                    :class="{ 'active': $page.url === '/prestataire' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nouveau prestataire / Liste</p>
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <Link href="" class="nav-link"  :class="{ 'active': $page.url === '/produit/create' || $page.url === '/commande/create' || $page.url === '/commande' || $page.url === '/commande/livraison'}">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Commande
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </Link>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <Link href="/produit/create" class="nav-link"
                                    :class="{ 'active': $page.url === '/produit/create' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveau produit/Liste</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/commande/create" class="nav-link"
                                    :class="{ 'active': $page.url === '/commande/create' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouvelle commande</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/commande/livraison" class="nav-link"
                                    :class="{ 'active': $page.url === '/commande/livraison' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Validation de la livraison</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/commande" class="nav-link"
                                    :class="{ 'active': $page.url === '/commande' }">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liste des commandes</p>
                                </Link>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <Link href="" class="nav-link"   :class="{ 'active': $page.url === '/virement/create' || $page.url === '/virement' || $page.url === '/utilisateur' }">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Banque
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </Link>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <Link href="/virement/create" class="nav-link"
                                    :class="{ 'active': $page.url === '/virement/create' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveau virement</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link href="/virement" class="nav-link"
                                    :class="{ 'active': $page.url === '/virement' }">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Liste des virements</p>
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <li v-if="user.role == 'Superadmin'" class="nav-item">
                        <Link href="/utilisateur" class="nav-link"
                            :class="{ 'active': $page.url === '/utilisateur' }">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Utilisateurs</p>
                        </Link>
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
