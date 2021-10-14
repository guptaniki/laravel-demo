<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;

class SubjectsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(Request $request)    {
        //
        if ($request->ajax()) {
            $data = Subjects::where('user_id',auth()->user()->id)->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="View" class="view btn btn-primary btn-sm viewSubject"><i class="fa fa-eye text-white"></i></a>&nbsp;';
                $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editSubject"><i class="fas fa-pen text-white"></i></a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSubject"><i class="far fa-trash-alt text-white" data-feather="delete"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
        }
        return view('subject');
    }

    public function store(Request $request)
    {
        //
        $id=$request->id;
        Subjects::updateOrCreate(
            [
             'id' => $id
            ],
            [
            'user_id'=>$request->user_id,
            'subject_name' => $request->subject_name,
            'subject_title' => $request->subject_title,
            'subject_description' => $request->subject_description
            ]);
        return response()->json(['success'=>'Subjects saved successfully.']);
    }
    public function show(Subjects $subjects,$id)
    {
        //
        
        $product = Subjects::find($id);
        return response()->json($product);
    }

    public function edit($id)    {
        //
        $product = Subjects::find($id);
        return response()->json($product);
    }
    public function destroy($id)    {
        //
        Subjects::find($id)->delete();
        return response()->json(['success'=>'Subjects deleted successfully.']);
    }
}
