import { problems } from "@/Use/data/items";

export function getProblems(){
    axios.get('/api/problems')
    .then(res => {
        problems.value = res.data;
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

    axios.get(`/api/problems/search?${query}`)
    
    .then(res => {
        problems.value = res.data;
    })
    .catch(error => console.error("Ошибка при получений проблемных вопросов:", error));
}
export function deleteProblem(problem){
    axios.delete(`/api/problems/${problem}`, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
    })
      
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

    axios.post('/api/problems',formData, {
        headers: {
            "Accept": "application/json"
        },
    })
    .then(res => {
        form.reset();
        getProblems();
    })
    .catch(error => console.error("Ошибка при создании проблемного вопроса:", error));
}
export function updateProblemVisible(id,is_visible) {
    axios.put(`/api/problems/updateVisible/${id}`,{'is_visible':is_visible}, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
    })
        
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

    axios.post(`/api/problems/${form.id}`,formData ,{
        headers: {
            "Accept": "application/json"
        },
    })
    .then(res => {
        getProblems();
        console.log(res);
    })
    .catch(error => console.error("Ошибка при обновлений проблемного вопроса:", error));
}