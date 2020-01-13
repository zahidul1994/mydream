<?php

namespace App\Http\Controllers\Superadmin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use Yajra\DataTables\Contracts\DataTable;
class StatusController extends Controller
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
            return datatables()->of(Status::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" rid="'.$data->id.'" id="editBtn" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="deleteBtn" rid="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('superadmin.status');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    
                'status' => 'required|unique:statuses'
                           
            ]);
    
            if ($validator->fails()) {
    
                return response()->json
                (['success' =>false,
                 'errors'=>$validator->errors()->all()]);
            }
    
    else{
      
            $list = new Status();
            $list->status = $request->status;
            $list->save();
    
            if ($list->id) {
               
                 return response()->json(['success' => true,'message' => 'Gender Add Successfully', 'title' => 'Gender']);
                 
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
        $data = Status::find($id);
    
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
    
                'status' => 'required|unique:statuses,status,'.$id,
                           
            ]);
    
            if ($validator->fails()) {
    
                return response()->json
                (['success' =>false,
                 'errors'=>$validator->errors()->all()]);
            }
    
    else{
      
            $list =  Status::find($id);
            $list->status = $request->status;
            $list->update();
    
            if ($list->id) {
               
                 return response()->json(['success' => true,'message' => 'Gender Update Successfully', 'title' => 'Gender']);
                 
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
    { if (Status::destroy($id)) {
              
                return response()->json(['success' => true,'title'=>'Gender  Deleted Successfully','message'=>'Permission']);
            } else {
                
                return response()->json(['success' => false, 'message' => 'Deleted Failed']);
            }
        
        }
}
