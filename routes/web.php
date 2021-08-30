<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JudgeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*----------------------------------Main------------------------------------------*/

Route::get('/', [MainController::class, 'home_page']);

Route::get('student_registration', [MainController::class, 'student_registration']);

Route::get('login', [MainController::class, 'login']);

Route::get('about_us', [MainController::class, 'about_us']);


Route::post('student_registration_submit', [MainController::class, 'student_registration_submit']);

Route::post('others_login_submit', [MainController::class, 'others_login_submit']);

Route::post('judge_login_submit', [MainController::class, 'judge_login_submit']);

Route::get('admin_home_page', [MainController::class, 'admin_home_page']);

Route::get('principal_home_page', [MainController::class, 'principal_home_page']);

Route::get('dean_home_page', [MainController::class, 'dean_home_page']);

Route::get('judge_home_page', [MainController::class, 'judge_home_page']);

Route::get('getMentorDept', [MainController::class, 'getMentorDept']);

/*----------------------------------Main------------------------------------------*/


/*---------------------------ADMIN-----------------------------------------------*/
Route::get('add_mentor', [AdminController::class, 'add_mentor']);

Route::get('add_other_user', [AdminController::class, 'add_other_user']);

Route::get('add_judge', [AdminController::class, 'add_judge']);

Route::post('mentor_registration_submit', [AdminController::class, 'mentor_registration_submit']);

Route::post('judge_registration_submit', [AdminController::class, 'judge_registration_submit']);

Route::post('other_users_registration_submit', [AdminController::class, 'other_users_registration_submit']);

Route::get('project_allotment_page', [AdminController::class, 'project_allotment_page']);

Route::get('mentor_report', [AdminController::class, 'mentor_report']);

Route::get('judge_report', [AdminController::class, 'judge_report']);

Route::get('others_report', [AdminController::class, 'others_report']);

Route::get('edit_other_user/{id}', [AdminController::class, 'edit_other_user']);

Route::get('edit_judge_details/{id}', [AdminController::class, 'edit_judge_details']);

Route::get('getJudges/{id}', [AdminController::class, 'getJudges']);

Route::get('getAllotedPapers', [AdminController::class, 'getAllotedPapers']);

Route::get('addPaper', [AdminController::class, 'addPaper']);

Route::get('removePaper/{id}', [AdminController::class, 'removePaper']);

Route::get('edit_mentor/{id}', [AdminController::class, 'edit_mentor']);

Route::post('edit_otheruser_submit', [AdminController::class, 'edit_otheruser_submit']);

Route::post('edit_jude_details_submit', [AdminController::class, 'edit_jude_details_submit']);

Route::post('edit_mentor_details_submit', [AdminController::class, 'edit_mentor_details_submit']);

Route::get('remove_otheruser/{id}', [AdminController::class, 'remove_otheruser']);

Route::get('remove_mentor/{id}', [AdminController::class, 'remove_mentor']);

Route::get('remove_judge/{id}', [AdminController::class, 'remove_judge']);


Route::get('declare_result', [AdminController::class, 'declare_result']);

Route::get('getAllProjects', [AdminController::class, 'getAllProjects']);

Route::get('declare_final_result/{id}', [AdminController::class, 'declare_final_result']);

Route::get('evaluation_sheet', [AdminController::class, 'evaluation_sheet']);

Route::get('getEvaluationSheet', [AdminController::class, 'getEvaluationSheet']);

Route::get('getStudentsreport', [AdminController::class, 'getStudentsreport']);

Route::get('getParticipatedStudents', [AdminController::class, 'getParticipatedStudents']);

Route::get('ProjectsReport', [AdminController::class, 'ProjectsReport']);

Route::get('getProjectsReport', [AdminController::class, 'getProjectsReport']);

Route::get('WinnerReportPage', [AdminController::class, 'WinnerReportPage']);

Route::get('admin_logout', [AdminController::class, 'admin_logout']);

Route::get('project_stat_report', [AdminController::class, 'project_stat_report']);

Route::get('getMyWinners', [AdminController::class, 'getMyWinners']);

/*-----------------------------------JUDGE------------------------------------------*/

Route::get('allotedprojects', [JudgeController::class, 'allotedprojects']);

Route::get('judge_marking_page', [JudgeController::class, 'judge_marking_page']);

Route::get('edit_judge_marking_page', [JudgeController::class, 'edit_judge_marking_page']);

Route::get('getMyAllotedProjects', [JudgeController::class, 'getMyAllotedProjects']);

Route::get('project_member_page', [JudgeController::class, 'project_member_page']);

Route::get('get_members/{id}', [JudgeController::class, 'get_members']);

Route::get('gprojectstudents', [JudgeController::class, 'gprojectstudents']);

Route::get('projectsallotedstudents/{id}', [JudgeController::class, 'projectsallotedstudents']);

Route::get('view_pdf/{id}', [JudgeController::class, 'view_pdf']);

Route::get('download_vid/{id}', [JudgeController::class, 'download_vid']);

Route::get('download_pdf/{id}', [JudgeController::class, 'download_pdf']);

Route::get('give_marks/{id}', [JudgeController::class, 'give_marks']);

Route::post('judge_marks_submit', [JudgeController::class, 'judge_marks_submit']);

Route::post('judge_edit_marks_submit', [JudgeController::class, 'judge_edit_marks_submit']);

Route::get('edit_judge_marks/{id}', [JudgeController::class, 'edit_judge_marks']);

Route::get('getStudentDetails', [JudgeController::class, 'getStudentDetails']);

Route::get('submit_project_marks/{id}', [JudgeController::class, 'submit_project_marks']);

Route::get('MyEvaluated_projects', [JudgeController::class, 'MyEvaluated_projects']);

Route::get('judge_logout', [JudgeController::class, 'judge_logout']);

Route::get('projectevaluationreport', [JudgeController::class, 'projectevaluationreport']);

