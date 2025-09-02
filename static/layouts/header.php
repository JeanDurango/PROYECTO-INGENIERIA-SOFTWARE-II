<!-- Estructura principal del documento HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Compatibilidad con IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive -->
    <title>WeRoommates</title> <!-- Título de la página -->
    
    <!-- Bootstrap: Framework CSS para estilos y componentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <!-- Custom CSS: Estilos personalizados -->
    <link rel="stylesheet" href="/PROYECTO-INGENIERIA-SOFTWARE-II/static/css/styles.css">
    
    <!-- Google Fonts: Tipografía personalizada -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bungee&display=swap">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- JS: jQuery y script para botón hacia arriba -->
    <script src="http://code.jquery.com/jquery-latest.js"></script> <!-- jQuery -->
    <script src="/PROYECTO-INGENIERIA-SOFTWARE-II/static/js/up_arrow.js"></script>    <!-- Script para botón scroll up -->
</head>

<body>
    <?php   
    // Validaciones para el tipo de sesión y botones a mostrar
    // Dependiendo de la página actual, se define el tipo de sesión y se incluye el archivo de validación de sesión
    if($_SERVER['PHP_SELF']=='/PROYECTO-INGENIERIA-SOFTWARE-II/index.php'){
        $sessiontype='index'; // Página principal
        include_once '../PROYECTO-INGENIERIA-SOFTWARE-II/static/session/session_validations.php'; // Validación de sesión para index
    }
    else{
        if($_SERVER['PHP_SELF']=='/PROYECTO-INGENIERIA-SOFTWARE-II/pages/login.php'){
            $sessiontype='index'; // Página de login
            include_once '../static/session/session_validations.php'; // Validación de sesión para login
            }
        else{
            include_once '../static/session/session_validations.php'; // Validación de sesión para otras páginas
        }
    }    
    ?> 
    
    <!-- Barra de navegación fija: Menú superior con logo y botones -->
    <nav class="navbar sticky-top navbar-dark bg-dark"> <!-- Barra de navegación -->
    <div class="container-fluid"> <!-- Contenedor de la barra -->
            <div class=""> <!-- Logo y nombre -->
                <a class="navbar-brand bungeecss" href="/PROYECTO-INGENIERIA-SOFTWARE-II/index.php"><img class="iconlogo" src="/PROYECTO-INGENIERIA-SOFTWARE-II/images/iconlogo.png" alt="">WEROOMMATES</a>
            </div>            
            <div class="d-md-flex"> <!-- Botones de navegación -->
                <a type='button' href='/PROYECTO-INGENIERIA-SOFTWARE-II/index.php' class='btn btn-outline-primary home'>Inicio</a>
                <?php
                    // Botón de login/logout según el estado de sesión
                    echo ($loginlogoutbutton);
                ?>
            </div>
        </div>
    </nav>
    
    <!-- Botón hacia arriba: aparece al hacer scroll -->
    <span class="ir-arriba material-icons md-48">arrow_circle_up</span> <!-- Icono scroll up -->
    
    <!-- Inicio de página: contenedor principal -->
    <div class="container"> <!-- Contenido principal -->
