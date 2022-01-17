

CREATE TABLE IF NOT EXISTS error (
    id int(11) NOT NULL AUTO_INCREMENT,
    event TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Temp float(50) NOT NULL,
    Door varchar(50) NOT NULL,
    Current varchar(50) NOT NULL,
    status varchar(50) NOT NULL,
    PRIMARY KEY (id)
);