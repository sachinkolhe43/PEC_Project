<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Mentors;
use App\Models\Judges;
use App\Models\OtherUsers;
use App\Models\Projects;
use App\Models\Allocation;
use App\Models\StudentsMarks;
use App\Models\Students;
use App\Models\ProjectsMarks;
use App\Models\Winners;




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

    public function getJudges($jtype)
    {
        $judgeData['data'] = Judges::orderby("jname","asc")
        			->select('jemail','jname')
        			->where('jtype',$jtype)
        			->get();

        return response()->json($judgeData);
    }

    public function getAllotedPapers(Request $req)
    {
        $paperData['data'] = Allocation::orderby("id","asc")
        			->select('department','project_id','project_title')
        			->where([
                        ['academic_year','=',$req->ayear],
                        ['jemail','=',$req->jemail],
                        ['res_dec_status','=',NULL]
                    ])
        			->get();

        return response()->json($paperData);
    }

    public function addPaper(Request $req)
    {
        $allotment=new Allocation();
        $allotment->academic_year=$req->ayear;
        $allotment->department=$req->dept;
        $allotment->jemail=$req->jemail;
        $allotment->project_id=$req->projectid;
        $allotment->project_title=$req->title;
        $allotment->eval_status="UNCHECKED";
        $status=$allotment->save();
        if($status)
        {
            Projects::where('project_id',$req->projectid)
                ->update(['project_assign_status' => 'ASSIGNED']);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]
            );
        }

    }

    public function removePaper($projectid)
    {
        $deletestatus=Allocation::where('project_id',$projectid)->delete();
        if($deletestatus>0)
        {
            Projects::where('project_id',$projectid)
                ->update(['project_assign_status' => 'UNASSIGNED']);

            return response()->json(

                [
                    'success' => true,
                    'message' => 'Data deleted successfully'
                ]
            );
        }
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

    public function declare_result()
    {
        $datalist = Allocation::where('res_dec_status', '=', NULL)->get();
        $dataCount = $datalist->count();

        if($dataCount>0)
        {
            return view('DeclareResult');
        }
        else
        {
            return redirect()->to('WinnerReportPage');
        }
    }

    public function getAllProjects(Request $req)
    {
        $decres['data'] = DB::table('allocatedprojects')
            ->select('allocatedprojects.*')
            ->where(
                'allocatedprojects.academic_year','=',"$req->ayear"

            )
            ->get();

        return response()->json($decres);
    }

    public function evaluation_sheet()
    {
        return view('StudentEvaluationSheet');
    }

    public function getEvaluationSheet(Request $req)
    {
        $evalvesheet['data'] = DB::table('studentsmarks')
            ->join('projects', 'studentsmarks.project_id', '=', 'projects.project_id')
            ->join('students', 'studentsmarks.ucid', '=', 'students.ucid')

            ->select('studentsmarks.*','projects.project_title', 'students.name')
            ->where(
                'studentsmarks.academic_year','=',$req->ayear
            )
            ->get();
            return response()->json($evalvesheet);
    }

    public function getStudentsreport()
    {
        return view('StudentsReport');
    }

    public function getParticipatedStudents(Request $req)
    {
        $reportsheet['data'] = DB::table('students')
            ->join('projects', 'students.project_id', '=', 'projects.project_id')


            ->select('students.*', 'projects.project_title')
            ->where(
                'students.academic_year','=',$req->ayear
            )
            ->get();
        return response()->json($reportsheet);
    }

    public function ProjectsReport()
    {
        return view('ProjectReports');
    }

    public function getProjectsReport(Request $req)
    {
        $reportsheet['data'] = DB::table('projects')


            ->select('projects.*')
            ->where(
                'projects.academic_year','=',$req->ayear
            )
            ->get();
        return response()->json($reportsheet);
    }

    public function WinnerReportPage()
    {
        return view('WinnerReport');
    }


    public function declare_final_result($ayear)
    {

        DB::table('projects')->where('project_assign_status','=','UNASSIGNED')->update(['project_assign_status' => 'NOT_ASSIGN']);

        DB::table('allocatedprojects')->where('eval_status','=','UNCHECKED')->update(['eval_status' => 'NOT_CHECK']);
        DB::table('students')->where('proj_eval_status','=','UNCHECKED')->update(['proj_eval_status' => 'NOT_CHECK']);





        $pec_winners['data']=DB::table('projectmarks')
            ->join('projects', 'projectmarks.project_id', '=', 'projects.project_id')
            ->select('projects.project_title','projectmarks.department','projectmarks.project_id',DB::raw("DENSE_RANK() OVER (partition by projectmarks.department ORDER BY projectmarks.project_marks DESC) `rank`"))
            ->where([['projectmarks.academic_year','=',$ayear],['projectmarks.res_dec_date','=',NULL]])
            ->GROUPBY('projects.project_title','projectmarks.department','projectmarks.project_id')
            ->orderBy('projectmarks.department')
            ->get();


        $now = date('Y-m-d');;

        $len=count($pec_winners['data']);
        for($i=0;$i<$len;$i++)
        {
            if($pec_winners['data'][$i]->rank==1 || $pec_winners['data'][$i]->rank==2 || $pec_winners['data'][$i]->rank==3)
            {
                $w1=new Winners();
                $w1->academic_year=$ayear;
                $w1->department=$pec_winners['data'][$i]->department;
                $w1->pro_rank=$pec_winners['data'][$i]->rank;
                $w1->project_id=$pec_winners['data'][$i]->project_id;
                $w1->project_title=$pec_winners['data'][$i]->project_title;;
                $w1->res_dec_date=$now;
                $w1->save();
            }
        }
        DB::table('projectmarks')->update(['res_dec_date' => $now]);
        DB::table('projects')->where('res_dec_status','=',NULL)->update(['res_dec_status' => 'DECLARED']);
        DB::table('allocatedprojects')->where('res_dec_status','=',NULL)->update(['res_dec_status' => 'DECLARED']);

        return redirect()->to("WinnerReportPage");
    }

    public function project_stat_report()
    {
        return view('ProjectsStatsReport');
    }

    public function getMyWinners(Request $req)
    {
        $reportsheet['data'] = DB::table('winners')
            ->join('projects', 'winners.project_id', '=', 'projects.project_id')


            ->select('winners.*', 'projects.project_title')
            ->where(
                'projects.academic_year','=',$req->ayear
            )
            ->get();
        return response()->json($reportsheet);
    }




}
