<?php

namespace App\Http\Controllers;

use App\HeadOffice;
use App\HeadOfficeOverhead;
use App\Item;
use App\Models\Color;
use App\OverheadProject;
use App\Project;
use App\ProjectPayment;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OverheadProjectController extends Controller
{
    public function overHeadprojectCreate(){
        $projects = Project::all();
        return view('backend.pages.headofficeoproject.create',['projects'=>$projects]);
    }

    public function overHeadprojectManage(){
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));

        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $overheadproject = OverheadProject::whereBetween('date', [$start_date, $end_date])
                ->get();
        }elseif($today=$start_date) {
            $overheadproject = OverheadProject::all();
        }

        return view('backend.pages.headofficeoproject.index',['overheadprojects'=>$overheadproject, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }

    public function storeoverheadproject(Request $request){
        $date    =    $request->date;//your given date
        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $first_date = date("Y-m-d",$first_date_find);
        $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
        $last_date = date("Y-m-d",$last_date_find);
        $he = HeadOfficeOverhead::all();
        if($request->payment_method=='cash'){
           
            foreach ($he as $h){
                $s = $h->start_date;
                $e = $h->end_date;
                $total = HeadOfficeOverhead::where('payment_method','cash')->whereBetween('date', [$first_date, $last_date])
                    ->sum('amount');
            }
        }else {

            foreach ($he as $h){
                $s =  $h->start_date;
                $e =  $h->end_date;
                $total = HeadOfficeOverhead::where('payment_method','check')->whereBetween('date', [$first_date, $last_date])
                    ->sum('amount');
            }
        }
        $tamount = ($total*$request->percent)/100;
        $overheadProjects = new OverheadProject();
        $overheadProjects->project_id           = $request->project_id;
        $overheadProjects->date                 = $request->date;
        $overheadProjects->percent              = $request->percent;
        $overheadProjects->amount               = $tamount;
        $overheadProjects->payment_method       = $request->payment_method;
        $overheadProjects->note                 = $request->note;
        if($overheadProjects->save()){
            $project_payemts = new ProjectPayment();
            $project_payemts->project_id        = $overheadProjects->project_id;
            $project_payemts->category_id       =4;
            $project_payemts->item_name         =57;
            $project_payemts->date              =$overheadProjects->date;;
            $project_payemts->amount            = $overheadProjects->amount;
            $project_payemts->payment_method    = $overheadProjects->payment_method;
            $project_payemts->note              = $overheadProjects->note;
            $project_payemts->save();
        }

        return redirect('/admin/manage-overhead-particular')->with('message', 'Head office overHead Project Info Create Successfully');

    }
    public function edit($id){
        $projects = Project::all();
        $overheadProject = OverheadProject::find($id);
        return view('backend.pages.headofficeoproject.edit', ['overheadProject'=>$overheadProject, 'projects'=>$projects]);
    }

    public function update(Request $request)
    {$date    =    $request->date;//your given date
        $first_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
        $first_date = date("Y-m-d",$first_date_find);
        $last_date_find = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
        $last_date = date("Y-m-d",$last_date_find);
        $he = HeadOfficeOverhead::all();
        foreach ($he as $h){
            $total = HeadOfficeOverhead::whereBetween('date', [$first_date, $last_date])
                ->sum('amount');
        }
        $tamount = ($total*$request->percent)/100;
        $overheadProjects = OverheadProject::find($request->id);


        $overheadProjects->project_id           = $request->project_id;
        $overheadProjects->date                 = $request->date;
        $overheadProjects->percent              = $request->percent;
        $overheadProjects->amount               = $tamount;
        $overheadProjects->payment_method       = $request->payment_method;
        $overheadProjects->note                 = $request->note;

        if($overheadProjects->save()){
            $project_payemts = new ProjectPayment();
            $project_payemts->project_id        = $overheadProjects->project_id;
            $project_payemts->category_id       =4;
            $project_payemts->item_name         =57;
            $project_payemts->date              =$overheadProjects->date;;
            $project_payemts->amount            = $overheadProjects->amount;
            $project_payemts->payment_method    = $overheadProjects->payment_method;
            $project_payemts->note              = $overheadProjects->note;
            $project_payemts->save();
        }

//        $overheadProjects->project_id       = $request->project_id;
//        $overheadProjects->date             = $request->date;
//        $overheadProjects->percent          = $request->percent;
//        $overheadProjects->amount           = $request->amount;
//        $overheadProjects->payment_method   = $request->payment_method;
//        $overheadProjects->note             = $request->note;
//        $overheadProjects->save();
        return redirect('/admin/manage-overhead-project')->with('message', 'Head office overHead Project Info Create Successfully');
    }


        public function delete($id){
            $overheadProjects = OverheadProject::find($id);
            if(!is_null($overheadProjects)){
                $overheadProjects->delete();
            }

        return redirect('/admin/manage-overhead-project')->with('delete', 'Head office overHead Project Info Deleted Successfully');
    }

    public function createPDF($start_date, $end_date) {

        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $overheadproject = OverheadProject::whereBetween('date', [$start_date, $end_date])
                ->get();
        }elseif($today=$start_date) {
            $overheadproject = OverheadProject::all();
        }
        $pdf = PDF::loadView('backend.pages.headofficeoproject.pdf', ['overheadprojects'=>$overheadproject, 'start_date'=>$start_date,'end_date'=>$end_date])->setPaper('a4', 'landscape');
        // download PDF file with download method
        return $pdf->stream('Project Overhead.pdf');
    }

}
