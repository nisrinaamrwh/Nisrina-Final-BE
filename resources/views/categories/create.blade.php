<div class="modal fade" id="createGenreModal" tabindex="-1" aria-labelledby="createGenreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGenreModalLabel"><i class="uil uil-plus-circle me-1"></i>Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeategory') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Type kategori here..." name="title" value="{{ old('title') }}">
                        @error('title')
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
