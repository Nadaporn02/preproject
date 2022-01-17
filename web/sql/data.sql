

CREATE TABLE IF NOT EXISTS data (
    id int(11) NOT NULL AUTO_INCREMENT,
    event TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Temp varchar(50) NOT NULL,
    Door varchar(50) NOT NULL,
    Current varchar(50) NOT NULL,
    PRIMARY KEY (id)
);