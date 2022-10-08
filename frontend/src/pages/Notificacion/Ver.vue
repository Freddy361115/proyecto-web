<template>
<div class="content">
    <div class="md-layout">
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
            <md-card>
                <md-card-header data-background-color="green">
                    <h4 class="title">Detalles Notificacion</h4>
                </md-card-header>
                <md-card-content>
                    <md-card-content v-if="notificacion">
                        <h6 class="category text-gray">Fecha Inicio: {{notificacion.fecha_inicial}} / Fecha Final: {{notificacion.fecha_final}}</h6>
                        <h4 class="card-title">{{notificacion.titulo_actividad}}</h4>
                        <p class="card-description">
                            {{notificacion.descripcion}}
                        </p>
                        <p v-if="notificacion.filepath"><a :href="filePath" target="_blank">Descargar Archivo</a></p>
                        <div v-if="notificacion.id_tipo_actividad == 2">
                            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                                <hr>
                                <div class="md-layout-item md-small-size-100 md-size-100">
                                    <md-field>
                                        <label>Archivo</label>
                                        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                                    </md-field>
                                </div>
                                <md-button class="md-round md-success" @click="uploadFile">Cargar Archivo</md-button>
                            </div>
                        </div>
                    </md-card-content>
                </md-card-content>
            </md-card>
            <div class="md-layout-item md-size-100 text-right">
                <md-button class="md-raised md-default" @click="goBack">Cancelar</md-button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'Notificacion',
    props: {
        caption: {
            type: String,
            default: 'Detalles de Notificacion'
        },
    },
    mounted: async function () {
        this.notificacion = await this.$getRequest(process.env.VUE_APP_API + '/notificacion/' + this.$route.params.id);
        this.filePath = process.env.VUE_APP_BASE + this.notificacion.filepathNew;
        if (this.notificacion.id_tipo_actividad != 2 && this.notificacion.estado == 1) {
            this.sendDelete();
        }
    },
    data: () => {
        return {
            notificacion: null,
            filePath:''
        }
    },
    methods: {
        handleFileUpload() {
            this.notificacion.file = this.$refs.file.files[0];
        },
        goBack() {
            this.$router.replace({
                path: '/dashboard'
            })
        },
        async sendDelete() {
            let response = await this.$deleteRequest(process.env.VUE_APP_API + '/notificacion/' + this.$route.params.id);
        },
        async uploadFile() {
            this.notificacion._method = 'PUT';
            let response = await this.$sendRequestFile(process.env.VUE_APP_API + "/notificacion/" + this.$route.params.id, this.notificacion);
            console.log(response);
            if (response.success) {
                this.active = false;
            }
        }
    }
}
</script>
