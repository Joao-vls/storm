<?php

if(!isset($_SESSION)){
  session_start();
}

//(isset($_GET['reqget']) || isset($_POST))
if (isset($_SESSION['id_nome']) && (isset($_POST['texto']) && mb_strlen($_POST['texto']) && mb_strlen($_POST['texto'])<=460)) {
  //$req=(isset($_GET['reqget'])) ? $_GET['reqget'] : $_POST['reqpos'];
  include "banco.php";
  $sql_bus="SELECT * FROM users WHERE id_nome=".$my_Db_Connection->quote($_SESSION['id_nome']);
  $bus = $my_Db_Connection->prepare($sql_bus);
  $bus->execute();
  $count = $bus->rowCount();
  if ($count == 1) {
    $my_Db_Connection->beginTransaction();
    $img_nome_t="";
    $result = $bus->fetch(PDO::FETCH_ASSOC);
    $idpos=uniqid().'p'.rand(1,1000).'p'.uniqid();
    $body_tr=htmlspecialchars($_POST['texto']);
    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime();
    $data=$data->format('Y/m/d H:i');
    $stmt = $my_Db_Connection->prepare("INSERT INTO postagens (user_id_nome, id_post, date_post,body) VALUES (:uin, :ip, :dp,:bd)");
    $stmt->bindParam(":uin",$result['id_nome']);
    $stmt->bindParam(":ip",$idpos);
    $stmt->bindParam(":dp",$data);
    $stmt->bindParam(":bd",$body_tr);
    if ($stmt->execute()) {
      $img=$_FILES['arquivos'];
      //die(print_r($_FILES).isset($_FILES['arquivos']).$img['error'][0]);
      if(isset($_FILES['arquivos'])){
        $arq_val=0;
        for ($i=0; $i <count($_FILES['arquivos']['name']) ; $i++) {
          if(!$img['error'][$i]){
            $pasta =__DIR__. "/arquivos/".$idpos;
            if (!file_exists($pasta)) {
              mkdir($pasta, 0777,true);
            }
            $img=$_FILES['arquivos'];
            $locals="arquivos/".$idpos."/";
            $nome_img=uniqid().'a'.rand(1,1000).'a'.uniqid();
            $tipo=strtolower(pathinfo($img['name'][$i],PATHINFO_EXTENSION));
            if ($tipo != "jpg" && $tipo!= "png" && $tipo!= "jpeg") {
              die("formato de imagem nao permitida");
            }
            $locals=$locals . $nome_img . '.' . $tipo;
            $img_ok= move_uploaded_file($img['tmp_name'][$i],$locals);

            if ($img_ok) {
              $img_nome_t.=$nome_img . "." . $tipo.",";
              $arq_val+=1;
            }else {
              die("erro ao salvar aquivo");
            }
          }
        }
        if ($arq_val) {
          $img2="arquivos/".$idpos;
          $img_nome_t=substr($img_nome_t, 0, mb_strlen($img_nome_t) - 1);
          $stmt = $my_Db_Connection->prepare("INSERT INTO arquivos (id_post, id_arquivo, caminho) VALUES (:ip, :ida, :cam)");
          $stmt->bindParam(":ip",$idpos);
          $stmt->bindParam(":ida",$img_nome_t);
          $stmt->bindParam(":cam",$img2);
          $stmt->execute();
        }

      }
    }
    $my_Db_Connection->commit();
  }else {
    die("error");
  }
}
?>
