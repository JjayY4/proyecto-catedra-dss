@if (session()->has('success') || session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session()->has('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{!! session()->pull('success') !!}",
                    background: '#1f2937',
                    color: '#fff',
                    iconColor: '#22c55e',
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'Continuar',
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif

            @if(session()->has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{!! session()->pull('error') !!}",
                    background: '#1f2937',
                    color: '#fff',
                    iconColor: '#ef4444',
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'Cerrar',
                });
            @endif
        });
    </script>
@endif