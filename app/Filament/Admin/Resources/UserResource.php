<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use PharIo\Manifest\Author;
use PhpParser\Node\Stmt\Label;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Filament\Admin\Resources\UserResource\Pages\ListUsers;
use App\Filament\Admin\Resources\UserResource\Pages\CreateUser;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use function Laravel\Prompts\select;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Kelola User';

    protected static ?string $navigationLabel = 'Peserta Magang';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama'),
                Select::make('nama_pembimbing')
                    ->label('Pembimbing')
                    ->options(
                        User::where('role','pembimbing')->pluck('name','name')
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', 'user');
                });
            })
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama')
                    ->copyable(),
                TextColumn::make('email')
                    ->label('G-Mail')
                    ->copyable(),
                TextColumn::make('nama_pembimbing')
                    ->label('Nama Pembimbing')
                    ->badge(),
                
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        // Hitung jumlah user dengan role pembimbing
        return User::role('user')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
