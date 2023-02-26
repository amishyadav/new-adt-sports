<?php

namespace App\Repositories;

use App\Models\AllMatch;
use App\Models\League;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


/**
 * Class LeagueRepository
 */
class AllMatchRepository extends BaseRepository
{
    public $fieldSearchable = [
        'match_title',
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
        return AllMatch::class;
    }
    
}
