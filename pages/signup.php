<?php 
$sessiontype = 'index';
include_once("../static/layouts/header.php");
?>

<style>
    .signup-container {
        padding: 40px 20px;
        min-height: 90vh;
    }

    .signup-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .signup-header h1 {
        font-size: 42px;
        font-weight: bold;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
    }

    .signup-header p {
        color: #777;
        font-size: 18px;
    }

    .signup-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        margin: 0 auto;
        padding: 50px;
    }

    .form-section {
        margin-bottom: 35px;
    }

    .form-section-title {
        color: #667eea;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-title .material-icons {
        font-size: 24px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group-signup {
        margin-bottom: 20px;
    }

    .form-group-signup label {
        display: block;
        color: #555;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-group-signup label .required {
        color: #ff4757;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon-left {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 20px;
    }

    .form-control-signup {
        width: 100%;
        padding: 14px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control-signup:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-control-signup.has-icon {
        padding-left: 45px;
    }

    textarea.form-control-signup {
        resize: vertical;
        min-height: 120px;
        padding: 14px 20px;
    }

    select.form-control-signup {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%23999' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
    }

    .role-selector {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .role-option {
        position: relative;
    }

    .role-option input[type="radio"] {
        display: none;
    }

    .role-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .role-label:hover {
        border-color: #667eea;
        background: white;
    }

    .role-option input[type="radio"]:checked + .role-label {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
    }

    .role-icon {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .role-name {
        font-weight: 600;
        color: #333;
    }

    .role-description {
        font-size: 12px;
        color: #777;
        text-align: center;
        margin-top: 5px;
    }

    .photo-input-group {
        display: flex;
        gap: 15px;
        align-items: flex-end;
    }

    .photo-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        overflow: hidden;
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview .material-icons {
        font-size: 48px;
        color: #ccc;
    }

    .btn-signup {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-signup:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-cancel {
        width: 100%;
        padding: 16px;
        background: transparent;
        color: #667eea;
        border: 2px solid #667eea;
        border-radius: 12px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 15px;
    }

    .btn-cancel:hover {
        background: #667eea;
        color: white;
    }

    .signup-footer {
        text-align: center;
        margin-top: 30px;
        color: #777;
    }

    .signup-footer a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .signup-footer a:hover {
        color: #764ba2;
    }

    @media (max-width: 768px) {
        .signup-card {
            padding: 30px 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .role-selector {
            grid-template-columns: 1fr;
        }

        .photo-input-group {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<div class="signup-container">
    <div class="signup-header">
        <h1>✨ Crear Cuenta</h1>
        <p>Únete a nuestra comunidad y encuentra tu hogar ideal</p>
    </div>

    <div class="signup-card">
        <form onsubmit="return registerValidation()" method="POST" action="create_userdata.php">
            
            <!-- Información Personal -->
            <div class="form-section">
                <div class="form-section-title">
                    <span class="material-icons">person</span>
                    Información Personal
                </div>

                <div class="form-group-signup">
                    <label>Nombre completo <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <span class="material-icons input-icon-left">badge</span>
                        <input type="text" 
                               class="form-control-signup has-icon" 
                               id="namesignup" 
                               name="namesignup" 
                               placeholder="Juan Pérez"
                               required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-signup">
                        <label>Correo electrónico <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <span class="material-icons input-icon-left">email</span>
                            <input type="email" 
                                   class="form-control-signup has-icon" 
                                   id="emailsignup" 
                                   name="emailsignup" 
                                   placeholder="tu@email.com"
                                   required>
                        </div>
                    </div>

                    <div class="form-group-signup">
                        <label>Contraseña <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <span class="material-icons input-icon-left">lock</span>
                            <input type="password" 
                                   class="form-control-signup has-icon" 
                                   id="passwordsignup" 
                                   name="passwordsignup" 
                                   placeholder="••••••••"
                                   minlength="6"
                                   required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ubicación -->
            <div class="form-section">
                <div class="form-section-title">
                    <span class="material-icons">location_on</span>
                    Ubicación
                </div>

                <div class="form-row">
                    <div class="form-group-signup">
                        <label>País <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <span class="material-icons input-icon-left">public</span>
                            <input type="text" 
                                   class="form-control-signup has-icon" 
                                   id="countrysignup" 
                                   name="countrysignup" 
                                   placeholder="Colombia"
                                   required>
                        </div>
                    </div>

                    <div class="form-group-signup">
                        <label>Ciudad <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <span class="material-icons input-icon-left">location_city</span>
                            <input type="text" 
                                   class="form-control-signup has-icon" 
                                   id="townsignup" 
                                   name="townsignup" 
                                   placeholder="Medellín"
                                   required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rol -->
            <div class="form-section">
                <div class="form-section-title">
                    <span class="material-icons">how_to_reg</span>
                    Selecciona tu rol
                </div>

                <div class="role-selector">
                    <div class="role-option">
                        <input type="radio" id="role_anfitrion" name="rolesignup" value="Anfitrión" required>
                        <label for="role_anfitrion" class="role-label">
                            <div class="role-icon">🏠</div>
                            <div class="role-name">Anfitrión</div>
                            <div class="role-description">Ofrece propiedades</div>
                        </label>
                    </div>

                    <div class="role-option">
                        <input type="radio" id="role_invitado" name="rolesignup" value="Invitado">
                        <label for="role_invitado" class="role-label">
                            <div class="role-icon">🧳</div>
                            <div class="role-name">Invitado</div>
                            <div class="role-description">Busca alojamiento</div>
                        </label>
                    </div>

                    <div class="role-option">
                        <input type="radio" id="role_admin" name="rolesignup" value="Administrador">
                        <label for="role_admin" class="role-label">
                            <div class="role-icon">👑</div>
                            <div class="role-name">Administrador</div>
                            <div class="role-description">Gestiona la plataforma</div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Perfil -->
            <div class="form-section">
                <div class="form-section-title">
                    <span class="material-icons">account_circle</span>
                    Perfil
                </div>

                <div class="form-group-signup">
                    <label>URL de tu foto <span class="required">*</span></label>
                    <div class="photo-input-group">
                        <div class="photo-preview" id="photoPreview">
                            <span class="material-icons">add_a_photo</span>
                        </div>
                        <div style="flex: 1;">
                            <input type="text" 
                                   class="form-control-signup" 
                                   id="photosignup" 
                                   name="photosignup" 
                                   placeholder="https://example.com/tu-foto.jpg"
                                   onchange="previewPhoto()"
                                   required>
                            <small style="color: #777;">Ingresa la URL de tu foto de perfil</small>
                        </div>
                    </div>
                </div>

                <div class="form-group-signup">
                    <label>Reseña personal <span class="required">*</span></label>
                    <textarea class="form-control-signup" 
                              id="reviewsignup" 
                              name="reviewsignup" 
                              placeholder="Cuéntanos sobre ti, tus intereses y qué buscas en WeRoommates..."
                              required></textarea>
                </div>
            </div>

            <!-- Botones -->
            <button type="submit" class="btn-signup">
                <span class="material-icons">person_add</span>
                Crear Cuenta
            </button>

            <button type="button" class="btn-cancel" onclick="window.location.href='/PROYECTO-INGENIERIA-SOFTWARE-II/index.php'">
                Cancelar
            </button>

            <div class="signup-footer">
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </form>
    </div>
</div>

<script>
// Preview de foto
function previewPhoto() {
    const photoUrl = document.getElementById('photosignup').value;
    const preview = document.getElementById('photoPreview');
    
    if (photoUrl) {
        preview.innerHTML = `<img src="${photoUrl}" alt="Preview" onerror="this.parentElement.innerHTML='<span class=\'material-icons\'>broken_image</span>'">`;
    } else {
        preview.innerHTML = '<span class="material-icons">add_a_photo</span>';
    }
}

// Animación de entrada
document.addEventListener('DOMContentLoaded', function() {
    const card = document.querySelector('.signup-card');
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