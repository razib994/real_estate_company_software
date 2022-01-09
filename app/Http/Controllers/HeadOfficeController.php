<?php

namespace App\Http\Controllers;

use App\Bank;
use App\HeadOffice;
use App\HeadOfficeOverhead;
use App\Models\Category;
use App\OverheadProject;
use App\ProjectPayment;
use Illuminate\Http\Request;

class HeadOfficeController extends Controller
{
    public function index(){
        $headoffice = HeadOffice::all();
        return view('backend.pages.headoffice.index', ['headoffices'=>$headoffice]);
    }
    public function create(){
        return view('backend.pages.headoffice.create');
    }

    public function store(Request $request){
        $request->validate([
            'particular_name' => 'required',
        ]);
        $headoffice = new HeadOffice();
        $headoffice->particular_name         = $request->particular_name;
        $headoffice->save();
        return redirect('/admin/manage-headoffice-particular')->with('message', 'Head office Particular Info Create Successfully');
    }

    public function edit($id){
        $headoffice = HeadOffice::find($id);
        return view('backend.pages.headoffice.edit', ['headoffice'=>$headoffice]);
    }

    public function update(Request $request){
        $headoffice = HeadOffice::find($request->id);
        $headoffice->particular_name         = $request->particular_name;
        $headoffice->save();
        return redirect('/admin/manage-headoffice-particular')->with('update', 'Head office Particular Info Updated Successfully');
    }

    public function delete($id){
        $headoffice = HeadOffice::find($id);
        if(!is_null($headoffice)){
            $headoffice->delete();
        }

        return redirect('/admin/manage-headoffice-particular')->with('delete', 'Head office Particular Info Deleted Successfully');
    }
    public function overHeadCreate(){
        $headoffices = HeadOffice::all();
        $bank = Bank::all();
        return view('backend.pages.headofficeoverhead.create',['headoffices'=>$headoffices, 'banks'=>$bank]);
    }
    public function overHeadManage(){
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $headofficeoverheads = HeadOfficeOverhead::whereBetween('date', [$start_date, $end_date])
                ->get();
            $overheadprojects = OverheadProject::whereBetween('date', [$start_date, $end_date])
                ->get();
        }elseif($today=$start_date) {
            $headofficeoverheads = HeadOfficeOverhead::all();
            $overheadprojects = OverheadProject::all();
        }

        return view('backend.pages.headofficeoverhead.index',['headofficeoverheads'=>$headofficeoverheads, 'overheadprojects'=>$overheadprojects, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }
    public function storeoverhead(Request $request){
        $headofficeoverhead = new HeadOfficeOverhead();
        $headofficeoverhead->particular_id          = $request->particular_id;
        $headofficeoverhead->bank_id                = $request->bank_id;
        $headofficeoverhead->date                   = $request->date;
        $headofficeoverhead->start_date             = $request->start_date;
        $headofficeoverhead->end_date               = $request->end_date;
        $headofficeoverhead->amount                 = $request->amount;
        $headofficeoverhead->payment_method         = $request->payment_method;
        $headofficeoverhead->note                   = $request->note;
        $headofficeoverhead->save();
        return redirect('/admin/manage-overhead-particular')->with('message', 'Head office overHead Particular Info Create Successfully');

    }

}
