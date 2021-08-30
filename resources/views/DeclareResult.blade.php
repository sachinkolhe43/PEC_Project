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
    <script>
        function askNredirect(urltoredirect)
        {
            if ((window.confirm("Are you sure to store all marks permanantly?")))
            {
                window.location.href = urltoredirect;
            } else
            {
                return false;
            }
        }
    </script>



    <section class="container">
        <div class="page-header text-center mt-5">

            <h2 id="Report_Heading">Declare Results</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-3">
                <label for="academic_year" class="form-label">Academic Year</label>
                <input type="text" readonly class="form-control" id="academic_year" name="academic_year" required>
                <script>
                    var d = new Date();
                    var curYear = d.getFullYear();
                    var curMonth = d.getMonth();
                    var academic_year="";
                    if(curMonth<=8)
                    {
                        academic_year= curYear-1 +'-'+ (curYear.toString().substr(-2));
                    }
                    else
                    {
                        academic_year= curYear +'-'+ ((curYear+1).toString().substr(-2));
                    }

                    document.getElementById('academic_year').value= academic_year;

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
                    <th scope="col">Project ID</th>
                    <th scope="col">Department</th>
                    <th scope="col">Project Title</th>

                    <th scope="col">Evaluation Status</th>


                </tr>
                </thead>
                <tbody id="projectmarks">

                </tbody>
            </table>
        </div>

        <script type='text/javascript'>

            $(document).ready(function(){

                // data
                var academic_year = $('#academic_year').val();

                // Empty the tbody
                $('#projectmarks').find('tr').remove();

                // AJAX request
                $.ajax({
                    url: 'getAllProjects',
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

                                var eval_status = response['data'][i].eval_status;

                                var row = "<tr><td>"
                                    +project_id+
                                    "</td><td>"
                                    +department+
                                    "</td><td>"
                                    +project_title+
                                    "</td><td>"
                                    +eval_status+
                                    "</td></tr>";
                                $("#projectmarks").append(row);


                            }
                        }
                    }
                });
            });

        </script>

        <div class="col-12 mt-4">
            <a class="btn btn-outline-primary" id="getResults" href = "javascript:;" onclick = "this.href='declare_final_result/'+ document.getElementById('academic_year').value">Declare Results</a>        </div>
        <script>
            $('#getResults').click(function(e) {
                askNredirect();
            });
        </script>
        </div>
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
