<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;



class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Portfolio::paginate(9);
        return $this->successResponse($data);
    }

    public function getPortfoliosByUser($id){
        $data = Portfolio::where("author_id",$id)->paginate(9);
        return $this->successResponse($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        if($request->hasFile('cover_img')){

            $imgExtension = $request->cover_img->getClientOriginalExtension();
            $fileName = time() . "-" . uniqid() . '.' . $imgExtension;
            $request->cover_img->move(public_path('upload'),$fileName);
    
         $data['cover_img']='/upload/'.$fileName;
        };
      
       
       $project = Portfolio::create($data);
        
       return $this->successResponse($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project= Portfolio::findOrFail($id);
       
        $data=$request->all();
        if($request->hasFile('cover_img')){

            $imgExtension = $request->cover_img->getClientOriginalExtension();
            $fileName = time() . "-" . uniqid() . '.' . $imgExtension;
            $request->cover_img->move(public_path('upload'),$fileName);
    
         $data['cover_img']='/upload/'.$fileName;
        };
       /*  dd($data); */
        $project->update($data);
       return $this->successResponse($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project=Portfolio::find($id);
        $project->delete();
        return response()->json('Success') /* $this->successResponse($project) */;
    }
}
