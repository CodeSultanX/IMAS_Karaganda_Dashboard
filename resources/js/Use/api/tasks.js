import { tasks } from "@/Use/data/items";

export function getTasks(user_id){
    axios.get(`/api/tasks?user_id=${user_id}`)
    .then(res => {
        tasks.value = res.data;
    })
    .catch(error => console.error("Ошибка при получений пометок/поручений:", error));
}

export function createTask(form,user_id){
    axios.post(`/api/tasks`, {
         'id' : form.id,
         'type' : form.type,
         'content' : form.content,
         'user_id' : user_id,
        },{
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
    })
    .then(res => {
        tasks.value = res.data;
        form.reset();
        getTasks(user_id);
    })
    .catch(error => console.error("Ошибка при cозданий пометок/поручений:", error));
}
export function updateTask(form,user_id){
    axios.put(`/api/tasks/${form.task_id}`,  {
        'type' : form.type,
        'content' : form.content,
        'status' : form.status,
        'user_id' : user_id,
        },{
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
    })
    .then(res => {
        getTasks(user_id);
    })
    .catch(error => console.error("Ошибка при обновлений пометок/поручений:", error));
}
export function deleteTask(id,user_id){
    axios.delete(`/api/projects/${id}`)
    .then(res => {
        getTasks(user_id);
    })
    .catch(error => console.error("Ошибка удалений пометок/поручений:", error));
}