<?php

namespace App\Http\Controllers;

use App\BodyParts;

use Illuminate\Http\Request;
use App\Authorizable;
class BodyPartsController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BodyParts $model)
    {
        return view('plugins.parts.index', ['parts' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plugins.parts.create');
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
        $data['created_by'] = auth()->user()->name;
        BodyParts::create($data);

        return redirect()->route('parts.index')->withStatus(__('Body part successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BodyParts  $bodyParts
     * @return \Illuminate\Http\Response
     */
    public function show(BodyParts $bodyParts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BodyParts  $bodyParts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parts =BodyParts::findorFail($id);
        return view('plugins.parts.update',compact('parts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BodyParts  $bodyParts
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
        BodyParts::whereId($id)->update($data);
        return redirect()->route('parts.index')->withStatus(__('Module successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BodyParts  $bodyParts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parts =BodyParts::findOrFail($id);
        $parts->delete();
        return redirect()->route('parts.index')->withStatus(__('Body part successfully deleted.'));
    }
}
