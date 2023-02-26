<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\League;
use App\Models\SocialIcon;
use Illuminate\Support\Facades\DB;


/**
 * Class LeagueRepository
 */
class SocialIconRepository extends BaseRepository
{
    public $fieldSearchable = [
        'title',
        'url',
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
        return SocialIcon::class;
    }
    
}
