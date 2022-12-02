<?php

namespace App\Http\Controllers;

use App\Models\PaketModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('page_admin.paket');
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
        PaketModel::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $paket = PaketModel::all();

        return DataTables::of($paket)
            ->addIndexColumn()
            ->addColumn('action', function($item){
                $a = ' 
                <a 
                    href="javascript:void(0)" 
                    data-toggle="tooltip"  
                    data-id="'.$item->id.'" 
                    data-original-title="Delete" 
                    class="btn btn-danger deleteData"
                    >Delete
                    <i class="fa fa-trash-o"></i>
                </a>
                <a 
                    href="javascript:void(0)" 
                    data-toggle="tooltip"  
                    data-id="'.$item->id.'" 
                    data-original-title="Look" 
                    class="btn btn-warning lookData">
                    Edit
                    <i class="fa fa-search"></i>
                </a>';
                return $a;
            })
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $update = PaketModel::find($id);
        $update->update($request->all());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PaketModel::find($id);
        $data->delete();
    }
}
