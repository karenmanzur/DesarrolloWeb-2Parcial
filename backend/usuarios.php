 <?php
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['usuario'];
  if (isset($varsesion)){
  ?>

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
  <?php 
    include("includes/_navbar.php");
   ?>
  
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
        <h2>Usuarios</h2>
        <div class="table-responsive view" id="show_data">
          <table class="table table-striped table-sm" id="list_usuarios">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div id="insert_data" class="view">
          <form action="#" id="form_data" enctype="multipart/form-data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" id="nombre" name="nombre" class="form-control">
                </div>
                <div class="form-group">
                  <label for="correo">Correo Electrónico</label>
                  <input type="email" id="correo" name="correo" class="form-control">
                </div>
                <div class="form-group">
                 <input type="file" id="foto" name="foto"  accept="image/x-png,image/gif,image/jpeg">
                <input type="hidden" name="ruta" id="ruta" readonly="readonly">
              </div>
                 <div id="preview"></div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="tel" id="telefono" name="telefono" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="password" id="password" name="password" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <button type="button" class="btn btn-success" id="guardar_datos">Guardar</button>
        <div class="alert alert-danger" id="correcto" style="display: none;"></div>
        <div class="alert alert-success" id="error" style="display: none;"></div>
              </div>
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
        "accion" : "consultar_usuarios"
      };
      $.post("includes/_funciones.php", obj, function(respuesta){
        let template = ``;
        $.each(respuesta,function(i,e){
          template += `
          <tr>
          <td>${e.nombre_usr}</td>
          <td>${e.telefono_usr}</td>
          <td>
          <a href="#" data-id="${e.id_usr}" class="editar_registro">Editar</a>
          <a href="#" data-id="${e.id_usr}" class="eliminar_registro">Eliminar</a>
          </td>
          </tr>
          `;
        });
        $("#list_usuarios tbody").html(template);
      },"JSON");
    }
   
    $("#nuevo_registro").click(function(){
      change_view('insert_data');
    });

     $("#guardar_datos").click(function(r) {
     let nombre = $("#nombre").val();
     let telefono = $("#telefono").val();
     let correo = $("#correo").val();
     let password = $("#password").val();
     let obj ={
      "accion" : "insertar_usuarios",
      "nombre" : nombre,
      "telefono" : telefono,
      "correo" : correo,
      "password" : password
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
      if($(this).data("editar") == 1){
        obj["id"]  = $(this).data('id');
        obj["accion"] = "editar_usuarios";
        $(this).text("Guardar").removeData("editar").removeData("id");
      }

      $.post('includes/_funciones.php', obj, function(response) {
        alert(response);
        $("#form_data")[0].reset();

       });
    });

 $("#list_usuarios").on("click",".eliminar_registro",function(e){
        e.preventDefault();
        let confirmacion = confirm('Desea eliminar este registro?');
        if (confirmacion) {
          let id = $(this).data('id'),
          obj = {
            "accion":"eliminar_registro",
            "id" : id
          };
          $.post("includes/_funciones.php",obj,function(r){
            if (r == "1") {
           $("#correcto").html("Usuario Eliminado Correctamente"); 
          consultar();
 
         } else {
           $("#error").html("Error al Eliminar Usuario"); 
         }

          });

          }
      });

  $("#list_usuarios").on("click",".editar_registro",function(e){
        e.preventDefault();
          let id = $(this).data('id');
          obj = {
            "accion":"consultar_registro",
            "id" : id
          };
          $("#form_data")[0].reset();
          change_view('insert_data');
          $("#guardar_datos").text("Editar").data("editar", 1).data("id", id);
          $.post("includes/_funciones.php",obj,function(r){
            $("#nombre").val(r.nombre_usr);
            $("#correo").val(r.correo_usr);
            $("#telefono").val(r.telefono_usr);
            $("#password").val(r.pswd_usr);
          },"JSON");
          console.log(obj);
          console.log(id);
          });

  $(document).ready(function(){
      consultar();
      change_view();
    });

     //Para subir las fotos
$("#foto").on("change", function (e) {
      let formDatos = new FormData($("#form_data")[0]);
      formDatos.append("accion", "carga_foto");
      $.ajax({
        url: "includes/_funciones.php",
        type: "POST",
        data: formDatos,
        contentType: false,
        processData: false,
        success: function (datos) {
          let respuesta = JSON.parse(datos);
          if(respuesta.status == 0){
            alert("No se cargó la foto");
          }
          let template = `
          <img src="${respuesta.archivo}" alt="" class="img-fluid" />
          `;
          $("#ruta").val(respuesta.archivo);
          $("#preview").html(template);
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

<?php
 }
  else 
  {
header("Location:index.php");
  }
