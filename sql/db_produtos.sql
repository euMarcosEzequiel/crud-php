drop database if exists produtos;
create database if not exists produtos;
use produtos;

create table if not exists produto(
    id int primary key auto_increment not null,
    nome varchar(255) not null,
    categoria varchar(255) not null
);