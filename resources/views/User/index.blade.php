@extends('layouts.app')

@section('content')
        <div class="container">
            @include('includes.result_message')
            <form method='POST' action="{{  route('profile.update',$user->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
            <div class='row justify-container-center'>
                    <div class="col-md-4">
                        <img class="border w-100" src=@if($user->avatar==null)"{{ asset('storage/default_images/empty_profile.png') }}"@else "{{ asset("storage/avatars/") }}/{{$user->avatar}}" @endif/>
                            <input type='file'
                                   id="avatar"
                                   name='avatar'
                                   class="form-control-file"
                                   hidden
                                   onchange="readURLAvatar(this)"
                            >
                            <label for="avatar" class="btn btn-primary w-100">Выбрать фото</label>
                    </div>
                <div class="col-md-6">
                            <div class='form-group'>
                                <label for='name'>Имя</label>
                                <input name='name'
                                       value='{{ $user->name }}'
                                       id='name'
                                       type='text'
                                       class='form-control'
                                       minlength='2'
                                >
                            </div>
                            <div class='form-group'>
                                <label for='city'>Город</label>
                                <select name='city'
                                        id='city'
                                        class='form-control'
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
                                >
                            </div>
                            <div class='form-group'>
                                <label for='about'>О себе</label>
                                <textarea name='about'
                                          id='about'
                                          class='form-control'
                                >{{ old('description',$user->about) }}</textarea>
                            </div>
                            <button type='submit' class='btn btn-primary float-right'>Сохранить</button>
                        </div>
                </div>
            </form>
        </div>
@endsection

