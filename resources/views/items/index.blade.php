@extends('layouts.main')
@section('title','Projects')
@section('style')
<style>
    i.text-success, i.text-secondary{
        font-size: x-large;
    }
</style>
@section('main-content')
<h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
@if($errors->any())
<div class="row align-items-start m-0">
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show mr-2" role="alert" aria-live="polite" aria-atomic="true"  data-delay="50000">
        {{ $error }}
        <div type="button" class="close" data-dismiss="alert">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-backspace-fill"
                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z" />
            </svg>
        </div>
    </div>
    @endforeach
</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr class="text-dark">
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Name</th>
                    <th class="align-middle" scope="col">Email</th>
                    <th class="align-middle" scope="col" >Telp</th>
                    <th class="align-middle text-center" scope="col">Sosial Media</th>
                    <th class="align-middle text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse ($teams as $team)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $team->name }}</td>
                    <td>{{ $team->email }}</td>
                    <td>{{ $team->email }}</td>
                    <td class="text-center">
                        <a href="{{ $team->twitter ? $team->twitter : '#'}}" class="btn btn-sm btn-transparent p-0">
                            <i class="fas fa-check-circle {{ $team->twitter ? 'text-success' : 'text-secondary' }}"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ $team->instagram ? $team->instagram : '#'}}" class="btn btn-sm btn-transparent p-0">
                            <i class="fas fa-check-circle {{ $team->instagram ? 'text-success' : 'text-secondary' }}"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ $team->linkedin ? $team->linkedin : '#'}}" class="btn btn-sm btn-transparent p-0">
                            <i class="fas fa-check-circle {{ $team->linkedin ? 'text-success' : 'text-secondary' }}"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ $team->facebook ? $team->facebook : '#'}}" class="btn btn-sm btn-transparent p-0">
                            <i class="fas fa-check-circle {{ $team->facebook ? 'text-success' : 'text-secondary' }}"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ $team->github ? $team->github : '#'}}" class="btn btn-sm btn-transparent p-0">
                            <i class="fas fa-check-circle {{ $team->github ? 'text-success' : 'text-secondary' }}"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('teams.edit',$team->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        <form action="{{ route('teams.destroy',$team->id) }}" class="btn btn-sm btn-transparent p-0 m-0" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty --}}
                <tr>
                    <td colspan="10" class="text-center">Data kosong!!</td>
                </tr>
                {{-- @endforelse --}}
            </tbody>
        </table>
        <div class="row mt-2">
            <div class="col align-middle">
                <button type="button" class="btn btn-success btn-circle p-0" data-toggle="modal" data-target="#exampleModal">
                    <i style="font-size: 200%" class="fas fa-plus-circle"></i>
                </button>
            </div>
            <div class="col align-middle">
                <div class="d-flex flex-row-reverse">
                    {{-- {{ $teams->links() }} --}}
                    </div>
            </div>
        </div>
    </div>
</div>
@include('items.modal')
@endsection
@push('script')
<script>
    $('#myModal').modal('show')
</script>
@endpush
