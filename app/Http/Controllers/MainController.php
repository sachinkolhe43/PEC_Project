<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Projects;
use App\Models\OtherUsers;
use App\Models\Judges;
use App\Models\Mentors;
class MainController extends Controller
{
    public function home_page()
    {
        return view('MainHomePage');
    } 

    public function student_registration()
    {
        return view('studentregister');
    }
    
    public function login()
    {
        return view('login');
    }
    
    function student_registration_submit(request $req)
    {         
        $id=Students::select('id')->latest('id')->first();
        if($id==null)
        {
            $count=1;
        }
        else
        {
            $count=$id['id']+1;
        }
        $project_id=$req->project_id.$count;
        $ucid=$req->ucid;
        $category=$req->category;
        $name=$req->name;
        $email=$req->email;
        $mobile=$req->mobile;
        for($i=0;$i<count($ucid);$i++)
        {
            $student=new Students();
            $student->academic_year=$req->academic_year;
            $student->department=$req->department;        
            
            $student->group_count=$req->group_count;
            $student->project_id=$project_id;
        
            $student->ucid=$ucid[$i];
            $student->category=$category[$i];
            $student->name=$name[$i];
        
            $student->email=$email[$i];
            $student->mobile=$mobile[$i];
            $student->save();
        }
        $project=new Projects();
        $project->academic_year=$req->academic_year;
        $project->department=$req->department;  
        $project->project_id=$project_id;
        $project->mentor_dept=$req->mentor_dept;
        $project->mentor_name=$req->mentor_name;
        $project->project_title=$req->project_title;
        $project->project_desc=$req->project_desc;
        $project->project_out=$req->project_out;

        $pdf=$req->project_pdf;
        $pdfname='PDF'.$project_id.time().'.'.$pdf->getClientOriginalExtension();
        $req->project_pdf->move('uploads',$pdfname);
        $project->project_pdf=$pdfname;

        $vid=$req->project_vid;
        $vidname='VID'.$project_id.time().'.'.$vid->getClientOriginalExtension();
        $req->project_vid->move('uploads',$vidname);
        $project->project_vid=$vidname;
        
        
        $project->project_assign_status="UNASSIGNED";
        $project->save();
        $req->session()->flash("student-success","Your Project ID is  $project_id Your Project Details Submitted Successfully."); 
       
        return redirect()->to("student_registration");
    } 

    function others_login_submit(Request $req)
    {
        $info=OtherUsers::select('*')->where(
            [
                ['uemail','=',$req->ousername],
                ['upassword','=',$req->opassword],
            ]
        )->first();
        if($info!=null)
        {
            if($info->Role=="ADMIN")
            {
                $req->session()->put('adminLogData',[$info]);
                return redirect()->to("admin_home_page");
            }
            if($info->Role=="PRINCIPAL")
            {
                $req->session()->put('principalLogData',[$info]);
                return redirect()->to("principal_home_page");
            }
            if($info->Role=="DEAN")
            {
                $req->session()->put('deanLogData',[$info]);
                return redirect()->to("dean_home_page");
            }
            
        }
        else
        {
            return redirect()->to("login");
        }
    }


    function admin_home_page()
    {
        return view('AdminHomePage');
    }
    function principal_home_page()
    {
        return view('PrincipalHomePage');
    }
    function dean_home_page()
    {
        return view('DeanHomePage');
    }

    function judge_home_page()
    {
        return view('JudgeHomePage');
    }

    function judge_login_submit(Request $req)
    {
        $info=Judges::select('*')->where(
            [
                ['jemail','=',$req->jusername],
                ['jpassword','=',$req->jpassword],
            ]
        )->first();
        if($info!=null)
        {
            
                $req->session()->put('judgeLogData',[$info]);
                return redirect()->to("judge_home_page");
            
            
        }
        else
        {
            return redirect()->to("login");
        }
    }


    public function getMentorDept(Request $req)
    {
        $MentorData['data'] = Mentors::orderby("id","asc")
        			->select('m_name')
        			->where(
                        'm_department','=',$req->mentordept                       
                    )
        			->get();
  
        return response()->json($MentorData);
    }

}

