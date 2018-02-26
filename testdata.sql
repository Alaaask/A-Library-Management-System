CREATE DATABASE LIBRARY;
USE LIBRARY;

CREATE TABLE ADMIN(
    MID CHAR(20) NOT NULL,
    MPWD VARCHAR(10) NOT NULL,
    PRIMARY KEY(MID)
);

CREATE TABLE READER(
    RID CHAR(20) NOT NULL,
    RPWD VARCHAR(10) NOT NULL,
    EMAIL VARCHAR(25) NOT NULL,
    PRIMARY KEY(RID)
);

CREATE TABLE BOOKNAME(
    ISBN CHAR(7) NOT NULL,
    BNAME VARCHAR(40) NOT NULL
);

CREATE TABLE BOOKAUTHOR(
    ISBN CHAR(7) NOT NULL,
    AUTHOR VARCHAR(20) NOT NULL,
    PRIMARY KEY(ISBN)
);

CREATE TABLE BOOKKEY(
    ISBN CHAR(7) NOT NULL,
    KEY_1 CHAR(15),
    KEY_2 CHAR(15),
    KEY_3 CHAR(15),
    PRIMARY KEY(ISBN)
);

CREATE TABLE PRESSLIST(
    ISBN CHAR(7) NOT NULL,
    PRESS VARCHAR(30),
    PTIME DATE,
    PRIMARY KEY(ISBN)
);

CREATE TABLE STORAGE(
    ISBN CHAR(7) NOT NULL,
    TOTAL SMALLINT NOT NULL,
    COPY SMALLINT NOT NULL,
    LOCATE CHAR(15) NOT NULL,
    PRIMARY KEY(ISBN)
);

CREATE TABLE BORROW(
    ISBN CHAR(7) NOT NULL,
    RID CHAR(20) NOT NULL,
    STIME DATE,
	DONE CHAR,
    ETIME DATE,
    PRIMARY KEY(ISBN,RID,STIME)
);

CREATE TABLE RESERVE(
    ISBN CHAR(7) NOT NULL,
    RID CHAR(20) NOT NULL,
    STIME DATE,
    PRIMARY KEY(ISBN,RID)
);

INSERT INTO ADMIN
          (MID,MPWD)
    VALUES('BOSS','000000'),
	      ('DALAO','888888');

INSERT INTO READER
          (RID,RPWD,EMAIL)
    VALUES('LIMING','990224','aaa@fudan.edu.cn'),
	      ('WANGFANG','881212','bbb@fudan.edu.cn'),
		  ('EGONGHEYE','830617','ccc@fudan.edu.cn'),
		  ('HANMEIMIE','970515','ddd@fudan.edu.cn'),
		  ('SUNHONGLEI','770912','eee@fudan.edu.cn'),
		  ('WANGMEI','950505','fff@fudan.edu.cn'),
		  ('ZHANGJUN','781111','ggg@fudan.edu.cn'),
		  ('LIUXING','691009','hhh@fudan.edu.cn'),
		  ('YANGWEI','840822','iii@fudan.edu.cn'),
		  ('FEIFEI','920318','jjj@fudan.edu.cn'),
		  ('LIJUN','691230','kkk@fudan.edu.cn'),
		  ('ZHAOCHENG','770506','lll@fudan.edu.cn'),
		  ('ZHOUYI','950304','mmm@fudan.edu.cn'),
		  ('DAXUE','000419','nnn@fudan.edu.cn'),
		  ('XIAOHUA','980304','ooo@fudan.edu.cn'),
		  ('PENGLIAN','890234','ppp@fudan.edu.cn'),
		  ('TOM','010723','qqq@fudan.edu.cn'),
		  ('SHERLOCK','880808','rrr@fudan.edu.cn'),
		  ('JERRY','960304','sss@fudan.edu.cn'),
		  ('PAIPAI','970707','ttt@fudan.edu.cn');
		  
