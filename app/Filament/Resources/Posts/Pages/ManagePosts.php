<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostsResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePosts extends ManageRecords
{
    protected static string $resource = PostsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Ver publicaciones')
                ->url('/')
                ->label('Ver publicaciones')
                ->icon('heroicon-o-newspaper'),
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->after(function ($record, $data) {
                    // Esto hace que Laravel haga un redirect completo fuera de Filament
                    return redirect()->away(url('/'));
                })
        ];
    }
}
