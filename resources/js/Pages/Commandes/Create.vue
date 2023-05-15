<template>

    <Head title="Nouvelle commande" />
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
                            <input required type="text" disabled class="form-control"  :class="{'is-invalid': errors.commande}"  v-model="commande" id="inputName">
                        </div>
                        <div class="col-6">
                            <label for="inputFirstname" class="form-label">Client</label>
                            <Multiselect v-model="client_id"
                                :options="clients"
                                :searchable="true"
                                :show-labels="false"
                                :placeholder="'Choississez le client'"
                                :allow-empty="false"
                                :custom-label="customClient"
                                :select-label="selectClient">
                                </Multiselect>
                            <!-- <select class="form-control form-select" required aria-label=".form-select-lg example" v-model="client_id"  >
                                <option value="" >Selectionner le client </option>
                                <option v-for="client in clients" :key="client.id" :value="client.id">
                                    {{ client . nom }} {{ client . prenom }}</option>

                            </select> -->
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
                                        <select v-model="detail.produit" class="form-control form-select" :class="{'is-invalid': errors.details+'.' +index+ '.'+produit}"  aria-label=".form-select-lg example"  @change="onProductSelected(detail)"   >
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
                                        <input type="number" class="form-control"  v-model="detail.longueur" :class="{'is-invalid': errors.details+'.' +index+ '.'+longueur}" >


                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label>Largeur <font color="red">*</font></label>
                                        <input title="saisir la quantité" type="number"  v-model="detail.largeur" class="form-control" :class="{'is-invalid': errors.details+'.' +index+ '.'+largeur}" name="" @change="updateTotal(detail)">
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
                                <input type="text" name="" id="" v-model="montant" :class="{'is-invalid': errors.montant}" class="form-control" disabled>

                               </div>
                            </div>
                            <div class="col-2">

                            </div>
                            <div class="card-footer">
                                <button type="reset" class="btn btn-icon icon-left btn-danger"><i
                                    class="fas fa-times"></i>
                                        Annuler
                                    </button>
                                    <button class="btn btn-icon icon-left btn-success float-right" type="submit"  id="addvente"><i
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
                                               Date de creation</th>
                                               <th class="text-center" tabindex="0" aria-controls="example1"
                                               rowspan="1" colspan="1">
                                              Validation</th>
                                            <th class="text-center" tabindex="0" aria-controls="example1"
                                                rowspan="1" >Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="commande in commandes.data" :key="commande.id" class="">
                                            <td class="text-center">{{commande.numero_commande}}</td>
                                            <td class="text-center">{{commande.client.nom}}      {{commande.client.prenom }}</td>
                                            <td class="text-center">{{commande.total}} fcfa</td>
                                            <td class="text-center">{{moment(commande.created_at).format("DD/MM/YYYY")}}</td>
                                            <td v-if="commande.validation == 'en attente'" class="text-center"> <div class="badge badge-warning">{{commande.validation}}</div></td>
                                            <td v-if="commande.validation == 'validé'" class="text-center"> <div class="badge badge-success">{{commande.validation}}</div></td>
                                            <!-- <td v-if="commande.livraison == 'non-livrer'" class="text-center"> <div class="badge badge-warning">{{commande.livraison}}</div></td>
                                            <td v-if="commande.livraison == 'livré'" class="text-center"> <div class="badge badge-success">{{commande.livraison}}</div></td> -->
                                            <td v-if="commande.validation == 'en attente'" class="text-center m-3">
                                                <Link title="Detail la facture"  :href="`/commande/${commande.id}/detail-commande/`" type="button" class="btn
                                                    btn-icon  btn-info"><i
                                                        class="fas fa-info"></i></Link>
                                                        <Link  type="button" method="post" :href="`/commande/${commande.id}/valider-commande/`" title="imprimer la facture" class="btn
                                                    btn-icon btn-success"><i
                                                        class="fas
                                                        fa-check"></i></Link>
                                                <button class="btn
                                                btn-icon"><i
                                                        class="fas
                                                        fa"></i></button>
                                            </td>
                                            <td v-if="commande.validation == 'validé'" class="text-center m-3">
                                                <Link title="Detail la facture"  :href="`/commande/${commande.id}/detail-commande/`" type="button" class="btn
                                                    btn-icon  btn-info"><i
                                                        class="fas fa-info"></i></Link>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12" style="float:left;">
                                <Pagination :links="commandes.links"/>
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
    import Inputmask from 'inputmask'

    export default {
            layout: Layout,
            components: {
            Multiselect
        },
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
                    {produit:null ,longueur:null,largeur:null,prix:null,total:null,},
                ],
                client_id: '',
                prix: null,
                montant: null,
                clients: this.clients,

            }
        },
        methods:{

            customClient(client) {
                return `${client.nom} ${client.prenom}`;
                },
                selectClient(client) {
                return client.id;
                },
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
                this.$inertia.post('/commande', { details: this.details , client_id: this.client_id, commande: this.commande,montant: this.montant});
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
<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>


