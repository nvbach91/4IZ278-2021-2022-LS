<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Models\User;
use App\Services\User\UserDeleteValidatorService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * @var UserDeleteValidatorService
     */
    private $deleteValidatorService;

    public function __construct(UserDeleteValidatorService $deleteValidatorService)
    {
        $this->deleteValidatorService = $deleteValidatorService;
    }

    public function profile(): RedirectResponse
    {
        /** @var User $user */
        $user = auth('web')->user();

        return redirect()->route('app.users.show', [
            'user' => $user->id,
        ]);
    }

    public function show(User $user, UserShowRequest $request): string
    {
        return view('app.user.show', [
            'user' => $user,
        ]);
    }

    public function delete(User $user, UserDeleteRequest $request): RedirectResponse
    {
        if (! $this->deleteValidatorService->validate($request, $user)) {
            $error = $user->github
                ? ['name' => [__('status.users.delete.nameFailed')]]
                : ['password' => [__('status.users.delete.passwordFailed')]];

            return redirect()->back()
                ->withErrors($error, 'user_delete')
                ->with('show-delete-modal', true);
        }

        // Logout user
        auth('web')->logout();

        // Delete user
        $user->delete();

        return redirect()->route('auth.login')->with('status', [
            'success' => __('status.users.delete.success'),
        ]);
    }
}
