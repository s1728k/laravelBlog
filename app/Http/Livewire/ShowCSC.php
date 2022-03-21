<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

class ShowCSC extends Component
{
    public $country_id;
    public $state_id;
    public $city_id;
    public $countries;
    public $states;
    public $cities;

    public function mount()
    {
        $this->countries = Country::all();
        $this->states = State::where('country_id',$this->countries[0]->id)->get();
        $this->cities = City::where('state_id',$this->states[0]->id)->get();
    }

    public function updated()
    {
        // $this->countries = Country::all();
        $this->states = State::where('country_id',$this->country_id)->get();
        $this->cities = City::where('state_id',$this->state_id??$this->states[0]->id)->get();
    }

    public function render()
    {
        return view('livewire.show-c-s-c');
    }
}
