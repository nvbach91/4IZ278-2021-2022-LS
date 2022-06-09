<?php

namespace App\Services\Position;

use App\DTOs\LandingPage\ReactionDTO;
use App\DTOs\Position\PositionDTO;
use App\Models\Position;
use App\Models\PositionInterest;
use App\Models\Tag;
use App\Models\User;

class PositionService
{
    public function storeOrUpdate(PositionDTO $positionStoreDTO, ?Position $position = null): Position
    {
        $position = $position ?? new Position();

        /** @var User $user */
        $user = auth('web')->user();

        $position->user_id = $user->id;
        $position->branch_id = $positionStoreDTO->branchId;
        $position->workload = $positionStoreDTO->workload;
        $position->company_id = $positionStoreDTO->company;
        $position->name = $positionStoreDTO->name;
        $position->salary_from = $positionStoreDTO->salaryFrom;
        $position->salary_to = $positionStoreDTO->salaryTo;
        $position->external_url = $positionStoreDTO->externalUrl;
        $position->content = $positionStoreDTO->content;
        $position->workplace_address = $positionStoreDTO->workplaceAddress;
        $position->valid_from = $positionStoreDTO->validFrom;
        $position->valid_until = $positionStoreDTO->validUntil;
        $position->min_practice_length = $positionStoreDTO->minPracticeLength;

        $position->save();

        if (! empty($positionStoreDTO->tags)) {
            $tagIds = [];

            foreach ($positionStoreDTO->tags as $tag) {
                /** @var Tag $tag */
                $tag = Tag::query()->firstOrCreate([
                    'user_id' => $user->id,
                    'name' => $tag,
                ]);

                $tagIds[] = $tag->id;
            }

            $position->tags()->sync($tagIds);
        }

        return $position;
    }

    public function storeInterest(Position $position, ReactionDTO $reactionDTO): PositionInterest
    {
        $interest = new PositionInterest();

        $interest->position_id = $position->id;
        $interest->name = $reactionDTO->name;
        $interest->email = $reactionDTO->email;
        $interest->phone = $reactionDTO->phone;
        $interest->message = $reactionDTO->message;

        $interest->save();

        return $interest;
    }
}
