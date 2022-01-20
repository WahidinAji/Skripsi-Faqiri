<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <div class="form-group row">
                        <label for="inputCode" class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="inputCode" value="{{ old('code') }}" name="code">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" value="{{ old('name') }}" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Harga Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="inputPrice" value="{{ old('price') }}" name="price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputType" class="col-sm-2 col-form-label @error('type') is-invalid @enderror">Tipe Barang</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="box" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                  Box
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="unit">
                                <label class="form-check-label" for="exampleRadios2">
                                  Satuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputInformation" class="col-sm-2 col-form-label">Stok Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('stock') is-invalid @enderror" id="inputInformation" value="{{ old('stock') }}" name="stock">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputCategory" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                <option value="Rokok" {{ old('category') == 'Rokok' ? "selected" : null }}>Rokok</option>
                                <option value="Sabun" {{ old('category') == 'Sabun' ? "selected" : null }}>Sabun</option>
                                <option value="Makanan" {{ old('category') == 'Makanan' ? "selected" : null }}>Makanan</option>
                                <option value="Minuman" {{ old('category') == 'Minuman' ? "selected" : null }}>Minuman</option>
                                <option value="Snack" {{ old('category') == 'Snack' ? "selected" : null }}>Snack</option>
                                <option value="Obat" {{ old('category') == 'Obat' ? "selected" : null }}>Obat</option>
                                <option value="Sembako" {{ old('category') == 'Sembako' ? "selected" : null }}>Sembako</option>
                                <option value="Alat Tulis Kerja" {{ old('category') == 'Alat Tulis Kerja' ? "selected" : null }}>Alat Tulis Kerja</option>
                                <option value="Lain - lain" {{ old('category') == 'Lain - lain' ? "selected" : null }}>Lain - lain</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
