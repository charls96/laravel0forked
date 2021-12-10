<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use App\Profession;
use App\ProfessionFilter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
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

    public function create()
    {
        return $this->form('professions.create', new Profession);
    }

    public function store(CreateProfessionRequest $request)
    {
        $request->createProfession();

        return redirect()->route('professions.index');
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

    public function trashed()
    {
        $professions = Profession::onlyTrashed()->paginate();

        return view('professions.index', [
            'professions' => $professions,
            'view' => 'trash',
        ]);
    }

    public function trash(Profession $profession)
    {
        $profession->profile()->delete();
        $profession->delete();

        return redirect()->route('professions.index');
    }

    /* public function destroy(Profession $profession)
    {
        abort_if($profession->profiles()->exists(), 400, 'Cannot delete a profession linked to a profile');

        $profession->delete();

        return redirect()->route('professions.index');
    } */



    public function destroy($id)
    {
        $profession = Profession::onlyTrashed()->where('id', $id)->firstOrFail();

        abort_if($profession->profiles()->exists(), 400, 'Cannot delete a profession linked to a profile');

        $profession->forceDelete();

        return redirect()->route('professions.trashed');
    }
}
