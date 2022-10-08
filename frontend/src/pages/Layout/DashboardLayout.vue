<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <notifications></notifications>

    <side-bar
      :sidebar-item-color="sidebarBackground"
      :sidebar-background-image="sidebarBackgroundImage"
    >
      <mobile-menu slot="content"></mobile-menu>
      <sidebar-link to="/dashboard">
        <md-icon>home</md-icon>
        <p>Inicio</p>
      </sidebar-link>
      <sidebar-link to="/profesores" v-if="rol_id == 1">
        <md-icon >person</md-icon>
        <p>Profesores</p>
      </sidebar-link>
      <sidebar-link to="/establecimientos" v-if="rol_id == 1">
        <md-icon>domain</md-icon>
        <p>Establecimientos</p>
      </sidebar-link>
      <sidebar-link to="/supervisores" v-if="rol_id == 1">
        <md-icon>book</md-icon>
        <p>Supervisores</p>
      </sidebar-link>
      <sidebar-link to="/notificaciones">
        <md-icon>notifications</md-icon>
        <p>Notificaciones</p>
      </sidebar-link>
    </side-bar>

    <div class="main-panel">
      <top-navbar></top-navbar>
      <dashboard-content> </dashboard-content>

      <content-footer v-if="!$route.meta.hideFooter"></content-footer>
    </div>
  </div>
</template>

<script>
import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import DashboardContent from "./Content.vue";
import MobileMenu from "@/pages/Layout/MobileMenu.vue";

export default {
  components: {
    TopNavbar,
    DashboardContent,
    ContentFooter,
    MobileMenu
  },
  data() {
    return {
      sidebarBackground: "green",
      rol_id: localStorage.rol_id,
      sidebarBackgroundImage: require("@/assets/img/sidebar-2.jpg"),
    };
  },
};
</script>
