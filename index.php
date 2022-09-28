<!doctype html>
<html lang="en">

<head>
  <title>Agenda web</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.js"></script>

</head>

<body>

    <div class="col-md-8 offset-md-2">
        <div id='calendar'></div>
    </div>

    <!--  Modal trigger button  -->
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalEvento">
      Launch
    </button>
    
    <!-- Modal Body-->
    <div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">Datos del evento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        

                    <form action="" method="post">
                      
                    <div class="mb-3">
                      <label for="id " class="form-label">ID:</label>
                      <input type="text"
                        class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID:">
                    </div>

                    <div class="mb-3">
                      <label for="Titulo" class="form-label">Titulo</label>
                      <input type="text"
                        class="form-control" name="Titulo" id="Titulo" aria-describedby="helpId" placeholder="Titulo:">
                    </div>

                    <div class="mb-3">
                      <label for="Fecha" class="form-label">Fecha</label>
                      <input type="text"
                        class="form-control" name="Fecha" id="Fecha" aria-describedby="helpId" placeholder="Fecha:">
                    </div>

                    <div class="mb-3">
                      <label for="Hora" class="form-label">Hora del evento</label>
                      <input type="time"
                        class="form-control" name="Hora" id="Hora" aria-describedby="helpId" placeholder="Hora:">
                    </div>

                    <div class="mb-3">
                      <label for="Descripcion" class="form-label">Descripción</label>
                      <textarea class="form-control" name="Descripcion" id="Descripcion" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                      <label for="color" class="form-label">Color</label>
                      <input type="color"
                        class="form-control" name="color" id="color" aria-describedby="helpId" placeholder="Color:">
                    </div>

                    </form>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="agregarEvento()" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

  <header>
    <!-- place navbar here -->
  </header>
  <main>
    
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>
  
    <script>
    var modalEvento;
    modalEvento= new bootstrap.Modal(document.getElementById('modalEvento'),{ keyboard:false } );

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: "es",
          headerToolbar:{
            left:'prev,next today',
            center:'title',
            right:'dayGridMonth,timeGridWeek,timeGridDay'
          },
          dateClick:function(informacion){
            limpiarFormulario(informacion.dateStr);

            //alert("Presionaste "+informacion.dateStr);
            modalEvento.show();
          },
          eventClick:function(informacion){
            console.log(informacion);
            modalEvento.show();
            recuperarDatosEvento(informacion.event);
          }
          ,events: "api.php"
        });
        calendar.render();
      });
    </script>
<script>
  function recuperarDatosEvento(evento){
document.getElementById('id').value=evento.id;
  }
function agregarEvento(){
  enviarDatosApi();
}

function enviarDatosApi(){
            fetch("api.php?accion=agregar",{
              method:"POST",
              body:recolectarDatos()
            })
            .then(data=>{
              console.log(data);
              modalEvento.hide();
            })
            .catch(error=>{
              console.log(error);
            });
}

function recolectarDatos(){
  var evento=new FormData();
  evento.append("title", document.getElementById("Titulo").value);
  evento.append("Fecha", document.getElementById("Fecha").value);
  evento.append("Hora", document.getElementById("Hora").value);
  evento.append("Descripcion", document.getElementById("Descripcion").value);
  evento.append("color", document.getElementById("color").value);
  evento.append("id", document.getElementById("id").value);
  return evento;
}
function limpiarFormulario(fecha){

  document.getElementById('Titulo').value="";
  document.getElementById('Fecha').value=fecha;
  document.getElementById('Hora').value="12:00";
  document.getElementById('Descripcion').value="";
  document.getElementById('color').value="";
  document.getElementById('id').value="";
}
</script>
    
</body>

</html>