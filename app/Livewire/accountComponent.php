<?php

namespace App\Livewire;



use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Layout\Stack;
use Livewire\Component;
use Rawilk\FilamentPasswordInput\Password;


use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;


use Filament\Tables\Columns\Summarizers\Sum;

use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;


use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\userprofile;
use Filament\Tables\Columns\TextColumn;



class accountComponent extends Component implements HasTable,HasForms
{
    use InteractsWithForms;
 use InteractsWithTable;

    public function table(Table $table):Table
    {
        return $table
            ->query(userprofile::query())
            ->columns([

                Stack::make([


                    TextColumn::make('name')->label('Name')->description('Name'),
                    TextColumn::make('height')->description('Height'),
                    TextColumn::make('age')->description('Age'),
                    TextColumn::make('Sex')->description('Gender'),
                    TextColumn::make('expenditure')->description('Expenditure'),
                    TextColumn::make('weight')->description('Weight'),











                ])


            ]);
    }
    public function render()
    {
        return view('livewire.account-table');
    }


}
