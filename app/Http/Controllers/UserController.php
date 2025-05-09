<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateChangePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UserController extends AppBaseController
{

    /**
     * @var UserRepository
     */
    public UserRepository $userRepo;

    /**
     * UserController constructor.
     *
     * @param  UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }
    public function index(): Application|Factory|View
    {
        return view('users.index');
    }

    public function create(): Application|Factory|View
    {
        return view('users.create');
    }


    public function store(CreateUserRequest $request): Application|RedirectResponse|Redirector
    {
        $input = $request->all();
        $this->userRepo->store($input);

        Flash::success( __('messages.flash.user_create'));

        return redirect(route('users.index'));
    }

    public function edit($id): Factory|View|Application
    {
        $user = User::with('address')->findOrFail($id);

        return  view('users.edit' ,compact('user'));
    }


    public function update(UpdateUserRequest $request, User $user): Application|RedirectResponse|Redirector
    {

        $input = $request->all();
        $this->userRepo->update($input, $user);

        Flash::success( __('messages.flash.user_update'));
        return redirect(route('users.index'));
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return $this->sendSuccess(__('messages.flash.user_deleted'));
    }

   public  function editProfile(): Factory|View|Application
   {

       $user = getLogInUser();

       if($user->hasRole('admin')){
           return view('profile.index', compact('user'));
       }elseif($user->hasRole('member')){
           return view('profile.user_index', compact('user'));
       }
       return view('profile.index', compact('user'));
   }
    public function updateProfile(UpdateUserProfileRequest $request): Redirector|Application|RedirectResponse
    {
        $user = getLogInUser();

        $user->update($request->all());

        Flash::success( __('messages.flash.user_profile_update'));

        return redirect(route('profile.setting'));
    }

    public function changePassword(UpdateChangePasswordRequest $request): JsonResponse
    {
        $input = $request->all();

        try {
            /** @var User $user */
            $user = getLogInUser();
            if (!Hash::check($input['current_password'], $user->password)) {
                return $this->sendError(__('messages.flash.current_invalid'));
            }
            $input['password'] = Hash::make($input['new_password']);
            $user->update($input);

            return $this->sendSuccess(__('messages.flash.password_update'));
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
    public function updateLanguage(Request $request): JsonResponse
    {
        $language = $request->get('language');

        $user = getLogInUser();
        $user->update(['language' => $language]);

        return $this->sendSuccess('Language Update Successfully');
    }
    /**
     *
     * @return JsonResponse
     */
    public function updateDarkMode(): JsonResponse
    {
        $user = getLogInUser();

        $darkEnabled = $user->theme_mode == true;

        $user->update([
            'theme_mode' => !$darkEnabled,
        ]);

        return $this->sendSuccess(__('messages.flash.theme_change'));
    }

    public function impersonate($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        getLogInUser()->impersonate($user);

        if($user->hasRole('admin')){
            return redirect()->route('admin.dashboard');
        }elseif($user->hasRole('member')){
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('admin.dashboard');
    }

    public function impersonateLeave(): RedirectResponse
    {
        getLogInUser()->leaveImpersonation();

        return redirect()->route('admin.dashboard');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function twoFactorAuth(Request $request)
    {
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
        $user = getLogInUser();
        $imageRender = null;
        $secret = null;
        if ($user->google2fa_secret){
            $secret = Crypt::decrypt($user->google2fa_secret);
            $image = $google2fa->getQRCodeUrl(
                $request->getHttpHost(),
                $user->email,
                $user->google2fa_secret
            );
            $imageRender = ((new \chillerlan\QRCode\QRCode())->render($image));
        }

        return view('2fa_security.index',compact('imageRender','user','secret'));
    }

    /**
     * @param Request $request
     *
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     * @return JsonResponse
     */
    public function twoFactorAuthEnable(Request $request)
    {
        $image = null;
        $secret = null;
       $data = [];
            $google2fa = new Google2FA();
            $data['secret'] = $google2fa->generateSecretKey();

            $user = $request->user();
            $user->google2fa_secret = Crypt::encrypt($data['secret']);
            $data['user'] = $user->save();

            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

            $image = $google2fa->getQRCodeUrl(
                $request->getHttpHost(),
                $user->email,
                $secret
            );

        $data['imageRender'] = ((new \chillerlan\QRCode\QRCode())->render($image));

        return $this->sendResponse($data,'Two Factor Authentication Enabled successfully');
    }

    /**
     * @param Request $request
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     * @return JsonResponse
     */
    public function twoFactorAuthDisable(Request $request)
    {
        $user = getLogInUser();
        $secret = Crypt::decrypt($user->google2fa_secret);

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secret, $request->twoStep_otp);
        if (!$valid){
           return $this->sendError('The entered One-Time Password is not valid.');
        }
        $user->google2fa_secret = null;
        $user->save();

        return $this->sendResponse($user,'Two Factor Authentication Disabled successfully');
    }
}
