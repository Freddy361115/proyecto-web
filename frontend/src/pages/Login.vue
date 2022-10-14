<template >
<div class="content" style="background-image:url('https://www.slon.pics/file/2017/03/Flag-of-Guatemala-in-the-corner-on-white-background.-Isolated-contains-clipping-path-19431.jpg'); background-repeat: no-repeat;">
    <div class="md-layout" >
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33">

        </div>
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33">
            <md-card style="margin-top: 10%">
                <md-card-header data-background-color="green">
                    <h4 class="title">Iniciar Sesion</h4>
                </md-card-header>
                <md-card-content>
                    <div class="md-layout">
                        <div class="md-layout-item md-small-size-100 md-size-100">
                            <img class="img" :src="logoimage" />
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-100">
                            <md-field>
                                <label>Correo</label>
                                <md-input required v-model="email"></md-input>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-100">
                            <md-field>
                                <label>Password</label>
                                <md-input required v-model="password" type="password"></md-input>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-100">
                            <md-button class="md-raised md-success" @click="login">Acceder</md-button>
                        </div>
                    </div>
                </md-card-content>
            </md-card>
        </div>
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33">

        </div>
    </div>
    <md-snackbar :md-position="position" :md-duration="isInfinity ? Infinity : duration" :md-active.sync="showSnackbar" md-persistent>
      <span>{{error}}</span>
    </md-snackbar>
</div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            password    : '',
            email       : '',
            user_id     : null,
            loading     : false,
            error       : '',
            showSnackbar: false,
            position    : 'center',
            duration    : 4000,
            isInfinity  : false
        }
    },
    props: {
        logoimage: {
            type: String,
            default: require("@/assets/img/logo.png"),
        },
    },
    methods: {
        async getUserInfo() {
            let response = await this.$getRequest(process.env.VUE_APP_API + '/details/' + localStorage.user_id);
            localStorage.user_data = JSON.stringify(response);
            this.$router.push('dashboard');
            this.loading = false;
        },
        async login() {

            if (!this.email || this.email.length == 0) {
                this.showSnackbar = true;
                this.error = 'El campo email es requerido';
                return;
            }

            if (!this.email || this.password.length == 0) {
                this.showSnackbar = true;
                this.error = 'El campo password es requerido';
                return;
            }

            let data = {
                'password': this.password,
                'email': this.email
            }

            this.loading = true;

            let response = await this.$postRequest(process.env.VUE_APP_API + "/login", data);

            if (response && response.success) {
                localStorage._token = response.success.token;
                localStorage.user_id = response.success.id;
                localStorage.rol_id = response.success.id_rol;
                this.user_id = response.user_id;
                this.$showNotification('success', 'Bienvenido', 'check');
                this.getUserInfo();
            } else {
                this.showSnackbar = true;
                this.error = 'Verifique su usuario y contraseña.';
                this.loading = false;
            }

        }
    }
}
</script>

<style scoped>
@media (min-width: 1200px) {
    .container {
        width: 60% !important;
    }
}
</style>
