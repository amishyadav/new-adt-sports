<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $phone
 * @property string|null $region_code
 * @property string|null $sms_verified_at
 * @property int $status
 * @property int $theme_mode
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read string $profile_image
 * @property-read mixed $role_display_name
 * @property-read mixed $role_name
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User permission($permissions)
 * @method static Builder|User query()
 * @method static Builder|User role($roles, $guard = null)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRegionCode($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSmsVerifiedAt($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereThemeMode($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia ,Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'contact',
        'status',
        'unique_code',
        'type',
        'position',
        'position_type',
        'gender',
        'dob',
    ];


    const LANGUAGES = [
        'en' => 'English',
        'es' => 'Spanish',
        'fr' => 'French',
        'de' => 'German',
        'ru' => 'Russian',
        'pt' => 'Portuguese',
        'ar' => 'Arabic',
        'zh' => 'Chinese',
        'tr' => 'Turkish',
        'it' => 'Italian',
    ];

    const POSITION_TYPE = [
         'Left Corner' => ' Left Corner',
         'Right Corner' => 'Right Corner',
         'Left Cover' => 'Left Cover',
         'Right Cover' => 'Right Cover',
        ];

    const LANGUAGES_IMAGE = [
        'en' => 'web/media/flags/united-states.svg',
        'es' => 'web/media/flags/spain.svg',
        'fr' => 'web/media/flags/france.svg',
        'de' => 'web/media/flags/germany.svg',
        'ru' => 'web/media/flags/russia.svg',
        'pt' => 'web/media/flags/portugal.svg',
        'ar' => 'web/media/flags/iraq.svg',
        'zh' => 'web/media/flags/china.svg',
        'tr' => 'web/media/flags/turkey.svg',
        'it' => 'web/media/flags/italy.svg',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     const MEMBER = 'member';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const PROFILE = 'profile';
    const AADHAR_CARD = 'aadhar_card';

    protected $with = ['media', 'roles'];

    public static $rules = [
        'first_name'  => 'required',
        'last_name'   => 'required',
        'email'       => 'required|email|unique:users,email|regex:/(.*)@(.*)\.(.*)/',
        'contact'       => 'required|nullable|unique:users,contact',
        'password'    => 'required|same:password_confirmation|min:8',
        'position'      => 'required',
        'gender'      => 'required',
        'status'      => 'nullable',
        'profile'     => 'nullable|mimes:jpeg,png,jpg',
        'aadhar_card_image'     => 'nullable|mimes:jpeg,png,jpg',
    ];

    protected $appends = ['full_name', 'profile_image', 'aadhar_image', 'role_name', 'role_display_name'];

    /**
     * @return string
     */
    public function getProfileImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('images/avatar.png');
    }

    /**
     * @return string
     */
    public function getAadharImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::AADHAR_CARD)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('images/avatar.png');
    }

    public function getRoleNameAttribute()
    {
        $role = $this->roles->first();

        if (!empty($role)) {
            return $role->display_name;
        }
    }

    public function getRoleDisplayNameAttribute()
    {
        $role = $this->roles->first();

        if (!empty($role)) {
            return $role->name;
        }
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id' );
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'user_id' );
    }

    public function teamPlayer()
    {
        return $this->hasOne(TeamPlayer::class, 'user_id' );
    }

    public function registeredPlayer()
    {
        return $this->hasMany(RegisteredPlayer::class, 'user_id' );
    }

    /**
     * @return string
     */
    public static function generatePlayerUniqueCode(): string
    {
        $uniqueCode = mb_strtoupper('PLAYER'.Str::random(6));
        while (true) {
            $isExist = self::where('unique_code',$uniqueCode)->exists();
            if ($isExist) {
                self::generatePlayerUniqueCode();
            }
            break;
        }

        return $uniqueCode;
    }
}
