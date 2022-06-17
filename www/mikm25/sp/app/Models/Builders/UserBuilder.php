<?php

namespace App\Models\Builders;

use App\Models\Builders\Traits\WithIdQuery;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    use WithIdQuery;

    public function ofEmail(string $email): self
    {
        return $this->where('email', $email);
    }

    public function ofGithubId(int $githubId): self
    {
        return $this->where('github_id', $githubId);
    }

    public function hasVerifiedEmail(): self
    {
        return $this->whereNotNull('email_verified_at');
    }
}