INSERT INTO BOOKNAME
          (ISBN,BNAME)
	VALUES('A000001','Computer Science'),
	      ('A000002','Computer System'),
		  ('A000003','Database System'),
		  ('A000004','Data Stucture'),
		  ('B000001','Brief History of Time'),
		  ('B000002','Particle Physics'),
		  ('B000003','Analysis Physics'),
		  ('C000001','The Fiction of Evil'),
		  ('C000002','Shakespearean Criticism'),
		  ('C000003','The Greek Classics'),
		  ('D000001','Gender Socialization'),
		  ('D000002','Social Psychology'),
		  ('D000003','Attachment Theory'),
		  ('E000001','The Economics of Music'),
		  ('E000002','The Enjoyment of Music'),
		  ('E000003','Popular Music in India'),
		  ('F000001','The Economic Way of Thinking'),
		  ('F000002','History of Economy'),
		  ('F000003','The Green Economy'),
		  ('G000001','Health,Illness,and Society'),
		  ('G000002','Emergency Radiology'),
		  ('G000003','My Medical Dictionary');

INSERT INTO BOOKAUTHOR
          (ISBN,AUTHOR)
    VALUES('A000001','Dipsy'),
		  ('A000002','Tinky'),
		  ('A000003','Laa-laa'),
		  ('A000004','Po'),
		  ('B000001','Doudou'),
		  ('B000002','Feifei'),
		  ('B000003','Miaomiao'),
		  ('C000001','Huahua'),
		  ('C000002','Yuyu'),
		  ('C000003','Tommy'),
		  ('D000001','Jack'),
		  ('D000002','Smith'),
		  ('D000003','Jordin'),
		  ('E000001','Lance'),
		  ('E000002','Juliet'),
		  ('E000003','Kaka'),
		  ('F000001','Greyson'),
		  ('F000002','Wangwang'),
		  ('F000003','Toby'),
		  ('G000001','Sally'),
		  ('G000002','Susan'),
		  ('G000003','Piupiu');
		  
INSERT INTO BOOKKEY
          (ISBN,KEY_1,KEY_2,KEY_3)
	VALUES('A000001','computer','science','technology'),
		  ('A000002','computer','science','system'),
		  ('A000003','computer','data','system'),
		  ('A000004','data','computer','structure'),
		  ('B000001','physics','history','science'),
		  ('B000002','physics','science','theory'),
		  ('B000003','physics','science','theory'),
		  ('C000001','literature','fiction','england'),
		  ('C000002','england','literature','shakespear'),
		  ('C000003','greek','literature','classics'),
		  ('D000001','gender','social','psychology'),
		  ('D000002','theory','social','psychology'),
		  ('D000003','theory','social','psychology'),
		  ('E000001','economic','music','art'),
		  ('E000002','enjoy','music','art'),
		  ('E000003','india','music','art'),
		  ('F000001','economic','theory','social'),
		  ('F000002','history','economic','global'),
		  ('F000003','green','economic','theory'),
		  ('G000001','medical','theory','social'),
		  ('G000002','medical','theory','technology'),
		  ('G000003','medical','theory','technology');
	
INSERT INTO PRESSLIST
          (ISBN,PRESS,PTIME)
	VALUES('A000001','IGI Global','2007-3-4'),
	      ('A000002','Brill','2008-4-5'),
		  ('A000003','Brill','2009-11-11'),
		  ('A000004','Cengage Learning','2001-2-1'),
		  ('B000001','United Nations Publications','2005-12-3'),
		  ('B000002','IGI Global','2007-3-4'),
		  ('B000003','Cengage Learning','2009-5-5'),
		  ('C000001','Cengage Learning','2001-2-1'),
		  ('C000002','United Nations Publications','2005-12-3'),
		  ('C000003','IGI Global','2006-3-3'),
		  ('D000001','United Nations Publications','2006-3-3'),
		  ('D000002','Springer','2007-3-4'),
		  ('D000003','Cengage Learning','2009-5-5'),
		  ('E000001','Brill','2012-8-12'),
		  ('E000002','Springer','2012-8-12'),
		  ('E000003','Springer','2010-9-23'),
		  ('F000001','Elsevier','2010-9-23'),
		  ('F000002','Brill','2005-12-3'),
		  ('F000003','Elsevier','2005-12-5'),
		  ('G000001','United Nations Publications','2011-10-10'),
		  ('G000002','IGI Global','2012-1-1'),
		  ('G000003','Springer','2002-11-28');

		  
