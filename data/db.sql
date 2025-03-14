CREATE TABLE couriers (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    middlename VARCHAR(100) NULL
);
CREATE TABLE regions (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    days INTEGER NOT NULL
);
CREATE TABLE trips (
    id SERIAL PRIMARY KEY,
    startdate DATE NOT NULL,
    enddate DATE NOT NULL,
    courierid INTEGER NOT NULL,
    regionid INTEGER NOT NULL,
    FOREIGN KEY (courierid) REFERENCES couriers(id),
    FOREIGN KEY (regionid) REFERENCES regions(id)
);

INSERT INTO couriers (id, firstname, lastname, middlename)
VALUES 
    (1, 'Иван', 'Петров', 'Алексеевич'),
    (2, 'Андрей', 'Алексеев', 'Васильевич'),
    (3, 'Александр', 'Яшин', 'Петрович'),
    (4, 'Алексей', 'Иванов', NULL),
    (5, 'Дмитрий', 'Артемьев', 'Александрович'),
    (6, 'Никита', 'Дятлов', NULL),
    (7, 'Артем', 'Воробьев', 'Иванович'),
    (8, 'Василий', 'Патрушин', NULL),
    (9, 'Ян', 'Доценко', 'Андреевич'),
    (10, 'Алексей', 'Чернов', 'Дмитриевич');

INSERT INTO regions (id, name, days)
VALUES
    (1, 'Санкт-Петербург', 2),
    (2, 'Уфа', 4),
    (3, 'Нижний Новгород', 3),
    (4, 'Владимир', 3),
    (5, 'Кострома', 2),
    (6, 'Екатеринбург', 4),
    (7, 'Ковров',  5),
    (8, 'Воронеж', 3),
    (9, 'Самара', 3),
    (10, 'Астрахань', 3);

INSERT INTO public.trips (id, startdate, enddate, courierid, regionid) VALUES (24, '2025-03-15', '2025-03-17', 10, 1);
INSERT INTO public.trips (id, startdate, enddate, courierid, regionid) VALUES (25, '2025-03-19', '2025-03-22', 4, 4);
INSERT INTO public.trips (id, startdate, enddate, courierid, regionid) VALUES (26, '2025-03-11', '2025-03-14', 10, 9);
INSERT INTO public.trips (id, startdate, enddate, courierid, regionid) VALUES (27, '2025-04-11', '2025-04-15', 6, 6);
INSERT INTO public.trips (id, startdate, enddate, courierid, regionid) VALUES (28, '2025-03-28', '2025-04-02', 10, 7);
INSERT INTO public.trips (id, startdate, enddate, courierid, regionid) VALUES (29, '2025-03-16', '2025-03-18', 3, 5);
INSERT INTO public.trips (id, startdate, enddate, courierid, regionid) VALUES (30, '2025-05-08', '2025-05-12', 9, 2);
