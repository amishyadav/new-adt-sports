<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Repositories\PartnerRepository;
use Illuminate\Http\Request;

class PartnerController extends AppBaseController
{

    /**
     * @param PartnerRepository $partnerRepository
     */
    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partnerRepo = $partnerRepository;
    }

    public function index()
    {
        return view('partner.index');
    }

  
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $this->partnerRepo->store($request->all());

        return $this->sendSuccess('Partner Item Created Successfully.');
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Partner $partner)
    {
        return $this->sendResponse($partner, 'Partner Item Retrieved Successfully');
    }


    public function update(Request $request, $id)
    {
        $this->partnerRepo->update($request->all(), $id);

        return $this->sendSuccess('Partner Item Update successfully.');
    }


    public function destroy(Partner $partner)
    {
        $partner->delete();
        return $this->sendResponse($partner, 'Partner Item Deleted successfully');
    }
}
