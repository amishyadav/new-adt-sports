<?php

namespace App\Repositories;

use App\Models\TeamMatch;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class TeamMatchRepository
 */
class TeamMatchRepository extends BaseRepository
{
    public $fieldSearchable = [
        'team1_id',
        'team2_id',
        'status',
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
        return TeamMatch::class;
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

            $input['user_id'] = getLogInUserId();
            $input['status'] = 'Pending';
            $teamMatch = TeamMatch::create($input);

            DB::commit();

            return $teamMatch;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input,$id)
    {
        try {
            DB::beginTransaction();
            $input['user_id'] = getLogInUserId();
            $input['status'] = 'Pending';
            $teamMatch = TeamMatch::findOrFail($id);
            $teamMatch->update($input);

            DB::commit();

            return $teamMatch;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
