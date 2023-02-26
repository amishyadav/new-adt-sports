<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\SeoTool;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


/**
 * Class CategoryRepository
 */
class SettingRepository extends BaseRepository
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
        return Setting::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */

    public function update($input,$id)
    {
        try {
            $inputArr = Arr::except($input, ['_token']);
            foreach ($inputArr as $key => $value){
                /** @var Setting $setting */
                $setting = Setting::where('key', $key)->first();
                if (! $setting) {
                    continue;
                }
                $setting->update(['value' => $value]);

                if (in_array($key, ['logo']) && ! empty($value)) {
                    $setting->clearMediaCollection(Setting::LOGO);
                    $media = $setting->addMedia($value)->toMediaCollection(Setting::LOGO, config('app.media_disc'));
                    $setting->update(['value' => $media->getUrl()]);
                }

                if (in_array($key, ['favicon']) && ! empty($value)) {
                    $setting->clearMediaCollection(Setting::FAVICON);
                    $media = $setting->addMedia($value)->toMediaCollection(Setting::FAVICON, config('app.media_disc'));
                    $setting->update(['value' => $media->getUrl()]);
                }
            }
            
            
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
