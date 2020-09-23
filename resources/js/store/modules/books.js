const state = {
    books: '',
    formErrors: null
};
const getters = {};
const actions = {
    getBooks({commit}) {
        axios.get('/api/books').then(response => {
            commit('SET_BOOKS', response.data.data)
        }).catch(error => {
            console.log(error)
        })
    },
    addBook({commit}, bookForm) {
        axios.post('/api/books', bookForm).then(response => {
            commit('ADD_BOOK', response.data)
            console.log(response.data)
        }).catch(error => {
            commit('SET_ERRORS', error.response.data.errors)
        })
    }
};
const mutations = {
    SET_BOOKS(state, data) {
        state.books = data;
    },
    ADD_BOOK(state, data) {
        state.books.push(data.data);
    },
    SET_ERRORS(state, data) {
        state.formErrors = data;
    }
};

export default {
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
