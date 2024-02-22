

const ENDPOINT_PATH = "http://localhost/panatest/backend";

export async function  getTasks()  {

    const result = await  fetch(ENDPOINT_PATH);
    const response = await result.json();
    return response;
};

export async function  getTasksStates()  {

    const result = await  fetch(ENDPOINT_PATH + '?states');
    const response = await result.json();
    return response;
};

export async function getTasksById(id){

    const result = await  fetch(ENDPOINT_PATH + '?id=' +id);
    const response = await result.json();
    return response;
};

export async function createTasks(task){

    const result = await  fetch(ENDPOINT_PATH + '?save', {
        method: 'PUT',
        body: JSON.stringify(task) 
    });
    const response = await result.json();
    return response;
};


export async function updateTasksById(task){

    const result = await  fetch(ENDPOINT_PATH,{
        method: 'PUT',
        body: JSON.stringify(task) 
    });
    const response = await result.json();
    return response;
};

export async function deleteTasksById(id){

    const result = await  fetch(ENDPOINT_PATH + '?id=' +id ,{
        method: 'DELETE',
    });
    const response = await result.json();
    return response;
};

