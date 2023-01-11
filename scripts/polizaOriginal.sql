create database poliza;
use  poliza;

/*INICIACION DE LA BASE DE DATOS*/
create table ROLES(
idRoles int not null primary key auto_increment,
roles varchar(100)
);

create table DIRECCIONES_NACIONALES(
idDnac int not null primary key auto_increment,
nom_dnac varchar (150) not null
);

 
create table DEPARTAMENTOS(
idDepto int not null primary key auto_increment,
nom_depto varchar (150) not null
);

create table UNIDADES_OPERATIVAS(
idUnoperativa int not null primary key auto_increment,
nom_unoperativa varchar (150) not null,
idDepto int,
idDnac int,
foreign key(idDepto)
references DEPARTAMENTOS(idDepto),
foreign key(idDnac)
references DIRECCIONES_NACIONALES(idDnac)
);
 

Create table USUARIOS(
idUsuarios int not null primary key auto_increment,
idRoles int,
nombre varchar(150),
username varchar(150),
contrasena varchar(50),
correo varchar(150),
idUnoperativa int,
foreign key (idRoles)
references ROLES(idRoles),
foreign key (idUnoperativa)
references UNIDADES_OPERATIVAS(idUnoperativa)
);

create table RUBROS(
idRubros int not null primary key auto_increment,
nomb_Rubros varchar(150) not null
);

create table ESPECIFICOS(
idEspecifico int not null primary key auto_increment,
nomb_Especifico varchar(150) not null,
idRubros int,
foreign key (idRubros)
references RUBROS(idRubros)
);

create table BANCOS(
idBancos int not null primary key auto_increment,
nomb_Bancos varchar(100) not null,
num_cuenta varchar(150) not null,
idUnoperativa int,
foreign key(idUnoperativa)
references UNIDADES_OPERATIVAS(idUnoperativa)
);

create table TIPOS_DE_TRANSACCIONES(
idTip_Transaccion int not null primary key auto_increment,
tipoTransacciones varchar(100) not null
);



create table ESTADOS(
idEstado int not null primary key auto_increment,
tipo_Estado varchar(40) not null
);


create table TIPOS_DE_POLIZAS(
idTip_Poliza int not null primary key auto_increment,
tipo_poliza varchar (150) not null 
);




create table TIPOS_DE_SUMINISTRANTE(
idTipoSuministrante int not null primary key auto_increment,
tipo_suminist varchar (150) not null
);

create table SUMINISTRANTES_SB(
idSuminis_SB int not null primary key auto_increment,
nom_suminist varchar (150) not null,
idTipoSuministrante int,
foreign key (idTipoSuministrante)
references TIPOS_DE_SUMINISTRANTE(idTipoSuministrante)
);
 
 create table ENCABEZADO(
idPoliza int not null primary key auto_increment,
idUsuarios int,
idSuminis_SB int,
num_Poliza Varchar(150),
ejercicio int,
cod_presupuestario varchar (150),
fec_crear date,
idEstado int,
idTip_Poliza int,
montoTotal decimal(19,2),
foreign key(idUsuarios)
references USUARIOS(idUsuarios),
foreign key(idEstado)
references ESTADOS(idEstado),
foreign key(idSuminis_SB)
references SUMINISTRANTES_SB(idSuminis_SB),
foreign key(idTip_Poliza)
references TIPOS_DE_POLIZAS(idTip_Poliza)
); 


 create table PAGOS_REINTEGROS(
idPago_Reint int not null primary key auto_increment,
idPoliza int,
fechaPago date,
fechaActual date,
total decimal(19,2),
num_Documento int,
idTip_Transaccion int,
idBancos int,
foreign key(idTip_Transaccion)
references TIPOS_DE_TRANSACCIONES(idTip_Transaccion),
foreign key (idPoliza)
references ENCABEZADO(idPoliza),
foreign key (idBancos)
references BANCOS(idBancos)
);


