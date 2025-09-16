@props(['buttonId'])

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById("{{ $buttonId }}");
        if(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault(); // detener el link por defecto
                Swal.fire({
                    title: 'Insertar nuevo resgitro',
                    text: 'Vas a crear un nuevo registro',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Continuar'
                }).then(() => {
                    // redirige al href del link después de confirmar
                    window.location.href = btn.getAttribute('href');
                });
            });
        }
    });
</script>
