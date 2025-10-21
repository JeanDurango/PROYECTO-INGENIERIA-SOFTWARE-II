<?php
// IMPORTANTE: session_start() DEBE ir ANTES de cualquier salida HTML
// Validaciones para el tipo de sesión
if($_SERVER['PHP_SELF']=='/PROYECTO-INGENIERIA-SOFTWARE-II/index.php'){
    $sessiontype='index';
    include_once '../PROYECTO-INGENIERIA-SOFTWARE-II/static/session/session_validations.php';
}
else{
    if($_SERVER['PHP_SELF']=='/PROYECTO-INGENIERIA-SOFTWARE-II/pages/login.php'){
        $sessiontype='index';
        include_once '../static/session/session_validations.php';
    }
    else{
        include_once '../static/session/session_validations.php';
    }
}
?>
<!-- Estructura principal del documento HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WeRoommates - Encuentra tu hogar ideal. Apartamentos en las mejores ciudades de Colombia.">
    <meta name="keywords" content="apartamentos, alquiler, roommates, vivienda, colombia">
    <meta name="author" content="WeRoommates">
    
    <title>WeRoommates - Tu Hogar Ideal</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/PROYECTO-INGENIERIA-SOFTWARE-II/images/iconlogo.png">
    
    <!-- Bootstrap: Framework CSS para estilos y componentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <!-- Custom CSS: Estilos personalizados -->
    <link rel="stylesheet" href="/PROYECTO-INGENIERIA-SOFTWARE-II/static/css/styles.css">
    
    <!-- Google Fonts: Tipografía personalizada -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bungee&family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- jQuery (HTTPS para seguridad) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        /* Estilos del navbar mejorado */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-modern {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar-modern.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
        }

        .navbar-brand.bungeecss {
            font-family: 'Bungee', cursive;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 24px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand.bungeecss:hover {
            transform: scale(1.05);
        }

        .iconlogo {
            max-height: 45px;
            max-width: 100%;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease;
        }

        .iconlogo:hover {
            transform: rotate(10deg) scale(1.1);
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-nav {
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav.home {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-nav.home:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-nav.login {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-nav.login:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .btn-nav.signup {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
        }

        .btn-nav.signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-nav.logout {
            background: transparent;
            color: #ff4757;
            border: 2px solid #ff4757;
        }

        .btn-nav.logout:hover {
            background: #ff4757;
            color: white;
            transform: translateY(-2px);
        }

        .btn-nav.profile {
            background: transparent;
            color: #764ba2;
            border: 2px solid #764ba2;
        }

        .btn-nav.profile:hover {
            background: #764ba2;
            color: white;
            transform: translateY(-2px);
        }

        .btn-nav.admin {
            background: transparent;
            color: #ffa502;
            border: 2px solid #ffa502;
        }

        .btn-nav.admin:hover {
            background: #ffa502;
            color: white;
            transform: translateY(-2px);
        }

        /* Botón scroll up mejorado */
        .ir-arriba {
            display: none;
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 50%;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            z-index: 999;
        }

        .ir-arriba:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
        }

        .ir-arriba .material-icons {
            font-size: 32px;
        }

        /* Container principal */
        .container-main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand.bungeecss {
                font-size: 18px;
            }

            .iconlogo {
                max-height: 35px;
            }

            .nav-buttons {
                flex-wrap: wrap;
                gap: 5px;
            }

            .btn-nav {
                padding: 8px 15px;
                font-size: 12px;
            }

            .ir-arriba {
                width: 45px;
                height: 45px;
                bottom: 20px;
                right: 20px;
                text-align: center;
            }

            .ir-arriba .material-icons {
                font-size: 28px;
                text-align: center;
            }
        }

        /* Animación de carga */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-modern {
            animation: fadeIn 0.5s ease;
        }

        /* Estilos para colapso en móvil */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 20px;
                margin-top: 15px;
                border-radius: 15px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            }

            .nav-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-nav {
                width: 100%;
                justify-content: center;
                margin: 5px 0;
            }
        }
    </style>
</head>

<body data-logged-in="<?php echo (isset($_SESSION['id']) && $_SESSION['id'] > 0) ? 'true' : 'false'; ?>">
    
    <!-- Barra de navegación moderna -->
    <nav class="navbar navbar-modern sticky-top navbar-expand-lg">
        <div class="container-fluid px-4">
            <!-- Logo y nombre -->
            <a class="navbar-brand bungeecss" href="/PROYECTO-INGENIERIA-SOFTWARE-II/index.php">
                <img class="iconlogo" src="/PROYECTO-INGENIERIA-SOFTWARE-II/images/iconlogo.png" alt="WeRoommates Logo">
                <span>WEROOMMATES</span>
            </a>
            
            <!-- Toggle para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    style="border: 2px solid #667eea; color: #667eea;">
                <span class="navbar-toggler-icon" style="filter: invert(0.4) sepia(1) saturate(5) hue-rotate(210deg);"></span>
            </button>
            
            <!-- Botones de navegación -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="nav-buttons">
                    <a href='/PROYECTO-INGENIERIA-SOFTWARE-II/index.php' class='btn-nav home'>
                        <span class="material-icons" style="font-size: 18px;">home</span>
                        Inicio
                    </a>
                    <?php
                        // Generar botones según el estado de sesión
                        if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                            // Usuario logueado
                            echo "<a href='/PROYECTO-INGENIERIA-SOFTWARE-II/pages/profile.php' class='btn-nav profile'>
                                    <span class='material-icons' style='font-size: 18px;'>account_circle</span>
                                    Perfil
                                  </a>";
                            
                            // Botón especial para administrador
                            if(isset($_SESSION['role']) && $_SESSION['role'] === 'Administrador') {
                                echo "<a href='/PROYECTO-INGENIERIA-SOFTWARE-II/pages/adminlist.php' class='btn-nav admin'>
                                        <span class='material-icons' style='font-size: 18px;'>admin_panel_settings</span>
                                        Solicitudes
                                      </a>";
                            }
                            
                            echo "<a href='/PROYECTO-INGENIERIA-SOFTWARE-II/pages/logout_validation.php' class='btn-nav logout'>
                                    <span class='material-icons' style='font-size: 18px;'>logout</span>
                                    Cerrar Sesión
                                  </a>";
                        } else {
                            // Usuario no logueado
                            echo "<a href='/PROYECTO-INGENIERIA-SOFTWARE-II/pages/login.php' class='btn-nav login'>
                                    <span class='material-icons' style='font-size: 18px;'>login</span>
                                    Iniciar Sesión
                                  </a>";
                            echo "<a href='/PROYECTO-INGENIERIA-SOFTWARE-II/pages/signup.php' class='btn-nav signup'>
                                    <span class='material-icons' style='font-size: 18px;'>person_add</span>
                                    Registrarse
                                  </a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Botón hacia arriba -->
    <div class="ir-arriba" id="scrollTopBtn">
        <span class="material-icons">arrow_upward</span>
    </div>
    
    <!-- Contenedor principal -->
    <div class="container">

<script>
// Script mejorado para scroll up
$(document).ready(function() {
    // Mostrar/ocultar botón scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.ir-arriba').fadeIn(300);
            $('.navbar-modern').addClass('scrolled');
        } else {
            $('.ir-arriba').fadeOut(300);
            $('.navbar-modern').removeClass('scrolled');
        }
    });

    // Scroll suave al hacer clic
    $('.ir-arriba').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 600, 'swing');
        return false;
    });
});

// Cerrar navbar en móvil al hacer clic en un link
document.querySelectorAll('.btn-nav').forEach(item => {
    item.addEventListener('click', () => {
        const navbar = document.querySelector('.navbar-collapse');
        if (navbar && navbar.classList.contains('show')) {
            const bsCollapse = new bootstrap.Collapse(navbar);
            bsCollapse.hide();
        }
    });
});
</script>