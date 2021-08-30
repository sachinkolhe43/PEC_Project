<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PC@SPIT</title>
    
</head>
<body>
    @extends('JudgeMarkingLayout')

@section('content')
<script>
    function askNredirect(urltoredirect)
    {
        if ((window.confirm("Are you sure to submit all members marks?"))) 
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
        $data=session()->get('judgeLogData');
        foreach( $data as $d )
        {
            $email=$d['jemail'];
        }               
        @endphp
        @endif
        @if (session('data'))
        @php
        $members=session()->get('data');
        @endphp
        @endif
        <section class="container">
            <div class="page-header text-center mt-5">
               
                <h2 id="Report_Heading">Project Members</h2>
                <hr>
            </div>
            <div class="row">
                
                    <input type="text" hidden value="{{$email}}" id="jemail" name="jemail">
            </div>
            <br>
            
            
            <div id="tab">
            <table class="table table-striped text-center" >
                <thead>
                <tr>
                    <th scope="col">Project ID</th>
                    <th scope="col">UCID</th>
                    <th scope="col">Student Name</th>
                    <th scope="col" id="removeheading">Action</th>
                </tr>
                </thead>
                <tbody id="projects">
                    @foreach ($members as $m)
                    @php
                      $pid=$m->project_id; 
                    @endphp
                     
                    <tr>
                        <th>{{$m->project_id}}</th>
                        <th>{{$m->ucid}}</th>
                        <th>{{$m->name}}</th>
                        @if ($m->proj_eval_status=="UNCHECKED")
                        <th><a class="btn btn-success btn-sm"  href="give_marks/{{$m->ucid}}">Evaluate</a></th>
                        @else
                        <th><a class="btn btn-info btn-sm"  href="edit_judge_marks/{{$m->ucid}}">Edit</a></th>  
                        @endif
                        
                    </tr>
                    @endforeach                           
                </tbody>
            </table>
            
            </div>
            <div class="col-12 mt-4">
                <a class="btn btn-outline-info w-100" href="submit_project_marks/{{$pid}}" onclick="return askNredirect()">Submit Project Marks</a>
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
