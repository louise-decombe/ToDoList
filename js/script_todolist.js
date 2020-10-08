$(document).ready(function () {

  $(document).on('submit', '#todo_formulaire', function (event) {
    event.preventDefault();
    
    // GET LIST ID
    function getUrlParameter(name) {
      name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
      var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
      var results = regex.exec(location.search);
      return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };
    id_list = getUrlParameter('idlist');


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
          idlist: id_list,
        },

        success: function (data) {
          console.log(data);
          $('#submit').attr('disabled', false);
          $('#todo_formulaire')[0].reset();
          $('.list-group').prepend(data);

        },
        error: function (data) {
          console.log(data)
        }
      })
    }
  });

  $(document).on('click', '.list-group-item', function () {
    var id = $(this).data('id');
    $.ajax({
      url: "traitement/todolist_process.php?maj",
      method: "POST",
      data: {
        id: id
      },
      success: function (data) {
        $('#list-group-item-' + id).css('text-decoration', 'line-through').fadeOut('slow');
      }
    })


  });

  $(document).on('click', '.badge', function () {
    var id = $(this).data('id');
    $.ajax({
      url: "traitement/todolist_process.php?supprimer",
      method: "GET",
      data: {
        id: id
      },
      success: function (data) {
        $('#list-group-item-' + id).fadeOut('slow');
      }
    })
  });

});


$(function () {
  $('#description').on('click', function (e) {
    e.preventDefault();
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $(this).next()
        .stop()
        .slideUp(300);
    } else {
      $(this).addClass('active');
      $(this).next()
        .stop()
        .slideDown(500);
    }
  });
});