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
                <div class="card col-lg-10 offset-1 col-md-12">
                    <div class="card-header">
                        <h2 class="col-lg-10 text-center col-md-12">Liste des Factures</h2>
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
                                                    N° fact</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Client</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                  Montant</th>
                                                   <th class="text-center" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                  Etat</th>  <th class="text-center" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                   Date de creation</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" >Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="facture in factures" :key="facture.id" class="">
                                                <td class="text-center">{{facture.numero_facture}}</td>
                                                <td class="text-center">{{facture.client.nom}}      {{facture.client.prenom }}</td>
                                                <td class="text-center">{{facture.montant}}</td>
                                                <td class="text-center"> <div class="badge badge-success">{{facture.etat}}</div></td>
                                                <td class="text-center">{{moment(facture.created_at).format("DD/MM/YYYY")}}</td>
                                                <td class="text-center m-3">
                                                    <Link title="Detail la facture"  :href="`/facture/${facture.id}/detail-facture/`" type="button" class="btn
                                                        btn-icon  btn-info"><i
                                                            class="fas fa-info"></i></Link>
                                                            <Link  type="button" @click="getPdf" title="imprimer la facture" class="btn
                                                        btn-icon btn-warning"><i
                                                            class="fas
                                                            fa-print"></i></Link>
                                                    <button class="btn
                                                    btn-icon"><i
                                                            class="fas
                                                            fa"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="col-sm-12" style="float:left;" >
                                   <!-- <Pagination :links="factures.links"/>  -->
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
            factures:Object
        },
        data() {
        return {
          moment:moment,
        }
    },
    methods: {
        getPdf() {
        window.open('/facture/liste', '_blank');
    }
    }
    }

</script>

