<template>
<div class="content">
    <div class="md-layout">
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
            <md-card>
                <md-card-header data-background-color="green">
                    <h4 class="title">Notificaciones</h4>
                    <p class="category">Listado Notificaciones</p>
                </md-card-header>
                <md-card-content>
                    <div class="md-layout">
                        <div class="md-layout-item md-small-size-100 md-size-33">
                            <md-field>
                                <label>Buscar...</label>
                                <md-input v-model="filter" type="text"></md-input>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-33">
                        </div>
                        <div class="md-layout-item md-small-size-100 md-size-33" style="text-align:right;">
                            <md-button class="md-primary" @click="gotoCreate">Crear Notificación</md-button>
                        </div>
                    </div>
                    <br>
                    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                        <b-table :hover="hover" @filtered="onFiltered" :striped="striped" :busy="isBusy" :bordered="bordered" :small="small" :fixed="fixed" responsive="xs" :items="items" :fields="fields" :current-page="currentPage" :per-page="perPage" :filter="filter" class="md-table">
                            <template #table-busy>
                                <div class="text-center text-warning my-2">
                                    <b-spinner class="align-middle"></b-spinner>
                                    <strong> Cargando...</strong>
                                </div>
                            </template>
                            <template slot="Nombres" slot-scope="data">
                                <strong>{{data.item.names}}</strong>
                            </template>
                            <template #cell(id)="data">
                                <md-button class="md-primary md-just-icon" @click="gotoDetails(data.item.id)">
                                    <md-icon>search</md-icon>
                                </md-button>
                                <md-button class="md-danger md-just-icon" @click="showConfirm(data.item.id)">
                                    <md-icon>delete</md-icon>
                                </md-button>
                            </template>
                        </b-table>
                        <nav>
                            <b-pagination class="rounded" size="sm" :total-rows="totalRows" :per-page="perPage" v-model="currentPage" prev-text="Prev" next-text="Next" hide-goto-end-buttons />
                        </nav>
                    </div>

                </md-card-content>
            </md-card>
        </div>
    </div>
    <div>
        <md-dialog-confirm :md-active.sync="active" md-title="Confirmar eliminar notificacion?" md-content="Esta seguro de eliminar el notificacion seleccionado?" md-confirm-text="Confirmar" md-cancel-text="Cancelar" @md-cancel="onCancel" @md-confirm="onConfirm" />
    </div>
</div>
</template>

<script>
export default {
    props: {
        caption: {
            type: String,
            default: 'Notificaciones'
        },
        hover: {
            type: Boolean,
            default: true
        },
        striped: {
            type: Boolean,
            default: true
        },
        bordered: {
            type: Boolean,
            default: false
        },
        small: {
            type: Boolean,
            default: false
        },
        fixed: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            items: [],
            filter: '',
            value: null,
            isBusy: false,
            active: false,
            resource_id: null,
            fields: [{
                    key: 'titulo_actividad',
                    label: 'Titulo',
                    sortable: true,
                },
                {
                    key: 'fecha_inicial',
                    label: 'Fecha Inicial',
                    sortable: true,
                },
                {
                    key: 'fecha_final',
                    label: 'fecha Final',
                    sortable: true,
                },
                {
                    key: 'id_tipo_actividad',
                    label: 'Tipo Actividad',
                },
                {
                    key: 'id',
                    label: 'Acciones',
                }
            ],
            currentPage: 1,
            perPage: 10,
            totalRows: 0
        }
    },
    mounted: function () {
        this.getData();
    },
    methods: {
        onConfirm() {
            this.sendDelete();
        },
        onCancel() {
            this.value = 'Disagreed'
        },
        onFiltered(filteredItems) {
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        getRowCount(items) {
            return items.length
        },
        gotoCreate() {
            this.$router.push({
                name: 'CrearNotificacion'
            });
        },
        async getData() {
            this.isBusy = true;
            this.items = await this.$getRequest(process.env.VUE_APP_API + '/notificacion');
            this.totalRows = this.items.length;
            this.isBusy = false;
        },
        async sendDelete() {
            let response = await this.$deleteRequest(process.env.VUE_APP_API + '/notificacion/' + this.resource_id);
            if (response.success) {
                this.active = false;
                this.getData();
            }
        },
        gotoDetails(id) {
            this.$router.push(`notificaciones/${id.toString()}`);
        },
        showConfirm(id) {
            this.resource_id = id;
            this.active = true
        },
    },
};
</script>

<style scoped>
.card-body>>>table>tbody>tr>td {
    cursor: pointer;
}
</style>
