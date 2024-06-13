<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Dashboard</x-slot>

    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Today --}}
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex gap-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 text-gray-900 dark:text-gray-100 w-full">
                <div class="p-6 ">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-medium">Today</h2>
                        <div class="flex p-4 sm:rounded-lg bg-gray-200 dark:bg-gray-700 gap-4 text-lg">

                            <p>Handcash: {{$todayHandCash}} ৳</p>
                            <p>Cash recived: {{$todayCashTotal-$todayHandCash}} ৳</p>
                            <p>Expenses: {{$todayExpenseTotal}} ৳</p>
                            <p>Remains: {{$todayCashTotal-$todayExpenseTotal}} ৳</p>
                        </div>
                    </div>


                    {{-- Ref Images --}}
                    <div class="hidden gap-4">
                        <div class="">

                            <img src="{{asset('ref/1.jpg')}}" alt="" srcset="">
                        </div>
                        <div class="">

                            <img src="{{asset('ref/2.jpg')}}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex gap-4">
            {{-- Cash --}}
            <div class="basis-1/2">
                {{-- Cash entry --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 text-gray-900 dark:text-gray-100">
                    <div class="p-6 ">
                        <h2 class="text-lg font-medium">Cash Entry</h2>
                        <form action="{{route('transactions.store')}}" method="post">
                            <div class="flex gap-4">
                                @csrf
                                @method('post')

                                <div class="basis-4/12">
                                    <label for="particular" class="block mb-2">Particulars</label>
                                    <input type="text" class="form-input dark:bg-gray-700" id="particular" name="particular" required>
                                </div> <!-- end -->
                                <div class="basis-4/12">
                                    <label for="category_id" class="block mb-2">Cash Category</label>
                                    <select class="form-select dark:bg-gray-700" id="category_id" name="category_id" required>

                                            <option value="">Please select one</option>
                                            @foreach ($cashCat as $cc)
                                            <option value="{{$cc->id}}">{{$cc->name}}</option>
                                            @endforeach
                                    </select>
                                </div> <!-- end -->
                                {{-- <div class="basis-2/12">
                                    <label for="folio" class="block mb-2">Folio</label>
                                    <input type="number" class="form-input dark:bg-gray-700" id="folio" name="folio" readonly>
                                </div> <!-- end --> --}}
                                <div class="basis-3/12">
                                    <label for="type" class="block mb-2">Type</label>
                                    <select name="type" class="form-select dark:bg-gray-700" id="type" required>
                                        <option value="1" selected>Sales</option>
                                        <option value="2">Loan</option>
                                        <option value="3">Other</option>
                                        <option value="4">Handcash</option>
                                    </select>
                                </div>
                                <div class="basis-3/12">
                                    <label for="amount" class="block mb-2">Amount</label>
                                    <input type="number" class="form-input dark:bg-gray-700" id="amount" name="amount" required="">
                                </div> <!-- end -->
                            </div>
                            <div class="lg:col-span-2">
                                <button type="submit" class="font-mont mt-4 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300">Save</button>
                            </div> <!-- end button -->

                        </form>
                    </div>
                </div>

                {{-- Cash table --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100 compact">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-medium">Cash List</h2>
                        <table id="cashTransactionTable" class="display stripe text-xs sm:text-base" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Particular</th>
                                    <th>Folio</th>
                                    <th>Mode</th>
                                    <th class="flex justify-end">Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>


            {{-- Expense --}}
            <div class="basis-1/2">
                {{-- Expense entry --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 text-gray-900 dark:text-gray-100">
                    <div class="p-6">
                        <h2 class="text-lg font-medium">Expense Entry</h2>
                        <form action="{{route('transactions.store')}}" method="post">
                            <div class="flex gap-4">
                                @csrf
                                @method('post')

                                <div class="basis-4/12">
                                    <label for="particular" class="block mb-2">Particulars</label>
                                    <input type="text" class="form-input dark:bg-gray-700" id="particular" name="particular" required>
                                </div> <!-- end -->
                                <div class="basis-4/12">
                                    <label for="category_id" class="block mb-2">Cash Category</label>
                                    <select class="form-select dark:bg-gray-700" id="category_id" name="category_id" required>

                                            <option value="">Please select one</option>
                                            @foreach ($expCat as $cc)
                                            <option value="{{$cc->id}}">{{$cc->name}}</option>
                                            @endforeach
                                    </select>
                                </div> <!-- end -->
                                <div class="basis-3/12">
                                    <label for="type" class="block mb-2">Type</label>
                                    <select name="type" class="form-select dark:bg-gray-700" id="type" required>
                                        <option value="1" selected>Sales</option>
                                        <option value="2">Loan</option>
                                        <option value="3">Other</option>
                                        <option value="4">Handcash</option>
                                    </select>
                                </div>
                                <div class="basis-2/12">
                                    <label for="amount" class="block mb-2">Amount</label>
                                    <input type="number" class="form-input dark:bg-gray-700" id="amount" name="amount" required="">
                                </div> <!-- end -->
                            </div>
                            <div class="lg:col-span-2">
                                <button type="submit" class="font-mont mt-4 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300">Save</button>
                            </div> <!-- end button -->

                        </form>
                    </div>
                </div>

                {{-- Expense table --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-medium">Expense List</h2>
                        <table id="expenseTransactionTable" class="display stripe text-xs sm:text-base compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Particular</th>
                                    <th>Folio</th>
                                    <th>Mode</th>
                                    <th class="flex justify-end text-right">Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>

            $(document).ready(function () {

                var cashlist = $('#cashTransactionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    paging:   false,
                    ordering: false,
                    info:     false,
                    searching:false,
                    ajax: "{!! route('transactions.cash') !!}",
                    columns: [{
                            "render": function(data, type, full, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: null,
                            render: function (data) {
                                return  data.category.name + '-' + data.particular;
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
                        }
                    ],
                    columnDefs: [
                        {
                            targets: -1,
                            className: 'text-right'
                        }
                    ]
                });

                var expenselist = $('#expenseTransactionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    paging:   false,
                    ordering: false,
                    info:     false,
                    searching:false,
                    ajax: "{!! route('transactions.expense') !!}",
                    columns: [{
                            "render": function(data, type, full, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: null,
                            render: function (data) {
                                return  data.category.name + '-' + data.particular;
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
                        }

                    ],
                    columnDefs: [
                        {
                            targets: -1,
                            className: 'text-right',

                        }
                    ]
                });
            });


        </script>
    </x-slot>
</x-app-layout>
