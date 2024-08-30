@extends('back_office.layouts.index')
@include('back_office.layouts.modal_hapus')
@section('content')
<div class="container-fluid bg-white wrapperDataTableBackOffice">
    <table class="stripe table-back-office" id="serverSide">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA PEMESAN</th>
                <th>TANGGAL PESANAN</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<style>
    .dt-orderable-none:nth-child(3){
        text-align: center !important;
    }

</style>
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
                url: "{{ route('orderItem.index') }}"
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
                    data: 'created_at',
                    name: 'created_at',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-center'
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

                var infoSection = $(
                    '<div class="icon-info"><i class="ri-building-4-line"></i></div><div class="text-info"><span>Total Data Pesanan</span><h5>0</h5></div>'
                );

                $('.section-table-info').append(infoSection);

                $('.section-table-info h5').text("{{ $getData->count() }}");

            },
        })
    }
    function redirectDetail(id) {
        window.location.href = '{{ route("orderItem.show", "") }}' + '/' + id;
    }
    function deleteData(id) {
        $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
        $('#ModalDelete').modal('show');
    }
</script>
@endsection
