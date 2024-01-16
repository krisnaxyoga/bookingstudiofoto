@extends('layouts.admin')
@section('title', 'package')
@section('content')
<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>package</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('package.create') }}" class="btn btn-primary mb-2">add</a>
                    {{-- <a href="{{ route('excel.package') }}" class="btn btn-success mb-2">Download Excel</a> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th>category name</th> --}}
                                    <th>name</th>
                                    <th>description</th>
                                    <th>price</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    {{-- <td>{{ $item->categorypackage->name }}</td> --}}
                                    <td>{{ $item->name }}</td>
                                    <td class="elipsis">{{ $item->description }}</td>
                                    <td>{{ $item->price }}</td>
                                   
                                    <td><a href="{{ route('package.edit',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></a>

                                        <form class="d-inline" action="{{route('package.destroy', $item->id)}}" method="POST" onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
