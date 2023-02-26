<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\League;
use Illuminate\Support\Facades\DB;


/**
 * Class LeagueRepository
 */
class LeagueRepository extends BaseRepository
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
        return League::class;
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
            $league = League::create($input);
            
            DB::commit();

            return $league;
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
            $league = League::findOrFail($id);
            $league->update($input);
           

            DB::commit();

            return $league;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
