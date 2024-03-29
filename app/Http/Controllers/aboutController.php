<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class aboutController extends Controller
{
    public function AboutPage(){
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all',compact('aboutpage'));
    }

    public function UpdateAbout(Request $request){

        $about_id = $request->id;

        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
            
            $save_url = 'upload/about_page /'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'About Image Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } else{

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                 

            ]); 
            $notification = array(
            'message' => 'about Updated without Image Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } // end Else

     } // End Method 
     public function HomeAbout(){

        $aboutpage = About::find(1);
        return view('frontend.about_page',compact('aboutpage'));

     }// End Method 

}
