--
-- PatronatoQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cd; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE cd (
    id_producto text NOT NULL,
    artista text NOT NULL,
    titulo text NOT NULL,
    genero text,
    cantidadsoundtracks integer,
    CONSTRAINT cd_genero_check CHECK ((genero = ANY (ARRAY['Rock alternativo'::text, 'Pop'::text, 'Clasico'::text, 'Banda'::text, 'Jazz'::text, 'Mexicana'::text])))
);


ALTER TABLE cd OWNER TO patronato;

--
-- Name: cliente_contacto; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE cliente_contacto (
    id_cliente integer NOT NULL,
    id_direccion integer NOT NULL
);


ALTER TABLE cliente_contacto OWNER TO patronato;

--
-- Name: direccion_id_sequence; Type: SEQUENCE; Schema: public; Owner: patronato
--

CREATE SEQUENCE direccion_id_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE direccion_id_sequence OWNER TO patronato;

--
-- Name: direccion; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE direccion (
    calle_numero text NOT NULL,
    colonia text NOT NULL,
    ciudad text NOT NULL,
    cp character(5) NOT NULL,
    pais integer NOT NULL,
    id integer DEFAULT nextval('direccion_id_sequence'::regclass) NOT NULL
);


ALTER TABLE direccion OWNER TO patronato;

--
-- Name: TABLE direccion; Type: COMMENT; Schema: public; Owner: patronato
--

COMMENT ON TABLE direccion IS 'id direcciones';


--
-- Name: COLUMN direccion.id; Type: COMMENT; Schema: public; Owner: patronato
--

COMMENT ON COLUMN direccion.id IS 'id direcciones';


--
-- Name: dvd; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE dvd (
    id_producto text NOT NULL,
    titulo text NOT NULL,
    duracion integer NOT NULL,
    genero text,
    director text NOT NULL,
    CONSTRAINT dvd_genero_check CHECK ((genero = ANY (ARRAY['terror'::text, 'drama'::text, 'musical'::text, 'concierto'::text])))
);


ALTER TABLE dvd OWNER TO patronato;

--
-- Name: envio; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE envio (
    id_notificacion integer NOT NULL,
    id_direccion integer NOT NULL,
    telefono text NOT NULL,
    fecha_entrega date
);


ALTER TABLE envio OWNER TO patronato;

--
-- Name: libro; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE libro (
    id_producto text NOT NULL,
    titulo text NOT NULL,
    autor text NOT NULL
);


ALTER TABLE libro OWNER TO patronato;

--
-- Name: notificacion; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE notificacion (
    folio integer NOT NULL,
    id_cliente integer NOT NULL,
    monto integer NOT NULL,
    fecha date NOT NULL
);


ALTER TABLE notificacion OWNER TO patronato;

--
-- Name: notificacion_folio_seq; Type: SEQUENCE; Schema: public; Owner: patronato
--

CREATE SEQUENCE notificacion_folio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE notificacion_folio_seq OWNER TO patronato;

--
-- Name: notificacion_folio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: patronato
--

ALTER SEQUENCE notificacion_folio_seq OWNED BY notificacion.folio;


--
-- Name: pago; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE pago (
    id_notificacion integer NOT NULL,
    forma_pago text NOT NULL,
    status text NOT NULL
);


ALTER TABLE pago OWNER TO patronato;

--
-- Name: pedido; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE pedido (
    id_notificacion integer NOT NULL
);


ALTER TABLE pedido OWNER TO patronato;

--
-- Name: persona; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE persona (
    id integer NOT NULL,
    nombre text NOT NULL,
    apellido_paterno text NOT NULL,
    apellido_materno text DEFAULT ''::text NOT NULL,
    correo text NOT NULL
);


ALTER TABLE persona OWNER TO patronato;

--
-- Name: TABLE persona; Type: COMMENT; Schema: public; Owner: patronato
--

COMMENT ON TABLE persona IS 'Contiene a todas las personas involucradas en el sistema, clientes y administradores. El id es una secuencia';


