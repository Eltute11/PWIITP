CREATE DATABASE IF NOT EXISTS Seguralandia;
USE Seguralandia;


DROP TABLE IF EXISTS  HISTORIAL_ALARMAS;
DROP TABLE IF EXISTS  ALARMAS;
DROP TABLE IF EXISTS  PRODUCTOS_SISTEMA;
DROP TABLE IF EXISTS  CAMARAS;
DROP TABLE IF EXISTS  USUARIOS;
DROP TABLE IF EXISTS  PERSONAS;
DROP TABLE IF EXISTS  TIPOS_PERSONAS;
DROP TABLE IF EXISTS  LOCALIDADES;
DROP TABLE IF EXISTS  PROVINCIAS;
DROP TABLE IF EXISTS  PAISES;
DROP TABLE IF EXISTS TIPOS_DOCUMENTOS;

CREATE TABLE TIPOS_DOCUMENTOS 
(
	cod_tipdoc NUMERIC(2)	 NOT NULL,
	descr_tipdoc VARCHAR (20) NOT NULL,	
	PRIMARY KEY (cod_tipdoc)
);

INSERT INTO TIPOS_DOCUMENTOS VALUES (1, 'DNI');


CREATE TABLE PAISES (
    cod_pais INT NOT NULL AUTO_INCREMENT,
    descr_pais VARCHAR(30) NOT NULL,
    PRIMARY KEY (cod_pais)
)  AUTO_INCREMENT=1;

INSERT INTO PAISES (descr_pais) VALUES ('Argentina');

CREATE TABLE PROVINCIAS
(
	cod_prov  INT NOT NULL AUTO_INCREMENT,
	descr_prov  VARCHAR (30) NOT NULL,
	cod_pais  INT NOT NULL,
	PRIMARY KEY (cod_prov),
	FOREIGN KEY (cod_pais) REFERENCES PAISES(cod_pais)
)AUTO_INCREMENT=1 ;


INSERT INTO PROVINCIAS (descr_prov, cod_pais) VALUES ('Buenos Aires',1);
INSERT INTO PROVINCIAS (descr_prov, cod_pais) VALUES ('Cordoba',1);


CREATE TABLE LOCALIDADES
(
	cod_loc    INT NOT NULL AUTO_INCREMENT,
	descr_loc  VARCHAR (30) NOT NULL,
	cod_prov   INT NOT NULL,
	UNIQUE  (descr_loc,cod_prov),
    PRIMARY KEY (cod_loc),
	FOREIGN KEY (cod_prov) REFERENCES PROVINCIAS(cod_prov)

)AUTO_INCREMENT=1 ;


INSERT INTO LOCALIDADES (descr_loc,cod_prov) VALUES ('San Antonio de Padua',1);
INSERT INTO LOCALIDADES (descr_loc,cod_prov) VALUES ('Castelar',1);


CREATE TABLE TIPOS_PERSONAS
(
   cod_tipper   NUMERIC(2) NOT NULL ,
   descr_tipper VARCHAR (30) NOT NULL, 
   PRIMARY KEY (cod_tipper)

);

INSERT INTO TIPOS_PERSONAS VALUES (1,'Administrador');
INSERT INTO TIPOS_PERSONAS VALUES (2,'Monitoreador');
INSERT INTO TIPOS_PERSONAS VALUES (3,'Clientes');
INSERT INTO TIPOS_PERSONAS VALUES (4,'Personal Seguridad');




CREATE TABLE PERSONAS 
(  
	cod_tipper       NUMERIC(2) NOT NULL,
	id_persona		 NUMERIC (10) NOT NULL,
	cod_tipdoc		 NUMERIC (2)  NOT NULL,
	nro_doc			 NUMERIC (11) NOT NULL,
	nombres			 VARCHAR (30) NOT NULL,
	apellidos		 VARCHAR (30) NOT NULL,
	fecha_nac		 DATETIME	  NOT NULL,
	cod_pais		 INT NOT NULL,
	cod_prov		 INT NOT NULL,
	cod_loc			 INT NOT NULL,
	direccion		 VARCHAR (30) NOT NULL,
    num_direccion	 NUMERIC (6)  NOT NULL,
	sexo			 VARCHAR (1)  NOT NULL,
	telefono_1		 NUMERIC (15) NOT NULL,	
	telefono_2		 NUMERIC (15) NULL,
	direccion_email  VARCHAR (40) NULL,
	disponibilidad   NUMERIC (1)  NULL,   -- 1:DISPONIBLE 0: NO DISPONIBLE // CAMPO UNICAMENTE PARA PERSONAL DE SEGURIDAD

	UNIQUE (cod_tipper,cod_tipdoc,nro_doc),
    PRIMARY KEY (cod_tipper,id_persona),
    FOREIGN KEY (cod_tipper) REFERENCES TIPOS_PERSONAS(cod_tipper),
	FOREIGN KEY (cod_tipdoc) REFERENCES TIPOS_DOCUMENTOS(cod_tipdoc),
	FOREIGN KEY (cod_pais)   REFERENCES PAISES(cod_pais),
	FOREIGN KEY (cod_prov)   REFERENCES PROVINCIAS(cod_prov),
	FOREIGN KEY (cod_loc)    REFERENCES LOCALIDADES(cod_loc)
)AUTO_INCREMENT=1 ;	

