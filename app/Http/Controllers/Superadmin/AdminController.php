<?php

namespace App\Http\Controllers\Superadmin;

use App\Admin;
use App\Gender;
use App\Status;
use App\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admininfo=Admin::with('status','gender')->get();
        return view('superadmin.createadmin.index')->with('admininfo',$admininfo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gender = Gender::pluck('gender','id')->all();
        $roles = Role::pluck('name','name')->all();
        $status = Status::pluck('status','id')->all(); 
     return view('superadmin.createadmin.create',compact('gender','roles','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    
    {
        // dd($request);
     $request->validate([
        'firstname' => 'required|max:50',
        'lastname' => 'required|max:50',
        'email' => 'required|email|unique:admins|max:250',
        'gender' => 'required',
        'phone' => 'required|numeric|unique:admins',
        'status' => 'required',
        'roles' => 'required',
        'password' => 'required|min:6|max:60|same:repassword',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:8000'
                 
           
                
    ]);


      if ($request->hasfile('photo')) {
            $image = $request->file('photo');
             $rand = mt_rand(100000, 999999);
              $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
             $name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
             $image->move(storage_path().'/app/public/profileimage/', $name);
             $resizedImage = Image::make(storage_path().'/app/public/profileimage/' . $name)->resize(800, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
            $resizedImage_thumb = Image::make(storage_path().'/app/public/profileimage/' . $name)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
             // save file as jpg with medium quality
             $resizedImage->save(storage_path() . '/app/public/profileimage/'.$name, 60);
              $resizedImage_thumb->save(storage_path() . '/app/public/profileimage/'.$name_thumb, 70);
     }
     else{
         $name = 'not-found.jpg';
     };
         
       $admin = new Admin(array(
           'firstname'=>$request->firstname,
           'lastname'=>$request->lastname,
           'phone'=>$request->phone,
           'status'=>$request->status,
          'gender'=>$request->gender,
           'image'=>$name,
        'email' => $request->email,
    'password' =>Hash::make($request->password),
    
 
));

    if($admin->save()){
   
     $admin->assignRole($request->input('roles'));        
    Toastr::success("User Create Successfully ", "Add Admin");
    return Redirect::route('admin.index');
}
else{
    Toastr::error('Something Wrong !!', 'Opps');
    return Redirect::route('admin.index');
}



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name )
    {
        $permission=Permissions::where('name','like', '%'.$name.'%');
        
            if ($permission->id) {
               
                return response()->json(['success' => true,$permission]);
            } else {
                return response()->json(['success' => false, 'message' => 'Error!!'], 200);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $admin=Admin::find($id);
        $gender = Gender::pluck('gender','id')->all();
        $roles = Role::pluck('name','name')->all();
        $status = Status::pluck('status','id')->all(); 
     return view('superadmin.createadmin.edit',compact('gender','roles','status','admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
        'firstname' => 'required|max:50',
        'lastname' => 'required|max:50',
        'email' => 'required|email|unique:admins,email,'.$id,
        'gender' => 'required',
        'phone' => 'required|numeric|unique:admins,phone,'.$id,
        'status' => 'required',
        'roles' => 'required',
        'password' => 'required|min:6|max:60|same:repassword',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:8000'
                 
           
                
    ]);


      if ($request->hasfile('photo')) {
            $image = $request->file('photo');
             $rand = mt_rand(100000, 999999);
              $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
             $name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
             $image->move(storage_path().'/app/public/profileimage/', $name);
             $resizedImage = Image::make(storage_path().'/app/public/profileimage/' . $name)->resize(800, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
            $resizedImage_thumb = Image::make(storage_path().'/app/public/profileimage/' . $name)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
             // save file as jpg with medium quality
             $resizedImage->save(storage_path() . '/app/public/profileimage/'.$name, 60);
              $resizedImage_thumb->save(storage_path() . '/app/public/profileimage/'.$name_thumb, 70);
     }
     else{
         $name = $request->oldimage;
     };
         
       $admin =  Admin::find($id);
          $admin->firstname=$request->firstname;
            $admin->lastname=$request->lastname;
            $admin->phone=$request->phone;
            $admin->status=$request->status;
           $admin->gender=$request->gender;
            $admin->image=$name;
         $admin->email = $request->email;
     $admin->password =Hash::make($request->password);
 $admin->update();

    if($admin->save()){
   
     DB::table('model_has_roles')->where('model_id',$id)->delete();
     $admin->assignRole($request->input('roles'));       
    Toastr::success("User Update Successfully ", "Edit Admin");
    return Redirect::route('admin.index');
}
else{
    Toastr::error('Something Wrong !!', 'Opps');
    return Redirect::route('admin.index');
}
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  public function showpermission(Request $request )
    {
        $permission=Permissions::where('name','like', '%'. $request->name .'%')->first();
        
            if ($permission->id) {
               
                return response()->json(['success' => true,'message'=>'Permission Update Successfully', 'title'=>'Permission',$permission]);
            } else {
                return response()->json(['success' => false, 'message' => 'Error!!']);
                 
            }
    }


       public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Admin::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
        }
        if($request->action=="deny"){
            $roomapproval->status=1;


        }
            $roomapproval->update();
            if($roomapproval->update()==true){
                return response()->json(['success' => true, 'message' =>'Operation Successfull Updated!']);
            }



    }


}
