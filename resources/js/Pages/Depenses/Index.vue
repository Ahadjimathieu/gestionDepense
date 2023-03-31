<template>
    <Head title="Liste des factures"/>
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
                <div class="card col-lg-10 offset-1 col-md-10">
                    <div class="card-header">
                        <h2 class="col-lg-10 offset-4 col-md-12">Liste des Depenses</h2>
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
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Facture</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Client</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Note</th> <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Etat</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Date paiement</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Montant réglé</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1">Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="paiement in paiements.data" :key="paiement.id" class="">
                                                <td class="text-center">{{ paiement . facture . numero_facture }}</td>
                                                <td class="text-center">{{ paiement . facture . client . nom }}
                                                    {{ paiement . facture . client . nom }}</td>
                                                <td class="text-center">
                                                    <div class="badge badge-primary">{{ paiement . note }}</div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="badge badge-success">{{ paiement . etat }}</div>
                                                </td>
                                                <td class="text-center">
                                                    {{ moment(paiement . created_at) . format('DD-MM-YYYY-hh') }}</td>
                                                <td class="text-center">{{ paiement . montant_paiement }}</td>
                                                <td  class="text-center">
                                                    <Link type="button"
                                                        href=""
                                                        data-toggle="tooltip" title=""
                                                        class="btn btn-icon btn-info" data-original-title="Détails"><i
                                                            class="fas fa-info"></i></Link>
                                                        <Link type="button" target="_blank"
                                                        href=""
                                                        class="btn btn-icon btn-warning"><i class="fas fa-print"></i></Link>
                                                    </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12" style="float:left;">
                                    <Pagination :links="paiements.links"/>
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
            paiements:Object
        },
        data() {
        return {
          moment:moment,
        }
    }
    }

</script>

