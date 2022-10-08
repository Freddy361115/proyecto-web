<template>
<div>
    <li class="md-list-item">
        <div class="md-list-item-content">
            <drop-down>
                <md-button slot="title" class="md-button md-just-icon md-simple" data-toggle="dropdown">
                    <md-icon>notifications</md-icon>
                    <span class="notification">15</span>
                    <p class="hidden-lg hidden-md">Notifications</p>
                </md-button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#">Mike John responded to your email</a></li>
                    <li><a href="#">You have 5 new tasks</a></li>
                    <li><a href="#">You're now friend with Andrew</a></li>
                    <li><a href="#">Another Notification</a></li>
                    <li><a href="#">Another One</a></li>
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
        };
    },
    methods: {
        getData() {
            // this.$showNotification('danger', 'El campo email es requerido', 'check');
        }
    },
    mounted() {
        this.getData();
        setInterval(this.getData, 25000);
    },
};
</script>
