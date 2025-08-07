<div>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Cek Pengaduan Saya
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Udah lapor tapi penasaran udah sampai mana prosesnya?<br />
                Masukkan kode pengaduanmu dan cari tahu update-nya di sini~
                </p>

            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{asset('images/public/cover-3.png')}}" alt="mockup">
            </div>
        </div>
    </section>

    <section class="bg-blue-50 dark:bg-gray-800 py-12 rounded-lg text-center">
        <div class="max-w-screen-md mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-4">
            Cek Status Aduanmu
            </h2>

            <p class="mt-4 text-md text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-6">
                Cek status aduanmu di sini, siapa tau udah kelar tanpa kamu sadari — no drama, no ribet
            </p>
            <!-- Input dan Tombol -->
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-center mb-6">
                <input type="text" wire:model.defer="code"
                    placeholder="Masukin kode, biar ga halu 😵‍💫"
                    class="w-full sm:w-2/3 pl-4 pr-4 py-2 text-sm border rounded-lg bg-gray-50 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >

                <button wire:click="cari"
                    class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                    Cari
                </button>
            </div>

            <div wire:loading wire:target="cari" class="text-center text-sm text-blue-500 dark:text-blue-300 mb-4 animate-pulse">
                🌀 Lagi ngintip data kamu... sabar ya bestie 😚
            </div>

            <!-- Flash Message -->
            @if (session()->has('error') && $error)
            <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error')}}
                </div>
                <button type="button"
                    wire:click="$set('error', false)"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            @endif

            <!-- Hasil Tracking -->
            @if ($found)

            <div class="bg-blue-50 dark:bg-gray-800 py-10 px-4 flex justify-center items-center">
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow-md border border-blue-100 dark:border-blue-0 p-6 w-full max-w-xl text-center relative">

                    <!-- Icon -->
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-800 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                    </div>

                    <h3 class="mt-8 text-lg font-bold text-blue-800 dark:text-white">Status Pengaduan</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">Informasi terkini mengenai aduan kamu.</p>

                    <!-- Grid info -->
                    <div class="grid grid-cols-2 gap-y-4 text-sm text-center">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400">Kode Aduan</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $data->code }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 dark:text-gray-400">Subjek Aduan</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $data->subject }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 dark:text-gray-400">Status Saat Ini</div>
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $data->complaint_status->getLabel() }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 dark:text-gray-400">Tanggal Diajukan</div>
                            <div class="font-semibold text-gray-900 dark:text-white">
                                {{ $data->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="mt-6 text-sm italic text-gray-700 dark:text-blue-100">
                        {{ $data->complaint_status->getDescription() }}
                    </div>
                </div>
            </div>




            @endif
        </div>
    </section>

    <section class="mt-12">

    </section>


</div>
