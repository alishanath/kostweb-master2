<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Filter Tanggal</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="p-10">

    <div x-data="{
        open: false,
        startDate: '',
        endDate: '',
        init() {
            this.startDate = new URLSearchParams(window.location.search).get('start_date') || '';
            this.endDate = new URLSearchParams(window.location.search).get('end_date') || '';
        },
        resetDates() {
            this.startDate = '';
            this.endDate = '';
            this.open = false;
            this.$nextTick(() => this.$refs.dateForm.submit());
        },
        validateDates() {
            if (this.startDate && this.endDate && this.startDate > this.endDate) {
                alert('Tanggal akhir tidak boleh sebelum tanggal mulai');
                return false;
            }
            return true;
        },
        submitForm() {
            if (this.validateDates()) {
                this.open = false;
                this.$refs.dateForm.submit();
            }
        }
    }" x-init="init()" class="relative">
        <button @click="open = !open" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-full">Filter
            Tanggal</button>

        <div x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute bg-white shadow-lg rounded-lg p-4 w-80 mt-2 z-50">
            <form x-ref="dateForm" method="GET" class="space-y-4">
                <div>
                    <label>Dari Tanggal</label>
                    <input type="date" name="start_date" x-model="startDate" class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label>Sampai Tanggal</label>
                    <input type="date" name="end_date" x-model="endDate" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="flex justify-between">
                    <button type="button" @click="resetDates" class="text-red-600">Reset</button>
                    <div class="space-x-2">
                        <button type="button" @click="open = false"
                            class="bg-gray-200 px-4 py-2 rounded-full">Batal</button>
                        <button type="button" @click="submitForm"
                            class="bg-blue-600 text-white px-4 py-2 rounded-full">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
