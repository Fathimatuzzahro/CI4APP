<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Data Komik</h2>

            <form action="/komik/save" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul'); ?>">
                    <div class="invalid-feedback">
                        <?= (session('validation'))?->listErrors(); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                    <div class="invalid-feedback">>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                        <div class="invalid-feedback">>
                        </div>
                        <div class="mb-3">
                            <label for="sampul" class="form-label">Sampul</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="sampul">Pilih gambar</label>
                                <br><br>
                                <input type="file" class="custom-file-input" id="sampul" name="sampul">
                            </div>
                            <div class="invalid-feedback">

                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>