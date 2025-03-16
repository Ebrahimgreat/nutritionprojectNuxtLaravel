<?php

namespace App\Livewire;

use Carbon\Carbon;

use App\Models\nutrients;


use Closure;
use Faker\Provider\Text;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;


use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Summarizers\Sum;

use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\foods;


use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Stack;
use function Laravel\Prompts\form;


class DailyCalorie extends Component implements HasForms,HasTable
{
    public $foodName;
    public $foodId;


    public $date;
    public $quantity;

    public $count;


    use InteractsWithForms;
    use InteractsWithTable;


    public function mount()
    {

        $this->date =Carbon::today()->format('Y-m-d');

    }


    public function table(Table $table):Table
    {
        return $table->query(nutrients::query()->where('date', $this->date))


            ->paginated(false)
            ->description('1.Calories 2. Protein. 3. Carbohydrates, 4. Fats')



            ->emptyStateHeading('Hello There')
            ->emptyStateDescription('Ready to get Started')

              ->headerActions([

                Action::make('previous')
                 ->action(fn() => $this->previous()),

                Action::make('next')
                  ->action(fn() => $this->next()),
                CreateAction::make('ADD')->label('Add New')
                ->model(nutrients::class)

                ->form([
                    DateTimePicker::make('date')
                    ->format('Y-m-d')
                    ->label('Date'),
                    TextInput::make('Calories'),
                    TextInput::make('Protein'),
                    TextInput::make('Carbs'),
                    TextInput::make('Fat'),
                    Select::make('food_name')->label('Foods previously eaten')
            ->options(foods::all()->pluck('name', 'id'))

            ->live(),
                    TextInput::make('quantity'),




                    TextInput::make('foodType')


                ]),
                  Action::make('Quick Food add')
                      ->slideOver()







                      ->model(foods::class)
                      ->form([
                          Select::make('name')
                              ->options(foods::all()->pluck('name', 'id'))




                              ->afterStateUpdated(function ($state, $set) {
                                  $this->foodId = $state;
                                  $this->foodName=foods::find($state)['name'];







                              }),
                          Select::make('quantity')
                              ->options([
                                  range(1,100)

                              ])
                              ->afterStateUpdated(function ($state, $set) {
                                  $this->quantity = $state;

                              }),

                      ])
                      ->requiresConfirmation()
                      ->action(fn()=>$this->calculateCalories($this->foodName,$this->quantity)),























              ])

            ->filters([
                Filter::make('date')
                ->form([

                    DatePicker::make('date')
                ])
                ->query(function(Builder $query, array $data) {
                    if ($data['date'] != null) {


                        return $query->whereDate('date', $data['date']);
                    }
                    return $query;
                    }


                )



            ])



                 ->columns([
                     TextColumn::make('target')




            ->alignCenter()
            ->weight('bold'),

                TextColumn::make('date')->date(),




                Stack::make([

                TextColumn::make('Calories')->numeric(2)


            ->description('calories')



            ->summarize([

                Sum::make('Total calories')->label('Total Calories')->numeric(2)
            ]),

                TextColumn::make('Protein')->numeric(2)
                    ->description('Protein')
                    ->summarize([
                        Sum::make('Total Protein')->label('Total Protein')->numeric(2)
                    ]),
                    TextColumn::make('Carbs')
                        ->description('Carbohydrates')
            ->summarize([
                Sum::make('Total Carbs')->label('Total Carbs')->numeric(2)
            ]),
                    TextColumn::make('Fat')

                    ->description('Fat')
                    ->summarize([
                        Sum::make('Total Fat')->label('total Fat')



                    ]),
                    TextColumn::make('food_name')
                    ->alignCenter()
                    ->weight('bold')
                    ->color('blue'),
                    TextColumn::make('foodType')

                    ]),

            ])




        ->actions([
        EditAction::make()
            ->model(nutrients::class)
                ->form([
                DateTimePicker::make('date')
                    ->label('Date')
                    ->format('Y-m-d')
                    ->required(),
                TextInput::make('Calories'),
                TextInput::make('Protein'),
                TextInput::make('Carbs'),
                TextInput::make('Fat'),


            ]),
            DeleteAction::make()
            ->model(nutrients::class),
            Action::make('search_food')
            ->form([
                TextInput::make('Search food')

            ]),

            CreateAction::make('add food')
            ->model(foods::class)
            ->form([
                TextInput::make('name'),
                TextInput::make('Protein'),
                TextInput::make('Carbs'),
                TextInput::make('Fats'),
                TextInput::make('quantity'),


            ]),













    ]);















    }





    public function previous()
    {



        //creates a new data
        $dateModified=date_create($this->date);

        date_sub($dateModified, date_interval_create_from_date_string('1 days'));
        $this->date=$dateModified->format('Y-m-d');
        return $this->table->query(nutrients::query()->where('date', $this->date));












    }
    public function next()
    {
        $dateModified=date_create($this->date);
        date_add($dateModified, date_interval_create_from_date_string('1 days'));
        $this->date=$dateModified->format('Y-m-d');
        return $this->table->query(nutrients::query()->where('date', $this->date));






    }
    public function getTargetCalories()
    {
        $targetCalories=nutrients::getLatestNutrients()['goals_id']->goals->targetCalories;
        return $targetCalories;
    }


    public function calculateCalories($food_name,$quantity)
    {


      $foods=new foods();
      $arrayofNutrients=$foods->calculateCalories($food_name,$quantity);
      nutrients::create([
          'Protein'=>$arrayofNutrients[1],
          'Carbs'=>$arrayofNutrients[2],
          'Calories'=>$arrayofNutrients[0],
          'Fat'=>$arrayofNutrients[3],
          'date'=>$this->date,
          'foods_id'=>$this->foodId,

      ]);





        // Ensure 'quantity' is a form input



    }







    public function render()
    {
             return view('livewire.daily-calorie',
                [

             ]);
        }

}
