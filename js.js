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
  // $(document).on("change",$("#enviar_imvi"), function(e) {
  //
  // });
  var imagens,post,user,carregado=0,escrito='',move_lef_rig;
  //console.log(users[0].src[0][1]);
  function criarImagemg(src){
    var im=$('<img class="imgvid-m" src="'+src+'" alt="">');
    criarSobretela();
    $("body").append(im);
  }
  function mudarImgleft() {
    if (move_lef_rig>0) {
      var bl=$('<button class="pab-left" type="button" name="button"><i class="fa-solid fa-arrow-left"></i></button>');
      $("body").append(bl);
      $(bl).click(function(){
        $(".imgvid-m").remove();
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
        $(".imgvid-m").remove();
        criarImagemg(imagens[move_lef_rig+=1].src);
        mudarImgleft();
        if(move_lef_rig==imagens.length-1){
          $(".pab-right").css({display:"none"});
        }
      });
    }
  }
  function criarConteudo(imagem_perfil,nome_user,email,conteudo,imagens){

    var div=$('<div class="conteu"><div class="user-post"><img class="user-img" src="'+imagem_perfil+
    '" alt="imagem_perfil"><div class="user-nome">'+nome_user+'<div class="user-id">'+email
    +'</div></div></div><p>'+conteudo+'</p></div>');

    $("#principal").append(div);

    var pai=div;

    if (imagens.length) {
      var div=$('<div class="imgvid-post"></div>');
      $(pai).append(div);
      var img;
      if(imagens.length==1){
        img=$('<img class="imgvid-u" src="'+imagens[0]+'" alt="">');
        $(div).append(img);
      }else {
        for (var i = 0; i < imagens.length; i++) {
          img=$('<img class="imgvid-p" src="'+imagens[i]+'" alt="">');
          $(div).append(img);
        }
      }
    }

    div=$('<div class="interacao"><div class="react"><button type="button" name="reacao"><i class="fa-solid fa-heart-circle-plus"></i></button><div class="react-buttom"><button type="button" name="coracao"><i class="fa-solid fa-heart fa-sm"></i></button><button type="button" name="triste"><i class="fa-solid fa-face-sad-tear fa-sm"></i></button><button type="button" name="supresa"><i class="fa-solid fa-face-surprise fa-sm"></i></button><button type="button" name="alegre"><i class="fa-solid fa-face-laugh fa-sm"></i></button><button type="button" name="irritado"><i class="fa-solid fa-face-tired fa-sm"></i></button></div></div><button type="button" name="comentario"><i class="fa-solid fa-comment"></i></button><button type="button" name="compartilha"><i class="fa-solid fa-copy"></i></button><button type="button" name="views"><i class="fa-solid fa-eye"></i></button></div>')

    $(pai).append(div);
  }
  function criarSobretela(){
    var div=$("<div />");
    div.addClass("sobre-tela");
    $("body").css({overflow:"hidden"})
    $("body").append(div);
    $(".sobre-tela").click(function(){
      if($("#novo-post")){
        if ($("#novo-post textarea").val()) {
          escrito=$("#novo-post textarea").val();
        }else {
          escrito='';
        }
        $("#novo-post").remove();
      }
      if($(".imgvid-m")){
        $(".imgvid-m").remove();
      }
      $("body").css({overflow:"auto"})
      $(".sobre-tela").remove();
    });
  }

  function criarEscrever(){
    var div=$('<div id="novo-post"> <textarea name="texto" placeholder="Escreva aqui..."></textarea><label for="enviar_imvi"><i class="fa-sharp fa-solid fa-images"></i></label><input id="enviar_imvi" type="file" accept="image/*,video/*" capture="user"><button type="button" name="enviar" >Enviar</button> <button type="button" name="cancelar_envio" >Cancelar</button></div>');
    $("body").append(div);
    if (escrito) {
      $("#novo-post textarea").val(escrito);
    }
    $("#enviar_imvi").change(function(e){
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
    });
    $("#novo-post button").click(
      function(){
        if ($(this).attr('name')=="cancelar_envio") {
          $(".sobre-tela").remove();
          $("body").css({overflow:"auto"});
          $("#novo-post").remove();
        }
      }
    );
  }
  function carregaConteudo(){
    for (var o = imagens.length - 1; o > 0; o--) {
      var j = Math.floor(Math.random() * o);
      var aux = imagens[o];
      imagens[o]= imagens[j];
      imagens[j]=aux;
    }
    for (var i = 0; i < 10; i++) {
      //console.log(imagens[o].images.length=1,imagens[o].images);
      imagens[i].images.length=Math.floor(Math.random() * imagens[i].images.length);
      criarConteudo(user[i].image,user[i].username,user[i].email,post[i].body,imagens[i].images);
    }
    imagens.length=0;user.length=0;post.length=0;
    $(".imgvid-post .imgvid-p").click(function(){
      criarImagemg($(this).attr('src'))
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
    });
  }

  function conf(){
    if (carregado==3) {
      carregado=0;
      carregaConteudo();
      $(".load").remove();
    }
  }
  function getAjax(sk){
    $.ajax({
      method: "GET",
      url: "https://dummyjson.com/products?skip="+sk+"&limit=10",
      beforeSend: function(){
        $('.load').css({display:"block"});

      },
      complete: function(){
        carregado+=1;
        conf();
      },
      success: function(data){
        imagens=data.products;
        console.log(imagens,'i');

      }
    });
    $.ajax({
      method: "GET",
      url: "https://dummyjson.com/posts?skip="+sk+"&limit=10",
      beforeSend: function(){
        $('.load').css({display:"block"});
      },
      complete: function(){
        carregado+=1;
        conf();
      },
      success: function(data){
        post=data.posts;
        console.log(post,'p');
      }
    });
    $.ajax({
      method: "GET",
      url: "https://dummyjson.com/users?skip="+sk+"&limit=10",
      beforeSend: function(){
        $('.load').css({display:"block"});
      },
      complete: function(){
        carregado+=1;
        conf();
      },
      success: function(data){
        user=data.users;
        console.log(user,'u');
      }
    });
  }

  $(function(){
    $("button").click(function(){
      if($(this).attr('name')=="escrever"){
        criarSobretela();
        criarEscrever();
      }
    });
    $(window).on('scroll',debounce(function(){
      if ($(".conteu").length<100) {
        if($(window).scrollTop()+100 + $(window).height() >= $(document).height()) {
          getAjax($(".conteu").length+'');
        }
      }else {
        console.log(100);
      }
    },100))
    getAjax("0");
  });
}());
