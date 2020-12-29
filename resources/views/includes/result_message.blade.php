@if($errors->any())
    <div class='row justify-container-center'>
        <div class='col-md-11'>
            <div class='alert alert-danger' role='alert'>
                <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                    <span aria-hidden='true'>X</span>
                </button>
               <ul>
                   @foreach($errors->all() as $errorText)
                       <li>{{$errorText}}</li>
                   @endforeach
               </ul>
            </div>
        </div>
    </div>
@endif
@if(session('success'))
    <div class='row justify-container-center'>
        <div class='col-md-11'>
            <div class='alert alert-success' role='alert'>
                <button type='button' class='close' data-dismiss='alert' arial-label='Close'>
                    <span aria-hidden='true'>X</span>
                </button>
                {{session()->get('success')}}
            </div>
        </div>
    </div>
@endif
