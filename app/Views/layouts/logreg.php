<!DOCTYPE html>
<html lang="id">

<head>
    <!-- SEO Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title><?= $this->renderSection('title_login') ?></title>

    <!-- Favicon Configuration -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/favicon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>">
    <link rel="manifest" href="<?= base_url('assets/img/favicon/site.webmanifest') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN + Custom Color Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            700: '#1e293b',
                            800: '#0f172a',
                            900: '#0a0f1d'
                        },
                        brand: {
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        },
                        cream: {
                            50: '#fdfbf7',
                            100: '#f7f4ed',
                            200: '#ede8dd',
                            300: '#e2dacb'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Base CSS (General) -->
</head>

<body class="bg-gradient-to-br from-cream-100 via-cream-50 to-white min-h-screen font-sans text-navy-800 flex flex-col justify-between items-center p-4">
    <!-- Wrapper All -->
    <div class="h-[100dvh] w-full max-w-5xl mx-auto px-4 py-2 flex flex-col justify-between items-center overflow-hidden">

        <!-- Header Section -->
        <div class="w-full shrink-0">
            <?= $this->include('templates/header'); ?>
        </div>

        <!-- Main Content Section -->
        <main class="w-full max-w-4xl flex-1 flex flex-col justify-center items-center my-auto min-h-0 overflow-hidden">
            <?= $this->renderSection('content_login') ?>
        </main>

        <!-- Footer Section -->
        <div class="w-full shrink-0">
            <?= $this->include('templates/footer'); ?>
        </div>

    </div>
</body>

</html>