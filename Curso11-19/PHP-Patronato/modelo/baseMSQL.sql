CREATE TABLE persona (
    id integer NOT NULL,
    nombre text NOT NULL,
    apellido_paterno text NOT NULL,
    apellido_materno text DEFAULT '' NOT NULL,
    correo text NOT NULL
);

CREATE TABLE usuario (
    id integer NOT NULL,
    id_persona integer,
    login_usuario character varying(30) NOT NULL,
    contrasena character varying(256) NOT NULL,
    salt character varying(256) NOT NULL,
    rol text NOT NULL,
    activo boolean,
    CONSTRAINT usuario_rol_check CHECK (rol IN ('Cliente', 'Administrador'))
);

