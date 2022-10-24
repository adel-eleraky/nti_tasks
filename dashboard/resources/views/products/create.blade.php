@extends('layouts.parent')

@section('title', 'create Product')

@section('css')
<link rel="stylesheet" href="{{ asset('dist/css/formstyle.css') }}">
@endsection

@section('content')



<div class="col-12">
    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row my-2">
            <div class="col-6">
                <label for="name_en">Name english</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{ old('name_en') }}">
                @error('name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="name_ar">Name arabic</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ old('name_ar') }}">
                @error('name_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="form-row my-2">
            <div class="col-6">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" >
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-6">
                <label for="code">Status</label>
                <select name="status" id="status" class="form-control">
                    <option @selected(old('status') == 1 ) value="1">Active</option>
                    <option @selected( old('status') == 0 ) value="0">Not Active</option>
                </select>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach ($brands as $brand)
                        <option  @selected(old('brand_id') == $brand->id )  value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="form-row my-2">
            <div class="col-6">
                <label for="details_en">Details english</label>
                <textarea name="details_en" id="details_en" class="form-control" cols="30" rows="10" >{{ old('details_en') }}</textarea>
                @error('details_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="details_ar">Details arabic</label>
                <textarea name="details_ar" id="details_ar" class="form-control" cols="30" rows="10">{{ old('details_ar') }}</textarea>
                @error('details_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-4">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-2">
                <button class="btn btn-primary"> Create </button>
            </div>
        </div>
    </form>
</div>

@endsection


