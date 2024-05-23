import {ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

export default function useAuthors() {
    const authors = ref([]);
    const author = ref({});
    const router = useRouter();

    /**
     * @returns {Promise<void>}
     */
    const getAuthors = async () => {
        try {
            const response = await axios.get('/api/authors')
            authors.value = response.data.data

        } catch (e) {
            console.log(e)
        }

        return false;
    }

    /**
     * @param id
     * @returns {Promise<void>}
     */
    const getAuthor = async (id) => {
        try {
            let request_config = {}
            const response = await axios.get('/api/authors/' + id, request_config)

            author.value = response.data.data
        } catch (e) {
            console.log(e)
        }
        return false;
    }

    /**
     * @returns {Promise<boolean>}
     */
    const storeAuthor = async () => {
        try {
            const response = await axios.post('/api/authors', author.value)

            return response.data;
        } catch (e) {
            console.error(e);
        }
    };


    /**
     * @param id
     * @returns {Promise<boolean>}
     */
    const updateAuthor = async (id) => {
        try {
            const response = await axios.put('/api/authors/' + id, {
                name: author.name
            })

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
    const destroyAuthor = async (id) => {
        if (id !== undefined) {
            try {
                await axios.delete('/api/authors/' + id)
                await getAuthors();
            } catch (e) {
                console.error(e);
            }
        }

        return false;
    }

    return {
        getAuthor,
        getAuthors,
        storeAuthor,
        updateAuthor,
        destroyAuthor,
        authors,
        author
    }
}
