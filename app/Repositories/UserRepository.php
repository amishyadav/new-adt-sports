<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\User;
use Arr;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\DataTables;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository
{
    public $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'status',
        'password',

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
        return User::class;
    }

    /**
     * @param  array  $input
     *
     * @return mixed
     */
    public function store($input){
        $addressInputArray = Arr::only($input,
            ['address_1', 'address_2', 'state', 'city', 'zip']);

        try {
            DB::beginTransaction();
            $input['email'] = setEmailLowerCase($input['email']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole('member');
            $user->address()->create($addressInputArray);
            if (isset($input['profile']) && !empty('profile')) {
                $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return $user;
        }catch (\Exception $e){
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $user
     *
     *
     * @return int
     */
    public function update($input, $user): int
    {

        $addressInputArray = Arr::only($input,
            ['address_1', 'address_2', 'country_id', 'state', 'city', 'zip']);

        try {
            DB::beginTransaction();
            $input['email'] = setEmailLowerCase($input['email']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $input['type'] = User::MEMBER;
            $user->update($input);
            $user->address()->update($addressInputArray);

            if (isset($input['profile']) && ! empty('profile')) {
                $user->clearMediaCollection(User::PROFILE);
                $user->media()->delete();
                $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }
            DB::commit();

            return $user;
        }catch (\Exception $e){
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }






    /**
     * @return mixed
     */
    public function getCountries()
    {
        $countries = Country::pluck('name', 'id');

        return $countries;
    }




}
