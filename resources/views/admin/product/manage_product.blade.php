@extends('admin.layout.layout')
@php
    $title='Products';
    $subTitle = 'Products';
    $script = '<script>
                    let table = new DataTable("#dataTable");
               </script>';
@endphp

@section('content')

            <div class="card basic-data-table">
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Datatables</h5>
                    <a href="{{route('admin.add_products')}}" class="btn btn-primary" style="float:right;">Add New</a>
                </div>
                
                <div class="card-body">
                    <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                              
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Sale Price </th>
                                <th scope="col">Regular Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            {{-- Image --}}
                            <td>
                                @if($product->images->count())
                                    <img src="{{ asset('storage/'.$product->images->first()->image) }}" 
                                        width="50" height="50" style="object-fit:cover;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>

                            {{-- Product Name --}}
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">
                                        {{ $product->name }}
                                    </h6>
                                </div>
                            </td>

                          

                          
                            {{-- Sale Price --}}
                            <td>
                                ₹{{ $product->sale_price }}
                            </td>

                            {{-- Regular Price --}}
                            <td>
                                ₹{{ $product->regular_price }}
                            </td>

                          

                            {{-- Status --}}
                            <td>
                                @if($product->status == 1)
                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">
                                        Active
                                    </span>
                                @else
                                    <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            {{-- Action --}}
                            <td>
                                <a href="{{ route('admin.product.product_edit',$product->id) }}"
                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>

                                <a href="{{ route('admin.product.product_delete',$product->id) }}"
                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                onclick="return confirm('Are you sure?')">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
@endsection