@component('mail::message')
    # Pengingat Pembayaran Sewa

    Halo {{ $notifikasi->penghuni->name ?? 'Penghuni' }},

    Pembayaran sewa kamar {{ $notifikasi->kamar->no_kamar ?? '-' }} akan jatuh tempo pada tanggal:
    {{ \Carbon\Carbon::parse($notifikasi->tanggal_sewa)->addDays($notifikasi->tipe_pembayaran === 'bulanan' ? 30 : 7)->format('d-m-Y') }}

    Total tagihan:
    Rp {{ number_format($notifikasi->total_pembayaran, 0, ',', '.') }}


    Terima kasih,

    ---
    Jika Anda sudah melakukan pembayaran, abaikan email ini.
    Untuk bantuan hubungi:
    Email : alfiakostpurwokerto@gmail.com
    No Hp : +62 896 3043 3177
@endcomponent
