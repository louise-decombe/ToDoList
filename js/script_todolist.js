$(document).ready(function () {

  // GET LIST ID
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
  };

  var idlist = getUrlParameter('idlist');

  $(document).on('submit', '#todo_formulaire', function (event) {

    event.preventDefault();




    if ($('#nom_tache').val() == '') {
      $('#message').html('<div class="alert alert-danger">Il faut écrire quelque chose</div>');
      return false;

    } else {
      console.log('ok')
      $('#submit').attr('disabled', 'disabled');
      let task_name = $('#nom_tache').val();
      let description = $('#description').val();
      let select_user = $('#select_user').val();

      $.ajax({
        url: "traitement/todolist_process.php?ajouter",
        method: "POST",
        data: {
          nom_tache: task_name,
          description: description,
          select_user: select_user,
          idlist: idlist,
        },

        success: function (data) {
          console.log(data);
          $('#submit').attr('disabled', false);
          $('#todo_formulaire')[0].reset();
          $('.list-group').prepend(data);
          display_task()
          displayTaskDone();

        },
        error: function (data) {
          console.log(data)
        }
      })
    }

  })

  function templateTaskTodo(task_name, create_at, description, user_name, id) {
    return (`<div class="content_task">
    
    <div class="task_name">
      <p class="font-weight-bold">${task_name} <br> <span class="font-weight-light">Crée le ${create_at}</p>
      <h6>Description</h6>
      <p>${description}</p>
      
    </div>
    <div class="assignedto">
      <p class="badge-info text-center font-weight-bold p-3">Attribué à ${user_name}</p>
    </div>
    <div class="button_done">
      <form action="" method="post" id="finished_task">
        <input type="hidden" id="task_id" value="${id}">
        <button type="submit" name="finish" id="finish_button" class="btn btn-warning ml-3">Terminé</button>
      </form>
      <form action="" method="post" id="delete_task">
        <input type="hidden" id="delete_id" value="${id}">
        <button type="submit" name="delete" id="delete_button" class="btn btn-danger m-3">Supprimer</button>
      </form>
    </div>
  </div>`).trim()
  }

  function templateTaskDone(task_name, finished_at, description, user_name, id) {
    return (`
    <div class="content_task">
    
    <div class="task_name">
      <p>${task_name} <br> <span class="font-weight-light">Terminée le ${finished_at}</p>
      <h6>Description</h6>
      <p>${description}</p>
    </div>
    <div class="assignedto">
      <p class="badge-secondary p-3 ">Réalisé par : ${user_name}</p>
    </div>

  </div>`).trim()
  }

  function display_task() {


    $.ajax({
      url: "traitement/display_task.php",
      type: "post",
      dataType: "json",
      data: {
        idlist: idlist,
      },
      success: function (data) {

        $('.task_todo').empty();

        console.log(data)

        $('.task_todo').append('<h2>Liste des tâches</h2>')
        console.log(data.length)
        if (data.length == 0) {
          $('.task_todo').append('<h4 class="text-center mt-5">Vous n\'avez aucune tâche en cours</h4>')
        } else {
          for (let i = 0; i < data.length; i++) {

            $('.task_todo').append(templateTaskTodo(data[i].nom, data[i].create_at, data[i].description, data[i].assign_to, data[i][0]))
            


          }
        }

        $('#finished_task').submit(function (event) {
          event.preventDefault();
          let id_task = $('#task_id').val();
          console.log(id_task)

          $.ajax({
            url: "traitement/update_task.php",
            type: "post",
            data: {
              id: id_task,
            },
            success: function (data) {
              console.log(data)
              displayTaskDone();
              display_task();

            },error: function (data) {
              console.log(data)
            }
          })

        })

        $('#delete_task').submit(function (event) {
          event.preventDefault();
          let delete_id = $('#delete_id').val();
          console.log(delete_id);

          $.ajax({
            url: "traitement/delete_task.php",
            type: "post",
            data: {
              delete_id: delete_id,
            },
            success: function (data) {
              console.log(data)
              displayTaskDone();
              display_task();
            }
          })





        })


      },
      error: function (data) {
        console.log(data)
      }

    })



  }
  display_task()

  function displayTaskDone() {
    $.ajax({
      url: "traitement/display_taskDone.php",
      type: "post",
      dataType: "json",
      data: {
        idlist: idlist,
      },
      success: function (data) {

        $('.task_done').empty();

        console.log(data)

        $('.task_done').append('<h2>Tâches terminées</h2>')
        for (let i = 0; i < data.length; i++) {

          $('.task_done').append(templateTaskDone(data[i].nom, data[i].finished_at, data[i].description, data[i].assign_to, data[i].id))
        }
      },
      error: function (data) {
        console.log(data)
      }

    })


  }
  displayTaskDone();





})