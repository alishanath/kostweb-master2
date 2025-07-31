<button type="button" class="kirim-email bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700"
    data-id="{{ $item->id }}">
    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" stroke="currentColor" stroke-width="2"
            stroke-linejoin="round" />
        <path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
    </svg>
</button>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.kirim-email').click(function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Kirim Email?',
                text: "Email pengingat akan dikirim ke penghuni.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/admin/notifikasi/kirim-email') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat mengirim email.',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        });
    });
</script>
