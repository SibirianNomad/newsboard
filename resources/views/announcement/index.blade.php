@extends('layouts.app')

@section('content')
    <div class='container'>
        <h3 class="text-center">Актуальные объявления</h3>

        <div class='row justify-container-center'>
            <div class='form-group'>
                <select name='parent_id'
                        id='parent_id'
                        class='form-control'
                        placeholder='Категория'
                >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @foreach($paginator as $item)
                <div class="col-sm">
                    <img class="mx-auto d-block" width="300" src=@if(count($item->photos)==0)"image/empty_picture.svg"@else{{$item->photos[0]->file_patch}} @endif>
                    <h5>{{$item->title}}</h5>
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

