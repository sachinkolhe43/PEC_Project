<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PC@SPIT</title>
    <style>


        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {display:none;}

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.default:checked + .slider {
            background-color: #444;
        }
        input.primary:checked + .slider {
            background-color: #2196F3;
        }
        input.success:checked + .slider {
            background-color: #8bc34a;
        }
        input.info:checked + .slider {
            background-color: #3de0f5;
        }
        input.warning:checked + .slider {
            background-color: #FFC107;
        }
        input.danger:checked + .slider {
            background-color: #f44336;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>
<body>
@extends('AdminLayout')

@section('content')
    <section class="container">
        <div class="page-header text-center mt-5">

            <h2 id="Report_Heading">PEC Winners</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-2">
                <label for="academic_year" class="form-label">Academic Year</label>
                <select class="form-select" aria-label="Default select example" id="academic_year" name="academic_year" required>
                </select>
                <script>
                    var d = new Date();
                    var curYear = d.getFullYear();
                    for(var i=curYear;i>=2021;i--)
                    {
                        var academic_year= i-1 +'-'+ (i.toString().substr(-2));
                        if(i==d.getFullYear)
                        {
                            var option = "<option selected value='"+academic_year+"'>"+academic_year+"</option>";
                        }
                        else
                        {
                            var option = "<option value='"+academic_year+"'>"+academic_year+"</option>";
                        }
                        $("#academic_year").append(option);
                    }
                </script>
            </div>
            <div class="col-2 mt-4 text-center">
                <label class="switch">
                    <input type="checkbox" id="btnToggle" onchange="return dis()" class="primary">
                    <span class="slider round"></span>
                </label>

                {{-- <input type="text" hidden value="{{$email}}" id="jemail" name="jemail"> --}}
            </div>
            <div class="col-2">
                <label for="from_academic_year" class="form-label">Select Starting Year</label>
                <select class="form-select" disabled aria-label="Default select example" id="from_academic_year" name="from_academic_year" required>
                </select>
                <script>
                    var d = new Date();
                    var curYear = d.getFullYear();
                    curYear=curYear-1;
                    for(var i=curYear;i>=2021;i--)
                    {
                        var academic_year= i-1 +'-'+ (i.toString().substr(-2));
                        if(i==d.getFullYear)
                        {
                            var option = "<option selected value='"+academic_year+"'>"+academic_year+"</option>";
                        }
                        else
                        {
                            var option = "<option value='"+academic_year+"'>"+academic_year+"</option>";
                        }
                        $("#from_academic_year").append(option);
                    }
                </script>
            </div>
            <div class="col-4">
                <script type='text/javascript'>
                    $(document).on('change', '#btnToggle', function(){
                        if($(this).prop('checked')){
                            $('#academic_year').attr('disabled', 'disabled');
                            $('#from_academic_year').removeAttr('disabled');
                        } else {
                            $('#academic_year').removeAttr('disabled');
                            $('#from_academic_year').attr('disabled', 'disabled');
                        }
                    });
                </script>
            </div>
            <div class="col-2" style="margin-top: 32px;">
                <button class="btn btn-primary w-100" onclick="return createPDF()">Print</button>
            </div>
        </div>
        <br>

        <script type='text/javascript'>

            $(document).ready(function(){

                // data
                var academic_year = $('#academic_year').val();

                // Empty the tbody
                $('#papers').find('tr').remove();

                // AJAX request
                $.ajax({
                    url: 'getMyWinners',
                    type: 'get',
                    data:{ayear:academic_year},
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
                                var pro_rank=response['data'][i].pro_rank;

                                if(eval_status=="UNCHECKED")
                                {
                                    var row = "<tr><td>"
                                        +group_id+
                                        "</td><td>"
                                        +pdepartment+
                                        "</td><td>"
                                        +paper_title+
                                        "</td><td id='removelinks'>"
                                        +"<a class='btn btn-info btn-sm' target='_blank' href='view_pdf/"+paper_pdf+"'>View</a>"
                                        +"&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='download_pdf/"+paper_pdf+"'>Download</a>"
                                        +"</td><td id='removelinks'>"
                                        +"<a class='btn btn-primary btn-sm' href='download_ppt/"+paper_ppt+"'>Download</a>"
                                        +"</td><td id='removelinks'>"
                                        +"<a class='btn btn-success btn-sm' id='evalBtn["+i+"]' href='give_marks/"+group_id+"'>Evaluate</a>"
                                        +"</td></tr>";

                                    $("#papers").append(row);
                                }
                                else
                                {
                                    var row = "<tr><td>"
                                        +group_id+
                                        "</td><td>"
                                        +pdepartment+
                                        "</td><td>"
                                        +paper_title+
                                        "</td><td id='removelinks'>"
                                        +"<a class='btn btn-info btn-sm' target='_blank' href='view_pdf/"+paper_pdf+"'>View</a>"
                                        +"&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='download_pdf/"+paper_pdf+"'>Download</a>"
                                        +"</td><td id='removelinks'>"
                                        +"<a class='btn btn-primary btn-sm' href='download_ppt/"+paper_ppt+"'>Download</a>"
                                        +"</td><td id='removelinks'>"
                                        +"<label>Evaluated</label>"
                                        +"</td></tr>";

                                    $("#papers").append(row);
                                }


                            }
                        }
                    }
                });
            });

        </script>

        <script type='text/javascript'>

            $(document).ready(function(){

                // data
                var academic_year = $('#academic_year').val();
                // Empty the tbody
                $('#papers').find('tr').remove();
                // AJAX request
                $.ajax({
                    url: 'getMyWinners',
                    type: 'get',
                    data:{ayear:academic_year},
                    dataType: 'json',
                    success: function(response){

                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                            // Read data and create <option >
                            for(var i=0; i<len; i++){
                                var department = response['data'][i].department;
                                var project_id = response['data'][i].project_id;
                                var project_title = response['data'][i].project_title;
                                var pro_rank = response['data'][i].pro_rank;
                                var project_marks = response['data'][i].project_marks;

                                var row = "<tr><td>"
                                    +department+
                                    "</td><td>"
                                    +pro_rank+
                                    "</td><td>"
                                    +project_id+
                                    "</td><td>"
                                    +project_title+
                                    "</td><td>"
                                    +project_marks+
                                    "</td></tr>";
                                $("#papers").append(row);


                            }
                        }
                    }
                });
            });

        </script>


        <div id="tab1">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true"><strong>ALL</strong></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="extc-tab" data-bs-toggle="tab" data-bs-target="#extc" type="button" role="tab" aria-controls="extc" aria-selected="true"><strong>EXTC</strong></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="etrx-tab" data-bs-toggle="tab" data-bs-target="#etrx" type="button" role="tab" aria-controls="etrx" aria-selected="false"><strong>ETRX</strong></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="comp-tab" data-bs-toggle="tab" data-bs-target="#comp" type="button" role="tab" aria-controls="comp" aria-selected="false"><strong>COMP</strong></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="it-tab" data-bs-toggle="tab" data-bs-target="#it" type="button" role="tab" aria-controls="it" aria-selected="false"><strong>IT</strong></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mca-tab" data-bs-toggle="tab" data-bs-target="#mca" type="button" role="tab" aria-controls="mca" aria-selected="false"><strong>MCA</strong></button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <br><table class="table table-striped text-center" >
                        <thead>
                        <tr>
                            <th scope="col">Department</th>
                            <th scope="col">Rank</th>
                            <th scope="col">Project ID</th>
                            <th scope="col">Project Title</th>
                            <th scope="col" id="removeheading">Total Points</th>
                        </tr>
                        </thead>
                        <tbody id="papers">

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade show" id="extc" role="tabpanel" aria-labelledby="extc-tab">
                    <br><table class="table table-striped text-center" >
                        <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Group ID</th>
                            <th scope="col">Paper Title</th>
                            <th scope="col" id="removeheading">PDF</th>
                            <th scope="col" id="removeheading">PPT</th>
                            <th scope="col" id="removeheading">Total Points</th>
                        </tr>
                        </thead>
                        <tbody id="papers">

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="etrx" role="tabpanel" aria-labelledby="etrx-tab">
                    <br><table class="table table-striped text-center" >
                        <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Group ID</th>
                            <th scope="col">Paper Title</th>
                            <th scope="col" id="removeheading">PDF</th>
                            <th scope="col" id="removeheading">PPT</th>
                            <th scope="col" id="removeheading">Total Points</th>
                        </tr>
                        </thead>
                        <tbody id="papers">

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="comp" role="tabpanel" aria-labelledby="comp-tab">
                    <br><table class="table table-striped text-center" >
                        <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Group ID</th>
                            <th scope="col">Paper Title</th>
                            <th scope="col" id="removeheading">PDF</th>
                            <th scope="col" id="removeheading">PPT</th>
                            <th scope="col" id="removeheading">Total Points</th>
                        </tr>
                        </thead>
                        <tbody id="papers">

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="it" role="tabpanel" aria-labelledby="it-tab">
                    <br><table class="table table-striped text-center" >
                        <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Group ID</th>
                            <th scope="col">Paper Title</th>
                            <th scope="col" id="removeheading">PDF</th>
                            <th scope="col" id="removeheading">PPT</th>
                            <th scope="col" id="removeheading">Total Points</th>
                        </tr>
                        </thead>
                        <tbody id="papers">

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="mca" role="tabpanel" aria-labelledby="mca-tab">
                    <br><table class="table table-striped text-center" >
                        <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Group ID</th>
                            <th scope="col">Paper Title</th>
                            <th scope="col" id="removeheading">PDF</th>
                            <th scope="col" id="removeheading">PPT</th>
                            <th scope="col" id="removeheading">Total Points</th>
                        </tr>
                        </thead>
                        <tbody id="papers">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <script>
        function createPDF() {
            var sTable = document.getElementById('tab1').innerHTML;
            var report_heading = document.getElementById("Report_Heading");

            var style = "<style>";
            style = style + "table {width: 100%;font: 14px Times-New-Roman;rotate:90}";
            style = style + "table, th, td {border: solid 2px #DDD; border-collapse: collapse;";
            style = style + "padding: 3px 3px;text-align: center;}";
            style = style + "#removeheading{display:none;}";
            style = style + "#removelinks{display:none;}";
            style = style + "</style>";

            //Create Window Object
            var win = window.open('', '', 'height=600,width=1200');

            win.document.write('<html><head>');
            win.document.write('<title></title>');   // <title> FOR PDF HEADER.
            win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
            win.document.write('</head>');
            win.document.write('<body>  <center><div id="Heading"> <h1 id="Report_Heading">' + report_heading.innerHTML + '</h1><hr style="width:40%;"> </div></center><br><br>');
            win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
            win.document.write('</body></html>');

            win.document.close(); 	// CLOSE THE CURRENT WINDOW.
            win.print();    // PRINT THE CONTENTS.
        }
    </script>
@endsection
</body>
</html>
