-- queries in sql per creare le tabelle
DROP DATABASE IF EXISTS penny_wise_db;
CREATE DATABASE penny_wise_db;
USE penny_wise_db;

-- creazione utente
DROP USER 'user'@'%';
CREATE USER 'user'@'%' IDENTIFIED BY 'user';
GRANT ALL PRIVILEGES ON penny_wise_db.* TO 'user'@'%';
-- crezione tabella progetto
CREATE TABLE progetto (
                          id INT NOT NULL AUTO_INCREMENT ,
                          nome VARCHAR(255) NOT NULL ,
                          descrizione TEXT NOT NULL ,
                          link_condivisione VARCHAR(255) NULL UNIQUE,
                          PRIMARY KEY (id));

-- creazione tabella utente
CREATE TABLE utente (
                        email VARCHAR(255) NOT NULL ,
                        username VARCHAR(255) NOT NULL ,
                        password VARCHAR(255) NOT NULL,
                        PRIMARY KEY (email)
);

-- creazione della relazione tag
-- id presente in quanto all'interno della relazione movimento,
-- ci si riferisce a tag.id => ogni aggiornamento su tag
-- può essere fatto in modo indipendente senza dover alterare la tabella movimento.
CREATE TABLE tag (
                     id INT NOT NULL AUTO_INCREMENT,
                     nome VARCHAR(255) NOT NULL,
                     id_progetto INT NOT NULL,
                     descrizione TEXT ,
                     PRIMARY KEY (id),
                     FOREIGN KEY (id_progetto) REFERENCES progetto(id) ON DELETE CASCADE
);

-- creazione della tabella movimento
-- spesa non sembra essere un nome adatto in quanto implica un
-- importo sempre negativo
-- il campo tag può essere nullo
CREATE TABLE movimento (
                           id INT NOT NULL AUTO_INCREMENT,
                           id_progetto INT NOT NULL,
                           data DATETIME NOT NULL,
                           importo FLOAT NOT NULL,
                           descrizione TEXT,
                           tag_id INT NULL,
                           PRIMARY KEY (id),
                           FOREIGN KEY (id_progetto) REFERENCES progetto(id) ON DELETE CASCADE,
                           FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE SET NULL
);

CREATE TABLE progetto_utente(
                                email VARCHAR(255) NOT NULL,
                                id_progetto INT NOT NULL,
                                PRIMARY KEY (email, id_progetto),
                                FOREIGN KEY (email) REFERENCES utente(email) ON DELETE CASCADE,
                                FOREIGN KEY (id_progetto) REFERENCES progetto(id) ON DELETE CASCADE
);

-- un tag può essere appartenente a più progetti e
-- più progetti possono averse lo stesso tag.
-- => relazione molti a molti tra tag e progetto

-- Inserimento dati di esempio per la tabella progetto
INSERT INTO progetto (nome, descrizione, link_condivisione)
VALUES
    ('Progetto A', 'Descrizione del progetto A', 'http://link-condivisione-progetto-A'),
    ('Progetto B', 'Descrizione del progetto B', 'http://link-condivisione-progetto-B'),
    ('Progetto C', 'Descrizione del progetto C', NULL);

-- Inserimento dati di esempio per la tabella utente
INSERT INTO utente (email, username, password)
VALUES
    ('email1@example.com', 'utente1', 'password1'),
    ('email2@example.com', 'utente2', 'password2'),
    ('email3@example.com', 'utente3', 'password3');

-- Inserimento dati di esempio per la tabella tag
INSERT INTO tag (nome, id_progetto, descrizione)
VALUES
    ('Tag 1', 1, 'Descrizione del tag 1 per Progetto A'),
    ('Tag 2', 1, 'Descrizione del tag 2 per Progetto A'),
    ('Tag 3', 2, 'Descrizione del tag 3 per Progetto B');

-- Inserimento dati di esempio per la tabella movimento
INSERT INTO movimento (id_progetto, data, importo, descrizione, tag_id)
VALUES
    (1, '2024-04-24 10:00:00', 50.00, 'Spesa per Progetto A', 1),
    (1, '2024-04-25 12:00:00', 30.00, 'Altra spesa per Progetto A', 2),
    (2, '2024-04-26 15:00:00', 100.00, 'Spesa per Progetto B', 3),
    (3, '2024-04-27 08:00:00', 20.00, 'Spesa per Progetto C', NULL);

-- Inserimento dati di esempio per la tabella progetto_utente
INSERT INTO progetto_utente (email, id_progetto)
VALUES
    ('email1@example.com', 1),
    ('email2@example.com', 2),
    ('email3@example.com', 3);