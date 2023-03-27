<template>

    <Head title="Client create" />
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
                    <h3>Enregistrement d'une nouvelle facture</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="store">
                        <div class="col-6">
                            <label for="inputName" class="form-label">Date paiement</label>
                            <input required type="date"  class="form-control"  id="inputName">
                        </div>
                        <div class="col-6">
                            <label for="inputName" class="form-label">Montant paiement</label>
                            <input required type="text"  class="form-control"   id="inputName">
                        </div>
                        <div class="col-6">
                            <label for="inputFirstname" class="form-label">N° facture</label>
                            <select  v-model="selectedFacture" class="form-control form-select" id="facture" aria-label=".form-select-lg example"  required="" >
                                <option selected>Selectionner la facture </option>
                                <option v-for="facture in factures" :key="facture.id" :value="facture.id"  >
                                    {{ facture.numero_facture }} </option>

                            </select>
                        </div>
                        <div  v-if="selectedClient" class="col-6">
                            <div class="form-group">
                                <label for="inputName" class="form-label">Client</label>
                                <p class="form-control"> {{ selectedClient.nom }} {{ selectedClient.prenom }}</p>
                            </div>
                        </div>
                        <br>

                        <div class=" row col-12">

                            <div class="col-4">
                               <div class="form-group">
                                 <label for=""> Montant dû </label>
                                <p class="form-control" > </p>

                               </div>
                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-6" style="padding-top:32px;">

                                    <button type="reset" class="btn btn-icon icon-left btn-danger"><i
                                        class="fas fa-times"></i>
                                            Annuler
                                        </button>
                                        <button class="btn btn-icon icon-left btn-primary" type="submit"  id="addvente"><i
                                        class="fas fa-check"></i> Enregistrer</button>

                            </div>


                            <!-- <Link href="/client" class="btn btn-danger">Annuler</Link>
                            <button type="submit"  class="btn btn-success float-right">Enregistrer</button> -->
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
                                <table id="example1"
                                    class="table table-bordered table-striped dataTable dtr-inline"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending">
                                                N° </th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending">N°  fact</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                              Client</th>
                                               <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                              Dtae paiement</th>  <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                              Montant réglé</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" >Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr v-for="facture in factures" :key="facture.id" class="">
                                            <td class="text-center">{{facture.numero_facture}}</td>
                                            <td class="text-center">{{facture.client.nom}}      {{facture.client.prenom }}</td>
                                            <td class="text-center">{{facture.montant}}</td>
                                            <td class="text-center"> <div class="badge badge-success">{{facture.etat}}</div></td>
                                            <td class="text-center">{{moment(facture.created_at).format("DD-MM-YYYY-hh")}}</td>
                                            <td class="text-center m-3">
                                                <Link title="Detail la facture"  :href="`/facture/${facture.id}/detail-facture/`" type="button" class="btn
                                                    btn-icon  btn-info"><i
                                                        class="fas fa-info"></i></Link>
                                                        <Link  type="button" :href="`/facture/${facture.id}/facture-pdf/`" title="imprimer la facture" class="btn
                                                    btn-icon btn-warning"><i
                                                        class="fas
                                                        fa-print"></i></Link>
                                                <button class="btn
                                                    btn-link"><i
                                                        class="fas
                                                        fa"></i></button>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12" style="float:left;">
                                <!-- <Pagination :links="clients.links"/>  -->
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
            factures:Object,
            clients:Object,
            montant:Object
        },

        data() {
            return {
                moment: moment,
                selectedFacture: '',
            }
        },
        computed: {
            selectedClient() {
                const facture = this.factures.find(
                    (facture) => facture.id === this.selectedFacture
                );

                if (facture) {
                    return this.clients.find(
                        (client) => client.id === facture.client_id
                    );
                }

                return null;
            },
          


            
        },
        methods:{
            store() {
                this.$inertia.post('/facture', { });
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Facture Créé avec succes',
                    showConfirmButton: false,
                    timer: 5000
                    })

            },


                }


    }
</script>


