<template>

    <Head title="Paiement facture" />
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
                    <h3>Règlement d'une nouvelle facture</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="store">
                        <div class="col-6">
                            <label for="inputName" class="form-label">Lieu de l'opération</label>
                            <select v-model="type" class="form-control form-select" id=""
                                :class="{ 'is-invalid': errors.type }" aria-label=".form-select-lg example">
                                <option value="">Selectionner </option>
                                <option value="caisse">Caisse </option>
                                <option value="banque">Banque </option>

                            </select>
                        </div>
                        <div class="col-6">
                            <label for="inputFirstname" class="form-label">N° facture</label>
                            <select v-model="selectedFacture" class="form-control form-select"
                                :class="{ 'is-invalid': errors.selectedFacture }" id="facture"
                                aria-label=".form-select-lg example" >
                                <option  value="">Selectionner la facture </option>
                                <option v-for="facture in factures" :key="facture.id" :value="facture.id">
                                    {{ facture . numero_facture }} </option>

                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="inputName" class="form-label">Client</label>
                                <input required type="text" v-model="client" class="form-control" id="inputName"
                                    readonly>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for=""> Montant </label>
                                <input required type="number" v-model="montant_facture" readonly class="form-control"
                                    id="inputName">

                            </div>
                        </div>
                        <br>

                        <div v-if="type === 'caisse'" class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Montant </label>
                                    <input type="number" class="form-control" :class="{ 'is-invalid': errors.montant }"
                                        v-model="montant" id="montant">

                                </div>
                            </div>
                        </div>
                        <div v-else-if="type === 'banque'" class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputFirstname" class="form-label">Banque</label>
                                    <select v-model="banque" class="form-control form-select" id="facture"
                                        :class="{ 'is-invalid': errors.banque }" aria-label=".form-select-lg example">
                                        <option selected value="">Selectionner la banque </option>
                                        <option v-for="banque in banques" :key="banque.id" :value="banque.id">
                                            {{ banque . nom }} </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputName" class="form-label">Operation</label>
                                    <select v-model="operation" class="form-control form-select"
                                        :class="{ 'is-invalid': errors.operation }" id=""
                                        aria-label=".form-select-lg example">
                                        <option value="">Selectionner l'operation </option>
                                        <option value="virement">Virement bancaire </option>
                                        <option value="cheque">Chèque </option>

                                    </select>

                                </div>
                            </div>

                            <div v-if="operation === 'virement'" class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Numero de compte </label>
                                        <input type="number" v-model="numero_compte" class="form-control"
                                            :class="{ 'is-invalid': errors.numero_compte }" id="inputName">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Montant </label>
                                        <input type="number" v-model="montant"
                                            :class="{ 'is-invalid': errors.montant }" class="form-control"
                                            id="inputName">

                                    </div>
                                </div>
                            </div>
                            <div v-else-if="operation === 'cheque'" class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="inputFirstname" class="form-label">Numero d'ordre</label>
                                        <input type="number" v-model="numero_ordre"
                                            :class="{ 'is-invalid': errors.numero_ordre }" class="form-control"
                                            id="inputName">

                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for=""> Montant </label>
                                        <input type="number" v-model="montant"
                                            :class="{ 'is-invalid': errors.montant }" class="form-control"
                                            id="inputName">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" class="btn btn-icon icon-left btn-danger"><i
                                    class="fas fa-times"></i>
                                Annuler
                            </button>
                            <button class="btn btn-icon icon-left btn-success float-right" type="submit"
                                id="addvente"><i class="fas fa-check"></i> Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-lg-10 offset-1 col-md-12">
                <div class="">
                    <h2 class="text-center">Liste des paiements</h2>
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
                                                aria-label="Browser: activate to sort column ascending">Facture</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Client</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Note</th> <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Etat</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Date paiement</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                                Montant réglé</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="paiement in paiements.data" :key="paiement.id" class="">
                                            <td class="text-center">{{ paiement . facture . numero_facture }}</td>
                                            <td class="text-center">{{ paiement . facture . client . nom }}
                                                {{ paiement . facture . client . nom }}</td>
                                            <td class="text-center">
                                                <div class="badge badge-primary">{{ paiement . note }}</div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge badge-success">{{ paiement . etat }}</div>
                                            </td>
                                            <td class="text-center">
                                                {{ moment(paiement . created_at) . format('DD-MM-YYYY-hh') }}</td>
                                            <td class="text-center">{{ paiement . montant_paiement }}</td>
                                            <td v-if="paiement.etat == 'en attente'" class="text-center">
                                            <Link type="button"
                                                data-toggle="tooltip" title=""
                                                class="btn btn-icon btn-info" data-original-title="Détails"><i
                                                    class="fas fa-info"></i></Link>
                                            <Link type="button"  method="post" :href="`/paiement/${paiement.id}/valider-paiement/`" data-toggle="tooltip" data-id="7"
                                                title=""
                                                class="btn btn-icon btn-success data-valider"
                                                data-original-title="Valider"><i class="fas fa-check"></i></Link>
                                            <Link type="button" method="delete" :href="`/paiement/${paiement.id}/annuler-paiement/`"  data-id="7"
                                                data-placement="bottom" title=""
                                                class="btn btn-icon btn-danger data-supprimer"
                                                data-original-title="Supprimer"><i class="fas fa-trash"></i></Link>
                                            <Link type="button"

                                                data-toggle="tooltip"  title=""
                                                class="btn btn-icon btn-primary" data-original-title="Modifier"><i
                                                    class="fas fa-edit"></i></Link>
                                            <Link type="button" target="_blank"
                                                href=""
                                                class="btn btn-icon btn-warning"><i class="fas fa-print"></i></Link>
                                            </td>
                                            <td v-if="paiement.etat == 'validé'" class="text-center">
                                                <Link type="button"
                                                    href=""
                                                    data-toggle="tooltip" title=""
                                                    class="btn btn-icon btn-info" data-original-title="Détails"><i
                                                        class="fas fa-info"></i></Link>
                                                <Link type="button" target="_blank"
                                                    href=""
                                                    class="btn btn-icon btn-danger"><i class="fas fa-times"></i></Link>
                                                    <Link type="button" target="_blank"
                                                    href=""
                                                    class="btn btn-icon btn-warning"><i class="fas fa-print"></i></Link>
                                                </td>
                                            <!-- <td class="text-center m-3">
                                                <Link title="Detail la facture"
                                                    :href="`/paiement/${paiement.id}/detail-facture/`" type="button"
                                                    class="btn
                                                    btn-icon  btn-info">
                                                <i class="fas fa-info"></i></Link>
                                                <Link type="button" :href="`/paiement/${paiement.id}/facture-pdf/`"
                                                    title="imprimer la facture"
                                                    class="btn
                                                    btn-icon btn-warning">
                                                <i
                                                    class="fas
                                                        fa-print"></i>
                                                </Link>
                                                <button
                                                    class="btn
                                                    btn-link"><i
                                                        class="fas
                                                        fa"></i></button>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12" style="float:left;">
                                <Pagination :links="paiements.links"/>
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
            clients:Object,
            factures: Object,
            montant: Object,
            banques: Object,
            errors: Object,
            paiements: Object,
        },


        data() {
            return {
                moment: moment,
                selectedFacture: '',
                type: '',
                operation: '',
                numero_compte: '',
                numero_ordre: '',
                montant_facture: '',
                client: '',
                banque: '',
            }
        },
        methods: {
            selectedFactureDetails() {
                const facture = this.factures.find(
                    (facture) => facture.id === this.selectedFacture
                );
                if (facture) {
                    const client = this.clients.find(
                        (client) => client.id === facture.client_id
                    );
                    if (client) {
                        return {
                            montant: facture.montant,
                            nomPrenom: client.nom + ' ' + client.prenom,
                        };
                    }
                }
                return null;
            },
            store() {
                this.$inertia.post('/paiement', {
                    selectedFacture: this.selectedFacture,
                    type: this.type,
                    operation: this.operation,
                    numero_compte: this.numero_compte,
                    numero_ordre: this.numero_ordre,
                    banque: this.banque,
                    montant: this.montant,
                    montant_facture: this.montant_facture
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
        watch: {
            selectedFacture(newVal, oldVal) {
                // Mettre à jour les détails de la facture lorsqu'une nouvelle facture est sélectionnée
                const factureDetails = this.selectedFactureDetails();
                if (factureDetails) {
                    this.montant_facture = factureDetails.montant;
                    this.client = factureDetails.nomPrenom;
                } else {
                    this.montant_facture = null;
                    this.client = null;
                }
            },
        },


    }
</script>
<style>
    .form-control.errors {
        border-color: #dc3545;
    }
</style>
