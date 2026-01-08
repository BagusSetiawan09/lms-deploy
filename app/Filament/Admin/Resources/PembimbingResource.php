<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PembimbingResource\Pages;
use App\Filament\Admin\Resources\PembimbingResource\RelationManagers;
use App\Models\Pembimbing;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembimbingResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Kelola User';

    protected static ?string $navigationLabel = 'Pembimbing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', 'pembimbing');
                });
            })
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('email')
                    ->label('G-Mail'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPembimbings::route('/'),
            'create' => Pages\CreatePembimbing::route('/create'),
            'edit' => Pages\EditPembimbing::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        // Hitung jumlah user dengan role pembimbing
        return User::role('pembimbing')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
