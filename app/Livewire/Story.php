<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use App\Models\Cerita;
use App\Models\Komentar;

class Story extends Component
{
    use WithFileUploads;
    public $ceritabaru = false;
    public $judul, $cerita, $gambar, $memberterpilih, $komentar;

    public function pilihMember($id){
        $this->memberterpilih = $id;
    }

    public function simpanCerita(){
        $this->validate([
            'judul' => 'required',
            'cerita' => 'required',
            'gambar' => 'image|max:10000'
        ]);

        $this->gambar->store('gambar','public');

        $simpan = Cerita::create([
            'judul' => $this->judul,
            'isi' => $this->cerita,
            'foto' => $this->gambar->hashName(),
            'user_id' => auth()->id()
        ]);

        $this->reset();
    }

    public function simpanKomentar($id){
        $this->validate([
            'komentar' => 'required'
        ]);

        Komentar::create([
            'cerita_id' => $id,
            'isi' => $this->komentar,
            'user_id' => auth()->id()
        ]);

        $this->reset('komentar');
    }

    public function buatCeritaBaru(){
        $this->ceritabaru = true;
    }

    public function batal(){
        $this->reset();
    }

    public function render()
    {
        $semuamemberkecualisaya=User::all()->except(auth()->id());
        if($this->memberterpilih){
            $semuacerita=Cerita::with('user')->where('user_id', $this->memberterpilih)->get();
        }
        else {
            $semuacerita=Cerita::with('user')->where('user_id', auth()->id())->latest() ->get();
        }
        return view('livewire.story')->with([
            'semuamemberkecualisaya'=>$semuamemberkecualisaya,
            'semuacerita'=>$semuacerita
        ]);
    }
}
