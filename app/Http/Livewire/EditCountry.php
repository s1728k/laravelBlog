<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditCountry extends Component
{
	public $some_id = 0;

	protected function getListeners()
    {
        return $this->listeners = ['editForm'];
    }

    public function render()
    {
        return view('livewire.edit-country');
    }

    public function editForm($id)
    {
    	$this->some_id = $id;
    }
}
