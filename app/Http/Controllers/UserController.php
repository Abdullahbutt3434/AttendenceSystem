<?php

namespace App\Http\Controllers;

use App\Attendence;
use App\Leave;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->role == 'admin')
            return view('admin.index')->with('user',$user);
        else
            return view('users.index')->with('user',$user);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
//        $date = Carbon::today();
        $attende  = DB::table('attendences')->where('user_id',$user->id)->where('date',Carbon::today())->get();
//        dd($attende);
//        dd(Carbon::today());

        if(isset($attende['0'])) {
            session()->flash('success' , 'Attendence Already Marked');
            return redirect(route('user.index'));

        }
        else{
            Attendence::create([
                'user_id' => $user->id,
                'presence'=> 'present',
                'date'=> Carbon::today()

            ]);
            session()->flash('success' , 'Attendence Marked Successfully');
            return redirect(route('user.index'));
        }


//        $mytime = Carbon::now();

//        dd( $mytime->toDateTimeString());


    }



    public function viewAttendence(){
//
        $user = Auth::user();
        $user_record = DB::table('attendences')->where('user_id',$user->id)->get();
        $count = count($user_record);
//        dd($count);
        return view("users.viewAttend")->with('user_record',$user_record);
    }

    public function leaveRequest(){
        $user = Auth::user();
        $request  = DB::table('leaves')->where('user_id',$user->id)->where('date',Carbon::today())->get();

        if(isset($request['0'])){
            session()->flash('success' , 'Request Already Sent to Admin Please Wait for Approval ');
            return redirect(route('user.index'));
        }else{
            Leave::create([
                'user_id'=>$user->id,
                'request'=> '1',
                'date' => Carbon::today(),
                'name' => $user->name
            ]);

            Attendence::create([
                'user_id' => $user->id,
                'presence'=> 'Leave Request Pending...',
                'date'=> Carbon::today()
            ]);

        }

        session()->flash('success' , 'Request Send Successfully to Admin');
        return redirect(route('user.index'));
    }

    public function viewProfile(){
        $user = Auth::user();

        return view("users.profile")->with('user',$user);
    }

    /**
     * Update the Profile resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {

        $this->validate(request(), [
                'name' => 'required',
            ]
        );
        if($request->hasFile('image')){
            $image = Storage::disk('public')->put('profilePic', $request->image);
//            $image = $request->image->store('profilePic');
            $user->update([
                'name' => $request->name,
                'image' => $image

            ]);
        }else {
            $user->update([
                'name' => $request->name
            ]);

        }

        session()->flash('success','Post restore successfully');
        return redirect()->back();
    }


}
