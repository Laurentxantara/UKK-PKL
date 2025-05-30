<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;


class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'bi-book';
    protected static ?string $navigationLabel = 'Siswa SIJA';
    protected static ?string $navigationGroup = 'Guru & Siswa';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Jumlah Siswa';
    }
    public static function getPluralModelLabel(): string
    {
        return 'Siswa';
    }
    public static function getSlug(): string
    {
        return 'siswa'; 
    }
    


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Siswa')
                    ->description('Harap diisi dengan benar')
                        ->schema([
                            Forms\Components\Grid::make(2)
                            ->schema([
                                 Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\FileUpload::make('avatar')
                                            ->label('Foto Profil')
                                            ->image()
                                            ->disk('public')
                                            ->directory('profile_siswa')
                                            ->imagePreviewHeight('200')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ])
                                            ->panelLayout('compact')
                                            ->helperText('Maksimal ukuran foto 2MB')
                                            ->maxSize(2048),
                                    ]),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('nama')
                                            ->label('Nama')
                                            ->prefixIcon('bi-person')
                                            ->required(),

                                        Forms\Components\TextInput::make('email')
                                            ->label('Email')
                                            ->prefixIcon('bi-envelope-check')
                                            ->email()
                                            ->required(),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('nis')
                                                    ->label('NIS')
                                                    ->prefixIcon('bi-person-badge')
                                                    ->required(),
                                                    Forms\Components\Select::make('gender')
                                                    ->options([
                                                        'L' => 'Laki-laki',
                                                        'P' => 'Perempuan',
                                                    ])
                                                    ->placeholder('Pilih Gender')
                                                    ->label('Gender')
                                                    ->prefixIcon('bi-gender-ambiguous')
                                                    ->required()
                                            ]),

                                    ]),
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('kontak')
                                            ->label('Kontak')
                                            ->prefixIcon('bi-telephone'),
                                        Forms\Components\TextInput::make('alamat')
                                            ->label('Alamat')
                                            ->prefixIcon('bi-map'),
                                        Forms\Components\ToggleButtons::make('status_pkl')
                                            ->options([
                                                'diterima' => 'Diterima',
                                                'kosong' => 'Kosong',
                                            ])
                                            ->icons([
                                                'diterima' => 'bi-check-circle',
                                                'kosong' => 'bi-dash-circle',
                                            ])
                                            ->colors([
                                                'diterima' => 'primary',
                                                'kosong' => 'gray',
                                            ])
                                            ->default('kosong')
                                            ->label('Status PKL')
                                            ->inline()
                                            ->required()
                                            ->disabled()
                                           
                                ]),
                            ]),
                            
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Kosong')
            ->emptyStateIcon('bi-book')
            ->emptyStateDescription('Belum ada SIswa yang terdaftar')
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('')
                    ->circular()
                    ->size(35)
                    ->default('https://thumbs.dreamstime.com/b/default-avatar-profile-icon-social-media-user-vector-image-icon-default-avatar-profile-icon-social-media-user-vector-image-209162840.jpg'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->formatStateUsing(fn ($state) => DB::selectOne("SELECT getGenderName(?) AS gender", [$state])->gender)
                    ->sortable(),
                Tables\Columns\TextColumn::make('nis')
                    ->label('NIS')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status_pkl')
                    ->label('Status PKL')
                    ->boolean()
                    ->trueIcon('bi-check-circle')
                    ->falseIcon('bi-dash-circle')
                    ->trueColor('primary')
                    ->falseColor('gray')
                    ->size('md')
                    ->alignCenter()
                    ->getStateUsing(fn ($record) => $record->status_pkl === 'diterima'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                // Tables\Actions\DeleteBulkAction::make()
                    
            ])
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
