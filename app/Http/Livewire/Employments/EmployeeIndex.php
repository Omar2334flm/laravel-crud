<?php

namespace App\Http\Livewire\Employments;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Livewire\Component;

class EmployeeIndex extends Component
{

    public $search='';
     public $middle_name; 
     public $first_name;
     public $last_name;
     public $country_id;
     public $department_id;
     public $city_id;
     public $state_id;
     public $zip_code;
     public $birthdate;
     public $date_hired;
     public $address;
     public $EmployeeId;
     public $selectedDepartmentId=null;

    


     public $editMode=false;

    protected $rules = [
        
       'middle_name'=>'required', 
        'first_name'=>'required',
        'last_name'=>'required',
        'country_id'=>'required',
        'department_id'=>'required',
        'city_id'=>'required',
        'state_id'=>'required',

     'zip_code'=>'required',       
     'birthdate'=>'required',        
     'date_hired'=>'required',
        'address'=>'required',  
    ];
    public function createEmployee(){
       
        $this->validate();


        Employee::create([
        'middle_name' => $this->middle_name,
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'country_id' => $this->country_id,
        'state_id' => $this->state_id,
        'city_id' => $this->city_id,
        'department_id' => $this->department_id,
        'zip_code'=>$this->zip_code,
        'birthdate'=>$this->birthdate,
        'date_hired'=>$this->date_hired,
        'address'=>$this->address



        ]);
        
        $this->reset();
        

        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'Employee successfully created.');

    }
         public function ShowEditModel($id)
         {
              
            $this->reset();
          $this->editMode=true;
            //finduser
            $this->EmployeeId=$id;
            //loaduser 
            $this->loadEmployee();
            //open model
            $this->dispatchBrowserEvent('showModel');
            //edit user
            $this->updateEmployee();
            

         }
         public function loadEmployee()
         {
            $Employee =Employee::find($this->EmployeeId);
            $this->middle_name = $Employee->middle_name;
             $this->first_name = $Employee->first_name;
             $this->last_name = $Employee->last_name;
             $this->country_id = $Employee->country_id;
             $this->state_id  = $Employee->state_id;
            $this->city_id = $Employee->city_id;
             $this->department_id = $Employee->department_id;
             $this->zip_code = $Employee->zip_code;
             $this->birthdate = $Employee->birthdate;
             $this->date_hired = $Employee->date_hired;
             $this->address = $Employee->address;

         }
          public function updateEmployee(){
            $validated=$this->validate([
                'middle_name'=>'required', 
                'first_name'=>'required',
                'last_name'=>'required',
                'country_id'=>'required',
                'department_id'=>'required',
                'city_id'=>'required',
                'state_id'=>'required',
        
             'zip_code'=>'required',       
             'birthdate'=>'required',        
             'date_hired'=>'required',
                'address'=>'required', 
                
            ]);

            $Employee =Employee::find($this->EmployeeId);
            $Employee->update([
                'middle_name' => $this->middle_name,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'country_id' => $this->country_id,
                'state_id' => $this->state_id,
                'city_id' => $this->city_id,
                'department_id' => $this->department_id,
                'zip_code'=>$this->zip_code,
                'birthdate'=>$this->birthdate,
                'date_hired'=>$this->date_hired,
                'address'=>$this->address,
            ]);

        

            $this->dispatchBrowserEvent('closeModel');
            session()->flash('message', 'User successfully updated.');

          }
        public function closeModel(){
            $this->dispatchBrowserEvent('closeModel');
            $this->reset();
        }

        public function deleteEmployee($id){
            $Employee =Employee::find($id);
            $Employee->delete();
            session()->flash('message', 'Employee successfully deleted.');

              
        }
    public function render()
    {
        $Employees=Employee::paginate(5);
        if(strlen($this->search>2)){
            $Employees = Employee::where('first_name', 'LIKE', "%$this->search%")->paginate(5);

        }
        elseif($this->selectedDepartmentId){
            $Employees = Employee::where('department_id', 'LIKE', "%$this->selectedDepartmentId%")->paginate(5);

        }
        $countries=Country::all();
        $states=State::all();
        $departments=Department::all();
        $city=City::all();
        return view('livewire.employments.employee-index',compact('Employees','countries','states','city','departments'))->layout('layouts.main');
    }
}
