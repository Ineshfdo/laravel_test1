<x-layout>

@include('components.hero')
@include('components.search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">



@unless (count($products) == 0)
    

@foreach ($products as $product)
  <x-product-card :product="$product" />
@endforeach
  

@else
  <p>No Products Found</p>
@endunless

</div>

{{-- Pagination  --}}
<div class="mt-6 p-4">
  {{$products->links()}}

</div>
</x-layout>