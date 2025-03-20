import { problems } from "@/Use/data/items";

export function getProblems(){
    fetch('/api/problems', {
        method: "GET",
    })
    .then(response => response.json())  
    .then(res => {
        problems.value = res.data;
        console.log(res);
    })
    .catch(error => console.error("Ошибка при получений проблемных вопросов:", error));
}

export function createProblem(form,user_id) {
    form.value_regions = form.value_regions.map(f => f.id)
    
    const formData = new FormData();
    formData.append("title",form.title);
    formData.append("result",form.result);
    formData.append("status",form.status);
    formData.append("level",form.level);
    formData.append("color",form.color);
    formData.append("user_id",user_id);
    
    form.images.forEach(image => {
        formData.append("images[]",image);
    });
    form.value_regions.forEach(region_id => {
        formData.append("regions[]",region_id);
    });

    
    fetch('/api/problems', {
        method: "POST",
        body: formData,
    })
        
    .then(response => response.json())  
    .then(res => {
        form.reset();
        getProblems();
    })
    .catch(error => console.error("Ошибка при создании проблемного вопроса:", error));
}
export function updateProblemVisible(problem) {
    
    fetch(`/api/problems/${problem.id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
                'is_visible':problem.is_visible,
            }
        ),
    })
        
    .then(response => response.json())  
    .then(res => {
        console.log(res);
    })
    .catch(error => console.error("Ошибка при обновлений is_visible:", error));
}