<template>

    <Head title="Initialisation de la caisse" />
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
            <div class="col-4 offset-3">
                <div v-if="$page.props.flash.success" class="alert alert-success"  role="alert">
                    <span class="text-xxl text-center m-2">{{ $page.props.flash.success }}</span>
                </div>
                <div v-if="$page.props.flash.error" class="alert alert-danger"  role="alert">
                    <span class=" text-xxl text-center m-2">{{ $page.props.flash.error }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <h3 class="text-center">Solde de la caisse</h3>
                        <div class="inner">
                            <h3 class="text-center" >{{ solde }}  Fcfa</h3>

                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
                
            

            <div class="card col-lg-8 offset-2 col-md-10">
                <div style="margin:40px;">
                    <h3>Initialisation du solde de la caisse</h3>
                    <div class="d-flex mb-2">
                        <h2 class="card-title flex-grow-1"> </h2>
                    </div>
                    <form class="row g-3 m-5" @submit.prevent="initialiserCaisse">
                        <div class="col-4">
                            <label for="inputName" class="form-label">Montant</label>
                            <input v-model="form.montant" :class="{ 'is-invalid': errors.montant }" type="text" class="form-control" id="inputName">
                        </div>
                        
                        <div class="col-6 mt-5">
                            <button type="submit" class="btn btn-success ">Enregistrer</button>
                        </div>
                    </form>
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
            solde:Object,
            errors: Object,

        },
        data() {
            return {

            }
        },
        watch: {
            '$page.props.flash': {
            handler() {
                this.show = true
            },
            deep: true,
            },
  },

    }
</script>
<script setup>
    import {
        reactive
    } from 'vue'
    import {
        router
    } from '@inertiajs/vue3'
    let form = reactive({
        montant: null,


    })

    let initialiserCaisse = () => {
        router.post('/caisse', form)

        if(errors == null) 
        {
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Solde initialisée enregistré avec succes',
            showConfirmButton: false,
            timer: 5000
        })

        form.montant = null;
        }
        

    }
</script>
