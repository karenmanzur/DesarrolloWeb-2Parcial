<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Dashboard Template · Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Custom styles for this template -->
  <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
     <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">ActiveBox</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="usuarios.php">
              Usuarios <span class="sr-only"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="slider.php">
              Slider <span class="sr-only"></span>       
            </a>
          </li>
      </div>
    </nav>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-sm btn-outline-danger cancelar">Cancelar</button>
              <button type="button" class="btn btn-sm btn-outline-success" id="nuevo_registro">Nuevo</button>
            </div>
          </div>
        </div>
        <h2>Slider</h2>
        <div class="table-responsive view" id="show_data">
          <table class="table table-striped table-sm" id="slider">
            <thead>
              <tr>
                <th>Imagén</th>
                <th>Texto</th>
                <th>Nombre</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div id="insert_data" class="view">
          <form action="#" id="form_data">
            <div class="row">
              <div class="col">
                <form action="validar_foto.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label for="imagen">Imagen</label>
                  <input type="file" id="imagen" name="imagen" accept="image/x-png,image/gif,image/jpeg" class="form-control"
                 style=" padding-bottom: 10px;    height: 48px; ">
                </div>
                <div class="form-group">
                  <label for="texto">Texto</label>
                  <input type="text" id="texto" name="texto" class="form-control">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="name" id="nombre" name="nombre" class="form-control">
                </div>
              </div>
            </div>
             </form>
            <div class="row">
              <div class="col">
                <button type="button" class="btn btn-success" id="guardar_datos">Guardar</button>
                 <div class="alert alert-danger" id="correcto" style="display: none;"></div>
                <div class="alert alert-success" id="error" style="display: none;"></div>
              </div>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
    function change_view(vista = 'show_data'){
      $("#main").find(".view").each(function(){
        // $(this).addClass("d-none");
        $(this).slideUp('fast');
        let id = $(this).attr("id");
        if(vista == id){
          $(this).slideDown(300);
          // $(this).removeClass("d-none");
        }
      });
    }
    function consultar(){
      let obj = {
        "accion" : "consultar_slider"
      };
      $.post("includes/_funciones.php", obj, function(respuesta){
        let template = ``;
        $.each(respuesta,function(i,e){
          template += `
          <tr>
          <td>${e.img_slider}</td>
          <td>${e.quote_slider}</td>
          <td>${e.name_slider}</td>
          <td>
          <a href="#" data-id="${e.id_slider}">Editar</a>
          <a href="#" data-id="${e.id_slider}">Eliminar</a>
          </td>
          </tr>
          `;
        });
        $("#slider tbody").html(template);
      },"JSON");
    }
    $(document).ready(function(){
      consultar();
      change_view();
    });
    $("#nuevo_registro").click(function(){
      change_view('insert_data');
    });
    $("#guardar_datos").click(function(){
      let obj ={
        "accion" : "insertar_slider",
        "imagen" :  imagen,
        "texto" : texto,
        "nombre" : nombre
        
      }
      $("#form_data").find("input").each(function(){
        $(this).removeClass("has-error");
        if($(this).val() != ""){
          obj[$(this).prop("name")] =  $(this).val();
        }else{
          $(this).addClass("has-error").focus();
          return false;
        }
      });
      $.post("includes/_funciones.php", obj, function(){
        if (a == "1") {
         $("#correcto").html("Se inserto La imagen correctamente").fadeIn(); 
         $("#form_data")[0].reset();
       } else {
         $("#error").html("Hubo un error").fadeIn(); 
       }

      });
    });
    $("#main").find(".cancelar").click(function(){
      change_view();
      $("#form_data")[0].reset();
    });
  </script>
</body>
</html>