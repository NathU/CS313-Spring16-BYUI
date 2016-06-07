DROP DATABASE IF EXISTS templetracker;
CREATE DATABASE IF NOT EXISTS templetracker;

USE templetracker;

GRANT EXECUTE
    ON templetracker.*
    TO 'root'@'localhost' IDENTIFIED BY '';

