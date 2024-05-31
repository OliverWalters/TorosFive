<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/eventos.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="../js/equiposFilters.js"></script>
</head>

<body class="body--margin">
    <?php
        include '../header.html';
        require_once "../bootstrap.php";
        require_once '../src/Entity/Evento.php';
        //fecha de hoy
        $fechaActual = new DateTime('now');
        // Obtener todos los eventos
        $eventos = $entityManager->getRepository('Evento')->findAll();

        // Inicializar las variables para almacenar los eventos más cercanos
        $eventoMasCercano = null;
        $eventosHoy = [];
        $intervaloMasCercano = null;


        foreach ($eventos as $evento) {
            $fechaEvento = $evento->getFecha();

            // Verificar si el evento es hoy
            if ($fechaEvento->format('Y-m-d') === $fechaActual->format('Y-m-d')) {
                array_push($eventosHoy, $evento);
            }
            
            // Busca evento más cercano qc
            $intervalo = $fechaActual->diff($fechaEvento);
            if ($intervaloMasCercano === null || $intervalo->invert === 0 && $intervalo < $eventoMasCercano) {
                $intervaloMasCercano = $intervalo;
                $eventoMasCercano = $evento;
            }
        }
        if(!empty($eventosHoy)){
            foreach($eventosHoy as $eventoHoy){
    ?>
    
    <div class="evento">
        <img src="<?php 
                    if($eventoHoy->getImagen()==null){
                        echo "https://fikrirasyid.com/wp-content/uploads/2016/10/placeholder-portrait-3-4-56158_1080x675.jpg";
                    }
                    else{
                        echo $eventoHoy->getImagen();
                    }
                    
                ?>" class="evento__img">
        <div class="evento__contendor">
            <h3 class="evento__titulo"><?php echo $eventoHoy->getNombre(); ?></h3>
            <p class="evento__fecha"><?php echo $eventoHoy->getFecha()->format('d-m-Y'); ?></p>
            <p class="evento__txt"><?php echo $eventoHoy->getDescripcion(); ?></p>
        </div>
    </div>
    
    <?php
            }
        }
    ?>
    <div class="proximo">
        <h3 class="proximo__titulo">Proximamente</h3>
        <div class="evento evento--proximo">
            <img src="<?php 
                        if($eventoMasCercano->getImagen()==null){
                            echo "https://fikrirasyid.com/wp-content/uploads/2016/10/placeholder-portrait-3-4-56158_1080x675.jpg";
                        }
                        else{
                            echo $eventoMasCercano->getImagen();
                        }

                    ?>" class="evento__img">
            <div class="evento__contendor">
                <h3 class="evento__titulo"><?php echo $eventoMasCercano->getNombre(); ?></h3>
                <p class="evento__fecha"><?php echo $eventoMasCercano->getFecha()->format('d-m-Y'); ?></p>
                <p class="evento__txt"><?php echo $eventoMasCercano->getDescripcion(); ?></p>
            </div>
        </div>
    </div>
</body>

</html>

