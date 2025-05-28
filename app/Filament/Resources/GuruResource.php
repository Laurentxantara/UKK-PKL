<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'bi-person-video3';
    protected static ?string $navigationLabel = 'Guru Pembimbing';
    protected static ?string $navigationGroup = 'Guru & Siswa';
    public static function getModelLabel(): string
    {
        return 'Guru Pembimbing';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Guru Pembimbing';
    }
    public static function getSlug(): string
    {
        return 'guru-pembimbing'; 
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Jumlah Pembimbing';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Section::make('Informasi Guru')
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
                                            ->imagePreviewHeight('200')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ])
                                            ->panelLayout('compact')
                                            ->directory('profile_guru')
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
                                                Forms\Components\TextInput::make('nip')
                                                    ->label('NIP')
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
                                        
                                ]),
                            ]),
                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Kosong')
            ->emptyStateIcon('bi-person-video3')
            ->emptyStateDescription('Belum ada Guru Pembimbing yang terdaftar')
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
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
