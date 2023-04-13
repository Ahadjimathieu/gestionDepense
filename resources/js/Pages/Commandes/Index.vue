<template>
    <Head title="Liste des commandes"/>
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
                <div class="card col-lg-10 offset-1 col-md-12">
                    <div class="card-header">
                        <h2 class="col-lg-10 text-center col-md-12">Liste des Commandes</h2>
                    </div>

                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    
                                </div>
                                <div class="col-sm-12 col-md-6" >
                                    <div id="example1_filter"  style="float:right;" class="dataTables_filter"><label>Search:<input
                                               type="text" class="form-control form-control-sm" placeholder=""
                                               ></label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1"
                                        class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    N° commande</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Client</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                  Montant</th>
                                                  <th class="text-center" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                   Date de creation</th>
                                                   <th class="text-center" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                  Validation</th> 
                                                  <th class="text-center" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                  Livraison</th> 
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" >Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="commande in commandes.data" :key="commande.id" class="">
                                                <td class="text-center">{{commande.numero_commande}}</td>
                                                <td class="text-center">{{commande.client.nom}}      {{commande.client.prenom }}</td>
                                                <td class="text-center">{{commande.total}}</td>
                                                <td class="text-center">{{moment(commande.created_at).format("DD/MM/YYYY")}}</td>
                                                <td v-if="commande.validation == 'en attente'" class="text-center"> <div class="badge badge-warning">{{commande.validation}}</div></td>
                                                <td v-if="commande.validation == 'validé'" class="text-center"> <div class="badge badge-success">{{commande.validation}}</div></td>
                                                <td v-if="commande.livraison == 'non-livrer'" class="text-center"> <div class="badge badge-warning">{{commande.livraison}}</div></td>
                                                <td v-if="commande.livraison == 'livrée'" class="text-center"> <div class="badge badge-success">{{commande.livraison}}</div></td>
                                                <td v-if="commande.livraison == 'non-livrer'" class="text-center m-3">
                                                    <Link title="Detail de la commande"  :href="`/commande/${commande.id}/detail-commande/`" type="button" class="btn
                                                        btn-icon  btn-info"><i
                                                            class="fas fa-info"></i></Link>
                                                            <Link  type="button" method="post" :href="`/commande/${commande.id}/valider-livraison/`" title="Valider la livraison" class="btn
                                                        btn-icon btn-success"><i
                                                            class="fas
                                                            fa-check"></i></Link>
                                                    <button class="btn
                                                        btn-link"><i
                                                            class="fas
                                                            fa"></i></button>
                                                </td>
                                                <td v-if="commande.livraison == 'livrée'" class="text-center m-3">
                                                    <Link title="Detail de la commande"  :href="`/commande/${commande.id}/detail-commande/`" type="button" class="btn
                                                        btn-icon  btn-info"><i
                                                            class="fas fa-info"></i></Link>
            
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="col-sm-12" style="float:left;" >
                                   <Pagination :links="commandes.links"/> 
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


</template>

<script setup>
    import Pagination from '../../components/Pagination.vue'

</script>
<script>
    import Layout from '../../components/MainLayout.vue'
    import moment from "moment";

    export default {
        layout: Layout,

        props:{
            commandes:Object
        },
        data() {
        return {
          moment:moment,
        }
    }
    }

</script>

