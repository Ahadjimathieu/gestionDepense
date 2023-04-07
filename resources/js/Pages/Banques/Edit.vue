<template>

    <Head title="Banques" />
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
                    <h3>Modification d'une banque</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="update">
                        <div class="col-6">
                            <label for="inputName" class="form-label">Nom</label>
                            <input v-model="form.nom" required type="text" class="form-control" id="inputName">
                        </div>
                        <div class="col-6">
                            <label for="inputFirstname" class="form-label">solde</label>
                            <input v-model="form.solde" required type="text" class="form-control"
                                id="inputFirstname">
                        </div>



                        <br>
                        <div class="card-footer mt-4">
                            <Link href="/banque" class="btn btn-danger">Annuler</Link>
                            <button type="submit" class="btn btn-success float-right">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-lg-10 offset-1 col-md-12">
                <div class="">
                    <h2 class="text-center">Liste des Banques</h2>
                </div>

                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dt-buttons btn-group flex-wrap">

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="example1_filter" style="float:right;" class="dataTables_filter">
                                    <label>Search:<input type="search" class="form-control form-control-sm"
                                            placeholder="" aria-controls="example1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending">
                                                Nom</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending">
                                                Solde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="banque in banques" :key="banque.id" class="">
                                            <td class="text-center">{{ banque.nom }}</td>
                                            <td class="text-center">{{ banque.solde }}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12" style="float:left;" >
                               <!-- <Pagination :links="agents.links"/>  -->
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

    export default {
        layout: Layout,

        props: {
            banque: Object,
            banques: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    nom: this.banque.nom,
                    solde: this.banque.solde,
                }),
            }
        },
        methods: {
            update() {
                this.form.put(`/banque/${this.banque.id}`)
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Banque modifié avec succes',
                    showConfirmButton: false,
                    timer: 5000
                });
            },
        },

    }
</script>
