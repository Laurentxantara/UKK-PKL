<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\Page;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'bi-person';
    protected static ?string $navigationGroup = 'Hak Akses';
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Jumlah User';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi User')
                    ->description('Harap diisi dengan benar')
                        ->schema([
                            Forms\Components\Grid::make(2)
                            ->schema([
                                 Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\FileUpload::make('profile')
                                            ->label('Foto Profil')
                                            ->image()
                                            ->disk('public')
                                            ->imagePreviewHeight('200')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ])
                                            ->panelLayout('compact')
                                            ->directory('profile_user')
                                            ->helperText('Maksimal ukuran foto 2MB')
                                            ->maxSize(2048),
                                    ]),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama')
                                            ->prefixIcon('bi-person')
                                            ->required(),

                                        Forms\Components\TextInput::make('email')
                                            ->label('Email')
                                            ->prefixIcon('bi-envelope-check')
                                            ->email()
                                            ->required(),
                                    ]),
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('password')
                                            ->label('Password')
                                            ->prefixIcon('bi-key')
                                            ->password()
                                            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->required(fn (Page $livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),

                                         Forms\Components\Select::make('roles')
                                            ->label('Roles')
                                            ->placeholder('kosong')
                                            ->relationship('roles', 'name')
                                            ->preload()
                                            ->prefixIcon('bi-shield-lock')
                                            // ->required()
                                        ]),
                            ]),
                            
                    ]),
                    
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Kosong')
            ->emptyStateIcon('bi-person')
            ->emptyStateDescription('Belum ada User yang terdaftar')
            ->columns([
                Tables\Columns\ImageColumn::make('profile')
                    ->label('')
                    ->circular()
                    ->size(35)
                    ->default('https://thumbs.dreamstime.com/b/default-avatar-profile-icon-social-media-user-vector-image-icon-default-avatar-profile-icon-social-media-user-vector-image-209162840.jpg'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'guru' => 'warning',
                        'siswa' => 'success',
                    })
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
