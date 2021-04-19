 <?php require_once 'calendar.php' ?>
 <!DOCTYPE html>
 <html>

 <head>
   <title>Contact Form</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

   <!-- <script type="text/javascript" src="moment.js"></script> -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
 </head>

 <body>
   <div class="container">
     <div class="row justify-content-center mt-5">
       <div class="col-md-8">
         <div class="card">
           <div class="card-header">
             <h4><i class="fab fa-google"></i> Google Calender</h4>
           </div>
           <div class="card-body">
             <form action="" method="POST">
               <?php
                if (isset($_POST['agendar'])) {
                  if ($mensaje != '') {
                ?>
                   <label class="control-form">Error :<?= $mensaje; ?></label>
                 <?php
                  } elseif ($id_event != '') {
                  ?>
                   <label class="control-form">ID Evento :<?= $id_event; ?></label><br>
                   <a href="<?= $link_event; ?>" class="btn btn-sm btn-info"><i class="fas fa-paperclip"></i> Ver evento asignado</a>
                 <?php
                  }
                  ?><br>
                 <button type="button" class="btn btn-sm btn-success mt-4" onclick="reload();">Regresar</button>
               <?php
                } else {
                ?>
                 <div class="form-group">
                   <div class="row">
                     <div class="col-sm-6">
                       <label>Nombre</label>
                       <div class="form-group">
                         <input type="text" class="form-control " name="username" placeholder="Ingresa tu nombre">
                       </div>
                     </div>
                     <div class="col-sm-6">
                       <label>Fecha y hora</label>
                       <div class="form-group">
                         <input type="datetime-local" class="form-control " name="date_start" placeholder="Ingresa tu nombre">
                         <small id="emailHelp" class="form-text text-muted">Asigna la fecha y hora de terapia.</small>
                       </div>
                     </div>
                   </div>
                   <!-- <div class="row">
                     <div class="col-sm-12">
                       <label>Fecha y hora</label>
                       <div class="form-group">
                         <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                           <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="date_start" />
                           <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                             <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div> -->

                 </div>
                 <div class="text-center">
                   <button type="submit" class="btn btn-primary btn-sm" name="agendar">Enviar</button>
                 </div>
               <?php
                }
                ?>
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>

   <script>
     //  $(function() {
     //    $('#datetimepicker1').datetimepicker({
     //      format: 'YYYY-MM-DD HH:mm'
     //    });
     //  });

     function reload() {
       location.href = "index.php";
     }
   </script>


 </body>

 </html>