<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementUpdateRequest extends FormRequest
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
            'title'          => 'required|min:5|max:200',
            'category_id'    => 'required|integer|exists:categories,id',
            'description'    => 'min:3|max:500',
            'city'           => 'required',
            'price'          => 'required|integer',
            'file'           => 'image|mimes:jpeg,jpg,png|max:10000'
        ];
    }

    public function attributes()
    {
        return [
            'title'         => 'Заголовок',
            'category_id'   => 'Категория',
            'price'         => 'Цена'
        ];
    }
    public function messages(){
        return[
            'file.max'    => 'Размер загружаемой фотографии должен быть не больше 10 Мб',
            'file.mimes'    => 'Фотография должна быть файлом одного из следующих типов: jpeg, jpg, png'
        ];
    }
}
