<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">Crear nuevo profesor</h4>
                    </md-card-header>
                    <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Nombres</label>
                                    <md-input required v-model="profesor.nombres"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Apellidos</label>
                                    <md-input required v-model="profesor.apellidos" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Fecha Nacimiento</label>
                                    <md-input required v-model="profesor.fecha_nacimiento" type="date"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Nombre de Usuario</label>
                                    <md-input required v-model="profesor.nombre_usuario" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Email</label>
                                    <md-input required v-model="profesor.email" type="email"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Password</label>
                                    <md-input required v-model="profesor.password" type="password"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>DPI</label>
                                    <md-input v-model="profesor.dpi" maxlength="13" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Direccion</label>
                                    <md-input v-model="profesor.direccion" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Telefono</label>
                                    <md-input v-model="profesor.telefono" maxlength="8" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-size-100 text-right">
                                <md-button class="md-raised md-success" @click="save">Guardar</md-button>
                                <md-button class="md-raised md-default" @click="goBack">Cancelar</md-button>
                            </div>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "edit-profile-form",
    props: {
        dataBackgroundColor: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            profesor: {
                nombres: '',
                apellidos: '',
                nombre_usuario: '',
                direccion: '',
                telefono: '',
                fecha_nacimiento: '',
                email: '',
                dpi: '',
                password: ''
            }
        };
    },
    methods: {
        goBack() {
            this.$router.push({
                name: "Profesores"
            });
        },
        async save() {
            let that = this;
            let response = await this.$postRequest(process.env.VUE_APP_API + "/profesores", this.profesor);
            if (response.success) {
                this.$showNotification('success', 'Profesor creado correctamente', 'check');
                this.$router.push({
                    name: "Profesores"
                });
            }
        },
    },
};
</script>
