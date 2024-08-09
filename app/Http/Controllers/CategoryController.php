<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(Hash::make('12345678'));
        return CategoryResource::collection( Category::orderBy('created_at','DESC')->get())->additional(['meta'=>['message'=>null,
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
       $category = Category::create($data);
        
       return $this->successResponse($category);
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
        $category= Category::find($id);
        $data=$request->all();
        if($request->hasFile('file')){

            $imgExtension = $request->file->getClientOriginalExtension();
            $fileName = time() . "-" . uniqid() . '.' . $imgExtension;
            $request->file->move(public_path('upload'),$fileName);
    
            $data['image']='/upload/'.$fileName;
        };
      
        $category->update($data);
       return $this->successResponse($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $category->delete();
        return response()->json('Success') /* $this->successResponse($category) */;
    }
}
