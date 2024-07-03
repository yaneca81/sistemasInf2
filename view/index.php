<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Pro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
        .custom-alert {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050; /* Asegúrate de que esté por encima de otros elementos */
            width: 50%; /* Ancho ajustable */
            text-align: center;
        }
    </style>

</head>

<body>


    <div class="container-fluid row ml-3 ">


        
        <div class="card m-4">
            <div class="card-body">
            <form  method="POST">
            <h3 class="text-center text-secondary">Crear Nuevo Evento</h3>
            <?php
            
            include "../controller/controller.evento.php";


            ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input required type="text" class="form-control" name="nombre">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tema</label>
                <input required type="text" class="form-control" name="tema">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">fecha</label>
                <input required type="date" class="form-control" name="fecha">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ubicacion</label>
                <input required type="text" class="form-control" name="ubicacion">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoría</label>
                <select required class="form-control" name="id_Categoria">
                    <?php while ($categoria = $categorias->fetch_object()) { ?>
                        <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripcion</label>
                <textarea required class="form-control" name="descripcion"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>

            </div>
        </div>
       

        <div class="col-8 p-4">
            <table class="table table-striped">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tema</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Ubicacion</th>
                        
                        <th scope="col">Categoria</th>
                        <th scope="col">Estado</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($datos = $listEvents->fetch_object()) { ?>
                        <tr>
                            
                            <td><?php echo $datos->nombre; ?></td>
                            <td><?php echo $datos->tema; ?></td>
                            <td><?php echo $datos->descripcion; ?></td>
                            <td><?php echo $datos->fecha; ?></td>
                            <td><?php echo $datos->ubicacion; ?></td>
                            <td><?php echo $datos->categoria_nombre; ?></td>
                            <td><?php echo $datos->estado; ?></td>
                            <td>
                            <button class="btn btn-warning edit-button";
                                        data-toggle="modal" 
                                        data-id="<?php echo $datos->id; ?>" 
                                        data-nombre="<?php echo $datos->nombre; ?>" 
                                        data-tema="<?php echo $datos->tema; ?>" 
                                        data-descripcion="<?php echo $datos->descripcion; ?>" 
                                        data-fecha="<?php echo $datos->fecha; ?>" 
                                        data-ubicacion="<?php echo $datos->ubicacion; ?>" 
                                        data-categoria="<?php echo $datos->id_Categoria; ?>" 
                                        data-target="#exampleModal">
                                    Editar
                                </button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>


        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" id="editForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="form-group">
                                <label for="edit-nombre">Nombre</label>
                                <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-tema">Tema</label>
                                <input type="text" class="form-control" id="edit-tema" name="tema" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-fecha">Fecha</label>
                                <input type="date" class="form-control" id="edit-fecha" name="fecha" required>
                            </div>
                            <div class="form-group">
                                <label >Ubicación</label>
                                <input type="text" class="form-control" id="edit-ubicacion" name="ubicacion" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-categoria">Categoría</label>
                                <select required class="form-control" name="id_Categoria" id="edit-categoria">
                                    <?php 
                                    $categorias->data_seek(0); 
                                    while ($categoriaEdit = $categorias->fetch_object()) { ?>
                                        <option   value="<?php echo $categoriaEdit->id; ?>"><?php echo $categoriaEdit->nombre; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-descripcion">Descripción</label>
                                <textarea class="form-control" id="edit-descripcion" name="descripcion" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="btneditar">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // Ocultar alertas después de 3 segundos
        setTimeout(function() {
            var alert = document.querySelector('.custom-alert');
            var alert = document.getElementById('alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 3000);

        // Rellenar el formulario del modal con los datos del evento
        $(document).on("click", ".edit-button", function () {
            var id = $(this).data('id');
            var nombre = $(this).data('nombre');
            var tema = $(this).data('tema');
            var descripcion = $(this).data('descripcion');
            var fecha = $(this).data('fecha');
            var ubicacion = $(this).data('ubicacion');
            var categoria = $(this).data('categoria');

            $("#edit-id").val(id);
            $("#edit-nombre").val(nombre);
            $("#edit-tema").val(tema);
            $("#edit-descripcion").val(descripcion);
            $("#edit-fecha").val(fecha);
            $("#edit-ubicacion").val(ubicacion);
            $("#edit-categoria").val(categoria);
        });
    </script>
</body>

</html>