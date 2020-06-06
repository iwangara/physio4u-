<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Movements;
use Illuminate\Http\Request;

class MovementsController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Movements $model)
    {
        return view('plugins.movements.index', ['movements' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plugins.movements.create');
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
            'name' => 'required|min:3',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $names =explode(",",$request->name);
        foreach ($names as $name){
            $data['created_by'] = auth()->user()->name;
            $data ['name'] =$name;
            Movements::create($data);
        }

        return redirect()->route('movements.index')->withStatus(__('Movement(s) successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movements  $movements
     * @return \Illuminate\Http\Response
     */
    public function show(Movements $movements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movements  $movements
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movements =Movements::findorFail($id);
        return view('plugins.movements.update',compact('movements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movements  $movements
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
        Movements::whereId($id)->update($data);
        return redirect()->route('movements.index')->withStatus(__('Movement successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movements  $movements
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modules =Movements::findOrFail($id);
        $modules->delete();
        return redirect()->route('movements.index')->withStatus(__('Movements successfully deleted.'));
    }
}
