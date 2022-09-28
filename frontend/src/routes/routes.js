import DashboardLayout from "@/pages/Layout/DashboardLayout.vue";

import Dashboard from "@/pages/Dashboard.vue";
import BlankPage from "@/pages/BlankPage.vue";
import SupervisorListado from "@/pages/Supervisor/Listado.vue";
import SupervisorCrear from "@/pages/Supervisor/Crear.vue";
import SupervisorVer from "@/pages/Supervisor/Ver.vue";
import SupervisorEditar from "@/pages/Supervisor/Editar.vue";

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/dashboard",
    children: [
      {
        path: "dashboard",
        name: "Dashboard",
        component: Dashboard,
      },
      {
        path: "blank",
        name: "Blank Page",
        component: BlankPage,
      },
      {
        path: "supervisores",
        name: "Supervisores",
        component: SupervisorListado,
      },
      {
        path: "supervisores/crear",
        name: "CrearSupervisor",
        component: SupervisorCrear,
      },
      {
        path: "supervisor/:id",
        name: "Supervisor",
        component: SupervisorVer,
      },
      {
        path: "supervisor/editar/:id",
        name: "EditarSupervisor",
        component: SupervisorEditar,
      },
    ],
  },
];

export default routes;
