@extends('admin.layout.layout')
@php
    $title='Products';
    $subTitle = 'Products';

   $script = '<script src="' . asset('assets/js/editor.highlighted.min.js') . '"></script>
                 <script src="' . asset('assets/js/editor.quill.js') . '"></script>
                 <script src="' . asset('assets/js/editor.katex.min.js') . '"></script>
                 ';
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
                    <form id="myForms" action="{{route('admin.product.update_product',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-20">
                                    <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Product Name <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" name="name" value="{{ old('name', $product->name ?? '') }}" id="name" placeholder="Enter Product Name">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="mb-20">
                                    <label for="short_desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Short Description <span class="text-danger-600">*</span></label>
                                    <textarea  class="form-control radius-8" name="short_desc"  id="short_desc" > {{ old('short_desc', $product->short_description ?? '') }}</textarea>
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
                                            <div id="editor"></div>
                                            <input type="hidden" name="description" id="prodesc">
                                            <!-- Edit End -->
                                        </div>
                                    </div>
                                </div>
                              

                            <div class="row" style="margin-top:10%;">
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="regular_price" class="form-label fw-semibold text-primary-light text-sm mb-8">Regular Price</label>
                                    <input type="text" class="form-control radius-8" id="regular_price" name="regular_price" value="{{ old('regular_price', $product->regular_price ?? '') }}" placeholder="Enter Regular Price">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="sale_price" class="form-label fw-semibold text-primary-light text-sm mb-8"> Sale Price</label>
                                    <input type="text" class="form-control radius-8" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Sale Price">
                                </div>
                            </div>
                            </div>
                           
                          

                           

                           

                           

                            


                            
                           
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="main_image" class="form-label fw-semibold text-primary-light text-sm mb-8"> Main Image <span class="text-danger-600">*</span></label>
                                    @if($product->images->where('is_primary',1)->first())
                                    @php
                                        $mainImage = $product->images->where('is_primary',1)->first();
                                    @endphp
                                    <div class="mb-3 position-relative d-inline-block">
                                        <img src="{{ asset('storage/'.$mainImage->image) }}" 
                                            width="60" 
                                            class="img-thumbnail">

                                        <a href="{{ route('admin.product.image.delete', $mainImage->id) }}"
                                        onclick="return confirm('Delete this image?')"
                                        class="btn btn-danger btn-sm position-absolute"
                                        style="top: -8px; right: -8px; border-radius: 50%; padding: 0px 5px;">
                                            ×
                                        </a>
                                    </div>
                                    @endif
                                    <input type="file" name="main_image" class="form-control radius-8" id="main_image" placeholder="main_image">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="gallery_images" class="form-label fw-semibold text-primary-light text-sm mb-8"> Gallery Image <span class="text-danger-600">*</span></label>
                                    <div class="row">
                                        @foreach($product->images->where('is_primary',0) as $gallery)
                                        <div class="col-md-2 mb-2 position-relative">
                                            <img src="{{ asset('storage/'.$gallery->image) }}" 
                                                width="60" 
                                                class="img-thumbnail">

                                            <a href="{{ route('admin.product.image.delete',$gallery->id) }}"
                                            onclick="return confirm('Delete this image?')"
                                            class="btn btn-danger btn-sm position-absolute"
                                            style="top: -8px;     right: 10px; border-radius: 50%; padding:0px 5px;">
                                                ×
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <input type="file" name="gallery_images[]" multiple class="form-control radius-8" id="main_image" placeholder="main_image">
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="mb-20">
                                    <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Status <span class="text-danger-600">*</span>
                                    </label>

                                    <select class="form-control radius-8 form-select" name="status" id="status">
                                        <option disabled>Select Status</option>

                                        <option value="1" 
                                            {{ old('status', $product->status) == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="0" 
                                            {{ old('status', $product->status) == 0 ? 'selected' : '' }}>
                                            Deactive
                                        </option>
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

<script>
    function getSubcat(id){

        var cat_id = id;
        $('#sub_category_id').html('<option>Loading...</option>');

            $.ajax({
                url: '{{ url("/admin/subcategories") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowid: id,
                },
                success: function(data){
                   var html = '<option value="">-- Select Subcategory --</option>';
                    data.forEach(function(sub){
                        html += '<option value="'+sub.id+'">'+sub.category+'</option>';
                    });
                    $('#sub_category_id').html(html);
                },
            });
        
    }

    function goforAttributeAndValue(id){

    $('#attributeVal').html('<p>Loading...</p>');

    $.ajax({
        url: '{{ url("/admin/getAttributeVal") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            rowid: id,
        },
        success: function(data){

            let html = '';

            if(data.length > 0){

                data.forEach(function(attr){

                    html += `
                        <div class="card mb-3 p-3 border">
                            <label class="fw-bold mb-2">${attr.name}</label>
                            <div class="d-flex flex-wrap gap-3">
                    `;

                    if(attr.values.length > 0){

                        attr.values.forEach(function(val){

                            html += `
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="attributes[${attr.id}][]"
                                           value="${val.id}"
                                           id="attr_${attr.id}_${val.id}">
                                    <label class="form-check-label"
                                           for="attr_${attr.id}_${val.id}">
                                        ${val.value}
                                    </label>
                                </div>
                            `;
                        });

                    } else {

                        html += `<p>No values found</p>`;
                    }

                    html += `
                            </div>
                        </div>
                    `;
                });

            } else {

                html = '<p>No attributes found</p>';
            }

            $('#attributeVal').html(html);
        }
    });
}
    </script>