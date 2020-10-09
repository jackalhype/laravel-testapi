<?php

namespace App\Http\Requests\Document;

use App\Enums\DocumentStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class DocumentSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! in_array($this->method(), ['POST', 'PATCH'])) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
        ];

        switch($this->method()) {
            case 'POST':
                return $rules;
            case 'PUT':
            case 'PATCH':
                return array_merge($rules, [
                    'payload' => [ 'required', 'string', 'json' ],
                ]);
        }

        return $rules;
    }
}
