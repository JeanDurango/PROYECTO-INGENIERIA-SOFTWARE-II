<?php
$sessiontype = 'anfitrion';
include_once("../static/layouts/header.php");

include_once '../database/models/ApartmentModel.php';
$apartmentModel = new ApartmentModel();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$apartment = $apartmentModel->getApartment($id);

// Validar que el apartamento existe
if (!$apartment) {
    echo "<script>alert('Apartamento no encontrado'); window.location.href='list_apartments.php';</script>";
    exit;
}

// Valores seguros
$aptTown = isset($apartment['town']) ? htmlspecialchars($apartment['town']) : '';
$aptCountry = isset($apartment['country']) ? htmlspecialchars($apartment['country']) : '';
$aptAddress = isset($apartment['address']) ? htmlspecialchars($apartment['address']) : '';
$aptGps = isset($apartment['gps']) ? htmlspecialchars($apartment['gps']) : '';
$aptRooms = isset($apartment['rooms']) ? intval($apartment['rooms']) : 1;
$aptValue = isset($apartment['value']) ? floatval($apartment['value']) : 0;
$aptReview = isset($apartment['roomreview']) ? htmlspecialchars($apartment['roomreview']) : '';
$aptPhoto = isset($apartment['photo']) ? htmlspecialchars($apartment['photo']) : '';
?>

