<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\BulletinBoard\PostEditRequest;
use App\Http\Requests\BulletinBoard\MainCategoryRequest;
use App\Http\Requests\BulletinBoard\SubCategoryRequest;
use App\Http\Requests\BulletinBoard\PostCommentRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments', 'subCategories')->get();
        // dd($posts);
        $categories = MainCategory::get();
        $sub_categories = SubCategory::get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            // if文で確認する前にkeywordとsubcategoryテーブルのsubcategoryが一致しているかどうか確認
            $sub_category = SubCategory::where('sub_category', $request->keyword)->first();
            if($sub_category){
                $posts = Post::whereHas('subCategories', function($q) use ($sub_category){
                    $q->where('sub_category_id', $sub_category->id);
                });
                $posts = $posts->get();
            }else{
                $posts = Post::with('user', 'postComments')
                ->where('post_title', 'like', '%'.$request->keyword.'%')
                ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
            }

        }else if($request->category_word){
            $category_word = $request->category_word;
            $sub_category = SubCategory::where('sub_category', $category_word)->first();
            // dd($sub_category[0]->id);getの時は配列の番号を指定するかforeachで指定して
            $posts = Post::whereHas('subCategories', function($q) use ($sub_category){
                $q->where('sub_category_id', $sub_category->id);
            });
            $posts = $posts->get();

        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }else if($request->sub_category){
            $sub_category = SubCategory::where('sub_category', $request->sub_category)->first();
            if($sub_category){
                $posts = Post::whereHas('subCategories', function($q) use ($sub_category){
                    $q->where('sub_category_id', $sub_category->id);
                });
                $posts = $posts->get();
            }else{
                $posts = collect();
            }
    }
        // dd($sub_categories);
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'sub_categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments' ,'subCategories')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        $sub_categories = SubCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories', 'sub_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        PostSubCategory::create([
            'post_id' => $post->id,
            'sub_category_id' => $request->post_category_id,
        ]);

        return redirect()->route('post.show');
    }

    public function postEdit(PostEditRequest $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    public function mainCategoryCreate(MainCategoryRequest $request){
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }

    public function subCategoryCreate(SubCategoryRequest $request){
        SubCategory::create(['sub_category' => $request->sub_category_name,
       'main_category_id' => $request->main_category_name]);
        return redirect()->route('post.input');
    }


    public function commentCreate(PostCommentRequest $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        // この投稿の最新の総いいね数を取得
        // $post_likes_count = Post::whitCount('likes')->findOrFail($post_id)->likes_count;

        // $param = ['post_likes_count' => $post_likes_count];
        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
