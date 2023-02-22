<?php

namespace App\Http\Livewire\States;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;


class StateIndex extends Component
{

    use WithPagination;

    
    public $search='';
    public $country_id;
    public $name;
    public $stateId;
    public $editmode=false;
    protected $rules = [
        'name' => 'required',
        'country_id' => 'required',
        

    ];

    public function createState(){
        $this->validate();
        State::create([

            'country_id'=>$this->country_id,

              'name'=>$this->name,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'State successfully created.');


    }
    public function showEditModel($id){
          $this->reset();
          $this->editmode=true;
          $this->stateId=$id;
          $this->loadState();
          $this->dispatchBrowserEvent('showModel');

        
    }

    public function loadState(){
        $states =State::find($this->stateId);
        $this->country_id=$states->country_id;
        $this->name=$states->name;
    }
      
    public function editState(){
        $states=State::find($this->stateId);
        $states->update([
            'country_id'=>$this->country_id,
              'name'=>$this->name,
        ]);
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'State successfully updated.');

    }
    public function closeModel(){
        $this->dispatchBrowserEvent('closeModel');
        $this->reset();
    }

    public function DeleteState($id){
        $states=State::find($id);
        $states->delete();
        session()->flash('message', 'States successfully deleted.');
    }
    public function render()
    {

       
        $states=State::paginate(3);
        if(strlen($this->search)>2){
            $states = State::where('name', 'LIKE', "%$this->search%")->orwhere('country_id', 'LIKE', "%$this->search%")->paginate(1);

        }
        $countries=Country::all();
      
        return view('livewire.states.state-index',compact('states','countries'))->layout('layouts.main');
    }
}
