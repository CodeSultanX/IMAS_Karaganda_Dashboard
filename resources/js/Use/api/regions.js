import { regions } from "@/Use/data/items";

export function getRegions(){
    axios.get('/api/regions')
    .then(res => {
        regions.value = res.data;
    })
    .catch(error => console.error("Ошибка при получений регионов", error));
}