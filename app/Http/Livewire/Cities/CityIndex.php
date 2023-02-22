<?php

namespace App\Http\Livewire\Cities;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class CityIndex extends Component
{
    use WithPagination;


    public $search='';
    public $state_id;
    public $name;
    public $cityId;
    public $editmode=false;
    protected $rules = [
        'name' => 'required',
        'state_id' => 'required',
        

    ];

    public function createCity(){
              
        City::create([
            'state_id'=>$this->state_id,
              'name'=>$this->name,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'State successfully created.');


    }
    public function showEditModel($id){
          $this->reset();
          $this->editmode=true;
          $this->cityId=$id;
          $this->loadCity();
          $this->dispatchBrowserEvent('showModel');

        
    }

    public function loadCity(){
        $city =City::find($this->cityId);
        $this->state_id=$city->state_id;
        $this->name=$city->name;
    }
      
    public function editCity($city){
        $city=city::find($this->cityId);
        $city->update([
            'state_id'=>$this->state_id,
              'name'=>$this->name,
        ]);
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'State successfully updated.');

    }
    public function closeModel(){
        $this->dispatchBrowserEvent('closeModel');
        $this->reset();
    }

    public function DeleteCity($id){
        
        $city=City::find($id);
        $city->delete();
        session()->flash('message', 'States successfully deleted.');
    }
  

    public function render()
    {
        $cities=City::paginate(5);
        if(strlen($this->search)>2){
            $city = City::where('name', 'LIKE', "%$this->search%")->paginate(1);

        }
        $state=State::all();

        
        return view('livewire.cities.city-index',compact('cities','state'))->layout('layouts.main');
    }
}
