import { projects } from "@/Use/data/items";

export function getProjects(user_id){
    fetch(`/api/projects?user_id=${user_id}`, {
        method: "GET",
    })
    .then(response => response.json())  
    .then(res => {
        projects.value = res;
    })
    .catch(error => console.error("Ошибка при получений проектов:", error));
}

export function createProject(form,user_id){
    fetch(`/api/projects`,{
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body:JSON.stringify({
            'name' : form.title,
            'f_date' : form.startDate,
            's_date' : form.endDate,
            'user_id' : user_id,
        })
    })
    .then(response => response.json())
    .then(res => {
        projects.value = res.data;
        form.reset();
        getProjects(user_id);
    })
    .catch(error => console.error("Ошибка при cозданий проекта:", error));
}
export function updateProject(form,user_id){
    fetch(`/api/projects/${form.id}`,{
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body:JSON.stringify({
            'name' : form.title,
            'f_date' : form.startDate,
            's_date' : form.endDate,
        })
    })
    .then(response => response.json())
    .then(res => {
        console.log(res);
        getProjects(user_id);
    })
    .catch(error => console.error("Ошибка при обновлений проекта:", error));
}
export function deleteProject(id,user_id){
    fetch(`/api/projects/${id}`,{
        method: "DELETE",
    })
    .then(response => response.json())
    .then(res => {
        getProjects(user_id);
    })
    .catch(error => console.error("Ошибка удалений проекта:", error));
}