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
        method: "POST",
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
      url: "traitement/todolist_process.php?maj",
      method: "POST",
      data: {
        id: id
      },
      success: function (data) {
        $('#list-group-item-' + id).css('text-decoration', 'line-through').fadeOut('slow');
      }
    })
    setInterval(function, 500);

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


$(function() {
$('#description').on('click', function(e) {
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
