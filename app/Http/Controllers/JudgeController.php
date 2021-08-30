<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;
use App\Models\Projects;
use App\Models\Students;
use App\Models\StudentsMarks;
use App\Models\ProjectsMarks;
use Illuminate\Support\Facades\DB;
class JudgeController extends Controller
{
    public function allotedprojects()
    {
        return view('allodemo');
    }

    public function judge_marking_page()
    {
        return view('EvaluationOfProjects');
    }



    // public function projectsallotedstudents($project_id)
    // {
    //     $users= DB::table('students')

    //             ->select('*')
    //             ->where(

    //                         'project_id','=',$project_id


    //             )
    //             ->get();

    //             return view('viewstudentsreportafterprojecteval',['users'=>$users]);

    // }


    public function getMyAllotedProjects(Request $req)
    {
        $users['data'] = DB::table('allocatedprojects')
                ->join('projects', 'allocatedprojects.project_id', '=', 'projects.project_id')
                ->select('allocatedprojects.*', 'projects.project_vid', 'projects.project_pdf','projects.project_title')
                ->where([
                            [
                            'allocatedprojects.jemail','=',$req->jemail
                            ],
                            [
                                'allocatedprojects.academic_year','=',$req->ayear
                            ]
                ])
                ->get();

        return response()->json($users);
    }

    public function gprojectstudents(Request $req)
    {
        $users['data'] = DB::table('allocatedprojects')
                ->join('students', 'allocatedprojects.project_id', '=', 'students.project_id')
                ->select('allocatedprojects.*', 'students.ucid', 'students.name','students.project_id')
                ->where([
                            [
                            'allocatedprojects.project_id','=',$req->project_id
                            ]

                ])
                ->get();

        return response()->json($users);
    }

    public function view_pdf($file)
    {
        return response()->file('uploads/'.$file, [
            'Content-Disposition' => 'inline; filename="'. $file .'"'
          ]);

    }

    public function download_vid($file)
    {
        return response()->download(public_path('uploads/'.$file));
    }

    public function download_pdf($file)
    {
        return response()->download(public_path('uploads/'.$file));
    }

    public function give_marks($ucid)
    {
        $data=DB::table('students')
                ->join('projects', 'students.project_id', '=', 'projects.project_id')
                ->select('projects.*','students.ucid','students.name')
                ->where('students.ucid','=',$ucid)
                ->first();
        return redirect('judge_marking_page')->with('data',$data);
    //    echo ($data);
    }

    public function edit_judge_marks($ucid)
     {
        $data=DB::table('studentsmarks')
        ->join('students', 'studentsmarks.project_id', '=', 'students.project_id')
        ->select('studentsmarks.*','students.ucid','students.name')
        ->where('studentsmarks.ucid','=',$ucid)
        ->first();
         return redirect('edit_judge_marking_page')->with('data',$data);
         //echo($data);

     }



     public function project_member_page()
    {
        return view('ProjectMemberPage');
    }

     public function get_members($project_id)
     {
         $data=DB::table('projects')
         ->join('students', 'projects.project_id', '=', 'students.project_id')
         ->select('projects.*','students.ucid','students.name','students.proj_eval_status')
         ->where('projects.project_id','=',$project_id)
         ->get();
         return redirect('project_member_page')->with('data',$data);
         //echo($data);

     }
     public function edit_judge_marking_page()
    {
        return view('EditEvaluationOfProjects');
    }





    public function getStudentDetails(Request $req)
    {
        $stds['data'] = DB::table('students')
                ->select('*')
                ->where(

                      'project_id','=',$req->project_id

                )
                ->get();

        return response()->json($stds);
    }

    function judge_marks_submit(request $req)
    {


            $student=new StudentsMarks();
            $student->academic_year=$req->academic_year;
            $student->department=$req->department;


            $student->project_id=$req->project_id;

            $student->ucid=$req->ucid;
            $student->p1=$req->p1;
            $student->p2=$req->p2;
            $student->p3=$req->p3;
            $student->p4=$req->p4;
            $student->p5=$req->p5;
            $student->total=$req->m_total;

            $student->save();


        Students::where('ucid',$req->ucid)
        ->update(['proj_eval_status' => 'CHECKED']);

        return redirect()->to("allotedprojects");
    }
    public function judge_edit_marks_submit(request $req)
    {



            $student= StudentsMarks::find($req->mid);
            $student->academic_year=$req->academic_year;
            $student->department=$req->department;


            $student->project_id=$req->project_id;

            $student->ucid=$req->ucid;
            $student->p1=$req->p1;
            $student->p2=$req->p2;
            $student->p3=$req->p3;
            $student->p4=$req->p4;
            $student->p5=$req->p5;
            $student->total=$req->m_total;

            $student->save();

        return redirect()->to("allotedprojects");
    }

    public function submit_project_marks($project_id)
    {
            $grpdata= DB::table('projects')
            ->join('students', 'projects.project_id', '=', 'students.project_id')
            ->select('students.ucid','students.department','students.academic_year')
            ->where('projects.project_id','=',$project_id)
            ->get();
            for($i=0;$i<count($grpdata);$i++)
            {
                $flag= StudentsMarks::select('total')
                ->where([
                    [
                    'project_id','=',$project_id
                    ],
                    [
                        'ucid','=',$grpdata[$i]->ucid
                    ]
                      ])
                ->get();

                if($flag == "[]")
                {
                    $student= new StudentsMarks();
                    $student->academic_year=$grpdata[$i]->academic_year;
                    $student->department=$grpdata[$i]->department;


                    $student->project_id=$project_id;

                    $student->ucid=$grpdata[$i]->ucid;
                    $student->p1=0;
                    $student->p2=0;
                    $student->p3=0;
                    $student->p4=0;
                    $student->p5=0;
                    $student->total=0;

                    $student->save();

                    Students::where('ucid',$grpdata[$i]->ucid)
                    ->update(['proj_eval_status' => 'CHECKED']);
                }

            }
            Allocation::where('project_id',$project_id)
                    ->update(['eval_status' => 'CHECKED']);
            $countData =DB::table("studentsmarks")
	       ->select('department','academic_year',DB::raw("AVG(total) as AvgMarks"))
            ->where('project_id',$project_id)
	        ->groupBy('department','academic_year')
	       ->first();

           $pm=new ProjectsMarks();
           $pm->academic_year=$countData->academic_year;
           $pm->department=$countData->department;
           $pm->project_id=$project_id;
           $pm->project_marks=$countData->AvgMarks;
           $pm->save();
        return redirect()->to("allotedprojects");
    }

    public function MyEvaluated_projects()
    {
        return view('JudgeEvaluatedProjects');
    }

    public function projectevaluationreport(Request $req)
    {
        $evalvesheet['data'] = DB::table('allocatedprojects')
            ->join('projects', 'allocatedprojects.project_id', '=', 'projects.project_id')
            ->join('projectmarks', 'allocatedprojects.project_id', '=', 'projectmarks.project_id')

            ->select('projectmarks.*','projects.project_title','allocatedprojects.jemail')
            ->where([
                [
                    'projectmarks.academic_year','=',$req->ayear
                ],
                [
                    'allocatedprojects.jemail','=', $req->jemail
                  ]
             ])
            ->get();
        return response()->json($evalvesheet);
    }

    public function judge_logout(Request $request)
    {
        $request->session('judgeLogData')->invalidate();

        return redirect('login');
    }

}
