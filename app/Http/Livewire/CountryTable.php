<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\Rule;

final class CountryTable extends PowerGridComponent
{
    use ActionButton;

    public $region;

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public array $perPageValues = [0, 5, 10, 1000, 5000];

    public function setUp(): void
    {
        $this->showCheckBox()
            ->showPerPage(10)
            ->showRecordCount('full')
            ->showSearchInput()
            ->showExportOption('download', ['excel', 'csv'])
            ->showToggleColumns()
            ->persist(['columns', 'filters']);
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return  \Illuminate\Database\Eloquent\Builder<\App\Models\User>|null
    */
    public function datasource(): ?Builder
    {
        return Country::query()->where('region', $this->region);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('iso3')
            ->addColumn('iso2')
            ->addColumn('numeric_code')
            ->addColumn('phone_code')
            ->addColumn('capital')
            ->addColumn('currency')
            ->addColumn('currency_name')
            ->addColumn('currency_symbol')
            ->addColumn('tld')
            ->addColumn('native')
            ->addColumn('region')
            ->addColumn('subregion')
            ->addColumn('latitude')
            ->addColumn('longitude')
            ->addColumn('emoji')
            ->addColumn('emojiU')
            ->addColumn('created_at_formatted', function(Country $model) { 
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function(Country $model) { 
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id'),
                // ->makeInputRange(),

            Column::add()
                ->title('NAME')
                ->field('name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('ISO3')
                ->field('iso3')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('ISO2')
                ->field('iso2')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('NUMERIC CODE')
                ->field('numeric_code')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('PHONE CODE')
                ->field('phone_code')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('CAPITAL')
                ->field('capital')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('CURRENCY')
                ->field('currency')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('CURRENCY NAME')
                ->field('currency_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('CURRENCY SYMBOL')
                ->field('currency_symbol')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('TLD')
                ->field('tld')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('NATIVE')
                ->field('native')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('REGION')
                ->field('region')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('SUBREGION')
                ->field('subregion')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('LATITUDE')
                ->field('latitude')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title('LONGITUDE')
                ->field('longitude')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title('EMOJI')
                ->field('emoji')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('EMOJIU')
                ->field('emojiU')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('CREATED AT')
                ->field('created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('created_at'),

            Column::add()
                ->title('UPDATED AT')
                ->field('updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('updated_at'),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Country Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */

    
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption('Edit')
               ->class('bg-indigo-500 cursor-pointer px-3 py-2.5 m-1 rounded text-sm')
            //    ->emit('addCountry', ['key' => 'id']),
               ->openModal('edit-country', ['id' => 'id']),
            //  ->route('country.edit', ['country' => 'id']),

           Button::add('destroy')
               ->caption('Delete')
               ->class('bg-red-500 cursor-pointer px-3 py-2 m-1 rounded text-sm')
               ->emit('deleteModel', ['id' => 'id']),
               // ->route('country.destroy', ['id' => 'id'])
               // ->method('delete'),
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Country Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($country) => $country->id === 1)
                ->hide(),
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

     /**
     * PowerGrid Country Update.
     *
     * @param array<string,string> $data
     */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Country::query()->findOrFail($data['id'])
                ->update([
                    $data['field'] => $data['value'],
                ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
    */




    protected function getListeners()
    {
        return $this->listeners = ['deleteModel', 'refreshTable', 'confirmed'];
    }

    public function deleteModel($id)
    {
        $this->deletableModelId = $id;
        Country::where('id', $this->deletableModelId)->first()->delete();
        // $this->alert('warning', 'Are you sure, you want to delete this record?', [
        //     'position' => 'top',
        //     'timer' => 9000,
        //     'toast' => false,
        //     'showConfirmButton' => true,
        //     'onConfirmed' => 'confirmed',
        //     'confirmButtonText' => 'Yes',
        //     'showCancelButton' => true,
        //     'onDismissed' => '',
        //     'width' => '400px',
        //     'theme' => 'dark'
        // ]);
    }

    public function confirmed()
    {
        // Country::where('id', $this->deletableModelId)->first()->delete();
    }


    public function refreshTable()
    {
        // $this->fillData();
    }
}
