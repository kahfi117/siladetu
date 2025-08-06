<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class EditComplaint extends EditRecord
{
    protected static string $resource = ComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            // Actions\ForceDeleteAction::make(),
            // Actions\RestoreAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
                return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([

                                Forms\Components\Placeholder::make('code')
                                    ->content(fn ($record) => $record->code)
                                    ->label('Kode'),

                                Forms\Components\Placeholder::make('subject')
                                    ->content(fn ($record): mixed => $record->subject)
                                    ->label('Subjek Pengaduan'),

                                Forms\Components\Placeholder::make('complainant')
                                    ->content(fn ($record): mixed => $record->complainant)
                                    ->label('Nama Pengadu'),

                                Forms\Components\Placeholder::make('complaint_type_id')
                                    ->content(fn (Model $record): string => $record->complaintType->name)
                                    ->label('Jenis Pengaduan'),

                                Forms\Components\Fieldset::make('Aduan')
                                    ->schema([
                                        Forms\Components\Placeholder::make('description')
                                            ->content(fn (Complaint $record): HtmlString => new HtmlString($record->description))
                                            ->label('Aduan')
                                            ->hiddenlabel()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('location')
                                    // ->required()
                                    ->readonly()
                                    ->label('Lokasi')
                                    ->columnSpanFull(),

                                Forms\Components\Section::make('Foto Pendukung')
                                    ->schema([
                                        Forms\Components\FileUpload::make('proof_of_complaint')
                                            ->directory('Bukti')
                                            ->multiple()
                                            ->deletable(false)
                                            ->openable()
                                            ->hiddenLabel()
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
                                    ->live()
                                    ->options(StatusEnum::class)
                                    ->default('new'),

                                Forms\Components\ToggleButtons::make('complaint_prorities')
                                    ->required()
                                    ->inline()
                                    ->label('Prioritas Aduan')
                                    ->options(PriorityEnum::class)
                                    ->default('low'),

                                Forms\Components\Toggle::make('anonim')
                                    // ->hintIcon(static::getHintIcon(),'Centang Jika Ingin Melapor Sebagai Anonim')
                                    ->label('Anonim')
                                    ->inline(false),

                                Forms\Components\Select::make('assigned_to')
                                    // ->relationship('assignedTo', 'name')
                                    ->options(User::whereHas('roles',
                                        function (Builder $query){
                                            return $query->where('name', 'ilike','petugas');
                                        })
                                    ->get()->pluck('name', 'id'))
                                    ->label('Ditugaskan Kepada')
                                    ->searchable()
                                    ->required(fn(Get $get, Model $record):bool =>
                                        $get('complaint_status') == 'assigned' ? true : false
                                    ),
                                ])
                        ->columnSpan(1)
                    ])
                    ->columns(3)
            ]);
    }
}
