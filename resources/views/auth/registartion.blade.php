@extends('welcome')
@section('title','Registration Page')
@section('content')

<body>

    <div class="container" style="margin-bottom: 4rem;">
    <div id="alertContainer" class="col-md-12"></div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="img">
                    <img src=" {{ URL('assets/sign.jpg') }}" alt="Logo"/>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="container py-4">
                    <form method="POST" enctype="multipart/form-data" id="registrationForm" action="{{ route('register_user') }}">

                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-3 mb-3 col-sm-3">
                                <div class="text-center">
                                    <div>
                                        <label for="imageInput" style="cursor: pointer;">
                                            <div class="rounded-circle border d-flex justify-content-center align-items-center" id="imageContainer" style="width: 100px; height: 100px; overflow: hidden; border-color: #753873;">
                                                <img id="uploadedImage" src="{{ URL('assets/upload.png') }}" alt="Upload"/>
                                            </div>
                                            <input type="file" id="imageInput" name="image" class="form-control" style="display: none;" onchange="handleImageUpload(event)" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('messages.full_name')}}" style="text-align: @if(App::getLocale() == 'ar') right @endif"/>
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="{{__('messages.user_name')}}" style="text-align: @if(App::getLocale() == 'ar') right @endif"/>
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{__('messages.email')}} " style="text-align: @if(App::getLocale() == 'ar') right @endif"/>
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="{{__('messages.phone_number')}}" style="text-align: @if(App::getLocale() == 'ar') right @endif"/>
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" class="form-control" id="address" name="address" placeholder="{{__('messages.address')}}" style="text-align: @if(App::getLocale() == 'ar') right @endif"/>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{__('messages.password')}}" style="text-align: @if(App::getLocale() == 'ar') right @endif"/>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="{{__('messages.confirm_password')}}" style="text-align: @if(App::getLocale() == 'ar') right  @endif"/>
                            </div>

                            <div class="form-group mb-3" id="datepicker">
                                <input type="date" class="form-control" id="Birth" name="Birth" style="text-align: @if(App::getLocale() == 'ar') right @endif"/>
                            </div>

                            <div class="form-group mb-3 row align-items-center justify-content-center">
                                <button  type="button" class="btn text-white col-md-5 mb-2 mb-md-0" style="background-color: #753873;" data-bs-toggle="modal" data-bs-target="#actorsModal" id="dob-btn">
                                    <span id="dobButton">{{__('messages.actors_with_same_dob')}}</span>
                                    <span id="spinner" class="spinner-border spinner-border-sm" aria-hidden="true" style="display: none"></span>
                                    <span id="loading" role="status" style="display: none">{{__('messages.loading')}}</span>
                                </button>
                                <div class="col-md-1"></div>
                                <button type="submit" class="btn text-white col-md-5" style="background-color: #753873;" id="submit-btn">{{__('messages.sign_up')}}</button>
                            </div>
                        </div>
                    </form>


                    <div class="modal" id="actorsModal" data-route-url="{{ route('actors.born_today') }}" tabindex="-1" aria-labelledby="actorsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="actorsModalLabel">{{__('messages.actors_with_same_dob')}}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group" id="actorsList"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="loading"></div>
                <script src="{{ URL('BootstrapCss/bootstrap.min.js') }}"></script>
                <script src="{{ URL('js/form.js') }}"></script>

            </div>
        </div>
    </div>


</body>
</html>
@endsection

