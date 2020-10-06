<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Exercise;
use Illuminate\Http\Request;
use makbari\validator\rules;
use App\Equipments;
use App\Projects;

class ExerciseController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Exercise $model)
    {
        $role =auth()->user()->roles->implode('name',', ');

        if ($role=='Client'){
            $exercise_ids =Projects::where('user_id','=',auth()->user()->id)->get(['status','exercise_id']);
            $exercises = array();
            foreach($exercise_ids as $patient){
                $response = Exercise::where('id',$patient->exercise_id)->paginate(10);
                $exercises = $response;
            }
//            return $exercises;
            return  view('plugins.exercises.index',compact('exercises'));
        }else{
                    $exercises = Exercise::paginate(10);
        return view('plugins.exercises.index',compact('exercises'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $modules =Modules::pluck('name','id');
//        $parts =BodyParts::all();
        $equips =Equipments::pluck('name','id');
//        $moves =Movements::all();
//        $muscles =Muscles::all();
//        $objs =Objectives::all();
        return view('plugins.exercises.create',compact('equips'));
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
            'description' => 'required|min:3',
            'instruction' => 'required|min:3',
            'modules' => 'required|min:1',
            'start' => 'required|image|mimes:jpeg,png,jpg,gif,svg,PNG|max:20480',
            'end' => 'image|mimes:jpeg,png,jpg,gif,svg,PNG|max:20480',
            'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi| max:30000',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token', '_method']);
        $save = Exercise::create($data);
        $save->addMedia($request->start)->usingName('start')->toMediaCollection('exercises');
        if ($request->has('end')){
            $save->addMedia($request->end)->usingName('end')->toMediaCollection('exercises');
        }
        if ($request->has('video')){
        $save->addMedia($request->video)->usingName('video')->toMediaCollection('exercises');
        }
        return redirect()->route('exercises.index')->withStatus(__('Exercise successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
//        $equips =Equipments::pluck('name','id');
//        $exercises =Exercise::findorFail($id);
        return view('plugins.exercises.show',compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equips =Equipments::pluck('name','id');
        $exercises =Exercise::findorFail($id);
        return view('plugins.exercises.update',compact('exercises','equips'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'instruction' => 'required|min:3',
            'modules' => 'required|min:1',
//            'start' => 'image|mimes:jpeg,png,jpg,gif,svg,PNG|max:20480',
//            'end' => 'image|mimes:jpeg,png,jpg,gif,svg,PNG|max:20480',
//            'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi| max:30000',

        );

        $this->validate($request, $rules);
        $data = request()->except(['_token','_method']);
        Exercise::whereId($id)->update($data);



        return redirect()->route('exercises.index')->withStatus(__('Exercise successfully updated.'));
//        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        $modules =Exercise::findOrFail($exercise->id);
        $modules->delete();
        return redirect()->route('exercises.index')->withStatus(__('Exercise successfully deleted.'));
//        return $exercise;
    }


}
