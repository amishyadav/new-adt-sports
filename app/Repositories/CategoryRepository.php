<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;


/**
 * Class CategoryRepository
 */
class CategoryRepository extends BaseRepository
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
        return Category::class;
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

            $input['status'] = isset($input['status']) ? 1 : 0;
            $category = Category::create($input);
            
            DB::commit();

            return $category;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input,$id)
    {
        try {
            DB::beginTransaction();
            $input['status'] = isset($input['status']) ? 1 : 0;
            $category = Category::findOrFail($id);
            $category->update($input);
           

            DB::commit();

            return $category;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
