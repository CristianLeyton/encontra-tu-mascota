<?php

namespace App\Filament\Resources\Breeds;

use App\Filament\Resources\Breeds\Pages\ManageBreeds;
use App\Filament\Resources\Species\SpeciesResource;
use App\Models\Breeds;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class BreedsResource extends Resource
{
    protected static ?string $model = Breeds::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocument;

    protected static ?string $modelLabel = 'raza';
    protected static ?string $pluralModelLabel = 'Razas';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Mascotas';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationParentItem = 'Especies';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->minLength(3)
                    ->maxLength(75)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'El nombre ya está en uso.',
                        'required' => 'El campo nombre es obligatorio.',
                        'max' => 'El campo nombre no debe exceder los :max caracteres.',
                        'min' => 'El campo nombre debe tener al menos :min caracteres.',
                    ]),
                Select::make('species_id')
                    ->relationship('species', 'name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->icon. ' ' . $record->name)
                    ->label('Especie')
                    ->required() 
                    ->preload()
                    ->native(false)
                    ->loadingMessage('Cargando especies...')
                    ->validationMessages([
                        'required' => 'El campo especie es obligatorio.',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('species_id')
                    ->label('Especie')
                    ->searchable()
                    ->formatStateusing(fn($record) => $record->species->name . ' ' . $record->species->icon)
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('deleted_at')
                    ->label('Eliminado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make(
                    'species_id' 
                )->label('Especie')->relationship('species', 'name')
            ])
            ->recordActions([
                EditAction::make()->button()->hiddenLabel()->extraAttributes([
                    'title' => 'Editar',
                ]),
                DeleteAction::make()->button()->hiddenLabel()->extraAttributes([
                    'title' => 'Eliminar',
                ]),
                ForceDeleteAction::make()->button()->hiddenLabel()->extraAttributes([
                    'title' => 'Eliminar permanentemente',
                ]),
                RestoreAction::make()->button()->hiddenLabel()->extraAttributes([
                    'title' => 'Restaurar',
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBreeds::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
