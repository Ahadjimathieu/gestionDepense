<template>
    <Head title="Nouvel utilisateur"/>
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
                    <div style="margin:20px;" >
                        <h3>Enregistrement d'un nouvel utilisateur</h3>
                        <div class="d-flex mb-2">
                            <h2 class="card-title flex-grow-1"> </h2>
                        </div>
                        <form class="row g-3" @submit.prevent="store">
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
                                    class="form-label">Email</label>
                                <input  v-model="form.email" :class="{ 'is-invalid': errors.email }" type="email"
                                    class="form-control"
                                    id="inputFirstname">
                            </div>
                            <div class="col-4">
                                <label for="inputFirstname"
                                    class="form-label">Mot de passe</label>
                                <input v-model="form.password" :class="{ 'is-invalid': errors.password }" type="password"
                                    class="form-control"
                                    id="inputFirstname" >
                            </div>

                            <div class="col-4">
                                <label for="inputName" class="form-label">Rôle</label>
                                <select v-model="form.role" class="form-control form-select" id=""
                                    :class="{ 'is-invalid': errors.role }" aria-label=".form-select-lg example">
                                    <option value="">Selectionner </option>
                                    <option value="Admin">Admin </option>
                                    <option value="Superadmin">Superadmin </option>
    
                                </select>
                            </div>
                           <br>
                           <div class="card-foote r">
                            <Link href="/client" class="btn btn-danger float-right">Annuler</Link>
                            <button type="submit"  class="btn btn-success float-end ">Enregistrer</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="card col-lg-10 offset-1 col-md-12">
                    <div class="">
                        <h2 class="text-center">Liste des utilisateurs</h2>
                    </div>

                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dt-buttons btn-group flex-wrap">

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6" >
                                    <form>
                                        <div id="example1_filter"  style="float:right;" class="dataTables_filter"><label>Search:<input
                                            type="text"   class="form-control form-control-sm" name="search"   placeholder=""
                                            aria-controls="example1"></label></div>
                                    </form>

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
                                                   Email</th>
                                                   <th class="text-center" tabindex="0" aria-controls="example1"
                                                   rowspan="1" colspan="1">
                                                   Rôle</th>  
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" >Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="utilisateur in utilisateurs.data" :key="utilisateur.id" class="">
                                                <td class="text-center" >{{utilisateur.nom}}</td>
                                                <td class="text-center" >{{utilisateur.prenom}}</td>
                                                <td class="text-center" >{{utilisateur.email}}</td>
                                                <td class="text-center" >{{utilisateur.role}}</td>
                                                <td class="text-center">
                                                    <Link :href="`/utilisateur/${utilisateur.id}/edit`" class="btn
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
                                   <Pagination :links="utilisateurs.links"  />
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
            utilisateurs:Object,
            errors: Object,
        },

        data() {
        return {
        }
    },
    
    methods: {
       
    }


    }
</script>
<script setup>
   import Pagination from '../../components/Pagination.vue'

    import {reactive} from 'vue'
    import {router} from '@inertiajs/vue3'
    let form =  reactive({
        nom:null,
        prenom:null,
        email:null,
        password:null,
        role:null,

    })

    let store = () => {
        router.post('/utilisateur',form)

            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Utilisateur enregistré avec succes',
            showConfirmButton: false,
            timer: 5000
            });
        
           
    }

</script>
