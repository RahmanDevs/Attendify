<!-- Skeleton HTML (Login and Registration) -->
<?= $this->extend('layouts/logreg') ?>

<?= $this->section('title_login') ?>
Attendify | Login & Register
<?= $this->endSection() ?>

<!-- Main Section (Content)  -->
<?= $this->section('content_login') ?>
    <!-- Form Component -->
    <?= $this->include('components/form'); ?>
<?= $this->endSection() ?>