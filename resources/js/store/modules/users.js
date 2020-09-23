const state = {
    user: {},
    authors: {},
    formErrors: null
};
const getters = {};
const actions = {
    getAuthors({commit}) {
        axios.get('/api/user/authors').then(response => {
            commit('SET_AUTHORS', response.data);
        });
    },
    loginUser({commit}, user) {
        axios.post("/api/user/login", {
            email: user.email,
            password: user.password
        }).then(response => {
            if (response.data.access_token) {
                localStorage.setItem('accessToken', response.data.access_token)
                window.location.replace('/dashboard')
            }
        }).catch(error => {
            commit('SET_ERRORS', error.response.data.errors)
        })
    },
    register({commit}, user) {
        axios.post('/api/user/register', {
            name: user.name,
            email: user.email,
            password: user.password,
            password_confirmation: user.password_confirmation,
            is_author: user.is_author,
            notifications: user.notifications,
        }).then(response => {
            if (response.data.access_token) {
                localStorage.setItem('accessToken', response.data.access_token)
                window.location.replace('/')
            }
        }).catch(error => {
            commit('SET_ERRORS', error.response.data.errors)
        })
    }
};
const mutations = {
    SET_USER(state, data) {
        state.user = data;
    },
    SET_AUTHORS(state, data) {
        state.authors = data;
    },
    SET_ERRORS(state, data) {
        state.formErrors = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
