const state = {
    user: {},
    formErrors: null
};
const getters = {};
const actions = {
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
    }
};
const mutations = {
    SET_USER(state, data) {
        state.user = data;
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
