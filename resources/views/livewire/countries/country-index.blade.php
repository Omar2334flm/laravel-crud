<div>
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">countries</h1>
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
                        <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      Create
                    </button>                    
                </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Country Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($countries as $country)
                            <tr>
                                <th scope="row">{{ $country->id }}</th>
                                <td>{{ $country->counrty_code }}</td>
                                <td>{{ $country->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" wire:click="showEditModel({{$country->id}})">
                                        Edit
                                      </button>
                                      <button type="button" class="btn btn-success" wire:click="DeleteCountry({{$country->id}})">
                                        Delete
                                      </button>
                                </td>
                            </tr>
                            @empty
                            <td>
                                <th>
                                    No Results
                                </th>
                            </td>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $countries->links() }}
    
                </div>
            </div>
           
        </div>
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form>
                

                <div class="form-group row">
                    <label for="country_code"
                        class="col-md-4 col-form-label text-md-right">{{ __('Country Code') }}</label>

                    <div class="col-md-6">
                        <input id="country_code" type="text"
                            class="form-control @error('name') is-invalid @enderror" wire:model.defer="country_code"
                            >

                        @error('country_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        wire:model.defer="name">

                        @error('name')
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
         @if ($editmode)
         <button type="button" class="btn btn-primary" wire:click="editCountry()">update Country</button>
     @else
            
     
     <button type="button" class="btn btn-primary" wire:click="createCountry()">Add Country</button>
        
     @endif
    
    </div>
      </div>
    </div>
  </div>
    </div>
</div>