--
-- Name: persona_id_seq; Type: SEQUENCE; Schema: public; Owner: patronato
--

CREATE SEQUENCE persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE persona_id_seq OWNER TO patronato;

--
-- Name: persona_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: patronato
--

ALTER SEQUENCE persona_id_seq OWNED BY persona.id;


--
-- Name: producto; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE producto (
    codigo_barras text NOT NULL,
    pais_origen text NOT NULL,
    precio_origen integer NOT NULL,
    proveedor integer NOT NULL,
    existencia integer NOT NULL,
    ganancia real NOT NULL
);


ALTER TABLE producto OWNER TO patronato;

--
-- Name: producto_notificacion; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE producto_notificacion (
    id_producto text NOT NULL,
    id_notificacion integer NOT NULL,
    cantidad integer NOT NULL
);


ALTER TABLE producto_notificacion OWNER TO patronato;

--
-- Name: proveedor; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE proveedor (
    id integer NOT NULL,
    nombre_proveedor text NOT NULL,
    direccion integer NOT NULL,
    rfc character(12)
);


ALTER TABLE proveedor OWNER TO patronato;

--
-- Name: proveedor_id_seq; Type: SEQUENCE; Schema: public; Owner: patronato
--

CREATE SEQUENCE proveedor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE proveedor_id_seq OWNER TO patronato;

--
-- Name: proveedor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: patronato
--

ALTER SEQUENCE proveedor_id_seq OWNED BY proveedor.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: patronato; Tablespace: 
--

CREATE TABLE usuario (
    id_persona integer,
    login_usuario character varying(30) NOT NULL,
    contrasena character varying(256) NOT NULL,
    salt character varying(256) NOT NULL,
    rol text NOT NULL,
    activo boolean,
    fecha_registro date,
    CONSTRAINT usuario_rol_check CHECK ((rol = ANY (ARRAY['Cliente'::text, 'Administrador'::text])))
);


ALTER TABLE usuario OWNER TO patronato;

