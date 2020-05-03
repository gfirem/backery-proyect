# WorkShop WordPress

WorkShop para desarrollar tus habilidades como desarrollador de WordPress y es parte del grupo 
[Haz dinero desarrollando para wordpress](https://www.facebook.com/groups/gfirem.dev.wordpress)

## Digitalizando una panaderia local

### Requerimientos
- Entorno LAMP con sitio de WordPress y listo para debuggear.
- Cuenta de github con repositorio para su proyecto.
- Mucha perseverancia y deseo de aprender.

### Recursos
- Sourcetree
- Plugin y licencia de generatepress
    - Yo los voy a compartir (escribirme por privado en el grupo).

### Requisitos
- Tener el sitio de wordpress con el plugin y la plantilla hijo.
- Versionada la carpeta wp-content excuyendo todo exepto el plugin y la plantilla hijo.
- Tener una forma clara de manejar el git.
- Tener el debug listo en tu entorno.

### Planificación
El proyecto va a estar estructurado en:
- Backend
    - Contactos
    - Productos
    - Órdenes
    - Blog
- Frontend
    - Página de Productos
        - Categorias
    - Blog
    - Checkout
    - Página de Contacto
    - Login/Logout

## Comandos relaciondos
Los siguientes comando estan relacionados con las tareas del workshop

- `git add . --force`
- `git commint -m "<message>"`
- `git push origin gfirem`
- `wp db export dump.sql --add-drop-table`
- `wp db import wp-content/_data/dump.sql`

