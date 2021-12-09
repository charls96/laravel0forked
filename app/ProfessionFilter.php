<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProfessionFilter extends QueryFilter
{
    public function rules(): array
    {
        return [
            'from' => 'date_format:d/m/Y',
            'to' => 'date_format:d/m/Y',
        ];
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
}