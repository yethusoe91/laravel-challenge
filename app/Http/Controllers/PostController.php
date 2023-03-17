<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostReactionRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
class PostController extends Controller
{
    public function list()
    {
        $posts = Post::withCount('likes')->with('tags')->paginate(20);
        
        return PostResource::collection($posts);
    }
    
    public function toggleReaction(PostReactionRequest $request)
    {   
        $post = Post::findorFail($request->post_id);
        
        if($post->user_id == auth()->id()) {
            return response()->json([
                'status' => 500,
                'message' => 'You cannot like your post'
            ]);
        }
        
        $like = Like::where('post_id', $request->post_id)->where('user_id', auth()->id())->first();
        
        if(!$like){
            Like::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id()
            ]);
            
            return response()->json([
                'status' => 200,
                'message' => 'You like this post successfully'
            ]);
        }

        if(!(boolval($request->like)))
        {
            $like->delete();
            
            return response()->json([
                'status' => 200,
                'message' => 'You unlike this post successfully'
            ]);
        }
        
    }
}
