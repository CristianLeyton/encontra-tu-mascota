<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                TextInput::make('phone')
                    ->tel()
                    ->label('Número de teléfono')
                    ->maxLength(15)
                    ->nullable()
                    ->validationMessages([
                        'max' => 'El número de teléfono no debe exceder los :max caracteres.',
                    ]),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}