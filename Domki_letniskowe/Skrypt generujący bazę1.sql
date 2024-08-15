USE master   
GO  
IF  EXISTS (SELECT * FROM sys.databases WHERE name='Domki-letniskowe' )
begin
alter database Domki_letniskowe SET SINGLE_USER WITH ROLLBACK IMMEDIATE
drop database Domki_letniskowe
end
create database Domki_letniskowe
go
Use [Domki_letniskowe]
go

IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Domki_letniskowe]') AND type in (N'U'))
DROP TABLE [dbo].Domki_letniskowe
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Historia]') AND type in (N'U'))
DROP TABLE [dbo].Historia
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Klienci]') AND type in (N'U'))
DROP TABLE [dbo].Klienci
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[najemcy]') AND type in (N'U'))
DROP TABLE [dbo].najemcy
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Rezerwacje]') AND type in (N'U'))
DROP TABLE [dbo].Rezerwacje
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Rodzaje_dkmków]') AND type in (N'U'))
DROP TABLE [dbo].Rodzaje_domków


CREATE TABLE Domki_letniskowe ( 
Nr_domku INT PRIMARY KEY  IDENTITY(1,1) NOT NULL, 
Nazwa_domku VARCHAR (30) UNIQUE NOT NULL, 
Miejscowoœæ VARCHAR (50) NOT NULL, 
[Rodzaj domku] VARCHAR (10) NOT NULL,
Cena INT NOT NULL, 
Status VARCHAR(10) NOT NULL CHECK (status IN ('wolny','zajety')) DEFAULT 'wolny');


CREATE TABLE Klienci( 
id_klienta INT PRIMARY KEY IDENTITY(1,1), 
Imie VARCHAR(30) NOT NULL, 
Nazwisko VARCHAR(30) NOT NULL, 
Pesel VARCHAR(11) NOT NULL UNIQUE CHECK (Pesel NOT LIKE '%[^0-9]%'), 
nr_telefonu INT NOT NULL UNIQUE CHECK (nr_telefonu Not Like '%[^0-9]%'));


CREATE TABLE Rodzaje_domków (
rodzaj_domku VARCHAR(15)
 ); 

CREATE TABLE Rezerwacje ( 
nr_rezerwacji INT PRIMARY KEY  IDENTITY(1,1), 
nr_domku INT NOT NULL, 
id_klienta INT NOT NULL,
nazwa_domku VARCHAR(25) NOT NULL, 
Miejscowoœæ VARCHAR(50) NOT NULL, 
data_przyjazdu DATE NOT NULL, 
data_odjazdu DATE NOT NULL, 
Rodzaj_domku VARCHAR(50) NOT NULL,
nr_telefonu INT NOT NULL UNIQUE CHECK (nr_telefonu Not Like '%[^0-9]%'),
platnosc VARCHAR(10) CHECK (platnosc IN ('gotowka', 'karta')));

CREATE TABLE najemcy ( 
id_rezerwacji INT NOT NULL IDENTITY(1,1), 
nr_najemcy INT PRIMARY KEY,
id_klienta INT NOT NULL,
nr_domku INT NOT NULL,
nazwa_domku VARCHAR(25) NOT NULL ,
nr_rezerwacji INT NOT NULL ,
data_zameldowania DATE NOT NULL, 
data_wymeldowania DATE NOT NULL);


CREATE TABLE Historia ( 
id_klienta INT NOT NULL IDENTITY(1,1), 
nazwa_domku VARCHAR(15) NOT NULL, 
nr_rezerwacji INT PRIMARY KEY   NOT NULL, 
nr_domku INT NOT NULL, 
Miejscowoœæ VARCHAR(50) NOT NULL,
Rodzaj_domku VARCHAR(20) NOT NULL,
data_zameldowania DATE NOT NULL, 
data_wymeldowania DATE NOT NULL);


SET IDENTITY_INSERT [dbo].Domki_letniskowe ON 
INSERT INTO Domki_letniskowe (Nr_domku, Nazwa_domku, Miejscowoœæ, [Rodzaj domku], Cena) 
VALUES (1, 'Bryza', 'Miêdzyzdroje', 'Gold', 300), 
 (2,'Na Fali', '£eba', 'Gold', 350), 
 (3,'Klif', 'Jurata', 'Silver', 300), 
 (4,'Laguna', 'Dêbki', 'Silver', 320), 
