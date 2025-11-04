<?php 
$sessiontype = 'all';
include_once("../static/layouts/header.php");

$id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Invitado';

include_once '../database/models/UsersModel.php';    
$usersModel = new UsersModel();    
$user = $usersModel->getUser($id);

// Validar que el usuario existe
if (!$user) {
    echo "<script>alert('Error al cargar el perfil'); window.location.href='profile.php';</script>";
    exit;
}

// Valores seguros
$userName = isset($user['name']) ? htmlspecialchars($user['name']) : '';
$userEmail = htmlspecialchars($email);
$userCountry = isset($user['country']) ? htmlspecialchars($user['country']) : '';
$userTown = isset($user['town']) ? htmlspecialchars($user['town']) : '';
$userPassword = isset($user['password']) ? htmlspecialchars($user['password']) : '';
$userRole = htmlspecialchars($role);
$userPhoto = isset($user['photo']) ? htmlspecialchars($user['photo']) : '';
$userReview = isset($user['personalreview']) ? htmlspecialchars($user['personalreview']) : '';
?>

<style>
    /* Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea, #764ba2);
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #2ecc71;
        --danger-color: #ff4757;
        --warning-color: #ffa502;
        --gray-50: #f8f9fa;
        --gray-100: #f0f0f0;
        --gray-200: #e9ecef;
        --gray-500: #adb5bd;
        --gray-700: #495057;
        --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
        --radius-lg: 20px;
        --transition: all 0.3s ease;
    }

    /* Contenedor principal */
    .edit-profile-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Header */
    .page-header {
        background: var(--primary-gradient);
        border-radius: var(--radius-lg);
        padding: 50px 40px;
        color: white;
        margin-bottom: 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
        top: -200px;
        right: -200px;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left h1 {
        font-size: 36px;
        margin: 0 0 10px 0;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-left .subtitle {
        font-size: 16px;
        opacity: 0.9;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-back:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    /* Layout del formulario */
    .form-layout {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 30px;
    }

    /* Tarjeta */
    .card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 35px;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .card:hover {
        box-shadow: var(--shadow-lg);
    }

    .card-title {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--gray-100);
    }

    .card-title .material-icons {
        color: var(--primary-color);
        font-size: 28px;
    }

    /* Sidebar de foto */
    .photo-sidebar {
        position: sticky;
        top: 100px;
    }

    .photo-section {
        text-align: center;
        margin-bottom: 25px;
    }

    .photo-preview-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .photo-preview-large {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--gray-100);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: var(--transition);
    }

    .photo-preview-large:hover {
        transform: scale(1.05);
        border-color: var(--primary-color);
    }

    .photo-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-gradient);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        font-size: 24px;
    }

    .photo-info {
        background: var(--gray-50);
        padding: 20px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .photo-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        font-size: 14px;
        color: var(--gray-700);
    }

    .photo-info-item:last-child {
        margin-bottom: 0;
    }

    .photo-info-item .material-icons {
        color: var(--primary-color);
        font-size: 20px;
    }

    /* Formulario */
    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 10px;
        font-size: 15px;
    }

    .form-label .material-icons {
        font-size: 20px;
        color: var(--primary-color);
    }

    .required {
        color: var(--danger-color);
    }

    .form-control-modern {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-size: 15px;
        transition: var(--transition);
        background: var(--gray-50);
        font-family: 'Poppins', sans-serif;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary-color);
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-control-modern:disabled {
        background: var(--gray-200);
        cursor: not-allowed;
        opacity: 0.7;
    }

    textarea.form-control-modern {
        resize: vertical;
        min-height: 150px;
        font-family: 'Poppins', sans-serif;
    }

    /* Grid de 2 columnas */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Select moderno */
    .custom-select {
        position: relative;
    }

    .custom-select select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%23667eea' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
        cursor: pointer;
    }

    /* Role selector con badges */
    .role-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-top: 10px;
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
        padding: 20px 15px;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        cursor: pointer;
        transition: var(--transition);
        background: white;
    }

    .role-label:hover {
        border-color: var(--primary-color);
        background: rgba(102, 126, 234, 0.05);
    }

    .role-option input[type="radio"]:checked + .role-label {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }

    .role-icon {
        font-size: 36px;
        margin-bottom: 8px;
    }

    .role-name {
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    /* Password toggle */
    .password-field {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--gray-500);
        transition: var(--transition);
    }

    .password-toggle:hover {
        color: var(--primary-color);
    }

    /* Contador de caracteres */
    .input-with-counter {
        position: relative;
    }

    .char-counter {
        position: absolute;
        right: 15px;
        bottom: 15px;
        font-size: 12px;
        color: var(--gray-500);
        background: white;
        padding: 5px 10px;
        border-radius: 8px;
        font-weight: 600;
    }

    /* Botones de acción */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 3px solid var(--gray-100);
    }

    .btn-submit {
        flex: 1;
        padding: 16px 30px;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-cancel {
        flex: 1;
        padding: 16px 30px;
        background: transparent;
        color: var(--gray-700);
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: var(--gray-100);
        border-color: var(--gray-500);
        transform: translateY(-2px);
    }

    /* Info boxes */
    .info-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        padding: 20px;
        border-radius: 12px;
        margin-top: 20px;
        border-left: 4px solid var(--primary-color);
    }

    .info-box-title {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-box-content {
        font-size: 14px;
        color: var(--gray-700);
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .form-layout {
            grid-template-columns: 1fr;
        }

        .photo-sidebar {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .role-options {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }
    }

    /* Animaciones */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeInUp 0.6s ease;
    }
</style>

<div class="edit-profile-container">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1>
                    <span class="material-icons">edit</span>
                    Editar Mi Perfil
                </h1>
                <p class="subtitle">Mantén tu información actualizada y completa</p>
            </div>
            <a href="profile.php" class="btn-back">
                <span class="material-icons">arrow_back</span>
                Volver al perfil
            </a>
        </div>
    </div>

    <!-- Formulario -->
    <form onsubmit="return editProfileValidation()" method="POST" action="update_profile.php">
        <div class="form-layout">
            <!-- Sidebar de foto -->
            <div class="photo-sidebar">
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons">account_circle</span>
                        Foto de Perfil
                    </h3>

                    <div class="photo-section">
                        <div class="photo-preview-wrapper">
                            <img src="<?php echo $userPhoto; ?>" 
                                 alt="<?php echo $userName; ?>" 
                                 class="photo-preview-large"
                                 id="photoPreviewLarge"
                                 onerror="this.src='https://via.placeholder.com/200'">
                            <div class="photo-badge">
                                <span class="material-icons">camera_alt</span>
                            </div>
                        </div>

                        <div class="photo-info">
                            <div class="photo-info-item">
                                <span class="material-icons">info</span>
                                <span>Tamaño recomendado: 400x400px</span>
                            </div>
                            <div class="photo-info-item">
                                <span class="material-icons">image</span>
                                <span>Formato: JPG, PNG</span>
                            </div>
                            <div class="photo-info-item">
                                <span class="material-icons">verified</span>
                                <span>Usa una foto clara de tu rostro</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="info-box-title">
                            <span class="material-icons">lightbulb</span>
                            Consejo
                        </div>
                        <div class="info-box-content">
                            Un perfil completo con foto genera más confianza y aumenta tus posibilidades de conexión.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario principal -->
            <div>
                <!-- Información Personal -->
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons">person</span>
                        Información Personal
                    </h3>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">badge</span>
                            Nombre Completo <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="nameedit" 
                               name="nameedit" 
                               value="<?php echo $userName; ?>"
                               placeholder="Tu nombre completo"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">email</span>
                            Correo Electrónico
                        </label>
                        <input type="email" 
                               class="form-control-modern" 
                               id="emailedit" 
                               name="emailedit" 
                               value="<?php echo $userEmail; ?>"
                               readonly
                               disabled>
                        <small style="color: var(--gray-500); font-size: 13px; margin-top: 5px; display: block;">
                            <span class="material-icons" style="font-size: 14px; vertical-align: middle;">lock</span>
                            El correo no puede modificarse
                        </small>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">public</span>
                                País <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-modern" 
                                   id="countryedit" 
                                   name="countryedit" 
                                   value="<?php echo $userCountry; ?>"
                                   placeholder="Ej: Colombia"
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">location_city</span>
                                Ciudad <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-modern" 
                                   id="townedit" 
                                   name="townedit" 
                                   value="<?php echo $userTown; ?>"
                                   placeholder="Ej: Medellín"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">lock</span>
                            Contraseña <span class="required">*</span>
                        </label>
                        <div class="password-field">
                            <input type="password" 
                                   class="form-control-modern" 
                                   id="passwordedit" 
                                   name="passwordedit" 
                                   value="<?php echo $userPassword; ?>"
                                   placeholder="Tu contraseña segura"
                                   required>
                            <span class="material-icons password-toggle" onclick="togglePassword()">
                                visibility_off
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Rol -->
                <div class="card" style="margin-top: 30px;">
                    <h3 class="card-title">
                        <span class="material-icons">work</span>
                        Rol en la Plataforma
                    </h3>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">how_to_reg</span>
                            Selecciona tu rol
                        </label>

                        <div class="role-options">
                            <div class="role-option">
                                <input type="radio" 
                                       id="role_anfitrion" 
                                       name="roleedit" 
                                       value="Anfitrión"
                                       <?php echo $userRole === 'Anfitrión' ? 'checked' : ''; ?>>
                                <label for="role_anfitrion" class="role-label">
                                    <div class="role-icon">🏠</div>
                                    <div class="role-name">Anfitrión</div>
                                </label>
                            </div>

                            <div class="role-option">
                                <input type="radio" 
                                       id="role_invitado" 
                                       name="roleedit" 
                                       value="Invitado"
                                       <?php echo $userRole === 'Invitado' ? 'checked' : ''; ?>>
                                <label for="role_invitado" class="role-label">
                                    <div class="role-icon">🧳</div>
                                    <div class="role-name">Invitado</div>
                                </label>
                            </div>

                            <div class="role-option">
                                <input type="radio" 
                                       id="role_admin" 
                                       name="roleedit" 
                                       value="Administrador"
                                       <?php echo $userRole === 'Administrador' ? 'checked' : ''; ?>>
                                <label for="role_admin" class="role-label">
                                    <div class="role-icon">👑</div>
                                    <div class="role-name">Administrador</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perfil Público -->
                <div class="card" style="margin-top: 30px;">
                    <h3 class="card-title">
                        <span class="material-icons">photo</span>
                        Perfil Público
                    </h3>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">link</span>
                            URL de tu Foto <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="photoedit" 
                               name="photoedit" 
                               value="<?php echo $userPhoto; ?>"
                               placeholder="https://ejemplo.com/tu-foto.jpg"
                               oninput="updatePhotoPreview()"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">description</span>
                            Reseña Personal <span class="required">*</span>
                        </label>
                        <div class="input-with-counter">
                            <textarea class="form-control-modern" 
                                      id="reviewedit" 
                                      name="reviewedit" 
                                      placeholder="Cuéntanos sobre ti: tus intereses, experiencias, qué te gusta hacer..."
                                      maxlength="500"
                                      oninput="updateCharCount()"
                                      required><?php echo $userReview; ?></textarea>
                            <span class="char-counter" id="charCount">0 / 500</span>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="action-buttons">
                    <button type="submit" class="btn-submit">
                        <span class="material-icons">save</span>
                        Guardar Cambios
                    </button>
                    <a href="profile.php" class="btn-cancel">
                        <span class="material-icons">close</span>
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Toggle password visibility
function togglePassword() {
    const input = document.getElementById('passwordedit');
    const icon = document.querySelector('.password-toggle');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
    }
}

