import { regions } from "@/Use/data/items";

export function getRegions(){
    fetch('/api/regions', {
        method: "GET",
    })
    .then(response => response.json())  
    .then(res => {
        regions.value = res;
    })
    .catch(error => console.error("Ошибка при получений регионов", error));
}