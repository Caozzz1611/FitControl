<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FitControl | Gestión de Clubes de Fútbol</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        /* Hero Section */
        .hero {
            background: url('https://images.unsplash.com/photo-1508078150086-1d1d0ac6e7a7?auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            color: white;
            height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-overlay {
            background: rgba(0,0,0,0.6);
            height: 100%;
            width: 100%;
            padding: 3rem;
        }

        .feature-icon {
            font-size: 3rem;
            color: #0d6efd;
        }

        /* Footer */
        footer {
            background-color: #f8f9fa;
            padding: 1.5rem 0;
            font-size: 0.9rem;
            color: #555;
        }

        /* Section titles */
        h2 {
            font-weight: 700;
            color: #222;
        }

        /* Navigation tweaks */
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: #0d6efd !important;
        }

        .nav-link {
            font-weight: 500;
            color: #555 !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #0d6efd !important;
        }

        /* Plans cards */
        .plan-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            height: 100%;
        }
        .plan-card:hover {
            box-shadow: 0 8px 20px rgba(13,110,253,0.25);
            transform: translateY(-8px);
        }

        /* Testimonials */
        .testimonial {
            background: #f1f5fb;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }
        .testimonial p {
            font-style: italic;
            color: #444;
        }
        .testimonial .author {
            font-weight: 600;
            margin-top: 1rem;
            color: #0d6efd;
        }

        /* Contact form */
        #contact .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        #contact .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">FitControl</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#hero">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Características</a></li>
                <li class="nav-item"><a class="nav-link" href="#plans">Planes</a></li>
                <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonios</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                <li class="nav-item ms-lg-3">
                    <a href="/login" class="btn btn-primary px-4">Iniciar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="hero" class="hero">
    <div class="hero-overlay d-flex flex-column justify-content-center">
        <div class="container text-center text-md-start">
            <h1 class="display-4 fw-bold">Gestiona tu club de fútbol<br>de forma sencilla y profesional</h1>
            <p class="lead mt-3 mb-4">Controla jugadores, entrenadores, estadísticas y comunicación en un solo lugar.</p>
            <a href="/register" class="btn btn-lg btn-primary">Comienza ahora</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">¿Qué ofrecemos?</h2>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-people-fill feature-icon"></i>
                </div>
                <h4>Gestión de Plantillas</h4>
                <p>Administra fácilmente los jugadores, entrenadores y personal técnico de tu club.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-bar-chart-line-fill feature-icon"></i>
                </div>
                <h4>Estadísticas y Análisis</h4>
                <p>Visualiza estadísticas detalladas para mejorar el rendimiento individual y colectivo.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-chat-dots-fill feature-icon"></i>
                </div>
                <h4>Comunicación Instantánea</h4>
                <p>Envía mensajes y notificaciones para mantener a todo el equipo sincronizado.</p>
            </div>
        </div>
    </div>
</section>

<!-- Plans Section -->
<section id="plans" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Planes para tu Club</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="plan-card text-center">
                    <h3>Plan Básico</h3>
                    <p class="text-muted mb-4">Ideal para clubes pequeños o emergentes</p>
                    <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Gestión de hasta 20 jugadores</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Estadísticas básicas</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Comunicación por email</li>
                    </ul>
                    <div class="h4">$10 / mes</div>
                    <button class="btn btn-outline-primary mt-3">Suscribirse</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="plan-card text-center border-primary">
                    <h3 class="text-primary">Plan Profesional</h3>
                    <p class="text-muted mb-4">Para clubes medianos con más necesidades</p>
                    <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Gestión ilimitada de jugadores y staff</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Estadísticas avanzadas</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Comunicación vía app y SMS</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Reportes personalizados</li>
                    </ul>
                    <div class="h4">$30 / mes</div>
                    <button class="btn btn-primary mt-3">Suscribirse</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="plan-card text-center">
                    <h3>Plan Elite</h3>
                    <p class="text-muted mb-4">Solución completa para clubes profesionales</p>
                    <ul class="list-unstyled mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Todo del plan Profesional</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Integración con sistemas externos</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Soporte dedicado 24/7</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Consultoría personalizada</li>
                    </ul>
                    <div class="h4">$70 / mes</div>
                    <button class="btn btn-outline-primary mt-3">Solicitar Demo</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Testimonios</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="testimonial">
                    <p>"FitControl ha transformado la forma en que gestionamos nuestro club. Ahora todo es más rápido, claro y profesional."</p>
                    <div class="author">— Carlos Méndez, Director Técnico Club Atlético</div>
                </div>
                <div class="testimonial">
                    <p>"Gracias a las estadísticas detalladas, hemos mejorado el rendimiento del equipo y tomado mejores decisiones tácticas."</p>
                    <div class="author">— Laura Gómez, Entrenadora Principal</div>
                </div>
                <div class="testimonial">
                    <p>"La comunicación instantánea ha facilitado la coordinación con jugadores y staff. ¡Muy recomendado!"</p>
                    <div class="author">— Juan Pérez, Manager Deportivo</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Sobre FitControl</h2>
        <p class="text-center lead mb-5 px-3 px-md-5">Somos una plataforma dedicada exclusivamente a la gestión de clubes de fútbol, creada por expertos en deporte y tecnología. Nuestra misión es facilitar la administración y potenciar el rendimiento de los equipos, ayudando a entrenadores, jugadores y directivos a lograr sus objetivos de manera eficiente.</p>
        <div class="row text-center">
            <div class="col-md-4">
                <i class="bi bi-stopwatch feature-icon"></i>
                <h5 class="mt-3">Optimiza tu tiempo</h5>
                <p>Automatiza procesos y dedica más tiempo al entrenamiento y estrategia.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-shield-lock-fill feature-icon"></i>
                <h5 class="mt-3">Seguridad avanzada</h5>
                <p>Protegemos tus datos con encriptación y protocolos de última generación.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-headset feature-icon"></i>
                <h5 class="mt-3">Soporte 24/7</h5>
                <p>Atención personalizada y asistencia técnica cuando la necesites.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Contacto</h2>
        <p class="text-center mb-4">¿Quieres saber más? Contáctanos y un asesor te guiará en el proceso.</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre completo</label>
                        <input type="text" id="name" class="form-control" placeholder="Tu nombre" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" id="email" class="form-control" placeholder="tucorreo@ejemplo.com" required />
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea id="message" class="form-control" rows="4" placeholder="Escribe tu mensaje aquí" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <small>© 2025 FitControl. Todos los derechos reservados.</small>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
