@extends('layouts.app')

@section('content')
        <div class="container">
            @include('includes.result_message')
            <div class='row justify-container-center'>
                    <div class="col-md-4">

                        <img class="border w-100" src=@if($user->avatar==null)"{{ asset('storage/default_images/empty_profile.png') }}"@else "storage/avatars/{{$user->avatar}}" @endif/>

                        <form onchange="uploadPhoto()" class="mt-2" id="uploadPhoto" method="POST" action="{{  action('User\UserController@update_avatar') }}" enctype="multipart/form-data">
                            @csrf
                            <input type='file' id="avatar" name='avatar' class="form-control-file" hidden>
                            <label for="avatar" class="btn btn-primary w-100">Выбрать фото</label>
{{--                            <small id="avatar" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>--}}
{{--                            <button type="submit" class="btn btn-primary w-100">Добавить</button>--}}
                        </form>
                            @if($user->avatar)
                            <form  class="mt-2" id="deletePhoto" method="POST" action="{{ route('profile.destroy', $user->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Удалить  аватар</button>
                            </form>
                            @endif


                    </div>
                <div class="col-md-6">
                    <form method='POST' action="{{  route('profile.update',$user->id) }}">
                        @method('PATCH')
                        @csrf
                            <div class='form-group'>
                                <label for='name'>Имя</label>
                                <input name='name' value='{{ $user->name }}'
                                       id='name'
                                       type='text'
                                       class='form-control'
                                       minlength='2'
                                       required
                                >
                            </div>
                            <div class='form-group'>
                                <label for='city'>Город</label>
                                <select name='city'
                                        id='city'
                                        class='form-control'
                                        required
                                >
                                    <option value="" disabled  selected>Выберите город</option>
                                    @foreach($cities as $city)
                                        <option @if($user->city==$city) selected @endif value="{{ $city }}">
                                            {{ $city}}
                                        </option>
                                    @endforeach
                            </div>
                            <div class='form-group'>
                                <label for='phone'>Телефон</label>
                                <input name='phone'
                                       value='{{ $user->phone }}'
                                       id='phone'
                                       type='text'
                                       class='form-control'
                                       minlength='2'
                                       required
                                >
                            </div>
                            <div class='form-group'>
                                <label for='about'>О себе</label>
                                <textarea name='about'
                                          id='about'
                                          class='form-control'
                                          required
                                >{{ old('description',$user->about) }}</textarea>
                            </div>
                            <button type='submit' class='btn btn-primary float-right'>Сохранить</button>
                        </div>
                </div>
            </form>
        </div>
@endsection