-- CUANDO EL CLIENTE SE DÉ DE ALTA COMO USUARIO, SE ENVIARA 3 POR DEFECTO EN COD_TIPPER.
-- CUANDO EL ADMINTRADOR DE DE ALTA A UN MONITOREADOR O A OTRO ADMINISTAOR, SE ENVIARA 2 Y 3 CORRESPONDIETNMENTE. 



CREATE TABLE USUARIOS 
(
	cod_tipper NUMERIC(2) NOT NULL,
	id_persona NUMERIC(10) NOT NULL,
	usuario    VARCHAR (30) NOT NULL,
	password   VARCHAR (40) NOT NULL,
	
	PRIMARY KEY (usuario),
	FOREIGN KEY (cod_tipper,id_persona) REFERENCES PERSONAS (cod_tipper,id_persona)

);

CREATE TABLE CAMARAS
 (  
	cod_tipper NUMERIC (2)  NOT NULL DEFAULT 3,
	id_cliente NUMERIC (10) NOT NULL,
	id_camara  INT AUTO_INCREMENT,
	IP_camara  VARCHAR (20) NOT NULL,
	disponibilidad NUMERIC(1) NOT NULL, -- 1: DISPONIBLE 0: NO DISPONIBLE.  CAMPO QUE HABILITA SI MONITOREADOR PUEDE VISUALZIAR LA MISMA O NO.
	
	UNIQUE KEY  (id_camara),
    PRIMARY KEY (IP_camara),
	FOREIGN KEY (cod_tipper,id_cliente) REFERENCES PERSONAS (cod_tipper,id_persona)
 
 )AUTO_INCREMENT=1000 ;




CREATE TABLE PRODUCTOS_SISTEMA
 (  cod_prod   INT NOT NULL AUTO_INCREMENT,
    descr_prod VARCHAR (100) NOT NULL,
	precio     DECIMAL (12,2) NOT NULL,
	stock      NUMERIC (10) NOT NULL,
	
	PRIMARY KEY (cod_prod)
  )AUTO_INCREMENT=1 ;

INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Router centralizador de seguridad',100,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Alarma blindada',100,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Batería de sistema de seguridad',100,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Sensores de presencia',100,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Sensores de cierre de aperturas',100,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Camaras IP',100,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Comunicador 3G',100,10);


/*
UNA IDEA PARA LAS FACTUAS ES GUARDAR UN NUMERO DE FACTURA X Y UN NRO SUB FACTURA.

NRO_FACT  NRO_SUBFACT   CLIENTE  PRODUCTO
	1		 0				11		1
	1		 1				11		3
	1		 2				11		4

CON EL FIN DE GUARDAR TODO EN UN MISMO NUMERO DE FACTURA 

CREATE TABLE FACTURAS 
 (  
	nro_fact    NUMERIC(10)NOT NULL AUTO_INCREMENT
  nro_subfact NUMERIC(3) NOT NULL 
	cod_tipper  NUMERIC (2)  NOT NULL DEFAULT 3,
	id_cliente  NUMERIC (10) NOT NULL, -- POR MEDIO DE ESTE CAMPO y COD_TIPPER = 3, SE OBTIENEN TODOS LOS DATOS DEL CLIENTE DE LA TABLA PERSONAS.
	fecha_venci DATETIME NOT NULL,
	estado_pago NUMERIC(1) NOT NULL -- 1:PAGO - 0:NO PAGO


	PRIMARY KEY (numero_fact),
	FOREIGN KEY (cod_tipper,id_cliente) REFERENCES PERSONAS (cod_tipper,id_persona)
 
 )

*/

CREATE TABLE ALARMAS_HOGAR 
 (  
	cod_tipper		 NUMERIC (2)  NOT NULL DEFAULT 3,
	id_cliente		 NUMERIC (10) NOT NULL, -- POR MEDIO DE ESTE CAMPO y COD_TIPPER = 3, SE OBTIENEN TODOS LOS DATOS DEL CLIENTE DE LA TABLA PERSONAS.
	cod_alarma		 INT AUTO_INCREMENT, 
	cod_desbloqueo   NUMERIC (10) NOT NULL, 
	estado			 NUMERIC (1)  NOT NULL, -- 1:ACTIVADA 0:DESACTIVADA

	PRIMARY KEY (cod_alarma),
	FOREIGN KEY (cod_tipper,id_cliente) REFERENCES PERSONAS (cod_tipper,id_persona)
 
 )AUTO_INCREMENT=1 ;


CREATE TABLE HISTORIAL_ALARMAS_HOGAR 
 (  
	cod_tipper		 NUMERIC (2)  NOT NULL,
	id_cliente		 NUMERIC (10) NOT NULL, -- POR MEDIO DE ESTE CAMPO y COD_TIPPER = 3, SE OBTIENEN TODOS LOS DATOS DEL CLIENTE DE LA TABLA PERSONAS.
	cod_alarma_hist	 INT NOT NULL,
	fecha_hora		 DATETIME , -- FECHA  Y HORA QUE FUE ACTIVADA
	real_falsa       VARCHAR (1) NOT NULL ,-- 'R' = REAL   'F'= FALSA	
	
	FOREIGN KEY (cod_alarma_hist) REFERENCES ALARMAS_HOGAR (cod_alarma)
 
 );


