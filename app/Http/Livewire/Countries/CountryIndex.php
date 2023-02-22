<?php

namespace App\Http\Livewire\Countries;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;


class CountryIndex extends Component
{
    use WithPagination;

   public $search='';
    public $country_code;
    public $name;
    public $countyId;
    public $editmode=false;
    protected $rules = [
        'name' => 'required',
        'counrty_code' => 'required',
        

    ];

    public function createCountry(){

        Country::create([
            'counrty_code'=>$this->country_code,
              'name'=>$this->name,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'Country successfully created.');


    }
    public function showEditModel($id){
          $this->reset();
          $this->editmode=true;
          $this->countyId=$id;
          $this->loadCountry();
          $this->dispatchBrowserEvent('showModel');

        
    }

    public function loadCountry(){
        $countries =Country::find($this->countyId);
        $this->country_code=$countries->counrty_code;
        $this->name=$countries->name;
    }
      
    public function editCountry(){
        $countries=Country::find($this->countyId);
        $countries->update([
            'counrty_code'=>$this->country_code,
              'name'=>$this->name,
        ]);
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'Country successfully updated.');

    }
    public function closeModel(){
        $this->dispatchBrowserEvent('closeModel');
        $this->reset();
    }

    public function DeleteCountry($id){
        $countries=Country::find($id);
        $countries->delete();
        session()->flash('message', 'User successfully deleted.');
    }
    public function render()
    {
 
        $countries =Country::paginate(3);

        if(strlen($this->search)>2){
            $countries = Country::where('name', 'LIKE', "%$this->search%")->orwhere('counrty_code', 'LIKE', "%$this->search%")->paginate(3);

        }
                return view('livewire.countries.country-index',compact('countries'))->layout('layouts.main');
    }
}
