<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Equipments;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Equipments $model)
    {
        return view('plugins.equipments.index', ['equipments' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plugins.equipments.create');
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
            'name' => 'unique:equipments,name|required|min:3',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $names =explode(",",$request->name);
        foreach ($names as $name){
            $data['created_by'] = auth()->user()->name;
            $data ['name'] =$name;
            Equipments::create($data);
        }

        return redirect()->route('equipments.index')->withStatus(__('Equipment(s) successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipments  $equipments
     * @return \Illuminate\Http\Response
     */
    public function show(Equipments $equipments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipments  $equipments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipments =Equipments::findorFail($id);
        return view('plugins.equipments.update',compact('equipments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipments  $equipments
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
        Equipments::whereId($id)->update($data);
        return redirect()->route('equipments.index')->withStatus(__('Equipment successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\objectives  $objectives
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modules =Equipments::findOrFail($id);
        $modules->delete();
        return redirect()->route('equipments.index')->withStatus(__('Equipment(s) successfully deleted.'));
    }
}
