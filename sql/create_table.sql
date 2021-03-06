CREATE TABLE docs (
	id VARCHAR(15) PRIMARY KEY,
	uv VARCHAR(5) NOT NULL,
	type VARCHAR(10) NOT NULL,
	nom VARCHAR(255) NOT NULL,
	extension VARCHAR(4),
	note TINYINT,
	semestre CHAR(3),
	etu CHAR(8) NOT NULL,
	FOREIGN KEY (etu) REFERENCES etu(login)
);

ALTER TABLE docs
	ADD etu CHAR(8) REFERENCES etu(login);


CREATE TABLE uvbranche (
	branche VARCHAR(3) NOT NULL,
	uv VARCHAR(5) NOT NULL,
	titreuv VARCHAR(255) NOT NULL
);


CREATE TABLE etu (
	login CHAR(8) PRIMARY KEY,
	lastAction DATETIME
);

CREATE TABLE avis (
	doc VARCHAR(15) NOT NULL,
	valeur TINYINT,
	etu CHAR(8) NOT NULL,
	FOREIGN KEY (doc) REFERENCES docs(id),
	FOREIGN KEY (etu) REFERENCES etu(login),
	PRIMARY KEY (etu, doc)
);