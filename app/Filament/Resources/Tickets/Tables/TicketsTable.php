<?php

namespace App\Filament\Resources\Tickets\Tables;

use App\Enums\TicketStatus;
use App\Enums\TicketPriority;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['assignedTo', 'createdBy', 'updatedBy']))

            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('priority')
                    ->badge()
                    ->sortable(),

                TextColumn::make('assignedTo.name')
                    ->label('Assigned to')
                    ->sortable()
                    ->placeholder('Unassigned'),

                TextColumn::make('createdBy.name')
                    ->label('Created by')
                    ->sortable(),

                TextColumn::make('updatedBy.name')
                    ->label('Updated by')
                    ->sortable()
                    ->placeholder('--'),

                TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options(TicketStatus::class),
                SelectFilter::make('priority')->options(TicketPriority::class),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
