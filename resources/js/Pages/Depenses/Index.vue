<template>
    <Head title="Liste des depenses"/>
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
                        <h2 class="col-lg-10 text-center col-md-12">Liste des depenses</h2>
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
                                                    aria-label="Browser: activate to sort column ascending">Date </th>
    
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Type</th> <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Montant</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                    Note</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                   Etat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="depense in depenses.data" :key="depense.id" class="">
                                                <td class="text-center">{{moment(depense . created_at) . format('DD/MM/YYYY') }}</td>
                                                <td class="text-center"> {{ depense .type}}
                                                                     </td>
                                                <td class="text-center">
                                                    <div>{{ depense . montant }}</div>
                                                </td>
                                                <td class="text-center">
                                                    <div>{{ depense . note }}</div>
                                                </td>
                                                <td class="text-center">
                                                    <div  v-if="depense.etat == 'en cours'" class="badge badge-warning">{{ depense . etat}}</div>
                                                    <div v-if="depense.etat == 'validé'"  class="badge badge-success">{{ depense . etat}}</div>
                                                    <div v-if="depense.etat == 'annuler'"  class="badge badge-success">{{ depense . etat}}</div>
                                                </td>
    
                                                <td v-if="depense.etat == 'en cours'" class="text-center">
                                                    <Link type="button" method="delete" :href="`/depense/${depense.id}/annuler-depense/`"  data-id="7"
                                                    data-placement="bottom" title=""
                                                    class="btn btn-icon btn-danger data-supprimer"
                                                    data-original-title="Supprimer"><i class="fas fa-trash"></i></Link>
                                                <Link type="button"  method="post" :href="`/depense/${depense.id}/valider-depense/`" data-toggle="tooltip" data-id="7"
                                                    title=""
                                                    class="btn btn-icon btn-success data-valider"
                                                    data-original-title="Valider"><i class="fas fa-check"></i></Link>
    
                                                </td>
    
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12" style="float:left;">
                                    <Pagination :links="depenses.links"/>
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
            depenses:Object
        },
        data() {
        return {
          moment:moment,
        }
    }
    }

</script>

