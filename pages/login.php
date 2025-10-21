<?php 
$sessiontype = 'index';
include_once("../static/layouts/header.php");
?>

<style>
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .auth-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 1000px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .auth-visual {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .auth-visual::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .auth-visual-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .auth-visual h2 {
        font-size: 36px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .auth-visual p {
        font-size: 18px;
        opacity: 0.9;
        line-height: 1.6;
    }

    .auth-icon {
        font-size: 80px;
        margin-bottom: 30px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .auth-form {
        padding: 60px 50px;
    }

    .auth-form h1 {
        color: #333;
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .auth-form-subtitle {
        color: #777;
        margin-bottom: 40px;
        font-size: 16px;
    }

    .form-group-modern {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group-modern label {
        display: block;
        color: #555;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 20px;
    }

    .form-control-modern {
        width: 100%;
        padding: 14px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .btn-login {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .auth-footer {
        text-align: center;
        margin-top: 30px;
        color: #777;
    }

    .auth-footer a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .auth-footer a:hover {
        color: #764ba2;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    @media (max-width: 968px) {
        .auth-card {
            grid-template-columns: 1fr;
        }

        .auth-visual {
            padding: 40px 30px;
        }

        .auth-visual h2 {
            font-size: 28px;
        }

        .auth-form {
            padding: 40px 30px;
        }

        .auth-form h1 {
            font-size: 26px;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <!-- Panel Visual Izquierdo -->
        <div class="auth-visual">
            <div class="auth-visual-content">
                <div class="auth-icon">🏠</div>
                <h2>¡Bienvenido de nuevo!</h2>
                <p>Ingresa a tu cuenta para acceder a las mejores propiedades y gestionar tus reservas.</p>
            </div>
        </div>

        <!-- Formulario Derecho -->
        <div class="auth-form">
            <h1>Iniciar Sesión</h1>
            <p class="auth-form-subtitle">Ingresa tus credenciales para continuar</p>

            <form onsubmit="return loginValidation()" method="POST" action="login_validation.php">
                <div class="form-group-modern">
                    <label for="emaillogin">Correo electrónico</label>
                    <div class="input-icon-wrapper">
                        <span class="material-icons input-icon">email</span>
                        <input type="email" 
                               class="form-control-modern" 
                               id="emaillogin" 
                               name="emaillogin" 
                               placeholder="tu@email.com"
                               required>
                    </div>
                </div>

                <div class="form-group-modern">
                    <label for="passwordlogin">Contraseña</label>
                    <div class="input-icon-wrapper">
                        <span class="material-icons input-icon">lock</span>
                        <input type="password" 
                               class="form-control-modern" 
                               id="passwordlogin" 
                               name="passwordlogin" 
                               placeholder="••••••••"
                               required>
                        <span class="material-icons password-toggle" onclick="togglePassword('passwordlogin')">
                            visibility_off
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span class="material-icons">login</span>
                    Iniciar Sesión
                </button>

                <div class="auth-footer">
                    <p>¿No tienes una cuenta? 
                        <a href="signup.php">Regístrate aquí</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.parentElement.querySelector('.password-toggle');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
    }
}

// Animación de entrada
document.addEventListener('DOMContentLoaded', function() {
    const card = document.querySelector('.auth-card');
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    
    setTimeout(() => {
        card.style.transition = 'all 0.6s ease';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 100);
});
</script>

<?php include_once("../static/layouts/footer.php") ?>