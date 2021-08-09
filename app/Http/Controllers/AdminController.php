<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentors;
use App\Models\Judges;
use App\Models\OtherUsers;
use App\Models\Projects;
use App\Models\Allocation;
class AdminController extends Controller
{
    public function add_mentor()
    {
        return view('AddMentor');
    }

    public function add_other_user()
    {
        return view('AddOtherUsers');
    }

    public function add_judge()
    {
        return view('AddJudge');
    }
    // addjudge
    function judge_registration_submit(request $req)
    {
        $judge=new Judges();
        $judge->jtype=$req->jtype;
        $judge->jname=$req->jname;
        $judge->jemail=$req->jemail;
        $judge->jmobile=$req->jmobile;
        $judge->jcompany=$req->jcompany;
        $judge->jexp=$req->jexp;
        $judge->jpassword=$req->jpassword;
        $judge->save();

        $req->session()->flash("judge-success","New judge has been added Successfully."); 
       
        return redirect()->to("add_judge");

    }

    // addmentor
    function mentor_registration_submit(request $req)
    {
        $mentor=new Mentors();
        $mentor->m_department=$req->m_department;
        $mentor->m_name=$req->m_name;
        $mentor->m_email=$req->m_email;
        $mentor->m_mobile=$req->m_mobile;
        $mentor->save();

        $req->session()->flash("mentor-success","New Mentor has been added Successfully."); 
       
        return redirect()->to("add_mentor");

    }
    // addotherusers
    function other_users_registration_submit(request $req)
    {
        $otheruser=new OtherUsers();
        $otheruser->Role=$req->Role;
        $otheruser->uname=$req->uname;
        $otheruser->uemail=$req->uemail;
        $otheruser->umobile=$req->umobile;
        $otheruser->upassword=$req->upassword;
        $otheruser->save();

        $req->session()->flash("other-success","New User has been added Successfully."); 
       
        return redirect()->to("add_other_user");

    }
    // projectallocation
    public function project_allotment_page()
    {
        return view('ProjectAllocation');
    }

    public function admin_logout(Request $request)
    {
        $request->session('adminLogData')->invalidate();

        return redirect('login');
    }

    public function getUnallotedprojects(Request $req)
    {
        $paperData['data'] = Projects::orderby("id","asc")
        			->select('project_id')
        			->where([
                        ['academic_year','=',$req->ayear],
                        ['department','=',$req->dept],
                        ['project_assign_status','=','UNASSIGNED']
                    ])
        			->get();
  
        return response()->json($paperData);
    }

    public function getProjectTitle(Request $req)
    {
        $Ptitle['data'] = Projects::select('project_title')
        			
        			->where(
                        'project_id','=',$req->projectid
                        
                    )
        			->get();
  
        return response()->json($Ptitle);
    }

    function judge_allocate_submit(request $req)
    {
        $ap=new Allocation();
        $ap->academic_year=$req->academic_year;
        $ap->department=$req->department;
        $ap->project_id=$req->projectid;
        $ap->jemail=$req->judgename;
        $ap->eval_status='UNCHECKED';

        $save_status=$ap->save();
        if($save_status){
            Projects::where('project_id',$req->projectid)
                ->update(['project_assign_status' => 'ASSIGNED']);
        }

        $req->session()->flash("allocation-success","Project has been acllocated Successfully."); 
       
        return redirect()->to("project_allotment_page");

    }


    public function mentor_report()
    {
        return view('viewMentorDetails');
    }

    public function judge_report()
    {
        return view('viewJudgeDetails');
    }

    public function others_report()
    {
        return view('ViewOthersDetails');
    }

    public function edit_other_user($id)
    {
        $user=OtherUsers::find($id);
        return view("EditOtherUserDetails",['user'=>$user]);
    }

    public function edit_judge_details($id)
    {
        $juser=Judges::find($id);
        return view("EditJudgesDetails",['user'=>$juser]);
    }

    public function edit_mentor($id)
    {
        $muser=Mentors::find($id);
        return view("EditMentorDetails",['user'=>$muser]);
    }



    public function edit_otheruser_submit(Request $req)
    {
        $user=OtherUsers::find($req->uid);
        $user->Role=$req->Role;
        $user->uname=$req->uname;
        $user->uemail=$req->uemail;
        $user->umobile=$req->umobile;
        $user->upassword=$req->upassword;
        $user->save();
        $req->session()->flash("user-update-success","User Details Updated Successfully."); 
        return redirect()->to("others_report");
    }


    

    public function edit_jude_details_submit(Request $req)
    {
        $juser=Judges::find($req->uid);
        $juser->jtype=$req->jtype;
        $juser->jname=$req->jname;
        $juser->jemail=$req->jemail;
        $juser->jmobile=$req->jmobile;
        $juser->jcompany=$req->jcompany;
        $juser->jexp=$req->jexp;
        $juser->jpassword=$req->jpassword;
        $juser->save();
        $req->session()->flash("user-update-success","Judge Details Updated Successfully."); 
        return redirect()->to("judge_report");
    }

    public function edit_mentor_details_submit(Request $req)
    {
        $muser=Mentors::find($req->uid);
        $muser->m_department=$req->m_department;
        $muser->m_name=$req->m_name;
        $muser->m_email=$req->m_email;
        $muser->m_mobile=$req->m_mobile;
        $muser->save();
        $req->session()->flash("user-update-success","Mentor Details Updated Successfully."); 
        return redirect()->to("others_report");
    }

    public function remove_otheruser(Request $req,$id)
    {
        $user=OtherUsers::find($id);
        $status=$user->delete();
        if($status>0)
        {
            $req->session()->flash("user-remove-success","User Details Removed Successfully."); 
            return redirect()->to("others_report");
        }  
    }

    public function remove_mentor(Request $req,$id)
    {
        $muser=Mentors::find($id);
        $status=$muser->delete();
        if($status>0)
        {
            $req->session()->flash("user-remove-success","Mentor Details Removed Successfully."); 
            return redirect()->to("mentor_report");
        }  
    }

    public function remove_judge(Request $req,$id)
    {
        $juser=Judges::find($id);
        $status=$juser->delete();
        if($status>0)
        {
            $req->session()->flash("user-remove-success","Judge Details Removed Successfully."); 
            return redirect()->to("judge_report");
        }  
    }



    
}
