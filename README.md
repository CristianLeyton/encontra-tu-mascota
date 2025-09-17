<img width="1268" height="597" alt="image" src="https://github.com/user-attachments/assets/ac65923f-ccb6-49c3-a36c-c22d63b86100" />


# Encontrá Tu Mascota

**Encontrá Tu Mascota** es una aplicación web dedicada a la comunidad, diseñada para facilitar la búsqueda y el reencuentro de mascotas perdidas. Los usuarios pueden publicar avisos de mascotas que han perdido o encontrado, proporcionando detalles y fotos para ayudar a que vuelvan a casa sanas y salvas.  

La idea fue propuesta por SaltaDev para la ciudad de Salta, Argentina.  

[Ver Propuesta](https://daffodil-bandicoot-bca.notion.site/mini-hackathon) - daffodil-bandicoot-bca.notion.site/mini-hackathon  

[Ver Demo](https://encontratumascota.cdl.com.ar/) - encontratumascota.cdl.com.ar  

## ✨ Funcionalidades Principales

### Para Usuarios

* **Registro e Inicio de Sesión:** Crea una cuenta para empezar a publicar.  
* **Publicar Avisos:** Crea publicaciones detalladas sobre mascotas perdidas o encontradas, incluyendo fotos, descripción, ubicación y fecha.  
* **Ver Publicaciones:** Navega por todos los avisos publicados por otros usuarios (Incluso sin estar logueado).  
* **Gestionar Publicaciones Propias:** Edita y elimina tus propias publicaciones desde un panel de usuario personal.  

### Para Administradores

* **Panel de Administración Completo:** Acceso a un panel de control avanzado construido con Filament.  
* **Gestión Total de Publicaciones:** Visualiza, edita, y elimina las publicaciones de todos los usuarios.  
* **Gestión de Usuarios:** Administra las cuentas de los usuarios registrados.  
* **Moderación de Contenido:** Revisa y gestiona los reportes realizados por los usuarios sobre las publicaciones.  
* **Gestión de Catálogos:** Administra las especies y razas de mascotas disponibles en la plataforma.  

## 🚀 Stack Tecnológico

**Backend:**  
    - PHP 8.2+  
    - Laravel 12  
    - Filament 4 (Panel de Administración)  

**Frontend:**  
    - Componentes Blade y Livewire  
    - Vite  
    - Tailwind CSS 4  
    - Swiper.js (Para carruseles de imágenes)  

**Base de Datos:**  
    - MySQL  

**Entorno de Desarrollo:**  
    - Laragon  
    - Visual Studio Code  

## ⚙️ Instalación y Configuración

### 1. Requisitos Previos

* PHP 8.2 o superior  
* Composer  
* Node.js y npm  
* Una base de datos (ej. MySQL, PostgreSQL, SQLite)  

Abre el archivo `.env` y configura las variables de entorno, especialmente la conexión a la base de datos (`DB_*`)  
y FILAMENT_FILESYSTEM_DISK="public_storage".  

```bash
composer install 
npm install && npm run dev
php artisan key:generate
php run migrate --seed
```

Esto creará un usuario administrador por defecto con las siguientes credenciales:  

```bash
Email: `admin@mail.com`  
Contraseña: `admin`  
```

Y creará un usuario por defecto con las siguientes credenciales:  

```bash
Email: `user@mail.com`  
Contraseña: `user`  
```

#### A tener en cuenta  

* **Arquitectura:** El proyecto sigue una arquitectura monolítica basada en el framework Laravel, utilizando el patrón Modelo-Vista-Controlador (MVC). El panel de administración se construye con Filament, que se integra perfectamente con el ecosistema de Laravel.  

* **Autorización:** Se recomienda el uso de Políticas de Laravel para gestionar los permisos de los usuarios. El `PostsResource` ya implementa una lógica básica para diferenciar entre administradores y usuarios comunes.  

* **Rutas Protegidas:** Las rutas de administración deben estar protegidas con el middleware `auth` y verificar el rol del usuario para garantizar la seguridad.  

* **CRUD con eliminaciones suaves (soft deletes)**  

## 🤖 IA Utilizada

Este proyecto ha sido desarrollado con la asistencia de **Gemini Code Assist**, un asistente de codificación de Google, para mejorar la calidad del código, generar documentación y acelerar el desarrollo. Y consultas al chat de GPT AI.  

## 📄 Licencia

Este proyecto se distribuye bajo la **Licencia MIT**.  
