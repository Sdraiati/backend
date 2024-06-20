-- queries in sql per creare le tabelle
DROP DATABASE IF EXISTS scaregna;
CREATE DATABASE scaregna;
USE scaregna;

-- crezione tabella progetto
CREATE TABLE progetto (
                          id INT NOT NULL AUTO_INCREMENT ,
                          nome VARCHAR(255) NOT NULL ,
                          descrizione TEXT NOT NULL ,
                          link_condivisione VARCHAR(255) NULL UNIQUE,
                          PRIMARY KEY (id));

-- creazione tabella utente
CREATE TABLE utente (
                        id INT NOT NULL AUTO_INCREMENT,
                        email VARCHAR(255) NOT NULL UNIQUE,
                        username VARCHAR(255) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL,
                        PRIMARY KEY (id)
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
                                id_utente INT NOT NULL,
                                id_progetto INT NOT NULL,
                                PRIMARY KEY (id_utente, id_progetto),
                                FOREIGN KEY (id_utente) REFERENCES utente(id) ON DELETE CASCADE,
                                FOREIGN KEY (id_progetto) REFERENCES progetto(id) ON DELETE CASCADE
);

-- Inserimento dati di esempio per la tabella progetto
INSERT INTO progetto (nome, descrizione, link_condivisione)
VALUES
    ('Vacanza Sardegna', 'Spese condivise della vacanza in Sardegna 2024', '3H9HPTTHLZ'),
    ('Spese', 'Le mie spese personali', 'HPTT3H9HWZ'),
    ('Ristrutturazione Casa', 'Ristrutturazione della casa nel 2024', 'RSTR2024HS'),
    ('Campagna di Marketing', 'Campagna di marketing per il nuovo prodotto', 'MARK2024NEW'),
    ('Startup Tecnologica', 'Spese per la startup tecnologica', 'STARTUPTECH2024'),
    ('Organizzazione Matrimonio', 'Organizzazione e spese per il matrimonio', 'WED2024ORG'),
    ('Progetto Educativo', 'Progetto per corsi di formazione', 'EDUPROJECT2024'),
    ('Viaggio Aziendale', 'Spese per il viaggio aziendale annuale', 'BUSITRIP2024'),
    ('Conferenza Internazionale', 'Spese per la conferenza internazionale', 'CONFINT2024'),
    ('Ricerca e Sviluppo', 'Progetto di ricerca e sviluppo', 'RND2024');

-- Inserimento dati di esempio per la tabella utente
INSERT INTO utente (email, username, password)
VALUES
    ('marco@libero.com', 'marco', 'password'),
    ('anna@gmail.com', 'anna', 'password'),
    ('luca@yahoo.com', 'luca', 'password'),
    ('giulia@outlook.com', 'giulia', 'password'),
    ('federico@libero.com', 'federico', 'password'),
    ('marta@gmail.com', 'marta', 'password'),
    ('roberto@yahoo.com', 'roberto', 'password'),
    ('chiara@outlook.com', 'chiara', 'password'),
    ('francesco@libero.com', 'francesco', 'password'),
    ('laura@gmail.com', 'laura', 'password'),
    ('user@example.com', 'user', 'user');

-- Inserimento dati di esempio per la tabella tag
INSERT INTO tag (nome, id_progetto, descrizione)
VALUES
    ('Affitto', 2, 'Affitto di casa'),
    ('Divertimento', 1, 'Le spese fatte per attività di divertimento'),
    ('Materiali', 3, 'Materiali per la ristrutturazione'),
    ('Cibo', 1, 'Spese per il cibo durante la vacanza'),
    ('Trasporto', 1, 'Costi di trasporto durante la vacanza'),
    ('Decorazioni', 6, 'Decorazioni per il matrimonio'),
    ('Regali', 6, 'Regali per gli invitati al matrimonio'),
    ('Marketing', 4, 'Spese di marketing per il progetto D'),
    ('Attrezzatura', 5, 'Acquisto di attrezzature per il progetto E'),
    ('Formazione', 7, 'Costi per corsi di formazione nel progetto F');

-- Inserimento dati di esempio per la tabella movimento
INSERT INTO movimento (id_progetto, data, importo, descrizione, tag_id)
VALUES
    (1, '2024-06-19', 200.00, 'Immersione subaquea', 2),
    (1, '2024-06-20', 150.00, 'Cena al ristorante', 4),
    (2, '2024-06-21', 500.00, 'Pagamento affitto mensile', 1),
    (3, '2024-06-22', 1200.00, 'Acquisto materiali edili', 3),
    (6, '2024-06-23', 300.00, 'Acquisto decorazioni', 6),
    (6, '2024-06-24', 150.00, 'Regali per gli invitati', 7),
    (4, '2024-06-25', 1000.00, 'Campagna pubblicitaria', 8),
    (5, '2024-06-26', 750.00, 'Acquisto attrezzature', 9),
    (7, '2024-06-27', 400.00, 'Corso di formazione', 10),
    (1, '2024-06-28', 100.00, 'Taxi', 5),
    (1, '2024-07-01', 80.00, 'Visita guidata', 2),
    (1, '2024-07-02', 200.00, 'Noleggio auto', 5),
    (1, '2024-07-03', 120.00, 'Pranzo in spiaggia', 4),
    (2, '2024-07-04', 50.00, 'Spese personali', NULL),
    (2, '2024-07-05', 20.00, 'Libri e riviste', NULL),
    (2, '2024-07-06', 100.00, 'Abbigliamento', NULL),
    (3, '2024-07-07', 300.00, 'Mobili nuovi', 3),
    (3, '2024-07-08', 400.00, 'Verniciatura', 3),
    (4, '2024-07-09', 150.00, 'Grafica pubblicitaria', 8),
    (4, '2024-07-10', 250.00, 'Sito web', 8),
    (5, '2024-07-11', 600.00, 'Computer nuovo', 9),
    (5, '2024-07-12', 100.00, 'Software', 9),
    (6, '2024-07-13', 500.00, 'Noleggio sala', 6),
    (6, '2024-07-14', 400.00, 'Servizio fotografico', 6),
    (7, '2024-07-15', 200.00, 'Workshop', 10),
    (7, '2024-07-16', 300.00, 'Materiali didattici', 10),
    (8, '2024-07-17', 50.00, 'Materiali di consumo', NULL),
    (8, '2024-07-18', 100.00, 'Spese generali', NULL),
    (9, '2024-07-19', 200.00, 'Consulenza', NULL),
    (9, '2024-07-20', 150.00, 'Spese amministrative', NULL),
    (10, '2024-07-21', 500.00, 'Viaggio di lavoro', NULL),
    (10, '2024-07-22', 300.00, 'Cena di lavoro', NULL),
    (10, '2024-07-23', 400.00, 'Hotel', NULL),
    (10, '2024-07-24', 100.00, 'Trasporto locale', NULL),
    (10, '2024-07-25', 150.00, 'Spese varie', NULL);

-- Inserimento dati di esempio per la tabella progetto_utente
INSERT INTO progetto_utente (id_utente, id_progetto)
VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6),
    (7, 7),
    (8, 8),
    (9, 9),
    (10, 10),
    (1, 2),
    (2, 3),
    (3, 4),
    (4, 5),
    (5, 6),
    (11, 1),
    (11, 2),
    (11, 3),
    (11, 4),
    (11, 5),
    (11, 6),
    (11, 7),
    (11, 8),
    (11, 9),
    (11, 10);