<?php

namespace App\Http\Controllers;

use App\Profession;
use App\ProfessionFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessionController extends Controller
{
    public function index(ProfessionFilter $professionFilter)
    {
        $professions = Profession::query()
            ->with('profiles')
            ->filterBy($professionFilter, request()->only(['from', 'to']))
            ->orderBy('title')
            ->paginate();

            $professions->appends($professionFilter->valid());

        return view('professions.index', [
           'professions' => $professions
        ]);
    }

    public function destroy(Profession $profession)
    {
        abort_if($profession->profiles()->exists(), 400, 'Cannot delete a profession linked to a profile');

        $profession->delete();

        return redirect()->route('professions.index');
    }
}
