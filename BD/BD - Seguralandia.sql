DROP DATABASE IF EXISTS Seguralandia;
CREATE DATABASE Seguralandia;
USE Seguralandia;


CREATE TABLE TIPOS_DOCUMENTOS 
(
	cod_tipdoc NUMERIC(2)	 NOT NULL,
	descr_tipdoc VARCHAR (20) NOT NULL,	
	PRIMARY KEY (cod_tipdoc)
);

INSERT INTO TIPOS_DOCUMENTOS VALUES (1, 'DNI');
INSERT INTO TIPOS_DOCUMENTOS VALUES (2, 'L.E');
INSERT INTO TIPOS_DOCUMENTOS VALUES (3, 'L.C');

CREATE TABLE PAISES (
    cod_pais INT NOT NULL AUTO_INCREMENT,
    descr_pais VARCHAR(30) NOT NULL,
    PRIMARY KEY (cod_pais)
)  AUTO_INCREMENT=1;

INSERT INTO PAISES (descr_pais) VALUES ('Argentina');
INSERT INTO PAISES (descr_pais) VALUES ('Chile');
INSERT INTO PAISES (descr_pais) VALUES ('Uruguay');

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
INSERT INTO PROVINCIAS (descr_prov, cod_pais) VALUES ('Santigo',2);
INSERT INTO PROVINCIAS (descr_prov, cod_pais) VALUES ('Melipilla',2);
INSERT INTO PROVINCIAS (descr_prov, cod_pais) VALUES ('Montevideo',3);
INSERT INTO PROVINCIAS (descr_prov, cod_pais) VALUES ('Punta del Este',3);


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
INSERT INTO LOCALIDADES (descr_loc,cod_prov) VALUES ('Ituzaingo',1);


CREATE TABLE TIPOS_ROLES
(
   cod_tiporol  NUMERIC(2) NOT NULL ,
   descr_tipper VARCHAR (30) NOT NULL, 
   PRIMARY KEY (cod_tiporol)

);

INSERT INTO TIPOS_ROLES VALUES (1,'Administrador');
INSERT INTO TIPOS_ROLES VALUES (2,'Monitoreador');
INSERT INTO TIPOS_ROLES VALUES (3,'Clientes');


CREATE TABLE PERFILES 
(  
	cod_tiporol      NUMERIC(2) NOT NULL,
	id_perfil		 NUMERIC (10) NOT NULL,
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
	
	UNIQUE (cod_tiporol,cod_tipdoc,nro_doc),
    PRIMARY KEY (cod_tiporol,id_perfil),
    FOREIGN KEY (cod_tiporol) REFERENCES TIPOS_ROLES(cod_tiporol),
	FOREIGN KEY (cod_tipdoc) REFERENCES TIPOS_DOCUMENTOS(cod_tipdoc),
	FOREIGN KEY (cod_pais)   REFERENCES PAISES(cod_pais),
	FOREIGN KEY (cod_prov)   REFERENCES PROVINCIAS(cod_prov),
	FOREIGN KEY (cod_loc)    REFERENCES LOCALIDADES(cod_loc)
)AUTO_INCREMENT=1 ;	

-- CUANDO EL CLIENTE SE DÉ DE ALTA COMO USUARIO, SE ENVIARA 3 POR DEFECTO EN cod_tiporol.
-- CUANDO EL ADMINTRADOR DE DE ALTA A UN MONITOREADOR O A OTRO ADMINISTAOR, SE ENVIARA 2 Y 3 CORRESPONDIETNMENTE. 



CREATE TABLE USUARIOS 
(
	cod_tiporol NUMERIC(2) NOT NULL,
	id_perfil NUMERIC(10) NOT NULL,
	usuario    VARCHAR (30) NOT NULL,
	password   VARCHAR (40) NOT NULL,
	
	PRIMARY KEY (usuario),
	FOREIGN KEY (cod_tiporol,id_perfil) REFERENCES PERFILES (cod_tiporol,id_perfil)

);

CREATE TABLE CAMARAS
 (  
	id_camara      INT NOT NULL AUTO_INCREMENT,
    cod_tiporol    NUMERIC (2)  NOT NULL DEFAULT 3,
	id_cliente     NUMERIC (10) NOT NULL,
    descripcion    VARCHAR (30) NULL,
    disponibilidad NUMERIC(1) NOT NULL, -- 1: DISPONIBLE 0: NO DISPONIBLE.  CAMPO QUE HABILITA SI MONITOREADOR PUEDE VISUALZIAR LA MISMA O NO.
	
	PRIMARY KEY  (id_camara),
    FOREIGN KEY (cod_tiporol,id_cliente) REFERENCES PERFILES (cod_tiporol,id_perfil)
 
 )AUTO_INCREMENT=1000 ;