--
-- Name: folio; Type: DEFAULT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY notificacion ALTER COLUMN folio SET DEFAULT nextval('notificacion_folio_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY persona ALTER COLUMN id SET DEFAULT nextval('persona_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY proveedor ALTER COLUMN id SET DEFAULT nextval('proveedor_id_seq'::regclass);


--
-- Data for Name: cd; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY cd (id_producto, artista, titulo, genero, cantidadsoundtracks) FROM stdin;
\.


--
-- Data for Name: cliente_contacto; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY cliente_contacto (id_cliente, id_direccion) FROM stdin;
\.


--
-- Data for Name: direccion; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY direccion (calle_numero, colonia, ciudad, cp, pais, id) FROM stdin;
\.


--
-- Name: direccion_id_sequence; Type: SEQUENCE SET; Schema: public; Owner: patronato
--

SELECT pg_catalog.setval('direccion_id_sequence', 2, true);


--
-- Data for Name: dvd; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY dvd (id_producto, titulo, duracion, genero, director) FROM stdin;
\.


--
-- Data for Name: envio; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY envio (id_notificacion, id_direccion, telefono, fecha_entrega) FROM stdin;
\.


--
-- Data for Name: libro; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY libro (id_producto, titulo, autor) FROM stdin;
\.


--
-- Data for Name: notificacion; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY notificacion (folio, id_cliente, monto, fecha) FROM stdin;
\.


--
-- Name: notificacion_folio_seq; Type: SEQUENCE SET; Schema: public; Owner: patronato
--

SELECT pg_catalog.setval('notificacion_folio_seq', 1, false);


--
-- Data for Name: pago; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY pago (id_notificacion, forma_pago, status) FROM stdin;
\.


--
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY pedido (id_notificacion) FROM stdin;
\.


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY persona (id, nombre, apellido_paterno, apellido_materno, correo) FROM stdin;
\.


--
-- Name: persona_id_seq; Type: SEQUENCE SET; Schema: public; Owner: patronato
--

SELECT pg_catalog.setval('persona_id_seq', 5, true);


--
-- Data for Name: producto; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY producto (codigo_barras, pais_origen, precio_origen, proveedor, existencia, ganancia) FROM stdin;
\.


--
-- Data for Name: producto_notificacion; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY producto_notificacion (id_producto, id_notificacion, cantidad) FROM stdin;
\.


--
-- Data for Name: proveedor; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY proveedor (id, nombre_proveedor, direccion, rfc) FROM stdin;
\.


--
-- Name: proveedor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: patronato
--

SELECT pg_catalog.setval('proveedor_id_seq', 1, false);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: patronato
--

COPY usuario (id_persona, login_usuario, contrasena, salt, rol, activo, fecha_registro) FROM stdin;
\.


--
-- Name: direccion_id; Type: CONSTRAINT; Schema: public; Owner: patronato; Tablespace: 
--

ALTER TABLE ONLY direccion
    ADD CONSTRAINT direccion_id PRIMARY KEY (id);


--
-- Name: notificacion_folio; Type: CONSTRAINT; Schema: public; Owner: patronato; Tablespace: 
--

ALTER TABLE ONLY notificacion
    ADD CONSTRAINT notificacion_folio PRIMARY KEY (folio);


--
-- Name: persona_id; Type: CONSTRAINT; Schema: public; Owner: patronato; Tablespace: 
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT persona_id PRIMARY KEY (id);


--
-- Name: producto_pkey; Type: CONSTRAINT; Schema: public; Owner: patronato; Tablespace: 
--

ALTER TABLE ONLY producto
    ADD CONSTRAINT producto_pkey PRIMARY KEY (codigo_barras);


--
-- Name: proveedor_id; Type: CONSTRAINT; Schema: public; Owner: patronato; Tablespace: 
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT proveedor_id UNIQUE (id);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: patronato; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (login_usuario);


--
-- Name: cliente_contacto_id_cliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY cliente_contacto
    ADD CONSTRAINT cliente_contacto_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES persona(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cliente_contacto_id_direccion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY cliente_contacto
    ADD CONSTRAINT cliente_contacto_id_direccion_fkey FOREIGN KEY (id_direccion) REFERENCES direccion(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: dvd_id_producto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY dvd
    ADD CONSTRAINT dvd_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES producto(codigo_barras) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: envio_id_notificacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY envio
    ADD CONSTRAINT envio_id_notificacion_fkey FOREIGN KEY (id_notificacion) REFERENCES notificacion(folio) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: libro_id_producto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY libro
    ADD CONSTRAINT libro_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES producto(codigo_barras) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: notificacion_id_cliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY notificacion
    ADD CONSTRAINT notificacion_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES persona(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pago_id_notificacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY pago
    ADD CONSTRAINT pago_id_notificacion_fkey FOREIGN KEY (id_notificacion) REFERENCES notificacion(folio) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pedido_id_notificacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT pedido_id_notificacion_fkey FOREIGN KEY (id_notificacion) REFERENCES notificacion(folio) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: producto_notificacion_id_notificacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY producto_notificacion
    ADD CONSTRAINT producto_notificacion_id_notificacion_fkey FOREIGN KEY (id_notificacion) REFERENCES notificacion(folio) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: producto_notificacion_id_producto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY producto_notificacion
    ADD CONSTRAINT producto_notificacion_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES producto(codigo_barras) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: producto_proveedor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY producto
    ADD CONSTRAINT producto_proveedor_fkey FOREIGN KEY (proveedor) REFERENCES proveedor(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: proveedor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: patronato
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT proveedor_id_fkey FOREIGN KEY (id) REFERENCES persona(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: patronato
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM patronato;
GRANT ALL ON SCHEMA public TO patronato;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PatronatoQL database dump complete
--

