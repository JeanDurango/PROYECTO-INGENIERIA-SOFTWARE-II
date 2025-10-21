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
        text-decoration: none;
        display: inline-block;
    }

    .btn-reserve:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        color: white;
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

    .modal-booking {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
    }

    .modal-content-booking {
        background: white;
        margin: 5% auto;
        padding: 0;
        border-radius: 25px;
        max-width: 900px;
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
        display: grid;
        grid-template-columns: 1fr 1fr;
        overflow: hidden;
    }

    .modal-image-side {
        background-size: cover;
        background-position: center;
        min-height: 400px;
    }

    .modal-form-side {
        padding: 40px;
    }

    .modal-close {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 32px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        background: rgba(0, 0, 0, 0.5);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: rotate(90deg);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control.modern {
        width: 100%;
        padding: 12px 18px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control.modern:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .date-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    @media (max-width: 968px) {
        .hero-section h1 {
            font-size: 36px;
        }

        .apartments-grid {
            grid-template-columns: 1fr;
        }

        .modal-content-booking {
            grid-template-columns: 1fr;
            margin: 10% 20px;
        }

        .modal-image-side {
            min-height: 250px;
        }
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state img {
        width: 200px;
        opacity: 0.5;
        margin-bottom: 20px;
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
            $town = $apartment['town'];
            $country = $apartment['country'];
            $address = $apartment['address'];
            $rooms = $apartment['rooms'];
            $value = number_format($apartment['value'], 2);
            $review = $apartment['roomreview'];
            $photo = $apartment['photo'];
            
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
                            <div class='price-tag'>$$value <span class='price-label'>/ noche</span></div>
                        </div>
                        <button class='btn-reserve' onclick='openBookingModal($id, \"$town\", \"$photo\", $rooms, $value)'>
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

<!-- Modal de Reserva -->
<div id="bookingModal" class="modal-booking">
    <div class="modal-content-booking">
        <div class="modal-image-side" id="modalImage"></div>
        <div class="modal-form-side">
            <span class="modal-close" onclick="closeBookingModal()" style="position: relative; top: 0; right: 0; color: #333;">&times;</span>
            <h2 style="margin-bottom: 10px; color: #333;">✨ Reserva tu Estadía</h2>
            <p style="color: #777; margin-bottom: 25px;" id="modalCity"></p>
            
            <form method="POST" action="pages/create_booking.php" onsubmit="return validateBooking()">
                <input type="hidden" id="apartmentId" name="apartment_id">
                
                <div class="form-group">
                    <label>Número de habitaciones</label>
                    <input type="number" class="form-control modern" id="modalRooms" name="rooms" readonly>
                </div>

                <div class="form-group">
                    <label>Valor por noche</label>
                    <input type="text" class="form-control modern" id="modalPrice" name="price" readonly>
                </div>

                <div class="date-row">
                    <div class="form-group">
                        <label>📅 Fecha de inicio</label>
                        <input type="date" class="form-control modern" id="checkin" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label>📅 Fecha de fin</label>
                        <input type="date" class="form-control modern" id="checkout" name="end_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Comentarios adicionales</label>
                    <textarea class="form-control modern" name="comments" rows="3" placeholder="¿Algo que debamos saber?"></textarea>
                </div>

                <button type="submit" class="btn-reserve" style="width: 100%; padding: 15px; font-size: 16px;">
                    🎉 Confirmar Reserva
                </button>
            </form>
        </div>
    </div>
</div>

<script>
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

// Modal de reserva
function openBookingModal(id, town, photo, rooms, price) {
    <?php if (!isset($_SESSION['id']) || $_SESSION['id'] <= 0): ?>
        alert('Debes iniciar sesión para realizar una reserva');
        window.location.href = 'pages/login.php';
        return;
    <?php endif; ?>
    
    document.getElementById('bookingModal').style.display = 'block';
    document.getElementById('modalImage').style.backgroundImage = `url('${photo}')`;
    document.getElementById('modalCity').textContent = `Apartamento en ${town}`;
    document.getElementById('apartmentId').value = id;
    document.getElementById('modalRooms').value = rooms;
    document.getElementById('modalPrice').value = price;
    
    // Establecer fechas mínimas
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('checkin').min = today;
    document.getElementById('checkout').min = today;
}

function closeBookingModal() {
    document.getElementById('bookingModal').style.display = 'none';
}

// Validación de fechas
document.getElementById('checkin')?.addEventListener('change', function() {
    document.getElementById('checkout').min = this.value;
});

function validateBooking() {
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    
    if (new Date(checkout) <= new Date(checkin)) {
        alert('La fecha de fin debe ser posterior a la fecha de inicio');
        return false;
    }
    return true;
}

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    const modal = document.getElementById('bookingModal');
    if (event.target == modal) {
        closeBookingModal();
    }
}

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

<?php include_once 'static/layouts/footer.php'; ?>