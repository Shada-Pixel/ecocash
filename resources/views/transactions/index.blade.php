<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">All Transactions</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    </x-slot>

    {{-- Page Content --}}
    <div class="gap-6 p-6 ">
        <div class="card flex-grow">
            <div class="p-6">
                <h2 class="text-lg font-medium mb-6">Transaction List</h2>
                <table id="categoryTable" class="display stripe text-xs sm:text-base" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Particular</th>
                            <th>Folio</th>
                            <th>Mode</th>
                            <th>Amount</th>
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
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{!! route('transactions.index') !!}",
                columns: [{
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                            // 2024-06-05T14:33:11.000000Z
                            var date = new Date(data.created_at);
                            var day = String(date.getDate()).padStart(2, '0');
                            var month = months[date.getMonth()];
                            var year = String(date.getFullYear()).slice(-2);

                            // Format the date
                            return  day + '-' + month + '-' + year;
                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            return  data.category.name + '-' + data.particular;
                            // return 'Hello';
                        }
                    },


                    {
                        data: null,
                        render: function (data) {

                            var mode = data.category.folio;
                            return mode;

                         }
                    },
                    {
                        data: null,
                        render: function (data) {

                            var mode = '';
                            if (data.category.mode == 1) {
                                mode = 'Cash';
                            } else {
                                mode = 'Expense';
                            }
                            return mode;

                         }
                    },
                    {
                        data: null,
                        render: function (data) {

                            var amount = data.amount+' ৳';
                            return amount;

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
