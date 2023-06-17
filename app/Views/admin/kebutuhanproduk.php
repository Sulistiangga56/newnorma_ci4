<?= $this->include('admin/header') ?>
<div class="container">
    <h1>Kebutuhan Produk</h1>
    <h2><?= $result[0]['nama_produk'] ?></h2>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th>No</th>
                <th>Nama Material</th>
                <th>Kebutuhan Material</th>
                <th>Jumlah</th>
            </tr>
            <?php
            $i = 1;
             foreach($result as $row): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['qty'] ?> <?= $row['satuan'] ?></td>
                <td><?= $row['jumlah'] ?></td>
            </tr>
            <?php 
            $i++;
            endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('admin/footer') ?>