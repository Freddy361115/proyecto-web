<template>
<div class="content">
    <div class="md-layout">
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
            <md-card class="md-card-example">
                <md-card-area md-inset>

                    <md-card-header data-background-color="green">
                        <h2 class="md-title">{{notificacion.titulo_actividad}}</h2>
                        <div class="md-subhead">
                            <md-icon>person_pin</md-icon>
                            <span>Creado por: {{notificacion.supervisor_name}}</span>
                        </div>
                    </md-card-header>
                    <md-card-media class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100" v-if="notificacion.extensionSupervisor === 'jpg' || notificacion.extensionSupervisor ==='png'">
                        <img :src=sharedfilepath width="400px" height="auto" />
                    </md-card-media>

                    <md-card-content>
                        {{notificacion.descripcion}}
                    </md-card-content>
                </md-card-area>

                <md-card-content>
                    <h3 class="md-subheading">Fecha Disponibilidad</h3>
                    <div class="card-reservation">
                        <md-icon>access_time</md-icon>
                        <div class="md-button-group">
                            <md-button>{{notificacion.fecha_inicial}}</md-button>
                            <md-button>{{notificacion.fecha_final}}</md-button>
                        </div>
                    </div>
                </md-card-content>

                <md-card-area>

                    <md-card-content v-if="notificacion.extensionSupervisor === 'pdf' || notificacion.extensionSupervisor === 'docx'|| notificacion.extensionSupervisor === 'xlsx'">
                        <h3 class="md-subheading">Archivo Compartido: </h3>
                        <div class="card-reservation">
                            <md-icon>cloud_download</md-icon>
                            <div class="md-button-group">
                                <md-button v-if="notificacion.sharedfilepath"> <a :href="sharedfilepath" target="_blank">Descargar Archivo</a></md-button>
                            </div>
                        </div>
                    </md-card-content>
                </md-card-area>
                <md-card-actions>
                    <md-button @click="sendDelete" class="md-primary">Marcar como leida</md-button>
                </md-card-actions>
            </md-card>
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
        this.sharedfilepath = process.env.VUE_APP_BASE + this.notificacion.sharedfilepathNew;
    },
    data: () => {
        return {
            notificacion: null,
            filePath: ''
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
