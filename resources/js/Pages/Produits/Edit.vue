<template>
    <Head title="Produit edit"/>
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
                        <h3>Modification des informations d'un produit</h3>
                        <div class="d-flex mb-2">
                            <h2 class="card-title flex-grow-1"> </h2>
                        </div>
                        <form class="row g-3" @submit.prevent="update">
                            <div class="col-4">
                                <label for="inputName"
                                    class="form-label">Désignation</label>
                                <input  v-model="form.designation" :class="{ 'is-invalid': errors.designation }" type="text"
                                    class="form-control"
                                    id="inputName">
                            </div>
                            <div class="col-2">
                                
                            </div>
                            <div class="col-4">
                                <label for="inputFirstname"
                                    class="form-label">Prix (m²)</label>
                                <input v-model="form.prix" :class="{ 'is-invalid': errors.prix }" type="number"
                                    class="form-control"
                                    id="inputFirstname">
                            </div>
                           <br>
                           <div class="card-footer">
                            <Link href="/produit"  class="btn btn-danger">retour à la liste</Link>
                            <button type="submit"  class="btn btn-success float-right">Modifier</button>
                        </div>
                        </form>
                    </div>
                </div>

               <div class="card col-lg-10 offset-1 col-md-12">
                    <div class="col-lg-10 offset-5 col-md-12">
                        <h2 class="">Liste des Produits</h2>
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
                                                    Désignation</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">Prix (m²)</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1">
                                                   Date de creation</th>
                                                <th class="text-center" tabindex="0" aria-controls="example1"
                                                    rowspan="1" >Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="produit in produits.data" :key="produit.id" class="">
                                                <td class="text-center" >{{produit.designation}}</td>
                                                <td class="text-center" >{{produit.prix}}</td>
                                                <td class="text-center" >{{moment(produit.created_at).format("DD-MM-YYYY")}}</td>
                                                <td class="text-center">
                                                    <Link :href="`/produit/${produit.id}/edit`" class="btn
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
                                   <Pagination :links="produits.links"/>
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
            produit:Object,
            produits:Object,
            errors: Object,
        },
        data() {
        return {
            moment: moment,
            form: this.$inertia.form({
                designation: this.produit.designation,
                prix: this.produit.prix
            }),
        }
    },
    methods: {
            update() {
            this.form.put(`/produit/${this.produit.id}`)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Produit modifié avec succes',
                showConfirmButton: false,
                timer: 5000
                    });
                    form.designation = "";
                    form.prix = "";
            },
        },

    }
</script>

