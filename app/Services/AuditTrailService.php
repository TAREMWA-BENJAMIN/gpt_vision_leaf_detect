<?php

namespace App\Services;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditTrailService
{
    /**
     * Log an action to the audit trail.
     *
     * @param string $action
     * @param null|\Illuminate\Database\Eloquent\Model $model
     * @param null|string $description
     * @param null|string $platform
     * @return void
     */
    public function log($action, $model = null, $description = null, $platform = null)
    {
        \Log::info('AuditTrailService called', [
            'action' => $action,
            'model' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'description' => $description,
            'platform' => $platform,
        ]);
        $user = request()->user() ?? auth()->user();
        $request = request();

        AuditTrail::create([
            'user_id' => $user ? $user->id : null,
            'action' => $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'description' => $description,
            'platform' => $platform ?? $this->detectPlatform($request),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    /**
     * Detect platform from request headers/user agent.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function detectPlatform($request)
    {
        $userAgent = $request->userAgent();
        if (stripos($userAgent, 'Android') !== false || stripos($userAgent, 'iPhone') !== false || stripos($userAgent, 'Mobile') !== false) {
            return 'Mobile App';
        }
        return 'Web App';
    }
} 