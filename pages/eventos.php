<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/eventos.css"/>
    <link rel="stylesheet" href="../css/heading.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
    <!-- fullcalendar -->
    <script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@6.1.11/index.global.min.js'></script>
    
</head>

<body class="body--margin">
    <?php
        include '../header.html';
        require_once "../bootstrap.php";
        require_once '../src/Entity/Evento.php';
        require_once '../src/Entity/Jugador.php';
    ?>
        <div class="heading">
            <h1 class="heading__txt">Eventos</h1>
        </div>
    <?php
        // Obtener todos los eventos y cumples
        $eventos = $entityManager->getRepository('Evento')->findAll();
        $jugadoras = $entityManager->getRepository('Jugador')->findAll();
        $fechas = [];
        $fechas = [
            array(
                "nombre" => "Dia de la Mujer",
                "fecha" => "2001-03-07",
                "descripcion" => "Hoy es el dia internacional de la mujer",
                "imagen" => null
            ),
            array(
                "nombre" => "Feria de Marbella",
                "fecha" => "2001-06-11",
                "descripcion" => "Hoy empieza la feria de marbella",
                "imagen" => "../images/jugadores/pista.jpg"
            )];
        foreach($eventos as $evento){
            array_push($fechas, array(
                "nombre" => $evento->getNombre(),
                "fecha" => $evento->getFecha()->format('Y-m-d'),
                "descripcion" => $evento->getDescripcion(),
                "imagen" => $evento->getImagen()
            ));
        }
        foreach($jugadoras as $jugadora){
            array_push($fechas, array(
                "nombre" => "Cumple de ".$jugadora->getNombre(),
                "fecha" => $jugadora->getNacimiento()->format('Y-m-d'),
                "descripcion" => "Hoy es el cumple de ".$jugadora->getNombre()."!! FELICIDADES!!",
                "imagen" => $jugadora->getImagen()
            ));
        }

        //fecha de hoy
        $fechaActual = new DateTime('now');
        // Inicializar las variables para almacenar los eventos más cercanos
        $eventoMasCercano = null;
        $eventosHoy = [];
        $intervaloMasCercano = null;


        foreach ($fechas as $fecha) {
            $fechaEvento = $fecha["fecha"];
            
            // Verificar si el evento es hoy
            if (strpos($fechaEvento, $fechaActual->format('m-d'))) {
                array_push($eventosHoy, $fecha);
            }
            else{
                $evento = new DateTime($fechaEvento);
                // Crear una nueva fecha con el año actual
                $evento->setDate($fechaActual->format('Y'), $evento->format('m'), $evento->format('d'));

                // Busca evento más cercano qc
                $intervalo = $fechaActual->diff($evento);
                if ($intervalo->invert === 0) {
                    $segundosIntervalo = $intervalo->days * 86400 + $intervalo->h * 3600 + $intervalo->i * 60 + $intervalo->s;
                    $segundosIntervaloMasCercano = $intervaloMasCercano ? ($intervaloMasCercano->days * 86400 + $intervaloMasCercano->h * 3600 + $intervaloMasCercano->i * 60 + $intervaloMasCercano->s) : null;

                    if ($intervaloMasCercano === null || $segundosIntervalo < $segundosIntervaloMasCercano) {
                        $intervaloMasCercano = $intervalo;
                        $eventoMasCercano = $fecha;
                    }
                }
                
            }
        }
        if(!empty($eventosHoy)){
            foreach($eventosHoy as $eventoHoy){
    ?>
    
    <div class="evento">
        <div class="evento__img__contenedor"> 
        <img src="<?php 
                    if($eventoHoy["imagen"]==null){
                        echo "https://fikrirasyid.com/wp-content/uploads/2016/10/placeholder-portrait-3-4-56158_1080x675.jpg";
                    }
                    else{
                        echo $eventoHoy["imagen"];
                    }
                    
                ?>" class="evento__img">
        </div>
        <div class="evento__contendor">
            <h3 class="evento__titulo"><?php echo $eventoHoy["nombre"]; ?></h3>
            <p class="evento__fecha"><?php echo $eventoHoy["fecha"]; ?></p>
            <p class="evento__txt"><?php echo $eventoHoy["descripcion"]; ?></p>
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
                    if($eventoMasCercano["imagen"]==null){
                    echo "https://fikrirasyid.com/wp-content/uploads/2016/10/placeholder-portrait-3-4-56158_1080x675.jpg";
                    }
                    else{
                        echo $eventoMasCercano["imagen"];
                    }

                    ?>" class="evento__img">
            <div class="evento__contendor">
                <h3 class="evento__titulo"><?php echo $eventoMasCercano["nombre"]; ?></h3>
                <p class="evento__fecha"><?php echo $eventoMasCercano["fecha"]; ?></p>
                <p class="evento__txt"><?php echo $eventoMasCercano["descripcion"]; ?></p>
            </div>
        </div>
    </div>
    
    <div id='calendario' class="calendario"></div>
    <script>
    //npm install fullcalendar

    document.addEventListener('DOMContentLoaded', function() {
        var eventos = [
            <?php foreach ($fechas as $fecha){
                ?>
                {
                    title: '<?php echo $fecha["nombre"]; ?>',
                    rrule: {
                        freq: 'yearly',
                        dtstart: '<?php echo $fecha["fecha"]; ?>'
                    }
                },
                <?php
            }?>
        ];
        var calendarEl = document.getElementById('calendario');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'title',
                center: '',
                right: 'today prev,next'
            },
            eventClick: function(info) {
                alert('Event: ' + info.event.title); /*------------------------------cambiar----------------------------------*/
            },
            locale: 'es',
            //editable: true,
            selectable: true,
            /*
            events: [
                { title: 'Event 1', start: '2024-05-01' },
                { title: 'Event 2', start: '2024-05-02', end: '2024-05-04' }
            ]*/
            eventContent: function(arg) {
                return { html: '<b>' + arg.event.title + '</b>' }
            },
            initialView: 'dayGridMonth',
            events: eventos
        });

        calendar.render();
    });

</script>
<?php
    include './footer.html';
?>
</body>

</html>

