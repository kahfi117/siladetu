<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Models\ComplaintNote;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Infolist;
use GalleryJsonMedia\Infolists\JsonMediaEntry;
use Illuminate\Support\HtmlString;
use Kirschbaum\Commentions\Filament\Infolists\Components\CommentsEntry;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class ViewComplaint extends ViewRecord
{
    protected static string $resource = ComplaintResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make()
                    ->schema([
                        Infolists\Components\Section::make('Informasi Pengaduan')
                            ->collapsible()
                            ->schema([
                                Infolists\Components\TextEntry::make('anonim')
                                    ->badge()
                                    ->formatStateUsing(fn(bool $state) : HtmlString => new HtmlString('Aduan Anonim'))
                                    ->icon('heroicon-o-users')
                                    ->color('danger')
                                    ->hiddenLabel()
                                    ->inlineLabel()
                                    ->visible(fn(bool $state):bool=> $state),
                                Infolists\Components\TextEntry::make('code')
                                    ->label('Kode')
                                    ->icon('heroicon-o-qr-code')
                                    ->copyable()
                                    ->inlineLabel(),
                                Infolists\Components\TextEntry::make('subject')
                                    ->label('Subjek Pengaduan')
                                    ->inlineLabel(),
                                Infolists\Components\TextEntry::make('complainant')
                                    ->label('Nama Pengadu')
                                    ->inlineLabel()
                                    ->icon('heroicon-o-user'),
                                Infolists\Components\TextEntry::make('complaintType.name')
                                    ->label('Tipe Pengauduan')
                                    ->inlineLabel(),
                                Infolists\Components\TextEntry::make('location')
                                    ->label('Lokasi')
                                    ->inlineLabel(),
                                Infolists\Components\TextEntry::make('description')
                                    ->html()
                                    ->inlineLabel()
                                    ->label('Deskripsi Aduan')
                            ])
                            ->columnSpan(2),
                        Infolists\Components\Section::make('Komentar')
                            ->schema([
                                CommentsEntry::make('comments')
                                    ->mentionables(fn (Model $record) => User::all()),
                            ])->columnSpan(1),

                        Infolists\Components\Section::make('Catatan Petugas')
                            ->headerActions([

                                Infolists\Components\Actions\Action::make('noted_petugas')
                                    ->label('Buat Catatan')
                                    ->form([
                                        Textarea::make('note')
                                            ->required()
                                            ->label('Catatan'),
                                        FileUpload::make('file')
                                            ->label('File Catatan'),
                                    ])
                                    ->action(function (array $data, Complaint $record) {
                                        $data['created_by'] = auth()->id();
                                        $data['complaint_id'] = $record->id;
                                        $note = new ComplaintNote;

                                        $note->create($data);
                                    }),

                            ])
                            ->schema([

                                Infolists\Components\RepeatableEntry::make('complaintNotes')
                                    ->label('Catatan Petugas')
                                    ->hiddenLabel()
                                    ->schema([
                                        Infolists\Components\TextEntry::make('created_at')
                                            ->since()
                                            ->dateTimeTooltip()
                                            ->badge()
                                            ->label('Dibuat')
                                            ->inlineLabel(),

                                        Infolists\Components\TextEntry::make('note')
                                            ->label('Catatan Petugas')
                                            ->words(10)
                                            ->inlineLabel(),

                                        Infolists\Components\ImageEntry::make('file')
                                            ->label('File Catatan')
                                            ->inlineLabel(),

                                    ])
                                    ->contained(true)
                            ])
                            ->columnSpanFull(),

                        Infolists\Components\Section::make('Bukti Aduan')
                            ->collapsed()
                            ->schema([
                                \Rupadana\FilamentSwiper\Infolists\Components\SwiperImageEntry::make('proof_of_complaint')
                                    ->navigation(true)
                                    ->pagination()
                                    ->paginationClickable()
                                    ->paginationDynamicBullets()
                                    ->paginationHideOnClick()
                                    ->paginationDynamicMainBullets(2)
                                    ->height(600)
                                    ->autoplay()
                                    ->centeredSlides()
                                    ->slidesPerView(2)
                            ])->columnSpanFull()

                    ])
                    ->columns(3)
                ]);
    }
}
