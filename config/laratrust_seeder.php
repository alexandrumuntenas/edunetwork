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
            'web' => 'pagina-crear,pagina-editar,pagina-eliminar,pagina-publicar,post-crear,post-editar,post-eliminar-post-publicar,avisos-crear,avisos-editar,avisos-eliminar,accion-files-subir,accion-files-edit,accion-files-eliminar,accion-publicaciones-crear,accion-publicaciones-editar,accion-publicaciones-eliminar',
            'comunicaciones' => 'enviar,responder,leer',
            'notificaciones' => 'enviar',
        ],
        'vicedirector' => [
            'web' => 'pagina-crear,pagina-editar,pagina-eliminar,pagina-publicar,post-crear,post-editar,post-eliminar-post-publicar,avisos-crear,avisos-editar,avisos-eliminar,accion-files-subir,accion-files-edit,accion-files-eliminar,accion-publicaciones-crear,accion-publicaciones-editar,accion-publicaciones-eliminar',
            'comunicaciones' => 'enviar,responder,leer',
            'notificaciones' => 'enviar',
        ],
        'secretaria' => [
            'web' => 'pagina-crear,pagina-editar,pagina-eliminar,pagina-publicar,post-crear,post-editar,post-eliminar-post-publicar,avisos-crear,avisos-editar,avisos-eliminar,accion-files-subir,accion-files-edit,accion-files-eliminar,accion-publicaciones-crear,accion-publicaciones-editar,accion-publicaciones-eliminar',
            'comunicaciones' => 'enviar,responder,leer',
            'notificaciones' => 'enviar',
        ],
        'jeafaturadeestudios' => [
            'web' => 'pagina-crear,pagina-editar,pagina-eliminar,pagina-publicar,post-crear,post-editar,post-eliminar-post-publicar,avisos-crear,avisos-editar,avisos-eliminar,accion-files-subir,accion-files-edit,accion-files-eliminar,accion-publicaciones-crear,accion-publicaciones-editar,accion-publicaciones-eliminar',
            'comunicaciones' => 'enviar,responder,leer',
            'notificaciones' => 'enviar',
        ],
        'bibliotecario' => [
            'biblioteca' => 'crear,lectura,editar,eliminar,prestamos',
        ],
        'profesor' => [
            'cuadernoprofesor' => 'crear,editar,archivar,eliminar',
            'comunicaciones' => 'enviar,responder',
            'elearning' => 'classroom-crear,classroom-editar,classroom-eliminar,classroom-archivar,classroom-unir,classroom-leer',
        ],
        'alumno' => [
            'biblioteca' => 'biblio-lectura',
            'elearning' => 'classroom-join',
        ],
    ],

    'permissions_map' => [

        /* Página web */
        'pagina-crear' => 'pagina-crear',
        'pagina-editar' => 'pagina-editar',
        'pagina-eliminar' => 'pagina-eliminar',
        'pagina-publicar' => 'pagina-publicar',
        'post-crear' => 'post-crear',
        'post-editar' => 'post-editar',
        'post-eliminar' => 'post-eliminar',
        'post-publicar' => 'post-publicar',
        'avisos-crear' => 'avisos-crear',
        'avisos-editar' => 'avisos-editar',
        'avisos-eliminar' => 'avisos-eliminar',
        'accion-files-subir' => 'accion-files-subir',
        'accion-files-edit' => 'accion-files-edit',
        'accion-files-eliminar' => 'accion-files-eliminar',
        'accion-publicaciones-crear' => 'accion-publicaciones-crear',
        'accion-publicaciones-editar' => 'accion-publicaciones-editar',
        'accion-publicaciones-eliminar' => 'accion-publicaciones-eliminar',

        /* Cuaderno del profesor */
        'archivar' => 'archivar',

        /* Comunicaciones */
        'enviar' => 'enviar',
        'responder' => 'responder',
        'leer' => 'leer',

        /* Biblioteca */
        'crear' => 'crear',
        'lectura' => 'lectura',
        'editar' => 'editar',
        'eliminar' => 'eliminar',
        'prestamos' => 'prestamos',

        /* Elearning */
        'classroom-crear' => 'classroom-crear',
        'classroom-editar' => 'classroom-editar',
        'classroom-eliminar' => 'classroom-eliminar',
        'classroom-archivar' => 'classroom-archivar',
        'classroom-unir' => 'classroom-unir',
        'classroom-leer' => 'classroom-leer',
        'classroom-acciones-alumnos' => 'classroom-acciones-alumnos',
        'classroom-acciones-profesores' => 'classroom-acciones-profesores',


    ]
];
