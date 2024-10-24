<?php
?>

<!DOCTYPE html>
<html lang="es"> <!-- Cambié el idioma a español -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Alta Alumno</title>
</head>
<body>
    <form action="" method="get">
        <h1>Alta alumno:</h1>
        <label for="nombre">Nombre: 
            <input type="text" id="nombre" name="nombre" required>
        </label><br>

        <label for="apellido">Apellido: 
            <input type="text" id="apellido" name="apellido" required>
        </label><br>

        <label for="nacimiento">Fecha de nacimiento: 
            <input type="date" name="nacimiento" id="nacimiento" required>
        </label><br>

        <label for="email">Correo: 
            <input type="email" name="email" id="email" required>
        </label><br>

        <label for="box">¿Qué lenguajes de programación conoces? 
            <input type="checkbox" name="box[]" id="box1" value="C++">
            <label for="box1">C++</label>
            <input type="checkbox" name="box[]" id="box2" value="JavaScript">
            <label for="box2">JavaScript</label>
            <input type="checkbox" name="box[]" id="box3" value="Python">
            <label for="box3">Python</label>
            <input type="checkbox" name="box[]" id="box4" value="PHP">
            <label for="box4">PHP</label>
        </label><br>

        <label for="radio">¿Sabes crear páginas web estáticas? 
            <input type="radio" name="radio" id="radio" value="Sí"> Sí
            <input type="radio" name="radio" value="No"> No
        </label><br>

        <label for="comentarios">Comentarios: <br> 
            <textarea name="comentarios" id="cajacomentarios"></textarea>
        </label><br>

        <label for="pass">Contraseña: 
            <input type="password" name="pass" id="pass" required>
        </label><br>

        <label for="password">Repita la contraseña: 
            <input type="password" name="password" id="password" required>
        </label><br>

        <label for="envio">
            <input type="submit" value="Enviar">
        </label>
    </form>
</body>
</html>