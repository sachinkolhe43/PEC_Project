<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PC@SPIT</title>
    
</head>
<body>
    @extends('JudgeLayout')

@section('content')

        <script>
            function askNredirect(urltoredirect)
            {
                if ((window.confirm("Are you sure to submit marks?"))) 
                {
                    window.location.href = urltoredirect;
                } else 
                {
                    return false;
                }
            }
        </script>

        @if(session()->has('judgeLogData'))
        @php
        $logInfo=session()->get('judgeLogData');
        foreach( $logInfo as $d )
        {
            $email=$d['jemail'];
        }               
        @endphp
        @endif
        @if (session('data'))
        @php
        $proData=session()->get('data');
        @endphp
        @endif
        <section class="container">                
                    
                    <div class="card m-5" style="border-radius: 10px;">
                        <div class="card-header">
                            <h3>
                                Rubrics Form
                            </h3>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
        
                            <form action="judge_marks_submit" method="post" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                                @csrf
                                <div class="col-12">
                                    <input type="text" hidden value="{{$email}}" id="email" name="email">
                                </div>
                                <div class="row col-12">
                                    <div class="col-md-4 mt-4">
                                        <label for="academic_year" class="form-label">Academic Year</label>
                                        <input type="text" readonly class="form-control" id="academic_year" name="academic_year" value="{{$proData->academic_year}}" required>
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" readonly class="form-control" id="department" name="department" value="{{$proData->department}}" required>
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="project_id" class="form-label">Project ID</label>
                                        <input type="text" readonly class="form-control" id="project_id" name="project_id" value="{{$proData->project_id}}" required>
                                    </div>

                                    <div class="col-md-12 mt-4">                                            
                                        <label for="project_title" class="form-label">Project Title</label>
                                        <textarea readonly class="form-control" id="project_title" name="project_title" required>{{$proData->project_title}}</textarea>
                                    </div>

                                    <div id="studentdetails">
                                    </div>
                                    

                                    <script type='text/javascript'>

                                        $(document).ready(function(){
                                                      
                                             // data
                                            var project_id = $('#project_id').val();
                                            
                                             // Empty the tbody
                                            $('#studentdetails').empty();
                                             
                                             // AJAX request 
                                            $.ajax({
                                                url: 'getStudentDetails',
                                                type: 'get',
                                                data:{project_id:project_id},
                                                dataType: 'json',
                                                success: function(response){
                                    
                                                    var len = 0;
                                                    if(response['data'] != null){
                                                        len = response['data'].length;
                                                    }
                                    
                                                    if(len > 0){
                                                   // Read data and create <option >
                                                        for(var i=0; i<len; i++){
                                                            
                                                            var ucid = response['data'][i].ucid;
                                                            var name = response['data'][i].name;
                                                            var category = response['data'][i].category;
                                                            var det = "<div class='col-md-12 mt-4'>"+
                                                                      "<div class='card' style='border-radius: 10px;'>"+
                                                                      "<div class='card-body'>"+
                                                                      
                                                                      "<div class='row col-12'>"+
                                                                      "<div class='col-md-6 mt-4'>"+
                                                                      "<label for='ucid[]' class='form-label'>UCID</label>"+
                                                                      "<input type='text' readonly class='form-control' id='ucid["+i+"]' name='ucid[]' value='"+ucid+"' required>"+
                                                                      "</div>"+

                                                                      "<div class='col-md-6 mt-4'>"+
                                                                      "<label for='category[]'' class='form-label'>Category</label>"+
                                                                      "<input type='text' readonly class='form-control' id='category["+i+"]' name='category[]' value='"+category+"' required>"+
                                                                      "</div>"+
                                                                      " <div class='col-md-12 mt-4'>"+
                                                                      "<label for='name[]' class='form-label'>Department</label>"+
                                                                      "<input type='text' readonly class='form-control' id='name["+i+"]' name='name[]' value='"+name+"' required>"+
                                                                      "</div>"+
                                                                      
                                        
                                            
                                           
                                                                      "<table class='table table-striped mb-0' >"+
                                                                      "<thead>"+
                                                                      "<tr>"+
                                                                      "<th scope='col'>Performance Indicator</th>"+
                                                                        "<th scope='col'>Exceed Expectation (EE) (4-5)</th>"+
                                                                        "<th scope='col'>Meet Expectation (ME) (2-3)</th>"+
                                                                        "<th scope='col'>Below Expectation (BE) (1)</th>"+
                                                                        "<th scope='col'>Marks Given</th>"+
                                                                        "</tr>"+
                                                                        "</thead>"+
                                                                        "<tbody>"+
                                                                            "<tr>"+
                                                                                "<td>"+
                                                                                    "Demonstration of Project "+
                                                                                "</td>"+
                                                                                "<td>"+
                                                                                    "Demonstration of full knowledge of the subject with explanations and elaboration."+
                                                                                "</td>"+
                                                                                "<td>"+
                                                                                    "At ease with content and able to elaborate and explain to some degree. "+
                                                                                "</td>"+
                                                                                "<td>"+
                                                                                    "Uncomfortable with content. Only basic concepts are demonstrated and interpreted. "+ 
                                                                                "</td>"+
                                                                                "<td>"+
                                                                    "<select class='form-select' aria-label='Default select example' style='width:80px;' id='r1["+i+"]' name='r1[]' onchange='return rTotal()'>"+
                                                                        "<option selected value='1'>1</option>"+
                                                                        "<option value='2'>2</option>"+
                                                                        "<option value='3'>3</option>"+
                                                                        "<option value='4'>4</option>"+
                                                                        "<option value='5'>5</option>"+
                                                                    "</select>"+
                                                                "</td>"+
                                                            "</tr>"+
                                                            "<tr>"+
                                                                "<td>"+
                                                                    "Working of Project"+
                                                                "</td>"+
                                                                "<td>"+
                                                                   " Project Worked as per the explanation given by group members"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "Project worked partially as per the suggested solution"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "There is mismatch between solution suggested and working of project"+ 
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<select class='form-select' aria-label='Default select example' style='width:80px;' id='r2["+i+"]' name='r2[]' onchange='return rTotal()'>"+
                                                                        "<option selected value='1'>1</option>"+
                                                                        "<option value='2'>2</option>"+
                                                                        "<option value='3'>3</option>"+
                                                                        "<option value='4'>4</option>"+
                                                                        "<option value='5'>5</option>"+
                                                                    "</select>"+
                                                                "</td>"+
                                                            "</tr>"+
                                                            "<tr>"+
                                                                "<td>Prototype Development</td>"+
                                                                    
                                                                
                                                                "<td>"+
                                                                   " The students have developed a proper prototype of the project "+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "The students have developed a partial prototype of the project"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "The students don’t have proper prototype of the project. "+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<select class='form-select' aria-label='Default select example' style='width:80px;' id='r3["+i+"]' name='r3[]' onchange='return rTotal()'>"+
                                                                        "<option selected value='1'>1</option>"+
                                                                        "<option value='2'>2</option>"+
                                                                        "<option value='3'>3</option>"+
                                                                        "<option value='4'>4</option>"+
                                                                        "<option value='5'>5</option>"+
                                                                    "</select>"+
                                                                "</td>"+
                                                            "</tr>"+
                                                            "<tr>"+
                                                                "<td>"+
                                                                    "Team Work "+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "Each group member have equal contribution towards project."+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "Majority of the project work is doneby a single person."+
                                                                "</td>"+
                                                                "<td>"+
                                                                 " Complete lack of team work among team members"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<select class='form-select' aria-label='Default select example' style='width:80px;' id='r4["+i+"]' name='r4[]' onchange='return rTotal()'>"+
                                                                        "<option selected value='1'>1</option>"+
                                                                        "<option value='2'>2</option>"+
                                                                        "<option value='3'>3</option>"+
                                                                        "<option value='4'>4</option>"+
                                                                        "<option value='5'>5</option>"+
                                                                    "</select>"+
                                                                "</td>"+
                                                            "</tr>"+
                                                            "<tr>"+
                                                                "<td>"+
                                                                    "Contribution Towards Domain"+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "The project actually contribute towards the problem domain which is discussed in literature survey."+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "The project has some contribution towards solving problem in the discussed problem domain but has partial success."+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "Project do not contribute much towards solving the problem domain discussed in the literature survey."+
                                                                "</td>"+
                                                                "<td>"+
                                                                    "<select class='form-select' aria-label='Default select example' style='width:80px;' id='r5["+i+"]' name='r5[]' onchange='return rTotal()'>"+
                                                                        "<option selected value='1'>1</option>"+
                                                                        "<option value='2'>2</option>"+
                                                                        "<option value='3'>3</option>"+
                                                                        "<option value='4'>4</option>"+
                                                                        "<option value='5'>5</option>"+
                                                                    "</select>"+
                                                                "</td>"+
                                                            "</tr>"+
                                                            "<tr>"+
                                                                "<td></td>"+
                                                                "<td></td>"+
                                                                "<td></td>"+
                                                                "<td><strong>Total</strong></td>"+
                                                                "<td><input type='number' readonly class='form-control' style='width:80px;' id='r_total["+i+"]' name='r_total[]'></td>"+
                                                            "</tr>"+
                                                        "</tbody>"+
                                                    "</table>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>"+
                                    "</div>";
                                    
                        
                                                            
                                                               
                                                                                                     
                                                    $("#studentdetails").append(det);
                                                            
                                                                    
                                                            
                                                        }
                                                    }
                                                }
                                            });
                                        });                                
                                               
                                    </script>
                                    <div class="col-12 mt-4">
                                        <input class="btn btn-outline-info w-100" type="button" onclick="return proav()" value="calculate average" required>
                                    </div>
                                   <div class="col-md-12 mt-4">   
                                        <label for="r_avg" class="form-label">projects Marks</label> 
                                        <div class="input-group mb-3">
                                            <input type="number" readonly class="form-control text-center" id="r_avg" name="r_avg">
                                            <span class="input-group-text">/</span>
                                            <input type="number" class="form-control text-center" value="25" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-outline-success w-100" type="submit" onclick="return askNredirect()">Save</button>
                                    </div>
                                </div> 
                            </form>
                            </blockquote>
                        </div>
                    </div>             
        </section>
        @php
                $cnt=DB::table('students')->select('group_count')->where('project_id',$proData->project_id)->get(); 
                $grp=$cnt[0]->group_count;
        @endphp
        <script>
            function rTotal(){  
                for(var i=0;i<4;i++)
                {
                        var r1=Number(document.getElementById('r1['+i+']').value);
                        var r2=Number(document.getElementById('r2['+i+']').value);
                        var r3=Number(document.getElementById('r3['+i+']').value);
                        var r4=Number(document.getElementById('r4['+i+']').value);
                        var r5=Number(document.getElementById('r5['+i+']').value);
                        document.getElementById('r_total['+i+']').value=r1+r2+r3+r4+r5;
                      
                 }
                 
                 
               
            }
        
                function proav()
                {
                    
                        var av=0;
                        var cnt = {{$grp}};
                       
                        for(var i=0;i<cnt;i++)
                        {
                            var mk=Number(document.getElementById('r_total['+i+']').value);
                            av=av+mk;
                        }
                        document.getElementById('r_avg').value=av/cnt;
                
                }
            
                </script>
@endsection
</body>
</html>