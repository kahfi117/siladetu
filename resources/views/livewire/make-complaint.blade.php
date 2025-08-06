<div>
    <section class="bg-blue-50 dark:bg-gray-800 mb-6">
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


    <x-filament::section>
    {{-- <x-slot name="heading">
        User details
    </x-slot> --}}

    <form wire:submit="create">
        {{ $this->form }}

        <div class="flex justify-center py-3">
            <x-filament::button
                color="info"
                type="submit">
                Buat Pengaduan
            </x-filament::button>
        </div>
    </form>
</x-filament::section>
</div>
