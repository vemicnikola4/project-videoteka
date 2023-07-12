@extends('layouts.app')
@section('content')

            <div class="card">
                <div class="card-header">{{ __('Members') .": ". __('Edit')}}</div>
                <div class="card-body">
                    <form method="post" action="{{route('people.update',['people'=>$people->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">{{ __('Name')}}</label>
                            <div class="col-sm-10">
                                <input type="text"class="form-control 
                                @error('name') is-invalid @enderror" id="name" 
                                name="name" value= "{{ old('name',$people->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">  
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">{{ __('Surname')}}</label>
                            <div class="col-sm-10">
                                <input type="text"class="form-control @error('surname') is-invalid @enderror" id="surname" 
                                name="surname" value= "{{ old('surname',$people->surname) }}">
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">  
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">{{ __('Birth date')}}</label>
                            <div class="col-sm-10">
                                <input type="date"class="form-control @error('b_date') is-invalid @enderror" id="b_date" 
                                name="b_date" value= "{{ old('b_date') }}">
                                @error('b_date')
                                    <span class="invalid-feedback" role="alert">  
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary me-2">{{ __('Save') }}</button>
                            <a  href= "{{route('people.index')}}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
       
@endsection