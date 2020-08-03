<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Attendence;
use App\Http\Requests\attendence\CreateAttendenceRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function viewAllStudents(){
        $user = DB::table('users')->where('role', 'student')->get();
        return view('admin.allStudents')->with('users' , $user);
    }


    public function viewStudent($id){
        $user = DB::table('users')->where('id', $id )->get();
        $present = DB::table('attendences')->where('user_id', $id)->where('presence', 'present')->get();
        $absent = DB::table('attendences')->where('user_id', $id)->where('presence', 'absent')->get();
        $leave = DB::table('attendences')->where('user_id', $id)->where('presence', 'leave')->get();
        $presentC = DB::table('attendences')->where('user_id', $id)->where('presence', 'present')->count();
        $absentC = DB::table('attendences')->where('user_id', $id)->where('presence', 'absent')->count();
        $leaveC = DB::table('attendences')->where('user_id', $id)->where('presence', 'leave')->count();

        return view('admin.studentProfile')->with([
            'user' => $user[0],
            'pCount'=>$presentC,
            'aCount'=>$absentC,
            'lCount'=>$leaveC,
            'present'=>$present,
            'absent'=>$absent,
            'leave'=>$leave
        ]);
    }

    public function leaveRequest(){

        $request = DB::table('leaves')->where('request', '1')->get();

        return view('admin.leaveRequests')->with([
            'request'=>$request
        ]);
    }

    public function acceptLeave(Request $request, $id, $date){
        DB::table('attendences')->where('user_id', $id)->where('date' ,  $date)->update(['presence' => 'leave']);
        DB::table('leaves')->where('user_id', $id)->where('date' ,  $date)->update(['request' => 'accept']);
        $request = DB::table('leaves')->where('request', '1')->get();
        session()->flash('success' , 'Leave Accepted Successfully');
        return redirect(route('leavesR'))->with([
            'request'=>$request
        ]);
    }

    public function rejectLeave(Request $request, $id, $date){

        DB::table('attendences')->where('user_id', $id)->where('date' ,  $date)->update(['presence' => 'absent']);
        DB::table('leaves')->where('user_id', $id)->where('date' ,  $date)->update(['request' => 'reject']);
        $request = DB::table('leaves')->where('request', '1')->get();
        session()->flash('success' , 'Leave Rejected Successfully');
        return redirect(route('leavesR'))->with([
            'request'=>$request
        ]);
    }


    public function editAttendence(Request $request, $id){
        $attendence = DB::table('attendences')->where('id', $id)->get();
        $user = DB::table('users')->where('id',$attendence[0]->user_id )->get();

        return view('admin.editAttendence')->with([
            'att_id' => $attendence[0],
            'date'=>$attendence[0]->date,
            'user'=>$user[0]
        ]);

    }

    public function updateAttendence(Request $request , $id){
        DB::table('attendences')->where('id', $id)->update(
            [
                'presence' => $request->presence
            ]);

        session()->flash('success' , 'Attendence updated succefully');
        $uid = DB::table('attendences')->where('id', $id)->get();
        return $this->viewStudent($uid[0]->user_id);
    }

    public function  addAttendence(Request $request , $id){
        $user = DB::table('users')->where('id', $id)->get();
        return view('admin.editAttendence')->with('user',$user[0]);
    }

    public function storeAttendence(Request $request){
            dd('here');
        $attend = DB::table('attendences')->where('user_id', $request->user_id)
            ->where('date',$request->date)
            ->get();

        if(($attend)->isEmpty()){
//            your fix
//            cast string to int
            Attendence::create([
                'user_id' =>(int)$request->user_id,
                'presence'=>$request->presence,
                'date'=>$request->date
            ]);
            session()->flash('success' , 'Attendence updated succefully');
            return $this->viewStudent($request->user_id);
        }
        else{
            session()->flash('error' , 'Attendence already marked on this date');
            return $this->viewStudent($request->user_id);
        }
    }

    public function deleteAttendence(Request $request,$id){
        $user =DB::table('users')->where('id', $request->user_id)->get();
        DB::table('attendences')->where('id', $id)->delete();
        session()->flash('success' , 'Attendence deleted successfully');
        return $this->viewStudent($request->user_id);

    }
}
