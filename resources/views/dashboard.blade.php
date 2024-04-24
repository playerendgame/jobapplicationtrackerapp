<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Job Application - Dashboard</title>
</head>
<body>
    
    <div class="container-md pt-5">

        <div class="upperSection row">

            <div class="col-md-6">

                <h4 class="display-4">Hello {{ auth()->user()->regusername }}</h4>

            </div>

            <div class="col-md-6">

               <div class="Buttons p-3 d-flex float-end">

                <button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#addJob">Add Job Application</button> &nbsp; &nbsp; 

                <form action="user.logout" method="POST"> 
                    @csrf
                    <button class="btn btn-danger" type="submit">Log Out</button>


                </form>

               </div>

            </div>

             <!--Modal For Add Job-->
            <div class="modal fade" id="addJob" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                <div class="modal-dialog modal-dialog-centered">

                  <div class="modal-content">

                    <div class="modal-header">

                      <h1 class="modal-title fs-5" id="exampleModalLabel">Add Job</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">
                    
                        <form method="POST" action="add.job">
                          @csrf
        
                            <!-- Hidden input field to store the user's id -->
                            <input type="hidden" name="users_id" value="{{ Auth::id() }}">

                            <Div class="companyName-Container pb-3">
        
                                <label class="">Company Name:</label>
                                <input type="text" name="companyName" class="form-control">
            
                            </Div>

                            <Div class="jobPosition-Container pb-3">
        
                                <label class="">Job Position:</label>
                                <input type="text" name="jobPosition" class="form-control">
            
                            </Div>
        
                            <Div class="platform-Container pb-4">
        
                                <label class="">Platform:</label>
                                <input type="text" name="platform" class="form-control">
                
                            </Div>

                            <Div class="status-Container pb-4">
        
                                <label class="">Status:</label>
                                <input type="text" name="status" class="form-control">
                
                            </Div>

                            <Div class="notes-Container pb-4">
        
                                <label class="">Notes:</label>
                                <textarea class="form-control" name="notes"></textarea>
                
                            </Div>
                            

                    </div>

                        <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>

                        </div>

                    </form>

                    @if (session('status'))

                        <script>

                            alert('{{ session('status') }}');
                            
                        </script>
        
                    @endif

                  </div>

                </div>

            </div>

        </div>
        &nbsp; &nbsp; &nbsp;
        <div class="jobtrackerSection row pt-5">

            <div class="col-md-6 ">

                <h4 class="h4 pb-2">
                    <b>
                        Job Application Tracker:
                    </b>
                </h4>

            </div>
         
            <div class="col-md-6 ">

                <div class="searchcontainer d-flex pb-3 float-end">

                    <form>
    
                        <input type="search" name="jobSearch" class="form-control" placeholder="Search By Company Or Position" value="{{ request('jobSearch') }}" style="width: 20rem;">
    
                    </form>
    
                </div>

            </div>
            

            <div class="table-responsive-md">

                @if($jobDetails)
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Job Position</th>
                        <th scope="col">Job Platform Applied</th>
                        <th scope="col">Date Applied</th>
                        <th scope="col">Status</th>
                        <th scope="col">Notes</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($jobDetails as $jobDetail)
                        
                      <tr>
                        <th scope="row">{{ $jobDetail->id }}</th>
                        <td>{{ $jobDetail->companyName }}</td>
                        <td>{{ $jobDetail->jobPosition }}</td>
                        <td>{{ $jobDetail->platform }}</td>
                        <td>{{ $jobDetail->created_at }}</td>
                        <td>{{ $jobDetail->status }}</td>
    
                        <td>
    
                            <textarea class="form-control" disabled>{{ $jobDetail->notes }} </textarea>
    
                        </td>
                        
                        <td>

                            <div class="buttonsAction d-inline-flex">

                                <!--Button for modal that updates Job Details if clicked per ID-->
                                <button class="btn btn-primary" type="button" onclick="openUpdateModal({{ $jobDetail->id }}, '{{ $jobDetail->companyName }}', '{{ $jobDetail->jobPosition }}', '{{ $jobDetail->platform }}', '{{ $jobDetail->status }}', '{{ $jobDetail->notes }}')" data-bs-toggle="modal" data-bs-target="#updateStatus">    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>

                                    </span>
                                </button>
                                &nbsp;  &nbsp;
                                <form method="POST" action="{{ url('delete.job/'.$jobDetail->id) }}"> 
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                        <span>
            
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                            </svg>
            
                                        </span>
                                    </button>
                                </form> 

                                @if (session('deleteStatus'))

                                <script>
    
                                    alert('{{ session('deleteStatus') }}');
                                    
                                </script>
    
                                @endif

                            </div>
                        
                        </td>
    
                      </tr>
                      @endforeach
                    </tbody>
                </table>

                 <!-- Pagination links -->
                <div class="pagination-container d-flex justify-content-center mt-4">

                    {{ $jobDetails->links() }}

                </div>

                @else

                <p>No job details found.</p>

                @endif

            </div>
          

            <!--Modal For Update Status-->
            <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                <div class="modal-dialog modal-dialog-centered">

                  <div class="modal-content">

                    <div class="modal-header">

                      <h1 class="modal-title fs-5" id="exampleModalLabel">Add Job</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">
                    
                        <form method="POST" action="{{ route('update.job') }}">
                            @csrf
                            <!-- Include input fields for updating job details -->
                            <input type="hidden" name="job_id" id="job_id">

                            <div class="companyName-Container pb-3">
                                <label class="">Company Name:</label>
                                <input type="text" name="companyName" id="companyName" class="form-control">
                            </div>
                            <div class="jobPosition-Container pb-3">
                                <label class="">Job Position:</label>
                                <input type="text" name="jobPosition" id="jobPosition" class="form-control">
                            </div>
                            <div class="platform-Container pb-4">
                                <label class="">Platform:</label>
                                <input type="text" name="platform" id="platform" class="form-control">
                            </div>
                            <div class="status-Container pb-4">
                                <label class="">Status:</label>
                                <input type="text" name="status" id="status" class="form-control">
                            </div>
                            <div class="notes-Container pb-4">
                                <label class="">Notes:</label>
                                <textarea class="form-control" id="notes" name="notes"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>

                  </div>

                </div>

            </div>

        </div>

        <div class="row pt-4 pb-4">

            <h5 class="h6 text-center">Job Tracker App Made By: Clyde Timothy R. Sumabat</h5>

        </div>

    </div>

    <script src={{ asset('javascript/updateModals.js') }}></script>

</body>
</html>