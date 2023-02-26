<?php

function validar_info(){
  $campos_nn=0;
  if(isset($_POST['Cadast_id']) && $_POST['Cadast_id']!=""){
    if (!preg_match('/^[a-zA-Z0-9_-]{3,16}$/',$_POST['Cadast_id'])) {
      return 0;
    }
    $campos_nn+=1;
  }
  if(isset($_POST['Cadast_emainu']) && $_POST['Cadast_emainu']!=""){
    if (!filter_var($_POST['Cadast_emainu'], FILTER_VALIDATE_EMAIL)) {
      return 0;
    }
    $campos_nn+=1;

  }
  if(isset($_POST['Cadast_nome']) && $_POST['Cadast_nome']!=""){
    if (!preg_match('/^[a-zA-Z0-9_\s-]{1,16}$/',$_POST['Cadast_nome'])) {
      return 0;
    }
    $campos_nn+=1;

  }
  if((isset($_POST['Cadast_sen']) && $_POST['Cadast_sen']!="") && (isset($_POST['Cadast_conf_sen'])  &&  $_POST['Cadast_conf_sen']!="")){
    if (strcmp($_POST['Cadast_conf_sen'],$_POST['Cadast_sen'])!=0) {
      return 0;
    }
    $campos_nn+=1;

  }
  if(isset($_POST['Cadast_idade']) && $_POST['Cadast_idade']!=""){
    $date1 = new DateTime($_POST['Cadast_idade']);
    $date2 = new DateTime();
    $intervalo = $date1->diff($date2);
    $idade = $intervalo->y;
    if ($idade<13) {
      die($idade);

      return 0;
    }
    $campos_nn+=1;

  }
  if ($campos_nn==5) {
    return 1;
  }
}

?>
