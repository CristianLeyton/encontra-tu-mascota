<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\ManagePosts;
use App\Models\Breeds;
use App\Models\Images;
use App\Models\Posts;
use App\Models\Species;
use App\Models\User;
use BackedEnum;
use DragonCode\PrettyArray\Services\File;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use UnitEnum;


class PostsResource extends Resource
{
    protected static ?string $model = Posts::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $modelLabel = 'publicación';
    protected static ?string $pluralModelLabel = 'Publicaciones';
    protected static bool $hasTitleCaseModelLabel = false;
    protected static string | UnitEnum | null $navigationGroup = 'Mascotas';
    protected static ?int $navigationSort = 1;



    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->helperText('Si sabes el nombre, colocalo aquí. Si no, una descripción corta de la mascota será suficiente.')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3)
                    ->unique()
                    ->validationMessages([
                        'unique' => 'Ya existe una publicación con ese título',
                        'required' => 'Debes ingresar un título',
                        'min' => 'El título debe tener al menos :min caracteres',
                        'max' => 'El título no puede tener más de :max caracteres',
                    ]),
                Select::make('is_missing')
                    ->label('Estado')
                    ->helperText('¿Perdiste o encontraste una mascota?')
                    ->required()
                    ->boolean()
                    ->options([
                        true => 'Perdido',
                        false => 'Encontrado'
                    ])->default(true)
                    ->native(false)
                    ->validationMessages([
                        'required' => 'Debes seleccionar una opción'
                    ]),
                Toggle::make('is_published')
                    ->label('Publicado')
                    ->aboveLabel('Publicar post en el sitio')
                    ->default(true)
                    ->required(),
                Toggle::make('is_resolved')
                    ->aboveLabel('Marcar como resuelto')
                    ->label('Resuelto')
                    ->default(false)
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3)
                    ->validationMessages([
                        'required' => 'Debes ingresar un título',
                        'min' => 'El título debe tener al menos :min caracteres',
                        'max' => 'El título no puede tener más de :max caracteres',
                    ])
                    ->helperText('Descripción larga de la mascota.'),
                FileUpload::make('images')
                    ->label('Imágenes')
                    ->multiple()
                    ->maxFiles(6)
                    ->image()
                    ->reorderable()
                    ->appendFiles()
                    ->panelLayout('grid')
                    ->directory('posts/images')
                    ->validationMessages([
                        'image' => 'Debes seleccionar una imagen',
                        'max' => 'Debes seleccionar :max imágenes',
                    ]),
                DatePicker::make('date')
                    ->label('Fecha')
                    ->required()
                    ->validationMessages([
                        'required' => 'Debes seleccionar una fecha',
                    ])
                    ->helperText('Coloca la fecha en la que perdiste o encontraste esta mascota.'),
                TextInput::make('location')
                    ->label('Ubicación aproximada')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3)
                    ->placeholder('Ej: Plaza 9 de Julio, Zuviria y Av. Belgrano')
                    ->validationMessages([
                        'required' => 'Debes ingresar una ubicación',
                        'min' => 'La ubicación debe tener al menos :min caracteres',
                        'max' => 'La ubicación no puede tener más de :max caracteres',
                    ])
                    ->helperText('Coloca la ubicación aproximada donde perdiste o encontraste esta mascota. No coloques números de casas. '),
                Select::make('species_id')
                    ->relationship('species', 'name')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->icon . ' ' . $record->name)
                    ->label('Especie')
                    ->required()
                    ->preload()
                    ->reactive() // 🔑 Hace que Filament "escuche" cambios 
                    ->validationMessages([
                        'required' => 'Debes seleccionar una especie',
                    ])
                    ->afterStateUpdated(fn(callable $set) => $set('breed_id', null)),

                Select::make('breed_id')
                    ->label('Raza')
                    ->options(function (callable $get) {
                        $speciesId = $get('species_id');
                        if (! $speciesId) {
                            return [];
                        }
                        return Breeds::where('species_id', $speciesId)
                            ->orderBy('name')
                            ->pluck('name', 'id');
                    })
                    ->disabled(fn(callable $get) => !$get('species_id'))
                    ->createOptionUsing(function (array $data, callable $get) {
                        $speciesId = $get('species_id');
                        if (!$speciesId) {
                            return null;
                        }
                        return Breeds::create([
                            'name' => $data['name'],
                            'species_id' => $speciesId,
                        ])->id;
                    })
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Nombre de la raza')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Debes ingresar un nombre de raza',
                                'max' => 'El nombre de la raza no puede tener más de :max caracteres',
                                'min' => 'El nombre de la raza debe tener al menos :min caracteres',
                            ]),
                    ])
                    ->createOptionAction(function ($action) {
                        return $action->modalHeading('Crear nueva raza');
                    }),
                TextInput::make('color'),
                Select::make('size')
                    ->label('Tamaño')
                    ->options([
                        'muy pequeño' => 'Muy pequeño',
                        'pequeño' => 'Pequeño',
                        'mediano' => 'Mediano',
                        'grande' => 'Grande',
                        'muy grande' => 'Muy grande'
                    ])
                    ->default('pequeño'),
                TextInput::make('name_contact')
                    ->label('Nombre de contacto')
                    ->default(Auth::user()->name)
                    ->maxLength(255)
                    ->minLength(3)
                    ->helperText('Podes cambiarlo o dejar en blanco si no queres que se muestre tu nombre en la página.')
                    ->validationMessages([
                        'max' => 'El nombre no puede tener más de :max caracteres',
                        'min' => 'El nombre debe tener al menos :min caracteres'
                    ]),
                TextInput::make('email_contact')
                    ->label('Email de contacto')
                    ->default(Auth::user()->email)
                    ->email()
                    ->maxLength(255)
                    ->minLength(3)
                    ->helperText('Podes cambiarlo o dejar en blanco si no queres que se muestre tu email en la página.')
                    ->validationMessages([
                        'email' => 'Ingresa un email valido',
                        'max' => 'El nombre no puede tener más de :max caracteres',
                        'min' => 'El nombre debe tener al menos :min caracteres'
                    ]),
                TextInput::make('phone_contact')
                    ->tel()
                    ->label('Teléfono de contacto')
                    ->maxLength(255)
                    ->minLength(3)
                    ->default(Auth::user()->phone)
                    ->helperText('Podes cambiarlo o dejar en blanco si no queres que se muestre tu teléfono en la página.')
                    ->validationMessages([
                        'tel' => 'Ingresa un teléfono valido',
                        'max' => 'El nombre no puede tener más de :max caracteres',
                        'min' => 'El nombre debe tener al menos :min caracteres'
                    ]),
                Hidden::make('user_id')
                    ->default(Auth::user()->id),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 📝 Información principal (FULL WIDTH)
                Section::make('Información')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('title')
                            ->weight('bold')
                            ->color('primary')
                            ->copyable()
                            ->label('Título')
                            ->hidden(fn($record) => empty($record->title)),

                        TextEntry::make('description')
                            ->label('Descripción')
                            ->color('gray')
                            ->hidden(fn($record) => empty($record->description)),

                        TextEntry::make('date')
                            ->date()
                            ->badge()
                            ->color('info')
                            ->label('Fecha')
                            ->icon('heroicon-o-calendar')
                            ->hidden(fn($record) => empty($record->date)),

                        TextEntry::make('location')
                            ->icon('heroicon-m-map-pin')
                            ->badge()
                            ->label('Ubicación')
                            ->color('success')
                            ->url(fn($record) => $record->location ? 'https://www.google.com/maps/search/' . urlencode($record->location) : null)
                            ->openUrlInNewTab()
                            ->hidden(fn($record) => empty($record->location)),
                        ImageEntry::make('images')
                            ->label('Imágenes')
                            ->hidden(fn($record) => empty($record->images))
                            ->url(fn($state) => Storage::url($state))
                            ->openUrlInNewTab()
                            ->columnSpanFull()
                            ->imageSize(128)
                    ]),


                // 🐾 Relación con especie y raza
                Section::make('Datos de la mascota')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('species.name')
                            ->badge()
                            ->color('primary')
                            ->icon('heroicon-o-heart')
                            ->label('Especie')
                            ->hidden(fn($record) => empty(optional($record->species)->name)),

                        TextEntry::make('breed.name')
                            ->badge()
                            ->color('info')
                            ->label('Raza')
                            ->icon('heroicon-o-information-circle')
                            ->hidden(fn($record) => empty(optional($record->breed)->name)),

                        TextEntry::make('color')
                            ->badge()
                            ->color('primary')
                            ->label('Color')
                            ->icon('heroicon-o-swatch')
                            ->hidden(fn($record) => empty($record->color)),

                        TextEntry::make('size')
                            ->badge()
                            ->label('Tamaño')
                            ->color('info')
                            ->formatStateUsing(fn($state) => ucfirst($state))
                            ->icon('heroicon-o-scale')
                            ->hidden(fn($record) => empty($record->size)),
                    ])->collapsible(),

                // 🟢 Estado general
                Section::make('Estado')
                    ->schema([
                        IconEntry::make('is_published')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger')
                            ->label(fn($record) => $record->is_published ? 'Publicado' : 'No publicado')
                            ->inlineLabel()
                            ->alignEnd(),

                        IconEntry::make('is_missing')
                            ->boolean()
                            ->falseIcon('heroicon-o-information-circle')
                            ->trueIcon('heroicon-o-face-frown')
                            ->falseColor('info')
                            ->trueColor('warning')
                            ->label(fn($record) => $record->is_missing ? 'Perdido' : 'Encontrado')
                            ->inlineLabel()
                            ->alignEnd(),

                        IconEntry::make('is_resolved')
                            ->boolean()
                            ->falseIcon('heroicon-o-no-symbol')
                            ->trueIcon('heroicon-o-face-smile')
                            ->trueColor('success')
                            ->falseColor('danger')
                            ->label(fn($record) => $record->is_resolved ? 'Resuelto' : 'No resuelto')
                            ->inlineLabel()
                            ->alignEnd(),
                    ])
                    ->collapsible(),

                // 📞 Contacto
                Section::make('Contacto')
                    ->schema([
                        TextEntry::make('name_contact')
                            ->weight('medium')
                            ->icon('heroicon-o-user')
                            ->label('Nombre')
                            ->iconColor('info')
                            ->inlineLabel()
                            ->badge()
                            ->color('info')
                            ->hidden(fn($record) => empty($record->name_contact)),

                        TextEntry::make('email_contact')
                            ->copyable()
                            ->icon('heroicon-o-envelope')
                            ->label('Email')
                            ->inlineLabel()
                            ->iconColor('info')
                            ->badge()
                            ->color('info')
                            ->hidden(fn($record) => empty($record->email_contact)),

                        TextEntry::make('phone_contact')
                            ->copyable()
                            ->icon('heroicon-o-phone')
                            ->label('Teléfono')
                            ->inlineLabel()
                            ->url(fn($record) => $record->phone_contact ? 'https://wa.me/' . preg_replace('/\D/', '', $record->phone_contact) : null)
                            ->openUrlInNewTab()
                            ->iconColor('info')
                            ->badge()
                            ->color('info')
                            ->hidden(fn($record) => empty($record->phone_contact)),
                    ])->collapsible(),

                // 🗓️ Información del post (renombrado)
                Section::make('Información del post')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('user_id')
                            ->label('Creado por')
                            ->inlineLabel()
                            ->badge()
                            ->formatStateUsing(fn($state) => User::find($state)->name)
                            ->icon('heroicon-o-user')
                            ->iconColor('info')
                            ->hidden(fn($record) => empty($record->user_id)),

                        TextEntry::make('created_at')
                            ->icon('heroicon-o-calendar')
                            ->inlineLabel()
                            ->badge()
                            ->dateTime()
                            ->label('Creado'),

                        TextEntry::make('updated_at')
                            ->icon('heroicon-o-calendar')
                            ->inlineLabel()
                            ->badge()
                            ->dateTime()
                            ->label('Actualizado'),

                        TextEntry::make('deleted_at')
                            ->icon('heroicon-o-calendar')
                            ->inlineLabel()
                            ->badge()
                            ->dateTime()
                            ->label('Eliminado')
                            ->hidden(fn($record) => empty($record->deleted_at)),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('species_id')
                    ->label('Especie')
                    ->getStateUsing(fn($record) => Species::find($record->species_id)->name)
                    ->numeric()
                    ->sortable()
                    ->visibleFrom('md')
                    ->toggleable(),
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date()
                    ->sortable()
                    ->visibleFrom('md')
                    ->badge()
                    ->color('info')
                    ->toggleable(),
                TextColumn::make('user_id')
                    ->label('Usuario')
                    ->getStateUsing(fn($record) => User::find($record->user_id)->name)
                    ->searchable()
                    ->toggleable()
                    ->visibleFrom('md')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->icon('heroicon-o-user'),
                IconColumn::make('is_resolved')
                    ->label('Resuelto')
                    ->color(fn($record) => $record->is_resolved ? 'success' : 'danger')
                    ->falseIcon('heroicon-o-no-symbol')
                    ->trueIcon('heroicon-o-face-frown')
                    ->boolean()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make()->button()->hiddenLabel()->extraAttributes([
                    'title' => 'Ver',
                ]),
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
            'index' => ManagePosts::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
