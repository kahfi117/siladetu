<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;
use App\Filament\Resources\ComplaintResource;
use App\Models\Complaint;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateComplaint extends CreateRecord
{
    protected static string $resource = ComplaintResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([

                                Forms\Components\TextInput::make('code')
                                    ->required()
                                    ->label('Kode')
                                    ->unique(Complaint::class, 'code', ignoreRecord: true)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('subject')
                                    ->label('Subjek Pengaduan')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('complainant')
                                    ->maxLength(255)
                                    ->label('Nama Pengadu'),

                                Forms\Components\Select::make('complaint_type_id')
                                    ->relationship('complaintType', 'name')
                                    ->required()
                                    ->label('Jenis Pengaduan')
                                    ->createOptionForm(ComplaintResource::getTypeForm())
                                    ->createOptionAction(function (Action $action){
                                        return $action
                                            ->modalHeading('Buat Tipe Aduan')
                                            ->modalSubmitActionLabel('Buat')
                                            ->modalWidth('lg');
                                    }),

                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->label('Aduan')
                                    ->hintIcon(ComplaintResource::getHintIcon(),'Jelaskan Aduan Anda Disini')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('location')
                                    ->required()
                                    ->label('Lokasi')
                                    ->columnSpanFull(),

                                Forms\Components\Section::make('Foto Pendukung')
                                    ->schema([
                                        Forms\Components\FileUpload::make('proof_of_complaint')
                                            ->directory('Bukti')
                                            ->multiple()
                                    ])

                            ])
                            ->columns(2)
                            ->columnSpan(2),

                        Forms\Components\Section::make()
                            ->schema([

                                Forms\Components\ToggleButtons::make('complaint_status')
                                    ->required()
                                    ->inline()
                                    ->label('Status Aduan')
                                    ->options(StatusEnum::class)
                                    ->default('new'),

                                Forms\Components\ToggleButtons::make('complaint_prorities')
                                    ->required()
                                    ->inline()
                                    ->label('Prioritas Aduan')
                                    ->options(PriorityEnum::class)
                                    ->default('low'),

                                Forms\Components\Toggle::make('anonim')
                                    ->hintIcon(ComplaintResource::getHintIcon(),'Centang Jika Ingin Melapor Sebagai Anonim')
                                    ->label('Anonim')
                                    ->inline(false),
                        ])
                        ->columnSpan(1)
                    ])
                    ->columns(3)
            ]);
    }
}
