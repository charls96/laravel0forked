<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfessionRequest;
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

    public function show(Profession $profession)
    {
        if ($profession == null) {
            return response()->view('errors.404', [], 404);
        }

        return view('professions.show', compact('profession'));
    }

    public function edit(Profession $profession)
    {
        return $this->form('professions.edit', $profession);
    }

    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        $request->updateProfession($profession);

        return redirect()->route('professions.show', $profession);
    }

    

    protected function form($view, Profession $profession)
    {
        return view($view, [
            'profession' => $profession,
        ]);
    }

    public function destroy(Profession $profession)
    {
        abort_if($profession->profiles()->exists(), 400, 'Cannot delete a profession linked to a profile');

        $profession->delete();

        return redirect()->route('professions.index');
    }
}
