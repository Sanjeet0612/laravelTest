@extends('admin.layout.layout')
@php
    $title='Products';
    $subTitle = 'Products';

    $script = '<script src="' . asset('assets/js/editor.highlighted.min.js') . '"></script>
                 <script src="' . asset('assets/js/editor.quill.js') . '"></script>
                 <script src="' . asset('assets/js/editor.katex.min.js') . '"></script>';

@endphp

@section('content')

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize Quill
    const quill = new Quill("#editor", {
        modules: {
            syntax: true,
            toolbar: "#toolbar-container",
        },
        placeholder: "Compose an epic...",
        theme: "snow",
    });
    // Edit page ke liye description load karna ho to
    let oldContent = `{!! old('description', $product->description ?? '') !!}`;
    if(oldContent){
        quill.root.innerHTML = oldContent;
    }
    // Form submit pe hidden input me value set karo
    document.getElementById("myForms").addEventListener("submit", function () {
        document.getElementById("prodesc").value = quill.root.innerHTML;
    });
});
</script>


<div class="card h-100 p-0 radius-12 overflow-hidden">

<div class="message">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>


                <div class="card-body p-40">
                    <form id="myForms" action="{{route('admin.add_products')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-20">
                                    <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Product Name <span class="text-danger-600">*</span></label>
                                    <input required type="text" class="form-control radius-8" name="name" value="{{old('name')}}" id="name" placeholder="Enter Product Name">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="mb-20">
                                    <label for="short_desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Short Description <span class="text-danger-600">*</span></label>
                                    <textarea   class="form-control radius-8" name="short_desc"  id="short_desc" > {{old('short_desc')}}</textarea>
                                </div>
                            </div>


                            <div>
                                <label class="form-label fw-bold text-neutral-900">Post Description </label>
                                <div class="border border-neutral-200 radius-8 overflow-hidden">
                                    <div class="height-200">
                                        <!-- Editor Toolbar Start -->
                                        <div id="toolbar-container">
                                            <span class="ql-formats">
                                                <select class="ql-font"></select>
                                                <select class="ql-size"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-strike"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <select class="ql-color"></select>
                                                <select class="ql-background"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-script" value="sub"></button>
                                                <button class="ql-script" value="super"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-header" value="1"></button>
                                                <button class="ql-header" value="2"></button>
                                                <button class="ql-blockquote"></button>
                                                <button class="ql-code-block"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-list" value="ordered"></button>
                                                <button class="ql-list" value="bullet"></button>
                                                <button class="ql-indent" value="-1"></button>
                                                <button class="ql-indent" value="+1"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-direction" value="rtl"></button>
                                                <select class="ql-align"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-link"></button>
                                                <button class="ql-image"></button>
                                                <button class="ql-video"></button>
                                                <button class="ql-formula"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-clean"></button>
                                            </span>
                                        </div>
                                        <!-- Editor Toolbar Start -->

                                        <!-- Editor start -->
                                        <div id="editor">{{old('description')}}
                                        </div>
                                        
                                        <input type="hidden" name="description" id="prodesc">
                                        <!-- Edit End -->
                                    </div>
                                </div>
                            </div>
                              

                            <div class="row" style="margin-top:10%;">
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="regular_price" class="form-label fw-semibold text-primary-light text-sm mb-8">Regular Price</label>
                                    <input type="text" required class="form-control radius-8" id="regular_price" name="regular_price" value="{{old('regular_price')}}" placeholder="Enter Regular Price">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="sale_price" class="form-label fw-semibold text-primary-light text-sm mb-8"> Sale Price</label>
                                    <input type="text" required class="form-control radius-8" id="sale_price" name="sale_price" value="{{old('sale_price')}}" placeholder="Sale Price">
                                </div>
                            </div>
                            </div>
                           
                           
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="main_image" class="form-label fw-semibold text-primary-light text-sm mb-8"> Main Image <span class="text-danger-600">*</span></label>
                                    <input type="file" name="main_image" class="form-control radius-8" id="main_image" placeholder="main_image">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="main_image" class="form-label fw-semibold text-primary-light text-sm mb-8"> Gallery Image <span class="text-danger-600">*</span></label>
                                    <input type="file" name="gallery_images[]" multiple class="form-control radius-8" id="main_image" placeholder="main_image">
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                                    <select class="form-control radius-8 form-select" name="status" id="status">
                                        <option selected disabled>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>


                            <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                                <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                                    Save Change
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@endsection

