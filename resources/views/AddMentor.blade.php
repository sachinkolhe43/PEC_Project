<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Mentor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
   
@extends('AdminLayout')

@section('content')

<script>
        $(function () {
            @if (session() -> has('mentor-success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '{{ session('mentor-success') }}'
                })
        @endif
            });
    </script>
        <section class="container">
            <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">
            <div class="card m-5" style="border-radius: 10px;">
                <div class="card-header">
                    <h3>
                        Add Mentor
                    </h3>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">

                    <form action="mentor_registration_submit" method="POST" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                    @csrf
                       <div class="col-md-6 mt-4">
                            <label for="mdepartment" id="deptlabel" class="form-label">Department</label>
                            <select class="form-select" aria-label="Default select example" id="m_department" name="m_department">
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

                        <div class="col-md-12 mt-4">
                            <label for="uname" class="form-label">Name</label>
                            <input type="text" class="form-control" id="m_name" name="m_name" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="uemail" class="form-label">Email ID</label>
                            <input type="email" class="form-control" id="m_email" name="m_email" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="umobile" class="form-label">Mobile No.</label>
                            <input type="mobile" class="form-control" pattern="\d{10}" title="Enter a valid phone number"  id="m_mobile" name="m_mobile" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        
                       

                        <div class="col-12">
                            <button class="btn btn-outline-success w-100" type="submit">Save</button>
                        </div>
                    </form>
                    
                </blockquote>
                </div>
            </div>
            </div>
            <div class="col-2">

            </div>
            </div>
        </section>
        @endsection
</body>
</html>
