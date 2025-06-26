create table device
(
    codigo int(5) auto_increment
        primary key,
    nome   varchar(60) null
);

INSERT INTO device (codigo, nome) VALUES (1, 'Dispositivo 1');
