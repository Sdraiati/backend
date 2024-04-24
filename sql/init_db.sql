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
