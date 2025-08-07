<?php

namespace App\Livewire;

use App\Models\Complaint;
use Livewire\Component;

class CekComplaint extends Component
{
    public $code;
    public $status;
    public $keterangan;
    public $found = false;
    public $error = false;
    public $data;

    public function cari()
    {
        sleep(2);
        $complaint = Complaint::where('code', strtoupper($this->code))->first() ?? false;
        // Contoh statis (bisa ganti dengan query ke database)
        if ($complaint) {
            $this->data = $complaint;
            $this->keterangan = 'Aduanmu lagi OTW diproses sama tim, sabar yaa 😇';
            $this->found = true;
        } else {
            $this->reset(['status', 'tanggal', 'keterangan']);
            $this->found = false;
            $this->error = true;
            session()->flash('error', 'Yah Kode tidak ditemukan 😢');
        }
    }
    public function render()
    {
        return view('livewire.cek-complaint');
    }
}
