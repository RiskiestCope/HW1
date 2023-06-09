
DROP DATABASE IF EXISTS spotiapi;
CREATE DATABASE spotiapi;
USE spotiapi;
SHOW ENGINE INNODB STATUS;

CREATE TABLE Utenti(
	NOME VARCHAR(20),
    COGNOME VARCHAR(15),
	EMAIL TEXT,
	NOMEUT VARCHAR(20) PRIMARY KEY,
    PASSWORD VARCHAR(24)
)ENGINE=InnoDB;

CREATE TABLE Raccolte(
	NOMEUTENTE VARCHAR(20),
    TITOLO VARCHAR(10) ,
    COPERTINA TEXT,
    idk INTEGER AUTO_INCREMENT PRIMARY KEY,
    FOREIGN KEY (NOMEUTENTE) REFERENCES Utenti(NOMEUT)
)ENGINE=InnoDB;

CREATE TABLE Contenuti(
	CONTENUTO TEXT,
    ID INTEGER AUTO_INCREMENT PRIMARY KEY
)ENGINE=InnoDB;

CREATE TABLE LEGA(
	RACCOLTA  INTEGER,
    CONTENUTO INTEGER,
    PRIMARY KEY (RACCOLTA,CONTENUTO),
    FOREIGN KEY (RACCOLTA) REFERENCES Raccolte(idk),
    FOREIGN KEY (CONTENUTO) REFERENCES Contenuti(id)
)ENGINE=InnoDB;

