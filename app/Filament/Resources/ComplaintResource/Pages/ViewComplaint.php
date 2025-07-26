<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
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
                        Infolists\Components\Section::make('Komenentar')
                            ->schema([

                                CommentsEntry::make('comments')
                                    ->mentionables(fn (Model $record) => User::all()),
                            ])->columnSpan(1),

                    ])
                    ->columns(3)
                ]);
    }
}
