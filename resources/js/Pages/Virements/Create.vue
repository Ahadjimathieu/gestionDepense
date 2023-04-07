<template>

    <Head title=" Nouveau virement" />
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
                <div style="margin:20px;">
                    <h3>Enregistrement d'un nouveau virement</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="store">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="inputFirstname" class="form-label">Banque</label>
                                <select v-model="banque" class="form-control form-select" id="facture"
                                    :class="{ 'is-invalid': errors.banque }" required aria-label=".form-select-lg example">
                                    <option   value="">Selectionner la banque </option>
                                    <option v-for="banque in banques" :key="banque.id" :value="banque.id">
                                        {{ banque . nom }} </option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="inputFirstname" class="form-label">Type d'opération</label>
                            <select v-model="type" class="form-control form-select"
                                :class="{ 'is-invalid': errors.type }" id="facture"
                                aria-label=".form-select-lg example">
                                <option  value="">Selectionner le type d'opération </option>
                                <option value="depot">Dépôt </option>
                                <option value="retrait">Retrait </option>

                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for=""> Montant </label>
                                <input type="number" class="form-control" :class="{ 'is-invalid': errors.montant }"
                                    v-model="montant" id="montant">

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="reset" class="btn btn-icon icon-left btn-danger"><i
                                    class="fas fa-times"></i>
                                Annuler
                            </button>
                            <button class="btn btn-icon icon-left btn-primary float-right" type="submit"
                                id="addvente"><i class="fas fa-check"></i> Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-lg-10 offset-1 col-md-12">
                <div class="">
                    <h2 class="text-center">Liste des virements</h2>
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
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending">Date </th>

                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Type</th> <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Montant</th>

                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                               Etat</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="virement in virements.data" :key="virement.id" class="">
                                            <td class="text-center">{{moment(virement . created_at) . format('DD/MM/YYYY') }}</td>
                                            <td class="text-center"> {{ virement .type}}
                                                                 </td>
                                            <td class="text-center">
                                                <div>{{ virement . montant }}</div>
                                            </td>
                                            <td class="text-center">
                                                <div  v-if="virement.etat == 'en cours'" class="badge badge-warning">{{ depense . etat}}</div>
                                                <div v-if="virement.etat == 'validé'"  class="badge badge-success">{{ depense . etat}}</div>
                                                <div v-if="virement.etat == 'annuler'"  class="badge badge-success">{{ depense . etat}}</div>
                                            </td>

                                            <td v-if="depense.etat == 'en cours'" class="text-center">
                                                <Link type="button" method="delete" :href="`/virement/${virement.id}/annuler-virement/`"  data-id="7"
                                                data-placement="bottom" title=""
                                                class="btn btn-icon btn-danger data-supprimer"
                                                data-original-title="Supprimer"><i class="fas fa-trash"></i></Link>
                                            <Link type="button"  method="post" :href="`/virement/${virement.id}/valider-virement/`" data-toggle="tooltip" data-id="7"
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
                                <Pagination :links="virements.links"/>
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
        props: {
            banques: Object,
            virements: Object,
            errors: Object,
        },


        data() {
            return {
                moment: moment,
                type: '',
                montant: '',
                banque: '',
            }
        },
        methods: {
            store() {
                this.$inertia.post('/virement', { type: this.type, montant:this.montant,banque:this.banque

                });
                // Swal.fire({
                //     position: 'top-end',
                //     icon: 'success',
                //     title: 'Paiement  réglé avec succes',
                //     showConfirmButton: false,
                //     timer: 5000
                //     })

            },
        },
    }
</script>
