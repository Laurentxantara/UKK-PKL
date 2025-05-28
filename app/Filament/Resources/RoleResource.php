<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'bi-shield-lock';
    protected static ?string $navigationGroup = 'Hak Akses';
    protected static ?string $navigationLabel = 'Role & Permission';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Role')
                    ->description('Harap diisi dengan benar')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Fieldset::make('Hak Akses')
                            ->schema([
                                Forms\Components\CheckboxList::make('permissions')
                                    ->label('Roles')
                                    ->columns(2)
                                    ->required()
                                    ->relationship('permissions', 'name'),
                                ]),
                        ]),
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Kosong')
            ->emptyStateIcon('bi-shield-lock')
            ->emptyStateDescription('Belum ada Role yang terdaftar')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->badge()
                    ->counts('permissions')
                    ->label('Permissions'),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
