import { problems } from "@/Use/data/items";

export function getProblems(){
    fetch('/api/problems', {
        method: "GET",
    })
    .then(response => response.json())  
    .then(res => {
        problems.value = res;
    })
    .catch(error => console.error("Ошибка при получений проблемных вопросов:", error));
}
export function fillterProblems(data){
    const levels = data.value_levels.map(l => l.value).join(',');
    const regions = data.value_regions.map(r => r.id).join(',');
    const visible = data.visible;
    const f_date = new Date(data.startDate).toISOString().split('T')[0];
    const s_date = new Date(data.endDate).toISOString().split('T')[0];

    const query = new URLSearchParams({
        levels : levels,
        regions : regions,
        visible : visible,
        f_date : f_date,
        s_date : s_date,
    }).toString();

    fetch(`/api/problems/search?${query}`, {
        method: "GET",
    })
    .then(response => response.json())
    .then(res => {
        problems.value = res;
    })
    .catch(error => console.error("Ошибка при получений проблемных вопросов:", error));
}
export function deleteProblem(problem){
    fetch(`/api/problems/${problem}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
    })
    .then(response => response.json())  
    .then(res => {
        getProblems();
    })
    .catch(error => console.error("Ошибка при удалений проблемного вопроса:", error));
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
    formData.append("project_id",form.project_id);
    
    form.images.forEach(image => {
        formData.append("images[]",image);
    });
    form.value_regions.forEach(region_id => {
        formData.append("regions[]",region_id);
    });

    fetch('/api/problems', {
        method: "POST",
        headers: {
            "Accept": "application/json"
        },
        body: formData,
    })
        
    .then(response => response.json())  
    .then(res => {
        console.log(res);
        form.reset();
        getProblems();
    })
    .catch(error => console.error("Ошибка при создании проблемного вопроса:", error));
}
export function updateProblemVisible(id,is_visible) {
    fetch(`/api/problems/updateVisible/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({
                'is_visible':is_visible
            }
        ),
    })
        
    .then(response => response.json())  
    .then(res => {
        console.log(res);
    })
    .catch(error => console.error("Ошибка при обновлений is_visible:", error));
}

export function udpateProblem(form) {
    const formData = new FormData();
    formData.append("_method", "PUT");
    formData.append("title",form.title);
    formData.append("result",form.result);
    formData.append("status",form.status);
    formData.append("level",form.level);
    formData.append("color",form.color);
    formData.append("project_id",form.project_id);
    
    form.images.forEach(image => {
        formData.append("images[]",image);
    });

    form.value_regions = form.value_regions.map(f => f.id)
    form.value_regions.forEach(region_id => {
        formData.append("regions[]",region_id);
    });

    fetch(`/api/problems/${form.id}`, {
        method: "POST", // Меняем на POST (Laravel сам обработает PUT через _method)
        headers: {
            "Accept": "application/json"
        },
        body: formData,
    })
        
    .then(response => response.json())  
    .then(res => {
        getProblems();
        console.log(res);
    })
    .catch(error => console.error("Ошибка при обновлений проблемного вопроса:", error));
}