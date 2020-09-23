import Home from "./components/Home";
import loginForm from "./components/loginForm";
import registerForm from "./components/registerForm";
import Books from "./components/Books";


export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Home
        },
        {
          path: '/books',
          component: Books
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
