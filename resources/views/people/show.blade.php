@extends('layouts.app')
@section('content')


            
            <div class="card">
                <div class="card-header">
                    {{ __('Member') }}
                    
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Surname') }}</th>
                        <th scope="col">{{ __('Birdth date') }}</th>
                        <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <tr>
                            <td>{{ $people->name }}</td>
                            <td>{{ $people->surname }}</td>
                            <td>{{ $people->b_date }}</td>
                            <td>
                                <form method="POST" action="{{ route('people.destroy', [$people->id]) }}">
                                    @method('delete') 
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a  href= "{{ route('people.edit',[$people->id]) }}" class="btn btn-success btn-sm me-2">{{ __('Edit') }}</a>
                                        <button type="sumbit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                    </div>
                                </form>
                           
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
 
@endsection