@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class="mb-4">
            <a href="/announcement">объявления</a>/<a href="#">{{$item->category->name}}</a>/
        </div>
            <div class='row justify-container-center'>
                <div class='col-md-8'>
                    <h2>{{$item->title}}</h2>
                    <div>
                        <span class="font-weight-bold">Цена:</span> {{$item->price}} руб
                    </div>
                    <div>
                        <span class="font-weight-bold">{{$item->created_at}} Город: </span>{{$item->city}}
                    </div>
                    <div class="main-image">
                        @if(count($item->photos)==0)
                            <img src="{{ asset('storage/default_images/empty_picture.png') }}">
                        @else

                            <img src="{{ asset("storage/images/") }}/{{$item->photos[0]->file_patch}}">
                        @endif
                    </div>
                    <div>{{$item->description}}</div>
            </div>
            <div class='col-md-4 border'>
                <div class="avatar-image">
                    <img class="border mt-3" src=@if($item->user->avatar==null)"{{ asset('storage/default_images/empty_profile.png') }}"@else "{{ asset("storage/avatars/") }}/{{$item->user->avatar}}" @endif/>
                </div>
                    <div class="mt-2 mb-2">
                    <span class="font-weight-bold">Имя</span>
                    {{$item->user->name}}
                </div>
                <div class="mb-2">
                    <span class="font-weight-bold">На сайте</span>
                    c {{$item->user->created_at}}
                </div>
                <div class="mb-2">
                    <span class="font-weight-bold">Объявлений</span>
                    {{$number}}
                </div>
                <div class="mb-2">
                    <span class="font-weight-bold">Телефон</span>
                    {{$item->user->phone}}
                </div>
                <div class="mb-2">
                    <span class="font-weight-bold">О себе</span>
                    {{$item->user->about}}
                </div>
            </div>
         </div>
    </div>
@endsection

