<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Recomendation;
use App\Employee;
use Alert;
use Auth;

class RecomendationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recomendation::class, 'recomendation');
    }

    public function store(Employee $employee)
    {
        $recomendation = new Recomendation;
        $recomendation->employee()->associate($employee);

        Auth::user()->recomendations()->save($recomendation);
        Alert::success('Berhasil merekomendasikan Karyawan');

        return redirect()->back();
    }

    public function destroy(Employee $employee, Recomendation $recomendation)
    {
        $recomendation->delete();
        Alert::success('Berhasil menghapus Rekomendasi Karyawan');

        return redirect()->back();
    }

    public function accept(Employee $employee, Recomendation $recomendation)
    {
        $this->authorize('update', $recomendation);

        $recomendation->status = Recomendation::APPROVED;
        $recomendation->approvedBy()->associate(Auth::user());
        $recomendation->save();

        Alert::success('Berhasil menerima Rekomendasi Karyawan');
        return redirect()->back();
    }

    public function reject(Employee $employee, Recomendation $recomendation)
    {
        $this->authorize('update', $recomendation);

        $recomendation->status = Recomendation::REJECTED;
        $recomendation->approvedBy()->associate(Auth::user());
        $recomendation->save();

        Alert::success('Berhasil menolak Rekomendasi Karyawan');
        return redirect()->back();
    }
}
