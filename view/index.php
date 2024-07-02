<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Pro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>


    <div class="container-fluid row ml-3">


        <form class="col-2 p-3 m-3" method="POST">
            <h3 class="text-center text-secondary">Crear Nuevo Evento</h3>
            <?php
            include "../model/conexion.php";
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

        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tema</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Ubicacion</th>
                        <th scope="col"></th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Estado</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($datos = $listEvents->fetch_object()) { ?>
                        <tr>
                            <td><?php echo $datos->id; ?></td>
                            <td><?php echo $datos->nombre; ?></td>
                            <td><?php echo $datos->tema; ?></td>
                            <td><?php echo $datos->descripcion; ?></td>
                            <td><?php echo $datos->fecha; ?></td>
                            <td><?php echo $datos->ubicacion; ?></td>
                            <td><?php echo $datos->categoria_nombre; ?></td>
                            <td><?php echo $datos->estado; ?></td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-id="<?php echo $datos->id; ?>" data-target="#exampleModal">Editar</button>
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
                                <label for="edit-ubicacion">Ubicación</label>
                                <input type="text" class="form-control" id="edit-ubicacion" name="ubicacion" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-categoria">Categoría</label>
                                <select required class="form-control" name="id_Categoria">
                                    <?php 
                                    $categorias->data_seek(0); 
                                    while ($categoriaEdit = $categorias->fetch_object()) { ?>
                                        <option  value="<?php echo $categoriaEdit->id; ?>"><?php echo $categoriaEdit->nombre; ?></option>
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

    <script>
        // Ocultar alertas después de 3 segundos
        setTimeout(function() {
            var alert = document.getElementById('alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 3000);

        
        
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>