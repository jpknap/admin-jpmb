<?php

namespace App\Projects\Landlord\Filament\Resources;

use App\Models\Tenant;
use App\Projects\Landlord\Filament\Resources\TenantResource\Pages\CreateTenant;
use App\Projects\Landlord\Filament\Resources\TenantResource\Pages\EditTenant;
use App\Projects\Landlord\Filament\Resources\TenantResource\Pages\ListTenants;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Stancl\Tenancy\Database\Models\Domain;

class TenantResource extends Resource
{
    protected static ?string $slug = 'tenant';

    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('domain')
                    ->label('Subdomain')
                    ->required()
                    ->maxLength(255)
                    ->unique(table: Domain::class, column: 'domain') // Evita duplicados en 'domains'
                    ->placeholder('Enter subdomain'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('domains.domain'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => ListTenants::route('/'),
            'create' => CreateTenant::route('/create'),
            'edit' => EditTenant::route('/{record}/edit'),
        ];
    }
}
