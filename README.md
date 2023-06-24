# Repositorios de código fuente - Aplicación Full Stack Documentos 

### [Backend](https://github.com/Wilcascopr/documents-backend-tech-interview)

### [Frontend](https://github.com/Wilcascopr/documents-frontend-tech-interview)

## Requisitos de instalación

A continuación se detallan los requisitos de instalación y configuración para desplegar la aplicación localmente:

- PHP 8.1.2
- MySQL 8.0
- Composer (se utiliza para gestionar las dependencias del proyecto)
- Node 18.16.0

## Instrucciones de despliegue

**Backend:**

1. Clona el repositorio del backend en tu máquina local:

   ```bash
   git clone https://github.com/Wilcascopr/documents-backend-tech-interview
   ```

2. Navega al directorio del backend:

   ```bash
   cd documents-backend-tech-interview
   ```

3. Copia el archivo de entorno de ejemplo y renómbralo a .env:

   ```bash
   cp .env.example .env
   ```

4. Configura la conexión a la base de datos en el archivo .env. Modifica las siguientes variables de entorno de acuerdo a tu configuración:

   ```makefile
   DB_DATABASE=nombre_de_la_base_de_datos
   DB_USERNAME=usuario_de_la_base_de_datos
   DB_PASSWORD=contraseña_de_la_base_de_datos
   ```

5. Instala las dependencias del proyecto usando Composer:

   ```bash
   composer install
   ```

6. Genera la clave de cifrado de la aplicación:

   ```vbnet
   php artisan key:generate
   ```

7. Ejecuta las migraciones de la base de datos para crear las tablas:

   ```bash
   php artisan migrate
   ```

8. Ejecuta los seeders para cargar datos iniciales en la base de datos:

   ```bash
   php artisan db:seed
   ```

9. Inicia el servidor de desarrollo de Laravel:

   ```bash
   php artisan serve
   ```

**Frontend:**

1. Clona el repositorio del frontend en tu máquina local:

   ```bash
   git clone https://github.com/Wilcascopr/documents-frontend-tech-interview
   ```

2. Navega al directorio del frontend:

   ```bash
   cd documents-frontend-tech-interview
   ```

3. Modifica el archivo /src/services/api/api.js y actualiza la URL del backend con la dirección de tu servidor de desarrollo de Laravel (por defecto, 'http://localhost:8000').

4. Instala las dependencias del proyecto:

   ```bash
   npm install
   ```

5. Inicia el servidor de desarrollo del frontend:

   ```arduino
   npm run serve
   ```

6. Accede a la aplicación en tu navegador web mediante la URL proporcionada por el servidor de desarrollo del frontend.

## Credenciales de inicio de sesión

- Usuario: testuser@email.com
- Contraseña: testpassword

## Funcionalidades de la aplicación

La aplicación ofrece las siguientes funcionalidades:

- Login de usuario: Permite a los usuarios iniciar sesión en la aplicación.
- Logout de usuario: Permite a los usuarios cerrar sesión.
- Tabla o grilla de datos de los documentos: Muestra una lista de documentos en una tabla.
- Búsqueda de registros de documentos: Permite buscar documentos por diferentes criter

ios.
- Creación de registros de documentos: Permite crear nuevos documentos.
- Edición de registros de documentos: Permite editar la información de los documentos existentes.
- Eliminación de registros de documentos: Permite eliminar documentos de la base de datos.

## Modelo de datos

La aplicación utiliza las siguientes tablas en la base de datos:

- **PRO_PROCESO**: Almacena los procesos con los siguientes campos:
  - ID: Identificador único del proceso.
  - NOMBRE: Nombre del proceso.
  - PREFIJO: Prefijo del proceso.

- **TIP_TIPO_DOC**: Almacena los tipos de documentos con los siguientes campos:
  - ID: Identificador único del tipo de documento.
  - NOMBRE: Nombre del tipo de documento.
  - PREFIJO: Prefijo del tipo de documento.

- **DOC_DOCUMENTO**: Almacena los registros de los documentos con los siguientes campos:
  - ID: Identificador único del documento.
  - NOMBRE: Nombre del documento.
  - CODIGO: Código único del documento, generado automáticamente de acuerdo al siguiente lineamiento: TIP_PREFIJO - PRO_PREFIJO - \<ID\>.
  - CONTENIDO: Contenido del documento.
  - TIP_TIPO_DOCS_ID: Identificador del tipo de documento al que pertenece.
  - PRO_PROCESOS_ID: Identificador del proceso al que pertenece.

 ## Diagrama de clases
 ![Diagrama de clases](https://i.ibb.co/7jkZCdm/Screenshot-2023-06-23-191304.png)

**Nota**: El programa genera un código único consecutivo para cada documento, siguiendo el lineamiento mencionado anteriormente. No se deben repetir los consecutivos para documentos del mismo tipo y proceso.

## Tecnologías utilizadas

La aplicación utiliza las siguientes tecnologías:

- Backend:
  - PHP 8.1.2
  - Laravel

- Frontend:
  - Vue.js, generado con Vite.
  - Vuex
  - Vuetify
  - Axios

- Base de datos:
  - MySQL 8.0

- Herramientas y utilidades:
  - Composer (Gestor de dependencias de PHP)
  - npm (Gestor de paquetes de Node.js)

Estas tecnologías se combinan para crear una aplicación web completa con funcionalidades de login de usuario, gestión de documentos, búsqueda y manipulación de registros, y una arquitectura cliente-servidor basada en Laravel en el backend y Vue.js en el frontend.
