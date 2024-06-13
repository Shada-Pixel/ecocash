<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Edit {{$category->name}} Category</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        <!-- Gridjs Plugin css -->
        <link href="{{ asset('admindash/asset/libs/gridjs/theme/mermaid.min.css') }}" rel="stylesheet" type="text/css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6 p-6">

        <div class="card max-w-4xl">
            <div class="p-6">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    <div class="flex flex-wrap justify-between items-center gap-5">
                        @csrf
                        @method('PATCH')


                        <div>
                            <label for="name" class="block mb-2">Name</label>
                            <input type="text" class="form-input dark:bg-gray-700" id="name" name="name" required value="{{$category->name}}">
                        </div> <!-- end -->

                        <div>
                            <label for="mode" class="block mb-2">Category Mode</label>
                            <select class="form-select dark:bg-gray-700" id="mode" name="mode" required>
                                    <option value="1" @if ($category->mode == 1) selected @endif>Cash</option>
                                    <option value="2" @if ($category->mode == 2) selected @endif>Expense</option>
                            </select>
                        </div> <!-- end -->
                        <div>
                            <label for="folio" class="block mb-2">Folio</label>
                            <input type="text" class="form-input dark:bg-gray-700" id="folio" name="folio"  value="{{$category->folio ? $category->folio : ''}}">
                        </div> <!-- end -->


                        <div class="lg:col-span-2 self-end">
                            <button type="submit"
                                class="font-mont px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300">Save</button>
                        </div> <!-- end button -->


                    </div>
                </form>
            </div>
        </div>


    </div>


    <x-slot name="script">
        <script>
            //  $("form #name").on('blur', () => {
            //     const slug = slugify($("form #name").val());
            //     $("form #slug").val(slug);
            // });
        </script>
    </x-slot>
</x-app-layout>
