<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../bootstrap.php";
    require_once '../src/Entity/Entrenador.php';
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $correcto = false;
    $peticion = $entityManager->getRepository('Entrenador')->findBy(array("usuario" => $usuario));

    foreach ($peticion as $resultado) {
        if (password_verify($clave, $resultado->getClave()) || $clave == $resultado->getClave()) {
            $correcto = true;
        }
    }

    if ($correcto) {
        session_start();
        $_SESSION['usuario'] = $usuario;

        header("location:listaGestion.php");
    } else {
        echo "<p class='alert'>Usuario o clave incorrecta!!<p>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label class="form__label">Usuario:</label> <br>
        <input class="form__input" required type='text' name='usuario'> <br>
        <label class="form__label">Clave:</label> <br>
        <input class="form__input" required type='password' name='clave'> <br>
        <input class="form__input form__input--submit" class="submit" type='submit' value="Iniciar Sesión">
    </form>
    <!-- OJO de PASSWORD -->
</body>

</html>