@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('movies.create') }}" class="btn btn-primary">Thêm phim</a>
                <table class="table" id="table-phim">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Image</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Quốc Gia</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $key => $movie)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->slug }}</td>
                                <td><img width="60%" src="{{ asset('uploads/movies/' . $movie->image) }}"></td>
                                <td>{{ $movie->genre->title }}</td>
                                <td>{{ $movie->category->title }}</td>
                                <td>{{ $movie->country->title }}</td>
                                <td>{{ $movie->description }}</td>
                                <td>
                                    @if ($movie->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['movies.destroy', $movie->id],
                                        'onsubmit' => 'return confirm("Bạn chắc chắn muốn xóa?")',
                                    ]) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
