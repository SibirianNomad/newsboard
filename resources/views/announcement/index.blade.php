@extends('layouts.app')

@section('content')
    <div class='container'>
        <h3 class="text-center">Актуальные объявления</h3>
        <div class='d-flex bd-highlight'>
            <div class="flex-fill bd-highlight mb-4">
                <form method="GET"
                      action="{{ route('announcement.index') }}"
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
            <div class="flex-fill bd-highlight">
                <form method="GET"
                      action="{{ route('announcement.index') }}"
                >
                    <select name='city'
                            id='city'
                            class='form-control'
                            onchange="this.form.submit()"
                    >
                        <option value="все">Город</option>
                        @foreach($cities as $city)
                            <option @if(session()->get('city')==$city) selected @endif value="{{ $city }}">
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <form method="GET"
                  action="{{ route('announcement.index') }}"
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
                <div class="col-sm">
                    <a href="{{ route('announcement.show',$item->id) }}">
                        <img class="mx-auto d-block" width="300" src=@if(count($item->photos)==0)"{{ asset('storage/default_images/empty_picture.png') }}"@else"storage/images/{{$item->photos[0]->file_patch}}" @endif>
                        <h5>{{$item->title}}</h5>
                    </a>
                    <div>Цена: {{$item->price}} руб</div>
                    <div>{{$item->created_at}}</div>

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
@endsection

