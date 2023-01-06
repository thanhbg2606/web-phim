@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quản Lý Thể Loại') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($genre))
                            {!! Form::open(['route' => 'genres.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['genres.update', $genre->id], 'method' => 'PUT']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên thể loại', []) !!}
                            {!! Form::text('title', isset($genre) ? $genre->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập tên thể loại',
                                'id' => 'title',
                                'onkeyup' => 'ChangeToSlug()'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($genre) ? $genre->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập slug',
                                'id' => 'slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($genre) ? $genre->description : '', [
                                'style' => 'resize:none;',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mô tả',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($genre) ? $genre->status : '', ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit(isset($genre) ? 'Sửa thể loại': 'Thêm thể loại', ['class' => 'btn btn-success mt-2']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên thể loại</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genres as $key => $genre)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $genre->title }}</td>
                                <td>{{ $genre->slug }}</td>
                                <td>{{ $genre->description }}</td>
                                <td>
                                    @if ($genre->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['genres.destroy', $genre->id],
                                        'onsubmit' => 'return confirm("Bạn chắc chắn muốn xóa?")'
                                        ])
                                    !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
