<template>
    <Head title="Clients"/>
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
                        <h2 class="col-lg-10 offset-4 col-md-12">Liste des Clients</h2>
                    </div>

                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dt-buttons btn-group flex-wrap"><Link
                                            class="btn btn-primary"
                                            href="/client/create" > <i class="fa fa-user-plus" ></i> Ajouter un nouveau client</Link>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6" >
                                    <div id="example1_filter"  style="float:right;" class="dataTables_filter"><label>Search:<input
                                              v-model="search"  type="text" class="form-control form-control-sm" placeholder=""
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
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    Nom</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Prenom (s)</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                   Adresse</th>
                                                   <th class="sorting" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                   Telephone</th>  <th class="sorting" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                   Date de creation</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" >Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="client in clients.data" :key="client.id" class="">
                                                <td class="text-center">{{client.nom}}</td>
                                                <td class="text-center">{{client.prenom}}</td>
                                                <td class="text-center">{{client.adresse}}</td>
                                                <td class="text-center">{{client.telephone}}</td>
                                                <td class="text-center">{{moment(client.created_at).format("DD/MM/YYYY")}}</td>
                                                <td class="text-center">
                                                    <Link :href="`/client/${client.id}/edit`" class="btn
                                                        btn-link"><i
                                                            class="fas
                                                            fa-edit"></i></Link>
                                                    <button class="btn
                                                        btn-link"><i
                                                            class="fas
                                                            fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="col-sm-12" style="float:left;" >
                                   <Pagination :links="clients.links"/>
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
    import {ref, watch} from 'vue'

    let  search = ref('')

    watch(search, value => {
        console.log('changed', + value);
});
</script>
<script>
    import Layout from '../../components/MainLayout.vue'
    import moment from "moment";

    export default {
        layout: Layout,

        props:{
            clients:Object
        },
        data() {
        return {
            moment: moment
        }
    }
    }

</script>

