<?php

namespace App\Policies;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class MahasiswaPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mahasiswa $mahasiswa): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin'; // Only admin or dosen can create Mahasiswa
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->role === 'admin'; // Only admin or dosen can update Mahasiswa
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->role === 'admin'; // Only admin can delete Mahasiswa
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Mahasiswa $mahasiswa): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Mahasiswa $mahasiswa): bool
    {
        return false;
    }
}
