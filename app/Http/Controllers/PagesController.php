<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = "Welcome to the gallery!";
//        return  view('pages.index', compact('title', ));
        return  view('pages.index')->with('title', $title);
    }

//    public function about() {
//        $title = "This is the About Section";
//        // return  view('pages.about');
//        return  view('pages.about')->with('title', $title);
//    }
    public function about(Request $request) {
        $title = "This is the About Section";
        // return  view('pages.about');
        print "{{$request->file('posts')}}";
//        return  view('posts.index')->with('posts', $request->file('posts'));
    }

    public function services(Request $request) {
//        $data = array(
//            'title' => 'Services',
//            'services' => ['Web Ddesign', 'Programming', 'Dancing']
//        );
        $items = $request->input('items');
//        echo "console.log('**********************************************************$items')";

        // return  view('pages.services');
        return  view('pages.services')->with('items', $items);
    }


    public function succsess() {
        $title = "Zahlung erfolgreich!";
        return  view('resultpages.success')->with('title', $title);
    }

    public function fail() {
        $title = "Zahlung fehlgeschlagen";
        return  view('resultpages.fail')->with('title', $title);
    }

    public function test(Request $request)
    {
        //
//        $this->validate($request, [
//            'title' => 'required',
//            'price' => 'required',
//            'body' => 'required',
//            'gal_img' =>'image|nullable|max:1999'
//        ]);
        //handle the fileupload
//        if($request->hasFile('gal_img')) {
//            //get Filenmae with extensions
//            $fielNameWithExt = $request->file('gal_img')->getClientOriginalName();
//            $filename = pathinfo($fielNameWithExt, PATHINFO_FILENAME);
//            //get the ext
//            $extension = $request->file('gal_img')->getClientOriginalExtension();
//            //filename to store
//            $fileNameToStore = $filename.'_'.time().'.'.$extension;
//            //upload image
//            $path = $request->file('gal_img')->storeAs('public/gal_img', $fileNameToStore);
//        }else{
//            $fileNameToStore = 'noimage.jpeg';
//        }

//        $post = new Post;
//        $post->title = $request->input('title');
//        $post->body = $request->input('body');
//        $post->price = $request->input('price');
//        $post->user_id = auth()->user()->id;
//        $post->gal_img = $fileNameToStore;
//        $post->save();

        return redirect('/resultpage.fail')->with('title', 'Post created');
    }

}
