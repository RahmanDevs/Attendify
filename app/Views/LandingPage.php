<!-- Skeleton HTML (Home) -->
<?= $this->extend('layouts/main') ?>

<!-- Title Section -->
<?= $this->section('title') ?>
Attendify | Sistem Absensi Face Recognition Modern
<?= $this->endSection() ?>

<!-- Content Section -->
<?= $this->section('content') ?>
    <?= $this->include('components/hero') ?>
    <?= $this->include('components/features') ?>
    <?= $this->include('components/how_it_works') ?>
    <?= $this->include('components/cta') ?>
<?= $this->endSection() ?>