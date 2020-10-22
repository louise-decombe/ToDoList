<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("Location:index.php");
}


?>
<!DOCTYPE html>
<html>

<head>
  <title>Ma belle Todo Liste</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="src/fontello/css/fontello.css">
  <link rel="stylesheet" href="style.css">
  <script src="js/script.js"></script>
</head>

<body>
  <header>
    <?php include 'includes/header.php' ?>
  </header>


  <main class="main_todo">
    

    <section id="first_sect_todo">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Mes Listes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav" id="nav-list">

          </div>
        </div>
      </nav>

      <div id="error" class="m-3"></div>
      <div id="success" class="m-3"></div>
      <button type="submit" id="new_list" class="btn btn-success ml-3">Créer une nouvelle liste</button>
      <button type="submit" id="cancel" class="btn btn-danger ml-3">Annuler</button>
      <div id="addform">

        <form method="POST" id="add_list_form">
          <div class="form-row">
            <div class="col m-1">

              <input type="text" id="name" name="name" class="form-control" placeholder="Nom de la liste">
            </div>
            <div class="col m-1">

              <input type="text" id="username" name="username" class="form-control" placeholder="Ajouter un utilisateur à cette liste">
            </div>
          </div>
          <input type="hidden" id="iduser" name="iduser" value=<?= $_SESSION['id'] ?>>
          <div class="d-flex justify-content-end">
            <button type="submit" id="submit_list" class="btn btn-success p-2 m-3">Créer ma liste</button>
          </div>

        </form>
      </div>

      <article class="big_container_list">
        <div class="list_container p-3"></div>
      </article>
    </section>

    <section id="second_sect_todo">
    <div id="title_list_name" class="text-center m-3"></div>
      <article class="list_content">

        <div class="formadduser">
          <button type="submit" class=" btn btn-info m-3" id="add_user_btn">Ajouter un utilisateur à cette liste</button>
          <button type="submit" id="cancel_adduser" class="btn btn-danger m-3">Annuler</button>
          <div id="error_user"></div>
          <div id="success_user"></div>
          <form method="POST" id="add_user_tolist" class="m-3">
            <div class="">
              <div class="col m-1">

                <input type="text" id="add_username" name="add_username" class="form-control" placeholder="Nom de l'utilisateur">
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" id="submit_adduser" class="btn btn-success p-2 m-3">Ajouter cet utilisateur</button>
              </div>

          </form>

        </div>

        <form method="post" id="todo_formulaire">
          <span id="message"></span>
          <div class="input-group">
            <input type="text" name="nom_tache" id="nom_tache" class="form-control input-lg" placeholder="Tâche..." />
            <input type="textarea" name="description" id="description" class="form-control input-lg" placeholder="description..." />
            <select name="select_user" id="select_user" class="form-control">

            </select>

            <div class="input-group-btn">
              <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg ml-3"><span class="glyphicon glyphicon-plus m-3">Ajouter</span></button>
            </div>
          </div>
        </form>

        <div class="display_tasks">
          <div class="task_todo">
            
            
          </div>
          <div class="task_done">
            
          </div>

        </div>
        <div class="row ">
          <div class="col m-3">
            <button class="btn btn-danger" type="submit" id="delete_list">Supprimer cette liste</button>
          </div>

        </div>

      </article>


    </section>

  </main>



  <footer><?php include 'includes/footer.php' ?> </footer>

</body>
<script src="js/script_todolist.js"></script>


</html>