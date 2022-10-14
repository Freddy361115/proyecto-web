<template>
  <div class="content">
      <div class="md-layout">
        <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-33">
              <stats-card data-background-color="green">
                  <template slot="header">
                      <md-icon>notifications</md-icon>
                  </template>
  
                  <template slot="content">
                      <p class="category">Total Notificaciones</p>
                      <h3 class="title">
                          {{totalRows}}
                      </h3>
                  </template>
              </stats-card>
          </div>
          <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-33">
              <stats-card data-background-color="orange">
                  <template slot="header">
                      <md-icon>notifications</md-icon>
                  </template>
  
                  <template slot="content">
                      <p class="category">Notificaciones Leidas</p>
                      <h3 class="title">
                          {{leidas["leidas"]}}
                      </h3>
                  </template>
              </stats-card>
          </div>
          <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-33">
              <stats-card data-background-color="red">
                  <template slot="header">
                      <md-icon>notifications</md-icon>
                  </template>
  
                  <template slot="content">
                      <p class="category">Notificaciones No leidas</p>
                      <h3 class="title">
                          {{no_leidas["sin leer"]}}
                      </h3>
                  </template>
              </stats-card>
          </div>
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
                              <md-button class="md-primary" @click="gotoCreate" v-if="rol_id == 1">Crear Notificación</md-button>
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
                              </template>
                          </b-table>
                      </div>
  
                  </md-card-content>
              </md-card>
          </div>
      </div>
  </div>
  </template>
  
  <script>
  import {
      StatsCard,
  } from "@/components";
  
  export default {
  components: {
          StatsCard,
      },
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
              items      : [],
              filter     : '',
              value      : null,
              leidas     : 0,
              no_leidas  : 0,
              isBusy     : false,
              active     : false,
              resource_id: null,
              fields     : [
              {
                      key: 'nombre',
                      label: 'Establecimiento',
                      sortable: true,
                  },
                  {
                      key: 'Profesor',
                      label: 'Profesor',
                      sortable: true,
                  },
                  {
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
                      key: 'descripcion',
                      label: 'Tipo Actividad',
                  },
                  {
                      key: 'state',
                      label: 'Estado',
                      sortable: true,
                  },
                  {
                      key: 'id',
                      label: 'Acciones',
                  }
              ],
              currentPage: 1,
              perPage: 10,
              totalRows: 0
          };
      },
      mounted: function () {
          this.getData();
      },
      methods: {
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
              this.items = await this.$getRequest(process.env.VUE_APP_API + '/misnotificaciones/' + localStorage.user_id);
              this.totalRows = this.items.length;

              this.leidas = await this.$getRequest(process.env.VUE_APP_API + '/misnotificacionesleidas/' + localStorage.user_id);

              this.no_leidas = await this.$getRequest(process.env.VUE_APP_API + '/misnotificacionesnoleidas/' + localStorage.user_id);

              this.isBusy = false;
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
  