import {ref, reactive, inject, computed, watch} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

export default function useBooks() {
    const books = ref([]);
    const total_books = ref([]);
    const book = ref({});
    const sort_option = ref('title-asc');
    const book_page = ref(1);
    const book_page_count = ref(1);
    const router = useRouter();
    const store = inject('store');

    /**
     * @returns {Promise<void>}
     */
    const getBooks = async () => {
        try {
            const response = await axios.get('/api/books',
                {
                    params: {
                        page: book_page.value
                    }
                })
            books.value = response.data.data
            book_page_count.value = response.data?.meta?.total_pages
            total_books.value = response.data?.meta?.total

        } catch (e) {
            console.log(e)
        }

        return false;
    }

    /**
     * @param id
     * @returns {Promise<void>}
     */
    const getBook = async (id) => {
        try {
            let request_config = {}
            const response = await axios.get('/api/books/' + id, request_config)

            book.value = response.data.data
        } catch (e) {
            console.log(e)
        }
        return false;
    }

    /**
     * @returns {Promise<boolean>}
     */
    const storeBook = async () => {
        try {
            const response = await axios.post('/api/books', book.value)
            await router.push('/catalog');

            return response.data;
        } catch (e) {
            console.error(e);
        }
    };


    /**
     * @param id
     * @returns {Promise<boolean>}
     */
    const updateBook = async (id) => {
        try {
            const response = await axios.put('/api/books/' + id, {
                title: book.title,
                author_id: book.author_id,
                status: book.status,
                price: book.price,
                publisher_id: book.publisher_id,
            })
            await router.push('/catalog');

        } catch (e) {
            console.error(e);
            window.alert("Error while update");
        }

        return false;
    }

    /**
     * @param id
     * @returns {Promise<boolean>}
     */
    const destroyBook = async (id) => {
        if (confirm("Are you sure you want to delete this book??")) {
            if (id !== undefined) {
                try {
                    await axios.delete('/api/books/' + id)
                    await getBooks();
                } catch (e) {
                    console.error(e);
                }
            }
        }

        return false;
    }

    /**
     * Sort book title and book
     */
    const sortBooks = () => {
        const sorted_books = [...books.value];
        if (sort_option.value === 'title-asc') {
            sorted_books.sort((a, b) => a.product.title.localeCompare(b.product.title));
        } else if (sort_option.value === 'title-desc') {
            sorted_books.sort((a, b) => b.product.title.localeCompare(a.product.title));
        } else if (sort_option.value === 'book-asc') {
            sorted_books.sort((a, b) => a.book - b.book);
        } else if (sort_option.value === 'book-desc') {
            sorted_books.sort((a, b) => b.book - a.book);
        }
        books.value = sorted_books;
    };

    const changePage = async (page) => {
        book_page.value = page;
        await getBooks();
    };

    /**
     * Next page for pagination
     */
    const nextPage = async () => {
        if (book_page.value < book_page_count.value) {
            book_page.value++;
            await getBooks();
        }
    };

    /**
     * Preview page for pagination
     */
    const prevPage = async () => {
        if (book_page.value > 1) {
            book_page.value--;
            await getBooks();
        }
    };

    watch(sort_option, () => {
        sortBooks();
    });

    return {
        getBook,
        getBooks,
        storeBook,
        updateBook,
        destroyBook,
        changePage,
        nextPage,
        prevPage,
        books,
        book,
        sort_option,
        book_page,
        book_page_count,
        total_books
    }
}
