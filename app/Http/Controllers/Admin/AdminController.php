<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    // Profile Date ----------------------------------------------
    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.profile',compact('adminData'));
    } //End Method

    public function adminRegister(){
        return view('auth.user_register');
    }

    public function adminCreate(Request $request){
        $user = User::where('role','admin')->get();

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'vendor_join' => Carbon::now(),
            'role' => 'vendor',
            'status' => 'inactive',
            'vendor_join' => Carbon::now(),
            'password' => Hash::make($request->password),

        ]);
        $notification=array(
            'message'=>'Admin Register Successfully ',
            'alert'=>'success'
        );
        Notification::send($user, new VendorRegistration($request));
        return Redirect()->route('admin.login')->with($notification);

    }// End Method
    // Profile Store Data ------------------------------------------------
    public function Store(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('media/profile/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('media/profile'),$fileName);
            $data['photo'] = $fileName;
        }
        $data->save();
        $notification=array(
            'message'=>' Admin Profile Update Successfully',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    }//End Method

    // Password Change --------------------------------------
    public function ChangePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('admin.body.passwordChange');
    } // End Method


    // Update Password -----------------------------------------
    public function ChangeStore(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'con_password' => 'required|min:8',
        ]);

        $db_pass = Auth::user()->password;
        $current_password = $request->old_password;
        $newPass = $request->new_password;
        $confirmPass = $request->con_password;

       if (Hash::check($current_password,$db_pass)) {
          if ($newPass === $confirmPass) {
              User::findOrFail(Auth::id())->update([
                'password' => Hash::make($newPass)
              ]);

              Auth::logout();
              $notification=array(
                'message'=>' Your Password Change Success. Now Login With New Password',
                'alert'=>'success'
            );
            return Redirect()->route('login')->with($notification);

          }else {

            $notification=array(
                'message'=>' New Password And Confirm Password Not Same',
                'alert'=>'success'
            );
            return Redirect()->back()->with($notification);
          }
       }else {
        $notification=array(
            'message'=>' Old Password Not Match',
                'alert'=>'error'
        );
        return Redirect()->back()->with($notification);
        }
    }// End Method

    // Admin Manage ---------------------------------------------------------------------------------
    public function AllAdmin(){
        $allAdminUser = User::where('role','admin')->latest()->get();
        return view('admin.admin.all_admin',compact('allAdminUser'));
    }// End Mehtod


    public function AddAdmin(){
        $roles = Role::all();
        return view('admin.admin.add_admin',compact('roles'));
    }// End Mehtod


    public function AdminUserStore(Request $request){

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod


    public function EditAdminRole($id){

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.admin.edit',compact('user','roles'));
    }// End Mehtod


    public function AdminUserUpdate(Request $request,$id){


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod


    public function DeleteAdminRole($id){

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod

}


