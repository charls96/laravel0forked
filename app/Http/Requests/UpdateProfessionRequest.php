<?php

namespace App\Http\Requests;

use App\Role;
use App\profession;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateprofessionRequest extends FormRequest
{
    /**
     * Determine if the profession is authorized to make this request.
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

    public function updateProfession(Profession $profession)
    {
        $profession->fill([
            'title' => $this->title,
        ]);

        $profession->save();
    }
}
