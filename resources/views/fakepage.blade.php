<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Judge Allocation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
@extends('AdminLayout')

@section('content')

<script>
    $(function () {
        @if (session() -> has('allocation-success'))
            Swal.fire({
                icon: 'success',
                title: 'Great!',
                text: '{{ session('allocation-success') }}'
            })
    @endif
        });
</script>
        <section class="container">
            <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">
            <div class="card m-5" style="border-radius: 10px;">
                <div class="card-header">
                    <h3>
                        Project Allocation
                    </h3>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">

                    <form action="judge_allocate_submit" method="POST" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                    @csrf
                        <div class="col-md-6 mt-4">
                            <label for="academic_year" class="form-label">Academic Year</label>
                            <input type="text" readonly class="form-control" id="academic_year" name="academic_year"
                                required>


                            <script>
                                var d = new Date();
                                var curYear = d.getFullYear();
                                var academic_year = curYear - 1 + '-' + (curYear.toString().substr(-2));
                                document.getElementById('academic_year').value = academic_year;

                            </script>

                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="department"  class="form-label">Department</label>
                            <select class="form-select" aria-label="Default select example" id="department" name="department">
                                <option selected disabled value="">Choose...</option>
                                <option value="ETRX">ETRX</option>
                                <option value="EXTC">EXTC</option>
                                <option value="COMP">COMP</option>
                                <option value="IT">IT</option>
                                <option value="MCA">MCA</option>
                            </select>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>

                        

                        <div class="col-md-12 mt-4">
                            <label for="projectid"  class="form-label">Project ID</label>
                            <select class="form-select" aria-label="Default select example" id="projectid" name="projectid">
                                <option selected value="">Choose...</option>   
                                
                            </select>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>

                        <div class="col-md-12 mt-4">
                            <label for="project_title" class="form-label">Project Title</label>
                            <input type="text" class="form-control" readonly id="project_title" name="project_title" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                       @php
                       $judges=DB::table('judges')->select('*')->get();
                        @endphp
                    
                
                        <div class="col-md-12 mt-4">
                            <label for="judgename"  class="form-label">Judge Name</label>
                            <select class="form-select" aria-label="Default select example" id="judgename" name="judgename">
                                <option selected disabled value="">Choose...</option>
                                
                                @foreach ($judges as $j)
                                <option value="{{$j->jemail}}">{{$j->jname}}</option>   
                                @endforeach
                            </select>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        
                       

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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </section>
        <script type='text/javascript'>

            $(document).ready(function(){
             
              // Apply btn click
              $('#department').change(function(){
                
                 // data
                var academic_year = $('#academic_year').val();
                var department = $('#department').val();
                
                 // Empty the dropdown
                $('#projectid').find('option').not(':first').remove();
                 // AJAX request 
                $.ajax({
                    url: 'getUnallotedprojects',
                    type: 'get',
                    data:{ayear:academic_year,dept:department},
                    dataType: 'json',
                    success: function(response){
        
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }
        
                        if(len > 0){
                       // Read data and create <option >
                            for(var i=0; i<len; i++){
        
                                var projectid = response['data'][i].project_id;
                                                    
                                var option = "<option value='"+projectid+"' >"+projectid+"</option>"; 
        
                                $("#projectid").append(option); 
                            }
                        }
                    }
                });
            });

            $('#projectid').change(function(){
                
                 // data
                var projectid = $('#projectid').val();
                           
                 // Empty the dropdown
                
                 // AJAX request 
                $.ajax({
                    url: 'getProjectTitle',
                    type: 'get',
                    data:{projectid:projectid},
                    dataType: 'json',
                    success: function(response){
                          
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                            
                        }
        
                        if(len > 0){
                       // Read data and create <option >
                            var pt = response['data'][0].project_title; 
                            
                            document.getElementById("project_title").value=pt;
                        }
                    }
                });
            });                                
        });
        
        </script>
        @endsection
</body>
</html>
