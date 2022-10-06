<template>
<div class="content">
    <div class="md-layout">
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
            <md-card>
                <md-card-header data-background-color="green">
                    <h4 class="title">Crear nueva notificacion</h4>
                </md-card-header>
                <md-card-content>
                    <div class="md-layout">
                        <div class="md-layout-item md-small-size-100 md-size-100">
                            <md-field>
                                <label>Título</label>
                                <md-input required v-model="notificacion.titulo_actividad"></md-input>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-50">
                            <md-field>
                                <label>Fecha Inicial</label>
                                <md-input required v-model="notificacion.fecha_inicial" type="date"></md-input>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-50">
                            <md-field>
                                <label>Fecha Final</label>
                                <md-input required v-model="notificacion.fecha_final" type="date"></md-input>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-100">
                            <md-field>
                                <label>Descripción</label>
                                <md-textarea required v-model="notificacion.descripcion"></md-textarea>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-33">
                            <span>Tipo Notificación</span>
                            <md-field>
                                <v-select :loading="loading" :options="tipos_notificacion" style="width:100%" type="text" name="profesor" class="rounded" v-model="tipo_noti_selected">
                                    <template #no-options>
                                        No hay items disponibles
                                    </template>
                                </v-select>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-33">
                            <span>Establecimiento</span>
                            <md-field>
                                <v-select :loading="loading" :options="establecimientos" style="width:100%" type="text" name="establecimiento" class="rounded" v-model="establecimiento_selected">
                                    <template #no-options>
                                        No hay items disponibles
                                    </template>
                                </v-select>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-33">
                            <span>Profesor</span>
                            <md-field>
                                <v-select :loading="loading" :options="profesores" style="width:100%" type="text" name="profesor" class="rounded" v-model="profesor_selected">
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
        this.establecimiento_data = await this.$getRequest(process.env.VUE_APP_API + '/establecimientos');
        this.establecimiento_data.forEach(sup => {
            that.establecimientos.push({
                label: sup.nombre,
                code: sup.id_establecimiento
            });
        });

        this.profesores_data = await this.$getRequest(process.env.VUE_APP_API + '/profesores');
        this.profesores_data.forEach(sup => {
            that.profesores.push({
                label: sup.nombres,
                code: sup.id
            });
        });

        this.tipo_noti_data = await this.$getRequest(process.env.VUE_APP_API + '/tiponotificacion');
        this.tipo_noti_data.forEach(sup => {
            that.tipos_notificacion.push({
                label: sup.descripcion,
                code: sup.id
            });
        });

        this.loading = false;
    },
    data() {
        return {
            establecimiento_data: null,
            profesores_data: null,
            tipo_noti_data: null,
            establecimiento_selected: null,
            profesor_selected: null,
            tipo_noti_selected: null,
            loading: false,
            establecimientos: [],
            profesores: [],
            tipos_notificacion: [],
            notificacion: {
                titulo_actividad  : '',
                descripcion       : '',
                fecha_inicial     : '',
                fecha_final       : '',
                user_id           : 1,
                id_profesor       : null,
                id_establecimiento: null,
                id_tipo_actividad : null,
            }
        };
    },
    methods: {
        goBack() {
            this.$router.push({
                name: "Notificaciones"
            });
        },
        async save() {
            let that = this;

            if (this.establecimiento_selected) {
                this.notificacion.id_establecimiento = this.establecimiento_selected.code;
            }

            if (this.profesor_selected) {
                this.notificacion.id_profesor = this.profesor_selected.code;
            }

            if (this.tipo_noti_selected) {
                this.notificacion.id_tipo_actividad = this.tipo_noti_selected.code;
            }
            
            let response = await this.$postRequest(process.env.VUE_APP_API + "/notificacion", this.notificacion);
            if (response.success) {
                this.$showNotification('success', 'Notificación creada correctamente', 'check');
                this.$router.push({
                    name: "Notificaciones"
                });
            }
        },
    },
};
</script>
