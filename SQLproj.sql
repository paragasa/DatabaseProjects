
--Dropping all tables

DROP TABLE IF EXISTS ETH_LINKING; 
DROP TABLE IF EXISTS ETHNICITY; 
DROP TABLE IF EXISTS PERSONAL_INFO; 
DROP TABLE IF EXISTS MILITARY_BRANCH;
DROP TABLE IF EXISTS STATE; 
DROP TABLE IF EXISTS VET_STAT; 
DROP TABLE IF EXISTS GENDER; 
DROP TABLE IF EXISTS PERSONAL_INFO; 
DROP TABLE IF EXISTS BK_GROUND; 
DROP TABLE IF EXISTS EMP_HIST; 
DROP TABLE IF EXISTS EDU_HIST;
DROP TABLE IF EXISTS APPLICATION; 
DROP TABLE IF EXISTS ENTRANCE_TESTS;
DROP TABLE IF EXISTS TERM; 
DROP TABLE IF EXISTS STUDENT_TYPE; 
DROP TABLE IF EXISTS COLLEGE; 
DROP TABLE IF EXISTS DEGREE; 
DROP TABLE IF EXISTS MAJOR_TYPE; 
--DROP TABLE IF EXISTS USR_ACCT; 
DROP TABLE IF EXISTS APPLICATION;


/*-----------------APPLICATION-------------------*/

CREATE TABLE IF NOT EXISTS USR_ACCT( 
USR_NM VARCHAR(20), 
USR_PWD VARCHAR(32), 
PRIMARY KEY (USR_NM) 
)ENGINE=InnoDB;

CREATE TABLE MAJOR_TYPE( 
MAJOR_ID INT NOT NULL, 
MAJOR VARCHAR(60) NOT NULL, 
PRIMARY KEY (MAJOR_ID) 
)ENGINE=InnoDB;

CREATE TABLE DEGREE( 
DEGREE_ID INT NOT NULL, 
DEGREE VARCHAR(30) NOT NULL, 
PRIMARY KEY (DEGREE_ID) 
)ENGINE=InnoDB;

CREATE TABLE COLLEGE( 
COLLEGE_ID INT NOT NULL, 
COLLEGE VARCHAR(50) NOT NULL, 
PRIMARY KEY (COLLEGE_ID) 
)ENGINE=InnoDB;

CREATE TABLE STUDENT_TYPE( 
TYPE_ID INT NOT NULL, 
STUDENT_TYPE VARCHAR(30) NOT NULL, 
PRIMARY KEY (TYPE_ID) 
)ENGINE=InnoDB;

CREATE TABLE TERM( 
TERM_ID INT NOT NULL, 
TERM VARCHAR(15) NOT NULL,
PRIMARY KEY (TERM_ID) 
)ENGINE=InnoDB;

CREATE TABLE ENTRANCE_TESTS( 
TEST_TYPE VARCHAR(15) NOT NULL, 
TEST_DTE DATE NOT NULL, 
PRIMARY KEY (TEST_TYPE) 
)ENGINE=InnoDB;

CREATE TABLE APPLICATION( 
GRAD_APP_ID INT NOT NULL, 
USR_NM VARCHAR(20) NOT NULL, 
TYPE_ID INT NOT NULL, 
COLLEGE_ID INT NOT NULL, 
DEGREE_ID INT NOT NULL, 
MAJOR_ID INT NOT NULL, 
TERM_ID INT NOT NULL, 
PRIMARY KEY (GRAD_APP_ID), 
FOREIGN KEY (USR_NM) REFERENCES USR_ACCT(USR_NM),
FOREIGN KEY (MAJOR_ID) REFERENCES MAJOR_TYPE(MAJOR_ID), 
FOREIGN KEY (DEGREE_ID) REFERENCES DEGREE(DEGREE_ID), 
FOREIGN KEY (COLLEGE_ID) REFERENCES COLLEGE(COLLEGE_ID), 
FOREIGN KEY (TYPE_ID) REFERENCES STUDENT_TYPE(TYPE_ID), 
FOREIGN KEY (TERM_ID) REFERENCES TERM(TERM_ID)
)ENGINE=InnoDB;

