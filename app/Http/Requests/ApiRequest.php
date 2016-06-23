<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ApiRequest extends Request
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
            "uuid" => "required"
            /** although we can write token check here, but let it for middleware */
            /** middleware GROUP request for api in to 1 place */
//            "_token" => "required"
        ];
    }
}
