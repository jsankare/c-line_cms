-- pgAdmin SQL Dump
-- version 5.2.1
-- https://www.pgadmin.org/
--
-- Hôte : localhost
-- Généré le : mar. 14 mai 2024 à 13:07
-- Version du serveur : 13
-- Version de PostgreSQL : 13

BEGIN;
SET TIME ZONE 'UTC';

-- Table cline_user
DROP TABLE IF EXISTS public.cline_user CASCADE;
CREATE TABLE public.cline_user (
                                   id SERIAL PRIMARY KEY,
                                   firstname VARCHAR(50) NOT NULL,
                                   lastname VARCHAR(50) NOT NULL,
                                   email VARCHAR(320) NOT NULL UNIQUE,
                                   password VARCHAR(255) NOT NULL,
                                   status SMALLINT NOT NULL,
                                   validation_code VARCHAR(32),
                                   reset_token VARCHAR(32),
                                   token_expiration TIMESTAMP,
                                   date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                   date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Table cline_page
DROP TABLE IF EXISTS public.cline_page CASCADE;
CREATE TABLE public.cline_page (
                                   id SERIAL PRIMARY KEY,
                                   title VARCHAR(50) NOT NULL,
                                   description VARCHAR(255) NOT NULL,
                                   content TEXT NOT NULL,
                                   creator_id INT NOT NULL,
                                   slug VARCHAR(20) UNIQUE NOT NULL,
                                   is_main BOOLEAN DEFAULT FALSE,
                                   CONSTRAINT fk_user FOREIGN KEY (creator_id) REFERENCES public.cline_user(id),
                                   date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                   date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Table cline_article
DROP TABLE IF EXISTS public.cline_article CASCADE;
CREATE TABLE public.cline_article (
                                      id SERIAL PRIMARY KEY,
                                      title VARCHAR(100) NOT NULL,
                                      description VARCHAR(200),
                                      content TEXT NOT NULL,
                                      creator_id SMALLINT NOT NULL,
                                      CONSTRAINT fk_user FOREIGN KEY (creator_id) REFERENCES public.cline_user(id),
                                      date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                      date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Table cline_comment
DROP TABLE IF EXISTS public.cline_comment CASCADE;
DROP TYPE IF EXISTS comment_status CASCADE;
CREATE TABLE cline_comment (
                               id SERIAL PRIMARY KEY,
                               article_id INT NOT NULL,
                               user_id INT NOT NULL,
                               content TEXT NOT NULL,
                               status SMALLINT NOT NULL,
                               created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                               FOREIGN KEY (article_id) REFERENCES public.cline_article(id),
                               FOREIGN KEY (user_id) REFERENCES public.cline_user(id)
);

-- Table cline_category
DROP TABLE IF EXISTS public.cline_category CASCADE;
CREATE TABLE cline_category (
                                id SERIAL PRIMARY KEY,
                                name VARCHAR(50) NOT NULL,
                                type VARCHAR(50) NOT NULL,
                                date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Table cline_product
DROP TABLE IF EXISTS public.cline_product CASCADE;
CREATE TABLE cline_product (
                               id SERIAL PRIMARY KEY,
                               name VARCHAR(50) NOT NULL,
                               description VARCHAR(100) NOT NULL,
                               category VARCHAR(30) NULL,
                               image VARCHAR(500) NULL,
                               price NUMERIC NOT NULL,
                               available BOOLEAN,
                               date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Table cline_image
DROP TABLE IF EXISTS public.cline_image CASCADE;
CREATE TABLE cline_image (
                             id SERIAL PRIMARY KEY,
                             title VARCHAR(50) NOT NULL,
                             description VARCHAR(100) NOT NULL,
                             link VARCHAR(500) NOT NULL,
                             product_id INT,
                             is_gallery SMALLINT default 0,
                             date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                             date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                             FOREIGN KEY (product_id) REFERENCES cline_product(id)
);

-- Table cline_color
DROP TABLE IF EXISTS public.cline_color CASCADE;
CREATE TABLE cline_color (
                             id SERIAL PRIMARY KEY,
                             name VARCHAR(50),
                             color_code VARCHAR(7) NOT NULL UNIQUE
);

-- Table cline_size
DROP TABLE IF EXISTS public.cline_size CASCADE;
CREATE TABLE cline_size (
                            id SERIAL PRIMARY KEY,
                            name VARCHAR(20)
);

-- Table cline_product_color
DROP TABLE IF EXISTS public.cline_product_color CASCADE;
CREATE TABLE cline_product_color (
                                     PRIMARY KEY (product_id, color_id),
                                     product_id INT,
                                     color_id INT,
                                     FOREIGN KEY (product_id) REFERENCES cline_product(id) ON DELETE SET NULL,
                                     FOREIGN KEY (color_id) REFERENCES cline_color(id) ON DELETE SET NULL
);

-- Table cline_product_size
DROP TABLE IF EXISTS public.cline_product_size CASCADE;
CREATE TABLE cline_product_size (
                                    PRIMARY KEY (product_id, size_id),
                                    product_id INT,
                                    size_id INT,
                                    FOREIGN KEY (product_id) REFERENCES cline_product(id) ON DELETE SET NULL,
                                    FOREIGN KEY (size_id) REFERENCES cline_size(id) ON DELETE SET NULL
);

-- Table cline_settings
DROP TABLE IF EXISTS public.cline_settings CASCADE;
CREATE TABLE cline_settings(
                               id SERIAL PRIMARY KEY,
                               background_color VARCHAR(7) NOT NULL,
                               font_color VARCHAR(7) NOT NULL,
                               font_style VARCHAR(50) NOT NULL,
                               date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insert de l'utilisateur Jordan Sankare
INSERT INTO public.cline_user (firstname, lastname, email, password, status)
VALUES
    ('Toto', 'Bilbo', 'toto@mail.fr',
     '$2y$10$eK1ZEmE9Ce9jbX1x4y1PzeXZxZgZZ7qISyyQFnIXKm6K79rPzFSIS',
     1),
    ('Diana', 'Contigo', 'dcontigo@mail.fr',
     '$2y$10$eK1ZEmE9Ce9jbX1x4y1PzeXZxZgZZ7qISyyQFnIXKm6K79rPzFSIS',
     2),
    ('Lea', 'Planth', 'lplanth@mail.fr',
     '$2y$10$eK1ZEmE9Ce9jbX1x4y1PzeXZxZgZZ7qISyyQFnIXKm6K79rPzFSIS',
     3);

-- Seed pour les articles sur les animaux
INSERT INTO public.cline_article (title, description, content, creator_id)
VALUES
    ('Le Caméléon Maître du Camouflage', 'Les caméléons changent de couleur pour se camoufler et communiquer.',
     'Les caméléons ne changent pas seulement de couleur pour se fondre dans leur environnement, mais aussi pour réguler leur température corporelle et communiquer avec d''autres caméléons.', 1),

    ('Le Dauphin: Animal le Plus Intelligent', 'Les dauphins sont connus pour leur intelligence et leur sociabilité.',
     'Les dauphins ont un cerveau relativement grand par rapport à la taille de leur corps, et ils utilisent des sons pour naviguer et communiquer. Ils sont capables de résoudre des problèmes complexes et montrent des signes de conscience de soi.', 2),

    ('Le Pouvoir Mystérieux du Gecko', 'Le gecko a des capacités adhérence étonnantes.',
     'Grâce à des milliards de poils microscopiques appelés setae sur leurs orteils, les geckos peuvent accrocher à presque toutes les surfaces, même verticales, et se déplacer rapidement sans glisser.', 1),

    ('Les Abeilles et Leur Communication Sophistiquée', 'Les abeilles utilisent une danse pour indiquer où trouver de la nourriture.',
     'Les abeilles communiquent entre elles en effectuant une danse en forme de huit pour indiquer l''emplacement des fleurs riches en pollen. Cette danse fournit des informations précises sur la distance et la direction des sources de nourriture.', 2),

    ('Le Mystère des Pieuvres et leur Intelligence', 'Les pieuvres sont connues pour leur incroyable capacité à résoudre des problèmes.',
     'Les pieuvres possèdent un cerveau complexe et sont capables de résoudre des énigmes et d''apprendre à travers l''expérience. Elles ont également la capacité de changer de couleur pour se camoufler et exprimer des émotions.', 3),

    ('La Migration Époustouflante des Papillons Monarques', 'Les papillons monarques migrent sur des milliers de kilomètres.',
     'Chaque année, les papillons monarques parcourent plus de 4000 km pour migrer vers des climats plus chauds. Ce qui est fascinant, c''est que la génération qui entame le voyage n''est souvent pas celle qui le termine.', 1),

    ('L''Incroyable Capacité de Régénération de l''Axolotl', 'L''axolotl peut régénérer des parties de son corps endommagées.',
     'L''axolotl est une créature aquatique capable de régénérer non seulement ses membres perdus, mais aussi des parties vitales de son cœur et de son cerveau. Les scientifiques étudient ce processus unique pour des applications médicales potentielles.', 1),

    ('Les Éléphants: Gardiens de la Mémoire', 'Les éléphants ont une mémoire impressionnante.',
     'Les éléphants sont capables de se souvenir d''événements sur de longues périodes et peuvent reconnaître des individus humains et animaux même après des années de séparation. Leur mémoire est vitale pour la survie de leur troupeau.', 1),

    ('Les Fourmis: Petites mais Organisées', 'Les fourmis ont des structures sociales complexes.',
     'Les fourmis vivent en colonies bien organisées où chaque individu a un rôle précis. Certaines espèces d''ouvrières peuvent cultiver des champignons, tandis que d''autres s''occupent de la défense du nid.', 1),

    ('Le Perroquet, Maître de l''Imitation', 'Les perroquets sont capables de reproduire des sons et des mots.',
     'Les perroquets sont célèbres pour leur capacité à imiter les sons qu''ils entendent. Ils sont même capables de comprendre certains mots et de les utiliser de manière contextuelle, faisant d''eux l''un des animaux les plus "vocalement" intelligents.', 1);

COMMIT;
