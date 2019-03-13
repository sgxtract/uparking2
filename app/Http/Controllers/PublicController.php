<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Content;
use App\Log;
use Carbon\Carbon;

class PublicController extends Controller
{
    public function index(){
        $home = Content::where('id', 1)->first();
        return view('home')->with('home', $home);
    }

    public function about(){
        $about = Content::where('id', 2)->first();
        return view('about')->with('about', $about);
    }

    public function contact(){
        $contact = Content::where('id', 3)->first();
        return view('contact')->with('contact', $contact);
    }

    public function homeCMS(){
        $home = Content::where('id', 1)->first();
        return view('admin.cms.home-cms')->with('home', $home);
    }

    public function changeHome(Request $request){

        $home = Content::where('id', 1)->first();
        $home->title = strip_tags($request['title']);
        $home->sub_title = strip_tags($request['sub_title']);
        $home->description = strip_tags($request['description']);
        $home->updated_at = Carbon::now();

        $bg_img = $request->file('bg_img');
        
        if($bg_img){
            $fileName = $bg_img->getClientOriginalName();
            $fileExtension = $bg_img->getClientOriginalExtension();
            
            $bg_img->move('images/cms/home', $fileName);
            $home->image = 'images/cms/home/' . $fileName;
        }

        $home->save();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "Updated Home Page";
        $logs->ip_address = \Request::ip();
        $logs->action = 'update';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'Updated Home Page.');
    }

    public function aboutCMS(){
        $about = Content::where('id', 2)->first();
        return view('admin.cms.about-cms')->with('about', $about);
    }

    public function changeAbout(Request $request){

        $this->validate($request, [
            'bg_img' => 'file',
        ]);

        $about = Content::where('id', 2)->first();
        $about->title = strip_tags($request['title']);
        $about->sub_title = strip_tags($request['sub_title']);
        $about->description = strip_tags($request['description']);
        $about->updated_at = Carbon::now();

        $bg_img = $request->file('bg_img');

        if($bg_img){
            $fileName = $bg_img->getClientOriginalName();
            $fileExtension = $bg_img->getClientOriginalExtension();
            
            $bg_img->move('images/cms/home', $fileName);
            $about->image = 'images/cms/home/' . $fileName;
        }

        $about->save();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "Updated About Page";
        $logs->ip_address = \Request::ip();
        $logs->action = 'update';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'Updated About Page.');
    }

    public function contactCMS(){
        $contact = Content::where('id', 3)->first();
        return view('admin.cms.contact-cms')->with('contact', $contact);
    }

    public function changeContact(Request $request){

        $contact = Content::where('id', 3)->first();
        $contact->title = strip_tags($request['title']);
        $contact->sub_title = strip_tags($request['sub_title']);
        $contact->description = strip_tags($request['description']);
        $contact->updated_at = Carbon::now();

        $bg_img = $request->file('bg_img');

        if($bg_img){
            $fileName = $bg_img->getClientOriginalName();
            $fileExtension = $bg_img->getClientOriginalExtension();
            
            $bg_img->move('images/cms/home', $fileName);
            $contact->image = 'images/cms/home/' . $fileName;
        }
        
        $contact->save();

        // Post To Logs
        $logs = new Log;
        $logs->user_id = Auth::user()->id;
        $logs->type = 'admin';
        $logs->description = "Updated Contact Page";
        $logs->ip_address = \Request::ip();
        $logs->action = 'update';
        $logs->created_at = Carbon::now();
        $logs->save();

        return back()->with('success', 'Updated Contact Page.');
    }

}
