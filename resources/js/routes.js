import Home from "./components/Home";
import loginForm from "./components/loginForm";


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
    ],
}
