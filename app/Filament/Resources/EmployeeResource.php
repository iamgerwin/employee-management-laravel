<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Employee Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                    Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name')
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        $set('state_id', null);
                        $set('city_id', null);
                        $set('zone_id', null);
                    }),
                
                Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
                    ->options(function (Forms\Get $get) {
                        return \App\Models\State::query()
                            ->where('country_id', $get('country_id'))
                            ->pluck('name', 'id');
                    })
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        $set('city_id', null);
                        $set('zone_id', null);
                    }),
                
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->options(function (Forms\Get $get) {
                        return \App\Models\City::query()
                            ->where('state_id', $get('state_id'))
                            ->pluck('name', 'id');
                    })
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        $set('zone_id', null);
                    }),
                
                Forms\Components\Select::make('zone_id')
                    ->relationship('zone', 'name')
                    ->options(function (Forms\Get $get) {
                        return \App\Models\Zone::query()
                            ->where('city_id', $get('city_id'))
                            ->pluck('name', 'id');
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zone.name')
                    ->label('Zone'),
                Tables\Columns\TextColumn::make('departments.name')
                    ->label('Departments')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
