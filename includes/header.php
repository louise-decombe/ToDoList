<div class="heading">
    <h1>To Do List</h1>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['login'])) : ?>
                    <a class="nav-link" href="todolist.php">Mes listes</a>
                <?php endif ?>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['login'])) : ?>
                    <a class="nav-link" href="logout.php">Se déconnecter</a>
                <?php endif ?>
            </li>

        </ul>
    </div>
</nav>