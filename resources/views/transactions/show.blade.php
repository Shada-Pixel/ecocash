<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">{{$category->name}} Category</x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">

        <div class="card">
            <div class="p-6 ">
                <div class="flex justify-between items-center">

                    <h3 class="text-xl font-semibold">Keywords</h3>
                    <a href="{{route('categories.edit',$category->slug)}}">
                        <button type="submit" class="font-mont px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300">Edit</button>
                    </a>
                </div>
                <div class="mt-4 grid grid-cols-1 lg:grid-cols-2 gap-5">
                    <div>
                        <div class="">
                            @foreach (explode(',', $category->keywords) as $keyword)
                            <p class="">#{{ $keyword }}</p>
                                <span class="iconify text-2xl" data-icon="devicon:{{ $keyword }}"></span>
                            @endforeach
                        </div>
                        <h3 class="text-xl font-semibold">Slug</h3>
                        <div class="my-4">
                            <p class="">{{ $category->slug }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <x-slot name="script">
    </x-slot>
</x-app-layout>
