<?php

namespace App\Livewire;
use App\Tables\Columns\SearchColumn;
use Faker\Provider\Text;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Concerns\InteractsWithRecords;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Laravel\Prompts\SearchPrompt;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\Csv\Query\Ordering\Column;
use Livewire\Component;
use App\Models\nutrients;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use App\Http\Controllers\apiController;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Carbon\Carbon; // Make sure to import Carbon if you're using it
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;


use Filament\Tables\Columns\Layout\Split;




use Filament\Forms\Form;
use function Livewire\wrap;


class CalorieTable extends Component implements HasTable,HasForms
{
    use InteractsWithTable, InteractsWithForms;


    public function render()
    {
        return view('livewire.calorie-table',
        );
    }

    public function table(Table $table): Table
    {

       return $table

            ->query(nutrients::query())


           ->headerActions([
               action::make(date(today()))




           ])



            ->columns([

               Split::make([
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->alignCenter()
                ->grow(),

                ]),


                Stack::make([

                TextColumn::make('Calories')

                ->description('Calories')

                ->grow(),

                TextColumn::make('Fat')
                ->description('Fat'),
                TextColumn::make('Carb')
                    ->description('Fat')
                    ->grow(),
                    TextColumn::make('Carbs')
                    ->description('Carbs'),
                    ])


                ])






            ->actions(
                [

                    ViewAction::make('summary')->name('summary')

            ->form([

                TextInput::make('date'),
                TextInput::make('Calories')
                ->label('Calories'),
                TextInput::make('Protein')
                ->label('Protein')
                ->required(),
                TextInput::make('Carbs')



            ]),



                    EditAction::make()
                        ->model(nutrients::class)
                        ->form([
                            TextInput::make('Calories')
                                ->label('Calories'),
                            TextInput::make('Protein')
                                ->label('Protein')
                                ->required(),
                            TextInput::make('Carbs')
                                ->label('Carbs')
                                ->required(),
                            TextInput::make('Fats')
                            ->label('Fats')
                            ->required(),

                        ]),


                    DeleteAction::make()
                        ->model(nutrients::class)
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()


                ]);


    }


}
