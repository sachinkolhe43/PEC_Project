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
                if ((window.confirm("Are you sure to remove record permanantly?"))) 
                {
                    window.location.href = urltoredirect;
                } else 
                {
                    return false;
                }
            }
        </script>

        <script>                
            $(function(){
                @if(session()->has('user-update-success'))
                    
                    Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '{{ session()->pull('user-update-success') }}'
                    })

                {{ session()->forget('user-update-success') }}
                {{ session()->save() }}

                @endif
                
            });
        </script> 

      
        <script>                
            $(function(){
                @if(session()->has('user-remove-success'))
                    Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '{{ session('user-remove-success') }}'
                })
                @endif
            });
        </script>

        <section class="container">
            <div class="page-header text-center mt-5">
               
                <h2 id="Report_Heading">User Report</h2>
                <hr>
            </div>
            <div class="row">
                <div class="col-10">
                </div>
                <div class="col-2">
                    <button class="btn btn-primary w-100" onclick="return createPDF()">Print</button>
                </div>
            </div>
            <br>
            @php
                $users = DB::table('otherusers')->select('*')->get();
            @endphp 

            <div id="tab">
            <table class="table table-striped text-center" >
                <thead>
                <tr>
                    <th scope="col">Role</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">Password</th>
                    <th scope="col" id="removeheading">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                         
                    <tr>
                        <td>{{ $user->Role }}</td>
                        <td>{{ $user->uname }}</td>
                        <td>{{ $user->uemail }}</td>
                        <td>{{ $user->umobile }}</td>
                        <td>{{ $user->upassword }}</td>
                        <td  id="removelinks">
                            <a class="btn btn-info btn-sm" href="edit_other_user/{{ $user->id }}">Edit</a>
                            &nbsp;&nbsp;
                            <a class="btn btn-danger btn-sm" href="remove_otheruser/{{ $user->id }}" onclick="return askNredirect()">Remove</a>
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
