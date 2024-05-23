<script setup>
import {onMounted} from 'vue';
import {useRoute} from 'vue-router';
import useBooks from "@composable/book.js";

const route = useRoute();
const {book, getBook} = useBooks();

const book_id = route.params.id;

onMounted(async () => {
    await getBook(book_id);
});
</script>

<template>
    <section class="product-details">
        <div class="container">
            <div class="product__details__text">
                <h3>{{ book.title }}</h3>
                <div class="product__details__price">{{ book.price }}</div>
                <ul>
                    <li><b>Publisher:</b> <span>{{book.publisher.name }}</span></li>
                    <li><b>Author:</b> <span>{{ book.author.name }}</span></li>
                    <li><b>Status:</b> <span>{{ book.status }}</span></li>
                </ul>
            </div>
            <div class="container">
                <div class="product__details__tab">
                    <h6>Description of book</h6>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
