
CREATE DATABASE IF NOT EXISTS noel;

USE noel;

CREATE TABLE IF NOT EXISTS user (
  id int auto_increment  NOT NULL,
  email varchar (255) NOT NULL,
  password varchar (100) NOT NULL,
  roles varchar (512) Not NULL,
    CONSTRAINT user_PK PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS elf (
  id_user int NOT NULL,
  id int NOT NULL,
  name varchar (100) NOT NULL,
	CONSTRAINT elf_PK PRIMARY KEY (id_user, id),
	CONSTRAINT elf_user_FK FOREIGN KEY (id_user) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS visitor (
  id_user int NOT NULL,
  id int NOT NULL,
  firstName varchar (100) NOT NULL,
  lastName varchar (100) NOT NULL,
  pseudo varchar (100) NOT NULL,
  age int NOT NULL ,
  address int NOT NULL ,
  letter text NOT NULL,
	CONSTRAINT visitor_PK PRIMARY KEY (id_user, id),
	CONSTRAINT visitor_user_FK FOREIGN KEY (id_user) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS comment(
  id int auto_increment NOT NULL,
  comment text NOT NULL,
  validate BOOLEAN NOT NULL,
  pseudo varchar (50) NOT NULL,
	CONSTRAINT country_PK PRIMARY KEY (id)
    -- CONSTRAINT comment_visitor_FK FOREIGN KEY (id_category) REFERENCES category(id)
);

CREATE TABLE IF NOT EXISTS category(
  id int auto_increment NOT NULL,
  name varchar (100) NOT NULL,
	CONSTRAINT category_PK PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS gift(
  id int auto_increment NOT NULL,
  name VARCHAR (100) NOT NULL,
  age int NOT NULL ,
  description text NOT NULL,
  validate BOOLEAN NOT NULL,
  imageName VARCHAR (100) NOT NULL,
  id_category int NOT NULL,
	CONSTRAINT gift_PK PRIMARY KEY (id),
    CONSTRAINT gift_category_FK FOREIGN KEY (id_category) REFERENCES category(id)
);

CREATE TABLE IF NOT EXISTS visitor_gift(
  id_visitor int NOT NULL ,
  id_gift int NOT NULL,
	CONSTRAINT visitor_gift_PK PRIMARY KEY (id_visitor, id_gift)
);
