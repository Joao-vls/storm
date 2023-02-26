<?php
if(!isset($_SESSION)){
  session_start();
}
if (isset($_SESSION['id_nome'])) {
  header("location:index.php");
}
include "validarcamposcad.php";

if(validar_info()){
  include "banco.php";
  $email_nume=$_POST['Cadast_emainu'];
  $id_name = $_POST['Cadast_id'];
  $sql_bus="SELECT * FROM users WHERE  id_nome= '".$id_name."' or email_numero='".$email_nume."'";
  $bus=$my_Db_Connection->prepare($sql_bus);
  $bus->execute();
  if($bus->fetchColumn()){
    //die("4");
    header("location:cadastro.php");
    exit();
  }
  $name = $_POST['Cadast_nome'];
  $senha = password_hash($_POST['Cadast_sen'],PASSWORD_DEFAULT);
  $idade = $_POST['Cadast_idade'];
  date_default_timezone_set('America/Sao_Paulo');
  $data = new DateTime();
  $data=$data->format('Y/m/d H:i');

  if(isset($_FILES['Cadast_img_perf']) && $_FILES['Cadast_img_perf']['error'] === UPLOAD_ERR_OK){
    $img=$_FILES['Cadast_img_perf'];
    if($img['error']){
      die("erro ao salvar imagem");
    }
    $locals="imgs_perfil/";
    $nome_img=uniqid();
    $tipo=strtolower(pathinfo($img['name'],PATHINFO_EXTENSION));
    if ($tipo != "jpg" && $tipo!= "png") {
      die("formato de imagem nao permitida");
    }
    $locals=$locals . $nome_img . '.' . $tipo;
    $img_ok= move_uploaded_file($img['tmp_name'],$locals);

    if ($img_ok) {
      $my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO users (email_numero, senha, idade,nome,id_nome,dia_cadastro,img_perfil) VALUES (:ema, :se, :ida,:nom,:idnome,:datc,:imgp)");
      $my_Insert_Statement->bindParam(':imgp', $locals);
    }else {
      die("erro ao salvar arquivo");
    }
  }else{
    $my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO users (email_numero, senha, idade,nome,id_nome,dia_cadastro) VALUES (:ema, :se, :ida,:nom,:idnome,:datc)");
  }
  $my_Insert_Statement->bindParam(':ema', $email_nume);
  $my_Insert_Statement->bindParam(':se', $senha);
  $my_Insert_Statement->bindParam(':ida', $idade);
  $my_Insert_Statement->bindParam(':nom', $name);
  $my_Insert_Statement->bindParam(':idnome', $id_name);
  $my_Insert_Statement->bindParam(':datc', $data);
  if ($my_Insert_Statement->execute()) {
    header("location:login.php");
    exit();
  } else {
    //die("6");
    header("location:cadastro.php");
    exit();
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
        <div class="col-xl-10" >
          <div class="rounded-3">
            <div class="row g-0" style="background-color: #180c20e8;">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4"  style="background-color: #180c20e8;">

                  <div class="text-center">
                    <img src="img/parafuso.png"
                    style="width: 185px;   filter:saturate(1000%);" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">Storm</h4>
                  </div>
                  <form action="" enctype="multipart/form-data" method = "POST">
                    <p>Criar conta</p>
                    <div class="form-outline mb-4">
                      <input type="text"  name="Cadast_nome" class="form-control"
                      placeholder="coloque seu nome de usuario" />
                      <label class="form-label" for="Cadast_nome">Nome</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="text"  name="Cadast_emainu" class="form-control"
                      placeholder="coloque seu email ou numero" />
                      <label class="form-label" for="Cadast_emainu">email</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="text"  name="Cadast_id" class="form-control"
                      placeholder="coloque seu @" />
                      <label class="form-label" for="Cadast_id">identificação</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" name="Cadast_sen"  class="form-control" />
                      <label class="form-label" for="Cadast_sen">senha</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" name="Cadast_conf_sen"  class="form-control" />
                      <label class="form-label" for="Cadast_conf_sen">confirmar senha</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="date" name="Cadast_idade"  class="form-control" />
                      <label class="form-label" for="Cadast_idade">idade</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="file" name="Cadast_img_perf"  accept="image/*" class="form-control" />
                      <label class="form-label" for="Cadast_img_perf">imagem perfil</label>
                    </div>
                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" >Criar</button>
                    </div>

                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Ja tem uma conta?</p>
                      <a href="login.php" targert="_self" class="btn btn-outline-success">Login</a>

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
