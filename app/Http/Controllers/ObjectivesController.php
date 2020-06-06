<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Objectives;
use Illuminate\Http\Request;

class ObjectivesController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Objectives $model)
    {
        return view('plugins.objectives.index', ['objectives' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plugins.objectives.create');
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
            'name' => 'unique:objectives,name|required|min:3',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $names =explode(",",$request->name);
        foreach ($names as $name){
            $data['created_by'] = auth()->user()->name;
            $data ['name'] =$name;
            Objectives::create($data);
        }

        return redirect()->route('objectives.index')->withStatus(__('Objective(s) successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Objectives  $objectives
     * @return \Illuminate\Http\Response
     */
    public function show(Objectives $objectives)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\objectives  $objectives
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objectives =Objectives::findorFail($id);
        return view('plugins.objectives.update',compact('objectives'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\objectives  $objectives
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules =array(
            'name'=>'required|min:3',


        );
        $this->validate($request,$rules);
        $data = request()->except(['_token','_method']);
        $data['created_by']=auth()->user()->name;
//
        Objectives::whereId($id)->update($data);
        return redirect()->route('objectives.index')->withStatus(__('Objective successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\objectives  $objectives
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modules =Objectives::findOrFail($id);
        $modules->delete();
        return redirect()->route('objectives.index')->withStatus(__('Objective(s) successfully deleted.'));
    }
}
