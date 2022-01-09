<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\CategoryExport;
use App\Contact;
use App\User;
use App\Visitor;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('visitor.view')) {
            abort(403, 'Unauthorized Access');
        }
        $contacts = Contact::all();
        return view('backend.pages.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('visitor.create')) {
            abort(403, 'Unauthorized Access');
        }
        return view('backend.pages.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('visitor.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'person_name' => 'required',
        ]);
        $contacts = new Contact();
        $contacts->person_name = $request->person_name;
        $contacts->save();
        Session::flash('message', 'Contact Created Successfully');
        return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    public function contact($id)
    {
        if(is_null($this->user) || !$this->user->can('visitor.view')) {
            abort(403, 'Unauthorized Access');
        }
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $contact = Contact::find($id);
        $today =  date("Y-m-d");
        if($start_date!=$today){
            $visitors = DB::table('visitors')
                ->where('contact_id', $contact->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->get();
        } else {
            $visitors = Visitor::where('contact_id', $contact->id)->get();
        }



        return view('backend.pages.contact.show', (['contact'=>$contact, 'visitors'=>$visitors, 'start_date'=>$start_date, 'end_date'=>$end_date]));

    }

    public function createPDF($id,$start_date,$end_date){

        $contact = Contact::find($id);
        $today =  date("Y-m-d");
        if($start_date!=$today){
            $visitors = DB::table('visitors')
                ->where('contact_id', $contact->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->get();
        } else {
            $visitors = Visitor::where('contact_id', $contact->id)->get();
        }


        $pdf = PDF::loadView('backend.pages.contact.show-pdf', ['contact'=>$contact, 'visitors'=>$visitors, 'start_date'=>$start_date, 'end_date'=>$end_date])->setPaper('a4', 'landscape');
        return $pdf->download('Contact-wise-visitors.pdf');
//        return view('backend.pages.professional.show', (['profession'=>$profession, 'visitors'=>$visitors, 'start_date'=>$start_date, 'end_date'=>$end_date]));


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('visitor.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $user = User::find($id);
        $contacts = Contact::find($id);
        return view('backend.pages.contact.edit', compact('contacts','user'));
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
        if(is_null($this->user) || !$this->user->can('visitor.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $contacts = Contact::find($id);
        $request->validate([
            'person_name' => 'required',
        ]);
        $contacts->person_name = $request->person_name;
        $contacts->save();
        Session::flash('message', 'Contact Updates Successfully');
        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('visitor.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $contacts = Contact::find($id);
        if(!is_null($contacts)) {
            $contacts->delete();
        }
        Session::flash('message', 'Contact Deleted Successfully');
        return redirect('admin/contacts');
    }

//    public function exportIntoEXCEL(){
//        return Excel::download(new CategoryExport(), 'category.xlsx');
//    }
//    public function exportIntoCSV(){
//        return Excel::download(new CategoryExport(), 'category.csv');
//    }

//    public function createPDF() {
//        $categories = Category::all();
//        $pdf = PDF::loadView('backend.pages.categories.pdf', compact('categories'));
//        // download PDF file with download method
//        return $pdf->download('category.pdf');
//    }
}
