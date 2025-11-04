<?php
$sessiontype = 'anfitrion';
include_once("../static/layouts/header.php");
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
        --info-color: #3498db;
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
    .add-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Header inspirador */
    .page-header {
        background: var(--primary-gradient);
        border-radius: var(--radius-lg);
        padding: 60px 40px;
        color: white;
        margin-bottom: 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
        top: -250px;
        right: -250px;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .header-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .header-icon {
        font-size: 80px;
        margin-bottom: 20px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .header-content h1 {
        font-size: 42px;
        margin: 0 0 15px 0;
        font-weight: bold;
    }

    .header-content p {
        font-size: 18px;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Progress Steps */
    .progress-steps {
        background: white;
        padding: 30px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        margin-bottom: 40px;
    }

    .steps-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .steps-container::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 50px;
        right: 50px;
        height: 3px;
        background: var(--gray-200);
        z-index: 0;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: white;
        border: 3px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--gray-500);
        transition: var(--transition);
        margin-bottom: 10px;
    }

    .step.active .step-circle {
        background: var(--primary-gradient);
        border-color: var(--primary-color);
        color: white;
        transform: scale(1.1);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .step.completed .step-circle {
        background: var(--success-color);
        border-color: var(--success-color);
        color: white;
    }

    .step-label {
        font-size: 13px;
        color: var(--gray-500);
        font-weight: 600;
        text-align: center;
    }

    .step.active .step-label {
        color: var(--primary-color);
    }

    /* Layout del formulario */
    .form-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 30px;
        margin-bottom: 40px;
    }

    /* Tarjetas */
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
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 20px;
        border-bottom: 3px solid var(--gray-100);
    }

    .card-title .material-icons {
        color: var(--primary-color);
        font-size: 32px;
    }

    /* Grupos de formulario */
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
        font-size: 16px;
    }

    .form-hint {
        font-size: 13px;
        color: var(--gray-500);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-hint .material-icons {
        font-size: 16px;
    }

    /* Inputs modernos */
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
        transform: translateY(-2px);
    }

    .form-control-modern:hover {
        border-color: var(--primary-color);
    }

    textarea.form-control-modern {
        resize: vertical;
        min-height: 180px;
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
    }

    /* Grid de 2 columnas */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
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

    /* Preview de foto */
    .photo-upload-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        padding: 30px;
        border-radius: 15px;
        border: 2px dashed var(--primary-color);
        text-align: center;
        margin-top: 15px;
    }

    .photo-preview-box {
        width: 100%;
        height: 300px;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .photo-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        color: var(--gray-500);
    }

    .photo-placeholder .material-icons {
        font-size: 80px;
        color: var(--primary-color);
        opacity: 0.3;
    }

    .photo-instructions {
        font-size: 14px;
        color: var(--gray-700);
        line-height: 1.6;
    }

    /* Sidebar de ayuda */
    .help-sidebar {
        position: sticky;
        top: 100px;
    }

    .tip-card {
        background: white;
        padding: 25px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        margin-bottom: 20px;
    }

    .tip-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .tip-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .tip-title {
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }

    .tip-content {
        font-size: 14px;
        color: var(--gray-700);
        line-height: 1.6;
    }

    .tip-content ul {
        margin: 10px 0;
        padding-left: 20px;
    }

    .tip-content li {
        margin: 8px 0;
    }

    .quick-tips {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid var(--primary-color);
    }

    .quick-tips-title {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Botones de acción */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 3px solid var(--gray-100);
    }

    .btn-submit {
        flex: 1;
        padding: 18px 35px;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.5);
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .btn-cancel {
        flex: 1;
        padding: 18px 35px;
        background: transparent;
        color: var(--gray-700);
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-size: 17px;
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

    /* Success message */
    .success-banner {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
        padding: 20px 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        display: none;
        align-items: center;
        gap: 15px;
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .form-layout {
            grid-template-columns: 1fr;
        }

        .help-sidebar {
            position: relative;
            top: 0;
        }

        .steps-container {
            flex-direction: column;
            gap: 20px;
        }

        .steps-container::before {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .header-content h1 {
            font-size: 32px;
        }

        .header-icon {
            font-size: 60px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .card {
            padding: 25px 20px;
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

    /* Input focus effects */
    .form-control-modern:focus + .form-hint {
        color: var(--primary-color);
    }
</style>

<div class="add-container">
    <!-- Header Inspirador -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">🏡</div>
            <h1>Agrega tu Propiedad</h1>
            <p>Comparte tu espacio con miles de viajeros y comienza a generar ingresos. Es fácil, rápido y seguro.</p>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="steps-container">
            <div class="step active" id="step1">
                <div class="step-circle">
                    <span class="material-icons">location_on</span>
                </div>
                <span class="step-label">Ubicación</span>
            </div>
            <div class="step" id="step2">
                <div class="step-circle">
                    <span class="material-icons">home</span>
                </div>
                <span class="step-label">Detalles</span>
            </div>
            <div class="step" id="step3">
                <div class="step-circle">
                    <span class="material-icons">photo_camera</span>
                </div>
                <span class="step-label">Fotos</span>
            </div>
            <div class="step" id="step4">
                <div class="step-circle">
                    <span class="material-icons">check_circle</span>
                </div>
                <span class="step-label">Finalizar</span>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <form onsubmit="return addApartmentValidation()" method="POST" action="create_apartment.php">
        <div class="form-layout">
            <!-- Columna Principal -->
            <div>
                <!-- Ubicación -->
                <div class="card">
                    <h2 class="card-title">
                        <span class="material-icons">place</span>
                        Ubicación de tu Propiedad
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">location_city</span>
                                Ciudad <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-modern" 
                                   id="townadd" 
                                   name="townadd" 
                                   placeholder="Ej: Medellín"
                                   required>
                            <p class="form-hint">
                                <span class="material-icons">info</span>
                                La ciudad donde se encuentra tu propiedad
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">public</span>
                                País <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-modern" 
                                   id="countryadd" 
                                   name="countryadd" 
                                   placeholder="Ej: Colombia"
                                   required>
                            <p class="form-hint">
                                <span class="material-icons">info</span>
                                País de ubicación
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">home</span>
                            Dirección Completa <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="addressadd" 
                               name="addressadd" 
                               placeholder="Ej: Calle 10 # 45-32, El Poblado"
                               required>
                        <p class="form-hint">
                            <span class="material-icons">info</span>
                            Dirección exacta para que los huéspedes puedan encontrarte
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">map</span>
                            URL de Google Maps <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="gpsadd" 
                               name="gpsadd" 
                               placeholder="https://goo.gl/maps/..."
                               required>
                        <p class="form-hint">
                            <span class="material-icons">info</span>
                            Copia el enlace desde Google Maps (Compartir → Copiar enlace)
                        </p>
                    </div>
                </div>

                <!-- Detalles del Apartamento -->
                <div class="card" style="margin-top: 30px;">
                    <h2 class="card-title">
                        <span class="material-icons">king_bed</span>
                        Detalles de tu Apartamento
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">bed</span>
                                Número de Habitaciones <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control-modern" 
                                   id="numberadd" 
                                   name="numberadd" 
                                   min="1"
                                   max="20"
                                   placeholder="Ej: 3"
                                   required>
                            <p class="form-hint">
                                <span class="material-icons">info</span>
                                Cuántas habitaciones tiene disponibles
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">payments</span>
                                Valor por Noche <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control-modern" 
                                   id="valueadd" 
                                   name="valueadd" 
                                   step="0.01"
                                   min="0"
                                   placeholder="150000.00"
                                   required>
                            <p class="form-hint">
                                <span class="material-icons">info</span>
                                Precio por noche en tu moneda local
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">description</span>
                            Descripción Detallada <span class="required">*</span>
                        </label>
                        <div class="input-with-counter">
                            <textarea class="form-control-modern" 
                                      id="roomreviewadd" 
                                      name="roomreviewadd" 
                                      placeholder="Describe tu apartamento: características, comodidades, servicios incluidos, atractivos cercanos, reglas de la casa..."
                                      maxlength="1000"
                                      oninput="updateCharCount()"
                                      required></textarea>
                            <span class="char-counter" id="charCount">0 / 1000</span>
                        </div>
                        <p class="form-hint">
                            <span class="material-icons">info</span>
                            Una buena descripción aumenta tus posibilidades de reserva
                        </p>
                    </div>
                </div>

                <!-- Foto Principal -->
                <div class="card" style="margin-top: 30px;">
                    <h2 class="card-title">
                        <span class="material-icons">add_photo_alternate</span>
                        Foto Principal de tu Propiedad
                    </h2>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">link</span>
                            URL de la Imagen <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="photoadd" 
                               name="photoadd" 
                               placeholder="https://ejemplo.com/mi-apartamento.jpg"
                               oninput="updatePhotoPreview()"
                               required>
                        <p class="form-hint">
                            <span class="material-icons">info</span>
                            Pega la URL de una imagen alojada en línea
                        </p>
                    </div>

                    <div class="photo-upload-section">
                        <div class="photo-preview-box" id="photoPreview">
                            <div class="photo-placeholder">
                                <span class="material-icons">add_photo_alternate</span>
                                <div class="photo-instructions">
                                    <strong>Vista previa de tu imagen</strong><br>
                                    Pega una URL arriba para ver cómo se verá
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="action-buttons">
                    <button type="submit" class="btn-submit">
                        <span class="material-icons">save</span>
                        Publicar Apartamento
                    </button>
                    <a href="list_apartments.php" class="btn-cancel">
                        <span class="material-icons">close</span>
                        Cancelar
                    </a>
                </div>
            </div>

            <!-- Sidebar de Ayuda -->
            <div class="help-sidebar">
                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <span class="material-icons">lightbulb</span>
                        </div>
                        <h3 class="tip-title">Consejos para Éxito</h3>
                    </div>
                    <div class="tip-content">
                        <div class="quick-tips">
                            <div class="quick-tips-title">
                                <span class="material-icons">star</span>
                                Tips Rápidos
                            </div>
                            <ul>
                                <li>✓ Usa fotos de alta calidad y bien iluminadas</li>
                                <li>✓ Sé honesto en tu descripción</li>
                                <li>✓ Destaca servicios únicos</li>
                                <li>✓ Menciona atracciones cercanas</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <span class="material-icons">photo_camera</span>
                        </div>
                        <h3 class="tip-title">Foto Perfecta</h3>
                    </div>
                    <div class="tip-content">
                        <ul>
                            <li>📸 Luz natural es la mejor</li>
                            <li>🧹 Espacio limpio y ordenado</li>
                            <li>📐 Toma fotos desde las esquinas</li>
                            <li>🎨 Muestra el mejor ángulo</li>
                        </ul>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <span class="material-icons">monetization_on</span>
                        </div>
                        <h3 class="tip-title">Precio Competitivo</h3>
                    </div>
                    <div class="tip-content">
                        Investiga precios de propiedades similares en tu zona. Un precio justo aumenta tus reservas.
                    </div>
                </div>

                <div class="tip-card" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1)); border: 2px solid var(--primary-color);">
                    <div class="tip-content" style="text-align: center;">
                        <div style="font-size: 40px; margin-bottom: 10px;">🎉</div>
                        <strong style="color: var(--primary-color);">¡Casi listo!</strong>
                        <p style="margin: 10px 0 0 0; font-size: 13px;">
                            En pocos minutos tu propiedad estará disponible para miles de viajeros
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Contador de caracteres
function updateCharCount() {
    const textarea = document.getElementById('roomreviewadd');
    const counter = document.getElementById('charCount');
    const length = textarea.value.length;
    counter.textContent = `${length} / 1000`;
    
    if (length > 900) {
        counter.style.color = '#ff4757';
        counter.style.fontWeight = 'bold';
    } else if (length > 700) {
        counter.style.color = '#ffa502';
    } else {
        counter.style.color = '#adb5bd';
        counter.style.fontWeight = '600';
    }
}

// Preview de foto
function updatePhotoPreview() {
    const photoUrl = document.getElementById('photoadd').value;
    const preview = document.getElementById('photoPreview');
    
    if (photoUrl.trim() !== '') {
        preview.innerHTML = `<img src="${photoUrl}" alt="Preview" onerror="showPlaceholder()">`;
    } else {
        showPlaceholder();
    }
}

function showPlaceholder() {
    const preview = document.getElementById('photoPreview');
    preview.innerHTML = `
        <div class="photo-placeholder">
            <span class="material-icons">add_photo_alternate</span>
            <div class="photo-instructions">
                <strong>Vista previa de tu imagen</strong><br>
                Pega una URL arriba para ver cómo se verá
            </div>
        </div>
    `;
}

// Validación mejorada del formulario
function addApartmentValidation() {
    const town = document.getElementById('townadd').value.trim();
    const country = document.getElementById('countryadd').value.trim();
    const address = document.getElementById('addressadd').value.trim();
    const gps = document.getElementById('gpsadd').value.trim();
    const rooms = document.getElementById('numberadd').value;
    const value = document.getElementById('valueadd').value;
    const review = document.getElementById('roomreviewadd').value.trim();
    const photo = document.getElementById('photoadd').value.trim();

    // Validar campos vacíos
    if (!town || !country || !address || !gps || !rooms || !value || !review || !photo) {
        showNotification('⚠️ Por favor completa todos los campos obligatorios', 'warning');
        highlightEmptyFields();
        return false;
    }

    // Validar número de habitaciones
    if (rooms < 1 || rooms > 20) {
        showNotification('⚠️ El número de habitaciones debe estar entre 1 y 20', 'warning');
        document.getElementById('numberadd').focus();
        return false;
    }

    // Validar precio
    if (value <= 0) {
        showNotification('⚠️ El valor por noche debe ser mayor a 0', 'warning');
        document.getElementById('valueadd').focus();
        return false;
    }

    // Validar longitud de descripción
    if (review.length < 50) {
        showNotification('⚠️ La descripción debe tener al menos 50 caracteres para ser efectiva', 'warning');
        document.getElementById('roomreviewadd').focus();
        return false;
    }

    // Validar formato de URL
    if (!isValidUrl(photo)) {
        showNotification('⚠️ Por favor ingresa una URL válida para la foto', 'warning');
        document.getElementById('photoadd').focus();
        return false;
    }

    // Todo correcto
    showNotification('✓ ¡Validación exitosa! Publicando tu apartamento...', 'success');
    return true;
}

// Validar URL
function isValidUrl(string) {
    try {
        const url = new URL(string);
        return url.protocol === "http:" || url.protocol === "https:";
    } catch (_) {
        return false;
    }
}

// Resaltar campos vacíos
function highlightEmptyFields() {
    const fields = ['townadd', 'countryadd', 'addressadd', 'gpsadd', 'numberadd', 'valueadd', 'roomreviewadd', 'photoadd'];
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
    // Crear elemento de notificación
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
    
    // Remover después de 4 segundos
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.4s ease';
        setTimeout(() => notification.remove(), 400);
    }, 4000);
}

// Animación shake
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

// Progress steps interactivo
let currentStep = 1;

function updateSteps() {
    // Determinar paso actual basado en scroll o campos completados
    const townFilled = document.getElementById('townadd').value.trim() !== '';
    const countryFilled = document.getElementById('countryadd').value.trim() !== '';
    const addressFilled = document.getElementById('addressadd').value.trim() !== '';
    const roomsFilled = document.getElementById('numberadd').value !== '';
    const valueFilled = document.getElementById('valueadd').value !== '';
    const photoFilled = document.getElementById('photoadd').value.trim() !== '';
    
    if (photoFilled) {
        currentStep = 4;
    } else if (roomsFilled && valueFilled) {
        currentStep = 3;
    } else if (townFilled && countryFilled && addressFilled) {
        currentStep = 2;
    } else {
        currentStep = 1;
    }
    
    // Actualizar UI de steps
    for (let i = 1; i <= 4; i++) {
        const step = document.getElementById(`step${i}`);
        if (i < currentStep) {
            step.classList.remove('active');
            step.classList.add('completed');
        } else if (i === currentStep) {
            step.classList.add('active');
            step.classList.remove('completed');
        } else {
            step.classList.remove('active', 'completed');
        }
    }
}

// Monitorear cambios en inputs
document.addEventListener('DOMContentLoaded', function() {
    // Actualizar steps cuando cambien los campos
    const inputs = document.querySelectorAll('.form-control-modern');
    inputs.forEach(input => {
        input.addEventListener('input', updateSteps);
        input.addEventListener('blur', updateSteps);
    });
    
    // Inicializar contador
    updateCharCount();
    
    // Animación de entrada de cards
    const cards = document.querySelectorAll('.card, .tip-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Auto-save en localStorage (opcional)
    const autoSave = () => {
        const formData = {
            town: document.getElementById('townadd').value,
            country: document.getElementById('countryadd').value,
            address: document.getElementById('addressadd').value,
            gps: document.getElementById('gpsadd').value,
            rooms: document.getElementById('numberadd').value,
            value: document.getElementById('valueadd').value,
            review: document.getElementById('roomreviewadd').value,
            photo: document.getElementById('photoadd').value
        };
        localStorage.setItem('apartmentDraft', JSON.stringify(formData));
    };
    
    // Guardar cada 3 segundos
    let saveTimeout;
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(autoSave, 3000);
        });
    });
    
    // Cargar datos guardados si existen
    const savedData = localStorage.getItem('apartmentDraft');
    if (savedData) {
        const data = JSON.parse(savedData);
        if (confirm('¿Deseas recuperar los datos guardados anteriormente?')) {
            document.getElementById('townadd').value = data.town || '';
            document.getElementById('countryadd').value = data.country || '';
            document.getElementById('addressadd').value = data.address || '';
            document.getElementById('gpsadd').value = data.gps || '';
            document.getElementById('numberadd').value = data.rooms || '';
            document.getElementById('valueadd').value = data.value || '';
            document.getElementById('roomreviewadd').value = data.review || '';
            document.getElementById('photoadd').value = data.photo || '';
            updateCharCount();
            updatePhotoPreview();
            updateSteps();
        }
    }
});

// Limpiar localStorage al enviar
document.querySelector('form').addEventListener('submit', function() {
    localStorage.removeItem('apartmentDraft');
});

// Confirmación antes de salir si hay datos
window.addEventListener('beforeunload', function(e) {
    const hasData = document.getElementById('townadd').value.trim() !== '' ||
                   document.getElementById('countryadd').value.trim() !== '' ||
                   document.getElementById('addressadd').value.trim() !== '';
    
    if (hasData) {
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
        if (confirm('¿Deseas cancelar y volver a la lista de apartamentos?')) {
            window.location.href = 'list_apartments.php';
        }
    }
});

// Tooltip en tiempo real
const inputs = document.querySelectorAll('.form-control-modern');
inputs.forEach(input => {
    input.addEventListener('focus', function() {
        this.style.transform = 'translateY(-2px)';
    });
    
    input.addEventListener('blur', function() {
        this.style.transform = 'translateY(0)';
    });
});