<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI/CD con Laravel y GitHub Actions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #000000, #7f1d1d);
        }

        .card-3d {
            transform-style: preserve-3d;
            transition: all 0.3s ease;
            perspective: 1000px;
        }

        .card-3d:hover {
            transform: translateZ(20px) rotateX(5deg) rotateY(5deg);
            box-shadow: -10px -10px 30px rgba(139, 0, 0, 0.2),
            10px 10px 30px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body>
<div class="container mx-auto px-4 py-16">
</div>
