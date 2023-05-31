<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\Karyawan;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Karyawan $karyawan)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Karyawan $karyawan, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Karyawan $karyawan)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Karyawan $karyawan, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Karyawan $karyawan, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Karyawan $karyawan, Item $item)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Karyawan $karyawan, Item $item)
    {
        //
    }
}
