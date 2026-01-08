<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TugasSubmissionResource\Pages;
use App\Filament\Admin\Resources\TugasSubmissionResource\RelationManagers;
use App\Models\TugasSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TugasSubmissionResource extends Resource
{
    protected static ?string $model = TugasSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Tugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tugas_id')
                    ->required()
                    ->relationship('tugas','id'),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('user','name'),
                Forms\Components\FileUpload::make('file_path')
                    ->directory('submission')
                    ->nullable(),
                Forms\Components\Textarea::make('jawaban')
                    ->rows(3)
                    ->nullable(),
                Forms\Components\TextInput::make('nilai')
                    ->numeric()
                    ->minValue('0')
                    ->maxValue('100'),
                Forms\Components\Textarea::make('feedback')
                    ->rows(2)
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->options([
                        'submitted' => 'Submitted',
                        'graded' => 'Graded',
                    ])
                    ->default('submitted'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tugas.judul')->label('Tugas'),
                Tables\Columns\TextColumn::make('user.name')->label('Siswa'),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('nilai')->sortable(),
                Tables\Columns\TextColumn::make('feedback')->limit(30),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                 Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTugasSubmissions::route('/'),
            'create' => Pages\CreateTugasSubmission::route('/create'),
            'edit' => Pages\EditTugasSubmission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return TugasSubmission::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning'; 
    }
}
