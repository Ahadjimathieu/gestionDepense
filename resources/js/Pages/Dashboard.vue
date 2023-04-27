<template>
    <layout>

        <Head title="Tableau de bord" />

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Solde de la caisse</span>
                                <span class="info-box-number">
                                    {{soldeCaisse}}
                                    <small>FCFA</small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Depenses</span>
                                <span class="info-box-number">
                                    {{depense}}
                                    <small>FCFA</small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Paiement de facture</span>
                                <span class="info-box-number"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">New Members</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="font-size:10px;">
                    <div class="col-xl-12 col-lg-12">


                    </div>


                    <div class="col-xl-4 col-lg-4">
                        <div class="card">
                            <div class="card-body card-type-3">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-0">
                                            <font color="red">Commande (Ventes au comptant)</font>
                                        </h6>

                                        <h6 class="text-muted mt-2 mb-0">Nombre de commande  :  {{commandeTotal}}</h6>

                                        <h6 class="text-muted mt-2 mb-0">Nombre de commande livrée :  {{commandeLivre}}</h6>

                                        <h6 class="text-muted mt-2 mb-0">Nombre de commande non-livrée : {{commandeNonLivre}}</h6>

                                        <h6 class="text-muted mt-2 mb-0">Total commandes : <div
                                                class="badge badge-success badge-shadow"> {{ montantTotal }} FCFA </div>
                                        </h6>
                                        

                                       
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="card">
                            <div class="card-body card-type-3">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-0">
                                            <font color="red">Facture </font>
                                        </h6>

                                        <h6 class="text-muted mt-2 mb-0">Nombre de facture : {{factureTotal}}</h6>

                                        <h6 class="text-muted mt-2 mb-0">Nombre de facture réglée : {{factureRegle}}</h6>

                                        <h6 class="text-muted mt-2 mb-0">Nombre de facture non-régler : {{factureNonRegle}}</h6>

                                        <h6 class="text-muted mt-2 mb-0">Total facture : <div
                                                class="badge badge-success badge-shadow"> {{montantTotalFacture}} FCFA </div>
                                        </h6>
                                       
                                        <span class="font-weight-bold mb-0"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body card-type-3">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-0">
                                            <font color="blue"> Dépenses </font>
                                        </h6>
                                        <h6 class="text-muted mt-2 mb-0">Entrée/Appro caisse <span class="text-nowrap">
                                                <div class="badge badge-info badge-shadow"> {{approCaisse.montant}}  FCFA</div>
                                            </span></h6>
                                        <h6 class="text-muted mt-2 mb-0">Salaires <span class="text-nowrap">
                                                <div class="badge badge-warning badge-shadow"> {{salaire}} FCFA</div>
                                            </span></h6>
                                        <h6 class="text-muted mt-2 mb-0">Paiement prestataire <span class="text-nowrap">
                                                <div class="badge badge-danger badge-shadow"> {{prestataire}} FCFA</div>
                                            </span></h6>
                                            <h6 class="text-muted mt-2 mb-0">Autre <span class="text-nowrap">
                                                <div class="badge badge-success badge-shadow"> {{autre}} FCFA</div>
                                            </span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6" hidden>
                        <div class="card">
                            <div class="card-body card-type-3">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-0">
                                            <font color="red">Achats fournisseurs</font>
                                        </h6>
                                        <h6 class="text-muted mt-3 mb-0">Produit fini : <div
                                                class="badge badge-primary badge-shadow">20 000 </div>
                                        </h6>
                                        <h6 class="text-muted mt-3 mb-0">Matière première : <div
                                                class="badge badge-info badge-shadow">0 </div>
                                        </h6>
                                        <h6 class="text-muted mt-3 mb-0">Emballage : <div
                                                class="badge badge-warning badge-shadow">0 </div>
                                        </h6>
                                        <h6 class="text-muted mt-3 mb-0">Total achats : <div
                                                class="badge badge-success badge-shadow">20 000 </div>
                                        </h6>

                                        <span class="font-weight-bold mb-0"></span>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </layout>
</template>

<script>
    import Layout from '../components/MainLayout.vue'
    export default {
        layout: Layout,

        props:{
            // Depenses
           depense: Object,
           prestataire: Object,
           salaire: Object,
           autre: Object,
           soldeCaisse: Object,
           approCaisse: Object,
           //Commandes
           commandeTotal: Object,
           commandeLivre: Object,
           commandeNonLivre: Object,
           montantTotal: Object,
           // Facture
           factureTotal: Object,
           factureRegle: Object,
           factureNonRegle: Object,
           montantTotalFacture: Object,
        },
        data() {
        return {
           
            }
        },
    }
</script>