// Actualizar preview de foto
function updatePhotoPreview() {
    const photoUrl = document.getElementById('photoedit').value;
    const preview = document.getElementById('photoPreviewLarge');
    
    if (photoUrl.trim() !== '') {
        preview.src = photoUrl;
    }
}

// Contador de caracteres
function updateCharCount() {
    const textarea = document.getElementById('reviewedit');
    const counter = document.getElementById('charCount');
    const length = textarea.value.length;
    counter.textContent = `${length} / 500`;
    
    if (length > 450) {
        counter.style.color = '#ff4757';
        counter.style.fontWeight = 'bold';
    } else if (length > 350) {
        counter.style.color = '#ffa502';
    } else {
        counter.style.color = '#adb5bd';
        counter.style.fontWeight = '600';
    }
}

// Validación del formulario
function editProfileValidation() {
    const name = document.getElementById('nameedit').value.trim();
    const country = document.getElementById('countryedit').value.trim();
    const town = document.getElementById('townedit').value.trim();
    const password = document.getElementById('passwordedit').value.trim();
    const photo = document.getElementById('photoedit').value.trim();
    const review = document.getElementById('reviewedit').value.trim();
    const role = document.querySelector('input[name="roleedit"]:checked');

    if (!name || !country || !town || !password || !photo || !review) {
        showNotification('⚠️ Por favor completa todos los campos obligatorios', 'warning');
        highlightEmptyFields();
        return false;
    }

    if (!role) {
        showNotification('⚠️ Por favor selecciona un rol', 'warning');
        return false;
    }

    if (password.length < 6) {
        showNotification('⚠️ La contraseña debe tener al menos 6 caracteres', 'warning');
        document.getElementById('passwordedit').focus();
        return false;
    }

    if (review.length < 20) {
        showNotification('⚠️ La reseña personal debe tener al menos 20 caracteres', 'warning');
        document.getElementById('reviewedit').focus();
        return false;
    }

    showNotification('✓ Guardando cambios...', 'success');
    return true;
}

