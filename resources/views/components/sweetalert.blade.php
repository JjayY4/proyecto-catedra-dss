@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: @js(session('success')),
            background: '#1f2937',
            color: '#fff',
            iconColor: '#22c55e',
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'Continuar',
            timer: 3000,
            timerProgressBar: true,
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @js(session('error')),
            background: '#1f2937',
            color: '#fff',
            iconColor: '#ef4444',
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'Cerrar',
        });
    });
</script>
@endif