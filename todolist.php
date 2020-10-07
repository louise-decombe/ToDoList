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

  $_SESSION['id_utilisateur'] = 1;

  $id_utilisateur = $_SESSION['id_utilisateur'];
  $todolist->select($id_utilisateur);

  ?>
  <main>
    <section>
      <button type="submit" id="new_list" class="btn btn-success">Créer une nouvelle liste</button>
      <div id="addform">
        <div id="error"></div>
        <form action="" method="post" id="add_list_form">
          <div class="form-group">
            <label for="list_name">Nom de la liste</label>
            <input type="text" id="list_name" name="list_name">

          </div>
          <div class="form-group">
            <label for="add_user">Ajouter un utilisateur</label>
            <input type="text" id="add user" name="add_user">
          </div>
          <button type="submit" id="submit_list" class="btn btn-success">Créer ma liste</button>
        </form>
      </div>

      <article>
        <p>display list</p>
      </article>
    </section>
  </main>

  <div class="container">
    <div class="header">
      <div id="date"></div>
    </div>
    <br />
    <br />
    <div class="container">
      <h1 align="center">Votre liste <strong><?php echo $_SESSION['login']; ?></strong> <button type="button" class="btn btn-info">Déconnexion</button>
      </h1>
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
            <form method="get" id="todo_formulaire">
              <span id="message"></span>
              <div class="input-group">
                <input type="text" name="nom_tache" id="nom_tache" class="form-control input-lg" placeholder="Tâche..." />
                <input type="textarea" name="description" id="description" class="form-control input-lg" placeholder="description..." />
                <div class="input-group-btn">
                  <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
                </div>
              </div>
            </form>
            <br />
            <div class="list-group">
              <?php
              foreach ($result as $row) {
                $style = '';
                if ($row["statut"] == 'oui') {
                  $style = 'text-decoration: line-through';
                }
                echo '<a href="#" style="' . $style . '" class="list-group-item" id="list-group-item-' . $row["id"] . '" data-id="' . $row["id"] . '">' . $row["nom"] . '<span class="badge" data-id="' . $row["id"] . '">X</span>' . '<span class="button"><button type="button" class="btn btn-dark">+</button></span>' . '';
              }
              ?>
            </div>
          </div>
          <?php //} else {
          //   echo "<center>vous n'avez pas accès à cette page, connectez-vous pour commencer<br/>
          // <a href='index.php'> connexion/inscription </a></center> ";
          //}
          ?>
</body>
<script src="js/script_todolist.js">

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</html>