// Resaltar campos vacíos
function highlightEmptyFields() {
    const fields = ['nameedit', 'countryedit', 'townedit', 'passwordedit', 'photoedit', 'reviewedit'];
    fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            field.style.borderColor = '#ff4757';
            field.style.animation = 'shake 0.5s';
            setTimeout(() => {
                field.style.borderColor = '';
                field.style.animation = '';
            }, 500);
        }
    });
}

// Notificación toast
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 30px;
        background: ${type === 'success' ? '#2ecc71' : type === 'warning' ? '#ffa502' : '#ff4757'};
        color: white;
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 15px;
        animation: slideInRight 0.4s ease;
        max-width: 400px;
        font-weight: 600;
    `;
    
    notification.innerHTML = `
        <span class="material-icons" style="font-size: 24px;">${
            type === 'success' ? 'check_circle' : 
            type === 'warning' ? 'warning' : 'error'
        }</span>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.4s ease';
        setTimeout(() => notification.remove(), 400);
    }, 4000);
}

// Animaciones
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Inicializar al cargar
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar contador
    updateCharCount();
    
    // Animación de entrada
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Auto-save en localStorage (draft)
    const autoSave = () => {
        const formData = {
            name: document.getElementById('nameedit').value,
            country: document.getElementById('countryedit').value,
            town: document.getElementById('townedit').value,
            password: document.getElementById('passwordedit').value,
            photo: document.getElementById('photoedit').value,
            review: document.getElementById('reviewedit').value,
            role: document.querySelector('input[name="roleedit"]:checked')?.value
        };
        localStorage.setItem('profileDraft', JSON.stringify(formData));
    };
    
    // Auto-guardar cada 3 segundos
    let saveTimeout;
    const inputs = document.querySelectorAll('.form-control-modern, input[name="roleedit"]');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(autoSave, 3000);
        });
    });
    
    // Cargar draft si existe
    const savedData = localStorage.getItem('profileDraft');
    if (savedData) {
        const data = JSON.parse(savedData);
        const hasChanges = 
            data.name !== document.getElementById('nameedit').value ||
            data.country !== document.getElementById('countryedit').value ||
            data.town !== document.getElementById('townedit').value;
        
        if (hasChanges && confirm('¿Deseas recuperar los cambios no guardados?')) {
            document.getElementById('nameedit').value = data.name || '';
            document.getElementById('countryedit').value = data.country || '';
            document.getElementById('townedit').value = data.town || '';
            document.getElementById('passwordedit').value = data.password || '';
            document.getElementById('photoedit').value = data.photo || '';
            document.getElementById('reviewedit').value = data.review || '';
            
            if (data.role) {
                const roleInput = document.querySelector(`input[value="${data.role}"]`);
                if (roleInput) roleInput.checked = true;
            }
            
            updateCharCount();
            updatePhotoPreview();
        }
    }
    
    // Efectos de hover en inputs
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Limpiar localStorage al enviar
document.querySelector('form').addEventListener('submit', function() {
    localStorage.removeItem('profileDraft');
});

