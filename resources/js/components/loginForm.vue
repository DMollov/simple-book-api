<template>
    <div class="flex container justify-center items-center h-screen">
        <form class="bg-white max-w-md w-full shadow-md rounded px-4 pt-6 pb-8 mb-4">
            <div v-if="formErrors" class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg mt-4 px-4">
                <div v-for="(v, k) in formErrors" :key="k">
                    <p v-for="error in v" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input v-model="user.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input v-model="user.password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                <p class="text-red-500 text-xs italic" v-show="false">Please choose a password.</p>
            </div>
            <div class="flex items-center justify-between">
                <button @click.prevent="login" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import {mapState} from "vuex";

export default {
    data: () => ({
        user: {
            email: "",
            password: "",
        }
    }),
    computed: {
        ...mapState('users', ['formErrors']),
    },
    methods: {
        login() {
            this.$store.dispatch('users/loginUser', this.user)
        }
    }
}
</script>
