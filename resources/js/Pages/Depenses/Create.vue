<template>

    <Head title=" Nouvelle Depense" />
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
                    <h3>Enregistrement d'une nouvelle dépense</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="store">
                        <div class="col-6">
                            <label for="inputName" class="form-label">Lieu de l'opération</label>
                            <select v-model="type" class="form-control form-select" id=""
                                :class="{ 'is-invalid': errors.type }" aria-label=".form-select-lg example">
                                <option selected value="">Selectionner </option>
                                <option value="caisse">Caisse </option>
                                <option value="banque">Banque </option>

                            </select>
                        </div>
                        <div class="col-6">
                            <label for="inputFirstname" class="form-label">Type de dépense</label>
                            <select v-model="depense" class="form-control form-select"
                                :class="{ 'is-invalid': errors.depense }" id="facture"
                                aria-label=".form-select-lg example">
                                <option selected value="">Selectionner le type de dépense </option>
                                <option value="salaire">Salaire </option>
                                <option value="prestataire">Prestataires </option>
                                <option value="autre">autre </option>

                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for=""> Note </label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': errors.note }"
                                    v-model="note" id="montant">

                            </div>
                        </div>
                        <br>
                       
                            <div v-if="type === 'banque'" class="col-6">
                                <div class="form-group">
                                    <label for="inputFirstname" class="form-label">Banque</label>
                                    <Multiselect v-model="banque"
                                    :options="banques"
                                    :searchable="true"
                                    :show-labels="false"
                                    :placeholder="'Choississez la banque'"
                                    :allow-empty="false"
                                    :custom-label="customBanque"
                                    :select-label="selectBanque">
                                    :class="{ 'is-invalid': errors.banque }"
                                    </Multiselect>
                                    <!-- <select v-model="banque" class="form-control form-select" id="facture"
                                        :class="{ 'is-invalid': errors.banque }" required aria-label=".form-select-lg example">
                                        <option  selected value="">Selectionner la banque </option>
                                        <option v-for="banque in banques" :key="banque.id" :value="banque.id">
                                            {{ banque . nom }} </option>

                                    </select> -->
                                </div>
                            </div>
                            <div v-if="depense === 'salaire'" class="row">
                                <div  class="col-6">
                                    <div class="form-group">
                                        <label for="inputFirstname" class="form-label">Agent</label>
                                        <Multiselect v-model="agent"
                                        :options="agents"
                                        :searchable="true"
                                        :show-labels="false"
                                        :placeholder="'Choississez agent'"
                                        :allow-empty="false"
                                        :custom-label="customAgent"
                                        :select-label="selectAgent">
                                        :class="{ 'is-invalid': errors.agent }"
                                        </Multiselect>  
                                        <!-- <select v-model="agent" class="form-control form-select" id="facture"
                                            :class="{ 'is-invalid': errors.agent }"  required aria-label=".form-select-lg example">
                                            <option selected value="">Selectionner l'agent </option>
                                            <option v-for="agent in agents" :key="agent.id" :value="agent.id">
                                                {{ agent . nom }}  {{ agent . prenom }}  </option>
    
                                        </select> -->
                                    </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Montant </label>
                                    <input type="number" class="form-control" :class="{ 'is-invalid': errors.montant }"
                                        v-model="montant" id="montant">
    
                                </div>
                            </div>
                            </div>
                       
                            <div v-if="depense === 'prestataire'" class="col-6">
                                <div class="form-group">
                                    <label for="inputFirstname" class="form-label">Prestataire</label>
                                    <Multiselect v-model="prestataire"
                                        :options="prestataires"
                                        :searchable="true"
                                        :show-labels="false"
                                        :placeholder="'Choississez le prestataire'"
                                        :allow-empty="false"
                                        :custom-label="customPrestataire"
                                        :select-label="selectPrestataire">
                                        :class="{ 'is-invalid': errors.prestataire }"
                                        </Multiselect>  
                                    <!-- <select v-model="prestataire"  class="form-control form-select" id="facture"
                                        :class="{ 'is-invalid': errors.prestataire }" required aria-label=".form-select-lg example">
                                        <option  value="">Selectionner le prestataire </option>
                                        <option v-for="prestataire in prestataires" :key="prestataire.id" :value="prestataire.id">
                                            {{ prestataire . nom }}   </option>
                                    </select> -->
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Montant </label>
                                        <input type="number" class="form-control" :class="{ 'is-invalid': errors.montant }"
                                            v-model="montant" id="montant">
    
                                    </div>
                                </div>
                            </div>
                        <div v-if="depense === 'autre'">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Montant </label>
                                    <input type="number" class="form-control" :class="{ 'is-invalid': errors.montant }"
                                        v-model="montant" id="montant">

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
                    <h2 class="text-center">Liste des depense</h2>
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
                                                Note</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                               Etat</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1">Actions
                                            </th>
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
    import Multiselect from  '@suadelabs/vue3-multiselect'


    export default {
        layout: Layout,
        components: {
            Multiselect
        },
        props: {
            agents: Object,
            prestataires: Object,
            banques: Object,
            depenses: Object,
            errors: Object,
        },


        data() {
            return {
                moment: moment,
                type: '',
                depense: '',
                montant: '',
                agent: '',
                prestataire: '',
                banque: '',
                note: '',
                agents: this.agents,
                prestataires: this.prestataires,
                banques: this.banques,
            }
        },
        methods: {
            customAgent(agent) {
                return `${agent.nom} ${agent.prenom}`;
                },
                selectAgent(agent) {
                return agent.id;
                },
                customPrestataire(prestataire) {
                return `${prestataire.nom} ${prestataire.prenom}`;
                },
                selectPrestataire(prestataire) {
                return prestataire.id;
                },
                customBanque(banque) {
                return `${banque.nom}`;
                },
                selectBanque(banque) {
                return banque.id;
                },
            store() {
                this.$inertia.post('/depense', { type: this.type, depense:this.depense, montant:this.montant, agent:this.agent,prestataire:this.prestataire,banque:this.banque,note:this.note
                   
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
<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>
