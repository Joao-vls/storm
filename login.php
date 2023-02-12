<?php
if(!isset($_SESSION)){
  session_start();
}
if (isset($_SESSION['id_s'])) {
  header("location:index.php");
}

if (isset($_GET['Login_emailnu']) && $_GET['Login_emailnu']!=""
&& isset($_GET['Login_senha']) && $_GET['Login_senha']!="") {
  include "banco.php";
  $usr= array();

  $usr['emailnu'] =$my_Db_Connection->quote($_GET['Login_emailnu']);
  $usr['senha']= $_GET['Login_senha'];
  $sql_bus="SELECT * FROM users WHERE email_numero = ".$usr['emailnu']."";
  $bus = $my_Db_Connection->prepare($sql_bus);
  $bus->execute();
  $count = $bus->rowCount();
  if ($count == 1) {
    $result = $bus->fetch(PDO::FETCH_ASSOC);
    if(password_verify($usr['senha'],$result['senha'])){
      $_SESSION['id_s']=uniqid().'s'.rand(1,1000).'s'.uniqid();
      $_SESSION['emailnu']=$result['email_numero'];
      $_SESSION['id_name']=$result['id_nome'];
      $_SESSION['nome']=$result['nome'];
      $_SESSION['imgper']=$result['img_perfil'];
      $_SESSION['idade']=$result['idade'];
      $_SESSION['diacadas']=$result['dia_cadastro'];
      $data = new DateTime();
      $data=$data->format('Y/m/d H:i');
      $bus = $my_Db_Connection->prepare("UPDATE users SET login_date = :lda, id_session = :ids WHERE email_numero = :id");
      $bus->bindParam(':lda', $data);
      $bus->bindParam(':id', $result['email_numero']);
      $bus->bindParam(':ids', $_SESSION['id_s']);
      if($bus->execute()){
        header("location:index.php");
      }else {
        header("location:login.php");
      }
    }

  } else {
    header("location:login.php");
  }


}
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Storm</title>
  <script type="text/javascript" src="jquery/jquery-3.6.2.js"></script>
  <script src="https://kit.fontawesome.com/9f72a03fbd.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="jq.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <section class="h-100 gradient-form " style="background-color: #0a0011e8; color: white;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="rounded-3">
            <div class="row g-0" style="background-color: #180c20e8;">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4"  style="background-color: #180c20e8;">

                  <div class="text-center">
                    <img src="img/parafuso.png"
                    style="width: 185px;   filter:saturate(1000%);" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">Storm</h4>
                  </div>

                  <form  method = "GET">
                    <p>Entrar</p>
                    <div class="form-outline mb-4">
                      <input type="email" name="Login_emailnu" id="login_id_emailnu"  class="form-control"
                      placeholder="Phone number or email address" />
                      <label class="form-label" for="login_id_emailnu">Username</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" name="Login_senha" id="form2Example22"   class="form-control" />
                      <label class="form-label" for="form2Example22">Password</label>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                        in</button>
                        <a class="text-muted" href="#!">Esqueceu senha?</a>
                      </div>

                      <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Não tem conta?</p>
                        <a href="cadastro.php" target="_self" class="btn btn-outline-success">Criar</a>
                      </div>

                    </form>

                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">We are more than just a company</h4>
                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                      exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </body>
    </html>
