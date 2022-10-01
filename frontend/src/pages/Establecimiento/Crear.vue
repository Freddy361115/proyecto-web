<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">Crear nuevo Establecimiento</h4>
                    </md-card-header>
                    <md-card-content>
                        <div class="md-layout">
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Nombre</label>
                                    <md-input required v-model="establecimiento.nombre"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Email</label>
                                    <md-input required v-model="establecimiento.email" type="email"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Direccion</label>
                                    <md-input v-model="establecimiento.direccion" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Telefono</label>
                                    <md-input v-model="establecimiento.telefono" maxlength="8" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <md-field>
                                    <label>Codigo Establecimiento</label>
                                    <md-input v-model="establecimiento.codigo_establecimiento" type="text"></md-input>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-small-size-100 md-size-33">
                                <span>Supervisor</span>
                                <md-field>
                                    <v-select :loading="loading" :options="supervisores" style="width:100%" type="text"
                                        name="supervisor" class="rounded" v-model="supervisor_selected">
                                        <template #no-options>
                                            No hay items disponibles
                                        </template>
                                    </v-select>
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
import 'vue-select/dist/vue-select.css';

export default {
    name: "edit-profile-form",
    props: {
        dataBackgroundColor: {
            type: String,
            default: "",
        },
    },
    async mounted() {
        let that = this;
        this.loading = true;
        this.supervisores_data = await this.$getRequest(process.env.VUE_APP_API + '/supervisors');
        this.supervisores_data.forEach(sup => {
            that.supervisores.push({
                label: sup.nombres + ' ' + sup.apellidos,
                code: sup.id
            });
        });
        this.loading = false;
    },
    data() {
        return {
            supervisores_data : null,
            supervisor_selected: null,
            loading: false,
            supervisores: [],
            establecimiento: {
                nombre                : '',
                direccion             : '',
                telefono              : '',
                email                 : '',
                codigo_establecimiento: '',
                id_supervisor         : null
            }
        };
    },
    methods: {
        goBack() {
            this.$router.push({
                name: "Establecimientos"
            });
        },
        async save() {
            let that = this;
            this.establecimiento.id_supervisor = this.supervisor_selected.code;
            let response = await this.$postRequest(process.env.VUE_APP_API + "/establecimientos", this.establecimiento);
            if (response.success) {
                this.$showNotification('success', 'Establecimiento creado correctamente', 'check');
                this.$router.push({
                    name: "Establecimientos"
                });
            }
        },
    },
};
</script>
