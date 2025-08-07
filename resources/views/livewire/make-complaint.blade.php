<div>
    <section class="bg-blue-50 dark:bg-gray-800 mb-6 rounded-lg">
        <div class="max-w-screen-xl mx-auto px-4 py-16 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">
            Buat Pengaduan
            </h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            Ada masalah? Ceritain aja di sini, jangan dipendam sendiri<br />
            Tim kami siap bantu kamu sampai tuntas
            </p>
            <div class="mt-8">
            </div>
        </div>
    </section>

    @if ($success)
    <div id="alert-additional-content-1" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
        <div class="flex items-center">
            <svg class="shrink-0 w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <h3 class="text-lg font-medium">Pengaduan Berhasil Dikirim</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            Pengaduan kamu dengan subjek
            <b>
                {{ $successMessage }}
            </b>
            sudah tercatat dengan rapi kayak playlist Spotify.
            <br>
            Kode Pengaduan:
            <b> {{ $codeComplaint}} </b>
            — jangan lupa disimpan, ya. Buat nanti-nanti~
        </div>
        <div class="flex">
            <div class="relative">
                <button type="button"
                    onclick="copyCodeAndShowTooltip(this, @js($codeComplaint))"
                    class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 me-2 inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-2 h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                    </svg>
                    Salin Kode Pengaduan
                </button>
                <!-- Tooltip -->
                <div class="absolute left-0 top-full mt-1 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 transition-opacity duration-300 pointer-events-none z-10"
                    id="tooltip-copy">
                    Kode berhasil disalin!
                </div>
            </div>
            <button type="button"
                wire:click="$set('success', false)"
                class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800">
                Tutup
            </button>
        </div>
    </div>
    @endif


    <x-filament::section>
    {{-- <x-slot name="heading">
        User details
    </x-slot> --}}

        <form wire:submit="create">
            {{ $this->form }}

            <div class="flex py-3 mt-4">
                <x-filament::button
                    color="info"
                    type="submit">
                    Buat Pengaduan
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>

    <script>
        function copyCodeAndShowTooltip(button, text) {
            navigator.clipboard.writeText(text).then(() => {
                const tooltip = button.parentElement.querySelector('#tooltip-copy');
                tooltip.classList.remove('opacity-0');
                tooltip.classList.add('opacity-100');

                // Sembunyikan tooltip setelah 2 detik
                setTimeout(() => {
                    tooltip.classList.remove('opacity-100');
                    tooltip.classList.add('opacity-0');
                }, 2000);
            });
        }
    </script>
</div>