create table POLIZAS_FCMF(
idPoliza_FCMF int not null primary key auto_increment,
idPoliza int,
no_Documento int,
fechaDoc date not null,
idTip_Transaccion int,
idBancos int,
foreign key (idPoliza)
references ENCABEZADO(idPoliza),
foreign key(idTip_Transaccion)
references TIPOS_DE_TRANSACCIONES(idTip_Transaccion),
foreign key (idBancos)
references BANCOS(idBancos)
);

create table SERVICIOS_DE_SUMINISTRANTES(
idServicio int not  null primary key auto_increment,
nomb_suministrabte varchar(100) not null,
tipoServicio varchar(150) not null
);


create table SUMINISTRANTE_FCMF(
idSuminis_FCMF int not null primary key auto_increment,
monto double,
idEspecifico int,
idPoliza_FCMF int,
idServicio int,
 foreign key(idEspecifico)
 references ESPECIFICOS(idEspecifico),
 foreign key (idPoliza_FCMF)
 references POLIZAS_FCMF(idPoliza_FCMF),
 foreign key(idServicio)
 references SERVICIOS_DE_SUMINISTRANTES(idServicio)
);





 create table MEDIDORES(
idMedidor int not null primary key auto_increment,
num_Medidor varchar(40),
idUnoperativa int,
idSuminis_SB int,
foreign key(idUnoperativa)
references UNIDADES_OPERATIVAS(idUnoperativa),
foreign key(idSuminis_SB)
references SUMINISTRANTES_SB(idSuminis_SB)
);

create table MESES(
idMes int not null primary key auto_increment,
mes Varchar(20)
);

create table POLIZA_SB(
idPoliza_SB int not null primary key auto_increment,
idPoliza int,
idMedidor int,
num_doc_resp int not null,
idMes int,
fecha_doc date not null,
valor_doc decimal(19,2) not null,
foreign key (idPoliza)
references ENCABEZADO(idPoliza),
foreign key(idMedidor)
references MEDIDORES(idMedidor),
foreign key(idMes)
references MESES(idMes)
);
/*Direcciones nacionales*/
insert into DIRECCIONES_NACIONALES(nom_dnac) values('CD lOURDES');
/*Departamento*/
insert into DEPARTAMENTOS(nom_depto) values('La Libertad');
/*Unidades Operativas*/
insert into UNIDADES_OPERATIVAS(nom_unoperativa,idDepto,idDnac) values('Informatica','1','1');
/*ROLES*/
insert into ROLES(roles) value('Administrador');
insert into ROLES(roles) value('Tecnico');
insert into ROLES(roles) value('Jefe');
/*MESES*/
insert into MESES(mes) value('Enero');
insert into MESES(mes) value('Febrero');
insert into MESES(mes) value('Marzo');
insert into MESES(mes) value('Abril');
insert into MESES(mes) value('Mayo');
insert into MESES(mes) value('Junio');
insert into MESES(mes) value('Julio');
insert into MESES(mes) value('Agosto');
insert into MESES(mes) value('Septiembre');
insert into MESES(mes) value('Octubre');
insert into MESES(mes) value('Noviembre');
insert into MESES(mes) value('Diciembre');


/*Estado*/
insert into ESTADOS(tipo_estado) values('Iniciado');
insert into ESTADOS(tipo_estado) values('Finalizado');

/*TIPO POLIZA*/
insert into TIPOS_DE_POLIZAS(tipo_poliza) values('Servicio Basico');
insert into TIPOS_DE_POLIZAS(tipo_poliza) values('Fondo Circulante');
/*USUARIO*/
INSERT INTO USUARIOS(idRoles,nombre,username,contrasena,correo, idUnoperativa) values('1','Elida Natali Flores','Natali','1234','elidafloresc.27@gmail.com','1');
/*TIPO DE TRANSACCION*/
INSERT INTO TIPOS_DE_TRANSACCIONES(tipoTransacciones) values('cheque')

