<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    body {
        background-image: url('./frontend/images/fondo_login.png');
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .container {
        width: 300px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px #cfcfcf;
        transition: box-shadow 0.3s ease;
        line-height: 1.5; /* Añadido para centrar verticalmente */
    }

    .container:hover {
        box-shadow: 0px 0px 20px 0px #cfcfcf;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 8px 0 20px 0;
        border: 1px solid #ccc;
        font-size: 15px;
        border-radius: 4px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #42ab49;
    }

    button {
        background-color: #42ab49;
        color: white;
        font-size: 15px;
        padding: 14px 20px; /* Aumenté el espaciado horizontal */
        border: none;
        border-radius: 25px; /* Botón más redondeado */
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
        outline: none; /* Elimina el contorno al hacer clic */
    }

    button:hover {
        background-color: #3a9e42;
    }

    .imgcontainer {
        text-align: center;
        margin-bottom: 20px;
    }

    img.avatar {
        width: 100px;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .imgcontainer:hover img.avatar {
        transform: scale(1.1);
    }

    label {
        color: black;
        font-size: 17px;
        margin-bottom: 10px;
        display: block;
    }

    /* Change styles for small screens */
    @media screen and (max-width: 400px) {
        button {
            width: 100%;
        }
    }
</style>

</head>

<body>

    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="./auth/auth.php">
            <div class="imgcontainer">
                <img src="./frontend/images/icono_login.png" alt="Avatar" class="avatar">
            </div>
            <label for="uname"><i class='bx bxs-user'></i> <b>Usuario</b></label>
            <input type="text" placeholder="Ingrese Nombre de Usuario" name="user" required>

            <label for="psw"><i class='bx bxs-key'></i> <b>Contraseña</b></label>
            <input type="password" placeholder="Ingrese Contraseña" name="password" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

</body>

</html>
