<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function blog(){
        return response()->json(Blog::get(), 200);
    }

    public function blogById($id){
        $blog = Blog::find($id);
        if($blog!=null){
            return response()->json($blog, 200);
        }
        return response()->json(['error' => 'Blog Not Found!'], 404);
    }

    public function blogSave(Request $req){
        try{
        
            $user = auth()->userOrFail();
        
        }catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
        
            return response()->json(['error'=>true,'message'=>$e->getMessage()],401);
        }

        $blog = Blog::create(['title' => $req['title'],
                              'text' => $req['text'],                        
                              'user_id' => $user['id']]);
        return response()->json($blog, 201);
    }

    public function blogEdit(Request $req, Blog $blog){
        $blog->update($req->all());
        return response()->json($blog, 201);
    }

    public function blogDelete(Request $req, Blog $blog){
        $blog->delete();
        $message = ['message' => 'Successfully deleted!'];

        return response()->json($message, 200);
    }
}
