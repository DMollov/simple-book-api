import Home from "./components/Home";
import loginForm from "./components/loginForm";
import registerForm from "./components/registerForm";


export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/login',
            component: loginForm,
        },
        {
            path: '/register',
            component: registerForm
        }
    ],
}
