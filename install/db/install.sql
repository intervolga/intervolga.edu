CREATE TABLE IF NOT EXISTS intervolga_edu
(
    ID                    int NOT NULL AUTO_INCREMENT,
    TEST_NAME             varchar(255) NOT NULL,
    RESULT                BOOL,
    PASSED_DATE           DATETIME,
    COMPLAINT             BOOL,
    COMPLAINT_DATE        DATETIME,
    COMPLAINT_COMMENT     varchar(255),
    PRIMARY KEY (ID)
);