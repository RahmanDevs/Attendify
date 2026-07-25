<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Attendify | Sistem Absensi Face Recognition Modern
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?= $this->include('components/hero') ?>
    <?= $this->include('components/features') ?>
    <?= $this->include('components/how_it_works') ?>
    <?= $this->include('components/cta') ?>
<?= $this->endSection() ?>