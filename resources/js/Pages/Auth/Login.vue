<template>
    <Head title="Login" />
    <Main>
        <div class="login-box" style="width:700px">
            <div class="login-logo">
                <a href="#" style="color:#b3b6b9;font-size:1.8em;"><b style="font-weight:bold;">TRAMUD </b>ADMIN</a>
                <hr />
            </div>
        
            <div class="card bg-dark">
                <div class="card-body bg-dark login-card-body">
        
                    <form @submit.prevent="login">
                       
        
                        <div class="input-group mb-3">
                            <input type="email" placeholder="Email" class="form-control"
                                name="email" v-model="form.email" required autocomplete="off" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password"
                                name="password" v-model="form.password" required
                                autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
        
        
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                            </div>
        
                        </div>
                    </form>
        
                </div>
            </div>
        </div>
    </Main>
</template>
<script setup>
    import {Head} from '@inertiajs/vue3'
    import Main from '../../components/App.vue'
</script>
<script>
export default {
    components: {
    
    },
    data() {
      return {
        form: this.$inertia.form({
          email: '',
          password: '',
        }),
      }
    },
    methods: {
      login() {
        this.form.post('/login')
      },
    },
  }
</script>