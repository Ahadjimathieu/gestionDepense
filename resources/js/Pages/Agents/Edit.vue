<template>

    <Head title="Agents" />
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
                    <h3>EModification des information de l'agent</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="update">
                        <div class="col-4">
                            <label for="inputName" class="form-label">Nom(s)</label>
                            <input v-model="form.nom"  type="text" :class="{ 'is-invalid': errors.nom }" class="form-control" id="inputName">
                        </div>
                        <div class="col-4">
                            <label for="inputFirstname" class="form-label">Prénom(s)</label>
                            <input v-model="form.prenom"  type="text" :class="{ 'is-invalid': errors.prenom }" class="form-control"
                                id="inputFirstname">
                        </div>
                        <div class="col-4">
                            <label for="inputFirstname" class="form-label">Adresse</label>
                            <input v-model="form.adresse"  type="text" :class="{ 'is-invalid': errors.adresse }" class="form-control"
                                id="inputFirstname">
                        </div>
                        <div class="col-4">
                            <label for="inputFirstname" class="form-label">Telephone</label>
                            <input v-model="form.telephone"  type="text" :class="{ 'is-invalid': errors.telephone }" class="form-control"
                                id="inputFirstname" max="11">
                        </div>
                        <div class="col-4">
                            <label for="inputFirstname" class="form-label">Date embauche</label>
                            <input v-model="form.date_embauche"  type="date" :class="{ 'is-invalid': errors.date_embauche }" class="form-control"
                                id="inputFirstname" max="11">
                        </div>


                        <br>
                        <div class="card-footer">
                            <Link href="/agent" class="btn btn-danger">Annuler</Link>
                            <button type="submit" class="btn btn-success float-right">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-lg-10 offset-1 col-md-12">
                <div class="">
                    <h2 class="text-center">Liste des Agents</h2>
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
                                                Prenom (s)</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Adresse</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Telephone</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Date embauche</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="agent in agents.data" :key="agent.id" class="">
                                            <td>{{ agent . nom }}</td>
                                            <td>{{ agent . prenom }}</td>
                                            <td>{{ agent . adresse }}</td>
                                            <td>{{ agent . telephone }}</td>
                                            <td>{{ agent . date_embauche }}</td>
                                            <!-- {{ moment(agent . created_at) . format('DD-MM-YYYY') }} -->
                                            <td class="text-center">
                                                <Link  :href="`/agent/${agent.id}/edit`" class="btn
                                                 btn-icon btn-primary"><i
                                                    class="fas
                                                    fa-edit"></i></Link>
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
                        <div class="row mt-3">
                            <div class="col-sm-12" style="float:left;" >
                               <Pagination :links="agents.links"/>
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
            agent: Object,
            agents: Object,
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    nom: this.agent.nom,
                    prenom: this.agent.prenom,
                    adresse: this.agent.adresse,
                    telephone: this.agent.telephone,
                    date_embauche: this.agent.date_embauche,
                }),
            }
        },
        methods: {
            update() {
                this.form.put(`/agent/${this.agent.id}`)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agent modifié avec succes',
                    showConfirmButton: false,
                    timer: 5000
                });  
                
                form = [];
            },
        },

    }
</script>
