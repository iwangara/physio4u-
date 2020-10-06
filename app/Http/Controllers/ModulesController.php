<?php

namespace App\Http\Controllers;

use App\Modules;
use Illuminate\Http\Request;
use App\Authorizable;

class ModulesController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modules $model)
    {
        return view('plugins.modules.index', ['modules' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plugins.modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|min:3',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $names =explode(",",$request->name);
        foreach ($names as $name){
            $data['created_by'] = auth()->user()->name;
            $data ['name'] =$name;
            Modules::create($data);

        }

        return redirect()->route('modules.index')->withStatus(__('Module successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Modules $modules
     * @return \Illuminate\Http\Response
     */
    public function show(Modules $modules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Modules $modules
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modules =Modules::findorFail($id);
        return view('plugins.modules.update',compact('modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Modules $modules
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
        Modules::whereId($id)->update($data);
        return redirect()->route('modules.index')->withStatus(__('Module successfully updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Modules $modules
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modules =Modules::findOrFail($id);
        $modules->delete();
        return redirect()->route('modules.index')->withStatus(__('Module successfully deleted.'));
    }
}
