<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PC@SPIT</title>
    
</head>
<body>
    @extends('AdminLayout')

@section('content')

        <section class="container">
            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-8">
                    <div class="card m-5" style="border-radius: 10px;">
                        <div class="card-header">
                            <h3>
                                User Details Form
                            </h3>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">

                            <form action="{{ url('edit_otheruser_submit') }}" method="POST" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                                
                                @csrf
                                
                                <input type="text" class="form-control" id="uid" name="uid" value="{{ $user['id']}}" hidden>
                                
                                <div class="col-md-6 mt-4">
                                    <label for="Role"  class="form-label">Role</label>
                                    <select class="form-select" aria-label="Default select example" id="Role" name="Role">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="Dean">Dean</option>
                                        <option value="Principal">Principal</option>
                                        <option value="ADMIN">Admin</option>
                                    </select>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                
                                    {{-- <script>
                                        $("#role option[value='{{ $user['Role'] }}']").attr("selected","selected");
                                    </script> --}}
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>

                                

                                <div class="col-md-12 mt-4">
                                    <label for="uname" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="uname" name="uname" value="{{ $user['uname']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="uemail" class="form-label">Email ID</label>
                                    <input type="email" class="form-control" id="uemail" name="uemail" value="{{ $user['uemail']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="umobile" class="form-label">Mobile No.</label>
                                    <input type="mobile" class="form-control" pattern="\d{10}" title="Enter a valid phone number"  id="umobile" name="umobile" value="{{ $user['umobile']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                
                                <div class="col-md-12 mt-4">
                                    <label for="upwd" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="upassword" name="upassword"  required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>

                                {{-- <script>
                                    function getExtraField()
                                    {
                                        var role=document.getElementById("role").value;
                                        var dept="";
                                        if(role=="ADMIN" || role=="PRINCIPAL"|| role=="DEAN" || role=="R&D")
                                        { 
                                            $("#udepartment option[value='"+dept+"']").attr("selected","selected");
                                            document.getElementById("deptlabel").style.display = "none";
                                            document.getElementById("udepartment").style.display = "none";
                                            document.getElementById("udepartment").required = false;          
                                        }
                                        if(role=="JUDGE")
                                        { 
                                            document.getElementById("deptlabel").style.display="block" ;
                                            document.getElementById("udepartment").style.display="block" ;
                                            document.getElementById("udepartment").required = true;
                                            $("#udepartment option[value='"+dept+"']").attr("selected","selected");
                                        }
                                    }
                                </script> --}}

                                <div class="col-12">
                                    <button class="btn btn-outline-success w-100" type="submit">Save</button>
                                </div>
                            </form>
                            
                        </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-2">

                </div>
            </div>
        </section>
        

        
@endsection
</body>
</html>
