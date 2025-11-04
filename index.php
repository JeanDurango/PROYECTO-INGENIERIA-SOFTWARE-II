<?php 
$sessiontype = 'index';
include_once '../PROYECTO-INGENIERIA-SOFTWARE-II/static/layouts/header.php';
include_once '../PROYECTO-INGENIERIA-SOFTWARE-II/database/models/IndexApartmentModel.php';
$apartmentModel = new ApartmentModel();
$apartments = $apartmentModel->getApartmentsForIndex();
?>

<style>
    .hero-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9)),
                    url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1600') center/cover;
        border-radius: 25px;
        padding: 80px 40px;
        text-align: center;
        color: white;
        margin-bottom: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .hero-section h1 {
        font-size: 56px;
        font-weight: bold;
        margin-bottom: 20px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }

    .hero-section p {
        font-size: 22px;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-bar {
        background: white;
        border-radius: 50px;
        padding: 10px;
        display: flex;
        gap: 10px;
        max-width: 600px;
        margin: 30px auto 0;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    }

    .search-bar input {
        flex: 1;
        border: none;
        padding: 15px 20px;
        font-size: 16px;
        border-radius: 40px;
        background: #f8f9fa;
    }

    .search-bar input:focus {
        outline: none;
        background: white;
    }

    .search-bar button {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 15px 35px;
        border-radius: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-bar button:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .apartments-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .apartment-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .apartment-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .apartment-image-container {
        position: relative;
        height: 250px;
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

    .city-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 14px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    .apartment-content {
        padding: 25px;
    }

    .apartment-title {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .apartment-address {
        color: #777;
        font-size: 14px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .apartment-features {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .feature-badge {
        background: #f0f0f0;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 13px;
        color: #666;
    }

    .apartment-description {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .apartment-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 2px solid #f0f0f0;
        padding-top: 15px;
        margin-top: 15px;
    }

    .price-tag {
        font-size: 28px;
        font-weight: bold;
        color: #667eea;
    }

    .price-label {
        font-size: 12px;
        color: #999;
        font-weight: normal;
    }

    .btn-reserve {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-reserve:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .section-title {
        font-size: 36px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }

    .section-subtitle {
        color: #777;
        text-align: center;
        margin-bottom: 30px;
        font-size: 18px;
    }

    /* MODAL DE RESERVA MEJORADO */
    .modal-booking {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content-booking {
        background: white;
        margin: 3% auto;
        border-radius: 25px;
        max-width: 1000px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: slideUp 0.4s ease;
        max-height: 90vh;
        overflow-y: auto;
    }

    @keyframes slideUp {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 30px 40px;
        position: relative;
    }

    .modal-close {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 32px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        background: rgba(0, 0, 0, 0.3);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: rgba(0, 0, 0, 0.5);
        transform: rotate(90deg);
    }

    .modal-header-content h2 {
        font-size: 32px;
        margin: 0 0 10px 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .modal-header-content p {
        opacity: 0.9;
        font-size: 16px;
        margin: 0;
    }

    .modal-body {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 0;
    }

    .modal-left {
        padding: 40px;
        border-right: 1px solid #e0e0e0;
    }

    .modal-right {
        padding: 40px;
        background: #f8f9fa;
    }

    .section-block {
        margin-bottom: 35px;
    }

    .section-block:last-child {
        margin-bottom: 0;
    }

    .block-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .block-title .material-icons {
        color: #667eea;
        font-size: 26px;
    }

    /* CALENDARIO PERSONALIZADO */
    .calendar-container {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .calendar-month {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .calendar-nav {
        display: flex;
        gap: 10px;
    }

    .calendar-nav-btn {
        width: 35px;
        height: 35px;
        border: none;
        background: #667eea;
        color: white;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .calendar-nav-btn:hover {
        background: #764ba2;
        transform: scale(1.1);
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-bottom: 10px;
    }

    .calendar-day-name {
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        color: #999;
        padding: 8px 0;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
        border: 2px solid transparent;
    }

    .calendar-day:hover:not(.disabled):not(.selected) {
        background: #e8ebff;
        transform: scale(1.1);
    }

    .calendar-day.disabled {
        color: #ccc;
        cursor: not-allowed;
    }

    .calendar-day.selected {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        font-weight: bold;
        transform: scale(1.05);
    }

    .calendar-day.in-range {
        background: rgba(102, 126, 234, 0.2);
        color: #667eea;
    }

    /* FORMULARIO */
    .form-group-modal {
        margin-bottom: 25px;
    }

    .form-label-modal {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .form-label-modal .material-icons {
        font-size: 20px;
        color: #667eea;
    }

    .form-control-modal {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control-modal:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .date-display {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px;
        background: white;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .date-item {
        flex: 1;
        text-align: center;
        padding: 10px;
        border-radius: 8px;
        background: #f8f9fa;
    }

    .date-label {
        font-size: 12px;
        color: #999;
        margin-bottom: 5px;
    }

    .date-value {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .date-separator {
        font-size: 24px;
        color: #667eea;
    }

    /* RESUMEN DE PRECIO */
    .price-summary {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .price-row:last-child {
        border-bottom: none;
        border-top: 2px solid #667eea;
        margin-top: 10px;
        padding-top: 15px;
    }

    .price-label {
        color: #666;
        font-size: 14px;
    }

    .price-value {
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }

    .price-total {
        font-size: 24px !important;
        color: #667eea !important;
        font-weight: bold !important;
    }

    .nights-badge {
        background: #e8ebff;
        color: #667eea;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 10px;
    }

    /* BOTONES */
    .btn-confirm-booking {
        width: 100%;
        padding: 16px;
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
        margin-top: 20px;
    }

    .btn-confirm-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-confirm-booking:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
    }

    /* INFO CARDS */
    .info-card {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #667eea;
        margin-top: 20px;
    }

    .info-card-title {
        font-weight: 600;
        color: #667eea;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-card-content {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    /* APARTAMENTO INFO */
    .apartment-info-header {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 2px solid #f0f0f0;
    }

    .apartment-thumb {
        width: 120px;
        height: 120px;
        border-radius: 15px;
        object-fit: cover;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .apartment-details h3 {
        font-size: 20px;
        margin: 0 0 8px 0;
        color: #333;
    }

    .apartment-meta {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #666;
        font-size: 14px;
    }

    .meta-item .material-icons {
        font-size: 18px;
        color: #667eea;
    }

    /* RESPONSIVE */
    @media (max-width: 968px) {
        .modal-body {
            grid-template-columns: 1fr;
        }

        .modal-left {
            border-right: none;
            border-bottom: 1px solid #e0e0e0;
        }

        .hero-section h1 {
            font-size: 36px;
        }

        .apartments-grid {
            grid-template-columns: 1fr;
        }

        .calendar-days {
            gap: 5px;
        }

        .apartment-info-header {
            flex-direction: column;
        }
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <h1>🏠 Encuentra tu Hogar Ideal</h1>
    <p>Descubre apartamentos increíbles en las mejores ciudades de Colombia</p>
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="¿A dónde quieres ir? Busca por ciudad...">
        <button onclick="searchApartments()">🔍 Buscar</button>
    </div>
</div>

<!-- Apartments Section -->
<h2 class="section-title">Apartamentos</h2>
<p class="section-subtitle">Explora nuestra selección de propiedades premium</p>

<div class="apartments-grid" id="apartmentsGrid">
    <?php
    if (mysqli_num_rows($apartments) > 0) {
        while ($apartment = mysqli_fetch_assoc($apartments)) {
            $id = $apartment['id'];
            $town = htmlspecialchars($apartment['town']);
            $country = htmlspecialchars($apartment['country']);
            $address = htmlspecialchars($apartment['address']);
            $rooms = intval($apartment['rooms']);
            $value = floatval($apartment['value']);
            $review = htmlspecialchars($apartment['roomreview']);
            $photo = htmlspecialchars($apartment['photo']);
            
            echo "
            <div class='apartment-card' data-city='$town'>
                <div class='apartment-image-container'>
                    <img src='$photo' alt='$town' class='apartment-image' onerror=\"this.src='https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800'\">
                    <div class='city-badge'>📍 $town</div>
                </div>
                <div class='apartment-content'>
                    <h3 class='apartment-title'>Apartamento en $town</h3>
                    <div class='apartment-address'>
                        🌎 $address, $country
                    </div>
                    <div class='apartment-features'>
                        <span class='feature-badge'>🛏️ $rooms Habitaciones</span>
                        <span class='feature-badge'>✨ Premium</span>
                        <span class='feature-badge'>📶 WiFi</span>
                    </div>
                    <p class='apartment-description'>$review</p>
                    <div class='apartment-footer'>
                        <div>
                            <div class='price-tag'>$" . number_format($value, 2) . " <span class='price-label'>/ noche</span></div>
                        </div>
                        <button class='btn-reserve' onclick='openBookingModal($id, \"$town\", \"$photo\", $rooms, $value, \"$address\", \"$country\", \"$review\")'>
                            Reservar
                        </button>
                    </div>
                </div>
            </div>
            ";
        }
    } else {
        echo "
        <div class='empty-state'>
            <p style='font-size: 64px;'>🏘️</p>
            <h3>No hay apartamentos disponibles</h3>
            <p>Vuelve pronto para ver nuevas propiedades</p>
        </div>
        ";
    }
    ?>
</div>

<!-- Modal de Reserva Mejorado -->
<div id="bookingModal" class="modal-booking">
    <div class="modal-content-booking">
        <div class="modal-header">
            <span class="modal-close" onclick="closeBookingModal()">&times;</span>
            <div class="modal-header-content">
                <h2>
                    <span class="material-icons">event_available</span>
                    Reserva tu Estadía
                </h2>
                <p id="modalCitySubtitle"></p>
            </div>
        </div>

        <div class="modal-body">
            <!-- Columna Izquierda: Formulario y Calendario -->
            <div class="modal-left">
                <!-- Info del Apartamento -->
                <div class="section-block">
                    <div class="apartment-info-header">
                        <img id="modalApartmentThumb" src="" alt="" class="apartment-thumb">
                        <div class="apartment-details">
                            <h3 id="modalApartmentTitle"></h3>
                            <div class="apartment-meta">
                                <div class="meta-item">
                                    <span class="material-icons">location_on</span>
                                    <span id="modalApartmentLocation"></span>
                                </div>
                                <div class="meta-item">
                                    <span class="material-icons">bed</span>
                                    <span id="modalApartmentRooms"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selección de Fechas con Calendario -->
                <div class="section-block">
                    <div class="block-title">
                        <span class="material-icons">calendar_month</span>
                        Selecciona tus fechas
                    </div>

                    <div class="date-display">
                        <div class="date-item">
                            <div class="date-label">Check-in</div>
                            <div class="date-value" id="checkinDisplay">Selecciona</div>
                        </div>
                        <div class="date-separator">→</div>
                        <div class="date-item">
                            <div class="date-label">Check-out</div>
                            <div class="date-value" id="checkoutDisplay">Selecciona</div>
                        </div>
                    </div>

                    <!-- Calendario -->
                    <div class="calendar-container">
                        <div class="calendar-header">
                            <button class="calendar-nav-btn" onclick="prevMonth()">
                                <span class="material-icons">chevron_left</span>
                            </button>
                            <div class="calendar-month" id="calendarMonth"></div>
                            <button class="calendar-nav-btn" onclick="nextMonth()">
                                <span class="material-icons">chevron_right</span>
                            </button>
                        </div>
                        <div class="calendar-days">
                            <div class="calendar-day-name">Dom</div>
                            <div class="calendar-day-name">Lun</div>
                            <div class="calendar-day-name">Mar</div>
                            <div class="calendar-day-name">Mié</div>
                            <div class="calendar-day-name">Jue</div>
                            <div class="calendar-day-name">Vie</div>
                            <div class="calendar-day-name">Sáb</div>
                        </div>
                        <div class="calendar-days" id="calendarDays"></div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="section-block">
                    <div class="block-title">
                        <span class="material-icons">info</span>
                        Información adicional (opcional)
                    </div>

                    <div class="form-group-modal">
                        <label class="form-label-modal">
                            <span class="material-icons">people</span>
                            Número de huéspedes
                        </label>
                        <input type="number" 
                               class="form-control-modal" 
                               id="guestsCount" 
                               min="1" 
                               max="10" 
                               value="2"
                               placeholder="Número de personas">
                    </div>

                    <div class="form-group-modal">
                        <label class="form-label-modal">
                            <span class="material-icons">comment</span>
                            Comentarios o peticiones especiales
                        </label>
                        <textarea class="form-control-modal" 
                                  id="bookingComments" 
                                  rows="4"
                                  placeholder="Ej: Llegada tarde, necesito cuna para bebé, etc."></textarea>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Resumen y Precio -->
            <div class="modal-right">
                <div class="section-block">
                    <div class="block-title">
                        <span class="material-icons">receipt</span>
                        Resumen de tu reserva
                    </div>

                    <div class="price-summary">
                        <div class="price-row">
                            <span class="price-label">Precio por noche</span>
                            <span class="price-value" id="pricePerNight">$0</span>
                        </div>
                        <div class="price-row">
                            <span class="price-label">
                                Noches
                                <span class="nights-badge" id="nightsBadge">0 noches</span>
                            </span>
                            <span class="price-value" id="subtotalPrice">$0</span>
                        </div>
                        <div class="price-row">
                            <span class="price-label">Tarifa de servicio (10%)</span>
                            <span class="price-value" id="serviceFee">$0</span>
                        </div>
                        <div class="price-row">
                            <span class="price-label">Total</span>
                            <span class="price-value price-total" id="totalPrice">$0</span>
                        </div>
                    </div>

                    <button class="btn-confirm-booking" id="confirmBookingBtn" onclick="confirmBooking()" disabled>
                        <span class="material-icons">check_circle</span>
                        Confirmar Reserva
                    </button>
                </div>

                <div class="info-card">
                    <div class="info-card-title">
                        <span class="material-icons">verified_user</span>
                        Reserva segura
                    </div>
                    <div class="info-card-content">
                        Tu información está protegida. No te cobraremos hasta que el anfitrión acepte tu reserva.
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-title">
                        <span class="material-icons">cancel</span>
                        Cancelación gratuita
                    </div>
                    <div class="info-card-content">
                        Cancela hasta 48 horas antes del check-in para obtener un reembolso completo.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales para el modal de reserva
let currentApartmentData = {};
let currentMonth = new Date();
let selectedCheckin = null;
let selectedCheckout = null;
let selectingCheckout = false;

// Abrir modal de reserva
function openBookingModal(id, town, photo, rooms, price, address, country, review) {
    <?php if (!isset($_SESSION['id']) || $_SESSION['id'] <= 0): ?>
        alert('⚠️ Debes iniciar sesión para realizar una reserva');
        window.location.href = 'pages/login.php';
        return;
    <?php endif; ?>
    
    // Guardar datos del apartamento
    currentApartmentData = {
        id: id,
        town: town,
        photo: photo,
        rooms: rooms,
        price: price,
        address: address,
        country: country,
        review: review
    };
    
    // Actualizar información del modal
    document.getElementById('modalCitySubtitle').textContent = `${town}, ${country}`;
    document.getElementById('modalApartmentTitle').textContent = `Apartamento en ${town}`;
    document.getElementById('modalApartmentLocation').textContent = `${address}, ${country}`;
    document.getElementById('modalApartmentRooms').textContent = `${rooms} habitaciones`;
    document.getElementById('modalApartmentThumb').src = photo;
    document.getElementById('pricePerNight').textContent = `${formatNumber(price)}`;
    
    // Reset fechas
    selectedCheckin = null;
    selectedCheckout = null;
    selectingCheckout = false;
    document.getElementById('checkinDisplay').textContent = 'Selecciona';
    document.getElementById('checkoutDisplay').textContent = 'Selecciona';
    
    // Mostrar modal
    document.getElementById('bookingModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
    
    // Inicializar calendario
    currentMonth = new Date();
    renderCalendar();
    updatePriceSummary();
}

// Cerrar modal
function closeBookingModal() {
    document.getElementById('bookingModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    selectedCheckin = null;
    selectedCheckout = null;
}

// Renderizar calendario
function renderCalendar() {
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    
    document.getElementById('calendarMonth').textContent = 
        `${monthNames[currentMonth.getMonth()]} ${currentMonth.getFullYear()}`;
    
    const firstDay = new Date(currentMonth.getFullYear(), currentMonth.getMonth(), 1);
    const lastDay = new Date(currentMonth.getFullYear(), currentMonth.getMonth() + 1, 0);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    const calendarDays = document.getElementById('calendarDays');
    calendarDays.innerHTML = '';
    
    // Días vacíos al inicio
    for (let i = 0; i < firstDay.getDay(); i++) {
        const emptyDay = document.createElement('div');
        calendarDays.appendChild(emptyDay);
    }
    
    // Días del mes
    for (let day = 1; day <= lastDay.getDate(); day++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';
        dayElement.textContent = day;
        
        const currentDate = new Date(currentMonth.getFullYear(), currentMonth.getMonth(), day);
        
        // Deshabilitar días pasados
        if (currentDate < today) {
            dayElement.classList.add('disabled');
        } else {
            dayElement.onclick = () => selectDate(currentDate);
            
            // Marcar días seleccionados
            if (selectedCheckin && currentDate.getTime() === selectedCheckin.getTime()) {
                dayElement.classList.add('selected');
            }
            if (selectedCheckout && currentDate.getTime() === selectedCheckout.getTime()) {
                dayElement.classList.add('selected');
            }
            
            // Marcar rango
            if (selectedCheckin && selectedCheckout) {
                if (currentDate > selectedCheckin && currentDate < selectedCheckout) {
                    dayElement.classList.add('in-range');
                }
            }
        }
        
        calendarDays.appendChild(dayElement);
    }
}

// Seleccionar fecha en calendario
function selectDate(date) {
    if (!selectingCheckout) {
        // Seleccionar check-in
        selectedCheckin = date;
        selectedCheckout = null;
        selectingCheckout = true;
        
        document.getElementById('checkinDisplay').textContent = formatDate(date);
        document.getElementById('checkoutDisplay').textContent = 'Selecciona';
    } else {
        // Seleccionar check-out
        if (date <= selectedCheckin) {
            alert('La fecha de salida debe ser posterior a la fecha de entrada');
            return;
        }
        selectedCheckout = date;
        selectingCheckout = false;
        
        document.getElementById('checkoutDisplay').textContent = formatDate(date);
    }
    
    renderCalendar();
    updatePriceSummary();
}

// Navegación del calendario
function prevMonth() {
    currentMonth = new Date(currentMonth.getFullYear(), currentMonth.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentMonth = new Date(currentMonth.getFullYear(), currentMonth.getMonth() + 1);
    renderCalendar();
}

// Actualizar resumen de precios
function updatePriceSummary() {
    const confirmBtn = document.getElementById('confirmBookingBtn');
    
    if (!selectedCheckin || !selectedCheckout) {
        document.getElementById('nightsBadge').textContent = '0 noches';
        document.getElementById('subtotalPrice').textContent = '$0';
        document.getElementById('serviceFee').textContent = '$0';
        document.getElementById('totalPrice').textContent = '$0';
        confirmBtn.disabled = true;
        return;
    }
    
    // Calcular noches
    const nights = Math.ceil((selectedCheckout - selectedCheckin) / (1000 * 60 * 60 * 24));
    const subtotal = currentApartmentData.price * nights;
    const serviceFee = subtotal * 0.10;
    const total = subtotal + serviceFee;
    
    document.getElementById('nightsBadge').textContent = `${nights} noche${nights > 1 ? 's' : ''}`;
    document.getElementById('subtotalPrice').textContent = `${formatNumber(subtotal)}`;
    document.getElementById('serviceFee').textContent = `${formatNumber(serviceFee)}`;
    document.getElementById('totalPrice').textContent = `${formatNumber(total)}`;
    
    confirmBtn.disabled = false;
}

// Confirmar reserva
function confirmBooking() {
    if (!selectedCheckin || !selectedCheckout) {
        alert('⚠️ Por favor selecciona las fechas de tu estadía');
        return;
    }
    
    const guests = document.getElementById('guestsCount').value;
    const comments = document.getElementById('bookingComments').value;
    
    const nights = Math.ceil((selectedCheckout - selectedCheckin) / (1000 * 60 * 60 * 24));
    const subtotal = currentApartmentData.price * nights;
    const serviceFee = subtotal * 0.10;
    const total = subtotal + serviceFee;
    
    // Crear resumen de la reserva
    const bookingSummary = `
🏠 RESUMEN DE TU RESERVA

📍 Apartamento: ${currentApartmentData.town}, ${currentApartmentData.country}
📅 Check-in: ${formatDate(selectedCheckin)}
📅 Check-out: ${formatDate(selectedCheckout)}
🌙 Noches: ${nights}
👥 Huéspedes: ${guests}

💰 DESGLOSE DE PRECIOS
Precio por noche: ${formatNumber(currentApartmentData.price)}
Subtotal (${nights} noches): ${formatNumber(subtotal)}
Tarifa de servicio: ${formatNumber(serviceFee)}
━━━━━━━━━━━━━━━━━━━━
TOTAL: ${formatNumber(total)}

${comments ? `📝 Comentarios: ${comments}` : ''}

¿Deseas confirmar esta reserva?
    `;
    
    if (confirm(bookingSummary)) {
        showSuccessNotification();
        
        // Aquí puedes enviar los datos al servidor
        // Por ahora solo mostramos el mensaje de éxito
        setTimeout(() => {
            closeBookingModal();
        }, 3000);
    }
}

// Notificación de éxito
function showSuccessNotification() {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
        padding: 40px 50px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        z-index: 10001;
        text-align: center;
        animation: successPulse 0.6s ease;
    `;
    
    notification.innerHTML = `
        <div style="font-size: 64px; margin-bottom: 20px;">✅</div>
        <h2 style="margin: 0 0 10px 0; font-size: 28px;">¡Reserva Confirmada!</h2>
        <p style="margin: 0; font-size: 16px; opacity: 0.9;">
            Recibirás un email con los detalles de tu reserva
        </p>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => notification.remove(), 3000);
}

// Utilidades
function formatDate(date) {
    const months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    return `${date.getDate()} ${months[date.getMonth()]}`;
}

function formatNumber(number) {
    return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Búsqueda de apartamentos
function searchApartments() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.apartment-card');
    
    cards.forEach(card => {
        const city = card.getAttribute('data-city').toLowerCase();
        if (city.includes(searchTerm) || searchTerm === '') {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Enter para buscar
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchApartments();
    }
});

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    const modal = document.getElementById('bookingModal');
    if (event.target == modal) {
        closeBookingModal();
    }
}

// Cerrar modal con tecla ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeBookingModal();
    }
});

// Animación de entrada de tarjetas
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

// Animación de éxito
const successStyle = document.createElement('style');
successStyle.textContent = `
    @keyframes successPulse {
        0% {
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 0;
        }
        50% {
            transform: translate(-50%, -50%) scale(1.05);
        }
        100% {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }
    }
`;
document.head.appendChild(successStyle);
</script>

<?php include_once 'static/layouts/footer.php'; ?>