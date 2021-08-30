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
        <div class="page-header text-center mt-5">

            <h2 id="Report_Heading">Projects Report</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-3">
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

            <div class="col-2">
                <button class="btn btn-primary w-100" onclick="return createPDF()">Print</button>
            </div>
        </div>
        <br>



        {{-- <script type='text/javascript'>

            $(document).ready(function(){

            // Apply btn click
            $('#academic_year').change(function(){

                 // data
                 var academic_year = $('#academic_year').val();
                var jemail = $('#jemail').val();
                 // Empty the tbody
                $('#projects').find('tr').remove();

                 // AJAX request
                $.ajax({
                    url: 'getMyAllotedProjects',
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
                                var project_pdf = response['data'][i].project_pdf;
                                var project_vid = response['data'][i].project_vid;
                                var eval_status=response['data'][i].eval_status;

                                if(eval_status=="UNCHECKED")
                                {
                                    var row = "<tr><td>"
                                            +project_id+
                                            "</td><td>"
                                            +department+
                                            "</td><td>"
                                            +project_title+
                                            "</td><td id='removelinks'>"
                                            +"<a class='btn btn-info btn-sm' target='_blank' href='view_pdf/"+project_pdf+"'>View</a>"
                                            +"&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='download_pdf/"+project_pdf+"'>Download</a>"
                                            +"</td><td id='removelinks'>"
                                            +"<a class='btn btn-primary btn-sm' href='download_vid/"+project_vid+"'>Download</a>"
                                            +"</td><td id='removelinks'>"
                                            +"<a class='btn btn-success btn-sm' id='evalBtn["+i+"]' href='give_marks/"+project_id+"'>Evaluate</a>"
                                            +"</td></tr>";

                                        $("#projects").append(row);
                                }
                                else
                                {
                                    var row = "<tr><td>"
                                            +project_id+
                                            "</td><td>"
                                            +department+
                                            "</td><td>"
                                            +project_title+
                                            "</td><td id='removelinks'>"
                                            +"<a class='btn btn-info btn-sm' target='_blank' href='view_pdf/"+project_pdf+"'>View</a>"
                                            +"&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='download_pdf/"+project_pdf+"'>Download</a>"
                                            +"</td><td id='removelinks'>"
                                            +"<a class='btn btn-primary btn-sm' href='download_vid/"+project_vid+"'>Download</a>"
                                            +"</td><td id='removelinks'>"
                                            +"<label>Evaluated</label>"
                                            +"</td></tr>";

                                        $("#projects").append(row);
                                }


                            }
                        }
                    }
                });
            });
        });

        </script> --}}

        <div id="tab">
            <table class="table table-striped text-center" >
                <thead>
                <tr>
                    <th scope="col">Department</th>
                    <th scope="col">Project ID</th>
                    <th scope="col">Project Title</th>
                    <th scope="col">Mentor Name</th>
                    <th scope="col">Mentor Department</th>





                </tr>
                </thead>
                <tbody id="project_report_sheet">

                </tbody>
            </table>
        </div>

        <script type='text/javascript'>

            $(document).ready(function(){

                // data
                var academic_year = $('#academic_year').val();
                // Empty the tbody
                $('#project_report_sheet').find('tr').remove();
                // AJAX request
                $.ajax({
                    url: 'getProjectsReport',
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
                                var mentor_name = response['data'][i].mentor_name;
                                var mentor_dept = response['data'][i].mentor_dept;

                                var row = "<tr><td>"
                                    +department+
                                    "</td><td>"
                                    +project_id+
                                    "</td><td>"
                                    +project_title+
                                    "</td><td>"
                                    +mentor_name+
                                    "</td><td>"
                                    +mentor_dept+
                                    "</td></tr>";
                                $("#project_report_sheet").append(row);


                            }
                        }
                    }
                });
            });

        </script>

    </section>
    <script>
        function createPDF() {
            var sTable = document.getElementById('tab').innerHTML;
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
