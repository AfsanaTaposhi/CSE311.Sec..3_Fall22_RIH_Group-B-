CREATE DATABASE IF NOT EXISTS pakh_pakhali;

USE pakh_pakhali;


CREATE TABLE IF NOT EXISTS user_info
(
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL,
    user_name  VARCHAR(50)  NOT NULL,
    mail       VARCHAR(50)  NOT NULL,
    password   VARCHAR(255) NOT NULL,
    region     VARCHAR(50)  NOT NULL,
    PRIMARY KEY (user_name)
);

CREATE TABLE IF NOT EXISTS bird
(
    owner         VARCHAR(50)  NOT NULL,
    ring_id       VARCHAR(50)  NOT NULL,
    species_name  VARCHAR(50)  NOT NULL,
    mutation      VARCHAR(100) NOT NULL,
    birth_date    DATE         NOT NULL,
    breed_pair    INT,
    is_breed_able BOOLEAN      NOT NULL,
    PRIMARY KEY (owner, ring_id)
);
