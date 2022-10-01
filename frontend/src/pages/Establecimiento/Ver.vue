<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">Detalles Establecimiento</h4>
                    </md-card-header>
                    <md-card-content>
                        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100" v-if="establecimiento">
                            <md-list>
                                <md-list-item><b>Nombre: </b>{{establecimiento.nombre}}</md-list-item>
                                <md-list-item><b>Direccion: </b>{{establecimiento.direccion}}</md-list-item>
                                <md-list-item><b>Email: </b>{{establecimiento.email}}</md-list-item>
                                <md-list-item><b>Telefono: </b>{{establecimiento.telefono}}</md-list-item>
                                <md-list-item><b>Codigo Establecimiento: </b>{{establecimiento.codigo_establecimiento}}</md-list-item>
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
    name: 'Establecimiento',
    props: {
        caption: {
            type: String,
            default: 'Detalles de establecimiento'
        },
    },
    mounted: async function () {
        this.establecimiento = await this.$getRequest(process.env.VUE_APP_API + '/establecimientos/' + this.$route.params.id);
    },
    data: () => {
        return {
            establecimiento: null,
        }
    },
    methods: {
        goBack() {
            this.$router.replace({ path: '/establecimientos' })
        }
    }
}
</script>
