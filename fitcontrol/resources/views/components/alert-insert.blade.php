@props(['buttonId'])

@once
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endonce

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById(@json($buttonId));
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = btn.getAttribute('href');
                Swal.fire({
                    title: '¿Quieres insertar un nuevo registro?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        }
    });
</script>
