<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PKLResource\Pages;
use App\Filament\Resources\PKLResource\RelationManagers;
use App\Models\Rekrutpkl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Carbon\Carbon;

class PKLResource extends Resource
{
    protected static ?string $model = Rekrutpkl::class;

    protected static ?string $navigationIcon = 'bi-journal-text';
    protected static ?string $navigationLabel = 'Laporan PKL';
    public static function getModelLabel(): string
    {
        return 'Laporan PKL';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Laporan PKL';
    }
    public static function getSlug(): string
    {
        return 'laporan-pkl'; 
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Laporan')
                    ->description('Harap diisi dengan benar')
                        ->schema([
                              Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Group::make()
                                        ->schema([
                                            Forms\Components\Select::make('id_siswa')
                                                ->label('Siswa')
                                                ->relationship('siswa', 'nama')
                                                ->placeholder('Pilih Siswa')
                                                // ->searchable()
                                                ->required(),
                                                
                                                Forms\Components\Select::make('id_guru')
                                                ->label('Guru Pembimbing')
                                                ->placeholder('Pilih Guru Pembimbing')
                                                ->relationship('guru', 'nama')
                                                // ->searchable()
                                                ->required(),
                                            ]),
                                            Forms\Components\Group::make()
                                            ->schema([
                                                Forms\Components\Select::make('id_industri')
                                                ->label('Industri')
                                                ->placeholder('Pilih Industri')
                                                ->relationship('industri', 'nama')
                                                // ->searchable()
                                                ->required(),
                                            Forms\Components\Grid::make(2)
                                                ->schema([
                                                    Forms\Components\DatePicker::make('tanggal_mulai')
                                                        ->label('Tanggal Mulai PKL')
                                                        ->timezone('Asia/Jakarta')
                                                        ->required(),
                                                        Forms\Components\DatePicker::make('tanggal_selesai')
                                                        ->label('Tanggal Selesai PKL')
                                                        ->timezone('Asia/Jakarta')
                                                        ->required(),
                                                ]),
                                        ]),
                                    ]),
                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Kosong')
            ->emptyStateIcon('bi-journal-text')
            ->emptyStateDescription('Belum ada Laporan')
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru Pembimbing')
                    ->searchable(),
                Tables\Columns\TextColumn::make('industri.nama')
                    ->label('Industri')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Durasi')
                    ->getStateUsing(function ($record) {
                        if (!$record->tanggal_mulai) return '-';
                        
                        $start = Carbon::parse($record->tanggal_mulai);
                        $end = $record->tanggal_selesai 
                            ? Carbon::parse($record->tanggal_selesai)
                            : Carbon::now();
                            
                        return $start->diffInDays($end) . ' hari' . 
                            (!$record->tanggal_selesai ? ' (masih berjalan)' : '');
                    })
                    ->alignCenter()
                    ->color(fn ($record) => 
                        !$record->tanggal_selesai ? 'success' : null
                    )
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPKLS::route('/'),
            'create' => Pages\CreatePKL::route('/create'),
            'edit' => Pages\EditPKL::route('/{record}/edit'),
        ];
    }
}
