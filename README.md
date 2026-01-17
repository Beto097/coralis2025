# Centro Médico Coralis 2025

Sistema de gestión médica desarrollado en Laravel para el Centro Médico Coralis.

## Acerca del Proyecto

Centro Médico Coralis 2025 es un sistema integral de gestión médica que permite:

- Gestión de pacientes y consultas
- Órdenes de laboratorio y exámenes médicos
- Recetas médicas y certificados
- Referencias médicas y constancias
- Control de usuarios y roles
- Gestión de sucursales

## Características Principales

- **Gestión de Pacientes**: Registro y administración completa de pacientes
- **Consultas Médicas**: Sistema de consultas con historial médico
- **Laboratorio**: Órdenes de laboratorio con exámenes personalizables
- **Recetas**: Generación de recetas médicas
- **Certificados**: Emisión de certificados médicos
- **Referencias**: Sistema de referencias entre médicos
- **Multi-sucursal**: Soporte para múltiples sucursales

## Funcionalidades Recientes

### Agregar Exámenes Dinámicamente (Enero 2026)

Se implementó la funcionalidad para agregar nuevos exámenes directamente desde el modal de órdenes de laboratorio:

**Características:**
- **Búsqueda Inteligente**: El sistema muestra un botón "Agregar Examen" solo cuando no encuentra resultados en la búsqueda
- **Validación Automática**: Previene nombres duplicados y valida entrada mínima (2 caracteres)
- **Actualización en Tiempo Real**: Refresca automáticamente la lista de exámenes sin recargar la página
- **Interfaz Intuitiva**: Mensajes informativos y feedback visual para mejor experiencia de usuario

**Archivos Modificados:**
- `resources/views/modals/OrdenModals.blade.php` - Modal mejorado con botón y JavaScript
- `app/Http/Controllers/examenController.php` - Nuevos métodos `agregar()` y `lista()`
- `routes/web.php` - Rutas agregadas: `examen.agregar` y `examen.lista`

**Rutas Agregadas:**
```php
POST /examen/agregar - Crear nuevos exámenes desde modal
GET  /examen/lista   - Refrescar lista de exámenes
```

**Flujo de Uso:**
1. Usuario busca un examen en el modal de órdenes
2. Si no existe, aparece automáticamente el botón "Agregar Examen"
3. El usuario confirma la creación del nuevo examen
4. El sistema valida y crea el examen en la base de datos
5. La lista se actualiza automáticamente mostrando el nuevo examen

## Requisitos del Sistema

- PHP >= 8.0
- Laravel 8.x
- MySQL 5.7+
- Composer
- Node.js & NPM (para assets)

## Instalación

1. Clonar el repositorio
2. Ejecutar `composer install`
3. Configurar archivo `.env` con credenciales de base de datos
4. Ejecutar `php artisan migrate`
5. Ejecutar `php artisan serve`

## Estructura del Proyecto

```
app/
├── Http/Controllers/     # Controladores del sistema
├── Models/              # Modelos Eloquent
├── View/Components/     # Componentes de Blade
└── ...

resources/
├── views/               # Vistas Blade
│   ├── modals/         # Modales del sistema
│   └── components/     # Componentes reutilizables
└── ...

routes/
└── web.php             # Rutas del sistema
```

## Tecnologías Utilizadas

Este proyecto está construido sobre Laravel y utiliza las siguientes tecnologías:

- **Backend**: Laravel 8.x (PHP Framework)
- **Frontend**: Blade Templates, Bootstrap, jQuery
- **Base de Datos**: MySQL
- **Autenticación**: Laravel Auth personalizada
- **AJAX**: jQuery para operaciones asíncronas

---

## Acerca de Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
