<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class BlogController extends AppBaseController
{

    /**
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepo = $blogRepository;
    }

    public function index()
    {
       return view('cms.blog.index');
    }

    
    public function create()
    {
        return view('cms.blog.create');
    }

    
    public function store(Request $request)
    {
        $this->blogRepo->store($request->all());

        Flash::success(__('Blog create successfully.'));

        return redirect(route('blog.index'));
    }

  
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('cms.blog.edit', compact('blog'));
    }

    
    public function update(Request $request,Blog $blog)
    {
       $this->blogRepo->update($request->all(), $blog);

        Flash::success(__('Blog updated successfully.'));

        return redirect(route('blog.index'));
    }
    
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return $this->sendSuccess('Blog deleted successfully.');
    }
}
