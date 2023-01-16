<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<!-- PAGE-HEADER -->
<div class="page-header">
    <div>
        <h1 class="page-title">Produk Hukum</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="<?= site_url(); ?>">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Produk Hukum
            </li>
        </ol>
    </div>
</div>
<div class="card accordion-wizard">
    <div class="card-header">
        <h3 class="card-title">Produk Hukum</h3>
    </div>
    <div class="card-body">
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <label for="tahun">Tahun</label>
                <select class="form-control input-sm" id="tahun" name="tahun">
                    <option selected value="">Semua</option>
                    <?php foreach ($pilihan_tahun as $tahun) : ?>
                        <option value="<?= $tahun ?>"><?= $tahun ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="tahun">Kategori</label>
                <select class="form-control input-sm" id="kategori" name="kategori">
                    <option selected value="">Semua</option>
                    <?php foreach ($pilihan_kategori as $id => $kategori) : ?>
                        <option value="<?= $id ?>"><?= $kategori ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tabeldata">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Produk Hukum</th>
                        <th>Jenis</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var TableData = $('#tabeldata').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= site_url('fweb/peraturan/datatables') ?>",
                data: function(req) {
                    req.tahun    = $('#tahun').val();
                    req.kategori = $('#kategori').val();
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    width: '5%',
                },
                {
                    data: 'nama',
                    name: 'nama',
                    width: '50%',
                },
                {
                    data: 'kategori_dokumen',
                    name: 'kategori_dokumen',
                    width: '10%',
                },
                {
                    data: 'tahun',
                    name: 'tahun',
                    width: '10%',
                },
                {
                    data: function (data) {
                        if (data.url != null) {
                            return `<button onclick="window.location.href='${data.url}'" class="btn btn-primary btn-block" target="_blank" rel="noopener noreferrer">Lihat</button>`;
                        }
                        return '<a href="<?= site_url('dokumen_web/unduh_berkas/') ?>' + data.id + '" class="btn btn-primary btn-block" target="_blank" rel="noopener noreferrer">Unduh</a>';
                    },
                    name: 'aksi',
                    searchable: false,
                    orderable: false,
                    width: '10%',
                },
            ],
            order: [
                [3, 'asc']
            ]
        });

        $('select[name="tahun"]').on('change', function() {
            $(this).val();
            TableData.ajax.reload();
        });

        $('select[name="kategori"]').on('change', function() {
            $(this).val();
            TableData.ajax.reload();
        });
    });
</script>