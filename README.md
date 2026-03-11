# 🏥 Sistema Médico Clínico

Sistema completo para la gestión de consultorios médicos.

---

## 📝 Descripción

Plataforma profesional para la administración integral de consultorios médicos. Gestiona pacientes, doctores, especialidades, citas médicas, historial clínico, recetas, exámenes y facturación.

### ¿Qué hace este proyecto?

- **Gestión de Pacientes**: Registro completo con ficha clínica
- **Gestión de Doctores**: Control por especialidad
- **Especialidades Médicas**: Catálogo de especialidades
- **Citas Médicas**: Agenda y programación de consultas
- **Historial Clínico**: Registro de peso, altura, presión, diagnóstico, tratamiento
- **Recetas Médicas**: Generación de recetas imprimibles en PDF
- **Exámenes**: Control de exámenes médicos
- **Facturación**: Gestión de pagos y facturas
- **Dashboard**: Métricas en tiempo real

---

## ✨ Características Principales

| Característica | Descripción |
|----------------|-------------|
| 👥 **Gestión de Pacientes** | CRUD completo con ficha clínica |
| 👨‍⚕️ **Gestión de Doctores** | Por especialidad médica |
| 📋 **Especialidades** | Catálogo de especialidades médicas |
| 📅 **Citas Médicas** | Agenda y programación de consultas |
| 📋 **Historial Clínico** | Peso, altura, presión, diagnóstico |
| 💊 **Recetas Médicas** | Generación en PDF |
| 🔬 **Exámenes** | Control de exámenes médicos |
| 💰 **Facturación** | Gestión de pagos y facturas |
| 📊 **Dashboard** | Pacientes atendidos, citas del día |

---

## 🛠️ Stack Tecnológico

- **Backend**: PHP 8.3, Laravel 11, Livewire 3
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript Vanilla
- **Base de datos**: MySQL/MariaDB
- **PDF**: DomPDF

---

## 🚀 Instalación y Uso

### Requisitos

- PHP 8.2+
- Composer
- MySQL/MariaDB

### Instalación

```bash
# Clonar el repositorio
git clone <repositorio>

# Instalar dependencias
composer install

# Copiar archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Poblar base de datos con datos de ejemplo
php artisan db:seed

# Iniciar servidor
php artisan serve
```

### Usar Docker

```bash
# Construir y levantar contenedores
docker compose up -d --build

# Ver estado de los contenedores
docker compose ps

# Acceder al contenedor
docker compose exec app bash

# Ejecutar migraciones dentro del contenedor
php artisan migrate

# Poblar base de datos
php artisan db:seed

# Ver logs
docker compose logs -f app
```

### Credenciales por defecto

| Rol | Email | Contraseña |
|-----|-------|------------|
| Administrador | admin@clinica.com | password |

---

## 📁 Estructura del Proyecto

```
├── app/
│   ├── Livewire/           # Componentes Livewire
│   ├── Models/             # Modelos Eloquent
├── database/
│   ├── migrations/         # Migraciones
│   ├── seeders/            # Seeders
├── resources/views/        # Vistas Blade
├── docker-compose.yml      # Docker
└── Dockerfile              # Configuración Docker
```

---

## 📊 Módulos del Sistema

1. **Dashboard**: Métricas, pacientes atendidos, citas del día
2. **Pacientes**: CRUD con ficha clínica completa
3. **Doctores**: Gestión por especialidad
4. **Especialidades**: Catálogo médico
5. **Citas**: Agenda de consultas
6. **Historial**: Registro clínico (peso, altura, presión)
7. **Recetas**: Generación PDF
8. **Exámenes**: Control de exámenes
9. **Facturación**: Pagos y facturas

---

## ⚠️ Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o MariaDB

---

## 📦 Paquetes Utilizados

- `laravel/framework` - Framework Laravel
- `livewire/livewire` - Componentes reactivos
- `barryvdh/laravel-dompdf` - Generación de PDFs
- `bootstrap` - Framework CSS

---

## 👨‍💻 Desarrollado por Isaac Esteban Haro Torres

**Ingeniero en Sistemas · Full Stack · Automatización · Data**

- 📧 Email: zackharo1@gmail.com
- 📱 WhatsApp: 098805517
- 💻 GitHub: https://github.com/ieharo1
- 🌐 Portafolio: https://ieharo1.github.io/portafolio-isaac.haro/

---

© 2026 Isaac Esteban Haro Torres - Todos los derechos reservados.
