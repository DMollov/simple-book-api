import Home from "./components/Home";
import loginForm from "./components/loginForm";
import registerForm from "./components/registerForm";
import Books from "./components/Books";
import Dashboard from "./components/Dashboard";


export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Home
        },
        {
          path: '/dashboard',
          component: Dashboard,
          meta: {
              requiresAuth: true
          }
        },
        {
            path: '/books',
            component: Books,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/login',
            component: loginForm,
            meta: {
                onlyGuest: true
            }
        },
        {
            path: '/register',
            component: registerForm,
            meta: {
                onlyGuest: true
            }
        }
    ],
    linkActiveClass: "border-b-2 border-teal-500"
}
