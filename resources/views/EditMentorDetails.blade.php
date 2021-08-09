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
            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-8">
                    <div class="card m-5" style="border-radius: 10px;">
                        <div class="card-header">
                            <h3>
                                Mentor Details Form
                            </h3>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">

                            <form action="{{ url('edit_mentor_details_submit') }}" method="POST" autocomplete="off" class="row g-3 needs-validation" style="font-size: 14px;">
                                
                                @csrf
                                
                                <input type="text" class="form-control" id="uid" name="uid" value="{{ $user['id']}}" hidden>
                                
                                <div class="col-md-6 mt-4">
                                    <label for="m_department" id="deptlabel" class="form-label">Department</label>
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
                                    <script>
                                        $("#m_department option[value='{{ $user['m_department'] }}']").attr("selected","selected");
                                    </script>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <label for="m_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="m_name" name="m_name" value="{{ $user['m_name']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="m_email" class="form-label">Email ID</label>
                                    <input type="email" class="form-control" id="m_email" name="m_email" value="{{ $user['m_email']}}" required>
                                    <span class="error-msg" id="dept-msg">
                                    </span>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label for="m_mobile" class="form-label">Mobile No.</label>
                                    <input type="mobile" class="form-control" id="m_mobile" name="m_mobile" value="{{ $user['m_mobile']}}" required>
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
