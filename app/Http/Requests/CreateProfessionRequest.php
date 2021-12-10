<?php

namespace App\Http\Requests;

use App\Profession;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateProfessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }


    public function createProfession()
    {
        DB::transaction(function () {
            $profession = Profession::create([
                'title' => $this->title,
            ]);
        });
    }
}