INSERT INTO STORAGE
          (ISBN,TOTAL,COPY,LOCATE)
	VALUES('A000001',4,1,'Z-11-T5'),
		  ('A000002',5,0,'H-34-Y7'),
		  ('A000003',2,0,'Z-56-W2'),
		  ('A000004',3,2,'H-3-H3'),
		  ('B000001',4,4,'J-18-A2'),
		  ('B000002',4,1,'J-16-Y3'),
		  ('B000003',3,0,'Z-22-K1'),
		  ('C000001',2,1,'F-11-D4'),
		  ('C000002',2,0,'F-12-M9'),
		  ('C000003',3,3,'Z-44-N3'),
		  ('D000001',2,1,'Z-14-V2'),
		  ('D000002',2,0,'H-56-X1'),
		  ('D000003',1,0,'H-19-Z5'),
		  ('E000001',3,2,'J-32-J6'),
		  ('E000002',1,0,'J-55-G2'),
		  ('E000003',5,2,'Z-10-C3'),
		  ('F000001',3,2,'Z-13-B2'),
		  ('F000002',3,0,'H-33-D5'),
		  ('F000003',3,2,'H-72-L1'),
		  ('G000001',3,1,'F-33-R4'),
		  ('G000002',2,0,'F-10-G4'),
		  ('G000003',4,1,'Z-51-S9');
		  
