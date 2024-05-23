<script setup>
import {ref, onMounted} from "vue";
import {useRouter} from "vue-router";
import useBooks from "@composable/book.js";
import useAuthors from "@composable/author.js";
import usePublishers from "@composable/publisher.js";


const router = useRouter();

const {book, storeBook} = useBooks();
const {authors, getAuthors} = useAuthors();
const {publishers, getPublishers} = usePublishers();

const submitForm = async (book) => {
    await storeBook(book);
}

onMounted(() => {
    getAuthors();
    getPublishers();
    console.log(publishers.value, authors)
});
</script>

<template>
    <section class="blog-details spad">
        <div class="container">
            <div class="row">

                <div class="checkout__form col-lg-9">
                    <div class="blog__details__text">
                        <div class="container">
                            <div class="checkout__form">
                                <h4>Add Book</h4>
                                <form >
                                    <div class="row">
                                        <div class="col-lg-8 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="checkout__input">
                                                        <p>Title<span>*</span></p>
                                                        <input
                                                            type="text"
                                                            placeholder="Title"
                                                            v-model="book.title"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="checkout__input">
                                                        <p>Price<span>*</span></p>
                                                        <input
                                                            type="text"
                                                            placeholder="Price"
                                                            v-model="book.price"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="checkout__input">
                                                        <p>Status</p>
                                                        <select
                                                            class="checkout__input select"
                                                            v-model="book.status"
                                                        >
                                                            <option value="available">available</option>
                                                            <option value="sold_out">sold_out</option>
                                                            <option value="coming_soon">coming_soon</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="checkout__input">
                                                        <p>Author<span>*</span></p>
                                                        <select class="checkout__input select"
                                                                v-model="book.author_id"
                                                        >
                                                            <option
                                                                v-for="author_item in authors"
                                                                :key="author_item.id"
                                                                :value="author_item.id"
                                                            >
                                                                {{ author_item.name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="checkout__input">
                                                        <p>Publisher<span>*</span></p>
                                                        <select class="checkout__input select"
                                                                v-model="book.publisher_id"
                                                        >
                                                            <option
                                                                v-for="publisher_item in publishers"
                                                                :key="publisher_item.id"
                                                                :value="publisher_item.id"
                                                            >
                                                                {{ publisher_item.name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 text-left">
                                            <button
                                                type="submit"
                                                class="site-btn"
                                                @click.prevent="submitForm(book)"
                                            >
                                                ЗБЕРЕГТИ
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.blog-details {
    padding-top: 0px;
}

.checkout__input input.checkout__input__add__image {
    border: none !important;
}

.pagination button {
    flex-grow: 1;
}

.pagination button:hover {
    cursor: pointer;
}
</style>
