<?php

include('class/config.php');



?>
<!DOCTYPE html>
<html>

<head>
  <title>Ma belle Todo Liste</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-list-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
        </svg> Ma TODO Liste
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link" href="#">Mon compte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Ma todolist</a>
          </li>

        </ul>
      </div>
    </nav>
  </header>

  <?php //if(isset($_SESSION['id_utilisateur'])) {

  

  $id_utilisateur = $_SESSION['id'];
  $todolist->select($id_utilisateur);

  ?>

  <main>
    <section id="first_sect_todo">
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

      <article>
        <div class="list_container">

        </div>
      </article>
    </section>
  </main>

  <div class="header">
    <div id="date"></div>
  </div>
  <div class="container">
    <h1 align="center">Votre liste <strong><?php echo $_SESSION['login']; ?></strong> <button type="button" class="btn btn-info">Déconnexion</button></h1>
    <br />
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-9">
            <h3 class="panel-title">
              <?php
              setlocale(LC_TIME, 'fra_fra');
              echo strftime('%A %d %B %Y à %H:%M');
              ?>
            </h3>
            <img src="" alt="">
            <div class="clear">
              <i class="fa fa-refresh"></i>
            </div>
          </div>
          <div class="col-md-3">
          </div>
        </div>
        <div class="panel-body">
          <form method="post" id="todo_formulaire">
            <span id="message"></span>
            <div class="input-group">
              <input type="text" name="nom_tache" id="nom_tache" class="form-control input-lg" placeholder="Tâche..." />
              <input type="textarea" name="description" id="description" class="form-control input-lg" placeholder="description..." />
              <select name="select_user" id="select_user" class="form-control">
                <option id="select_user_opt" value="">Attribuer cette tâche à:</option>
              </select>

              <div class="input-group-btn">
                <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
              </div>
            </div>
          </form>
          <br />
          <div class="list-group">
            <div class="todo">

              <?php
              $id_list = $_GET['idlist'];
              $result = $db->query("SELECT * FROM todo WHERE statut='non' AND id_list='$id_list'");

              foreach ($result as $row) {

                foreach ($result as $row) {

                  $style = '';
                  if ($row->statut == 'non') {

                    echo '<a href="#" style="' . $style . '" class="list-group-item" id="list-group-item-' . $row->id . '" data-id="' . $row->id . '"><b>' . $row->nom . '</b><span class="badge" data-id="' . $row->id . '">X</span>' . '<section>' . $row->description . '</section>';
                  }
                }
              }

              ?>


            </div>
            <div class="done">
              <?php
              $result = $db->query("SELECT * FROM todo WHERE statut='oui' AND id_list='$id_list'");

              foreach ($result as $row) {

                $style = '';
                if ($row->statut == 'oui') {

                  echo '<p style="' . $style . '" class="list-group-item" id="list-group-item-' . $row->id . '" data-id="' . $row->id . '">' . 'terminé le :   ' . $row->finished_at . '   <b>' . $row->nom . '</b><span class="badge" data-id="' . $row->id . '">X</span>';
                }
              }
              ?></div>
          </div>
        </div>
        <?php //} else {
        //   echo "<center>vous n'avez pas accès à cette page, connectez-vous pour commencer<br/>
        // <a href='index.php'> connexion/inscription </a></center> ";
        //}
        ?>
</body>
<script src="js/script_todolist.js"></script>


</html>