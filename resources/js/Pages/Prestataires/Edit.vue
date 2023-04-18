<template>

    <Head title="Prestataire" />
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
                <div style="margin:20px;">
                    <h3>Modification des informations du prestataire agent</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="update">
                        <div class="col-12">
                            <label for="inputName" class="form-label">nom</label>
                            <input v-model="form.nom" :class="{ 'is-invalid': errors.nom }" type="text" class="form-control" id="inputName">
                        </div>

                        <div class="col-6">
                            <button type="submit" class="btn btn-success ">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-lg-10 offset-1 col-md-12">
                <div class="">
                    <h2 class="text-center">Liste des prestataires</h2>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dt-buttons btn-group flex-wrap">

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6" >
                                <div id="example1_filter"  style="float:right;" class="dataTables_filter"><label>Search:<input
                                            type="search" class="form-control form-control-sm" placeholder=""
                                            aria-controls="example1"></label></div>
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
                                                Nom</th>
                                             <th class="sorting" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                               Date de creation</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" >Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="prestataire in prestataires"  :key="prestataire.id" class="">
                                            <td class="text-center" >{{prestataire.nom}}</td>
                                            <td class="text-center" >{{moment(prestataire . created_at) . format('DD/MM/YYYY') }}</td>
                                            <!-- {{moment(agent.created_at).format("DD-MM-YYYY")}} -->
                                            <td class="text-center">
                                                <Link  :href="`/prestataire/${prestataire.id}/edit`" class="btn
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
                               <!-- <Pagination :links="prestataires.links"/>  -->
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
            prestataire: Object,
            prestataires: Object,
            errors: Object,
        },
        data() {
            return {
                moment:moment,
                form: this.$inertia.form({
                    nom: this.prestataire.nom,
                   
                }),
            }
        },
        methods: {
            update() {
                this.form.put(`/prestataire/${this.prestataire.id}`)
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Prestataire modifié avec succes',
                    showConfirmButton: false,
                    timer: 5000
                });
                form.nom = "";
            },
        },

    }
</script>
