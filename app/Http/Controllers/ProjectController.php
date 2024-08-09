<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProjectResource::collection( Project::orderBy('created_at','DESC')->paginate(10))->additional(['meta'=>['message'=>null,
        'error'=>null]]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        if($request->hasFile('file')){

            $imgExtension = $request->file->getClientOriginalExtension();
            $fileName = time() . "-" . uniqid() . '.' . $imgExtension;
            $request->file->move(public_path('upload'),$fileName);
    
         $data['image']='/upload/'.$fileName;
        };
      
       
       $project = Project::create($data);
        
       return $this->successResponse($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project= Project::find($id);
        $data=$request->all();
        if($request->hasFile('file')){

            $imgExtension = $request->file->getClientOriginalExtension();
            $fileName = time() . "-" . uniqid() . '.' . $imgExtension;
            $request->file->move(public_path('upload'),$fileName);
    
         $data['image']='/upload/'.$fileName;
        };
      
        $project->update($data);
       return $this->successResponse($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project=Project::find($id);
        $project->delete();
        return response()->json('Success') /* $this->successResponse($project) */;
    }
}
