<?php

namespace App\Livewire;

use App\Models\weightTracking;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Contracts\Editable;
use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use App\Models\weight;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Widgets\ChartWidget;








class WeightTable extends Component implements HasTable, HasForms
{
    use InteractsWithForms;
    use InteractsWithTable;





    public function table(Table $table):Table
    {


        return $table

        ->query(Weight::query())
            ->filters([
                Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ]),
                    ])

            ->headerActions([
                CreateAction::make('Create')->label('Add new Weight')
                ->model(weight::class)
                ->form([
                    TextInput::make('ScaleWeight')->label('Weight')
                    ->required(),
                    DatePicker::make('date')->label('Date')
                    ->default(now())
                ]),




            ])
            ->actions([
                DeleteAction::make('Delete')
                ->model(weight::class)
                ->requiresConfirmation(),
                EditAction::make('Edit')
                ->model(weight::class)
                ->form([
                    TextInput::make('ScaleWeight')->label('ScaleWeight')

                ])
            ])


        ->columns([
            TextColumn::make('date')->label('Date')

            ->date(),
            TextColumn::make('ScaleWeight'),
            TextColumn::make('trendWeight'),


            ])
            ->defaultSort('date', 'desc');



    }
    public function render()
    {
        return view('livewire.weightTable');
    }
}
