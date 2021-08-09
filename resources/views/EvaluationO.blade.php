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
        
                            <form action="rubrics_submit" method="post" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                                @csrf
                                

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-outline-success w-100" type="submit" onclick="return askNredirect()">Save</button>
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
