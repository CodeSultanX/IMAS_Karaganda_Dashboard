import { projects } from "@/Use/data/items";

export function getProjects(user_id){
    fetch(`/api/problems?user_id=${user_id}`, {
        method: "GET",
    })
    .then(response => response.json())  
    .then(res => {
        projects.value = res.data;
    })
    .catch(error => console.error("Ошибка при получений проектов:", error));
}

export function createProject(form,user_id){
    fetch(`/api/projects?user_id=${user_id}`,{
        method: "POST",
        body:JSON.stringify({
            'title' : form.title,
            'f_date' : form.f_date,
            's_date' : form.s_date
        })
    })
    .then(response => response.json())
    .then(res => {
        projects.value = res.data;
        form.reset();
    })
    .catch(error => console.error("Ошибка при cозданий проекта:", error));
}