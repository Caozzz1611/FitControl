@props(['buttonId'])

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById(@json($buttonId));
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = btn.getAttribute('href');
                Swal.fire({
                    title: '¿Quieres editar este registro?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, editar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        }
    });
</script>
