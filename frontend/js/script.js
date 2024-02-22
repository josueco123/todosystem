import * as TaskApi from "../js/ApiCalls/TaskCalls.js"


document.getElementById("due_date").min = new Date().toISOString().split("T")[0];

async function getTasks(){
    const data = await TaskApi.getTasks();
    return data;
}

$(document).ready(function() {
    showtasks();

   
    async function showtasks() {
        $("#lista-tareas").empty();

        const response = await getTasks();
        const tasks = response.tasks;
        tasks.forEach(function(task) {
          let state = "";
          switch (task.estate) {
            case "Pendiente":
              state = "badge bg-warning rounded-pill";
              break;
            case "Cancelada":
              state = "badge bg-danger rounded-pill";
              break;
            case "Realizada":
              state = "badge bg-success rounded-pill";
              break;
          }
            $("#lista-tareas").append(`
              <div class="card w-75">
                <div class="card-body">
                  <h4 class="card-title">${task.title}</h4>
                  <p class="card-text"> ${task.description}</p>
                  <span class="badge ${state} ">${task.estate}</span>
                  <button class="btn btn-danger btn-sm float-end evt-delete" data-id="${task.id}" ">Eliminar</button>
                  <button class="btn btn-primary btn-sm float-end me-2 evt-edit-modal" data-bs-toggle="modal" data-bs-target="#editModal" data-name="${task.title}" data-id="${task.id}">Editar</button>
                  
                </div>
              </div>
            `);
          });
    }

    $("body").on("click", ".evt-save", function (e) {  
        e.preventDefault();
        
        const form = $( "#form-addtask" );
        form.validate();
        if(form.valid()){

          const dataForm = form.serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
          }, {});

          TaskApi.createTasks(dataForm).then((response) =>{
            if(response.state){
              Swal.fire('!Éxito!','Tarea guardada con Exito','success');
              
              showtasks();  
            }else {
              Swal.fire('Error','Hubo un error al guardar la tarea','error');    
            }
            $("#addModal").modal("hide");
          });
        }
      });


      $('body').on("click", ".evt-edit-modal", function (e) { 
        e.preventDefault();
        const id = $(this).attr("data-id");
        const nameTask = $(this).attr("data-name");
        console.log(nameTask);
        $("#form-edittask").append(`<input type="hidden" name="id" value="${id}">`);
        $("#nametask").text(nameTask);
        $("#estate_id").empty();

            TaskApi.getTasksStates().then((data) =>{
              const select = $('#estate_id');
              const states = data.states;
              for (let i = 0; i < states.length; i++) {
                  let o = $('<option/>', { value: states[i].id })
                  .text(states[i].name)
                  o.appendTo(select);
              } 
            })    
    });

    $('body').on("click", ".evt-update", function (e) {
      e.preventDefault();
      
      const dataForm = $('#form-edittask').serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
      }, {});
      
     
      TaskApi.updateTasksById(dataForm).then((response) =>{
        if(response.state){
          Swal.fire('!Éxito!','Tarea actulizada con Exito','success');
          
          showtasks();  
        }else {
          Swal.fire('Error','Hubo un error al Actualizar','error');    
        }
        $("#editModal").modal("hide");
        
      });
      
    })
    
    $("body").on("click", ".evt-delete", function (e) { 
        e.preventDefault(); 
       const id = $(this).attr("data-id");

       Swal.fire({
        title: "Eliminar Tarea",
        text: "¿Esta seguro que deseas eliminar esta tarea?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: "Cancelar"
      }).then(function (result) {
        if (result.value) {
          TaskApi.deleteTasksById(id).then((response)=>{
            if(response.result){
              Swal.fire('!Éxito!','Eliminado con Exito','success');
              showtasks();        
            }else {
              Swal.fire('Error','Hubo un error al Eliminar','error');    
            }
          })
        }
      })
    });

    

    $("body").on("click", ".evt-report", function (e) {  
      e.preventDefault();

      TaskApi.getTasks().then((data) =>{
        const dataExcel = [
          ['Titulo','Descripcion', 'Estado', 'Fecha Creacion', 'Fecha Fin']
        ]
       const tasks = data.tasks;
        tasks.forEach(function(task) {
          dataExcel.push([task.title, task.description, task.estate, task.created_at, task.due_date])
        })

        const sheet = XLSX.utils.aoa_to_sheet(dataExcel);
    
        const bookCal = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(bookCal, sheet, 'Datos');
    
        XLSX.writeFile(bookCal, 'reporte_tares.xlsx');
      })
  
    });

})