INSERT INTO BORROW
          (ISBN,RID,STIME,DONE,ETIME)
	VALUES('B000001','YANGWEI','2017-1-1','T','2017-2-1'),
	      ('C000002','ZHAOCHENG','2017-1-1','T','2017-3-2'),
		  ('G000001','LIMING','2017-1-1','T','2017-1-3'),
		  ('E000003','TOM','2017-2-4','T','2017-3-4'),
		  ('G000002','HANMEIMIE','2017-2-27','T','2017-4-27'),
		  ('F000001','WANGFANG','2017-3-25','T','2017-3-27'),
		  ('G000003','ZHAOCHENG','2017-3-25','T','2017-5-8'),
		  ('A000002','SHERLOCK','2017-3-25','T','2017-5-10'),
		  ('B000001','SHERLOCK','2017-3-25','T','2017-3-27'),
		  ('C000001','SHERLOCK','2017-4-21','T','2017-4-27'),
		  ('F000002','SHERLOCK','2017-4-21','T','2017-4-27'),
		  ('B000003','ZHAOCHENG','2017-4-22','T','2017-5-1'),
		  ('E000002','DAXUE','2017-4-22','T','2017-4-27'),
		  ('B000003','ZHANGJUN','2017-4-22','T','2017-5-3'),
		  ('D000003','SHERLOCK','2017-4-22','T','2017-4-29'),
		  ('F000001','XIAOHUA','2017-4-23','T','2017-5-2'),
		  ('G000002','EGONGHEYE','2017-4-23','T','2017-5-1'),
		  ('C000003','XIAOHUA','2017-4-24','T','2017-5-4'),
		  ('F000002','YANGWEI','2017-4-25','T','2017-5-2'),
		  ('C000003','SHERLOCK','2017-4-27','T','2017-5-1'),
		  ('B000002','EGONGHEYE','2017-4-30','T','2017-5-7'),
		  ('D000002','PENGLIAN','2017-5-1','T','2017-5-3'),
		  ('B000003','WANGFANG','2017-5-1','F','2017-7-1'),
		  ('B000001','HANMEIMIE','2017-5-1','T','2017-5-3'),
		  ('A000002','YANGWEI','2017-5-1','F','2017-7-1'),
		  ('A000002','ZHANGJUN','2017-5-1','F','2017-7-1'),
		  ('E000003','SHERLOCK','2017-5-1','F','2017-7-1'),
		  ('B000002','ZHOUYI','2017-5-2','F','2017-7-2'),
		  ('A000002','WANGFANG','2017-5-2','F','2017-7-2'),
		  ('E000001','HANMEIMIE','2017-5-2','F','2017-7-2'),
		  ('G000003','XIAOHUA','2017-3-3','F','2017-5-3'),
		  ('G000003','DAXUE','2017-5-2','F','2017-7-2'),
		  ('A000002','WANGMEI','2017-5-3','F','2017-7-3'),
		  ('F000002','ZHOUYI','2017-5-3','F','2017-7-3'),
		  ('G000002','PAIPAI','2017-5-3','F','2017-7-3'),
		  ('G000001','PENGLIAN','2017-5-3','F','2017-7-3'),
		  ('A000002','DAXUE','2017-3-9','F','2017-5-9'),
		  ('E000003','HANMEIMIE','2017-5-3','F','2017-7-3'),
		  ('B000001','LIUXING','2017-5-3','T','2017-5-3'),
		  ('G000002','TOM','2017-5-4','F','2017-7-4'),
		  ('G000003','TOM','2017-5-4','F','2017-7-4'),
		  ('E000003','WANGFANG','2017-5-4','F','2017-7-4'),
		  ('C000001','PAIPAI','2017-5-4','T','2017-5-8'),
		  ('D000001','YANGWEI','2017-5-4','T','2017-5-5'),
		  ('A000001','SHERLOCK','2017-5-4','T','2017-5-6'),
		  ('F000002','PAIPAI','2017-5-4','F','2017-7-4'),
		  ('G000001','ZHAOCHENG','2017-5-4','F','2017-7-4'),
		  ('D000002','LIUXING','2017-5-4','F','2017-7-4'),
		  ('B000002','SUNHONGLEI','2017-5-4','F','2017-7-4'),
		  ('D000003','ZHOUYI','2017-5-5','F','2017-7-5'),
		  ('A000001','SUNHONGLEI','2017-5-5','F','2017-7-5'),
		  ('D000001','LIJUN','2017-5-5','F','2017-7-5'),
		  ('C000001','LIMING','2017-5-5','F','2017-7-5'),
		  ('C000002','ZHANG JUN','2017-5-5','F','2017-7-5'),
		  ('A000001','LIUXING','2017-5-5','F','2017-7-5'),
		  ('D000002','SHERLOCK','2017-5-5','F','2017-7-5'),
		  ('B000002','JERRY','2017-3-7','F','2017-5-7'),
		  ('B000003','LIJUN','2017-5-6','F','2017-7-6'),
		  ('F000001','SHERLOCK','2017-5-6','F','2017-7-6'),
		  ('B000003','JERRY','2017-3-2','F','2017-5-2'),
		  ('F000002','LIMING','2017-5-6','F','2017-7-6'),
		  ('A000003','SHERLOCK','2017-5-6','F','2017-7-6'),
		  ('C000002','SUNHONGLEI','2017-3-13','F','2017-5-13'),
		  ('F000003','FEIFEI','2017-5-7','F','2017-7-7'),
		  ('A000003','EGONGHEYE','2017-5-7','F','2017-7-7'),
		  ('E000002','WANGMEI','2017-5-7','F','2017-7-7'),
		  ('A000001','SHERLOCK','2017-3-8','F','2017-5-8'),
		  ('A000004','SHERLOCK','2017-5-7','F','2017-7-7');
		  
INSERT INTO RESERVE
		  (ISBN,RID,STIME)
	VALUES('A000002','PAIPAI','2017-5-3'),
	      ('D000002','JERRY','2017-5-5'),
		  ('G000002','SHERLOCK','2017-5-6'),
	      ('C000002','ZHOUYI','2017-5-7'),
	      ('A000003','SUNHONGLEI','2017-5-7'),
		  ('F000002','PENGLIAN','2017-5-7'),
		  ('E000002','SHERLOCK','2017-5-8');


		  
