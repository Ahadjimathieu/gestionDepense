<template>

    <Head title="Client create" />
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-center"></h1>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">

            <div class="card col-lg-10 offset-1 col-md-12">
                <div class="">
                    <h2 class="text-start">Detail(s) de la facture</h2>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dt-buttons btn-group flex-wrap">

                                </div>
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
                                                N° </th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending">Designation</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                              Quantité</th>
                                               <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                             Prix Unitaire (en fcfa)</th>  <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                              Montant total (en fcfa)</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" >Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(detail, index) in details" :key="detail.id" class="">
                                            <td class="text-center">{{index}}</td>
                                            <td class="text-center">{{detail.designation}}</td>
                                            <td class="text-center">{{detail.qantite}}</td>
                                            <td class="text-center">{{detail.prix_unit}}</td>
                                            <td class="text-center">{{detail.total}}</td>
                                            <td class="text-center m-3">
                                                <button class="btn
                                                    btn-icon btn-danger"><i
                                                        class="fas
                                                        fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div style="float:right;" >
                                <button class="btn btn-icon btn-info"><i
                                                        class="fas
                                                        fa-print"></i> Imprimer la facture </button>
                                <!-- <Pagination :links="clients.links"/>  -->
                            </div>
                            <div  >
                                <Link class="btn btn-icon btn-danger"><i
                                                        class="fas
                                                        fa-times"></i> Retour à la liste </Link>
                                <!-- <Pagination :links="clients.links"/>  -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '../../components/MainLayout.vue'
    import moment from "moment";

    export default {
        layout: Layout,
        props: {

            details:Object,
        },

        data() {
            return {
            }
        },
        methods:{
                }


    }
</script>


