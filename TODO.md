# Hoja de Ruta de Desarrollo (Roadmap)

## Fase 1: Configuración del Entorno
- [ ] Inicializar proyecto Symfony (`symfony new graduados --webapp`).
- [ ] Implementar la configuración optimizada de Apache VHost (SSL y Rewrites).

## Fase 2: Base de Datos y Entidades
- [ ] Crear entidad `Carrera`.
- [ ] Crear entidad `Graduado` (incluir campos de validación y campos de CACES).
- [ ] Crear entidad `ExperienciaLaboral` (Relación OneToMany con Graduado).
- [ ] Crear entidad `EstudioPosterior` (Relación OneToMany con Graduado).
- [ ] Ejecutar migraciones.

## Fase 3: Lógica de Negocio (Backend)
- [ ] **Comando de Importación:** Crear un comando de consola (`app:import-graduados`) que lea un Excel/CSV y llene la tabla `Graduado` con la cédula, apellidos, nombres, senescyt y carrera. *Sin esto el sistema no funciona.*
- [ ] **Controlador de Acceso:** Crear lógica que reciba Cédula + Apellido.
    - Si coincide: Crear sesión temporal o token y redirigir al formulario.
    - Si no coincide: Mostrar error "Graduado no encontrado en la lista maestra".
- [ ] **Formularios (Symfony Forms):**
    - Crear `GraduadoType` (Ocultar campos de validación, permitir editar contacto y perfil).
    - Usar `CollectionType` para permitir agregar múltiples experiencias laborales y estudios en la misma pantalla.
    - Campo de subida de archivo para el CV (PDF).

## Fase 4: Frontend (Interfaz)
- [ ] **Landing Page:** Diseño simple con el logo del Instituto y los dos campos de validación (Cédula/Apellido).
- [ ] **Panel del Graduado:**
    - Formulario de "Datos Personales".
    - Sección dinámica de "Experiencia Laboral" (Botón "Agregar Trabajo").
    - Sección dinámica de "Formación Académica".
    - Sección de "Intereses y Colaboración".
    - Botón para ir a la Encuesta de Google Forms (si aplica).
- [ ] **Mensajes Flash:** Alertas de éxito al guardar ("Datos actualizados correctamente").

## Fase 5: Panel Administrativo (Opcional / Fase 2)
- [ ] Instalar `EasyAdminBundle` para que el rectorado/coordinadores puedan ver la data, buscar graduados y exportar a Excel.

## Fase 6: Despliegue y Pruebas
- [ ] Cargar data real de prueba (Excel de secretaría).
- [ ] Verificar permisos de escritura en carpeta `public/uploads` (para los CVs).
- [ ] Testear validación con apellidos que tengan tildes o eñes.