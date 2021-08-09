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
        @if(session()->has('judgeLogData'))
        @php
        $data=session()->get('judgeLogData');
        foreach( $data as $d )
        {
            $email=$d['jemail'];
        }               
        @endphp
        @endif
        <section class="container">

            <div id="tab">
            <table class="table table-striped text-center" >
                <thead>
                <tr>
                    <th scope="col">Project ID</th>
                    <th scope="col">UCID</th>
                    <th scope="col">Name</th>
                    
                    
                </tr>
                </thead>
                <tbody id="projects">
                         @foreach ($users as $u)
                         <tr>
                            <td>{{$u->project_id}}</td>
                            <td>{{$u->ucid}}</td>
                            <td>{{$u->name}}</td>
                            <td  id="removelinks">
                                <a class="btn btn-info btn-sm" href="edit_mentor/{{ $u->id }}">Edit</a>
                                &nbsp;&nbsp;
                                <a class="btn btn-danger btn-sm" href="judge_marking_page" >Evaluate</a>
                            </td>
                            
                            </tr>
                         @endforeach                     
                </tbody>
                
            </table>
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
