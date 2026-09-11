# Sistema de Gestión de Biblioteca

Aplicación web desarrollada con Symfony 7 para gestionar una biblioteca pequeña.

## Tecnologías
- PHP 8.3
- Symfony 7
- Doctrine ORM
- MySQL
- Twig
- Bootstrap 5

## Requisitos
- PHP 8.2 o superior
- Composer
- Symfony CLI
- MySQL

## Instalación

### 1. Clonar el repositorio
git clone <url-del-repositorio>
cd biblioteca

### 2. Instalar dependencias
composer install

### 3. Configurar la base de datos
Copia el archivo .env y configura tu base de datos:
cp .env .env.local

Edita .env.local y cambia:
DATABASE_URL="mysql://usuario:password@127.0.0.1:3306/biblioteca?serverVersion=8.0&charset=utf8mb4"

### 4. Crear la base de datos
php bin/console doctrine:database:create
php bin/console doctrine:schema:create

### 5. Cargar datos de prueba
php bin/console doctrine:fixtures:load

### 6. Arrancar el servidor
symfony serve -d

Abre http://127.0.0.1:8000 en el navegador.

## Usuarios de prueba

### Administrador
- Email: admin@biblioteca.com
- Password: admin1234

### Usuarios normales
- Email: user1@biblioteca.com / Password: user1234
- Email: user2@biblioteca.com / Password: user1234
- Email: user3@biblioteca.com / Password: user1234
- Email: user4@biblioteca.com / Password: user1234

## Funcionalidades

### Usuario normal
- Buscar libros por título, autor o ISBN
- Ver disponibilidad de libros
- Solicitar préstamos (máximo 3 activos)
- Ver préstamos activos e historial
- Devolver libros
- Ver perfil con estadísticas

### Administrador
- Gestión completa de libros (CRUD)
- Ver todos los préstamos con filtros
- Dashboard con estadísticas
- Ver préstamos retrasados