CREATE TABLE PRODUCTOS_SISTEMA
 (  cod_prod   INT NOT NULL AUTO_INCREMENT,
    descr_prod VARCHAR (100) NOT NULL,
	precio     DECIMAL (12,2) NOT NULL,
	stock      NUMERIC (10) NULL,
	
	PRIMARY KEY (cod_prod)
  )AUTO_INCREMENT=0 ;

INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Costo de instalacion',3000,NULL);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Router centralizador de seguridad',1800,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Alarma blindada',3700,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Batería de sistema de seguridad',850,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Sensores de presencia',550,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Sensores de cierre de aperturas',750,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Camaras IP',1100,10);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock) VALUES ('Comunicador 3G',2500,10);


CREATE TABLE ALARMAS_HOGAR 
 (  
	cod_alarma		 INT AUTO_INCREMENT, 
    cod_tiporol		 NUMERIC (2)  NOT NULL DEFAULT 3,
	id_cliente		 NUMERIC (10) NOT NULL, -- POR MEDIO DE ESTE CAMPO y cod_tiporol = 3, SE OBTIENEN TODOS LOS DATOS DEL CLIENTE DE LA TABLA PERFILES.
	cod_desbloqueo   NUMERIC (10) NOT NULL, 
	estado			 NUMERIC (1)  NOT NULL, -- 1:ACTIVADA 0:DESACTIVADA

	PRIMARY KEY (cod_alarma),
	FOREIGN KEY (cod_tiporol,id_cliente) REFERENCES PERFILES (cod_tiporol,id_perfil)
 
 )AUTO_INCREMENT=1 ;


CREATE TABLE HIST_ALARMAS_HOGAR 
 (  
	cod_alarma_hist	 INT NOT NULL,
	fecha_hora		 DATETIME , -- FECHA  Y HORA QUE FUE ACTIVADA
	real_falsa       VARCHAR (1) NOT NULL ,-- 'R' = REAL   'F'= FALSA	
	
	FOREIGN KEY (cod_alarma_hist) REFERENCES ALARMAS_HOGAR (cod_alarma)
 
 );

/*

CREATE TABLE FACTURA_CAB 
 (  
	nro_fact		  INT AUTO_INCREMENT, 
    cod_tiporol		  NUMERIC (2)  NOT NULL DEFAULT 3,
	id_cliente		  NUMERIC (10) NOT NULL, -- POR MEDIO DE ESTE CAMPO y cod_tiporol = 3, SE OBTIENEN TODOS LOS DATOS DEL CLIENTE DE LA TABLA PERFILES.
    fecha_vencimiento DATETIME NOT NULL,
    SiNo_Mensual	  NUMERIC(1) NOT NULL, -- SI = 1 , NO = 0. QUE NO SEA MENSUAL; SIGNIFICA QUE ES LA PRIMER FACTURA GENERADA AL CONTRATAR EL SERVICIO 
										   -- TENER EN CUENTA EL COSTO POR INSTALACION.		
	Valor_Servicio 	   DECIMAL(10,2) NULL,
    estado_pago       NUMERIC(1) NOT NULL, -- 1:PAGO - 0:NO PAGO
	
	PRIMARY KEY (nro_fact),
	FOREIGN KEY (cod_tiporol,id_cliente) REFERENCES PERFILES (cod_tiporol,id_perfil)
 
 )AUTO_INCREMENT=1 ;
 
 
 
 CREATE TABLE FACTURA_DET
 (
   nro_fact    INT NOT NULL,
   nro_subfact INT NOT NULL,
   cod_prod    INT NULL,
   cantidad    INT NULL,
   imp_total   DECIMAL(10,2) NULL, -- IMPORTE TOTAL DEL PRODUCTO EN PARTICUALR POR CANTIDAD, NO EL TOTAL DE LA FACTURA.
   
   PRIMARY KEY (nro_fact,nro_subfact),
   FOREIGN KEY (nro_fact) REFERENCES FACTURA_CAB (nro_fact),
   FOREIGN KEY (cod_prod) REFERENCES PRODUCTOS_SISTEMA (cod_prod)
   
   
 )
 
 -- ===============================================================================================================================================
 -- EN CASO DE SER LA PRIMERA AL GENERARSE LA FACTURA SE DEBERA SUMAR EL IMPORTE TOTAL DE LOS PRODUCTOS + EL VALOR_SERVICIO DE LA TABLA FACTURA
 -- EN CASO DE SER UNA FACTURA QUE NO SEA LA PRIMERA, SOLO DEBERA COBRAR EL SERVICVIO.
 -- =================================================================================================================================================

*/


