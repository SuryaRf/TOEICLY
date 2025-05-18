<aside class="w-72 bg-white shadow-lg rounded-r-xl border border-gray-200 overflow-hidden">
    <div class="p-8 border-b border-gray-200">
        <h2 class="text-3xl font-extrabold text-purple-700 tracking-wide">TOEICLY</h2>
    </div>
    <ul class="mt-8 space-y-6 px-6">
        <li>
            <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                OVERVIEW
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.profile') }}" class="block px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                PROFIL
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.daftar-tes') }}" class="block px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                DAFTAR TES
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.riwayat-ujian') }}" class="block px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                RIWAYAT UJIAN
            </a>
        </li>
        <li>
            <form action="{{ route('mahasiswa.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                    LOGOUT
                </button>
            </form>
        </li>
    </ul>
</aside>