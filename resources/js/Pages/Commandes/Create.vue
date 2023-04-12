<template>

    <Head title="Nouvelle facture" />
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
                    <h3>Enregistrement d'une nouvelle commande</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3" @submit.prevent="store">
                        <div class="col-6">
                            <label for="inputName" class="form-label">N° Commande</label>
                            <input required type="text" disabled class="form-control"   v-model="commande" id="inputName">
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
                                    data-original-title="Ajouter produit">Ajouter les produits à la commande <i class="fas fa-plus"></i></button>
                        </div>
                        <div class="addNouveau">
                            <div v-for="(detail,index) in details"  :key="detail.index" class="row col-12">
                                <div   class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label>Produit <font color="red">*</font></label>
                                        <select v-model="detail.produit" class="form-control form-select" required aria-label=".form-select-lg example"  @change="onProductSelected(detail)"   >
                                            <option value="" >Selectionner le produit </option>
                                            <option v-for="produit in produits" :key="produit.id" :value="produit.id">
                                                {{ produit . designation }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label>Prix <font color="red">*</font></label>
                                        <input title="saisir la quantité" readOnly  v-model="detail.prix" class="form-control" name=""  @change="updateTotal(detail)">

                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label>Longueur <font color="red">*</font></label>
                                        <input title="saisir la quantité" type="number" :class="{ 'is-invalid': errors.longueur }" v-model="detail.longueur" class="form-control" name=""  @change="updateTotal(detail)">

                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label>Largeur <font color="red">*</font></label>
                                        <input title="saisir la quantité" type="number" :class="{ 'is-invalid':errors.largeur }" v-model="detail.largeur" class="form-control" name="" @change="updateTotal(detail)">
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
                            <div class="card-footer">
                                <button type="reset" class="btn btn-icon icon-left btn-danger"><i
                                    class="fas fa-times"></i>
                                        Annuler
                                    </button>
                                    <button class="btn btn-icon icon-left btn-primary float-right" type="submit"  id="addvente"><i
                                        class="fas fa-check"></i> Enregistrer</button>
                            </div>
                            <div class="col-6" style="padding-top:32px;">

                                    
                                        

                            </div>


                            <!-- <Link href="/client" class="btn btn-danger">Annuler</Link>
                            <button type="submit"  class="btn btn-success float-right">Enregistrer</button> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-lg-10 offset-1 col-md-12">
                <div class="">
                    <h2 class="text-center">Liste des Commandes</h2>
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
                                                N° commande</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1"
                                                aria-label="Browser: activate to sort column ascending">Client</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1">
                                              Montant</th>
                                               <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                              Etat</th> <th class="text-center" tabindex="0" aria-controls="example1"
                                              rowspan="1" colspan="1">
                                             Etat Livraison</th> <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                               Date de creation</th>
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
<script setup>
import Pagination from '../../components/Pagination.vue'
</script>
<script>
    import Layout from '../../components/MainLayout.vue'
    import moment from "moment";

    export default {
        layout: Layout,
        props: {
            clients: Object,
            produits: Object,
            commande: String,
            commandes:Object,
            errors:Object,
        },

        data() {
            return {

                moment: moment,
                details: [
                    {produit:null ,longueur:0,largeur:0,prix:null,total:null,},
                ],
                client_id: '',
                prix: null,
                montant: null

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
            onProductSelected(detail) {
                const selectedProduct = this.produits.find(p => p.id === detail.produit);
                if (selectedProduct) {
                detail.prix = selectedProduct.prix;
                this.updateTotal(detail);
                } else {
                detail.prix = 0;
                }
            },
            updateTotal(detail) {
                detail.total = detail.longueur * detail.largeur * detail.prix;
                this.calculerTotal();
            },
            calculerTotal() {
                    let total = 0;
                    for (let i = 0; i < this.details.length; i++) {
                    let detail = this.details[i];
                    if (detail.longueur && detail.largeur && detail.prix) {
                        detail.total = detail.longueur * detail.largeur *detail.prix;
                        total += detail.total;
                    } else {
                        detail.total = null;
                    }
                    }
                    this.montant = total;
                },
            store() {
                this.$inertia.post('/facture', { details: this.details , client_id: this.client_id, commande: this.commande,montant: this.montant});
                // Swal.fire({
                //     position: 'top-end',
                //     icon: 'success',
                //     title: 'Facture Créé avec succes',
                //     showConfirmButton: false,
                //     timer: 5000
                //     })

            },


                }


    }
</script>


