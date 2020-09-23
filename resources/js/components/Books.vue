<template>
    <div class="container">
        <div v-if="formErrors" class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg mt-4 px-4">
            <div v-for="(v, k) in formErrors" :key="k">
                <p v-for="error in v" :key="error" class="text-sm">
                    {{ error }}
                </p>
            </div>
        </div>
        <form class="flex flex-wrap mt-8 border-b border-gray-300" enctype="multipart/form-data">
            <div class="w-1/2 px-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="title">Title</label>
                <input type="text" v-model="bookForm.title" class="appearance-none block w-full border border-gray-600 rounded py-3 px-4 mb-3">
            </div>
            <div class="w-1/2 px-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="author">Select an author</label>
                <div class="relative">
                    <select v-model="bookForm.author_id" class="block appearance-none w-full bg-grey-lighter border border-gray-600 text-gray-600 py-3 px-4 pr-8 rounded">
                        <option v-for="author in authors" :key="author.id" :value="author.id">{{ author.name }}</option>
                    </select>
                    <div class="pointer-events-none absolute right-0 top-0 bottom-0 flex items-center px-2 text-grey-800">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="w-full px-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">Description</label>
                <textarea type="text" v-model="bookForm.description" class="appearance-none block w-full border border-gray-600 rounded py-3 px-4 mb-3"></textarea>
            </div>

            <div class="flex justify-between w-full my-4 px-4">
                <div class="overflow-hidden relative w-64">
                    <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 w-full inline-flex items-center" @click.prevent>
                        <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                        </svg>
                        <span class="ml-2">Upload a cover image</span>
                    </button>
                    <input class="cursor-pointer absolute block opacity-0 right-0 top-0" type="file" v-on:change="selectFile">
                </div>
                <button @click.prevent="addBook" class="py-2 px-4 bg-teal-500 text-white font-bold">Add a book</button>
            </div>
            <div class="my-2">
            </div>
        </form>
        <div class="w-full flex flex-wrap">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <div v-for="book in books" :key="book.id" class="rounded overflow-hidden shadow-lg">
                    <img class="w-full" :src="book.cover">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ book.title }}</div>
                        <p class="text-gray-700 text-base">
                            {{ book.description }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ book.author.name }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    data: () => ({
        bookForm: {
            title: "",
            description: "",
            author_id: "",
            cover: null,
        }
    }),
    computed: {
        ...mapState('books', ['books', 'formErrors']),
        ...mapState('users', ['authors'])
    },
    methods: {
        getBooks() {
            this.$store.dispatch('books/getBooks');
        },
        getAuthors() {
            this.$store.dispatch('users/getAuthors');
        },
        selectFile(event) {
            this.bookForm.cover = event.target.files[0];
        },
        addBook() {
            const data = new FormData();
            data.append('title', this.bookForm.title);
            data.append('description', this.bookForm.description);
            data.append('author_id', this.bookForm.author_id);
            data.append('cover', this.bookForm.cover);
            this.$store.dispatch('books/addBook', data).then(() => {
                this.bookForm.title = '';
                this.bookForm.description = '';
                this.bookForm.author_id = '';
                this.bookForm.cover = null;
            });
        }
    },
    mounted() {
        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem('accessToken');
        this.getBooks()
        this.getAuthors()
    },
}
</script>
