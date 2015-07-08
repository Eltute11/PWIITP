DROP DATABASE IF EXISTS Seguridadlandia;
CREATE DATABASE Seguridadlandia;
USE Seguridadlandia;


CREATE TABLE TIPOS_DOCUMENTOS (
    cod_tipdoc NUMERIC(2) NOT NULL,
    descr_tipdoc VARCHAR(20) NOT NULL,
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
	id_perfil		 NUMERIC (10) NOT NULL,
    cod_tiporol      NUMERIC(2) NOT NULL,
	cod_tipdoc		 NUMERIC (2)  NOT NULL,
	nro_doc			 NUMERIC (11) NOT NULL,
	nombres			 VARCHAR (30) NOT NULL,
	apellidos		 VARCHAR (30) NOT NULL,
	fecha_nac		 DATE	  NOT NULL,
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
    -- PRIMARY KEY (cod_tiporol,id_perfil),
    PRIMARY KEY (id_perfil),
    FOREIGN KEY (cod_tiporol) REFERENCES TIPOS_ROLES(cod_tiporol),
	FOREIGN KEY (cod_tipdoc) REFERENCES TIPOS_DOCUMENTOS(cod_tipdoc),
	FOREIGN KEY (cod_pais)   REFERENCES PAISES(cod_pais),
	FOREIGN KEY (cod_prov)   REFERENCES PROVINCIAS(cod_prov),
	FOREIGN KEY (cod_loc)    REFERENCES LOCALIDADES(cod_loc)
)AUTO_INCREMENT=1 ;	


INSERT INTO PERFILES ( cod_tiporol,       id_perfil,         cod_tipdoc,        
					   nro_doc,           nombres,           apellidos,         
					   fecha_nac,         cod_pais,          cod_prov,          
					   cod_loc,           direccion,         num_direccion,     
					   sexo,              telefono_1,        telefono_2,        
					   direccion_email)

			 VALUES ( 1,                            1,                            1,                            
					  35951529,                     'Juan Ignacio',               'Urcola',                     
					  '19921014',                   1,                            1,                            
					  1,                            'Scalabrini Ortiz',           525,                          
					  'M',                          1133443344,                   NULL,                         
					  'juanig.urcola@gmail.com');
                      
                      

-- CUANDO EL CLIENTE SE DÉ DE ALTA COMO USUARIO, SE ENVIARA 3 POR DEFECTO EN cod_tiporol.
-- CUANDO EL ADMINTRADOR DE DE ALTA A UN MONITOREADOR O A OTRO ADMINISTAOR, SE ENVIARA 2 Y 3 CORRESPONDIETNMENTE. 



CREATE TABLE USUARIOS (
    id_perfil NUMERIC(10) NOT NULL,
    cod_tiporol NUMERIC(2) NOT NULL,
    usuario VARCHAR(30) NOT NULL,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY (usuario),
    FOREIGN KEY (id_perfil)
     REFERENCES PERFILES (id_perfil)
);

INSERT INTO USUARIOS (cod_tiporol,id_perfil, usuario, password) VALUES	 (1,1,'jurcola','202cb962ac59075b964b07152d234b70');

CREATE TABLE CAMARAS
 (  
	id_cliente NUMERIC (10) NOT NULL,
    id_camara      INT NOT NULL AUTO_INCREMENT,
    -- cod_tiporol    NUMERIC (2)  NOT NULL DEFAULT 3,
	-- id_cliente     NUMERIC (10) NOT NULL,
    descripcion    VARCHAR (30) NULL,
    disponibilidad NUMERIC(1) NOT NULL, -- 1: DISPONIBLE 0: NO DISPONIBLE.  CAMPO QUE HABILITA SI MONITOREADOR PUEDE VISUALZIAR LA MISMA O NO.
	
	PRIMARY KEY  (id_camara),
    -- FOREIGN KEY (cod_tiporol,id_cliente) REFERENCES PERFILES (cod_tiporol,id_perfil)
    FOREIGN KEY (id_cliente) REFERENCES PERFILES (id_perfil)
 
 )AUTO_INCREMENT=1000 ;


CREATE TABLE PRODUCTOS_SISTEMA
 (  cod_prod     INT NOT NULL AUTO_INCREMENT,
    descr_prod   VARCHAR (100) NOT NULL,
	precio       DECIMAL (12,2) NOT NULL,
	stock        NUMERIC (10) NULL,
	obligatorio  NUMERIC (1) NULL,
    permite_cant NUMERIC (1) NULL,
	PRIMARY KEY (cod_prod)
  )AUTO_INCREMENT=000 ;

INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Costo de instalacion',3000,20,1,0);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Router centralizador de seguridad',1800,10,1,0);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Alarma blindada',3700,10,1,0);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Bateria de sistema de seguridad',850,10,1,0);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Sensores de presencia',550,10,1,1);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Sensores de cierre de aperturas',750,10,1,1);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Camaras IP',1100,10,0,1);
INSERT INTO PRODUCTOS_SISTEMA (descr_prod, precio,stock,obligatorio,permite_cant) VALUES ('Comunicador 3G',2500,10,0,1);


CREATE TABLE ALARMA_CLIENTE 
 (  
	id_cliente NUMERIC (10) NOT NULL,
    cod_alarma		 INT AUTO_INCREMENT, 
    -- id_cliente		 NUMERIC (10) NOT NULL, -- POR MEDIO DE ESTE CAMPO y cod_tiporol = 3, SE OBTIENEN TODOS LOS DATOS DEL CLIENTE DE LA TABLA PERFILES.
    -- cod_tiporol		 NUMERIC (2)  NOT NULL DEFAULT 3,
	cod_desbloqueo   VARCHAR(40) NOT NULL,
	estado			 VARCHAR (1)  NOT NULL, -- E: REPOSO - A: ALARMA - B:ALARMA DISPARADA REMOTAMENTE POR EL CLIENTE - C: ALARMA DISPARADA POR EL MONITOREADOR

	PRIMARY KEY (cod_alarma),
	-- FOREIGN KEY (cod_tiporol,id_cliente) REFERENCES PERFILES (cod_tiporol,id_perfil)
    FOREIGN KEY (id_cliente) REFERENCES PERFILES (id_perfil)
 
 )AUTO_INCREMENT=1 ;



CREATE TABLE HIST_ALARMA_CLIENTE
 (  
	cod_alarma_hist	 INT NOT NULL,
	id_cliente       INT NOT NULL,
    fecha_hora		 DATETIME , -- FECHA  Y HORA QUE FUE ACTIVADA
	real_falsa       VARCHAR (1) NOT NULL ,-- 'R' = REAL   'F'= FALSA	
	
	FOREIGN KEY (cod_alarma_hist) REFERENCES ALARMA_CLIENTE (cod_alarma)
 
 );


 -- DROP TABLE FACTURA_DET;
 --  DROP TABLE FACTURA_CAB;
CREATE TABLE FACTURA_CAB 
 (  
	id_cliente		  NUMERIC (10) NOT NULL, 
    nro_fact		  INT NOT NULL, 
    fecha_vencimiento DATE NOT NULL,
    estado_pago       NUMERIC(1) NOT NULL, -- 1:PAGO - 0:NO PAGO
    total_fact        NUMERIC(10)  NOT NULL,
	PRIMARY KEY (nro_fact),
	FOREIGN KEY (id_cliente) REFERENCES PERFILES (id_perfil)
 
 )AUTO_INCREMENT=1 ;
 
 
 CREATE TABLE FACTURA_DET
 (	
   nro_fact    INT NOT NULL,
   nro_subfact INT NOT NULL,
   id_cliente  INT NOT NULL,
   cod_prod    INT NULL,
   cantidad    INT NULL,
   imp_total   DECIMAL(10,2) NULL, -- IMPORTE TOTAL DEL PRODUCTO EN PARTICUALR POR CANTIDAD, NO EL TOTAL DE LA FACTURA.
   
   UNIQUE (nro_fact,nro_subfact),
   FOREIGN KEY (nro_fact) REFERENCES FACTURA_CAB (nro_fact),
   FOREIGN KEY (cod_prod) REFERENCES PRODUCTOS_SISTEMA (cod_prod)
   
   
 );
 
 -- ===============================================================================================================================================
 -- EN CASO DE SER LA PRIMERA AL GENERARSE LA FACTURA SE DEBERA SUMAR EL IMPORTE TOTAL DE LOS PRODUCTOS + EL VALOR_SERVICIO DE LA TABLA FACTURA
 -- EN CASO DE SER UNA FACTURA QUE NO SEA LA PRIMERA, SOLO DEBERA COBRAR EL SERVICVIO.
 -- =================================================================================================================================================

