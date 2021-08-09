<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <script>
        $(function () {
            @if (session() -> has('student-success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '{{ session('student- success') }}'
                })
        @endif
            });
    </script>

    <section class="container">

        <div class="card m-5" style="border-radius: 10px;">
            <div class="card-header">
                <h3>
                    Student Registration Form
                </h3>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">

                    <form action="student_registration_page_submit" method="POST" enctype="multipart/form-data"
                        autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">

                        <div class="col-md-6 mt-4">
                            <label for="academic_year" class="form-label">Academic Year</label>
                            <input type="text" readonly class="form-control" id="academic_year" name="academic_year"
                                required>


                            <script>
                                var d = new Date();
                                var curYear = d.getFullYear();
                                var academic_year = curYear - 1 + '-' + (curYear.toString().substr(-2));
                                document.getElementById('academic_year').value = academic_year;

                            </script>

                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" aria-label="Default select example" id="department"
                                name="department" onchange="return getGroupID()" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="ETRX">ETRX</option>
                                <option value="EXTC">EXTC</option>
                                <option value="COMP">COMP</option>
                                <option value="IT">IT</option>
                                <option value="MCA">MCA</option>
                            </select>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" id="category"
                                name="category" onchange="return getGroupID()" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                            </select>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="group_count" class="form-label">No. Of Students</label>
                            <select class="form-select" aria-label="Default select example" id="group_count"
                                name="group_count" onchange="return addSection()" required>
                                <option disabled value="">Choose...</option>
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                               
                            </select>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="group_id" class="form-label">Group ID</label>
                            <input type="text" readonly class="form-control" id="group_id" name="group_id" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                            <script>
                                function getGroupID() {
                                    var e = new Date();
                                    var year = e.getFullYear();
                                    var dept = document.getElementById('department').value;
                                    var cat = document.getElementById('category').value;
                                    var groupId = year - 1 + (year.toString().substr(-2)).toString() + dept + cat;
                                    document.getElementById('group_id').value = groupId;

                                }
                            </script>

                        </div>

                        <div id="addStudent">
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5>Student 1</h5>
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <div class="row" style="font-size: 14px;">
                                            <div class="col-md-6 mt-4">
                                                <label for="ucid[]" class="form-label">UCID</label>
                                                <input type="text" class="form-control" id="ucid[]" name="ucid[]"
                                                    required>
                                                <span class="error-msg" id="dept-msg">
                                                </span>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <label for="name[]" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name[]" name="name[]"
                                                    required>
                                                <span class="error-msg" id="dept-msg">
                                                </span>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="email[]" class="form-label">Email ID</label>
                                                <input type="email" class="form-control" id="email[]" name="email[]"
                                                    required>
                                                <span class="error-msg" id="dept-msg">
                                                </span>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="mobile[]" class="form-label">Mobile No.</label>
                                                <input type="mobile" class="form-control" id="mobile[]" name="mobile[]"
                                                    required>
                                                <span class="error-msg" id="dept-msg">
                                                </span>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <script>
                            function addSection() {
                                $("#addStudent").empty();
                                var NoOfRec = Number(document.getElementById("group_count").value);
                                //alert(NoOfRec);
                                for (var i = 1; i <= NoOfRec; i++) {
                                    $("<div class='card mt-4'>" +
                                        "<div class='card-header'><h5>Student #" + i + "</h5></div>" +

                                        "<div class='card-body'>" +
                                        "<blockquote class='blockquote mb-0'>" +
                                        "<div class='row' style='font-size: 14px;''>" +
                                        "<div class='col-md-6 mt-4'>" +
                                        "<label for='ucid[]' class='form-label'>UCID</label>" +
                                        "<input type='text' class='form-control' id='ucid[]' name='ucid[] ' required>" +
                                        "</div>" +

                                        "<div class='col-md-12 mt-4'>" +
                                        "<label for='name[]' class='form-label'>Name</label>" +
                                        "<input type='text' class='form-control' id='name[]' name='name[]' required>" +
                                        "</div>" +

                                        "<div class='col-md-6 mt-4'>" +
                                        "<label for='email[]' class='form-label'>Email ID</label>" +
                                        "<input type='email' class='form-control' id='email[]' name='email[]' required>" +
                                        "</div>" +

                                        "<div class='col-md-6 mt-4'>" +
                                        "<label for='mobile[]' class='form-label'>Mobile No.</label>" +
                                        "<input type='mobile' class='form-control' id='mobile[]' name='mobile[]' required>" +
                                        "</div></bl0ckquote></div></div></div>").appendTo("#addStudent");
                                }
                            }
                        </script>

                        <div class="col-md-12 mt-4">
                            <label for="project_title" class="form-label">Project Title</label>
                            <input type="text" class="form-control" id="project_title" name="project_title" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="project_description" class="form-label">Project Description</label>
                            <textarea type="text" class="form-control" id="project_description" name="project_description"
                                required></textarea>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="project_outcome" class="form-label">Project Outcome</label>
                            <textarea type="text" class="form-control" id="project_outcome" name="project_outcome"
                                required></textarea>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="doc_file" class="form-label">Project Document File</label>
                            <input class="form-control" accept="application/pdf" type="file" id="doc_file"
                                name="doc_file" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label for="project_video" class="form-label">Project Video</label>
                            <input class="form-control" type="file"
                                id="project_video" name="project_video" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>



                        <div class="col-12">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>

                </blockquote>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    </section>

    @endsection

</body>

</html>