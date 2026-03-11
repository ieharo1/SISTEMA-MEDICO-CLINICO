# Sistema Médico Clínico

Proyecto desarrollado por **Isaac Esteban Haro Torres**.

---

## Descripción

Plataforma completa para la gestión de consultorios médicos, permitiendo el registro de pacientes, doctores, especialidades, citas médicas, historial clínico, recetas médicas, exámenes y facturación básica.

---

## Características

- Registro y gestión de pacientes con ficha clínica completa
- Gestión de doctores y especialidades médicas
- Sistema de citas con agenda y calendario
- Historial clínico por paciente (peso, altura, presión, diagnóstico, tratamiento)
- Recetas médicas con generación de PDF
- Control de exámenes médicos
- Dashboard con métricas y estadísticas
- Panel administrativo moderno con Bootstrap 5

---

## Stack Tecnológico

* PHP 8.2+
* Laravel 11
* Livewire 3
* Bootstrap 5
* Docker
* MySQL 8.0
* DomPDF

---

## Instalación desde cero

1. Clonar el repositorio
2. Ejecutar `docker compose up -d --build`
3. Acceder al contenedor: `docker exec -it medical_app bash`
4. Ejecutar migraciones: `php artisan migrate`
5. Ejecutar seeders: `php artisan db:seed`
6. Acceder al sistema en `http://localhost:8000`

**Credenciales por defecto:**
- Email: admin@medical.com
- Password: password

---

## 👨‍💻 Desarrollado por Isaac Esteban Haro Torres

**Ingeniero en Sistemas · Full Stack · Automatización · Data**

- 📧 Email: zackharo1@gmail.com
- 📱 WhatsApp: 098805517
- 💻 GitHub: https://github.com/ieharo1
- 🌐 Portafolio: https://ieharo1.github.io/portafolio-isaac.haro/

---

© 2026 Isaac Esteban Haro Torres - Todos los derechos reservados.
