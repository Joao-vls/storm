<?php

if(!isset($_SESSION)){
  session_start();
}

if (isset($_SESSION['id_s']) && (isset($_GET['reqget']) || isset($_POST)) ) {
  $req=(isset($_GET['reqget'])) ? $_GET['reqget'] : $_POST['reqpos'];
  include "banco.php";
  $sql_bus="SELECT * FROM users WHERE  id_session= ".$my_Db_Connection->quote($_SESSION['id_s'])." AND email_numero=".$my_Db_Connection->quote($_SESSION['emailnu']);
  $bus = $my_Db_Connection->prepare($sql_bus);
  $bus->execute();
  $count = $bus->rowCount();
  if ($count == 1) {
    $result = $bus->fetch(PDO::FETCH_ASSOC);
    switch ($req) {
      case '1':
      echo json_encode($_SESSION['emailnu']);
      break;
      case '2':
      $novopos=$my_Db_Connection->prepare('INSERT INTO postagem (id_post, nome, id_nome,tipo,body,date_post,img_perfil) VALUES (:idp, :nom, :idno,"p",:bod,:datc,:imgp)');
      $idpos=uniqid().'p'.rand(1,1000).'p'.uniqid();
      $novopos->bindParam(':idp',$idpos);
      $novopos->bindParam(':nom',$result['nome']);
      $novopos->bindParam(':idno',$result['id_nome']);
      $body_tr=htmlspecialchars($_POST['texto']);
      $novopos->bindParam(':bod',$body_tr);
      //<script>console.log(1)</script>
      $data = new DateTime();
      $data=$data->format('Y/m/d H:i');
      $novopos->bindParam(':datc',$data);
      $novopos->bindParam(':imgp',$result['img_perfil']);
      $novopos->execute();
      if(isset($_FILES['arquivo'])){
        for ($i=0; $i <count($_FILES['arquivo']['name']) ; $i++) {

          $img=$_FILES['arquivo'];
          if($img['error'][$i]){
            die("erro ao salvar imagem");
          }
          $locals="arquivos/";
          $nome_img=uniqid();
          $tipo=strtolower(pathinfo($img['name'][$i],PATHINFO_EXTENSION));
          if ($tipo != "jpg" && $tipo!= "png") {
            die("formato de imagem nao permitida");
          }
          $locals=$locals . $nome_img . '.' . $tipo;
          $img_ok= move_uploaded_file($img['tmp_name'][$i],$locals);

          if ($img_ok) {
            $my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO arquivos (id_post,nome_arq,caminho) VALUES (:idp,:noar,:cam)");
            $my_Insert_Statement->bindParam(':cam', $locals);
            $my_Insert_Statement->bindParam(':noar', $nome_img);
            $my_Insert_Statement->bindParam(':idp', $idpos);
            $my_Insert_Statement->execute();
          }else {
            die("erro ao salvar arquivo");
          }
        }
      }



      break;
    }
  }else {
    die("error");
  }
}
?>
