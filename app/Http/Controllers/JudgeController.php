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

    public function give_marks($projid)
    {
        $data=Projects::select('*')->where('project_id',$projid)->first();
        return redirect('judge_marking_page')->with('data',$data);
       
    }

    public function edit_judge_marks($project_id)
     {
         $data=StudentsMarks::select('*')->where('project_id',$project_id)->get();
         return redirect('edit_judge_marking_page')->with('data',$data);
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
        
        $ucid=$req->ucid;
        $p1=$req->r1;
        $p2=$req->r2;
        $p3=$req->r3;
        $p4=$req->r4;
        $p5=$req->r5;
        $total=$req->r_total;
        
        
        for($i=0;$i<count($ucid);$i++)
        {
            $student=new StudentsMarks();
            $student->academic_year=$req->academic_year;
            $student->department=$req->department;        
            
            
            $student->project_id=$req->project_id;
        
            $student->ucid=$ucid[$i];
            $student->p1=$p1[$i];
            $student->p2=$p2[$i];
            $student->p3=$p3[$i];
            $student->p4=$p4[$i];
            $student->p5=$p5[$i];
            $student->total=$total[$i];
            $student->save();
        }
        $project=new ProjectsMarks();
        $project->academic_year=$req->academic_year;
        $project->department=$req->department;  
        $project->project_id=$req->project_id;
        $project->project_marks=$req->r_avg;
        $project->evaluated_by=$req->email;
        $project->res_dec_status=NULL;
        $project->save();
        Allocation::where('project_id',$req->project_id)
        ->update(['eval_status' => 'CHECKED']);
       
        return redirect()->to("allotedprojects");
    } 
    
}
