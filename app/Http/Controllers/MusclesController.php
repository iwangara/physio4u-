<?php

namespace App\Http\Controllers;

use App\Muscles;
use Illuminate\Http\Request;

class MusclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Muscles $model)
    {
        return view('plugins.muscles.index', ['muscles' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plugins.muscles.create');
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
            'name' => 'unique:muscles,name|required|min:3',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $names =explode(",",$request->name);
        foreach ($names as $name){
            $data['created_by'] = auth()->user()->name;
            $data ['name'] =$name;
            Muscles::create($data);
        }

        return redirect()->route('muscles.index')->withStatus(__('Muscle(s) successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Muscles  $muscles
     * @return \Illuminate\Http\Response
     */
    public function show(Muscles $muscles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Muscles  $muscles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $muscles =Muscles::findorFail($id);
        return view('plugins.muscles.update',compact('muscles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Muscles  $muscles
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
        Muscles::whereId($id)->update($data);
        return redirect()->route('muscles.index')->withStatus(__('Muscle successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\objectives  $objectives
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modules =Muscles::findOrFail($id);
        $modules->delete();
        return redirect()->route('muscles.index')->withStatus(__('Muscle(s) successfully deleted.'));
    }
}
