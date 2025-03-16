<?php

namespace App\Livewire;

use App\Models\User;
use Faker\Provider\Text;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use GuzzleHttp\Promise\Create;
use Livewire\Component;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use App\Models\UserProfile;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Actions\Action;
use function Laravel\Prompts\form;




class Information extends Component implements HasForms,HasInfolists
{
    public $form;
    public $active;
    public $name;
    public $weight;
    public $activityLevel;
    public $Sex;
    public $height;
    use InteractsWithForms;
    use InteractsWithInfolists;


    public function mount()
    {
        $this->name=UserProfile::all()[0]->name;
        $this->height=UserProfile::all()[0]->height;
        $this->Sex=UserProfile::all()[0]->Sex;
        $this->activityLevel=UserProfile::all()[0]->activityLevel;
        if($this->activityLevel>1 && $this->activityLevel<1.2){
            $this->activityLevel='low';
        }
        elseif($this->activityLevel>1.2 && $this->activityLevel<1.5){
            $this->activityLevel='medium';
        }
        elseif($this->activityLevel>1.5 && $this->activityLevel<1.6){
            $this->activityLevel='high';
        }
        $this->weight=UserProfile::all()[0]->weight;
    }

    public  function infolist(Infolist $infolist):Infolist
    {


      return $infolist

          ->state([
              'name' => $this->name,
              'activityLevel' => $this->activityLevel,
              'weight' => $this->weight,
              'height' => $this->height,
              'Sex'=>$this->Sex,

          ])




          ->schema([





              TextEntry::make('name')

              ->label('Name'),

              TextEntry::make('height')
              ->label('Height'),

              TextEntry::make('activityLevel')
              ->label('Activity Level'),
              TextEntry::make('weight')
              ->label('Weight'),
              TextEntry::make('Sex')
              ->label('Gender')


          ])
      ->columns(3);








    }










    public function render()
    {
        return view('livewire.information');
    }
}
