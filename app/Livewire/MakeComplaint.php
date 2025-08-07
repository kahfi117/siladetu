<?php

namespace App\Livewire;

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;
use App\Filament\Resources\ComplaintResource;
use App\Models\Complaint;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class MakeComplaint extends Component implements HasForms
{
    use InteractsWithForms;

    public bool $success = false;
    public string $successMessage = '';
    public string $codeComplaint = '';
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }
    public function render()
    {
        return view('livewire.make-complaint');
    }

    public function form(Form $form) :Form
    {
        return $form
            ->model(Complaint::class)
            ->columns(4)
            ->statePath('data')
            ->schema([
                TextInput::make('subject')
                    ->required()
                    ->columnSpan(2)
                    ->label('Subjek Pengaduan'),

                TextInput::make('complainant')
                    ->columnSpan(2)
                    ->label('Nama Pengadu'),

                Select::make('complaint_type_id')
                    ->relationship('complaintType', 'name')
                    ->required()
                    ->columnSpan(2)
                    ->native(false)
                    ->label('Jenis Pengaduan'),

                Toggle::make('anonim')
                    ->hintIcon(ComplaintResource::getHintIcon(),'Centang Jika Ingin Melapor Sebagai Anonim')
                    ->label('Anonim')
                    ->onColor('info')
                    ->offIcon('heroicon-m-x-circle')
                    ->onIcon('heroicon-m-check-circle')
                    ->inline(false),

                ToggleButtons::make('complaint_prorities')
                    ->required()
                    ->inline()
                    ->label('Prioritas Aduan')
                    ->options(PriorityEnum::class)
                    ->default(PriorityEnum::LOW),

                Textarea::make('description')
                    ->columnSpan(2)
                    ->label('Rincian Aduan'),

                Textarea::make('location')
                    ->columnSpan(2)
                    ->label('Lokasi Kejadian'),

                FileUpload::make('proof_of_complaint')
                    ->directory('Bukti')
                    ->label('Bukti')
                    ->columnSpanFull()
                    ->multiple()

            ]);
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $data['complaint_status'] = 'new';
        $data['code'] = Complaint::generateUniqueCode();

        $complaint = Complaint::create($data);

        $this->success = true;
        $this->successMessage = $complaint->subject;
        $this->codeComplaint = $complaint->code;

        $this->form->fill();

    }
}
