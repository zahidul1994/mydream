<?php

namespace App\Http\Controllers\Superadmin;
use Validator;
use Kamaln7\Toastr\Facades\Toastr;
use App\Permissions;
use Illuminate\Http\Request;
use Datatables;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
class PermissionsController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Permissions::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" rid="'.$data->id.'" id="editBtn" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="deleteBtn" rid="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('superadmin.roles.permission');
    }


// public function index()
// {

// if(request()->ajax()) {
//         return datatables()->of(User::select('*'))
//         ->addColumn('action', 'action_button')
//         ->rawColumns(['action'])
//         ->addIndexColumn()
//         ->make(true);
//     }
//     return view('list');

//     //  $permission = permissions::latest()->get();
     
//     // return view('superadmin.roles.permission')->with('permission',$permission);
   
// }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            
            $permission = permissions::latest()->get();
            //dd($purchase);
             return response()->json($permission);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
    
                'name' => 'required|unique:permissions'
                           
            ]);
    
            if ($validator->fails()) {
    
                return response()->json
                (['success' =>false,
                 'errors'=>$validator->errors()->all()]);
            }
    
    else{
      
            $list = new Permission();
            $list->name = $request->name;
            $list->save();
    
            if ($list->id) {
               
                 return response()->json(['success' => true,'message' => 'Permission Add Successfully', 'title' => 'Permission']);
                 
            } else {
                return response()->json(['success' => false, 'message' => 'Error!!'], 200);
            }
        }
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $data = Permission::find($id);
    
            return response()->json($data);
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
            $validator = Validator::make($request->all(), [
    
                'name' => 'required|unique:permissions,name,'.$id,
                           
            ]);
    
            if ($validator->fails()) {
    
    
                return response()->json
                (['success' =>false,
                 'errors'=>$validator->errors()->all()]);
            }
    
    else{
      
            $list = Permission::find($id);
            $list->name = $request->name;
          
            $list->save();
    
            if ($list->id) {
               
                return response()->json(['success' => true,'message'=>'Permission Update Successfully', 'title'=>'Permission']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error!!'], 200);
            }
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
           
            if (Permission::destroy($id)) {
              
                return response()->json(['success' => true,'title'=>'Permission  Deleted Successfully','message'=>'Permission']);
            } else {
                
                return response()->json(['success' => false, 'message' => 'Deleted Failed']);
            }
        
        }
    }
    