<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Categories</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="gap-6 p-6 ">
        <div class="card mb-6 max-w-4xl">
            <div class="p-6 ">
                <h2 class="text-lg font-medium mb-6">New Category</h2>
                <form action="{{ route('categories.store') }}" method="post">
                    <div class="flex justify-between items-center gap-5">
                        @csrf
                        @method('post')


                        <div>
                            <label for="name" class="block mb-2">Name</label>
                            <input type="text" class="form-input dark:bg-gray-700" id="name" name="name" required>
                        </div> <!-- end -->

                        <div>
                            <label for="mode" class="block mb-2">Category Mode</label>
                            <select class="form-select dark:bg-gray-700" id="mode" name="mode" required>
                                    <option value="1">Cash</option>
                                    <option value="2">Expense</option>
                            </select>
                        </div> <!-- end -->
                        <div>
                            <label for="folio" class="block mb-2">Folio</label>
                            <input type="text" class="form-input dark:bg-gray-700" id="folio" name="folio" >
                        </div> <!-- end -->


                        <div class="lg:col-span-2 self-end">
                            <button type="submit"
                                class="font-mont px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300">Save</button>
                        </div> <!-- end button -->


                    </div>
                </form>
            </div>
        </div>

        <div class="card flex-grow">
            <div class="p-6">
                <h2 class="text-lg font-medium mb-6">Category List</h2>
                <table id="categoryTable" class="display stripe text-xs sm:text-base" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Folio</th>
                            <th>Mode</th>
                            <th class="flex justify-end">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            var datatablelist = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('categories.index') !!}",
                columns: [{
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'folio',
                        name: 'folio'
                    },
                    {
                        data: null,
                        render: function (data) {

                            var mode = '';
                            if (data.mode == 1) {
                                mode = 'Cash';
                            } else {
                                mode = 'Expense';
                            }
                            return mode;

                         }
                    },

                    {
                        data: null,
                        render: function(data) {
                            return `<div class="flex flex-col sm:flex-row gap-5 justify-end items-center">
                                <a href="${BASE_URL}categories/${data.id}" class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-xl" >
                                    <span class="menu-icon"><i class="mdi mdi-eye"></i></span>
                                </a>
                                <a href="${BASE_URL}categories/${data.id}/edit" class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-xl" >
                                    <span class="menu-icon"><i class="mdi mdi-table-edit"></i></span>
                                </a>
                                <button type="button"  class="text-red-500/70 hover:text-red  hover:scale-105 transition duration-150 ease-in-out text-xl" onclick="categoryDelete(${data.id});">
                                    <span class="menu-icon"><i class="mdi mdi-delete"></i></span>
                                    </button>
                                </div>`;
                        }
                    }
                ]
            });


                        // Deleting Permission
            function categoryDelete(catID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this Category ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                    background: 'rgba(255, 255, 255, 0.6)',
                    padding: '20px',
                    confirmButtonColor: '#0db8a6',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL + 'categories/' + catID,
                            success: function(response) {
                                if (response.success) {
                                    // Swal.fire('Success!', response.message, 'success');

                                    $("#ajaxflash div p").text(response.success);
                                    $("#ajaxflash").fadeIn().fadeOut(5000);

                                    datatablelist.draw();
                                } else {
                                    Swal.fire('Not deletable!', 'This category is connected somewhere.', 'error');
                                    datatablelist.draw();
                                }
                            }
                        });
                    }
                });
            }

        </script>
    </x-slot>
</x-app-layout>
