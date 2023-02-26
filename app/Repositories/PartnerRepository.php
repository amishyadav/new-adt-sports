<?php

namespace App\Repositories;

use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


/**
 * Class CategoryRepository
 */
class PartnerRepository extends BaseRepository
{
    public $fieldSearchable = [
        'name',
    ];

    /**
     * @inheritDoc
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Partner::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            
            $partner_item = Partner::create($input);
            if (!empty($input['image'])) {
                $partner_item->addMedia($input['image'])->toMediaCollection(Partner::IMAGE,
                    config('app.media_disc'));
            }
            DB::commit();

            return $partner_item;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input,$id)
    {
        try {
            DB::beginTransaction();
            $partner_item = Partner::findOrFail($id);
            $partner_item->update($input);
            if (isset($input['image']) && !empty($input['image'])) {
                $partner_item->clearMediaCollection(Partner::IMAGE);
                $partner_item->addMedia($input['image'])->toMediaCollection(Partner::IMAGE,
                    config('app.media_disc'));
            }

            DB::commit();

            return $partner_item;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
