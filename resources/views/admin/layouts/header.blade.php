<div class="flex justify-between mb-4">
    @if (!request()->is('admin/notifikasi'))
        @if (request()->is('admin/kamar'))
            <button id="addRoomBtn"
                class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded-full">Tambah</button>
        @elseif (request()->is('admin/penghuni'))
            <button id="addPenghuniBtn"
                class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded-full">Tambah</button>
        @elseif (request()->is('admin/pemesanan'))
            <button id="addOrderBtn"
                class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded-full">Tambah</button>
        @endif
    @endif
</div>
