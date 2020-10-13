<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentPublishRequest extends FormRequest
{
    public function authorize()
    {
        return $this->method() === 'POST';
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
