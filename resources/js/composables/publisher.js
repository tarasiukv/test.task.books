import {ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

export default function usePublishers() {
    const publishers = ref([]);
    const publisher = ref({});
    const router = useRouter();

    /**
     * @returns {Promise<void>}
     */
    const getPublishers = async () => {
        try {
            const response = await axios.get('/api/publishers')
            publishers.value = response.data.data

        } catch (e) {
            console.log(e)
        }

        return false;
    }

    /**
     * @param id
     * @returns {Promise<void>}
     */
    const getPublisher = async (id) => {
        try {
            let request_config = {}
            const response = await axios.get('/api/publishers/' + id, request_config)

            publisher.value = response.data.data
        } catch (e) {
            console.log(e)
        }
        return false;
    }

    /**
     * @returns {Promise<boolean>}
     */
    const storePublisher = async () => {
        try {
            const response = await axios.post('/api/publishers', publisher.value)

            return response.data;
        } catch (e) {
            console.error(e);
        }
    };


    /**
     * @param id
     * @returns {Promise<boolean>}
     */
    const updatePublisher = async (id) => {
        try {
            const response = await axios.put('/api/publishers/' + id, {
                name: publisher.name
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
    const destroyPublisher = async (id) => {
        if (id !== undefined) {
            try {
                await axios.delete('/api/publishers/' + id)
                await getPublishers();
            } catch (e) {
                console.error(e);
            }
        }

        return false;
    }

    return {
        getPublisher,
        getPublishers,
        storePublisher,
        updatePublisher,
        destroyPublisher,
        publishers,
        publisher
    }
}
