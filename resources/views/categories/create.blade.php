<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Create Category</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        <!-- Gridjs Plugin css -->
        <link href="{{ asset('admindash/asset/libs/gridjs/theme/mermaid.min.css') }}" rel="stylesheet" type="text/css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">

        <div class="card">
            <div class="p-6">
                <form action="{{ route('categories.store') }}" method="post">
                    <div class="grid lg:grid-cols-2 gap-5">
                        @csrf
                        @method('post')


                        <div>
                            <label for="name" class="block mb-2">Name</label>
                            <input type="text" class="form-input" id="name" name="name" required>
                        </div> <!-- end -->

                        <div>
                            <label for="slug" class="block mb-2">Slug</label>
                            <input type="text" class="form-input" id="slug" name="slug" required=""
                                readonly>
                        </div> <!-- end -->

                        <div>
                            <label for="mode" class="block mb-2">Category Mode</label>
                            <select class="form-select" id="mode" name="mode" required>
                                    <option value="1">Cash</option>
                                    <option value="2">Expense</option>
                            </select>
                        </div> <!-- end -->


                        <div>
                            <label for="keywords" class="block mb-2">Keywords</label>
                            <input type="text" class="form-input" id="keywords" name="keywords" required="">
                        </div> <!-- end -->

                        <div class="lg:col-span-2 mt-3">
                            <button type="submit"
                                class="font-mont mt-8 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300">Save</button>
                        </div> <!-- end button -->


                    </div>
                </form>
            </div>
        </div>


    </div>


    <x-slot name="script">
        <script>
             $("form #name").on('blur', () => {
                const slug = slugify($("form #name").val());
                $("form #slug").val(slug);
            });
        </script>
    </x-slot>
</x-app-layout>
