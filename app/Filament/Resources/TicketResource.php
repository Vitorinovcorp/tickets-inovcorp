<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('inbox_id')
                    ->relationship('inbox', 'nome')
                    ->required()
                    ->label('Departamento'),
                Forms\Components\TextInput::make('assunto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tipo_id')
                    ->relationship('tipo', 'nome')
                    ->required(),
                Forms\Components\RichEditor::make('mensagem')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('estado_id')
                    ->relationship('estado', 'nome')
                    ->required(),
                Forms\Components\Select::make('operador_associado_id')
                    ->relationship('operador', 'name')
                    ->label('Operador Responsável'),
                Forms\Components\Select::make('entidade_id')
                    ->relationship('entidade', 'nome')
                    ->required(),
                Forms\Components\Select::make('contacto_criador_id')
                    ->relationship('contacto', 'nome')
                    ->required()
                    ->label('Contacto Criador'),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_ticket')
                    ->searchable()
                    ->label('Nº Ticket'),
                Tables\Columns\TextColumn::make('assunto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('inbox.nome')
                    ->label('Departamento'),
                Tables\Columns\TextColumn::make('estado.nome')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('inbox_id')
                    ->relationship('inbox', 'nome')
                    ->label('Departamento'),
                Tables\Filters\SelectFilter::make('estado_id')
                    ->relationship('estado', 'nome'),
                Tables\Filters\SelectFilter::make('operador_associado_id')
                    ->relationship('operador', 'name'),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}