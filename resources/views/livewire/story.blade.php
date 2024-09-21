<div>
    <div class="container mx-auto p-4">
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="w-full md:w-1/3 mb-4 md:mb-0">
                <div class="bg-white shadow-md p-6 rounded-lg">
                    <h1 class="text-2xl font-semibold">{{ Auth()->user()->name }}</h1>
                    <hr class="my-4">
                    <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded w-full" wire:click='batal'>Status saya</button>
                    @foreach ($semuamemberkecualisaya as $member)
                        <button class="mt-2 w-full px-4 py-2 rounded {{ $member->id == $memberterpilih ? 'bg-gradient-to-r from-purple-400 to-purple-600 text-white' : 'border border-purple-500 text-purple-500' }}" wire:click='pilihMember({{ $member->id }})'>
                            {{ $member->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="w-full md:w-2/3">
                @if ($ceritabaru)
                    <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded mb-4 w-full" wire:click='batal'>Batal</button>
                @else
                    <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded mb-4 w-full" wire:click='buatCeritaBaru'>Tambah Story</button>
                @endif

                <i class="fas fa-sync fa-spin" wire:loading></i>

                @if ($ceritabaru)
                    <div class="bg-white shadow-md p-6 rounded-lg mb-6">
                        <h2 class="font-bold text-xl mb-4">Buat Cerita Baru</h2>
                        <form wire:submit='simpanCerita'>
                            <div class="mb-4">
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" class="form-input mt-1 block w-full border border-gray-300 rounded" id="judul" wire:model='judul'>
                                @error('judul') 
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="cerita" class="block text-sm font-medium text-gray-700">Cerita</label>
                                <textarea class="form-textarea mt-1 block w-full border border-gray-300 rounded" id="cerita" wire:model='cerita'></textarea>
                                @error('cerita') 
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                                <input type="file" class="form-input mt-1 block w-full border border-gray-300 rounded" id="gambar" wire:model='gambar'>
                            </div>
                            <button type="submit" class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded">Simpan</button>
                        </form>
                    </div>
                @endif

                @foreach($semuacerita as $c)
                    <div class="bg-white shadow-lg rounded-lg mb-6 p-6">
                        <h3 class="font-bold text-xl mb-2">{{ $c->judul }}</h3>
                        <div class="mb-4">
                            <img src="{{ asset('storage/gambar/' . $c->foto) }}" alt="gmbr" class="w-full h-auto max-h-80 object-contain rounded-lg">
                        </div>
                        <p class="text-gray-700 leading-relaxed truncate">{{ $c->isi }}</p>
                        <hr class="my-4">
                        <div class="flex items-center space-x-2">
                            <input type="text" class="form-input w-full border border-gray-300 rounded" placeholder="Komentar Anda" wire:model='komentar' wire:keydown.enter="simpanKomentar({{ $c->id }})">
                            <button class="bg-gradient-to-r from-purple-400 to-purple-600 text-white px-4 py-2 rounded" wire:click='simpanKomentar({{ $c->id }})'>Kirim</button>
                        </div>
                        @error('komentar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <div class="mt-4 space-y-2">
                            @foreach($c->komentars as $k)
                                <div><b>{{ $k->user->name }}</b>: {{ $k->isi }}</div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>