@if (session()->has('adminLogData'))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Event</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


   <script>
    $(document).ready(function() {
       function disablePrev() { window.history.forward() }
       window.onload = disablePrev();
       window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
   </script>
</head>
<body>
    @extends('AdminLayout')

@section('content')

        <section class="container">
                    <script>
                    @if(session()->has('allotment-success'))
                    Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '{{ session('allotment-success') }}'
                    })
                    @endif
                    </script>
                    <div class="card m-5" style="border-radius: 10px;">
                        <div class="card-header">
                            <h3>
                                Judge Allocation
                            </h3>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">

                            <form action="project_allotment_page" method="get" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                                @csrf
                                <div class="row col-12">
                                    <div class="col-md-2 mt-4">
                                        <label for="academic_year" class="form-label">Academic Year</label>
                                        <input type="text" readonly class="form-control" id="academic_year" name="academic_year" required>
                                        <script>
                                            var d = new Date();
                                            var curYear = d.getFullYear();
                                            var academic_year = curYear - 1 + '-' + (curYear.toString().substr(-2));
                                            document.getElementById('academic_year').value = academic_year;
            
                                        </script>
                                        {{-- <script>
                                            var d = new Date();
                                            var curYear = d.getFullYear();
                                            var curMonth = d.getMonth();
                                            var academic_year="";
                                            if(curMonth<=7)
                                            {
                                                academic_year= curYear-1 +'-'+ (curYear.toString().substr(-2));
                                            }
                                            else
                                            {
                                                academic_year= curYear +'-'+ ((curYear+1).toString().substr(-2));
                                            }

                                            document.getElementById('academic_year').value= academic_year;

                                        </script> --}}
                                    </div>

                                    <div class="col-md-2 mt-4">
                                        <label for="jtype" class="form-label">Judge Type</label>
                                        <select class="form-select" aria-label="Default select example" id="jtype" name="jtype" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Academic">Academic</option>
                                            <option value="Industry">Industry</option>

                                        </select>
                                        <span class="error-msg" id="dept-msg">
                                       </span>
                                    </div>

                                    <script type='text/javascript'>

                                        $(document).ready(function(){

                                          // Department Change
                                        $('#jtype').change(function(){

                                             // Department
                                            var id = $(this).val();

                                             // Empty the dropdown
                                            $('#judges').find('option').not(':first').remove();

                                             // AJAX request
                                            $.ajax({
                                                url: 'getJudges/'+id,
                                                type: 'get',
                                                dataType: 'json',
                                                success: function(response){

                                                    var len = 0;
                                                    if(response['data'] != null){
                                                        len = response['data'].length;
                                                    }

                                                    if(len > 0){
                                                   // Read data and create <option >
                                                        for(var i=0; i<len; i++){

                                                            var id = response['data'][i].jemail;
                                                            var name = response['data'][i].jname;

                                                            var option = "<option value='"+id+"'>"+name+"</option>";

                                                            $("#judges").append(option);
                                                        }
                                                    }
                                                }
                                            });
                                        });
                                    });

                                    </script>

                                    <div class="col-md-4 mt-4">
                                        <label for="judges" class="form-label">Judge Name</label>
                                        <select class="form-select" aria-label="Default select example" id="judges" name="judges" required>
                                            <option selected value="">Choose...</option>

                                        </select>
                                        <span class="error-msg" id="dept-msg">
                                        </span>
                                    </div>

                                    <script type='text/javascript'>

                                        $(document).ready(function(){

                                            $('#cancel').click(function(){
                                            $('#jtype').removeAttr('disabled');
                                            $('#judges').removeAttr('disabled');




                                             // Empty the dropdown
                                            $('#alloted').find('option').remove();



                                        });

                                          // Apply btn click
                                        $('#apply').click(function(){
                                            $('#jtype').attr('disabled', 'disabled');
                                            $('#judges').attr('disabled', 'disabled');

                                             // data
                                            var academic_year = $('#academic_year').val();
                                            var jemail = $('#judges').val();

                                             // Empty the dropdown
                                            $('#alloted').find('option').remove();

                                             // AJAX request
                                            $.ajax({
                                                url: 'getAllotedPapers',
                                                type: 'get',
                                                data:{ayear:academic_year,jemail:jemail},
                                                dataType: 'json',
                                                success: function(response){

                                                    var len = 0;
                                                    if(response['data'] != null){
                                                        len = response['data'].length;
                                                    }

                                                    if(len > 0){
                                                   // Read data and create <option >
                                                        for(var i=0; i<len; i++){

                                                            var project_id = response['data'][i].project_id;
                                                            var department = response['data'][i].department;
                                                            var project_title = response['data'][i].project_title;

                                                            var option = "<option value='"+project_id+"' data-dept='"+department+"' data-project='"+project_title+"'>"+project_id+"  "+department+"  "+project_title+"</option>";

                                                            $("#alloted").append(option);
                                                        }
                                                    }
                                                }
                                            });
                                        });
                                    });

                                    </script>
                                    <div class="col-md-2" style="margin-top:53px;">
                                        <input type="button" class="btn btn-outline-primary w-100" id="apply" value="Apply"/>
                                    </div>
                                    <div class="col-md-2" style="margin-top:53px;">
                                        <input type="button" class="btn btn-outline-danger w-100" id="cancel" value="Cancel"/>
                                    </div>

                                    <script type="text/javascript">
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });


                                    $(document).ready(function(){

                                        $("#btnAdd").click(function(e){

                                            e.preventDefault();

                                            var academic_year = $('#academic_year').val();

                                            var jemail = $('#judges').val();

                                            var projectid=$('#unalloted > option:selected').val();
                                            var dept=$('#unalloted').find('option:selected').attr('data-dept');
                                            var title=$('#unalloted').find('option:selected').attr('data-project');

                                            var url = '{{ url('addPaper') }}';

                                            $.ajax({
                                                url:url,
                                                method:'get',
                                                data:{
                                                        ayear:academic_year,
                                                        jemail:jemail,
                                                        projectid:projectid,
                                                        dept:dept,

                                                    title:title
                                                },
                                                success:function(response){

                                                    if(response.success){
                                                        $('#unalloted > option:selected').appendTo('#alloted');

                                                    }else{
                                                        alert("There was an error...")
                                                    }
                                                },
                                                error:function(error){
                                                    // console.log(error)
                                                }
                                            });
                                        });
                                        $("#btnRemove").click( function(e){

                                            e.preventDefault();

                                            var prid=$('#alloted > option:selected').val();

                                            $.ajax({
                                                url:'removePaper/'+prid,
                                                method:'get',
                                                success:function(response){

                                                    if(response.success){
                                                        $('#alloted > option:selected').appendTo('#unalloted');

                                                    }else{
                                                        alert("There was an error...")
                                                    }
                                                },
                                                error:function(error){
                                                    // console.log(error)
                                                }
                                            });
                                        });
                                    });

                                    </script>

                                    <div class="row col-md-12">
                                        <div class="col-md-5 mt-4">
                                            <label for="alloted" class="form-label">Alloted Projects</label>
                                            <select class="form-select" size="10" aria-label="Default select example" id="alloted" name="alloted" >

                                            </select>
                                            <span class="error-msg" id="dept-msg">
                                            </span>
                                        </div>
                                        <div class="col-md-2 mt-4 text-center">

                                            <input type="button" class="btn btn-sm btn-info mt-5" id="btnAdd" value="Add"/><br />

                                            <input type="button" class="btn btn-sm btn-info mt-2" id="btnRemove" value="Remove"/><br />

                                        </div>
                                        @php
                                            $unallotedPapers=DB::table('projects')->select('*')->where('project_assign_status','UNASSIGNED')->get();
                                        @endphp
                                        <div class="col-md-5 mt-4">
                                            <label for="unalloted" class="form-label">Unalloted Projects</label>
                                            <select class="form-select" size="10" aria-label="Default select example" id="unalloted" name="unalloted" >
                                                @foreach ($unallotedPapers as $up)
                                                <option value="{{ $up->project_id }}" data-dept="{{ $up->department }}" data-project="{{ $up->project_title }}">{{ $up->project_id }}&nbsp;&nbsp;{{ $up->department }}&nbsp;&nbsp;{{ $up->project_title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-msg" id="dept-msg">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-outline-success w-100" type="submit">Done</button>
                                    </div>
                                </div>
                            </form>
                            </blockquote>
                        </div>
                    </div>
        </section>
@endsection
</body>
</html>
@else
<script>
    window.location = "login";
  </script>
@endif
