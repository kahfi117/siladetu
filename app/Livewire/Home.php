<?php

namespace App\Livewire;

use App\Models\Complaint;
use Livewire\Component;

class Home extends Component
{
    public $title = 'Sistem Informasi Laporan Desa Terpadu';

    public function render()
    {
        return view('livewire.home');
    }

    public function getCountComplaint(string $status=null):int
    {
        if (!empty($status))
            return Complaint::count();
        else
            return Complaint::where('complaint_status',$status)->count();
    }

    public array $faqs = [
        [
            'question' => 'Apa aja sih yang bisa dilaporin di sini?',
            'answer' => 'Dari jalan rusak, lampu mati, sampai gorong-gorong drama – semua bisa!<br>Kalau mantan balikan sama sahabat? Hmm... itu mah urusan hati, bukan desa 😅'
        ],
        [
            'question' => 'Berapa lama aduan saya ditangani?',
            'answer' => 'Kalau bisa cepat, langsung dikerjain.Kalau agak lama, mungkin petugas lagi ngopi 😴 Tapi tenang, gak bakal zonk kok.'
        ],
        [
            'question' => 'Bisa lapor anonim gak?',
            'answer' => 'Bisa banget dong! Kaya gebetanmu yang suka diem-diem perhatian 🫣<br>Identitas kamu aman terkendali.'
        ],
        [
            'question' => 'Kenapa aduan saya belum ditanggapi?',
            'answer' => 'Bisa jadi petugas lagi:<br>- Panen padi 🌾<br>- Main ML sambil nunggu laporan masuk 🎮<br>Tapi tenang, aduanmu gak akan di ghosting kok.'
        ],
        [
            'question' => 'Gimana cara tahu aduan saya udah diproses?',
            'answer' => 'Tinggal cek di halaman "Cek Aduan Saya" Kalau statusnya <b>selesai</b>, tinggal senyum-senyum kayak dapet chat dari doi 💌'
        ],
        [
            'question' => 'Boleh pantun terakhir dong?',
            'answer' => '<b>Malam minggu duduk di teras, Lagi gabut buka aplikasi.<br>Kalau desa ingin terus cerdas, Yuk lapor, biar makin aspiratif dan transparansi!</b>'
        ],
    ];
}
