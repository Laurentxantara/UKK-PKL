<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndustriResource\Pages;
use App\Filament\Resources\IndustriResource\RelationManagers;
use App\Models\Industri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndustriResource extends Resource
{
    protected static ?string $model = Industri::class;

    protected static ?string $navigationIcon = 'bi-building';
    protected static ?string $navigationLabel = 'Industri';
    public static function getModelLabel(): string
    {
        return 'Industri';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Industri';
    }
    public static function getSlug(): string
    {
        return 'industri'; 
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\Section::make('Informasi Industri')
                    ->description('Harap diisi dengan benar')
                        ->schema([
                            Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('nama')
                                            ->label('Nama Industri')
                                            ->required()
                                            ->prefixIcon('bi-building-add')
                                            ->maxLength(255),
                                            Forms\Components\TextInput::make('bidang_usaha')
                                            ->label('Bidang Usaha')
                                            ->required()
                                            ->prefixIcon('bi-gear')
                                            ->maxLength(255),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('kontak')
                                                    ->label('No Telepon')
                                                    ->required()
                                                    ->prefixIcon('bi-telephone')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('email')
                                                    ->label('Email')
                                                    ->required()
                                                    ->prefixIcon('bi-envelope')
                                                    ->maxLength(255),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('alamat')
                                                    ->label('Alamat')
                                                    ->required()
                                                    ->prefixIcon('bi-map'),
                                                Forms\Components\TextInput::make('website')
                                                    ->label('Link Website')
                                                    ->prefixIcon('bi-link'),


                                            ]),
                                    ]),
                                     Forms\Components\FileUpload::make('logo')
                                            ->label('Logo Industri')
                                            ->image()
                                            ->disk('public')
                                            ->imagePreviewHeight('300')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ])
                                            // ->panelLayout('compact')
                                            ->directory('logo_industri')
                                            ->helperText('Maksimal ukuran foto 2MB')
                                            ->maxSize(2048),
                            ]),
                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Kosong')
            ->emptyStateIcon('bi-building')
            ->emptyStateDescription('Belum ada industri yang terdaftar')
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\ImageColumn::make('logo')
                            ->circular()
                            ->default('https://img.freepik.com/premium-vector/building-logo-vector-illustration-designreal-estate-logo-template-logo-symbol-icon_9999-19683.jpg')
                            ->size(100),
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\TextColumn::make('nama')
                                ->searchable()                        
                                ->size('sm')
                                ->weight('semibold'),
                            Tables\Columns\TextColumn::make('bidang_usaha')
                                ->color('gray')
                                ->searchable()
                                ->size('xs')
                                ->limit(20),
                            Tables\Columns\TextColumn::make('alamat')
                                ->size('xs')
                                ->limit(40),
                        ])
                    ])
                ])
            ])
              ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListIndustris::route('/'),
            'create' => Pages\CreateIndustri::route('/create'),
            'edit' => Pages\EditIndustri::route('/{record}/edit'),
        ];
    }
}
