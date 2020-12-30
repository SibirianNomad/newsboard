@extends('layouts.app')

@section('content')
    @if($item->exists)
            <form method='POST' action="{{ route('announcement.update', $item->id ) }}">
                @method('PATCH')
                @else
                    <form method='POST' action="{{ route('announcement.store') }}" enctype="multipart/form-data"ы>
                        @endif
                        @csrf
        <div class='container'>
            @include('includes.result_message')
            <div class='col-md-10 m-auto'>
                <h3 class="text-center">{{$title}} объявление</h3>
                <div class='tab-content'>
                    <div class='tab-pave active' id='maindata' role='tabpanel'>
                        <div class='form-group'>
                            <label for='title'>Заголовок</label>
                            <input name='title'
                                   value='{{$item->title}}'
                                   id='title'
                                   type='text'
                                   class='form-control'
                            >
                        </div>
                        <div class='form-group'>
                            <label for='category_id'>Категория</label>
                            <select name='category_id'
                                    id='category_id'
                                    class='form-control'
                            >
                                <option disabled  selected>Категория</option>
                                @foreach($categories as $category)
                                    <option @if(isset($item->category->name))
                                                @if($item->category->name==$category->name)
                                                selected
                                                @endif
                                            @endif
                                            value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class='form-group'>
                            <label for='description'>Описание</label>
                            <textarea name='description'
                                      id='description'
                                      rows='3'
                                      class='form-control'
                            >{{ old('description',$item->description) }}</textarea>
                        </div>
                        <div class='form-group w-50'>
                            <label for='category_id'>Город</label>
                            <select name='category_id'
                                    id='category_id'
                                    class='form-control'
                            >
                                <option disabled  selected>Город</option>
                                @foreach($cities as $city)
                                    <option @if($item->city==$city)
                                            selected
                                            @endif
                                            value="{{ $city }}">
                                        {{ $city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class='form-group w-25'>
                            <label for='price'>Цена</label>
                            <input name='price'
                                   value='{{$item->price}}'
                                   id='price'
                                   type='text'
                                   class='form-control'
                            >
                        </div>
                        <div class="form-group">
                            <label for='file'>Фотография</label>
                            <input type='file' id="file" name='file[]' class="form-control-file" onchange="readURL(this)"  multiple="multiple">
                            <small id="file" class="form-text text-muted">Вы можете загрузить фотографию в формате jpeg, jpg, png весом не более 10 Мб</small>
                        </div>
                        <div class="row" id="selected_photos">

                        </div>


                        <button type='submit' class='btn btn-primary float-right'>Добавить</button>
                </div>
        </div>
    </from>
@endsection

