<x-layout>

<a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                    <div
                        class="flex flex-col items-center justify-center text-center"
                    >
                        <img
                        class="hidden w-48 mr-6 md:block"
                        src="{{$product->logo ? asset('storage/' .$product->logo) : asset('images/no-image.png')}}"
                        alt=""
                        />

                        <h3 class="text-2xl mb-2">{{$product['title']}}</h3>
                        <div class="text-xl font-bold mb-4">{{$product['company']}}</div>
                        <x-product-tags :tags="$product['tags']" />
                        <div class="text-lg my-4">
                            <i class="fa-solid fa-location-dot"></i> {{$product['location']}}
                        </div>
                        <div class="border border-gray-200 w-full mb-6"></div>
                        <div>
                            <h3 class="text-3xl font-bold mb-4">
                                Job Description
                            </h3>
                            <div class="text-lg space-y-6">
                                <p>
                                    {{$product['description']}}
                                </p>
                                <a
                                    href="{{$product['email']}}"
                                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-envelope"></i>
                                    Contact Employer</a
                                >

                                <a
                                    href="{{$product['website']}}"
                                    target="_blank"
                                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-globe"></i> Visit
                                    Website</a
                                >
                               
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="bg-gray-50 border border-gray-200 p-5 rounded mt-4 flex-2 space-x-6">
                    <a href="/products/{{$product['id']}}/edit"><i class="fa-solid fa-pencil"></i> Edit</a>
                </div> --}}
                {{-- <div class="bg-gray-50 border border-gray-200 p-5 rounded mt-4 flex-2 space-x-6">
                <form method="POST" action="/products/{{$product['id']}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
                </div> --}}
            </div>

</x-layout>