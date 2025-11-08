<?php

namespace App\Repositories;

use App\Models\Teams;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class TeamsRepository
 */
class TeamsRepository extends BaseRepository
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
        return Teams::class;
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
            $input['user_id'] = getLogInUserId();
            $team = Teams::create($input);

            if (isset($input['profile']) && !empty('profile')) {
                $team->addMedia($input['profile'])->toMediaCollection(Teams::TEAM_LOGO, config('app.media_disc'));
            }

            DB::commit();

            return $team;
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
            $input['user_id'] = getLogInUserId();
            $team = Teams::findOrFail($id);
            $team->update($input);

            if (isset($input['profile']) && ! empty('profile')) {
                $team->clearMediaCollection(Teams::TEAM_LOGO);
                $team->media()->delete();
                $team->addMedia($input['profile'])->toMediaCollection(Teams::TEAM_LOGO, config('app.media_disc'));
            }


            DB::commit();

            return $team;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
