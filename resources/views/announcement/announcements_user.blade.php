@extends('layouts.app')

@section('content')
    <div class='container'>
        @include('includes.result_message')
        <h3 class="text-center">Мои объявления</h3>
        <div class='d-flex bd-highlight'>
            <div class="flex-fill bd-highlight mb-4">
                <form method="GET"
                      action="/announcements/{{ Auth::user()->id }}"
                >
                    <select name='category_id'
                            id='category_id'
                            class='form-control'
                            onchange="this.form.submit()"
                    >
                        <option value="all"  selected>Категория</option>
                        @foreach($categories as $category)
                            <option @if(session()->get('category_id')==$category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="flex-fill bd-highlight pl-3">
                <form method="GET"
                      action="/announcements/{{ Auth::user()->id }}"
                >
                    <select name='status'
                            id='status'
                            class='form-control'
                            onchange="this.form.submit()"
                    >
                        <option value=""  selected>Статус</option>
                        <option value="1" @if($status==1) selected @endif>Активное</option>
                        <option value="2" @if($status==2) selected @endif>Закрытое</option>
                    </select>
                </form>
            </div>
            <form method="GET"
                  action="/announcements/{{ Auth::user()->id }}"
                  class="flex-fill bd-highlight">
                @csrf
                <div class="col">
                    <input type="text"
                           class="form-control"
                           placeholder="Искать"
                           id="searchText"
                           name="searchText"
                    />
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="submit">
                        Поиск
                    </button>
                </div>
            </form>
        </div>
        <div class='row justify-container-center mt-2'>
            @foreach($paginator as $item)
                <div class="col-md-8">
                    <div class="row">
                        <a href="{{ route('announcement.show',$item->id) }}">
                            <h5>{{$item->title}}</h5>
                        </a>
                        @if($item->status)
                            <a href="{{ route('announcement.edit',$item->id) }}">
                                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-pencil-square  ml-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            <form method='POST' action="{{ route('announcement.destroy', $item->id ) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary ml-4" href="{{ route('announcement.destroy',$item->id) }}">
                                    Закрыть
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="row mt-2">
                    <div class="font-weight-bold">{{$item->created_at}}</div>
                        <div class="font-weight-bold ml-4 mr-2">Категория: </div> {{$item->category->name}}
                        <div class="font-weight-bold ml-4 mr-2">Город: </div> {{$item->city}}
                    </div>
                    <div>{{$item->description}}</div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="font-weight-bold mr-2">Статус:</div>
                        @if($item->status)
                            Активное
                        @else
                            Закрытое
                        @endif
                    </div>
                    <div class="row">
                        <div class="font-weight-bold mr-2">Цена:</div>
                        {{$item->price}} руб
                    </div>
                        <img
                            @if(count($item->photos)==0)
                                src="{{ asset('storage/default_images/empty_picture.png') }}"
                            @else
                                src="{{ asset("storage/images/") }}/{{$item->photos[0]->file_patch}}"
                                onclick="showPhoto(this)"
                                data-toggle="modal"
                                data-target="#popupImage"
                            @endif
                        >
                </div>
            @endforeach
        </div>
    </div>
    @if($paginator->total() > $paginator->count())
        <div class='row justify-container-center mt-4'>
            <div class='col-md-12'>
                <div class='card'>
                    {{ $paginator->links() }}
                </div>
            </div>
        </div>
    @endif

    @include('includes.popup_image')
@endsection

