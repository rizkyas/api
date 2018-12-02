<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //

    public function addCategory(Request $request)
    {
        if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		$category = new Category;
    		$category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
    		$category->description = $data['description'];
    		$category->url = $data['url'];
    		$category->save();
    		return redirect('/admin/view-categories')->with('flash_message_success','Category added Successfully!');
    	}
		$levels = Category::where(['id'=>0])->get();
		
    	return view('admin.categories.add_category')->with(compact('levels'));
    }

	public function editCategory(Request $request,$id = null){
		if($request->isMethod('post')){
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;
			Category::where(['id'=>$id])->update(['category_name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url']]);
			return redirect('/admin/view-categories')->with('flash_message_success','Category Update Succesfully');
		}
		$categoryDetails = category::where(['id'=>$id])->first();
		return view('admin.categories.edit_category')->with(compact('categoryDetails'));
	}

    public function viewCategories(){
    	$categories = Category::get(); // get all records
    	$categories = json_decode(json_encode($categories));
    	/*echo "<pre>"; print_r($categories); die;*/
    	return view('admin.categories.view_categories')->with(compact('categories'));
	}
	
	public function deleteCategory(Request $request, $id = null)
    {
		if(!empty($id)){
			Category::where(['id' => $id])->delete();
			return redirect()->back()->with('flash_message_success','Category Delete Succesfully!');
		}
        
    }
}
