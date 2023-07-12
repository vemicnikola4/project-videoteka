@extends('layouts.app')
@section('content')

            <div class="btn-group mb-2" role="group" aria-label="Basic example">
                <a  href= "{{route('people.create')}}" class="btn btn-primary">{{ __('Add') }}</a>
            </div>
            <div class="card">
                <div class="card-header">
                    {{ __('Members') }}
                    
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
                    @foreach ($data as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->surname }}</td>
                            <td>{{ $p->b_date }}</td>
                            <td>
                            
                            

                                <form method="POST" action="{{ route('people.destroy', ['people'=>$p->id]) }}">
                                    @method('delete') 
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a  href= "{{ route('people.edit',['people'=>$p->id]) }}" class="btn btn-success btn-sm me-2">{{ __('Edit') }}</a>
                                        <a  href= "{{ route('people.show',['people'=>$p->id]) }}" class="btn btn-primary btn-sm me-2">{{ __('Detailes') }}</a>
                                        <button type="sumbit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                    </div>
                                </form>
                           
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
                </div>
            </div>
 
@endsection