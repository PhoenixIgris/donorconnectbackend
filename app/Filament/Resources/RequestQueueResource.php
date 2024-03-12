<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\RequestQueueResource\Pages;
use App\Filament\Resources\RequestQueueResource\RelationManagers;
use App\Models\RequestQueue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestQueueResource extends Resource
{
    protected static ?string $model = RequestQueue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('post_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('position')
                    ->numeric(),
                Forms\Components\TextInput::make('queue_code'),
                Forms\Components\Select::make('status')
                ->options([
                    Status::UNVERIFIED => Status::UNVERIFIED,
                    Status::VERIFIED => Status::VERIFIED,
                    Status::REQUESTED => Status::REQUESTED,
                    Status::PENDING_REQUEST => Status::PENDING_REQUEST,
                    Status::CLOSED => Status::CLOSED
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('post_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('position')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('queue_code')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        Status::UNVERIFIED => Status::UNVERIFIED,
                        Status::VERIFIED => Status::VERIFIED,
                        Status::REQUESTED => Status::REQUESTED,
                        Status::PENDING_REQUEST => Status::PENDING_REQUEST,
                        Status::CLOSED => Status::CLOSED
                    ])
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
            'index' => Pages\ListRequestQueues::route('/'),
            'create' => Pages\CreateRequestQueue::route('/create'),
            'edit' => Pages\EditRequestQueue::route('/{record}/edit'),
        ];
    }
}
