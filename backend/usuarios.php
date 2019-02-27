<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Usuarios</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->

      <link href="../css/estilo.css" rel="stylesheet">
  </head>
  <body>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuarios</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-danger cancelar">Cancelar</button>
            <button type="button" class="btn btn-sm btn-outline-success" id="nuevo_registro" >Nuevo</button>
          </div>
        </div>
      </div>

      <div class="table-responsive view" id="show_data">
        <table class="table table-striped table-sm" id="list_usuarios">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
       <div id="insert_data" class="view">
       <form action="#" id="form_data">
  <div class="row">
  <div class="col">
       <div class="form-group">
       <label for="nombre">Nombre</label>
       <input type="text" id="nombre" name="nombre" class="form-control">
     </div>
       <div class="form-group">
        <label for="correo">Correo</label>
       <input type="email" id="email" name="email" class="form-control">
       </div>
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
         <button type="button" class="btn btn-success " id="guardar_datos">Guardar</button>
       </div>
        <div class="alert alert-danger" id="correcto" style="display: none;"></div>
        <div class="alert alert-success" id="error" style="display: none;"></div>
     </div>
     </div>
       </form>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
<script>
  //todas las vitas se ocultan
  //pregunto que vista esta visible
  //pregunto cual es la vista que se va mostrar
  
  function change_view(vista ='show_data'){
    $("#main").find(".view").each(function() {
      $(this).slideUp('fast');
      let id=$(this).attr("id");
      if (vista==id) {
        $(this).slideDown(300);
      }
      
    });

  }
//consultar usuarios
  function  consultar(){
    let obj = {
      "action" : "consultar_usuarios"
    };

    $.post('includes/_funciones.php', obj, function(r) {
     let template = ``;
    $.each(r, function(i, e) {
    template += `
            <tr>
              <td>${e.nombre_usr}</td>
              <td>${e.telefono_usr}</td>
              <td>
                <a href="#" data-id="${e.id_usr}" class="editar_usuarios">Editar</a>
                <a href="#" data-id="${e.id_usr}" class="eliminar_registro">Eliminar</a>
              </td>
            </tr>
          `;
    });
    $("#list_usuarios tbody").html(template);
  }, "JSON");
  }
  $(document).ready(function(){
    consultar();
    change_view();
  }); 

  $("#nuevo_registro").click(function() {
   change_view('insert_data');
   });

  //insertar un nuevo usuario

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
   if ($(this).val() != "") {
      obj[$(this).prop("name")] = $(this).val();
   }else{
    $(this).addClass("has-error").focus();
    return false;
   }
  });

   $.post('includes/_funciones.php', obj, function(a) {

    if (a == "1") {
       $("#correcto").html("Se inserto el usuario correctamente").fadeIn(); 
       $("#form_data")[0].reset();
     } else {
       $("#error").html("Hubo un error").fadeIn(); 
     }

   });

});

  //eliminar usuarios
function eliminar_usuarios{
      $('#list_usuarios').on("click",".eliminar_registro",function(e){
        e.preventDefault();
        let confirmacion = confirm("Desea eliminar este registro?");
        if (confirmacion) {
          let id = $(this).data('id'),
          obj = {
            "accion":"eliminar_registro",
            "registro":id
          };
          $.post("includes/_funciones.php",obj,function(respuesta){
            alert(respuesta);
            consultar();
          });
        }else{
          alert("El registro no se ha eliminado");
        }
      });
}
   //editar usuarios
function editar_usuarios{
     $("#list_usuarios").on("click", ".editar_usuarios", function (e) {
       e.preventDefault();
       let confirmacion = confirm("Desea editar este usuario?");
        if (confirmacion) {
                change_view('insert_data');
                let id = $(this).data('id');
                 let nombre = $("#nombre").val();
                 let telefono = $("#telefono").val();
                 let correo = $("#correo").val();
                 let password = $("#password").val();
                    obj = {
                        "action": "editar_usuario";
                        "nombre": nombre,
                        "correo": correo,
                        "telefono": telefono,
                        "password": password,
                        "id": id
                    };
                $.post("includes/_funciones.php", obj, function (respuesta) {
                });
            } else {
                alert('Ocurrio un error al editar');
            }
        });
}

  $("#main").find(".cancelar").click(function() {
    change_view();
    $("#form_data")[0].reset();
  });

</script>
</body>
</html>
