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
                            <label for="inputName" class="form-label">N° Facture</label>
                            <input required type="text" disabled class="form-control"   v-model="facture" id="inputName">
                        </div>
                        <div class="col-6">
                            <label for="inputFirstname" class="form-label">Client</label>
                            <select class="form-control form-select" required aria-label=".form-select-lg example" v-model="client_id"  >
                                <option value="" >Selectionner le client </option>
                                <option v-for="client in clients" :key="client.id" :value="client.id">
                                    {{ client . nom }} {{ client . prenom }}</option>

                            </select>
                        </div>

                        <div class="row col-4 pt-3 offset-4">
                                <button data-toggle="tooltip" data-placement="bottom" @click="addRow" title="" type="button"
                                    class="btn btn-icon btn-primary addNewblock" id=""
                                    data-original-title="Ajouter produit">Ajouter les détails de la facture <i class="fas fa-plus"></i></button>
                        </div>
                        <div class="addNouveau">
                            <div v-for="(detail,index) in details"  :key="detail.index" class="row col-12">
                                <div   class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>Désignation <font color="red">*</font></label>
                                        <input title="saisir la quantité" type="text"  :class="{ 'is-invalid': errors.designation }" v-model="detail.designation" class="form-control" name="" >
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label>Qté <font color="red">*</font></label>
                                        <input title="saisir la quantité" type="number" :class="{ 'is-invalid': errors.quantite }" v-model="detail.quantite" class="form-control" name=""  @change="updateTotal(detail)">

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Prix Unitaire<font color="red">*</font></label>
                                        <input title="saisir la quantité" type="number" :class="{ 'is-invalid':errors.prix_unit }" v-model="detail.prix_unit" class="form-control" name="" @change="updateTotal(detail)">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label> Total<font color="red">*</font></label>
                                        <input title="saisir la quantité" disabled type="number" v-model="detail.total" class="form-control" name="" required=""  @change="calculerTotal">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding: 30px">

                                    <button  type="button" class="btn btn-icon btn-danger" id="addNewblock" @click="removeRow(index)" data-original-title="Ajouter produit"><i class="fas fa-trash"></i></button>

                                </div>
                                <!-- <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label> Monta<font color="red">*</font></label>
                                        <input title="saisir la quantité" disabled  :value="detail.total+detail.total" type="number" v-model="detail.montant" class="form-control" name="" required="">
                                    </div>
                                </div> -->
                            </div>




                        </div>


                        <br>

                        <div class=" row col-12">

                            <div class="col-4">
                               <div class="form-group">
                                 <label for=""> Montant total </label>
                                <input type="text" name="" id="" v-model="montant" class="form-control" disabled>

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
                    <h2 class="text-center">Liste des Factures</h2>
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
                                                N° fact</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending">Client</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                              Montant</th>
                                               <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                              Etat</th>  <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                               Date de creation</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" >Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="facture in factures" :key="facture.id" class="">
                                            <td class="text-center">{{facture.numero_facture}}</td>
                                            <td class="text-center">{{facture.client.nom}}      {{facture.client.prenom }}</td>
                                            <td class="text-center">{{facture.montant}}</td>
                                            <td class="text-center"> <div class="badge badge-success">{{facture.etat}}</div></td>
                                            <td class="text-center">{{moment(facture.created_at).format("DD/MM/YYYY")}}</td>
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
                                        </tr>
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
            clients: Object,
            facture: String,
            factures:Object,
            errors:Object,
        },

        data() {
            return {

                moment: moment,
                details: [
                    {designation:'',quantite:0,prix_unit:0,total:null,},
                ],
                client_id: '',
                montant: null,

                errors: {
                designation: [],
                quantite: [],
                prix_unit: [],
                // ...
                },

            }
        },
        methods:{

                 addRow() {
            this.details.push({});
            },
            removeRow(index) {

            this.details.splice(index, 1);
            this.calculerTotal();
            },
            updateTotal(detail) {
                detail.total = detail.quantite * detail.prix_unit;
                this.calculerTotal();
            },
            calculerTotal() {
                    let total = 0;
                    for (let i = 0; i < this.details.length; i++) {
                    let detail = this.details[i];
                    if (detail.quantite && detail.prix_unit) {
                        detail.total = detail.quantite * detail.prix_unit;
                        total += detail.total;
                    } else {
                        detail.total = null;
                    }
                    }
                    this.montant = total;
                },
            store() {
                this.$inertia.post('/facture', { details: this.details , client_id: this.client_id, facture: this.facture,montant: this.montant});
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


