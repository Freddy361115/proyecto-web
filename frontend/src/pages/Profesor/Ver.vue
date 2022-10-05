<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">Detalles Profesor</h4>
                    </md-card-header>
                    <md-card-content>
                        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                            <md-list>
                                <md-list-item><b>Nombres: </b>{{profesor.nombres}}</md-list-item>
                                <md-list-item><b>Apellidos: </b>{{profesor.apellidos}}</md-list-item>
                                <md-list-item><b>DPI: </b>{{profesor.dpi}}</md-list-item>
                                <md-list-item><b>Direccion: </b>{{profesor.direccion}}</md-list-item>
                                <md-list-item><b>Email: </b>{{profesor.email}}</md-list-item>
                                <md-list-item><b>Telefono: </b>{{profesor.telefono}}</md-list-item>
                                <md-list-item><b>Establecimiento: </b>{{profesor.nombre_establecimiento}}</md-list-item>
                                <md-list-item><b>Fecha Nacimiento: </b>{{profesor.fecha_nacimiento}}</md-list-item>
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
    name: 'Profesor',
    props: {
        caption: {
            type: String,
            default: 'Detalles de Profesor'
        },
    },
    mounted: async function () {
        this.profesor = await this.$getRequest(process.env.VUE_APP_API + '/profesores/' + this.$route.params.id);
    },
    data: () => {
        return {
            profesor: null,
        }
    },
    methods: {
        goBack() {
            this.$router.replace({ path: '/profesores' })
        }
    }
}
</script>
