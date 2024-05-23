<script setup>
import {onMounted} from "vue";
import {useRouter} from "vue-router";
import useBooks from "@composable/book.js";

const router = useRouter();
const {
    books,
    sort_option,
    book_page,
    book_page_count,
    total_books,
    getBooks,
    changePage,
    nextPage,
    prevPage
} = useBooks();

onMounted(async () => {
    await getBooks();
});
</script>

<template>
    <div>
        <section class="product">
            <div class="container">
                <div class="sidebar">
                    <div class="col-lg-6 col-md-6">
                        <div class="filter__sort">
                            <span>Сортувати за</span>
                            <div class="select-wrapper">
                                <select
                                    class="sort"
                                    v-model="sort_option"
                                >
                                    <option value="title-asc">title (A-Z)</option>
                                    <option value="title-desc">title (Z-А)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="filter__found">
                        <h6><span>{{ total_books }}</span> Books found</h6>
                    </div>
                </div>
                <div class="product__items">
                    <div v-for="book in books" :key="book.id" class="product__item">
                        <a :href="'/book/' + book.id">
                        <h3>{{ book.title }}</h3>
                        <p><strong>Author:</strong> {{ book.author.name }}</p>
                        <p><strong>Price:</strong> ${{ book.price }}</p>
                        </a>
                    </div>
                </div>
                <div class="product__pagination">
                    <a
                        v-if="book_page > 1"
                        @click="prevPage"
                        href="#"
                    >
                        <i><<</i>
                    </a>
                    <a
                        v-for="page in book_page_count"
                        :key="page"
                        :class="{ active: page === book_page }"
                        @click="changePage(page)"
                        href="#"
                    >
                        {{ page }}
                    </a>
                    <a
                        v-if="book_page < book_page_count"
                        @click="nextPage"
                        href="#"
                    >
                        <i>>></i>
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>

</style>
