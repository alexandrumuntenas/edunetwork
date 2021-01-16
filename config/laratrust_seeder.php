<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrador' => [
            'configuracionglobal' => 'r,u',
        ],
        'director' => [
            'web' => 'c,r,u,d',
        ],
        'vicedirector' => [],
        'secretaria' => [],
        'bibliotecario' => [
            'biblioteca' => 'biblio_crear,biblio_lectura,biblio_editar,biblio_eliminar,biblio_prestamos',
        ],
        'profesor' => [
            'cuadernoprofesor' => 'cuadernoprofesor_crear,cuadernoprofesor_editar,cuadernoprofesor_archivar,cuadernoprofesor_archivar',
            'comunicaciones' => 'comunicaciones_enviar,comunicaciones_responder,comunicaciones_leer',
            'elearning' => 'elearning_classroom_crear,elearning_classroom_editar,elearning_classroom_eliminar,elearning_classroom_archivar,elearning_classroom_unir,elearning_classroom_leer',
        ],
        'alumno' => [
            'biblioteca' => 'biblio_lectura',
            'elearning' => 'classroom_join',
        ],
    ],

    'permissions_map' => [

        /* */


        /* Página web */
        'web_pagina_crear' => 'Crear páginas en la web',
        'web_pagina_editar' => 'Editar páginas en la web',
        'web_pagina_eliminar' => 'Eliminar páginas en la web',
        'web_pagina_publicar' => 'Publicar páginas en la web',
        'web_pagina_leer' => 'Leer páginas en la web',
        'web_post_crear' => 'Crear páginas en la web',
        'web_post_editar' => 'Editar páginas en la web',
        'web_post_eliminar' => 'Eliminar páginas en la web',
        'web_post_publicar' => 'Eliminar páginas en la web',
        'web_post_leer' => 'Eliminar páginas en la web',
        'web_avisos_crear' => 'Crear avisos en la web',
        'web_avisos_editar' => 'Editar avisos en la web',
        'web_avisos_eliminar' => 'Eliminar avisos en la web',
        'web_accion_files_subir' => 'Subir archivos en la web',
        'web_accion_files_edit' => 'Editar archivos subidos en la web',
        'web_accion_files_eliminar' => 'Eliminar archivos subidos en la web',
        'web_accion_publicaciones_crear' => 'Crear publicaciones en la web',
        'web_accion_publicaciones_editar' => 'Editar publicaciones en la web',
        'web_accion_publicaciones_eliminar' => 'Eliminar publicaciones en la web',

        /* Cuaderno del profesor */
        'cuadernoprofesor_crear' => 'Crear Cuaderno del Profesor',
        'cuadernoprofesor_editar' => 'Editar el Cuaderno del Profesor',
        'cuadernoprofesor_eliminar' => 'Eliminar Cuaderno del Profesor',
        'cuadernoprofesor_archivar' => 'Archivar Cuaderno del Profesor',

        /* Comunicaciones */
        'comunicaciones_enviar' => 'Enviar comunicaciones',
        'comunicaciones_responder' => 'Responder a las comunicaciones',
        'comunicaciones_leer' => 'Leer las comunicaciones',

        /* Biblioteca */
        'biblio_crear' => 'Crear en la biblioteca',
        'biblio_lectura' => 'Leer registros de la biblioteca',
        'biblio_editar' => 'Editar registros de la biblioteca',
        'biblio_eliminar' => 'Eliminar registros de la biblioteca',
        'biblio_prestamos' => 'Prestar libros de la biblioteca',

        /* Elearning */
        'elearning_classroom_crear' => 'Crear clase',
        'elearning_classroom_editar' => 'Editar clase',
        'elearning_classroom_eliminar' => 'Eliminar clase',
        'elearning_classroom_archivar' => 'Archivar clase',
        'elearning_classroom_unir' => 'Unir clase',
        'elearning_classroom_leer' => 'Ver clase',
        'elearning_classroom_acciones_alumnos' => 'Todas las acciones que pueden realizar los alumnos',
        'elearning_classroom_acciones_profesores' => 'Todas las acciones que pueden realizar los profesores',


    ]
];
