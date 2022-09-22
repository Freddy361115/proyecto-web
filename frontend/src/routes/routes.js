import DashboardLayout from "@/pages/Layout/DashboardLayout.vue";

import Dashboard from "@/pages/Dashboard.vue";
import BlankPage from "@/pages/BlankPage.vue";

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
      }
    ],
  },
];

export default routes;
