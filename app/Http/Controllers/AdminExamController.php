<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminExamController extends Controller
{
    public function show()
    {
        $Exams = DB::table('exams')->where('e_level', '1')->get();
        return view('admin/source/question/exam/exam',['Exams' => $Exams,'e_id' => '0','displaytype' => '1']);
    }
    public function showInner($e_id)
    {
        $Exams = DB::table('exams')->where('e_level', $e_id)->get();
        return view('admin/source/question/exam/exam',['Exams' => $Exams,'e_id' => $e_id,'displaytype' => '2']);
    }
    public function adminAddExam(Request $request)
    {
        $TQs = DB::table('exams')->select('e_id')->where('e_level', '1')->get();
        $Total = $TQs->count(); 
        $Total++;
        $InnerLevel = '1.'.$Total;
        //Insert the test details in the tests table       
            DB::table('exams')->insert([
            'e_name' => $request->input('catname'),
            'e_level' => $request->input('catinner_id'),
            'e_inner_level' => $InnerLevel,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        return redirect()->route('adminCategories', ['c_id' => $request->input('catinner_id')]);
    }
    public function adminAddExamSubSection(Request $request)
    {
        $Level = $request->input('catinner_id');
        $InnerLevelDB = DB::table('exams')->select('e_id','e_inner_level')->where('e_id', $Level)->get();
        $InnerLevel = $InnerLevelDB->first()->e_inner_level;
        $TQs = DB::table('exams')->select('e_id')->where('e_level', $Level)->get();
        $Total = $TQs->count(); 
        $Total++;
        $InnerLevel = $InnerLevel.'.'.$Total;
        //Insert the test details in the tests table       
            DB::table('exams')->insert([
            'e_name' => $request->input('catname'),
            'e_level' => $request->input('catinner_id'),
            'e_inner_level' => $InnerLevel,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        return redirect()->route('adminCategoriesInner', ['c_id' => $request->input('catinner_id')]);
    }
    public function adminEditExam($e_id)
    {
        
        return view('admin/source/question/exam/examedit',['e_id' => $e_id]);
    }
    public function adminEditUExam(Request $request)
    {
        $e_id = $request->input('e_id');
        DB::table('exams')->where('e_id', $e_id)->update([
            'e_name' => $request->input('exam_name'),
            'e_info' => $request->input('exam_info'),
            'e_price3m' => $request->input('price3m'),
            'e_price6m' => $request->input('price6m'),
            'e_price1y' => $request->input('price1y'),
            'e_qt_id' => $request->input('question_types'),
            'e_description' => $request->input('exam_description')
        ]);
        return view('admin/source/question/exam/examedit',['e_id' => $e_id]);
    }
    public function adminEditU2Exam(Request $request)
    {
        $e_id = $request->input('e_id');
        DB::table('exams')->where('e_id', $e_id)->update([
            'e_name' => $request->input('exam_name'),
            'e_description' => $request->input('exam_description')
        ]);
        return view('admin/source/question/exam/examedit',['e_id' => $e_id]);
    }

}