CREATE TABLE EDU_HIST( 
INSTITU_HIST VARCHAR(40) NOT NULL, 
DEGREE_HIST VARCHAR(30) NOT NULL, 
START_DTE_HIST DATE NOT NULL, 
MAJOR_HIST VARCHAR(30) NOT NULL, 
DEGREE_RECV_DTE DATE NOT NULL, 
GRAD_APP_ID INT NOT NULL, 
PRIMARY KEY (INSTITU_HIST), 
FOREIGN KEY (GRAD_APP_ID) REFERENCES APPLICATION (GRAD_APP_ID) 
)ENGINE=InnoDB;

CREATE TABLE EMP_HIST( 
EMPLOYER VARCHAR(30) NOT NULL, 
CURRENTLY_EMPLOY CHAR(1) NOT NULL, 
ORG_ADDR VARCHAR(40) NOT NULL, 
ORG_PHONE VARCHAR(12) NOT NULL, 
TITLE VARCHAR(30) NOT NULL, 
START_DTE DATE NOT NULL, 
END_DTE DATE NOT NULL, 
PART_OR_FULL VARCHAR(5) NOT NULL, 
GRAD_APP_ID INT NOT NULL, 
FOREIGN KEY (GRAD_APP_ID) REFERENCES APPLICATION (GRAD_APP_ID)
)ENGINE=InnoDB;

CREATE TABLE BK_GROUND( 
FINANCIAL_AID CHAR(1) NOT NULL, 
TUITION_ASSIST CHAR(1) NOT NULL, 
OTHER_PROG CHAR(1) NOT NULL, 
CONVICTED CHAR(1) NOT NULL, 
EDU_PROBATION CHAR(1) NOT NULL, 
GRAD_APP_ID INT NOT NULL,
FOREIGN KEY (GRAD_APP_ID) REFERENCES APPLICATION (GRAD_APP_ID)
)ENGINE=InnoDB;





CREATE TABLE GENDER( 
GENDER_ID INT NOT NULL, 
GENDER_OPTION CHAR(6) NOT NULL, 
PRIMARY KEY (GENDER_ID) 
)ENGINE=InnoDB;

CREATE TABLE VET_STAT( 
VET_STAT_ID INT NOT NULL, 
VET_STATUS VARCHAR(18) NOT NULL, 
PRIMARY KEY (VET_STAT_ID) 
)ENGINE=InnoDB;

CREATE TABLE MILITARY_BRANCH( 
MIL_ID INT NOT NULL, 
MIL_BRANCH VARCHAR(30) NOT NULL, 
PRIMARY KEY (MIL_ID) 
)ENGINE=InnoDB;

CREATE TABLE STATE( 
STATE_ID CHAR(2) NOT NULL, 
STATE VARCHAR(20) NOT NULL, 
PRIMARY KEY (STATE_ID) 
)ENGINE=InnoDB;

CREATE TABLE PERSONAL_INFO( 
PERSON_ID INT NOT NULL, 
NAME VARCHAR(30) NOT NULL, 
PERFER_NM VARCHAR(30), 
DOB DATE NOT NULL, 
ADDR VARCHAR(30) NOT NULL, 
CITY VARCHAR(20) NOT NULL, 
STATE_ID CHAR(2) NOT NULL, 
ZIP INT NOT NULL, 
PHONE_NUM VARCHAR(12) NOT NULL, 
US_CITIZEN CHAR(1) NOT NULL, 
ENG_LANG_PRIMARY CHAR(1) NOT NULL, 
VET_STAT_ID INT NOT NULL,
MIL_ID INT NOT NULL, 
GENDER_ID INT NOT NULL, 
HISPANIC CHAR(1) NOT NULL,
GRAD_APP_ID INT NOT NULL,  
PRIMARY KEY (PERSON_ID), 
FOREIGN KEY (GRAD_APP_ID) REFERENCES APPLICATION (GRAD_APP_ID), 
FOREIGN KEY (STATE_ID) REFERENCES STATE (STATE_ID), 
FOREIGN KEY (GENDER_ID) REFERENCES GENDER (GENDER_ID), 
FOREIGN KEY (VET_STAT_ID) REFERENCES VET_STAT (VET_STAT_ID), 
FOREIGN KEY (MIL_ID) REFERENCES MILITARY_BRANCH(MIL_ID) 
)ENGINE=InnoDB;