(5,'Œnieszka', 'Karpaczi', 'Silver', 400), 
 (6,'Bajka', 'Zakopane', 'Bronze', 300 );

SET IDENTITY_INSERT [dbo].Domki_letniskowe OFF






SET IDENTITY_INSERT [dbo].Historia ON 
INSERT INTO Historia(nazwa_domku, id_klienta, nr_rezerwacji, nr_domku, Miejscowoœæ, Rodzaj_domku, data_zameldowania, data_wymeldowania)
VALUES ('Bryza',1, 1, 1, 'Miêdzyzdroje', 'Gold', '2021-03-5', '2021-03-10'),
('Klif',2, 2, 3, 'Jurata', 'Silver', '2021-03-07', '2021-03-15'),
('Œnieszka',3, 3, 5, 'Dêbki', 'Silver', '2021-03-30', '2021-04-10'),
('Bryza',4, 4, 1, 'Miêdzyzdroje', 'Gold', '2021-03-20', '2021-03-30'),
('Bajka',5, 5, 6, 'Zakopane', 'Bronze', '2021-04-10', '2021-04-19');


SET IDENTITY_INSERT [dbo].Historia OFF


SET IDENTITY_INSERT [dbo].Klienci ON 
INSERT INTO Klienci (id_klienta, Imie, Nazwisko, Pesel, nr_telefonu)
VALUES(1, 'Marcin', 'Gortat', '75091399898', '501234111'),
(2, 'Tadeusz', 'Dzik', '9602295114', '901245671'),
(3, 'Jan', 'Just', '9508177924', '602234141'),
(4, 'Tomasz', 'Wiœniewski', '8801138984', '456711432'),
(5, 'Julia', 'Œwi¹tek', '9107149865', '331311678'),
(6, 'Klaudia', 'Kowalska', '7702039267', '561235098');


SET IDENTITY_INSERT [dbo].Klienci OFF


SET IDENTITY_INSERT [dbo].Najemcy ON 
INSERT INTO Najemcy(id_rezerwacji, nr_Najemcy, id_klienta, nr_domku, nazwa_domku, nr_rezerwacji, data_zameldowania, data_wymeldowania)
VALUES(1, 1, 1, 1, 'Bryza', 1, '2021-05-10', '2021-05-20' ),
(2, 2, 2, 2, 'Na Fali', 2, '2021-05-17', '2021-05-30' ),
(3, 3, 2, 4, 'Laguna', 3, '2021-05-11', '2021-05-25' ),
(4, 4, 2, 6, 'Bajka', 4, '2021-06-16', '2021-06-20' ),
(5, 5, 2, 4, 'Laguna', 5, '2021-06-10', '2021-06-27' );
 



SET IDENTITY_INSERT [dbo].Najemcy OFF



SET IDENTITY_INSERT [dbo].Rezerwacje ON 
INSERT INTO Rezerwacje(nr_rezerwacji, nr_domku, id_klienta, nazwa_domku, Miejscowoœæ, data_przyjazdu, data_odjazdu, Rodzaj_domku, nr_telefonu, platnosc)
VALUES(1, 1, 1, 'Bryza', 'Miêdzyzdroje','2021-05-10', '2021-05-20', 'Gold', 501234111, 'gotowka' ),
(2, 2, 2, 'Na Fali', '£eba','2021-05-17', '2021-05-30','Gold', 901245671, 'karta' ),
(3, 4, 3, 'Laguna', 'Dêbki','2021-07-11', '2021-07-25', 'Silver', 602234141, 'gotowka'),
(4, 6, 4, 'Bajka', 'Zakopane','2021-07-01', '2021-07-20', 'Bronze', 456711432, 'karta');



SET IDENTITY_INSERT [dbo].Rezerwacje OFF




INSERT INTO Rodzaje_domków(rodzaj_domku)
VALUES('Gold'),
('Silver'),
('Bronze');
