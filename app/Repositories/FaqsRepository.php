<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\FAQs;
use App\Models\League;
use Illuminate\Support\Facades\DB;


/**
 * Class LeagueRepository
 */
class FaqsRepository extends BaseRepository
{
    public $fieldSearchable = [
        'questions',
        'answers',
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
        return FAQs::class;
    }

}
