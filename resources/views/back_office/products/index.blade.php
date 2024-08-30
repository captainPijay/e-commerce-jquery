@extends('back_office.layouts.index')
@section('content')
<div class="container-fluid bg-white wrapperDataTableBackOffice">
    <table class="stripe table-back-office" id="serverSide">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA PRODUK</th>
                <th>DESKRIPSI PRODUK</th>
                <th>HARGA PRODUK PER-LEMBAR</th>
                <th>KATEGORI PRODUK</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
    @include('back_office.layouts.modal_hapus')
    @include('back_office.products.modal_tambah')
    @include('back_office.products.modal_edit')
@endsection

@section('custom_js')
<script type="text/javascript">

    $(document).ready(function(){
        loadData();
    })

    function loadData(){
        $('.table-back-office').DataTable({
            processing: true,
            pagination: true,
            responsive: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax:{
                url: "{{ route('products.index') }}"
            },
            columns:[
                {
                    data: 'no',
                    name: 'no',
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true
                },
                {
                    data: 'description',
                    name: 'description',
                    searchable: true
                },
                {
                    data: 'price',
                    name: 'price',
                    searchable: true
                },
                {
                    data: 'category',
                    name: 'category',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: true,
                },
            ],
            language: {
                search: '',
                searchPlaceholder: "Search...",
                lengthMenu: "_MENU_ entries per page",
                paginate: {
                    first: '<div class="icon"><i class="ri-arrow-left-double-line"></i></div>',
                    previous: '<div class="icon"><i class="ri-arrow-left-s-line"></i></div>',
                    next: '<div class="icon"><i class="ri-arrow-right-s-line"></i></div>',
                    last: '<div class="icon"><i class="ri-arrow-right-double-line"></i></div>',
                }
            },
            pagingType: 'full_numbers',
            dom: '<"row"<"col-sm-6 section-table-tl"<"div section-table-length"l><"div section-table-info"Z>><"col-sm-6 section-table-tr"<"div section-table-search"f><"div section-table-button"B>>><"row"<"col-sm-12"tr>><"row"<"col-sm-8 d-flex align-items-center"i><"col-sm-4 d-flex justify-content-end"p>>',
            initComplete: function () {
                var addButton = $(
                    '<button class="btn btn-primary btn-add" data-bs-target="#ModalTambah" data-bs-toggle="modal"><i class="ri-add-line"></i>&nbsp;Tambah Data</button>'
                );

                $('.section-table-button').append(addButton).css("text-align", "end");

                var infoSection = $(
                    '<div class="icon-info"><i class="ri-building-4-line"></i></div><div class="text-info"><span>Total Data Produk</span><h5>0</h5></div>'
                );

                $('.section-table-info').append(infoSection);

                $('.section-table-info h5').text("{{ $getData->count() }}");

            },
        })
    }
    function deleteData(id) {
        $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
        $('#ModalDelete').modal('show');
    }
    function editData({id, name, price, description, category}) {
        $("#formEdit input[name='name']").val(name);
        $("#formEdit input[name='price']").val(price);
        $("#formEdit input[name='description']").val(description);
        $("#formEdit input[name='category']").val(category);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
    }
</script>
@endsection
