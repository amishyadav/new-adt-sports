<?php

namespace App\Repositories;

use App\Models\AllMatch;
use App\Models\Blog;
use App\Models\League;
use App\Models\Option;
use App\Models\Question;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


/**
 * Class LeagueRepository
 */
class BlogRepository extends BaseRepository
{
    public $fieldSearchable = [
        'title',
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
        return Blog::class;
    }

    public function store($input)
    {
        try {
            $blog = Blog::create($input);

            if (!empty($input['image'])) {
                $blog->addMedia($input['image'])->toMediaCollection(Blog::IMAGE,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $blog)
    {
        try {

            $blog->update($input);
            if (isset($input['image']) && !empty($input['image'])) {
                $blog->clearMediaCollection(Blog::IMAGE);
                $blog->addMedia($input['image'])->toMediaCollection(Blog::IMAGE,
                    config('app.media_disc'));
            }

        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
