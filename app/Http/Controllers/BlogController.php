<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class BlogController extends AppBaseController
{
    private BlogRepository $blogRepo;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepo = $blogRepository;
    }

    public function index(): Factory|View|Application
    {
        return view('cms.blog.index');
    }

    public function store(CreateBlogRequest $request): JsonResponse
    {
        $this->blogRepo->store($request->all());

        return $this->sendSuccess('Blog created successfully.');
    }

    public function edit(Blog $blog): JsonResponse
    {
        return $this->sendResponse($blog, 'Blog retrieved successfully.');
    }

    public function update(UpdateBlogRequest $request, Blog $blog): JsonResponse
    {
        $this->blogRepo->update($request->all(), $blog);

        return $this->sendSuccess('Blog updated successfully.');
    }

    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();

        return $this->sendSuccess('Blog deleted successfully.');
    }
}
