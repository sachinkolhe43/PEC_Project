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

                            <form action="judge_edit_marks_submit" method="post" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                                @csrf
                                <div class="col-12">
                                    <input type="text" hidden value="{{$email}}" id="email" name="email">
                                    <input type="text" hidden value="{{$proData->id}}" id="mid" name="mid">
                                </div>
                                <div class="row col-12">
                                    <div class="col-md-4 mt-4">
                                        <label for="academic_year" class="form-label">Academic Year</label>
                                        <input type="text" readonly class="form-control" id="academic_year" name="academic_year" value="{{$proData->academic_year}}"  required>
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" readonly class="form-control" id="department" name="department" value="{{$proData->department}}" required>
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="project_id" class="form-label">Project ID</label>
                                        <input type="text" readonly class="form-control" id="project_id" name="project_id" value="{{$proData->project_id}}" required>
                                    </div>









                                    <div class="col-md-4 mt-4">
                                        <label for="ucid" class="form-label">UCID</label>
                                        <input type="text" readonly class="form-control" id="ucid" name="ucid" value="{{$proData->ucid}}" required>
                                    </div>

                                    <div class="col-md-8 mt-4">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" readonly class="form-control" id="name" name="name" value="{{$proData->name}}" required>
                                    </div>


                                    <div class="col-md-12 mt-4">
                                        <div class="card" style="border-radius: 10px;">
                                            <div class="card-header">
                                                <h5>
                                                    Rubrics
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table table-striped mb-0" >
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Performance Indicator</th>
                                                                <th scope="col">Exceed Expectation (EE) (5-4)</th>
                                                                <th scope="col">Meet Expectation (ME) (3-2)</th>
                                                                <th scope="col">Below Expectation (BE) (1)</th>
                                                                <th scope="col">Marks Given</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Demonstration
                                                                    of
                                                                    Project                                                                </td>
                                                                <td>
                                                                    Demonstration of
                                                                    full knowledge of
                                                                    the subject with
                                                                    explanations and
                                                                    elaboration.
                                                                </td>
                                                                <td>
                                                                    At ease with content
                                                                    and able to elaborate
                                                                    and explain to some
                                                                    degree.
                                                                </td>
                                                                <td>
                                                                    Uncomfortable with
                                                                    content.
                                                                    Only basic concepts
                                                                    are demonstrated and
                                                                    interpreted.
                                                                </td>
                                                                <td>
                                                                    <select class="form-select" aria-label="Default select example" style="width:80px;" id="p1" name="p1" onchange="return MTotal()">
                                                                        <option selected value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Working of
                                                                    Project
                                                                </td>
                                                                <td>
                                                                    Project Worked as
                                                                    per the
                                                                    explanation given
                                                                    by group
                                                                    members
                                                                </td>
                                                                <td>
                                                                    Project worked
                                                                    partially as per the
                                                                    suggested solution                                                                </td>
                                                                <td>
                                                                    There is mismatch
                                                                    between solution
                                                                    suggested and
                                                                    working of project                                                                </td>
                                                                <td>
                                                                    <select class="form-select" aria-label="Default select example" style="width:80px;" id="p2" name="p2" onchange="return MTotal()">
                                                                        <option selected value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Prototype
                                                                    Development                                                                </td>
                                                                <td>
                                                                    The students have
                                                                    developed a
                                                                    proper prototype
                                                                    of the project                                                                 </td>
                                                                <td>
                                                                    The students have
                                                                    developed a partial
                                                                    prototype of the
                                                                    project
                                                                </td>
                                                                <td>
                                                                    The students don’t
                                                                    have proper prototype
                                                                    of the project.                                                                 </td>
                                                                <td>
                                                                    <select class="form-select" aria-label="Default select example" style="width:80px;" id="p3" name="p3" onchange="return MTotal()">
                                                                        <option selected value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Team Work                                                                </td>
                                                                <td>
                                                                    Each group
                                                                    member have
                                                                    equal contribution
                                                                    towards project.
                                                                </td>
                                                                <td>
                                                                    Majority of the
                                                                    project work is done
                                                                    by a single person.
                                                                </td>
                                                                <td>
                                                                    Complete lack of
                                                                    team work among
                                                                    team members
                                                                </td>
                                                                <td>
                                                                    <select class="form-select" aria-label="Default select example" style="width:80px;" id="p4" name="p4" onchange="return MTotal()">
                                                                        <option selected value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Contribution
                                                                    Towards
                                                                    Domain
                                                                </td>
                                                                <td>
                                                                    The project
                                                                    actually
                                                                    contribute
                                                                    towards the
                                                                    problem domain
                                                                    which is
                                                                    discussed in
                                                                    literature survey.                                                                </td>
                                                                <td>
                                                                    The project has
                                                                    some contribution
                                                                    towards solving
                                                                    problem in the
                                                                    discussed problem
                                                                    domain but has
                                                                    partial success.                                                                </td>
                                                                <td>
                                                                    Project do not
                                                                    contribute much
                                                                    towards solving the
                                                                    problem domain
                                                                    discussed in the
                                                                    literature survey.                                                                </td>
                                                                <td>
                                                                    <select class="form-select" aria-label="Default select example" style="width:80px;" id="p5" name="p5" onchange="return MTotal()">
                                                                        <option selected value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><strong>Total</strong></td>
                                                                <td><input type="number" readonly class="form-control" style="width:80px;" id="m_total" name="m_total"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <script>
                                        function MTotal()
                                        {
                                            var pmk1=Number(document.getElementById("p1").value);
                                            var pmk2=Number(document.getElementById("p2").value);
                                            var pmk3=Number(document.getElementById("p3").value);
                                            var pmk4=Number(document.getElementById("p4").value);
                                            var pmk5=Number(document.getElementById("p5").value);

                                            document.getElementById("m_total").value=pmk1+pmk2+pmk3+pmk4+pmk5;

                                        }

                                    </script>

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-outline-success w-100" type="submit" onclick="return askNredirect()">Save</button>
                                    </div>
                                </div>
                            </form>
                            </blockquote>
                        </div>
                    </div>
        </section>
        <script type='text/javascript'>
            $(document).ready(function(){
                $("#p1 option[value='{{ $proData->p1 }}']").attr("selected","selected");
                $("#p2 option[value='{{ $proData->p2 }}']").attr("selected","selected");
                $("#p3 option[value='{{ $proData->p3 }}']").attr("selected","selected");
                $("#p4 option[value='{{ $proData->p4 }}']").attr("selected","selected");
                $("#p5 option[value='{{ $proData->p5 }}']").attr("selected","selected");
                MTotal();

            });
        </script>


@endsection
</body>
</html>
