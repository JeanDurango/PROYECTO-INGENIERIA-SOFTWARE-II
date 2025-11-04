<?php 
$sessiontype = 'anfitrion';
include_once("../static/layouts/header.php");

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
include_once '../database/models/ApartmentModel.php';    
$apartmentModel = new ApartmentModel();            
$apartments = $apartmentModel->getApartments($email);
$totalApartments = mysqli_num_rows($apartments);
mysqli_data_seek($apartments, 0); // Reset pointer
?>

<style>
    /* Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea, #764ba2);
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #2ecc71;
        --warning-color: #ffa502;
        --danger-color: #ff4757;
        --gray-50: #f8f9fa;
        --gray-100: #f0f0f0;
        --gray-200: #e9ecef;
        --gray-500: #adb5bd;
        --gray-700: #495057;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
        --radius-md: 12px;
        --radius-lg: 20px;
        --transition: all 0.3s ease;
    }

    /* Contenedor principal */
    .apartments-container {
        max-width: 1400px;
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
        font-size: 18px;
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .header-stats {
        display: flex;
        gap: 30px;
    }

    .stat-box {
        text-align: center;
    }

    .stat-value {
        font-size: 32px;
        font-weight: bold;
        display: block;
        line-height: 1;
    }

    .stat-label {
        font-size: 14px;
        opacity: 0.8;
        margin-top: 5px;
    }

    /* Toolbar */
    .toolbar {
        background: white;
        padding: 25px 30px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .toolbar-left {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        width: 350px;
    }

    .search-box input {
        width: 100%;
        padding: 12px 45px 12px 20px;
        border: 2px solid var(--gray-200);
        border-radius: 25px;
        font-size: 14px;
        transition: var(--transition);
        background: var(--gray-50);
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary-color);
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .search-box .material-icons {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-500);
        cursor: pointer;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
    }

    .filter-btn {
        padding: 10px 20px;
        border: 2px solid var(--gray-200);
        background: white;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-700);
    }

    .filter-btn:hover, .filter-btn.active {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: white;
    }

    .btn-add {
        padding: 12px 30px;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Grid de apartamentos */
    .apartments-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    /* Tarjeta de apartamento */
    .apartment-card {
        background: white;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
        position: relative;
    }

    .apartment-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .apartment-image-container {
        position: relative;
        height: 240px;
        overflow: hidden;
    }

    .apartment-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .apartment-card:hover .apartment-image {
        transform: scale(1.1);
    }

    .status-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        background: var(--success-color);
        color: white;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    .city-tag {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Contenido de la tarjeta */
    .apartment-content {
        padding: 25px;
    }

    .apartment-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .apartment-features {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 5px;
        color: var(--gray-700);
        font-size: 14px;
    }

    .feature-item .material-icons {
        font-size: 18px;
        color: var(--primary-color);
    }

    .apartment-description {
        color: var(--gray-700);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .apartment-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 2px solid var(--gray-100);
    }

    .price-section {
        display: flex;
        flex-direction: column;
    }

    .price-amount {
        font-size: 26px;
        font-weight: bold;
        color: var(--primary-color);
        line-height: 1;
    }

    .price-label {
        font-size: 12px;
        color: var(--gray-500);
        margin-top: 3px;
    }

    .apartment-actions {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .btn-edit {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-edit:hover {
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-delete {
        background: var(--danger-color);
        color: white;
    }

    .btn-delete:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(255, 71, 87, 0.4);
    }

    /* Modal moderno */
    .modal-modern {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content-modern {
        background: white;
        margin: 10% auto;
        padding: 0;
        border-radius: var(--radius-lg);
        max-width: 500px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.4s ease;
        overflow: hidden;
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header-modern {
        background: var(--danger-color);
        color: white;
        padding: 25px 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .modal-header-modern .material-icons {
        font-size: 32px;
    }

    .modal-header-modern h3 {
        margin: 0;
        font-size: 22px;
    }

    .modal-body-modern {
        padding: 30px;
    }

    .modal-body-modern p {
        color: var(--gray-700);
        line-height: 1.6;
        margin-bottom: 15px;
        font-size: 15px;
    }

    .modal-footer-modern {
        padding: 20px 30px;
        background: var(--gray-50);
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .btn-modal {
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        font-size: 14px;
    }

    .btn-modal-cancel {
        background: white;
        color: var(--gray-700);
        border: 2px solid var(--gray-200);
    }

    .btn-modal-cancel:hover {
        background: var(--gray-100);
    }

    .btn-modal-confirm {
        background: var(--danger-color);
        color: white;
    }

    .btn-modal-confirm:hover {
        background: #e63946;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 71, 87, 0.4);
    }

    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
    }

    .empty-state-icon {
        font-size: 100px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 28px;
        color: var(--gray-700);
        margin-bottom: 15px;
    }

    .empty-state p {
        font-size: 16px;
        color: var(--gray-500);
        margin-bottom: 30px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .apartments-grid {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .header-stats {
            width: 100%;
            justify-content: space-around;
        }

        .toolbar {
            flex-direction: column;
        }

        .search-box {
            width: 100%;
        }

        .toolbar-left {
            width: 100%;
            flex-direction: column;
        }

        .filter-buttons {
            width: 100%;
            justify-content: center;
        }

        .apartments-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Animaciones */
    .apartment-card {
        animation: fadeInUp 0.6s ease;
    }

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
</style>

<div class="apartments-container">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1>
                    <span class="material-icons">apartment</span>
                    Mis Apartamentos
                </h1>
                <p class="subtitle">
                    <span class="material-icons">person</span>
                    Gestionando propiedades de <?php echo htmlspecialchars($_SESSION['email']); ?>
                </p>
            </div>
            <div class="header-stats">
                <div class="stat-box">
                    <span class="stat-value"><?php echo $totalApartments; ?></span>
                    <span class="stat-label">Propiedades</span>
                </div>
                <div class="stat-box">
                    <span class="stat-value">★ 4.8</span>
                    <span class="stat-label">Calificación</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar-left">
            <div class="search-box">
                <input type="text" 
                       id="searchInput" 
                       placeholder="Buscar por ciudad, país o dirección..."
                       oninput="searchApartments()">
                <span class="material-icons">search</span>
            </div>
            
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterAll()">
                    <span class="material-icons">select_all</span>
                    Todos
                </button>
                <button class="filter-btn" onclick="filterByRooms(1, 2)">
                    <span class="material-icons">bed</span>
                    1-2 Hab.
                </button>
                <button class="filter-btn" onclick="filterByRooms(3, 10)">
                    <span class="material-icons">king_bed</span>
                    3+ Hab.
                </button>
            </div>
        </div>

        <div>
            <a href="addapartment.php" class="btn-add">
                <span class="material-icons">add_circle</span>
                Agregar Apartamento
            </a>
        </div>
    </div>

    <!-- Grid de apartamentos -->
    <div class="apartments-grid" id="apartmentsGrid">
        <?php
        if ($totalApartments > 0) {
            while ($row = mysqli_fetch_assoc($apartments)) {
                // Validar datos
                $id = isset($row['id']) ? intval($row['id']) : 0;
                $town = isset($row['town']) ? htmlspecialchars($row['town']) : 'Sin ubicación';
                $country = isset($row['country']) ? htmlspecialchars($row['country']) : '';
                $address = isset($row['address']) ? htmlspecialchars($row['address']) : '';
                $rooms = isset($row['rooms']) ? intval($row['rooms']) : 0;
                $value = isset($row['value']) ? floatval($row['value']) : 0;
                $review = isset($row['roomreview']) ? htmlspecialchars($row['roomreview']) : '';
                $photo = isset($row['photo']) ? htmlspecialchars($row['photo']) : '';
                
                echo "
                <div class='apartment-card' data-town='$town' data-rooms='$rooms'>
                    <div class='apartment-image-container'>
                        <img src='$photo' alt='$town' class='apartment-image' onerror=\"this.src='https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800'\">
                        <span class='status-badge'>
                            <span class='material-icons' style='font-size: 14px;'>check_circle</span>
                            Activo
                        </span>
                        <span class='city-tag'>
                            <span class='material-icons' style='font-size: 16px;'>location_on</span>
                            $town
                        </span>
                    </div>
                    
                    <div class='apartment-content'>
                        <h3 class='apartment-title'>Apartamento en $town, $country</h3>
                        
                        <div class='apartment-features'>
                            <div class='feature-item'>
                                <span class='material-icons'>bed</span>
                                <span>$rooms Habitaciones</span>
                            </div>
                            <div class='feature-item'>
                                <span class='material-icons'>place</span>
                                <span>$address</span>
                            </div>
                        </div>
                        
                        <p class='apartment-description'>$review</p>
                        
                        <div class='apartment-footer'>
                            <div class='price-section'>
                                <span class='price-amount'>$" . number_format($value, 2) . "</span>
                                <span class='price-label'>por noche</span>
                            </div>
                            
                            <div class='apartment-actions'>
                                <button class='btn-action btn-edit' onclick=\"window.location.href='edit_apartment.php?id=$id'\" title='Editar'>
                                    <span class='material-icons'>edit</span>
                                </button>
                                <button class='btn-action btn-delete' onclick='openDeleteModal($id, \"$town\")' title='Eliminar'>
                                    <span class='material-icons'>delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "
            <div class='empty-state' style='grid-column: 1 / -1;'>
                <div class='empty-state-icon'>🏘️</div>
                <h3>No tienes apartamentos registrados</h3>
                <p>Comienza agregando tu primera propiedad y empieza a recibir huéspedes</p>
                <a href='addapartment.php' class='btn-add' style='margin: 0 auto;'>
                    <span class='material-icons'>add_circle</span>
                    Agregar mi primer apartamento
                </a>
            </div>
            ";
        }
        ?>
    </div>

    <!-- Botones de navegación -->
    <div style="text-align: center; margin-top: 40px;">
        <a href="profile.php" class="btn-modal-cancel btn-modal" style="display: inline-flex; align-items: center; gap: 10px;">
            <span class="material-icons">arrow_back</span>
            Volver a mi perfil
        </a>
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div id="deleteModal" class="modal-modern">
    <div class="modal-content-modern">
        <div class="modal-header-modern">
            <span class="material-icons">warning</span>
            <h3>Confirmar Eliminación</h3>
        </div>
        <div class="modal-body-modern">
            <p><strong>¿Estás seguro de que deseas eliminar este apartamento?</strong></p>
            <p id="modalApartmentInfo"></p>
            <p style="color: var(--danger-color); font-weight: 600;">⚠️ Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer-modern">
            <button class="btn-modal btn-modal-cancel" onclick="closeDeleteModal()">
                Cancelar
            </button>
            <button class="btn-modal btn-modal-confirm" id="confirmDeleteBtn">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <span class="material-icons" style="font-size: 18px;">delete_forever</span>
                    Eliminar Apartamento
                </span>
            </button>
        </div>
    </div>
</div>

<script>
// Variables globales para el modal
let currentDeleteId = null;

// Búsqueda de apartamentos
function searchApartments() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.apartment-card');
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Filtros
function filterAll() {
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    event.target.closest('.filter-btn').classList.add('active');
    
    document.querySelectorAll('.apartment-card').forEach(card => {
        card.style.display = 'block';
    });
}

function filterByRooms(min, max) {
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    event.target.closest('.filter-btn').classList.add('active');
    
    const cards = document.querySelectorAll('.apartment-card');
    cards.forEach(card => {
        const rooms = parseInt(card.dataset.rooms);
        if (rooms >= min && rooms <= max) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Modal de eliminación
function openDeleteModal(id, town) {
    currentDeleteId = id;
    document.getElementById('modalApartmentInfo').textContent = 
        `Apartamento en ${town} (ID: ${id})`;
    document.getElementById('deleteModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    currentDeleteId = null;
}

// Confirmar eliminación
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (currentDeleteId) {
        window.location.href = `delete_apartment.php?id=${currentDeleteId}`;
    }
});

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target == modal) {
        closeDeleteModal();
    }
}

// Cerrar modal con tecla ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDeleteModal();
    }
});

// Animación de entrada
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.apartment-card');
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
</script>

<?php include_once("../static/layouts/footer.php") ?>