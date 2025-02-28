create database trabalhoLairce



create table usuario
(
idusuario int auto_increment primary key,
nome varchar(50) not null,
telefone varchar(15) not null, 
email varchar(30) not null unique,
senha varchar(15) not null,
ramoatividade varchar(50)
)

create table administrador 
(
idadmin int auto_increment primary key,
idusuario int not null,
foreign key (idusuario) references usuario (idusuario)
)


create table plano
(
idplano int auto_increment primary key,
descricao varchar(50),
preco decimal(10,2)
)

create table publicacao
(
idpublic int auto_increment primary key,
texto varchar (100)not null,
data date not null,
status varchar(30),
tipo varchar(30),
idusuario int not null,
foreign key (idusuario) references usuario (idusuario)

)

create table fotosvideos
(
idfoto int auto_increment primary key,
foto blob not null,
video blob,
idpublic int not null,
foreign key (idpublic) references publicacao (idpublic)
)

create table usuarioplano
(
idplano int not null references plano(idplano),
idusuario int not null,
foreign key (idusuario) references usuario (idusuario)
)

create table pagamentomensal
(
idpgto int auto_increment primary key,
data date not null,
tipo varchar(30),
valor decimal(10,2),
idplano int not null, 
idusuario int not null,
foreign key (idplano) references plano (idplano),
foreign key (idusuario) references usuario (idusuario)

)

select * from usuario

select * from publicacao

insert into plano (descricao, preco) values ('planomensal', '10');

select * from plano
