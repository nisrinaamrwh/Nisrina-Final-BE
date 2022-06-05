<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel"><i class="uil uil-plus-circle me-1"></i>Tambah barang
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                            placeholder="Nama barang..." name="thumbnail" value="{{ old('thumbnail') }}">
                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Nama barang..." name="title" value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <textarea rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi Barang..."
                            name="description">
                            {{ old('description') }}
                        </textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tahun Rilis</label>
                        <input type="number" class="form-control @error('tahun_rilis') is-invalid @enderror"
                            placeholder="Tahun Rilis..." name="tahun_rilis" value="{{ old('tahun_rilis') }}">
                        @error('tahun_rilis')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="genre" class="form-control @error('category') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
