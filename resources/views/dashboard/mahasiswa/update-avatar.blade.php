<div class="avatar-upload relative">
    <div class="w-40 h-40 bg-purple-200 rounded-full overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
        <img src="{{ $user->profile ? asset('storage/' . $user->profile) : 'https://via.placeholder.com/150' }}" alt="Avatar" class="w-full h-full object-cover">
    </div>
    <form action="{{ route('mahasiswa.update-avatar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="avatar" class="absolute bottom-0 right-0 bg-purple-600 text-white p-3 rounded-full cursor-pointer shadow-lg hover:bg-purple-700 transition duration-300">
            <i class="fas fa-camera"></i>
        </label>
        <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
    </form>
</div>