<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Video;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\VideoResource\Pages;
use App\Filament\Admin\Resources\VideoResource\RelationManagers;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required(),
                TextInput::make('youtube_url')
                    ->label('YouTube URL (untuk thumbnail)')
                    ->required()
                    ->url(),


                // Part video (bisa banyak)
                Repeater::make('parts')
                    ->relationship()
                    ->schema([
                        TextInput::make('title')->required(),
                        TextInput::make('youtube_url')
                            ->label('YouTube URL Part')
                            ->required()
                            ->url(),
                    ])
                    ->createItemButtonLabel('Tambah Part')
                    ->columns(2)
                    ->minItems(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->label('Judul'),
                TextColumn::make('youtube_url')
                    ->label('YouTube'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Video::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
