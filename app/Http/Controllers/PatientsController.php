<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Patients;
use App\User;
use DB;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patients $model)
    {
//        return view('plugins.patients.index', ['patients' => $model->paginate(15)]);
        $patients= Patients::paginate(15);
        return view('plugins.patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('registered','=',0)->pluck('id','name');
        return view('plugins.patients.create',compact('users'));
//        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'age' => 'required|min:1',
            'gender'=>'required|min:1',
        'weight'=>'required|min:1',
            'height'=>'required|min:1',
            'address'=>'required|min:1','user_id'=>'required|min:1'

        );
        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $data['created_by'] = auth()->user()->name;
        $pat = Patients::where('user_id','=',$request->user_id)->exists();
        if ($pat){
            return redirect()->back() ->withInput()->withErrors(['error' => 'Patient Already exists']);
        }else{
            Patients::create($data);
            DB::table('users')
                ->where('id', $request->user_id)
                ->update(['registered' => true]);
            return redirect()->route('patients.index')->withStatus(__('Patient successfully created.'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function show(Patients $patients)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patients =Patients::findorFail($id);
        return view('plugins.patients.update',compact('patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'age' => 'required|min:1',
            'gender'=>'required|min:1',
            'weight'=>'required|min:1',
            'height'=>'required|min:1',
            'address'=>'required|min:1',


        );
        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $data['created_by'] = auth()->user()->name;
        Patients::whereId($id)->update($data);
        return redirect()->route('patients.index')->withStatus(__('Patient successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient =Patients::findOrFail($id);

        $user_id = DB::table('patients')->where('id',$id)->get('user_id');
        DB::table('users')
            ->where('id', $user_id[0]->user_id)
            ->update(['registered' => false]);
        $patient->delete();
//        return dd();
        return redirect()->route('patients.index')->withStatus(__('Patient successfully deleted.'));
    }



}
