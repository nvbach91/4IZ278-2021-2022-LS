<?php

namespace App\Services\Position;

use App\DTOs\Position\PositionStoreDTO;
use App\Models\Company;
use App\Models\Position;
use App\Models\Tag;

class PositionService
{
    public function store(PositionStoreDTO $positionStoreDTO, ?Company $company): Position
    {
        $position = new Position();

        $userId = auth()->user()->id;

        $position->user_id = $userId;
        $position->branch_id = $positionStoreDTO->branchId;
        $position->company_id = $company instanceof Company ? $company->id : null;
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
                    'user_id' => $userId,
                    'name' => $tag,
                ]);

                $tagIds[] = $tag->id;
            }

            $position->tags()->sync($tagIds);
        }

        return $position;
    }
}
