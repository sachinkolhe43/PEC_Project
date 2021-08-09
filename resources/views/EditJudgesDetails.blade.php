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
                                Judge Details Form
                            </h3>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">

                            <form action="{{ url('edit_jude_details_submit') }}" method="POST" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                                
                                @csrf
                                
                                <input type="text" class="form-control" id="uid" name="uid" value="{{ $user['id']}}" hidden>
                                
                                <div class="col-md-6 mt-4">
                                    <label for="jtype"  class="form-label">Judge Type</label>
                                    <select class="form-select" aria-label="Default select example" id="jtype" name="jtype" value="{{ $user['jtype']}}" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value="Academic">Academic</option>
                                        <option value="Industry">Industry</option>
                                        
                                    </select>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                
                                    
                                    
                                </div>

                                

                                <div class="col-md-12 mt-4">
                                    <label for="jname" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="jname" name="jname" value="{{ $user['jname']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="jemail" class="form-label">Email ID</label>
                                    <input type="email" class="form-control" id="jemail" name="jemail" value="{{ $user['jemail']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="jmobile" class="form-label">Mobile No.</label>
                                    <input type="mobile" class="form-control" id="jmobile" name="jmobile" value="{{ $user['jmobile']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="jcompany" class="form-label">Company/College Name</label>
                                    <input type="text" class="form-control" id="jcompany" name="jcompany" value="{{ $user['jcompany']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="jexp"   class="form-label">Year Of Experience</label>
                                    <select class="form-select" aria-label="Default select example" id="jexp" name="jexp">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="(0-5)years">(0-5)years</option>
                                        <option value="(5-10)years">(5-10)years</option>
                                        <option value="greater than 10 years">greater than 10 years </option>
                                        
                                    </select>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="jpassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="jpassword" name="jpassword" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>

                                 <script>
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
                                </script>

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
        

        <script>
            var role=document.getElementById("role").value;
            var dept="";
            if(role=="ADMIN" || role=="PRINCIPAL"|| role=="DEAN" || role=="RD")
            { 
                document.getElementById("deptlabel").style.display = "none";
                document.getElementById("udepartment").style.display = "none";
                document.getElementById("udepartment").required = false;
                $("#udepartment option[value='"+dept+"']").attr("selected","selected");
            }
                   
        </script>
@endsection
</body>
</html>
