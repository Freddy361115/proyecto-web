<template>
<md-toolbar md-elevation="0" class="md-transparent">
    <div class="md-toolbar-row">
        <div class="md-toolbar-section-start">
            <h3 class="md-title">{{ $route.name }}</h3>
        </div>
        <div class="md-toolbar-section-end">
            <md-button class="md-just-icon md-simple md-toolbar-toggle" :class="{ toggled: $sidebar.showSidebar }" @click="toggleSidebar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </md-button>

            <div class="md-collapse">
                <md-list>
                    <md-list-item href="#/">
                        <i class="material-icons">dashboard</i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </md-list-item>

                    <!-- <md-list-item href="#/notifications" class="dropdown">
              <drop-down>
                <a slot="title" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="hidden-lg hidden-md">Notifications</p>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#">Mike John responded to your email</a></li>
                  <li><a href="#">You have 5 new tasks</a></li>
                  <li><a href="#">You're now friend with Andrew</a></li>
                  <li><a href="#">Another Notification</a></li>
                  <li><a href="#">Another One</a></li>
                </ul>
              </drop-down>
            </md-list-item> -->

                    <notifications></notifications>

                    <li class="md-list-item">
                        <div class="md-list-item-content">
                            <drop-down>
                                <md-button slot="title" class="md-button md-just-icon md-simple" data-toggle="dropdown">
                                    <md-icon>person</md-icon>
                                    <p class="hidden-lg hidden-md">user</p>
                                </md-button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                      <md-card>
                                        <center><h3>{{username}}</h3></center>
                                      </md-card>
                                    </li>
                                    <li><a href="#" @click="logOut">Cerrar Sesion</a></li>
                                </ul>
                            </drop-down>
                        </div>
                    </li>
                </md-list>
            </div>
        </div>
    </div>
</md-toolbar>
</template>

<script>
import {
    Notifications,
} from "@/components";

export default {
    components: {
        Notifications,
    },
    data() {
        return {
            selectedEmployee: null,
            username: JSON.parse(localStorage.user_data).name
        };
    },
    methods: {
        toggleSidebar() {
            this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
        },
        logOut() {
          localStorage.clear();
          this.$router.push('login');
        }
    },
};
</script>

<style lang="css"></style>
