@extends('layouts.app')

@section('css')
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .table-action {
            width: 100px;
        }

        .table-id {
            width: 30px;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h2>Посты</h2>
                <table id="posts-table" class="" role="grid" style="width:100%">
                    <thead>
                    <tr>
                        <th>ИД</th>
                        <th>Заголовок</th>
                        <th>Статус</th>
                        <th>Создан</th>
                        <th>Опубликован</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Категории</h2>
                <table id="categories-table" class="" role="grid" style="width:100%">
                    <thead>
                    <tr>
                        <th>ИД</th>
                        <th>Имя</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    <script>

        $(function () {
            let $posts_table = $('#posts-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Новый пост',
                        action: function (e, dt, button, config) {
                            window.location = '{{ route('post.create') }}';
                        }
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('post.datatables') }}',
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        className: 'table-id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'published',
                        name: 'published'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        render: function (data, d2, row) {
                            let returnTxt = '';
                            returnTxt += '<button type="button" class="post-edit" data-id="' + row.id + '">изменить</button>';
                            returnTxt += '<button type="button" class="post-delete" data-id="' + row.id + '">удалить</button>';
                            return returnTxt;
                        },
                        className: 'table-action',
                        orderable: false

                    }
                ]
            });

            $(document).on('click', '.post-edit', function () {
                let $this = $(this);
                let id = $this.data('id');
                window.location.href = "/manage/post/" + id + "/edit";
            });


            $(document).on('click', '.post-delete', function () {
                if (!confirm('Удалить?')) {
                    return false;
                }

                let $this = $(this);
                let id = $this.data('id');
                console.log('delete ' + id);

                $.ajax({
                    type: "POST",
                    url: '{{ route('post.delete')  }}',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    dataType: 'json', //json
                    success: function (responce) {
                        $posts_table.ajax.reload(null, false);
                    },
                    error: function (xhr) {

                    }
                });


            });

            let $categories_table = $('#categories-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Новая категория',
                        action: function (e, dt, button, config) {
                            window.location = '{{ route('category.create') }}';
                        }
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('category.datatables') }}',
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        className: 'table-id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        render: function (data, d2, row) {
                            let returnTxt = '';
                            returnTxt += '<button type="button" class="category-edit" data-id="' + row.id + '">изменить</button>';
                            returnTxt += '<button type="button" class="category-delete" data-id="' + row.id + '">удалить</button>';
                            return returnTxt;
                        },
                        className: 'table-action',
                        orderable: false
                    }
                ]
            });

            $(document).on('click', '.category-edit', function () {
                let $this = $(this);
                let id = $this.data('id');
                window.location.href = "/manage/category/" + id + "/edit";
            });


            $(document).on('click', '.category-delete', function () {
                if (!confirm('Удалить?')) {
                    return false;
                }

                let $this = $(this);
                let id = $this.data('id');
                console.log('delete ' + id);

                $.ajax({
                    type: "POST",
                    url: '{{ route('category.delete')  }}',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    dataType: 'json', //json
                    success: function (responce) {
                        $categories_table.ajax.reload(null, false);
                    },
                    error: function (xhr) {

                    }
                });


            });

        });
    </script>

@stop