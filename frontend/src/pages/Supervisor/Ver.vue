<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">Detalles Supervisor</h4>
                    </md-card-header>
                    <md-card-content>
                        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                            <md-list>
                                <md-list-item><b>Nombres: </b>{{supervisor.nombres}}</md-list-item>
                                <md-list-item><b>Apellidos: </b>{{supervisor.apellidos}}</md-list-item>
                                <md-list-item><b>DPI: </b>{{supervisor.dpi}}</md-list-item>
                                <md-list-item><b>Direccion: </b>{{supervisor.direccion}}</md-list-item>
                                <md-list-item><b>Email: </b>{{supervisor.email}}</md-list-item>
                                <md-list-item><b>Telefono: </b>{{supervisor.telefono}}</md-list-item>
                                <md-list-item><b>Fecha Nacimiento: </b>{{supervisor.fecha_nacimiento}}</md-list-item>
                            </md-list>
                        </div>
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
    name: 'Supervisor',
    props: {
        caption: {
            type: String,
            default: 'Detalles de supervisor'
        },
    },
    mounted: async function () {
        this.supervisor = await this.$getRequest(process.env.VUE_APP_API + '/supervisors/' + this.$route.params.id);
    },
    data: () => {
        return {
            supervisor: null,
        }
    },
    methods: {
        goBack() {
            this.$router.replace({ path: '/supervisores' })
        }
    }
}
</script>
