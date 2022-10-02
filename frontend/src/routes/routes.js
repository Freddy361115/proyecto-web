import DashboardLayout from "@/pages/Layout/DashboardLayout.vue";

import Dashboard from "@/pages/Dashboard.vue";
import BlankPage from "@/pages/BlankPage.vue";
import SupervisorListado from "@/pages/Supervisor/Listado.vue";
import SupervisorCrear from "@/pages/Supervisor/Crear.vue";
import SupervisorVer from "@/pages/Supervisor/Ver.vue";
import SupervisorEditar from "@/pages/Supervisor/Editar.vue";

//  ESTABLECIMIENTOS
import EstablecimientoListado from "@/pages/Establecimiento/Listado.vue";
import EstablecimientoCrear from "@/pages/Establecimiento/Crear.vue";
import EstablecimientoVer from "@/pages/Establecimiento/Ver.vue";
import EstablecimientoEditar from "@/pages/Establecimiento/Editar.vue";

// PROFESORES
import ProfesorListado from "@/pages/Profesor/Listado.vue";
import ProfesorCrear from "@/pages/Profesor/Crear.vue";
import ProfesorVer from "@/pages/Profesor/Ver.vue";
import ProfesorEditar from "@/pages/Profesor/Editar.vue";

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
      {
        path: "establecimientos",
        name: "Establecimientos",
        component: EstablecimientoListado,
      },
      {
        path: "establecimientos/crear",
        name: "CrearEstablecimiento",
        component: EstablecimientoCrear,
      },
      {
        path: "establecimiento/:id",
        name: "Establecimiento",
        component: EstablecimientoVer,
      },
      {
        path: "establecimiento/editar/:id",
        name: "EditarEstablecimiento",
        component: EstablecimientoEditar,
      },
      {
        path: "profesores",
        name: "Profesores",
        component: ProfesorListado,
      },
      {
        path: "profesores/crear",
        name: "CrearProfesor",
        component: ProfesorCrear,
      },
      {
        path: "profesor/:id",
        name: "Profesor",
        component: ProfesorVer,
      },
      {
        path: "profesor/editar/:id",
        name: "EditarProfesor",
        component: ProfesorEditar,
      },
    ],
  },
];

export default routes;
