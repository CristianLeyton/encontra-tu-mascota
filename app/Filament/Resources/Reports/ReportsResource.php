<?php

namespace App\Filament\Resources\Reports;

use App\Filament\Resources\Reports\Pages\ManageReports;
use App\Models\Reports;
use App\Models\User;
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
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class ReportsResource extends Resource
{
    protected static ?string $model = Reports::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static ?string $modelLabel = 'reporte';
    protected static ?string $pluralModelLabel = 'Reportes';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Mascotas';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('post_id')
                    ->label('Publicación')
                    ->required()
                    ->relationship('post', 'title')
                    ->searchable()
                    ->preload()
                    ->disabledOn('edit'),
                TextInput::make('user_id')
                    ->label('Creado por')
                    ->disabledOn('edit')
                    ->readOnly()
                    ->default(fn($state, $record) => $record->user_id ?? Auth::user()->id)
                    ->formatStateUsing(fn($state, $record) => $record->user->name ?? Auth::user()->name)
                    ->dehydrateStateUsing(fn($state) => $state->id ?? Auth::user()->id),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title')
                    ->label('Publicación')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Creado por')
                    ->sortable()
                    ->searchable()
                    ->default('Anónimo')
                    ->badge()
                    ->color(fn($state, $record) => $record->user ? 'primary' : 'info')
                    ->icon(Heroicon::OutlinedUser),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                /*                 EditAction::make()->button()->hiddenLabel()->extraAttributes([
                    'title' => 'Editar',
                ]), */
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
            'index' => ManageReports::route('/'),
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
