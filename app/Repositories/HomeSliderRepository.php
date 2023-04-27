<?php

namespace App\Repositories;

use App\Models\HomeSlider;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class HomeSliderRepository
 */
class HomeSliderRepository extends BaseRepository
{
    public $fieldSearchable = [
        'main_title',
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
        return HomeSlider::class;
    }

    public function store($input)
    {
        try {
            $homeSlider = HomeSlider::create($input);

            if (!empty($input['slider_image'])) {
                $homeSlider->addMedia($input['slider_image'])->toMediaCollection(HomeSlider::SLIDER_IMAGE,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $homeSlider)
    {
        try {

            $homeSlider->update($input);
            if (isset($input['slider_image']) && !empty($input['slider_image'])) {
                $homeSlider->clearMediaCollection(HomeSlider::SLIDER_IMAGE);
                $homeSlider->addMedia($input['slider_image'])->toMediaCollection(HomeSlider::SLIDER_IMAGE,
                    config('app.media_disc'));
            }

        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
