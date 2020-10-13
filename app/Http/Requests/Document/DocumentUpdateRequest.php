<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUpdateRequest extends FormRequest
{
    public function authorize() : bool
    {
        return $this->method() === 'PATCH';
    }

    public function rules() : array
    {
        return [
            'document' => [ 'required', 'array' ],
            'document.payload' => [ 'required', 'array' ],
//            'document.payload.actor' => [ 'sometimes', 'array' ],
//            'document.payload.meta'  => [ 'sometimes', 'array' ],
//            'document.payload.actions' => [ 'sometimes', 'array' ],
        ];
    }
}
