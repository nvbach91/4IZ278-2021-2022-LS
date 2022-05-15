<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Auth\TokenGuard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class BearerTokenGuard extends TokenGuard
{
    use GuardHelpers;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;


    /**
     * Create a new authentication guard.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(
        UserProvider $provider,
        Request      $request)
    {
        $this->request = $request;
        $this->provider = $provider;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (!is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $token = $this->getTokenForRequest();
        if (!empty($token)) {
            $githubUser = $this->verifyToken($token);
            if ($githubUser) {
                $user = $this->provider->retrieveByCredentials(["node_id" => $githubUser['node_id']]);
            }
        }
        return $this->user = $user;
    }

    /**
     * Get the token for the current request.
     *
     * @return string
     */
    public function getTokenForRequest()
    {
        return $this->request->bearerToken();
    }

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $token = $this->getTokenForRequest();
        if (empty($token)) {
            return false;
        }
        $githubUser = $this->verifyToken($token);
        if (!$githubUser) {
            return false;
        } else if ($this->provider->retrieveByCredentials(['node_id' => $githubUser['node_id']])) {
            return true;
        }
        return false;
    }

    /**
     * Set the current request instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    private function verifyToken($accessToken)
    {
        try {
            return Socialite::driver('github')->scopes(['repo:status', 'read:user', 'user:email'])->stateless()->userFromToken($accessToken);
        } catch (\Exception $e) {
            return false;
        }
    }
}

