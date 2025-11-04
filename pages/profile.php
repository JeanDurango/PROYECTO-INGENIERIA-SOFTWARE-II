<?php 
$sessiontype = 'all';
include_once("../static/layouts/header.php");

// Obtener datos del usuario
$id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Invitado';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

include_once '../database/models/UsersModel.php';
$usersModel = new UsersModel();
$getUser = $usersModel->getUser($id);

// Validar que se obtuvieron datos del usuario
if (!$getUser) {
    echo "<div class='alert alert-danger'>Error al cargar el perfil</div>";
    exit;
}

// Valores por defecto para evitar warnings
$userName = isset($getUser['name']) ? htmlspecialchars($getUser['name']) : 'Usuario';
$userPhoto = isset($getUser['photo']) ? htmlspecialchars($getUser['photo']) : 'https://via.placeholder.com/150';
$userTown = isset($getUser['town']) ? htmlspecialchars($getUser['town']) : 'No especificada';
$userCountry = isset($getUser['country']) ? htmlspecialchars($getUser['country']) : 'No especificado';
$userReview = isset($getUser['personalreview']) ? htmlspecialchars($getUser['personalreview']) : 'Sin descripción';
?>

<style>
    /* Variables de diseño */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea, #764ba2);
        --shadow-card: 0 10px 40px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    /* Contenedor principal del perfil */
    .profile-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Header del perfil */
    .profile-header {
        background: var(--primary-gradient);
        border-radius: 25px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: var(--shadow-card);
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
        top: -50%;
        left: -50%;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .profile-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    /* Foto de perfil */
    .profile-photo-wrapper {
        position: relative;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        transition: var(--transition);
    }

    .profile-photo:hover {
        transform: scale(1.05);
    }

    .role-badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: white;
        color: #667eea;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    /* Información del perfil */
    .profile-info {
        flex: 1;
    }

    .profile-name {
        font-size: 36px;
        font-weight: bold;
        margin: 0 0 10px 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .profile-location {
        font-size: 18px;
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    .profile-stats {
        display: flex;
        gap: 30px;
        margin-top: 20px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 28px;
        font-weight: bold;
        display: block;
    }

    .stat-label {
        font-size: 14px;
        opacity: 0.8;
    }

    /* Sección de contenido */
    .profile-content {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    /* Tarjetas */
    .card-modern {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow-card);
        transition: var(--transition);
    }

    .card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title .material-icons {
        color: #667eea;
        font-size: 28px;
    }

    /* Reseña personal */
    .personal-review {
        color: #666;
        line-height: 1.8;
        font-size: 15px;
    }

    /* Botones de acción */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .btn-action {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 25px;
        border-radius: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 15px;
    }

    .btn-action.primary {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-action.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-action.secondary {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
    }

    .btn-action.secondary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    /* Información de contacto */
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 12px;
        transition: var(--transition);
    }

    .contact-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .contact-details {
        flex: 1;
    }

    .contact-label {
        font-size: 12px;
        color: #999;
        margin-bottom: 3px;
    }

    .contact-value {
        font-size: 15px;
        color: #333;
        font-weight: 500;
        word-break: break-word;
    }

    /* Galería de apartamentos */
    .apartments-section {
        margin-top: 40px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .apartments-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .apartment-card-mini {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 200px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-card);
    }

    .apartment-card-mini:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .apartment-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .apartment-card-mini:hover .apartment-image {
        transform: scale(1.1);
    }

    .apartment-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 20px;
        color: white;
    }

    .apartment-city {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .apartment-info {
        font-size: 13px;
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state-icon {
        font-size: 80px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 24px;
        color: #666;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 16px;
        color: #999;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .profile-header-content {
            flex-direction: column;
            text-align: center;
        }

        .profile-content {
            grid-template-columns: 1fr;
        }

        .profile-name {
            font-size: 28px;
        }

        .profile-stats {
            justify-content: center;
        }

        .apartments-grid {
            grid-template-columns: 1fr;
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

    .card-modern, .apartment-card-mini {
        animation: fadeInUp 0.6s ease;
    }
</style>

<div class="profile-container">
    <!-- Header del Perfil -->
    <div class="profile-header">
        <div class="profile-header-content">
            <div class="profile-photo-wrapper">
                <img src="<?php echo $userPhoto; ?>" 
                     alt="<?php echo $userName; ?>" 
                     class="profile-photo" 
                     onerror="this.src='https://via.placeholder.com/150'">
                <span class="role-badge">
                    <?php 
                        echo $role === 'Anfitrión' ? '🏠 ' : ($role === 'Administrador' ? '👑 ' : '🧳 ');
                        echo $role;
                    ?>
                </span>
            </div>
            
            <div class="profile-info">
                <h1 class="profile-name"><?php echo $userName; ?></h1>
                <div class="profile-location">
                    <span class="material-icons">location_on</span>
                    <span><?php echo $userTown . ', ' . $userCountry; ?></span>
                </div>
                
                <?php if($role == 'Anfitrión'): 
                    include_once '../database/models/ApartmentModel.php';    
                    $apartmentModel = new ApartmentModel();            
                    $apartments = $apartmentModel->getApartments($email);
                    $totalApartments = mysqli_num_rows($apartments);
                    mysqli_data_seek($apartments, 0); // Reset pointer
                ?>
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-value"><?php echo $totalApartments; ?></span>
                        <span class="stat-label">Apartamentos</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">★ 4.8</span>
                        <span class="stat-label">Calificación</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">45</span>
                        <span class="stat-label">Reseñas</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="profile-content">
        <!-- Sidebar con acciones -->
        <div>
            <div class="card-modern">
                <h3 class="card-title">
                    <span class="material-icons">menu</span>
                    Acciones
                </h3>
                <div class="action-buttons">
                    <a href="edit_profile.php" class="btn-action primary">
                        <span class="material-icons">edit</span>
                        Editar Perfil
                    </a>
                    
                    <?php if($role == 'Anfitrión'): ?>
                        <a href="list_apartments.php" class="btn-action secondary">
                            <span class="material-icons">apartment</span>
                            Mis Apartamentos
                        </a>
                        <a href="addapartment.php" class="btn-action secondary">
                            <span class="material-icons">add_home</span>
                            Agregar Apartamento
                        </a>
                    <?php endif; ?>
                    
                    <?php if($role == 'Administrador'): ?>
                        <a href="adminlist.php" class="btn-action secondary">
                            <span class="material-icons">admin_panel_settings</span>
                            Panel Admin
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Información de contacto -->
            <div class="card-modern" style="margin-top: 20px;">
                <h3 class="card-title">
                    <span class="material-icons">contact_mail</span>
                    Contacto
                </h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-icons">email</span>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">Correo</div>
                            <div class="contact-value"><?php echo $email; ?></div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-icons">location_city</span>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">Ubicación</div>
                            <div class="contact-value"><?php echo $userTown; ?></div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <span class="material-icons">public</span>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">País</div>
                            <div class="contact-value"><?php echo $userCountry; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel principal con reseña -->
        <div>
            <div class="card-modern">
                <h3 class="card-title">
                    <span class="material-icons">info</span>
                    Sobre mí
                </h3>
                <p class="personal-review">
                    <?php echo nl2br($userReview); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Galería de apartamentos (solo para anfitriones) -->
    <?php if($role == 'Anfitrión' && isset($apartments)): ?>
    <div class="apartments-section">
        <div class="section-header">
            <h2 class="section-title">
                <span class="material-icons">home_work</span>
                Mis Propiedades
            </h2>
            <a href="list_apartments.php" class="btn-action secondary" style="width: auto;">
                Ver Todos
                <span class="material-icons">arrow_forward</span>
            </a>
        </div>

        <?php if(mysqli_num_rows($apartments) > 0): ?>
            <div class="apartments-grid">
                <?php 
                $count = 0;
                while($row = mysqli_fetch_assoc($apartments)): 
                    if($count >= 6) break;
                    $count++;
                    
                    // Validar datos del apartamento
                    $aptId = isset($row['id']) ? intval($row['id']) : 0;
                    $aptTown = isset($row['town']) ? htmlspecialchars($row['town']) : 'Sin ubicación';
                    $aptPhoto = isset($row['photo']) ? htmlspecialchars($row['photo']) : '';
                    $aptRooms = isset($row['rooms']) ? intval($row['rooms']) : 0;
                    $aptValue = isset($row['value']) ? floatval($row['value']) : 0;
                ?>
                    <div class="apartment-card-mini" onclick="window.location.href='edit_apartment.php?id=<?php echo $aptId; ?>'">
                        <img src="<?php echo $aptPhoto; ?>" 
                             alt="<?php echo $aptTown; ?>" 
                             class="apartment-image"
                             onerror="this.src='https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800'">
                        <div class="apartment-overlay">
                            <div class="apartment-city">📍 <?php echo $aptTown; ?></div>
                            <div class="apartment-info">
                                <span class="material-icons" style="font-size: 16px;">bed</span>
                                <?php echo $aptRooms; ?> habitaciones • $<?php echo number_format($aptValue, 0); ?>/noche
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="card-modern">
                <div class="empty-state">
                    <div class="empty-state-icon">🏘️</div>
                    <h3>No tienes apartamentos registrados</h3>
                    <p>Comienza agregando tu primera propiedad</p>
                    <a href="addapartment.php" class="btn-action primary" style="width: fit-content; margin: 20px auto 0;">
                        <span class="material-icons">add</span>
                        Agregar Apartamento
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<script>
// Animación de entrada para las tarjetas
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-modern, .apartment-card-mini');
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