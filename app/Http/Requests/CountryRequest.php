<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $countryId = $this->route('country') ? $this->route('country')->id : '';
        
        $rules = [
            'name' => 'required|string|max:255|unique:countries,name,'.$countryId,
            'code' => 'required|string|max:2|unique:countries,code,'.$countryId
        ];
        
        // Make fields optional for update
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['name'] = str_replace('required|', 'sometimes|', $rules['name']);
            $rules['code'] = str_replace('required|', 'sometimes|', $rules['code']);
        }
        
        return $rules;
    }
}
