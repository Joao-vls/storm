debounce = function(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};


(function(){
  var imagens,post,user,escrito='',move_lef_rig,usuarios=[],usuario=[];


  //console.log(users[0].src[0][1]);
  function criarMostramid(){
    var midi;
    if ($(".midia_envia").length) {
      midi=$(".midia_envia");
    }else {
      midi=$('<div class="midia_envia"></div>');
      $("#novo-post").append(midi);
    }
    if($(".mostra-midia").length<4){
      var mostra_Midia=$('<div class="mostra-midia" ><button type="button" name="button" class="excluir-midia"><i class="fa-solid fa-circle-xmark fa-sm"></i></button></div>')
      $(midi).append(mostra_Midia);
      $(".excluir-midia").click(function(){
        $(this).parent().remove();
      });
    }
  }
  function criarImagemg(src){
    var im=$('<img class="imgvid-m" src="'+src+'" alt="">');
    criarSobretela();
    $("body").append(im);
    $(im).effect( "slide", 450);

  }
  function mudarImgleft() {
    if (move_lef_rig>0) {
      var bl=$('<button class="pab-left" type="button" name="button"><i class="fa-solid fa-arrow-left"></i></button>');
      $("body").append(bl);
      $(bl).click(function(){
        $(".imgvid-m").effect( "drop", 450);
        debounce(()=>{$(".imgvid-m").remove();},450);
        criarImagemg(imagens[move_lef_rig-=1].src);
        mudarImgright();
        if(move_lef_rig==0){
          $(".pab-left").remove();
        }
      });
    }
  }
  function mudarImgright() {
    if (move_lef_rig<imagens.length-1) {
      var br=$('<button class="pab-right" type="button" name="button"><i class="fa-solid fa-arrow-right"></i></button>');
      $("body").append(br);
      $(br).click(function(){
        $(".imgvid-m").effect( "drop", 450);
        debounce(()=>{$(".imgvid-m").remove();},450);
        criarImagemg(imagens[move_lef_rig+=1].src)
        mudarImgleft();
        if(move_lef_rig==imagens.length-1){
          $(".pab-right").css({display:"none"});
        }
      });
    }
  }
  function criareventImageg() {
    $(".imgvid-post img")?.click(function(){
      criarImagemg($(this).attr('src'));
      if($(this).attr('class')=="imgvid-p"){
        imagens=$(this).parent().children();
        for (var i = 0; i < imagens.length; i++) {
          if(imagens[i].src==$(this).attr('src')){
            move_lef_rig=i;
          }
        }
        if (move_lef_rig>0) {
          mudarImgleft();
        }
        if (move_lef_rig<imagens.length-1) {
          mudarImgright();
        }
      }
    });
  }
  function criarConteudo(imagem_perfil,nome_user,email,conteudo,imagens2,usr){

    var div=$('<div class="conteu"><div class="user-post"><img class="user-img" src="'+imagem_perfil+
    '" alt="imagem_perfil"><div class="user-nome">'+nome_user+'<div class="user-id">'+email
    +'</div></div></div><p>'+conteudo+'</p></div>');
    if(usr){

      $("body").append(div);
      div.insertBefore($(".conteu:eq(0)"));
    }else{
      $("#principal").append(div);
    }
    var pai=div;

    if (imagens2.length) {
      div=$('<div class="imgvid-post"></div>');
      $(pai).append(div);
      var img;
      if(imagens2.length==1){
        img=$('<img class="imgvid-u" src="'+imagens2[0]+'" alt="">');
        $(div).append(img);
      }else {
        for (var i = 0; i < imagens2.length; i++) {
          img=$('<img class="imgvid-p" src="'+imagens2[i]+'" alt="">');
          $(div).append(img);
        }
      }
    }

    div=$('<div class="interacao"><div class="react"><button type="button" name="reacao"><i class="fa-solid fa-heart-circle-plus"></i></button><div class="react-buttom"><button type="button" name="coracao"><i class="fa-solid fa-heart fa-sm"></i></button><button type="button" name="triste"><i class="fa-solid fa-face-sad-tear fa-sm"></i></button><button type="button" name="supresa"><i class="fa-solid fa-face-surprise fa-sm"></i></button><button type="button" name="alegre"><i class="fa-solid fa-face-laugh fa-sm"></i></button><button type="button" name="irritado"><i class="fa-solid fa-face-tired fa-sm"></i></button></div></div><button type="button" name="comentario"><i class="fa-solid fa-comment"></i></button><button type="button" name="compartilha"><i class="fa-solid fa-copy"></i></button><button type="button" name="views"><i class="fa-solid fa-eye"></i></button></div>');
    $(pai).append(div);
  }
  function criarSobretela(){
    var div=$("<div />");
    div.addClass("sobre-tela");
    $("body").css({overflow:"hidden"})
    $("body").append(div);
    $(div).effect( "slide", 450);
    $(".sobre-tela").click(function(){
      var aux;
      if($("#novo-post").length){
        if ($("#novo-post textarea").val()) {
          escrito=$("#novo-post textarea").val();
        }else {
          escrito='';
        }
        aux=$("#novo-post");
        imagens.length=0;
      }
      if($(".imgvid-m").length){
        aux=$(".imgvid-m");
      }
      $(".pab-right")?.remove();
      $(".pab-left")?.remove();
      $("body").css({overflow:"auto"})
      console.log(aux);

      $(aux).effect( "drop", 450 ,()=>{$(aux).remove()});
      $(".sobre-tela").effect( "drop", 450 ,()=>{$(".sobre-tela").remove()});

    });
  }

  function criarEscrever(){
    var div=$('<div id="novo-post"><form class=""id="formenviacont" method="post"> <textarea name="texto" placeholder="Escreva aqui..."></textarea><label for="enviar_imvi"><i class="fa-sharp fa-solid fa-images"></i></label><input name="arquivo[]" multiple id="enviar_imvi" type="file" accept="image/*" capture="user"><button type="submit" name="enviar" >Enviar</button> <button type="button" name="cancelar_envio" >Cancelar</button</form></div>');
    $("body").append(div);
    if (escrito) {
      $("#novo-post textarea").val(escrito);
    }
    $("#formenviacont").submit(function(e){
      e.preventDefault();
      var recdata;
      var formData = new FormData(this);
      formData.append('reqpos',"2");
      $.ajax({
        type: 'POST',
        url: 'GPvar.php',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
          recdata = data;
          console.log(recdata);
          $.ajax({
            url: 'GPvar.php',
            type: 'GET',
            data: { reqget: "1"},
            dataType:'json',
            success: function(data) {
              recdata=data;
              console.log(recdata);
            }
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR, textStatus, errorThrown);
        }
      });


    }
  );
  $("#novo-post button").click(
    function(){
      if ($(this).attr('name')=="cancelar_envio") {
        $("#novo-post").effect( "drop", 450 ,()=>{$("#novo-post").remove()});
        $(".sobre-tela").effect( "drop", 450 ,()=>{$(".sobre-tela").remove()});
        $("body").css({overflow:"auto"});
        imagens.length=0;
      }
      if ($(this).attr('name')=="enviar") {
        $("#novo-post").effect( "drop", 450 ,()=>{$("#novo-post").remove()});
        $(".sobre-tela").effect( "drop", 450 ,()=>{$(".sobre-tela").remove()});
        $("body").css({overflow:"auto"});
        usuarios={
          body:$("#novo-post textarea").val(),
          imagem_p:"img/per.png",
          username:"nome",
          email:"@id",
          src:imagens
        }
        usuario.push(usuarios);
        criarConteudo(usuarios.imagem_p,usuarios.username,usuarios.email,usuarios.body,usuarios.src,1);
        imagens.length=0;
        criareventImageg();
      }
    }
  );
  $("#enviar_imvi").on("change", function() {
    if (!( this.files && this.files.length<=4) || imagens.length==4) {
      return;
    }

    if (this.files.length<=4) {
      for (var i = 0; i <this.files.length ; i++) {
        var r = new FileReader();
        r.readAsDataURL(this.files[i]);
        r.onload = function(e){
          if (imagens.length<4) {
            criarMostramid();
            imagens.push(e.target.result);
            var div=$('<img src="'+imagens[$(".mostra-midia").length-1]+'" alt="imagem_perfil">');
            $(".mostra-midia:eq("+($(".mostra-midia").length-1)+")").append(div)
          }
        }
      }
    }
  });
  $( "#novo-post" ).effect( "slide", 450 );
}
function carregaConteudo(){
  if (imagens.length && user.length && post.length){

    for (var o = imagens.length - 1; o > 0; o--) {
      var j = Math.floor(Math.random() * o);
      var aux = imagens[o];
      imagens[o]= imagens[j];
      imagens[j]=aux;
    }
    usuarios=[];

    for (var i = 0; i < 10; i++) {
      var cont={
        email:user[i].email,
        nome:user[i].username,
        imagem_p:user[i].image,
        body:post[i].body,
        src:imagens[i].images
      };
      usuarios.push(cont)
    }
    for (var o = 9; o > 0; o--) {
      var j = Math.floor(Math.random() * o);
      var aux = usuarios[o];
      usuarios[o]= usuarios[j];
      usuarios[j]=aux;
    }
    for (var i = 0; i < 10; i++) {
      //console.log(imagens[o].images.length=1,imagens[o].images);
      var li;
      usuarios[i].src.length=Math.floor(Math.random() * (li=(usuarios[i].src.length<=5) ? usuarios[i].src.length : usuarios[i].src.length=5));
      criarConteudo(usuarios[i].imagem_p,usuarios[i].nome,usuarios[i].email,usuarios[i].body,usuarios[i].src);
    }
    imagens.length=0;user.length=0;post.length=0;usuarios.length=0;
    criareventImageg();
  }
}

function conf(){
  carregaConteudo();
  $(".load").remove();
}
function getAjax(sk){
  $.ajax({
    method: "GET",
    url: "https://dummyjson.com/products?skip="+sk+"&limit=10",
    success: function(data){
      imagens=data.products;
      $.ajax({
        method: "GET",
        url: "https://dummyjson.com/posts?skip="+sk+"&limit=10",
        success: function(dat){
          post=dat.posts;
          $.ajax({
            method: "GET",
            url: "https://dummyjson.com/users?skip="+sk+"&limit=10",
            success: function(da){
              user=da.users;
              conf();
            }
          });
        }
      });
    }
  }
);
}

$(function(){

  $("button").click(function(){
    if($(this).attr('name')=="escrever" && $("#novo-post").length==0){
      criarSobretela();
      criarEscrever();
    }
  });
  if (!$(".balao_perfil").length) {
    $(".img-1").click(()=>{
      window.location.href="http://localhost/storm/login.php";
    });
  }

  $(window).on('scroll',debounce(function(){
    if ($(".conteu").length<100) {
      if($(window).scrollTop()+100 + $(window).height() >= $(document).height()) {
        getAjax($(".conteu").length+'');
      }
    }
  },150))
  getAjax("0");
});
}());
