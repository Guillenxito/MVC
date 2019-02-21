drop table if exists noticias;

create table noticias(
    id int auto_increment,
    titulo varchar(30) not null,
    texto varchar (255) not null,
    fecha date not null,
    primary key(id)
);


-- Tabla Noticia
drop table if exists noticia;

create table noticia(
    id int auto_increment,
    titulo varchar(30) not null,
    texto varchar (255) not null,
    fecha date not null,
    primary key(id)
);