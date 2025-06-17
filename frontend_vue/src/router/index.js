// import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'

// const router = createRouter({
//   history: createWebHistory(import.meta.env.BASE_URL),
//   routes: [
//     {
//       path: '/',
//       name: 'home',
//       component: HomeView,
//     },
//     {
//       path: '/about',
//       name: 'about',
//       // route level code-splitting
//       // this generates a separate chunk (About.[hash].js) for this route
//       // which is lazy-loaded when the route is visited.
//       component: () => import('../views/AboutView.vue'),
//     },
//   ],
// })

// export default router
import { createRouter, createWebHistory } from "vue-router";
import InvoiceList from "../components/InvoiceList.vue";
import AddInvoice from "../components/AddInvoice.vue";
import MainComponent from "@/components/MainComponent.vue";
import BaseInput from "@/components/BaseInput.vue";
import SendOtp from "@/components/SendOtp.vue";
import InvoiceForn from "@/components/InvoiceForn.vue";
import Task from "@/components/Task.vue";

const routes = [
  { path: "/list", component: InvoiceList },
  { path: "/addInvoice", component: AddInvoice },
  { path: "/", component: MainComponent },
  { path: "/baseInput", component: BaseInput },
  { path: "/sendOtp", component: SendOtp },
  { path: "/invoiceForm", component: InvoiceForn },
  { path: "/toDoList", component: Task },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

