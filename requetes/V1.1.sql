CREATE TABLE Collection (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE Jeu (id INT AUTO_INCREMENT NOT NULL, collection_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prixAchat NUMERIC(2, 1) NOT NULL, devise VARCHAR(255) NOT NULL, codeBarre VARCHAR(255) NOT NULL, boite TINYINT(1) NOT NULL, notice TINYINT(1) NOT NULL, jeu TINYINT(1) NOT NULL, pointVIP TINYINT(1) NOT NULL, image VARCHAR(255) NOT NULL, supportRegion_id INT DEFAULT NULL, INDEX IDX_BAA9CB5580A14DA9 (supportRegion_id), INDEX IDX_BAA9CB55514956FD (collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE Region (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE Support (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE SupportRegion (id INT AUTO_INCREMENT NOT NULL, support_id INT NOT NULL, region_id INT NOT NULL, fullset INT NOT NULL, INDEX IDX_C33245F1315B405 (support_id), INDEX IDX_C33245F198260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, collection_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B392FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1D1C63B3A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_1D1C63B3514956FD (collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE Jeu ADD CONSTRAINT FK_BAA9CB5580A14DA9 FOREIGN KEY (supportRegion_id) REFERENCES SupportRegion (id);
ALTER TABLE Jeu ADD CONSTRAINT FK_BAA9CB55514956FD FOREIGN KEY (collection_id) REFERENCES Collection (id);
ALTER TABLE SupportRegion ADD CONSTRAINT FK_C33245F1315B405 FOREIGN KEY (support_id) REFERENCES Support (id);
ALTER TABLE SupportRegion ADD CONSTRAINT FK_C33245F198260155 FOREIGN KEY (region_id) REFERENCES Region (id);
ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3514956FD FOREIGN KEY (collection_id) REFERENCES Collection (id);