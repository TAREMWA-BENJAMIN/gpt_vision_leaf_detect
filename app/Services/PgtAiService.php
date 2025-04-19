<?php

namespace App\Services;

use App\Models\PgtAiResult;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PgtAiService
{
    /**
     * Get all results for a user
     */
    public function getUserResults(User $user, bool $paginate = false, int $perPage = 10): Collection|LengthAwarePaginator
    {
        $query = PgtAiResult::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        return $paginate ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Get all shared results
     */
    public function getSharedResults(bool $paginate = false, int $perPage = 10): Collection|LengthAwarePaginator
    {
        $query = PgtAiResult::where('shared', true)
            ->with('user')
            ->orderBy('created_at', 'desc');

        return $paginate ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Create a new result
     */
    public function createResult(array $data): PgtAiResult
    {
        return PgtAiResult::create($data);
    }

    /**
     * Get a specific result
     */
    public function getResult(int $id): ?PgtAiResult
    {
        return PgtAiResult::find($id);
    }

    /**
     * Update a result
     */
    public function updateResult(PgtAiResult $result, array $data): bool
    {
        return $result->update($data);
    }

    /**
     * Delete a result
     */
    public function deleteResult(PgtAiResult $result): bool
    {
        return $result->delete();
    }
} 