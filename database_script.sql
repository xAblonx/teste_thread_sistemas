-- public.usuario definition

-- Drop table

-- DROP TABLE public.usuario;

CREATE TABLE public.usuario (
	nome_completo varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	sexo bpchar(1) NOT NULL,
	telefone_celular varchar(255) NOT NULL,
	cpf varchar(14) NOT NULL,
	foto varchar(255) NULL,
	id serial NOT NULL,
	CONSTRAINT usuario_pk PRIMARY KEY (id),
	CONSTRAINT usuario_un_cpf UNIQUE (cpf),
	CONSTRAINT usuario_un_email UNIQUE (email)
);