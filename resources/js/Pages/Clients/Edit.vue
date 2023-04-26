<template>
    <Head title="Client edit"/>
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
                    <div class="" style="margin:20px;" >
                        <h3>Modification des informations d'un client</h3>
                        <div class="d-flex mb-2">
                            <h2 class="card-title flex-grow-1"> </h2>
                        </div>
                        <form class="row g-3" @submit.prevent="update">
                            <div class="col-4">
                                <label for="inputName"
                                    class="form-label">Nom(s)</label>
                                <input  v-model="form.nom" :class="{ 'is-invalid': errors.nom }" type="text"
                                    class="form-control"
                                    id="inputName">
                            </div>
                            <div class="col-4">
                                <label for="inputFirstname"
                                    class="form-label">Prénom(s)</label>
                                <input v-model="form.prenom" :class="{ 'is-invalid': errors.prenom }" type="text"
                                    class="form-control"
                                    id="inputFirstname">
                            </div>
                            <div class="col-4">
                                <label for="inputFirstname"
                                    class="form-label">Adresse</label>
                                <input  v-model="form.adresse" :class="{ 'is-invalid': errors.adresse }" type="text"
                                    class="form-control"
                                    id="inputFirstname">
                            </div>
                            <div class="col-4">
                                <label for="inputFirstname"
                                    class="form-label">Telephone</label>
                                <input v-model="form.telephone" :class="{ 'is-invalid': errors.telephone }" type="text"
                                    class="form-control"
                                    id="inputFirstname" max="11">
                            </div>


                           <br>
                           <div class="card-footer">
                                <Link href="/client" class="btn btn-danger">Annuler</Link>
                                <button type="submit"  class="btn btn-success float-right">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>

               <div class="card col-lg-10 offset-1 col-md-12">
                    <div class="col-lg-10 offset-5 col-md-12">
                        <h2 class="">Liste des Clients</h2>
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
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Prenom (s)</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                   Adresse</th>
                                                   <th class="text-center" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                   Telephone</th>  <th class="sorting" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                   Date de creation</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" >Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="client in clients" :key="client.id" class="">
                                                <td>{{client.nom}}</td>
                                                <td>{{client.prenom}}</td>
                                                <td>{{client.adresse}}</td>
                                                <td>{{client.telephone}}</td>
                                                <td>{{moment(client.created_at).format("DD-MM-YYYY")}}</td>
                                                <td class="text-center">
                                                    <Link :href="`/client/${client.id}/edit`" class="btn
                                                    btn-btn-icon btn-primary"><i
                                                        class="fas
                                                        fa-edit"></i></Link>
                                                    <button class="btn
                                                        btn-btn-icon btn-danger"><i
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

<script>
    import Layout from '../../components/MainLayout.vue'
    import moment from "moment";
    export default {
        layout: Layout,

        props:{
            client:Object,
            clients:Object,
            errors: Object,
        },
        data() {
        return {
            moment: moment,
            form: this.$inertia.form({
                nom: this.client.nom,
                prenom: this.client.prenom,
                adresse: this.client.adresse,
                telephone: this.client.telephone,
            }),
        }
    },
    methods: {
            update() {
            this.form.put(`/client/${this.client.id}`)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Client modifié avec succes',
                showConfirmButton: false,
                timer: 5000
                    });
                    form.nom = "";
                    form.prenom = "";
                    form.adresse = "";
                    form.telephone = null
            },

           
        },

    }
</script>

