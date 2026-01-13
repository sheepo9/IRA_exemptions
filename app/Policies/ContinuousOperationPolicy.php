<?php

namespace App\Policies;

use App\Models\Continuous_operation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization; // Add this line
class ContinuousOperationPolicy
{
   use HandlesAuthorization;

    /**
     * View list of applications
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('operation-list');
    }

    /**
     * View a specific application
     */
    public function view(User $user, Continuous_operation $application): bool
    {
        return $user->hasRole('Administrator')
            || $application->user_id === $user->id;
    }

    /**
     * Create application
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('operation-create');
    }

    /**
     * Update application
     */
    public function update(User $user, Continuous_operation $application): bool
    {
        return $user->hasRole('Administrator')
            || (
                $user->hasPermissionTo('operation-edit') &&
                $application->user_id === $user->id &&
                $application->status === 'Pending'
            );
    }

    /**
     * Delete application
     */
    public function delete(User $user, Continuous_operation $application): bool
    {
        return $user->hasRole('Administrator')
            || (
                $user->hasPermissionTo('operation-delete') &&
                $application->user_id === $user->id &&
                $application->status === 'Pending'
            );
    }

    /**
     * Approve application
     */
    public function approve(User $user, Continuous_operation $application): bool
    {
        return $user->hasRole('Administrator')
            || $user->hasPermissionTo('operation-approve');
    }

    /**
     * Download approved document
     */
    public function downloadApproved(User $user, Continuous_operation $application): bool
    {
        return $user->hasRole('Administrator')
            || $application->user_id === $user->id;
    }

    /**
     * Download or preview shift roster
     */
    public function downloadShiftRoster(User $user, Continuous_operation $application): bool
    {
        return $user->hasRole('Administrator')
            || $application->user_id === $user->id;
    }
}
