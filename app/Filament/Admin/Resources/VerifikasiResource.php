<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Verifikasi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Admin\Resources\VerifikasiResource\Pages;

class VerifikasiResource extends Resource
{
    protected static ?string $model = Verifikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationGroup = 'Kelola User';
    protected static ?string $navigationLabel = 'Verifikasi Peserta';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('nama_pembimbing')->required(),
                Select::make('role')
                    ->options([
                        'user' => 'User',
                        'admin' => 'Admin',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('email')->label('Email')->copyable(),
                TextColumn::make('nama_pembimbing')->label('Nama Pembimbing'),
                TextColumn::make('role')->label('Role'),
            ])
            ->actions([
                Action::make('acc')
                    ->label('Terima')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Verifikasi $record) {
                        // Pindahkan ke tabel users
                        $user = User::create([
                            'name'            => $record->name,
                            'email'           => $record->email,
                            'nama_pembimbing' => $record->nama_pembimbing,
                            'password'        => $record->password_plain,
                        ]);

                        // Assign role
                        $user->assignRole($record->role ?? 'user');

                        // Hapus dari verifikasi
                        $record->delete();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Action::make('bulkAcc')
                        ->label('ACC Terpilih')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $user = User::create([
                                    'name'            => $record->name,
                                    'email'           => $record->email,
                                    'nama_pembimbing' => $record->nama_pembimbing,
                                    'password'        => $record->password_plain,
                                ]);

                                $user->assignRole($record->role ?? 'user');

                                $record->delete();
                            }
                        }),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerifikasis::route('/'),
            'create' => Pages\CreateVerifikasi::route('/create'),
            'edit' => Pages\EditVerifikasi::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return Verifikasi::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning'; 
    }
}
