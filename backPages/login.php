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
    <link rel="stylesheet" href="../css/backCss/login.css">
</head>

<body>
    <div class="background"></div>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form__img"><i class="fa-solid fa-user-secret"></i></div>
            <div class="form__part">
                <label class="form__label"><i class="fa-solid fa-user" ></i></label>
                <input class="form__input" required type='text' name='usuario' placeholder="Usuario"> 
            </div>
            <div class="form__part">
                <label class="form__label"><i class="fa-solid fa-lock"></i></label>
                <input class="form__input" required type='password' name='clave' placeholder="Contraseña"> <br>
            </div>
            <input class="form__input form__input--submit" class="submit" type='submit' value="Iniciar Sesión">
        </form>
    
    <!-- OJO de PASSWORD -->
</body>

</html>