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
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-500 mb-8">
            CI/CD con Laravel
        </h1>

        <div class="max-w-4xl mx-auto bg-black/40 backdrop-blur-lg rounded-xl p-8 shadow-2xl">
            <h2 class="text-3xl font-semibold text-red-400 mb-4">
                Automatización con GitHub Actions
            </h2>
            <p class="text-xl text-gray-400 mb-12">
                Potencia tu flujo de desarrollo con integración y despliegue continuo
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- GitHub Actions -->
                <div class="card-3d p-6 bg-gradient-to-br from-red-950 to-black rounded-lg">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold text-red-400">GitHub Actions</h3>
                    <p class="text-gray-400">Workflows automatizados para testing y deployment</p>
                    <ul class="text-sm text-gray-500 mt-4 text-left">
                        <li>• PHPUnit Tests</li>
                        <li>• Code Quality Checks</li>
                        <li>• Automated Deployments</li>
                    </ul>
                </div>

                <!-- Laravel Pipeline -->
                <div class="card-3d p-6 bg-gradient-to-br from-red-950 to-black rounded-lg">
                    <div class="text-4xl mb-4">🛠️</div>
                    <h3 class="text-xl font-semibold text-red-400">Laravel Pipeline</h3>
                    <p class="text-gray-400">Framework robusto y escalable</p>
                    <ul class="text-sm text-gray-500 mt-4 text-left">
                        <li>• Artisan Commands</li>
                        <li>• Database Migrations</li>
                        <li>• Queue Workers</li>
                    </ul>
                </div>

                <!-- Deployment -->
                <div class="card-3d p-6 bg-gradient-to-br from-red-950 to-black rounded-lg">
                    <div class="text-4xl mb-4">🚀</div>
                    <h3 class="text-xl font-semibold text-red-400">Deployment</h3>
                    <p class="text-gray-400">Despliegue automatizado y seguro</p>
                    <ul class="text-sm text-gray-500 mt-4 text-left">
                        <li>• Zero Downtime</li>
                        <li>• Rollback Automático</li>
                        <li>• Monitoreo en Tiempo Real</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
