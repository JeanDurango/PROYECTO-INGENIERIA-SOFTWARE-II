<?php include_once("static/layouts/header.php");?>
<h1 class="espaciotitulos">Bienvenido</h1>
<?php
    include_once '../PROYECTO-INGENIERIA-SOFTWARE-II/database/models/IndexApartmentModel.php';    
    $apartmentModel = new ApartmentModel();            
    $apartments = $apartmentModel -> getApartmentsForIndex();
    while($row = mysqli_fetch_assoc($apartments)){
    // Componente visual de apartamento con formulario de reserva y calendario
    $template = "
    <div class='row index'>
        <div class='col-md-6 mb-3 picturetype1align'>
            <div>    
                <span class='bungeecss text-dark' id='numberadd'>{$row['town']}</span>
            </div>
            <div>    
                <img class='picturetype3' src='{$row['photo']}' alt=''>            
            </div>            
        </div>
        <div class='col-md-6'>
            <form class='form-reserva'>
                <div class='mb-3'>
                    <label class='form-label'>Número de habitaciones</label>
                    <span class='form-control' id='numberadd' name='numberadd'>{$row['rooms']}</span>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Valor noche</label>
                    <span class='form-control' id='valueadd' name='valueadd'>{$row['value']}</span>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Reseña habitación</label>
                    <textarea class='form-control index' style='height:125px' id='roomreviewadd' name='roomreviewadd' selected disabled>{$row['roomreview']}</textarea>
                </div>
                <!-- Calendario para seleccionar rango de fechas de reserva -->
                <div class='mb-3'>
                    <label class='form-label'>Fecha de inicio de reserva</label>
                    <input type='date' class='form-control' name='start_date' required>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Fecha de fin de reserva</label>
                    <input type='date' class='form-control' name='end_date' required>
                </div>
                <!-- Botón para reservar el apartamento -->
                <button type='submit' class='btn btn-success'>Reservar</button>
            </form>
        </div>
    </div>";
    echo $template;
    }
?>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Componente de alerta reutilizable -->
<script src="/PROYECTO-INGENIERIA-SOFTWARE-II/static/js/alert_component.js"></script>
<script>
// Validación de reserva al momento de hacer submit en el formulario
document.addEventListener('DOMContentLoaded', function() {
    var formularios = document.querySelectorAll('.form-reserva');
    formularios.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            var isLogged = <?php echo (isset($_SESSION['id']) && $_SESSION['id'] > 0) ? 'true' : 'false'; ?>;
            if (!isLogged) {
                showAlert('Reserva', 'Debes iniciar sesión para poder reservar.', 'warning', function() {
                    window.location.href = '/PROYECTO-INGENIERIA-SOFTWARE-II/pages/login.php';
                });
                event.preventDefault();
                return;
            }
            var startDate = form.querySelector("input[name='start_date']").value;
            var endDate = form.querySelector("input[name='end_date']").value;
            if (!startDate || !endDate) return;
            var start = new Date(startDate);
            var end = new Date(endDate);
            if (end < start) {
                showAlert('Fechas inválidas', 'La fecha de fin de reserva no puede ser menor que la fecha de inicio.', 'error');
                event.preventDefault();
                return;
            }
        });
    });
});
</script>
<?php include_once("static/layouts/footer.php") ?>