<?php

namespace App\Livewire;

use Faker\Provider\Text;
use Livewire\Component;

use App\models\UserProfile;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;

class formComponent extends Component implements HasForms
{

   use InteractsWithForms;
   public ?array $data=[];
    public?array $data1=[];
    public?array $personalInformation=[];
   public function mount():void


   {
       $this->form->fill();
   }

    public function form(Form $form):Form
    {
        return $form



                ->schema([




                Section::make('Personal Information')
                     ->schema([


                     TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('age')
                    ->label('age')
                    ->required(),
                 TextInput::make('Sex')
                 ->label('sex')
                     ->required(),
                ])

            ->statePath('personalInformation'),









                Section::make('Activity Information')

                ->schema([
                    Radio::make('activityLevel')

                        ->options(
                            [
                                '1.2'=> 'sedentary',
                                '1.375'=> 'Lightly Active',
                                '1.55'=>'Moderately Active',
                                '1.725'=>'Very Active',
                                '1.9'=>'Extremely Active',
                            ]

                        )

                        ->required(),

                    TextInput::make('weight')
                        ->label('Weight')
                        ->required(),
                    TextInput::make('Height')
                        ->label('Height')
                        ->required()
                ])





            ])

            ->statePath('data');







    }

    public function PersonalInformationComponent()
    {
        return TextInput::make('name');
    }
    public function getSteps():array
    {
        return[
            Step::make('Order')
            ->schema([
                TextInput::make('Order')
                ->label('Order')
                ->required()
                    ->statePath('data1.Order')
            ])

        ];

    }
    public function render()
    {
        return view('livewire.form');
    }
    public function save()
    {

        // Save the form data
        UserProfile::create($this->form->getState());



        // Redirect to the /submit route with the data
        return redirect()->to('/submit')->with('data', $this->data);
    }

}
