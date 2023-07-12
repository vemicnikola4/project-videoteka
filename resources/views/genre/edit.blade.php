@extends('layouts.app')
@section('content')

            <div class="card">
                <div class="card-header">{{ __('Genres') .": ". __('Edit')}}</div>
                <div class="card-body">
                    <form method="post" action="{{route('genre.update',['genre'=>$genre->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">{{ __('Name EN')}}</label>
                            <div class="col-sm-10">
                                <input type="text"class="form-control 
                                @error('name_en') is-invalid @enderror" id="name_en" 
                                name="name_en" value= "{{ old('name_en',$genre->name_en) }}">
                                @error('name_en')
                                    <span class="invalid-feedback" role="alert">  
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">{{ __('Name SR')}}</label>
                            <div class="col-sm-10">
                                <input type="text"class="form-control @error('name_sr') is-invalid @enderror" id="name_sr" 
                                name="name_sr" value= "{{ old('name_sr',$genre->name_sr) }}">
                                @error('name_sr')
                                    <span class="invalid-feedback" role="alert">  
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary me-2">{{ __('Save') }}</button>
                            <a  href= "{{route('genre.index')}}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
       
@endsection