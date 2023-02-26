<?php

namespace App\Http\Controllers;

use App\Models\FAQs;
use App\Repositories\FaqsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqsController extends AppBaseController
{

    /**
     * @param FaqsRepository $faqsRepository
     */
    public function __construct(FaqsRepository $faqsRepository)
    {
        $this->faqsRepo = $faqsRepository;
    }

    public function index(): Factory|View|Application
    {
        return view('faqs.index');
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $input['status'] = $input['status'] ?? 0;
        $this->faqsRepo->create($input);

        return $this->sendSuccess('Faqs create successfully.');
    }


    public function edit($id): JsonResponse
    {
        $faq = FAQs::findOrFail($id);

        return $this->sendResponse($faq, 'FAQ retrieved successfully');

    }


    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();
        $input['status'] = $input['status'] ?? 0;
        $this->faqsRepo->update($input, $id);

        return $this->sendSuccess('Faqs Updated successfully.');
    }

    public function destroy(FAQs $Faq): JsonResponse
    {
        $Faq->delete();

        return $this->sendSuccess('Faqs deleted successfully.');
    }


    public function changeStatus($id): JsonResponse
    {
        $faq = FAQs::findOrFail($id);
        $faq->update(['status' => $faq->status == 0 ? 1 : 0]);

        return $this->sendResponse($faq, 'Faqs Status Update Successfully');
    }
}
