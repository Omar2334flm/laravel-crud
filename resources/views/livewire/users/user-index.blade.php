
<div>
<div>
<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 flex text-center">Users</h1>
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
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Manage</th> 
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->Username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                </div><!-- Button trigger modal -->
                                <button type="button"  wire:click="ShowEditModel({{$user->id}})" class="btn btn-success" >
                                  Edit
                                </button>
                            </div>
                                </td>
                                <td>
                                </div><!-- Button trigger modal -->
                                <button type="button"  wire:click="deleteUser({{$user->id}})" class="btn btn-danger" >
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
                    {{ $users->links() }}

                </div>
            </div>
        </div>




        




        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            @if ($editMode)
            <h5 class="modal-title" id="exampleModalLabel">update  user</h5>

            @else
            <h5 class="modal-title" id="exampleModalLabel">create user</h5>

            @endif
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                

                <div class="form-group row">
                    <label for="username"
                        class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text"
                            class="form-control @error('name') is-invalid @enderror" wire:model.defer="username" 
                            >

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="first_name"
                        class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text"
                            class="form-control @error('name') is-invalid @enderror" wire:model.defer="firstName"
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
                        class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text"
                            class="form-control @error('name') is-invalid @enderror" wire:model.defer="lastName"
                            >

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email"
                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        wire:model.defer="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @if (!$editMode)
                    
              
                 <div class="form-group row">
                    <label for="password"
                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" wire:model.defer="password"
                        >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endif
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" wire:click="closeModel()">Close</button>
          @if ($editMode)
          <button type="button" class="btn btn-primary" wire:click="updateUser()">update</button>

          @else
          <button type="button" class="btn btn-primary" wire:click="createUser()">create</button>

              
          @endif

        </div>
      </div>
    </div>
  </div>
    </div>
</div>
</div>
</div>