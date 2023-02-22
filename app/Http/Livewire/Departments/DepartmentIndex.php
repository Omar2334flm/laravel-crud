<?php

namespace App\Http\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;

class DepartmentIndex extends Component
{

    public $search='';
    
    public $name;
    public $DepartmentId;
    public $editmode=false;
    protected $rules = [
        'name' => 'required',
        
        

    ];

    public function createDepartment(){
              
        Department::create([
        
              'name'=>$this->name,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'Department successfully created.');


    }
    public function showEditModel($id){
          $this->reset();
          $this->editmode=true;
          $this->DepartmentId=$id;
          $this->loadDepartment();
          $this->dispatchBrowserEvent('showModel');

        
    }

    public function loadDepartment(){
        $Department =Department::find($this->DepartmentId);
        
        $this->name=$Department->name;
    }
      
    public function editDepartment(){
        $Department=Department::find($this->DepartmentId);
        $Department->update([
              'name'=>$this->name,
        ]);
        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'Department successfully updated.');

    }
    public function closeModel(){
        $this->dispatchBrowserEvent('closeModel');
        $this->reset();
    }

    public function DeleteDepartment($id){
        $Department=Department::find($id)->delete();
        
        session()->flash('message','Department successfully deleted.');
    }
    public function render()
    {
        $Departments=Department::paginate(5);
        if(strlen($this->search)>2){
            $Departments = Department::where('name', 'LIKE', "%$this->search%")->paginate(5);

        }
        return view('livewire.departments.department-index',compact('Departments'))->layout('layouts.main');
    }
}
