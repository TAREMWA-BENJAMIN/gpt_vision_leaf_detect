<?php

namespace App\Services;

use App\Models\PgtAiResult;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

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
     * Get all results for all users
     */
    public function getAllResults(bool $paginate = false, int $perPage = 10): Collection|LengthAwarePaginator
    {
        $query = PgtAiResult::with('user')
            ->orderBy('created_at', 'desc');

        return $paginate ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Create a new result
     */
    public function createResult(array $data): PgtAiResult
    {
        // Handle base64 image upload
        if (isset($data['plant_image']) && str_starts_with($data['plant_image'], 'data:image')) {
            $base64Image = $data['plant_image'];
            @list($type, $fileData) = explode(';base64,', $base64Image);
            $extension = explode('/', $type)[1];
            $imageName = 'plant_' . time() . '.' . $extension;
            
            Storage::disk('public')->put('plant_images/' . $imageName, base64_decode($fileData));
            $data['plant_image'] = 'plant_images/' . $imageName; // Store the path
        }

        // Ensure user_id is set for the result
        if (!isset($data['user_id'])) {
            $data['user_id'] = auth()->id();
        }

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