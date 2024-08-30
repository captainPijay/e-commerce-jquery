<!-- Modal -->
<div class="modal fade modalForm modalDoubleCol" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="{{ route($storeUrl) }}" class="wrapperForm" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="name">Nama Produk</label>
                                    <input value="{{ old('name') }}" name="name" type="text"
                                    class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nama {{ $formTitle }}" style="width: 100%" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="description">Deskripsi Product</label>
                                    <input value="{{ old('description') }}" name="description" type="text"
                                    class="form-control {{ $errors->has('description') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Deskripsi {{ $formTitle }}" style="width: 100%" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="price">Harga Produk Per-Lembar</label>
                                    <input value="{{ old('price') }}" name="price" type="text"
                                           class="form-control {{ $errors->has('price') ? 'border-danger' : 'border-none' }}"
                                           placeholder="Masukkan Harga {{ $formTitle }}" style="width: 100%" required id="price">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="category">Category</label>
                                    <input value="{{ old('category') }}" name="category" type="text"
                                    class="form-control {{ $errors->has('category') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Kategori {{ $formTitle }}" style="width: 100%" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content: end;">
                        <button class="btn-batal" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn-submit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#price').on('input', function() {
        const value = $(this).val().replace(/\D/g, '');

        const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        $(this).val(formattedValue);
    });

    $('#price').on('keypress', function(event) {
        if (event.which < 48 || event.which > 57) {
            event.preventDefault();
        }
    });
});

</script>
