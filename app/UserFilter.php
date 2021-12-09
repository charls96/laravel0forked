<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserFilter extends QueryFilter
{

    public function rules(): array
    {
        return [
            'search' => 'filled',
            'state' => 'in:active,inactive',
            'role' => 'in:user,admin',
            'skills' => 'array|exists:skills,id',
            'from' => 'date_format:d/m/Y',
            'to' => 'date_format:d/m/Y',
            'salary' => 'nullable'
        ];
    }

    public function search($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->whereRaw('CONCAT(first_name, " ", last_name) like ?', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhereHas('team', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
        });

    }

    public function state($query, $state)
    {
        return $query->where('active', $state == 'active');
    }

    public function skills($query, $skills)
    {
        $subquery = DB::table('skill_user AS s')
            ->selectRaw('COUNT(s.id)')
            ->whereColumn('s.user_id', 'users.id')
            ->whereIn('skill_id', $skills);

        $query->addBinding($subquery->getBindings());

        $query->where(DB::raw("({$subquery->toSql()})"), count($skills));
    }

    public function from($query, $date)
    {
        $date = Carbon::createFromFormat('d/m/Y', $date);

        $query->whereDate('created_at', '>=', $date);
    }

    public function to($query, $date)
    {
        $date = Carbon::createFromFormat('d/m/Y', $date);

        $query->whereDate('created_at', '<=', $date);
    }

    public function salary($query, $salary){
        if ($salary === 'with_salary') {
            return $query->whereHas('profile', function (Builder $query) {
                $query->whereNotNull('annual_salary');
               })->get();
        } elseif ($salary === 'without_salary') {
            return $query->whereHas('profile', function (Builder $query) {
                $query->where('annual_salary', '=', null);
               })->get();
        }
    }
}