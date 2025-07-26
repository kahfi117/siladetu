<?php

namespace App\Filament\Resources;

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;
use App\Filament\Resources\ComplaintResource\Pages;
use App\Filament\Resources\ComplaintResource\RelationManagers;
use App\Models\Complaint;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use GalleryJsonMedia\Form\JsonMediaGallery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Kirschbaum\Commentions\Filament\Infolists\Components\CommentsEntry;
use App\Models\User;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $label = 'Pengaduan';

    public static function form(Form $form): Form
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
                                    ->createOptionForm(static::getTypeForm())
                                    ->createOptionAction(function (Action $action){
                                        return $action
                                            ->modalHeading('Buat Tipe Aduan')
                                            ->modalSubmitActionLabel('Buat')
                                            ->modalWidth('lg');
                                    }),

                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->label('Aduan')
                                    ->hintIcon(static::getHintIcon(),'Jelaskan Aduan Anda Disini')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('location')
                                    ->required()
                                    ->label('Lokasi')
                                    ->columnSpanFull(),

                                Forms\Components\Section::make('Foto Pendukung')
                                    ->relationship('complaintFiles')
                                    ->schema([
                                        JsonMediaGallery::make('path')
                                            ->directory('Aduan')
                                            ->hiddenLabel()
                                            ->downloadable()
                                            ->reorderable()
                                            ->preserveFilenames()
                                            ->visibility('public') // only public for now - NO S3
                                            ->maxSize(4 * 1024)
                                            ->replaceNameByTitle() // If you want to show title (alt customProperties) against file name
                                            ->image() // only images by default , u need to choose one (images or document)
                                            ->downloadable()
                                            ->deletable()
                                            // ->multiple()
                                            ->image()
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
                                    ->hintIcon(static::getHintIcon(),'Centang Jika Ingin Melapor Sebagai Anonim')
                                    ->label('Anonim')
                                    ->inline(false),

                                Forms\Components\Select::make('assigned_to')
                                    ->relationship('assignedTo', 'name')
                                    ->visibleOn('edit')
                                    ->label('Ditugaskan Kepada'),
                        ])
                        ->columnSpan(1)
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('complainant')
                    ->searchable(),
                Tables\Columns\IconColumn::make('anonim')
                    ->boolean(),
                Tables\Columns\TextColumn::make('complaintType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('complaint_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('complaint_prorities')
                    ->searchable(),
                Tables\Columns\TextColumn::make('assigned_to')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaint::route('/create'),
            'view' => Pages\ViewComplaint::route('/{record}'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getTypeForm():array{
        return [
            Forms\Components\TextInput::make('name')
                ->label('Nama'),

        ];
    }

    public static function getHintIcon() :string {
        return 'heroicon-m-question-mark-circle';
    }

}
