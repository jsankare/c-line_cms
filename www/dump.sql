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

-- Table cline_reviews
DROP TABLE IF EXISTS public.cline_review CASCADE;
CREATE TABLE cline_review(
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    position VARCHAR(255) NOT NULL,
    comment TEXT NOT NULL,
    grade SMALLINT NOT NULL,
    date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Table cline_faqs
DROP TABLE IF EXISTS public.cline_faq CASCADE;
CREATE TABLE cline_faq(
    id SERIAL PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer TEXT NOT NULL,
    date_inserted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

---------------------------------------

-- Seed users
INSERT INTO public.cline_user (firstname, lastname, email, password, status)
VALUES
    ('Toto', 'Bilbo', 'toto@mail.fr',
    -- test avec superPassword1&
    '$2y$10$87lWL8w7Vng27upNFWVP2OkB3oiYKFCIC7aN2.cKjPLDUhJ4Y.MHu',
    4),
    ('Diana', 'Contigo', 'dcontigo@mail.fr',
    '$2y$10$eK1ZEmE9Ce9jbX1x4y1PzeXZxZgZZ7qISyyQFnIXKm6K79rPzFSIS',
    1),
    ('Lea', 'Planth', 'lplanth@mail.fr',
    '$2y$10$eK1ZEmE9Ce9jbX1x4y1PzeXZxZgZZ7qISyyQFnIXKm6K79rPzFSIS',
    3);

-- Seed pages
INSERT INTO public.cline_page (title, description, content, creator_id, slug, is_main)
VALUES
    ('Le Caméléon', 'Les secrets fascinants du camouflage du caméléon',
    '<h2>Le Caméléon, Maître du Camouflage</h2>
    <p>Le caméléon est un <strong>reptile fascinant</strong> connu pour sa capacité unique à changer de couleur. Contrairement à ce que l''on croit, cette faculté n''est pas utilisée uniquement pour se camoufler. En réalité, le changement de couleur permet aussi au caméléon de <em>réguler sa température corporelle</em> et de <em>communiquer</em> avec ses congénères.</p>
    <p>Les cellules cutanées du caméléon, appelées <strong>chromatophores</strong>, contiennent des pigments qui réagissent à l''environnement et aux stimuli externes. Les mâles utilisent ce changement de couleur pour <strong>impressionner</strong> leurs rivaux lors de combats ou pour attirer l''attention des femelles.</p>
    <p><em>Apprenez-en plus sur cet animal incroyable et ses stratégies d''adaptation !</em></p>', 
    1, 'le-cameleon', false),

    ('Le Dauphin', 'L''intelligence fascinante des dauphins',
    '<h2>Le Dauphin, l''Animal le Plus Intelligent des Océans</h2>
    <p>Les dauphins ne sont pas seulement de magnifiques créatures marines, mais ils sont aussi parmi les <strong>animaux les plus intelligents</strong> de la planète. Grâce à un cerveau relativement grand, ils sont capables de résoudre des problèmes complexes, de montrer des signes de <em>conscience de soi</em> et d''utiliser un langage sophistiqué pour <em>communiquer</em> avec leurs semblables.</p>
    <p>Le dauphin utilise des <strong>sons et des clics</strong> pour naviguer et communiquer, un phénomène connu sous le nom d''<em>écholocation</em>. Ils vivent en groupes sociaux soudés et sont capables de créer des liens profonds avec leurs pairs, démontrant ainsi une <strong>intelligence émotionnelle</strong> exceptionnelle.</p>
    <p>Explorez le monde fascinant des dauphins et découvrez leurs talents incroyables.</p>', 
    2, 'le-dauphin', false),

    ('Le Gecko', 'Les capacités d''adhérence du gecko',
    '<h2>Le Gecko, Maître de l''Adhérence</h2>
    <p>Le gecko est une petite créature agile qui possède un pouvoir étonnant : il peut grimper sur pratiquement toutes les surfaces, même les murs et les plafonds ! Cela est rendu possible grâce à des milliards de minuscules <strong>poils</strong> appelés <em>setae</em> sur ses orteils. Ces structures microscopiques créent une force d''adhérence grâce à des interactions à l''échelle atomique.</p>
    <p>Cette capacité fait du gecko un prédateur redoutable, capable de se déplacer rapidement pour capturer ses proies ou échapper à ses ennemis. De plus, la structure de ses pattes inspire de nombreuses recherches en <strong>robotique</strong> et en <em>nanotechnologie</em>.</p>
    <p>Découvrez comment le gecko utilise son talent d''adhésion pour survivre et prospérer dans des environnements variés.</p>',
1, 'le-gecko', false),

    ('L''Abeille', 'La danse fascinante des abeilles', 
    '<h2>Les Abeilles et leur Communication Sophistiquée</h2>
    <p>Les abeilles sont des insectes <strong>hautement organisés</strong> qui jouent un rôle crucial dans la pollinisation de nombreuses plantes. Mais saviez-vous qu''elles communiquent entre elles à travers une <em>danse en forme de huit</em> ? Cette danse leur permet d''indiquer à leurs camarades l''emplacement exact des sources de nectar les plus riches.</p>
    <p>En fonction de l''angle et de l''intensité de la danse, les abeilles peuvent transmettre des informations très précises sur la <strong>distance</strong> et la <strong>direction</strong> des fleurs. Ce système de communication est un exemple parfait de l''évolution et de l''ingéniosité du règne animal.</p>
    <p>Plongez dans le monde incroyable des abeilles et découvrez leur rôle vital dans notre écosystème.</p>',
    2, 'l-abeille', false),

    ('La Pieuvre', 'L''incroyable intelligence des pieuvres', 
    '<h2>La Pieuvre, une Créature d''une Intelligence Rare</h2>
    <p>La pieuvre est une créature marine qui défie nos conceptions de l''intelligence animale. Avec ses <strong>huit tentacules</strong> et son cerveau complexe, elle est capable de <em>résoudre des énigmes</em>, de <em>se camoufler</em> et même d''apprendre de nouvelles techniques pour échapper aux prédateurs.</p>
    <p>Contrairement à de nombreux autres animaux, la pieuvre possède un système nerveux décentralisé, ce qui signifie que ses tentacules peuvent agir indépendamment de son cerveau principal. Elles sont également capables de modifier leur couleur et leur texture pour se fondre dans leur environnement, un talent essentiel pour éviter les dangers.</p>
    <p>Explorez l''univers mystérieux des pieuvres et découvrez leurs incroyables capacités d''adaptation et d''apprentissage.</p>', 
    3, 'la-pieuvre', false);

-- Seed articles
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

-- Seed comments
INSERT INTO public.cline_comment (article_id, user_id, content, status)
VALUES
    (1, 2, 'Incroyable article sur le caméléon, j''ignorais qu''il utilisait la couleur pour communiquer.', 1),
    (2, 3, 'Le dauphin est définitivement l''animal le plus intelligent. Belle analyse.', 1),
    (3, 1, 'Je suis fasciné par les geckos, leur capacité d''adhérence est hallucinante.', 1),
    (4, 2, 'Je ne savais pas que les abeilles utilisaient une danse pour se repérer. Très instructif.', 1);

-- Seed categories
INSERT INTO public.cline_category (name, type)
VALUES
    ('Animaux', 'Article'),
    ('Technologie', 'Article'),
    ('Écologie', 'Article'),
    ('Produits', 'Commerce'),
    ('Accessoires', 'Commerce');

-- Seed products
INSERT INTO public.cline_product (name, description, category, image, price, available)
VALUES
    ('T-shirt Caméléon', 'Un T-shirt qui change de couleur avec la température.', 'Accessoires', '/images/tshirt_cameleon.jpg', 29.99, true),
    ('Poster Dauphin', 'Poster représentant un groupe de dauphins en pleine mer.', 'Produits', '/images/poster_dauphin.jpg', 15.00, true),
    ('Mug Gecko', 'Mug avec un motif de gecko adhérent.', 'Accessoires', '/images/mug_gecko.jpg', 12.50, true),
    ('Peluche Abeille', 'Peluche en forme d''abeille.', 'Produits', '/images/peluche_abeille.jpg', 10.00, true);

-- Seed reviews
INSERT INTO public.cline_review (firstname, lastname, position, comment, grade)
VALUES
    ('Jarod', 'Boldur', 'Explorateur Animalier', 'Produit de qualité supérieure. Le t-shirt Caméléon est unique et confortable.', 5),
    ('Mei', 'Bathee', 'Biologiste', 'Le mug Gecko est parfait pour mon café du matin, j''adore le design !', 4),
    ('Roffo', 'Slaydragon', 'Photographe', 'Le poster Dauphin est magnifique, les détails sont incroyables.', 5),
    ('Riswynn', 'Poigndefer', 'Aventurière', 'La peluche abeille est adorable, mais je la trouve un peu petite.', 3);

-- Seed FAQs
INSERT INTO public.cline_faq (question, answer)
VALUES
    ('Comment entretenir un T-shirt Caméléon ?', 'Laver à froid, ne pas utiliser de sèche-linge pour conserver les propriétés thermochromiques.'),
    ('Le mug Gecko passe-t-il au lave-vaisselle ?', 'Oui, il est compatible avec le lave-vaisselle et le micro-ondes.'),
    ('Est-ce que la peluche Abeille est hypoallergénique ?', 'Oui, la peluche est fabriquée avec des matériaux hypoallergéniques.'),
    ('Le poster Dauphin est-il encadré ?', 'Non, il est livré sans cadre, mais il s''adapte à tous les cadres standards.');


COMMIT;
