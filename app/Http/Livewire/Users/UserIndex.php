<?php

namespace App\Http\Livewire\Users;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

      
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    
    use WithPagination;
public $search='';
     public $username; 
     public  $firstName;
     public $lastName ;
     public $email ;
     public $password;
     public $userId;
     public $editMode=false;

    protected $rules = [
        'username' => 'required',
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required',
        'password' => 'required',

    ];
    public function createUser(){
       
        $this->validate();


        User::create([
        'Username' => $this->username,
        'first_name' => $this->firstName,
        'last_name' => $this->lastName,
        'email' => $this->email,
        'password'=>Hash::make($this->password),
        ]);
        
        $this->reset();
        

        $this->dispatchBrowserEvent('closeModel');
        session()->flash('message', 'User successfully created.');

    }
         public function ShowEditModel($id)
         {
              
            $this->reset();
          $this->editMode=true;
            //finduser
            $this->userId=$id;
            //loaduser 
            $this->loadUser();
            //open model
            $this->dispatchBrowserEvent('showModel');
            //edit user
            $this->updateUser();
            

         }
         public function loadUser()
         {
            $user =User::find($this->userId);
             $this->username =  $user->Username;
             $this->firstName =  $user->first_name;
             $this->lastName =  $user->last_name;
             $this->email =  $user->email;

         }
          public function updateUser(){
            $validated=$this->validate([
                'username' => 'required',
                'firstName' => 'required',
                'lastName' => 'required',
                 'email' => 'required',
                
            ]);

            $user =User::find($this->userId);
            $user->update([
                'Username' => $this->username,
                'first_name' => $this->firstName,
                'last_name' =>  $this->lastName,
                'email' =>  $this->email,
            ]);

        

            $this->dispatchBrowserEvent('closeModel');
            session()->flash('message', 'User successfully updated.');

          }
        public function closeModel(){
            $this->dispatchBrowserEvent('closeModel');
            $this->reset();
        }

        public function deleteUser($id){
            $user =User::find($id)->delete();
            session()->flash('message', 'User successfully deleted.');

              
        }
    public function render()
    {

        $users=User::paginate(3);
        if(strlen($this->search)>2){
            $users = User::where('username', 'LIKE', "%$this->search%")->orwhere('email', 'LIKE', "%$this->search%")->paginate(3);

        }
        return view('livewire.users.user-index',compact('users'))->layout('layouts.main');
    }
   
}
