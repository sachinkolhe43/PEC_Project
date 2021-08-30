<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Judge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
@extends('AdminLayout')

@section('content')

<script>
        $(function () {
            @if (session() -> has('judge-success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '{{ session('judge-success') }}'
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
                        Add Judge
                    </h3>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">

                    <form action="judge_registration_submit" method="POST" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                    @csrf
                       <div class="col-md-6 mt-4">
                            <label for="jtype"  class="form-label">Judge Type</label>
                            <select class="form-select" aria-label="Default select example" id="jtype" name="jtype">
                                <option selected disabled value="">Choose...</option>
                                <option value="Academic">Academic</option>
                                <option value="Industry">Industry</option>

                            </select>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>

                        <div class="col-md-12 mt-4">
                            <label for="jname" class="form-label">Name</label>
                            <input type="text" class="form-control" id="jname" name="jname" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="jemail" class="form-label">Email ID</label>
                            <input type="email" class="form-control" id="jemail" name="jemail" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="jmobile" class="form-label">Mobile No.</label>
                            <input type="mobile" class="form-control" id="jmobile" name="jmobile" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="jcompany" class="form-label">Company/College Name</label>
                            <input type="text" class="form-control" id="jcompany" name="jcompany" required>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="jexp"   class="form-label">Year Of Experience</label>
                            <select class="form-select" aria-label="Default select example" id="jexp" name="jexp">
                                <option selected disabled value="">Choose...</option>
                                <option value="(0-5)years">(0-5)years</option>
                                <option value="(5-10)years">(5-10)years</option>
                                <option value="more than 10 years">greater than 10 years </option>

                            </select>
                            <span class="error-msg" id="dept-msg">
                            </span>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="jpassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="jpassword" name="jpassword" required>
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
