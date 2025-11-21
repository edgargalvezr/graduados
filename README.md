# Sistema de Seguimiento a Graduados (SSG)

## 1. Descripción del Proyecto
Aplicación web desarrollada en **Symfony** para la gestión y actualización de datos de los graduados del Instituto. El objetivo principal es cumplir con los indicadores de calidad del **CACES** (Relación con los Graduados).

El sistema permite mantener una base de datos actualizada sobre la localización, ocupación y estudios posteriores de las últimas cohortes, facilitar la inserción laboral y obtener retroalimentación de empleadores.

## 2. Reglas de Negocio y Seguridad
* **Acceso Público (Graduados):** No existe un sistema de "Login/Password" tradicional para los graduados.
* **Mecanismo de Validación:** El acceso se valida mediante la coincidencia exacta de dos campos pre-cargados:
    1.  Número de Cédula.
    2.  Apellidos (Seguridad básica).
* **Acceso Administrativo:** Los administradores del instituto (Coordinadores/Rectorado) tendrán acceso seguro (Login) para importar la "Lista Maestra" de graduados, ver reportes y descargar la base de datos.

## 3. Arquitectura Técnica
* **Framework:** Symfony (Versión estable actual).
* **Base de Datos:** MariaDB / MySQL.
* **Frontend:** Twig con Bootstrap para un diseño responsivo y simple.
* **Servidor:** Apache (Configuración VHost optimizada con SSL).

## 4. Modelo de Datos (Entidades)

### A. `Carrera`
Catálogo de las carreras ofertadas.
* `nombre` (string)

### B. `Graduado` (Entidad Principal)
Contiene la "Lista Maestra" (datos inmutables de validación) y el "Perfil" (datos actualizables).
* **Validación (Solo lectura para el usuario):**
    * `cedula` (string, unique)
    * `apellidos` (string)
    * `nombres` (string)
    * `registro_senescyt` (string, unique)
    * `cohorte` (string) (Ej: "2023-B")
    * `carrera_id` (ManyToOne)
* **Contacto (Actualizable):**
    * `email` (string)
    * `telefono` (string)
    * `ciudad_residencia` (string)
    * `pais_residencia` (string)
* **Perfil Profesional:**
    * `cv_path` (string) (Ruta del archivo PDF subido)
    * `busca_empleo` (boolean)
    * `habilidades_clave` (json/array) (Para filtrar en bolsa de trabajo)
    * `temas_interes_formacion` (json/array) (Para cursos de educación continua)
    * `tipo_colaboracion` (json/array) (Charlas, mentorías, red de graduados)
    * `logros_destacados` (text) (Para difusión institucional)

### C. `ExperienciaLaboral` (OneToMany desde Graduado)
Historial laboral para medir la empleabilidad.
* `empresa` (string)
* `cargo` (string)
* `estado_laboral` (string: Empleado, Desempleado, Emprendedor)
* `relacionado_carrera` (boolean)
* **Datos para el Empleador:**
    * `nombre_jefe_directo` (string, opcional)
    * `email_contacto_rrhh` (string, opcional)
    * `permiso_contacto_empleador` (boolean) (Autorización para enviar encuestas al empleador)

### D. `EstudioPosterior` (OneToMany desde Graduado)
Seguimiento a la formación académica continua.
* `institucion` (string)
* `titulo_obtenido` (string)
* `tipo_estudio` (string: Maestría, Certificación, Tecnología)

## 5. Requisitos de Instalación
1.  Clonar repositorio.
2.  `composer install`
3.  Configurar `.env` con credenciales de BD.
4.  `php bin/console doctrine:database:create`
5.  `php bin/console doctrine:migrations:migrate`
6.  Configurar VHost de Apache.