/* INSERT INTO PERSONAL_INFO(PERSON_ID,GRAD_APP_ID) VALUES(11,1); */

CREATE TABLE ETHNICITY(     
ETH_ID INT NOT NULL,     
ETH_CHOICE VARCHAR(35) NOT NULL,     
PRIMARY KEY (ETH_ID)     
)ENGINE=InnoDB;

CREATE TABLE ETH_LINKING( 
PERSON_ID INT NOT NULL, 
ETH_ID INT NOT NULL,
PRIMARY KEY (PERSON_ID, ETH_ID), 
FOREIGN KEY (PERSON_ID) REFERENCES PERSONAL_INFO(PERSON_ID), 
FOREIGN KEY (ETH_ID) REFERENCES ETHNICITY(ETH_ID) 
)ENGINE=InnoDB;


INSERT INTO USR_ACCT VALUES('user1',MD5('drowssap'));

INSERT INTO MAJOR_TYPE VALUES(1,'Certificate in Computer Science
Fundamentals'),(2,'Certificate in Software Architecture and
Design'),(3,'Certificate in Software Project Management');

INSERT INTO DEGREE VALUES (1,'Certificates'),(2,'Master\'s');

INSERT INTO COLLEGE VALUES(1,'College of Science and
Engineering'),(2,'Albers School of Business'),(3,'College of Arts and
Sciences'),(4,'College of Education'),(5,'College of
Nursing'),(6,'School of Theology and Ministry');

INSERT INTO STUDENT_TYPE VALUES(1,'Graduate'),(2,'Graduate Non-
Matriculated'),(3,'Graduate readmission');

INSERT INTO TERM VALUES(1,'FALL 2017'),(2,'FALL 2016'),(3,'SUMMER
2016'),(4,'SUMMER 2017');

INSERT INTO ENTRANCE_TESTS (TEST_TYPE) VALUES ('CBEST'),('GMAT'),('GRE
General'),('IELTS'),('MAT'),('PRAXIS'),('TOEFL'),('WEST-B'),('WEST-E')
;

INSERT INTO GENDER VALUES (1,'MALE'), (2,'FEMALE');

INSERT INTO VET_STAT VALUES(1,'Not a veteran'),(2,'Currently
serving'),(3,'Previously served'),(4,'Current dependent');

INSERT INTO MILITARY_BRANCH VALUES(1,'Army'),(2,'Marine
Corp'),(3,'Navy'),(4,'Air Force'),(5,'Coast Guard');

INSERT INTO STATE VALUES ('AL','Alabama'),('AK','Alaska'),('AZ','Arizo
na'),('AR','Arkansas'),('CA','California'),('CO','Colorado'),('CT','Co
nnecticut'),('DE','Delaware'),('FL','Florida'),('GA','Georgia'),('HI',
'Hawaii'),('ID','Idaho'),('IL','Illinois'),('IN','Indiana'),('IA','Iow
a'),('KS','Kansas'),('KY','Kentucky'),('LA','Louisiana'),('ME','Maine'
),('MD','Maryland'),('MA','Massachusetts'),('MI','Michigan'),('MN','Mi
nnesota'),('MS','Mississippi'),('MO','Missouri'),('MT','Montana'),('NE
','Nebraska'),('NV','Nevada'),('NH','New Hampshire'),('NJ','New
Jersey'),('NM','New Mexico'),('NY','New York'),('NC','North
Carolina'),('ND','North Dakota'),('OH','Ohio'),('OK','Oklahoma'),('OR'
,'Oregon'),('PA','Pennsylvania'),('RI','Rhode Island'),('SC','South
Carolina'),('SD','South Dakota'),('TN','Tennessee'),('TX','Texas'),('U
T','Utah'),('VT','Vermont'),('VA','Virginia'),('WA','Washington'),('WV
','West Virginia'),('WI','Wisconsin'),('WY','Wyoming');

INSERT INTO ETHNICITY VALUES (1,'Asian'),(2,'Black/African
American'),(3,'Native Hawaiian/Pacific Islander'),(4,'Native
American/Native Indian'),(5,'White/Middle Estern');

