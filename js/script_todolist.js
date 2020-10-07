$(document).ready(function () {

  $(document).on('submit', '#todo_formulaire', function (event) {
    event.preventDefault();

    if ($('#nom_tache').val() == '') {
      $('#message').html('<div class="alert alert-danger">Il faut écrire quelque chose</div>');
      return false;
    } else {
      $('#submit').attr('disabled', 'disabled');
      $.ajax({
        url: "traitement/todolist_process.php?ajouter",
        method: "GET",
        data: $(this).serialize(),
        success: function (data) {
          $('#submit').attr('disabled', false);
          $('#todo_formulaire')[0].reset();
          $('.list-group').prepend(data);
        }
      })
    }
  });

  $(document).on('click', '.list-group-item', function () {
    var id = $(this).data('id');
    $.ajax({
      url: "traitement/todolist_process?maj.php",
      method: "GET",
      data: {
        id: id
      },
      success: function (data) {
        $('#list-group-item-' + id).css('text-decoration', 'line-through');
      }
    })
  });

  $(document).on('click', '.badge', function () {
    var id = $(this).data('id');
    $.ajax({
      url: "traitement/todolist_process?supprimer.php",
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