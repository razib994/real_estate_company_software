<?php

namespace App\Http\Controllers;

use App\Bank;
use App\HeadOffice;
use App\HeadOfficeOverhead;
use App\OverheadProject;
use App\Project;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OverheadController extends Controller
{
    public function upateedit($id){
        $headofficeoverhead = HeadOfficeOverhead::find($id);
        $headoffices = HeadOffice::all();
        $bank = Bank::all();
        return view('backend.pages.headofficeoverhead.edit',['headofficeoverhead'=>$headofficeoverhead, 'headoffices'=>$headoffices, 'banks'=>$bank]);
       }

    public function update(Request $request)
    {
        $overheads = HeadOfficeOverhead::find($request->id);
        $overheads->particular_id          = $request->particular_id;
        $overheads->bank_id                = $request->bank_id;
        $overheads->date                   = $request->date;
        $overheads->start_date             = $request->start_date;
        $overheads->end_date               = $request->end_date;
        $overheads->amount                 = $request->amount;
        $overheads->payment_method         = $request->payment_method;
        $overheads->note                   = $request->note;
        $overheads->save();
        return redirect('/admin/manage-overhead-particular')->with('message', 'Head office overHead Particular Info Create Successfully');
    }


    public function delete($id){
        $overheadProjects = HeadOfficeOverhead::find($id);
        if(!is_null($overheadProjects)){
            $overheadProjects->delete();
        }

        return redirect('/admin/manage-overhead-particular')->with('delete', 'Head office overHead Project Info Deleted Successfully');
    }

    public function createPDF($start_date, $end_date) {
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
        $pdf = PDF::loadView('backend.pages.headofficeoverhead.pdf', ['headofficeoverheads'=>$headofficeoverheads, 'overheadprojects'=>$overheadprojects, 'start_date'=>$start_date,'end_date'=>$end_date])->setPaper('a4', 'landscape');
        // download PDF file with download method
        return $pdf->stream('Head Office Overhead.pdf');
    }
}
