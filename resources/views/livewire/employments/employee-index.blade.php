
<div>
    <div>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        </div>
        <div class="row">
            <div class="card  mx-auto">
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <form >
                                    <div class="form-row align-items-center">
                                        <div class="col">
                                            <input type="search" wire:model="search" class="form-control mb-2" id="inlineFormInput"
                                                placeholder="Jane Doe">
                                        </div>
                                        <div class="col">
                                            <select class="form-control mb-2" wire:model="selectedDepartmentId" aria-label="Default select example">
                                                <option selected >choose</option>
                        
                                                @foreach ($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                        
                                                @endforeach
                                                
                                              </select>
                                        </div>
                                        <div class="col" wire:loading>
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>                                </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div>
                            
                        </div><!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          create
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">first_name</th>
                                <th scope="col">Country</th>
                                
                                <th scope="col">Hire Date</th>
                                <th scope="col">Manage</th>
                                <th scope="col"></th>
    
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Employees as $Employee)
                                <tr>
                                    <th scope="row">{{ $Employee->id }}</th>
                                    <td>{{ $Employee->first_name }}</td>
                                    <td>{{ $Employee->country->name }}</td>
                                   
                                 
                                    <td>{{ $Employee->date_hired }}</td>
                                    <td>
                                    </div><!-- Button trigger modal -->
                                    <button type="button"  wire:click="ShowEditModel({{$Employee->id}})" class="btn btn-success" >
                                      Edit
                                    </button>
                                </div>
                                    </td>
                                    <td>
                                    </div><!-- Button trigger modal -->
                                    <button type="button"  wire:click="deleteEmployee({{$Employee->id}})" class="btn btn-danger" >
                                      Delete
                                    </button>
                                </div>
                                    </td>
                                </tr>
    
                                @empty
                                    <tr>
                                        
                                        <th>
                                            No Result
                                    </th> 
                                </tr>
                                
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $Employees->links() }}
    
                    </div>
                </div>
            </div>
    
    
    
    
            
    
    
    
    
            <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                @if ($editMode)
                <h5 class="modal-title" id="exampleModalLabel">update Employee</h5>
    
                @else
                <h5 class="modal-title" id="exampleModalLabel">create Employee
                </h5>
    
                @endif
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    
    
                    <div class="form-group row">
                        <label for="first_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>
    
                        <div class="col-md-6">
                            <input id="first_name" type="text"
                                class="form-control @error('name') is-invalid @enderror" wire:model.defer="first_name" 
                                >
    
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="last_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('lastName') }}</label>
    
                        <div class="col-md-6">
                            <input id="first_name" type="text"
                                class="form-control @error('name') is-invalid @enderror" wire:model.defer="last_name"
                                >
    
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="middle_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('middle Name') }}</label>
    
                        <div class="col-md-6">
                            <input id="middle_name" type="text"
                                class="form-control @error('name') is-invalid @enderror" wire:model.defer="middle_name"
                                >
    
                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country_id"
                        class="col-md-4 col-form-label text-md-right">{{ __('Country ') }}</label>
                    <div class="col-md-6">

                        <select class="custom-select" wire:model.defer="country_id" aria-label="Default select example">
                            <option selected>choose</option>
    
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
    
                            @endforeach
                            
                          </select>
                        
                           @error('country_id ')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                    </div>
                  

                    <div class="form-group row">
                        <label for="state_id"
                        class="col-md-4 col-form-label text-md-right">{{ __('State code') }}</label>
                       <div class="col-md-6">

                        <select class="custom-select" wire:model.defer="state_id" aria-label="Default select example">
                            <option selected>choose</option>
    
                            @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->name}}</option>
    
                            @endforeach
                            
                          </select>
                        
                           @error('state_id')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                    </div>


                    <div class="form-group row">
                        <label for="city_id"
                        class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                       <div class="col-md-6">

                        <select class="custom-select" wire:model.defer="city_id" aria-label="Default select example">
                            <option selected>choose</option>
    
                            @foreach ($city as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
    
                            @endforeach
                            
                          </select>
                        
                           @error('city_id')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                    </div>

                    <div class="form-group row">

                        <label for="department_id"
                        class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                       <div class="col-md-6">

                        <select class="custom-select" wire:model.defer="department_id" aria-label="Default select example">
                            <option selected>choose</option>
    
                            @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
    
                            @endforeach
                            
                          </select>
                        
                           @error('department_id')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="zip_code"
                            class="col-md-4 col-form-label text-md-right">{{ __('Zip Code') }}</label>
    
                        <div class="col-md-6">
                            <input id="zip_code" type="text"
                                class="form-control @error('name') is-invalid @enderror" wire:model.defer="zip_code" 
                                >
    
                            @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="birthdate"
                            class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>
    
                        <div class="col-md-6">
                            <div class="mt-1">
                                <input type="text" id="birth_date" wire:model.defer="birthdate"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
    
                            @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="date_hired"
                            class="col-md-4 col-form-label text-md-right">{{ __('Hired Date') }}</label>
    
                        <div class="col-md-6">
                            <div class="mt-1">
                                <input type="text" id="date_hired" wire:model.defer="date_hired"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
    
                            @error('date_hired')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Address"
                            class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
    
                        <div class="col-md-6">
                            <input id="first_name" type="text"
                                class="form-control @error('name') is-invalid @enderror" wire:model.defer="address" 
                                >
    
                            @error('Address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                  
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="closeModel()">Close</button>
              @if ($editMode)
              <button type="button" class="btn btn-primary" wire:click="updateEmployee()">update</button>
    
              @else
              <button type="button" class="btn btn-primary" wire:click="createEmployee()">create</button>
    
                  
              @endif
    
            </div>
          </div>
        </div>
      </div>
        </div>
    </div>
    </div>
    </div>