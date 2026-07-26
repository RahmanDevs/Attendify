<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>

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

    <!-- Tailwind CSS CDN -->
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
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155'
                        },
                        brand: {
                            700: '#1d4ed8',
                            600: '#2563eb',
                            500: '#3b82f6',
                            400: '#60a5fa',
                            100: '#dbeafe',
                            50: '#eff6ff'
                        },
                        cream: {
                            300: '#ede6d8',
                            200: '#f7f3eb',
                            100: '#fdfbf7',
                            50: '#fffefc'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Style CSS Custom -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="bg-cream-100 text-navy-900 font-sans antialiased selection:bg-brand-600 selection:text-white overflow-x-hidden">

    <!-- Navbar Section -->
    <?= $this->include('components/navbar') ?>

    <!-- Content Section -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer Section -->
    <?= $this->include('components/footer') ?>

    <!-- GSAP & ScrollTrigger CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <!-- Custom Script GSAP -->
    <script src="<?= base_url('assets/js/gsap.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <?= $this->renderSection('extra-scripts') ?>
</body>

</html>