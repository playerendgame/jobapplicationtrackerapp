<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/loginregistration.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.jpg') }}">
    <title>Job Application Tracker</title>
</head>
<body>
    

    <div class="loginmainContainer container-md">

        <div class="formRow row pt-5">

            <div class="formContainer container-md">

                <!--Loginform-->
                <form method="GET" action="login.user">
                  @csrf

                    <Div class="username-Container pb-3">

                        <label class="">Username:</label>
                        <input type="text" name="loginusername" class="form-control" required>
    
                    </Div>

                    <Div class="password-Container pb-5">

                        <label class="">Password:</label>
                        <input type="password" name="loginpassword" class="form-control" required>
        
                    </Div>

                    <Div class="buttons-container">

                        <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#register">Register</button>
        
                        <button class="btn btn-primary" type="submit">Login</button>

                    </Div>

                    @if (session('loginError'))

                    <script>

                        alert('{{ session('loginError') }}');
                        
                    </script>
    
                    @endif
    
                </form>

                <!--Modal For Register-->
                <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                    <div class="modal-dialog modal-dialog-centered">

                      <div class="modal-content">

                        <div class="modal-header">

                          <h1 class="modal-title fs-5" id="exampleModalLabel">Register Account</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>

                        <div class="modal-body">
                        
                            <form method="POST" action="add.user">
                              @csrf
            
                                <Div class="username-Container pb-3">
            
                                    <label class="">Username:</label>
                                    <input type="text" name="regusername" class="form-control" required>
                
                                </Div>

                                <Div class="email-Container pb-3">
            
                                    <label class="">Email:</label>
                                    <input type="email" name="regemail" class="form-control" required>
                
                                </Div>
            
                                <Div class="password-Container pb-4">
            
                                    <label class="">Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                    
                                </Div>

                                <Div class="confirmPassword-Container pb-4">
            
                                    <label class="">Confirm Password:</label>
                                    <input type="password" name="confirmpassword" class="form-control" required>
                    
                                </Div>
                
                    

                        </div>

                            <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>

                            </div>

                        </form>

                        @if(session('adduser'))

                        <script>
        
                            alert('{{ session('adduser') }}');
        
                        </script>

                        @elseif (session('regpassword'))

                        <script>

                            alert('{{ session('regpassword') }}');
                            
                        </script>
        
                        @endif

                      </div>

                    </div>

                   

                  </div>

            </div>

        </div>

        <div class="row pt-4">

            <h5 class="h6 text-center">Job Tracker App Made By: Clyde Timothy R. Sumabat</h5>

        </div>

    </div>

</body>
</html>