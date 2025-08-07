
<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Lapor Aja, Biar Nggak Emosi!
                </h1>
                <h4 class="max-w-2xl mb-4 text-md font-extrabold tracking-tight leading-none md:text-xl xl:text-xl dark:text-white">
                    🛠️ Sistem pengaduan desa yang nggak ribet dan bikin senyum
                </h4>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Ke pasar beli semangka,
                    Pulang-pulang lupa bawa. <br>
                    Kalau ada masalah di desa,
                    Laporin aja, jangan bawa ke mama!
                </p>
                <a href="{{route('complaint.create')}}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Buat Pengaduan
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <a href="{{route('complaint.check')}}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Cek Aduan Saya
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{asset('images/public/cover-2.png')}}" alt="mockup">
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-12 px-4 mx-auto max-w-screen-xl text-center lg:py-20 lg:px-6">
            <h2 class="mb-12 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
            Pengaduan Realita by the Numbers
            </h2>

            <div class="grid gap-8 md:grid-cols-3">
            <!-- Card 1: Total Pengaduan -->
            <div class="p-6 bg-gray-50 rounded-lg shadow dark:bg-gray-800">
                <h3 class="text-4xl font-extrabold text-gray-900 dark:text-white">2000</h3>
                <p class="mt-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Total Drama</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah pengaduan yang masuk, rame bener! 😮‍💨</p>
            </div>

            <!-- Card 2: Pengaduan Beres -->
            <div class="p-6 bg-green-50 rounded-lg shadow dark:bg-green-800">
                <h3 class="text-4xl font-extrabold text-green-600 dark:text-green-400">1300</h3>
                <p class="mt-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Udah Beres Gaes~ ✅</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Pengaduan yang udah kelar, aman sentosa 😎</p>
            </div>

            <!-- Card 3: Pengaduan Diproses -->
            <div class="p-6 bg-yellow-50 rounded-lg shadow dark:bg-yellow-800">
                <h3 class="text-4xl font-extrabold text-yellow-600 dark:text-yellow-400">700</h3>
                <p class="mt-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Masih Proses Nih 😵‍💫</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Lagi diurus, sabar ya bestie... 🧃</p>
            </div>
            </div>

            <p class="mt-6 text-xs text-gray-500 dark:text-gray-400">
            *Data diambil dari sistem, bukan hasil ramalan bintang 🌟
            </p>
        </div>
    </section>


    {{-- FAQ --}}
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <h2 class="mb-8 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
            FAQ (Fitur Aduan Qolbu)
            </h2>
            <p class="mb-6 text-lg text-gray-600 dark:text-gray-400">
                Buat kamu yang hatinya gelisah tapi masih mau tanya-tanya dulu.
            </p>

            <div class="grid pt-8 text-left border-t border-gray-200 md:gap-16 dark:border-gray-700 md:grid-cols-2">
            @foreach($faqs as $faq)
            <div class="mb-0">
                <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM10 7a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zM10 15a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd" />
                </svg>
                {{ $faq['question'] }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400">{!! $faq['answer'] !!}</p>
            </div>
            @endforeach
            </div>
        </div>
    </section>

</div>
