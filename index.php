<?php include('init.php'); ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
  <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <!-- xCRUD CSS -->
  <?php echo Xcrud::load_css() ?>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/cover.css" rel="stylesheet">

  <title>Printful Trial - Quiz</title>

</head>

<body>
  <div id="errors"></div>

  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand">Do you quiz?</h3>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link switcher active" data-target=".start" href="#">Quiz</a>
          <a class="nav-link switcher" data-target=".ranking" href="#">Ranking</a>
          <a class="nav-link switcher" data-target=".admin" href="#">Admin</a>
        </nav>
      </div>
    </header>

    <article class="start cover collapse">
      <h1 class="cover-heading">Get ready for some quests</h1>
      <p class="lead">Here are some Random questions about "Who knows what". Each correct answer will give you 10 points. Let's see how well are you prepared. Good Luck &amp; Have fun!</p>
      <p class="lead">
        <button id="takeme" class="btn btn-lg btn-secondary switcher" data-target=".prepare">Let's start!</button>
      </p>
    </article>

    <article class="sorry collapse">
      <h1 class="cover-heading">You had your chance!</h1>
      <p class="lead">Check your score @ Ranking</p>
      <p class="lead">Go ahead &amp; disguise as different hero or even better - Try Your luck in some other topic perhaps?</p>
    </article>

    <article class="prepare collapse">
      <form id="prepare-form" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Pick a name &amp; topic</h1>
        <input type="username" id="inputUser" name="hero_name" class="form-control" placeholder="Nickname" required autofocus>
        <div class="form-group">
          <select class="form-control" id="topic" name="hero_topic" required>
          <option value="" selected disabled>Choose your topic</option>
           <?php include('php/topics.php'); ?>
          </select>
        </div>
        <button id="begin" type="submit" class="btn btn-lg btn-primary btn-block" data-target=".quiz">Begin!</button>
      </form>
    </article>

    <article class="quiz collapse">
      <form id="quiz-form" class="quiz-form" method="post">
        <h1 class="h5 mb-3 font-weight-normal">Total progress:
          <div id="info" </>
        </h1>
        <div class="progress">
          <div id="progress" class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="10" style="width: 0%"></div>
        </div>
        <br>
        <h1 class="h2 mb-3 font-weight-normal">
          <div id="questing"></div>
        </h1>

        <div id="question" class="h2 mb-3 font-weight-normal text-center"></div>

        <div class="container">
          <div class="row">
            <div id="choices-left" class="col">
              <!-- Generates ood choices LEFT Column here-->
            </div>
            <div id="choices-right" class="col">
              <!-- Generates even choices LEFT Column here-->
            </div>
          </div>

      </form>
    </article>

    <!--  Ranking   -->
    <article class="ranking collapse">
      <?php echo $xcrud_lederboard->render(); ?>
    </article>
    <!--  Ranking   -->

    <article class="admin collapse">

      <div class="signin">
        <form id="admin-signin" class="admin-signin" method="POST">
          <h1 class="h3 mb-3 font-weight-normal">Admin, is that you?</h1>
          <label for="inputAdmin" class="sr-only">Username</label>
          <input type="username" id="inputAdmin" class="form-control" placeholder="Username" name="user" required="" autofocus="">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pass" autocomplete="off" required="">
          <button id="admin-btn" class="btn btn-lg btn-primary btn-block login" type="button">Sign in</button>
        </form>
      </div>
    </article>

    <div id="xcrud" class="crud collapse">
      <?php
        echo $xcrud_topics->render();
        echo $xcrud_heroes->render();
        echo $xcrud_quests->render();
        ?>
    </div>

    <footer class="mastfoot mt-auto">
      <div class="inner">
        <p><a target="_blank" href="https://getbootstrap.com/">Bootstrap - I choose you</a>, by Emils <a href="https://dtech.id.lv/quiz">@dtech</a>.</p>
      </div>
    </footer>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <?php echo Xcrud::load_js() ?>
</body>

</html>