<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PgtAiResultRequest;
use App\Models\PgtAiResult;
use App\Models\User;
use App\Services\PgtAiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PgtAiController extends Controller
{
    protected PgtAiService $pgtAiService;

    public function __construct(PgtAiService $pgtAiService)
    {
        $this->pgtAiService = $pgtAiService;
    }

    /**
     * Get all results for the authenticated user
     */
    public function index(Request $request): JsonResponse
    {
        // For now, return all results without user filtering
        $results = PgtAiResult::orderBy('created_at', 'desc')
            ->when($request->boolean('paginate', false), function($query) use ($request) {
                return $query->paginate($request->integer('per_page', 10));
            }, function($query) {
                return $query->get();
            });

        return response()->json($results);
    }

    /**
     * Get results for a specific user
     */
    public function userResults(Request $request, User $user): JsonResponse
    {
        $results = $this->pgtAiService->getUserResults(
            $user,
            $request->boolean('paginate', false),
            $request->integer('per_page', 10)
        );

        return response()->json($results);
    }

    /**
     * Get all shared results
     */
    public function shared(Request $request): JsonResponse
    {
        $results = $this->pgtAiService->getSharedResults(
            $request->boolean('paginate', false),
            $request->integer('per_page', 10)
        );

        return response()->json($results);
    }

    /**
     * Store a new result
     */
    public function store(PgtAiResultRequest $request): JsonResponse
    {
        $data = $request->validated();
        // Remove user_id requirement for now
        $result = $this->pgtAiService->createResult($data);

        return response()->json($result, 201);
    }

    /**
     * Get a specific result
     */
    public function show(PgtAiResult $result): JsonResponse
    {
        return response()->json($result);
    }

    /**
     * Update a result
     */
    public function update(PgtAiResultRequest $request, PgtAiResult $result): JsonResponse
    {
        // Remove authorization check
        $updated = $this->pgtAiService->updateResult($result, $request->validated());
        return response()->json(['success' => $updated]);
    }

    /**
     * Delete a result
     */
    public function destroy(PgtAiResult $result): JsonResponse
    {
        // Remove authorization check
        $deleted = $this->pgtAiService->deleteResult($result);
        return response()->json(['success' => $deleted]);
    }
} 