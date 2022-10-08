<template>
<div>
    <li class="md-list-item">
        <div class="md-list-item-content">
            <drop-down>
                <md-button slot="title" class="md-button md-just-icon md-simple" data-toggle="dropdown">
                    <md-icon>notifications</md-icon>
                    <span v-if="pending > 0" class="notification">{{pending}}</span>
                    <p class="hidden-lg hidden-md">Notifications</p>
                </md-button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li v-for="noti in notifications"><a href="#" @click="gotoDetails(noti.id)">
                            <md-icon v-if="noti.estado == 1" class="text-danger">warning</md-icon> {{noti.titulo_actividad}}
                        </a></li>
                </ul>
            </drop-down>
        </div>
    </li>
</div>
</template>

<script>
export default {
    name: "notifications",
    data() {
        return {
            chartId: "no-id",
            notifications: [],
            pending: 0,
            data: null
        };
    },
    methods: {
        async getData() {
            this.notifications = await this.$getRequest(process.env.VUE_APP_API + '/misnotificaciones/' + localStorage.user_id);
            this.pending = this.notifications.filter(function(element){
                return element.estado == 1;
            }).length;
        },
        gotoDetails(id) {
            this.$router.push({
                name: 'Notificacion',
                params: {
                    id: id
                }
            });
        },
    },

    mounted() {
        this.getData();
        setInterval(this.getData, 25000);
    },
};
</script>
