<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'firstname' => 'string',
            'middlename' => 'string',
            'lastname' => 'string',
            'email' => 'string|email|unique:users',

            'options.gender' => 'string',
            'options.birthday' => 'date',
            'options.city_id' => 'numeric',
            'options.region_id' => 'numeric',
            'options.country_id' => 'numeric'
        ];
    }
}