<style>
    /* Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea, #764ba2);
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #2ecc71;
        --danger-color: #ff4757;
        --gray-100: #f8f9fa;
        --gray-200: #e9ecef;
        --gray-500: #adb5bd;
        --gray-700: #495057;
        --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
        --radius-lg: 20px;
        --transition: all 0.3s ease;
    }

    /* Contenedor principal */
    .edit-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Header */
    .page-header {
        background: var(--primary-gradient);
        border-radius: var(--radius-lg);
        padding: 40px;
        color: white;
        margin-bottom: 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-title h1 {
        font-size: 32px;
        margin: 0;
        font-weight: bold;
    }

    .header-title .material-icons {
        font-size: 40px;
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
        grid-template-columns: 1fr 400px;
        gap: 30px;
        margin-bottom: 40px;
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
        font-size: 14px;
    }

    .form-label .material-icons {
        font-size: 20px;
        color: var(--primary-color);
    }

    .required {
        color: var(--danger-color);
    }

    /* Inputs modernos */
    .form-control-modern {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-size: 15px;
        transition: var(--transition);
        background: var(--gray-100);
        font-family: 'Poppins', sans-serif;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary-color);
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-control-modern:hover {
        border-color: var(--primary-color);
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

    /* Preview de foto */
    .photo-preview-container {
        margin-top: 15px;
        padding: 20px;
        background: var(--gray-100);
        border-radius: 12px;
        text-align: center;
    }

    .photo-preview-box {
        width: 100%;
        height: 250px;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        border: 2px dashed var(--gray-500);
    }

    .photo-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview-box .material-icons {
        font-size: 80px;
        color: var(--gray-500);
    }

    .photo-preview-text {
        font-size: 13px;
        color: var(--gray-500);
    }

    /* Sidebar de ayuda */
    .help-card {
        position: sticky;
        top: 100px;
    }

    .info-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
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

    .info-box-content ul {
        margin: 10px 0;
        padding-left: 20px;
    }

    .info-box-content li {
        margin: 5px 0;
    }

    /* Botones de acción */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid var(--gray-100);
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

    /* Input con contador */
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
        padding: 4px 8px;
        border-radius: 6px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .form-layout {
            grid-template-columns: 1fr;
        }

        .help-card {
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

    /* Toast notification */
    .toast-notification {
        position: fixed;
        top: 100px;
        right: 30px;
        background: white;
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        display: none;
        align-items: center;
        gap: 15px;
        z-index: 1000;
        animation: slideInRight 0.4s ease;
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
</style>

<div class="edit-container">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-title">
                <span class="material-icons">edit_location</span>
                <h1>Editar Apartamento</h1>
            </div>
            <a href="list_apartments.php" class="btn-back">
                <span class="material-icons">arrow_back</span>
                Volver a mis apartamentos
            </a>
        </div>
    </div>

    <!-- Formulario -->
    <form onsubmit="return editApartmentValidation()" method="POST" action="update_apartment.php?id=<?php echo $id; ?>">
        <div class="form-layout">
            <!-- Columna principal -->
            <div>
                <!-- Información básica -->
                <div class="card">
                    <h2 class="card-title">
                        <span class="material-icons">info</span>
                        Información Básica
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">location_city</span>
                                Ciudad <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-modern" 
                                   id="townedit" 
                                   name="townedit" 
                                   value="<?php echo $aptTown; ?>"
                                   placeholder="Ej: Medellín"
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">public</span>
                                País <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-modern" 
                                   id="countryedit" 
                                   name="countryedit" 
                                   value="<?php echo $aptCountry; ?>"
                                   placeholder="Ej: Colombia"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">place</span>
                            Dirección <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="addressedit" 
                               name="addressedit" 
                               value="<?php echo $aptAddress; ?>"
                               placeholder="Ej: Calle 10 # 45-32, El Poblado"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">map</span>
                            Ubicación Google Maps <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="gpsedit" 
                               name="gpsedit" 
                               value="<?php echo $aptGps; ?>"
                               placeholder="URL de Google Maps"
                               required>
                        <small style="color: #999; font-size: 12px; margin-top: 5px; display: block;">
                            💡 Copia el enlace desde Google Maps para compartir
                        </small>
                    </div>
                </div>

                <!-- Detalles del apartamento -->
                <div class="card" style="margin-top: 30px;">
                    <h2 class="card-title">
                        <span class="material-icons">home</span>
                        Detalles del Apartamento
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">bed</span>
                                Número de habitaciones <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control-modern" 
                                   id="numberedit" 
                                   name="numberedit" 
                                   value="<?php echo $aptRooms; ?>"
                                   min="1"
                                   max="20"
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <span class="material-icons">payments</span>
                                Valor por noche <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control-modern" 
                                   id="valueedit" 
                                   name="valueedit" 
                                   value="<?php echo $aptValue; ?>"
                                   step="0.01"
                                   min="0"
                                   placeholder="0.00"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">description</span>
                            Descripción del apartamento <span class="required">*</span>
                        </label>
                        <div class="input-with-counter">
                            <textarea class="form-control-modern" 
                                      id="roomreviewedit" 
                                      name="roomreviewedit" 
                                      placeholder="Describe las características, comodidades y atractivos de tu apartamento..."
                                      maxlength="1000"
                                      oninput="updateCharCount()"
                                      required><?php echo $aptReview; ?></textarea>
                            <span class="char-counter" id="charCount">0 / 1000</span>
                        </div>
                    </div>
                </div>

                <!-- Foto -->
                <div class="card" style="margin-top: 30px;">
                    <h2 class="card-title">
                        <span class="material-icons">photo_camera</span>
                        Foto Principal
                    </h2>

                    <div class="form-group">
                        <label class="form-label">
                            <span class="material-icons">link</span>
                            URL de la foto <span class="required">*</span>
                        </label>
                        <input type="text" 
                               class="form-control-modern" 
                               id="photoedit" 
                               name="photoedit" 
                               value="<?php echo $aptPhoto; ?>"
                               placeholder="https://ejemplo.com/foto.jpg"
                               oninput="updatePhotoPreview()"
                               required>
                    </div>

                    <div class="photo-preview-container">
                        <div class="photo-preview-box" id="photoPreview">
                            <?php if($aptPhoto): ?>
                                <img src="<?php echo $aptPhoto; ?>" alt="Preview" onerror="showPlaceholder()">
                            <?php else: ?>
                                <span class="material-icons">add_photo_alternate</span>
                            <?php endif; ?>
                        </div>
                        <p class="photo-preview-text">Vista previa de la imagen</p>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="card" style="margin-top: 30px;">
                    <div class="action-buttons">
                        <button type="submit" class="btn-submit">
                            <span class="material-icons">save</span>
                            Guardar Cambios
                        </button>
                        <a href="list_apartments.php" class="btn-cancel">
                            <span class="material-icons">close</span>
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar de ayuda -->
            <div>
                <div class="card help-card">
                    <h2 class="card-title">
                        <span class="material-icons">help_outline</span>
                        Consejos
                    </h2>

                    <div class="info-box">
                        <div class="info-box-title">
                            <span class="material-icons">lightbulb</span>
                            Descripción efectiva
                        </div>
                        <div class="info-box-content">
                            <ul>
                                <li>Sé específico sobre las comodidades</li>
                                <li>Menciona la ubicación exacta</li>
                                <li>Destaca características únicas</li>
                                <li>Incluye servicios incluidos</li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="info-box-title">
                            <span class="material-icons">photo</span>
                            Foto de calidad
                        </div>
                        <div class="info-box-content">
                            <ul>
                                <li>Usa imágenes de alta resolución</li>
                                <li>Muestra la mejor vista del lugar</li>
                                <li>Asegura buena iluminación</li>
                                <li>Mantén el espacio ordenado</li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="info-box-title">
                            <span class="material-icons">trending_up</span>
                            Precio competitivo
                        </div>
                        <div class="info-box-content">
                            Investiga precios similares en tu zona para establecer una tarifa competitiva y atractiva.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Contador de caracteres
function updateCharCount() {
    const textarea = document.getElementById('roomreviewedit');
    const counter = document.getElementById('charCount');
    const length = textarea.value.length;
    counter.textContent = `${length} / 1000`;
    
    if (length > 900) {
        counter.style.color = '#ff4757';
    } else {
        counter.style.color = '#adb5bd';
    }
}

// Preview de foto
function updatePhotoPreview() {
    const photoUrl = document.getElementById('photoedit').value;
    const preview = document.getElementById('photoPreview');
    
    if (photoUrl.trim() !== '') {
        preview.innerHTML = `<img src="${photoUrl}" alt="Preview" onerror="showPlaceholder()">`;
    } else {
        showPlaceholder();
    }
}

function showPlaceholder() {
    const preview = document.getElementById('photoPreview');
    preview.innerHTML = '<span class="material-icons">add_photo_alternate</span>';
}

// Inicializar contador al cargar
document.addEventListener('DOMContentLoaded', function() {
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
});

// Validación mejorada
function editApartmentValidation() {
    const town = document.getElementById('townedit').value.trim();
    const country = document.getElementById('countryedit').value.trim();
    const address = document.getElementById('addressedit').value.trim();
    const gps = document.getElementById('gpsedit').value.trim();
    const rooms = document.getElementById('numberedit').value;
    const value = document.getElementById('valueedit').value;
    const review = document.getElementById('roomreviewedit').value.trim();
    const photo = document.getElementById('photoedit').value.trim();

    if (!town || !country || !address || !gps || !rooms || !value || !review || !photo) {
        alert('⚠️ Todos los campos son obligatorios. Por favor completa el formulario.');
        return false;
    }

    if (rooms < 1 || rooms > 20) {
        alert('⚠️ El número de habitaciones debe estar entre 1 y 20.');
        return false;
    }

    if (value <= 0) {
        alert('⚠️ El valor por noche debe ser mayor a 0.');
        return false;
    }

    if (review.length < 50) {
        alert('⚠️ La descripción debe tener al menos 50 caracteres para ser efectiva.');
        return false;
    }

    return true;
}

// Auto-guardar (opcional)
let autoSaveTimeout;
document.querySelectorAll('.form-control-modern').forEach(input => {
    input.addEventListener('input', function() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            // Aquí puedes implementar auto-guardado si lo deseas
            console.log('Cambios detectados');
        }, 2000);
    });
});
</script>

<?php include_once("../static/layouts/footer.php") ?>