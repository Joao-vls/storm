<?php
include "banco.php";
if(!isset($_SESSION)){
  session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="jq.css">
  <script type="text/javascript" src="jquery/jquery-3.6.2.js"></script>
  <script type="text/javascript" src="jquery/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="jquery/jquery-ui.min.css">
  <script src="https://kit.fontawesome.com/9f72a03fbd.js" crossorigin="anonymous"></script>
  <title>Storm</title>
</head>
<body>
  <div class="load">
    <div class="loader">
    </div>
  </div>

  <main id="principal">

  </main>

  <nav id="nav-menu">
    <hr>

    <div class="img-nm">

      <img class="img-1" src="img/per.png" name="ir_perfil" alt="perfil">
      <?php
      if (isset($_SESSION['id_s'])){
        echo '<div class="balao_perfil">
        <a href="user.php" class="lin_perfil"><img class="usr_ft_per" src="'.$_SESSION['imgper'].'" alt=""><p>'.$_SESSION['nome'].'</p><p>@'.$_SESSION['id_name'].'</p></a>
        <div class="lin_sair">
        <hr>
        <a href="sair.php">
        <i class="fa-solid fa-door-open"></i>sair</a>
        </div>
        </div>';
      }
        ?>
      <img class="img-2" src="img/parafuso.png" name="ir_home" alt="principal">

      <?php
      if (isset($_SESSION['id_s'])){
        echo '<nav class="opca">
        <button type="button" name="notifica"><i class="fa-solid fa-bell fa-lg"></i></button>
        <button type="button" name="escrever"><i class="fa-solid fa-pen-to-square fa-lg"></i></button>
        <button type="button" name="chat" ><i class="fa-solid fa-comments fa-lg"></i></button>
        </nav>';
      }
      ?>
      <img class="img-3" src="img/en.png" name="ir_config" alt="configuracao">

      </div>
    </nav>
    <script type="text/javascript" src="js.js"></script>
  </body>
  </html>
