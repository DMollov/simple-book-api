<template>
    <div class="container">
        Hello boss {{ user.name }}

        <button class="py-2 px-4 bg-teal-500 rounded text-white" @click="logout">Logout</button>
    </div>
</template>
<script>
export default {
    computed: {
        user: {
            get() {
                return this.$store.state.users.user;
            }
        }
    },
    methods: {
        logout() {
            axios.post('/api/user/logout').then( response => {
                localStorage.removeItem('accessToken');
                window.location.href = "/login"
            })
        }
    },
    created() {
        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem('accessToken');
        this.$store.dispatch('users/getUser');
    }
}
</script>
