<?php

include('class/config.php');
if (!isset($_SESSION['login'])) {
  header("Location:index.php");
}
if(!isset($_GET['idlist'])){
  $a = 1;
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

  <?php //if(isset($_SESSION['id_utilisateur'])) {



  $id_utilisateur = $_SESSION['id'];
  $todolist->select($id_utilisateur);

  ?>

  <main class="main_todo">
    <h1 class="text-center" id="title">Mes Listes</h1>
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

      <article class="big_container_list">
        <div class="list_container p-3"></div>
      </article>
    </section>

    <section id="second_sect_todo">

      <div class="container">
        <h1 class="text-center" id="title_list_name"></h1>
        <br />
        <div class="panel panel-default">
          <div class="panel-heading">
            <div>
              <div>
                <h3 class="panel-title p-3">
                  <?php
                  setlocale(LC_TIME, 'fra_fra');
                  echo strftime('%A %d %B %Y à %H:%M');
                  ?>
                </h3>

              </div>
              <div class="formadduser">
                <button type="submit" class=" btn btn-info" id="add_user_btn">Ajouter un utilisateur à cette liste</button>
                <button type="submit" id="cancel_adduser" class="btn btn-danger ml-3">Annuler</button>
                <div id="error_user"></div>
                <div id="success_user"></div>
                <form method="POST" id="add_user_tolist" class="m-3">
                  <div class="form-row">
                    <div class="col m-1">

                      <input type="text" id="add_username" name="add_username" class="form-control" placeholder="Nom de l'utilisateur">
                    </div>

                  </div>


                  <div class="d-flex justify-content-end">
                    <button type="submit" id="submit_adduser" class="btn btn-success p-2 m-3">Ajouter cet utilisateur</button>
                  </div>

                </form>

              </div>
              <div class="row ">
                <div class="col m-3">
                  <button class="btn btn-danger" type="submit" id="delete_list">Supprimer cette liste</button>
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

                    </select>

                    <div class="input-group-btn">
                      <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg ml-3"><span class="glyphicon glyphicon-plus m-3">Ajouter</span></button>
                    </div>
                  </div>
                </form>
                <br />
                <div class="list-group">
                  <div class="todo">
                    <?php if (isset($_GET['idlist'])) : ?>
                      <?php
                      $idlist = $_GET['idlist'];
                      $result = $db->query("SELECT * FROM todo WHERE statut='non' AND idlist='$idlist'");
                     
                      foreach ($result as $row) {

                        foreach ($result as $row) {

                          $style = '';
                          if ($row->statut == 'non') {

                            echo '<a href="#" style="' . $style . '" class="list-group-item" id="list-group-item-' . $row->id . '" data-id="' . $row->id . '"><b>' . $row->nom . "  " . '</b>' . '<span class="badge" data-id="' . $row->id . '">X</span>' . '<span class=badge badge-secondary> Assigné à  ' . $row->assign_to . '</span>' . '</a>' . '<section>' . $row->description . '</section>';
                          }
                        }
                      }

                      ?>

                  </div>
                  <div class="done">

                    <?php
                      $result = $db->query("SELECT * FROM todo WHERE statut='oui' AND idlist='$idlist'");

                      foreach ($result as $row) {
                        $style = '';
                        if ($row->statut == 'oui') {

                          echo '<a href="#" style="' . $style . '" class="list-group-item" id="list-group-item-' . $row->id . '" data-id="' . $row->id . '">' . $row->nom . ' <span class="badge" data-id="' . $row->id . '">X</span></a>';
                        }
                      }
                    ?></div>
                <?php endif ?>

                <div class="d-flex justify-content-end"><p id="goback" class=" btn btn-info m-3">Retour aux listes</p></div>
                </div>

    </section>

  </main>



  <footer><?php include 'includes/footer.php' ?> </footer>

</body>
<script src="js/script_todolist.js"></script>


</html>