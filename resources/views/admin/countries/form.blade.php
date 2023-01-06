@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quản Lý Quốc Gia') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($country))
                            {!! Form::open(['route' => 'countries.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['countries.update', $country->id], 'method' => 'PUT']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên quốc gia', []) !!}
                            {!! Form::text('title', isset($country) ? $country->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập tên quốc gia',
                                'id' => 'title',
                                'onkeyup' => 'ChangeToSlug()'
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($country) ? $country->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập slug',
                                'id' => 'slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($country) ? $country->description : '', [
                                'style' => 'resize:none;',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập mô tả',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($country) ? $country->status : '', ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit(isset($country) ? 'Sửa quốc gia': 'Thêm quốc gia', ['class' => 'btn btn-success mt-2']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên quốc gia</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $key => $country)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $country->title }}</td>
                                <td>{{ $country->slug }}</td>
                                <td>{{ $country->description }}</td>
                                <td>
                                    @if ($country->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['countries.destroy', $country->id],
                                        'onsubmit' => 'return confirm("Bạn chắc chắn muốn xóa?")'
                                        ])
                                    !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-warning">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