// Confirmación antes de salir con cambios
window.addEventListener('beforeunload', function(e) {
    const originalName = "<?php echo $userName; ?>";
    const currentName = document.getElementById('nameedit').value.trim();
    
    if (currentName !== originalName) {
        e.preventDefault();
        e.returnValue = '¿Seguro que quieres salir? Los cambios no guardados se perderán.';
        return e.returnValue;
    }
});

// Atajos de teclado
document.addEventListener('keydown', function(e) {
    // Ctrl + S para guardar
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        document.querySelector('form').submit();
    }
    
    // Escape para cancelar
    if (e.key === 'Escape') {
        if (confirm('¿Deseas cancelar y volver al perfil?')) {
            window.location.href = 'profile.php';
        }
    }
});

// Validar foto al cambiar URL
document.getElementById('photoedit').addEventListener('blur', function() {
    const url = this.value.trim();
    if (url) {
        const img = new Image();
        img.onload = function() {
            showNotification('✓ Foto válida', 'success');
        };
        img.onerror = function() {
            showNotification('⚠️ No se pudo cargar la imagen. Verifica la URL', 'warning');
        };
        img.src = url;
    }
});

// Indicador de fortaleza de contraseña
document.getElementById('passwordedit').addEventListener('input', function() {
    const password = this.value;
    const strength = calculatePasswordStrength(password);
    
    // Remover indicador previo
    let indicator = document.querySelector('.password-strength');
    if (indicator) indicator.remove();
    
    if (password.length > 0) {
        indicator = document.createElement('div');
        indicator.className = 'password-strength';
        indicator.style.cssText = `
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            background: ${strength.color}20;
            color: ${strength.color};
            border: 1px solid ${strength.color};
        `;
        indicator.textContent = `Fortaleza: ${strength.text}`;
        this.parentElement.appendChild(indicator);
    }
});

function calculatePasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 6) strength++;
    if (password.length >= 10) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;
    
    if (strength <= 2) return { text: 'Débil', color: '#ff4757' };
    if (strength <= 3) return { text: 'Media', color: '#ffa502' };
    if (strength <= 4) return { text: 'Buena', color: '#2ecc71' };
    return { text: 'Muy Fuerte', color: '#00d2d3' };
}

// Preview instantáneo de cambios
document.getElementById('nameedit').addEventListener('input', function() {
    // Aquí podrías actualizar una vista previa si la implementas
    console.log('Nombre actualizado:', this.value);
});

// Contador de cambios realizados
let changesCount = 0;
const formInputs = document.querySelectorAll('.form-control-modern, input[name="roleedit"]');
formInputs.forEach(input => {
    input.addEventListener('change', function() {
        changesCount++;
        updateChangesIndicator();
    });
});

function updateChangesIndicator() {
    let indicator = document.querySelector('.changes-indicator');
    if (!indicator && changesCount > 0) {
        indicator = document.createElement('div');
        indicator.className = 'changes-indicator';
        indicator.style.cssText = `
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-gradient);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            z-index: 1000;
            font-weight: 600;
            animation: slideUp 0.4s ease;
        `;
        document.body.appendChild(indicator);
    }
    
    if (indicator) {
        indicator.textContent = `${changesCount} cambio${changesCount > 1 ? 's' : ''} realizado${changesCount > 1 ? 's' : ''}`;
    }
}

// Animación slideUp
const slideUpStyle = document.createElement('style');
slideUpStyle.textContent = `
    @keyframes slideUp {
        from {
            transform: translate(-50%, 100px);
            opacity: 0;
        }
        to {
            transform: translate(-50%, 0);
            opacity: 1;
        }
    }
`;
document.head.appendChild(slideUpStyle);