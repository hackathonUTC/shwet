CREATE TABLE docs ( -- OLD
	id VARCHAR(15) PRIMARY KEY,
	uv VARCHAR(5) NOT NULL,
	type VARCHAR(10) NOT NULL,
	nom VARCHAR(255) NOT NULL,
	extension VARCHAR(4)
);

ALTER TABLE docs
	add ( note TINYINT );
ALTER TABLE docs
	add ( semestre CHAR(3) );


CREATE TABLE docs (
	id VARCHAR(15) PRIMARY KEY,
	uv VARCHAR(5) NOT NULL,
	type VARCHAR(10) NOT NULL,
	nom VARCHAR(255) NOT NULL,
	extension VARCHAR(4),
	note TINYINT,
	semestre CHAR(3)
);

-----------------------------------

CREATE TABLE uvbranche ( -- OLD
	branche VARCHAR(3) NOT NULL,
	uv CHAR(4) NOT NULL,
	titreuv VARCHAR(255) NOT NULL
);

ALTER TABLE `uvbranche`
	CHANGE `uv`
	`uv` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;


CREATE TABLE uvbranche (
	branche VARCHAR(3) NOT NULL,
	uv VARCHAR(5) NOT NULL,
	titreuv VARCHAR(255) NOT NULL
);