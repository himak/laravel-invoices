import { ref } from 'vue'

export default function useItems() {
    const items = ref([])

    const getItems = async () => {
        axios.get('/api/items')
            .then(response => {
                items.value = response.data.data;
            })
    }

    return { items, getItems }
}
