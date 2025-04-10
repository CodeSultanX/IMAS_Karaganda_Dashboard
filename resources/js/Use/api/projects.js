import { projects } from "@/Use/data/items";

export function getProjects(user_id){
    axios.get(`/api/projects?user_id=${user_id}`)
    .then(res => {
        projects.value = res.data;
    })
    .catch(error => console.error("Ошибка при получений проектов:", error));
}

export function createProject(form,user_id){
    axios.post(`/api/projects`, {
        'name' : form.title,
        'f_date' : form.startDate,
        's_date' : form.endDate,
        'user_id' : user_id,
    },{
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
    })
    .then(res => {
        projects.value = res.data;
        form.reset();
        getProjects(user_id);
    })
    .catch(error => console.error("Ошибка при cозданий проекта:", error));
}
export function updateProject(form,user_id){
    axios.put(`/api/projects/${form.id}`, {
        'name' : form.title,
        'f_date' : form.startDate,
        's_date' : form.endDate,
    },{
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
    })
    .then(res => {
        getProjects(user_id);
    })
    .catch(error => console.error("Ошибка при обновлений проекта:", error));
}
export function deleteProject(id,user_id){
    axios.delete(`/api/projects/${id}`)
    .then(res => {
        getProjects(user_id);
    })
    .catch(error => console.error("Ошибка удалений проекта:", error));
}