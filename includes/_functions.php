<?php
require 'conexion.php';

// Función Insertar Usuario
if (isset($_POST['accion']) && $_POST['accion'] == 'insertar_usuario') {
    $ID_Rol = $_POST['ID_Rol'];
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Email = $_POST['Email'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $Password = password_hash($Password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (ID_Rol, Nombre, Apellido, Email, Username, Password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $ID_Rol, $Nombre, $Apellido, $Email, $Username, $Password);

    if ($stmt->execute()) 
    {
        echo '<script>
                alert("Usuario registrado exitosamente.");
                window.location.href = "../view/usuarios.php";
              </script>';
    } 
    else 
    {
        echo '<script>
                alert("Error: ' . $stmt->error . '");
              </script>';
    }

    $stmt->close();
    $conn->close();
}
// Función Modificar Usuario
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'actualizar_usuario') {
        $ID_Usuario = $_POST['ID_Usuario'];
        $ID_Rol = $_POST['ID_Rol'];
        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
        $Email = $_POST['Email'];
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];

        if (!empty($Password)) 
        {
            $sql = "UPDATE usuario SET ID_Rol = ?, Nombre = ?, Apellido = ?, Email = ?, Username = ?, Password = ? WHERE ID_Usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssssi", $ID_Rol, $Nombre, $Apellido, $Email, $Username, $Password, $ID_Usuario);
        } 
        else 
        {
            $sql = "UPDATE usuario SET ID_Rol = ?, Nombre = ?, Apellido = ?, Email = ?, Username = ? WHERE ID_Usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssi", $ID_Rol, $Nombre, $Apellido, $Email, $Username, $ID_Usuario);
        }

        if ($stmt->execute()) 
        {
            echo '<script>
                    alert("Usuario actualizado correctamente.");
                    window.location.href = "../view/usuarios.php";
                  </script>';
        } 
        else 
        {
            echo '<script>
                    alert("Error al actualizar usuario: ' . $stmt->error . '");
                    window.history.back();
                  </script>';
        }
        $stmt->close();
    }
}
// Función Agregar Rol
if (isset($_POST['accion'])) 
{
    $accion = $_POST['accion'];

    if ($accion == 'insertar_rol') 
    {
        $nombre = $_POST['Nombre'];
        $descripcion = $_POST['Descripcion'];

        $sql = "INSERT INTO Rol (Nombre, Descripcion) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $descripcion);

        if ($stmt->execute()) 
        {
            echo "<script>alert('Rol creado exitosamente');</script>";
            echo "<script>window.location.replace('../view/roles.php');</script>";
            exit;
        } 
        else 
        {
            echo "Error al insertar el rol: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
}
// Función para actualizar un rol
if (isset($_POST['accion']) && $_POST['accion'] == 'actualizar_rol') 
{
    $id_rol = $_POST['ID_Rol'];
    $nombre = $_POST['Nombre'];
    $descripcion = $_POST['Descripcion'];

    $sql = "UPDATE Rol SET Nombre = ?, Descripcion = ? WHERE ID_Rol = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $descripcion, $id_rol);

    if ($stmt->execute()) 
    {
        echo '<script>alert("Rol actualizado exitosamente."); window.location.href = "../view/roles.php";</script>';
        exit;
    } 
    else 
    {
        echo "Error al actualizar el rol: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>