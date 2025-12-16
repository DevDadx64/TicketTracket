<?php

namespace App\Filament\Resources\Tickets\Schemas;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(120) // Match DB Migration
                    ->columnSpanFull(),

                Select::make('status')
                    ->required()
                    ->options(TicketStatus::class)
                    ->default(TicketStatus::Open)
                    ->native(false),

                Select::make('priority')
                    ->required()
                    ->options(TicketPriority::class)
                    ->default(TicketPriority::Normal)
                    ->native(false),

                TextInput::make('assigned_to_user_id')
                    ->label('Assigned to')
                    ->relationship('assignedTo', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->native(false),
            ]);
    }
}
