<aside class="w-72 bg-white shadow-lg rounded-r-xl border border-gray-200 overflow-hidden">
    <div class="p-8 border-b border-gray-200">
        <h2 class="text-3xl font-extrabold text-purple-700 tracking-wide">TOEICLY</h2>
    </div>
    <ul class="mt-8 space-y-6 px-6">
        <li>
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="group flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                <svg class="w-5 h-5 transform transition duration-300 group-hover:translate-x-1 group-hover:scale-110"
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l9-9 9 9v9a3 3 0 01-3 3H6a3 3 0 01-3-3z"/>
                </svg>
                OVERVIEW
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.profile') }}" 
               class="group flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                <svg class="w-5 h-5 transform transition duration-300 group-hover:translate-x-1 group-hover:scale-110" 
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.297.534 6.121 1.484M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                PROFIL
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.daftar-tes') }}" 
               class="group flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                <svg class="w-5 h-5 transform transition duration-300 group-hover:translate-x-1 group-hover:scale-110" 
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M9 12l2 2 4-4m2-5h-6a2 2 0 00-2 2v2m0 0v10a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2z"/>
                </svg>
                DAFTAR TES
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.riwayat-ujian') }}" 
               class="group flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                <svg class="w-5 h-5 transform transition duration-300 group-hover:translate-x-1 group-hover:scale-110" 
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M12 6v6l4 2m4-2a8 8 0 11-8-8 8 8 0 018 8z"/>
                </svg>
                RIWAYAT UJIAN
            </a>
        </li>
        <li>
            <form action="{{ route('mahasiswa.logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="group flex items-center gap-3 w-full text-left px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                    <svg class="w-5 h-5 transform transition duration-300 group-hover:translate-x-1 group-hover:scale-110" 
                         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-12V4"/>
                    </svg>
                    LOGOUT
                </button>
            </form>
        </li>
    </ul>
</aside>
