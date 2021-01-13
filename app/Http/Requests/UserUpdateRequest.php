<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'     => 'required|min:5|max:100',
            'about'    => 'max:400',
            'city'     => 'required',
            'phone'    => 'required',
            'avatar'   => 'image|mimes:jpeg,jpg,png|max:3000'
        ];
    }
    public function attributes()
    {
        return [
            'about'         => 'О себе',
        ];
    }

    public function messages(){
        return[
            'avatar.image'  => 'Загружаемая аватарка должна быть изображением',
            'avatar.max'    => 'Размер загружаемой фотографии должен быть не больше 3 Мб',
            'avatar.mimes'  => 'Аватар должнен быть файлом одного из следующих типов: jpeg, jpg, png'
        ];
    }
}
