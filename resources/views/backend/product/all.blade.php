@extends('backend.layouts.app')

@section('title')
    All product table
@endsection
{{-- 
@push('js')
    <script>
         $.ajax({ 
           type: "POST", 
           url: "{{ url('product/delete/{id}') }}",               
           data:{id:id}
           success: function(result) {
            console.log(result);
           }
       });
    </script>
@endpush --}}

@section('content')
    <!--body wrapper start-->
    <div class="wrapper">
                       
             <!--Start row-->
             <div class="row">
                 <div class="col-md-12">
                     <div class="white-box">
                         <h2 class="header-title">All Product</h2>
                          <div class="table-responsive">
                           <table id="example" class="display table">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Name</th>
                                          <th>Category Name</th>
                                          <th>SKU</th>
                                          <th>size</th>
                                          <th>brand</th>
                                          <th>image</th>
                                          <th>quantity</th>
                                          <th>price</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>Id</th>
                                          <th>Name</th>
                                          <th>Category Name</th>
                                          <th>SKU</th>
                                          <th>size</th>
                                          <th>brand</th>
                                          <th>image</th>
                                          <th>quantity</th>
                                          <th>price</th>
                                          <th></th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                     @foreach ($products as $product)
                                         <tr>
                                             <td>{{ $product->id }}</td>
                                             <td>{{ $product->name }}</td>
                                             <td>{{ $product->name_category }}</td>
                                             <td>{{ $product->SKU }}</td>
                                             <td>{{ $product->size }}</td>
                                             <td>{{ $product->brand }}</td>
                                             <td><img style="width: 40px; height: 40px" src="{{ asset('storage/backend/product/'.$product->img) }}" ></td>
                                             <td>{{ $product->quantity }}</td>
                                             <td>{{ $product->price }}</td>
                                             <td>
                                                <a href='{{ url("admin/product/$product->id/edit") }}' class="btn btn-success">Edit</a>
                                                <a class="btn btn-danger" data-id="{{ $product->id }}" name="delete" href="javascript:void(0)" onclick="document.getElementById('product-{{ $product->id }}').submit()">Delete</a>
                                                <form action="product/delete/{{ $product->id }}" method="post" id="product-{{ $product->id }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                         </tr>
                                     @endforeach

                                     {{ $products->links('vendor.pagination.bootstrap-4') }}
                                  </tbody>
                            </table>  
                          </div>
                     </div>
                 </div>
             </div>
             <!--End row-->
      </div>
      <!-- End Wrapper-->
    <!--End main content -->
@endsection


