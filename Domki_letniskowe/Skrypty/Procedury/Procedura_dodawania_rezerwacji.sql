Use [Domki_letniskowe]
BEGIN
	IF exists (select * from sys.procedures where name='Dodawanie_rezerwacji') 
		DROP PROC dbo.Dodawanie_rezerwacji;
END;
GO
CREATE PROC dbo.Dodawanie_rezerwacji
--Input
@NrRezerwacji AS int,
@Nrdomku AS varchar(20),
@IdKlienta as int,
@NazwaDomku as varchar(25),
@Miejscowo�� as varchar(50),
@DataPrzyjazdu as date,
@DataOdjazdu as date,
@RodzajDomku as varchar(50),
@NrTelefonu as int,
@P�atno�� as varchar(10)

AS
BEGIN
SET NOCOUNT ON;
BEGIN TRY
	DECLARE
		@error_kod nvarchar(5) = '',
		@error_opis nvarchar(200) = '';
	
		IF @Miejscowo�� = ''
		BEGIN
			SET @error_kod = 'ABC01';
			SET @error_opis = 'Nie podano nazwy miejscowo�ci';
			RAISERROR(@error_opis,15,1);
		END
		IF @NazwaDomku = ''
		BEGIN
			SET @error_kod = 'ABC04';
			SET @error_opis = 'Nie podano nazwy domku';
			RAISERROR(@error_opis,15,1);
		END
		IF @DataPrzyjazdu = ''
		BEGIN
			SET @error_kod = 'ABC02';
			SET @error_opis = 'Nie podano daty przyjazdu';
			RAISERROR(@error_opis,15,1);
		END
		IF @DataOdjazdu = ''
		BEGIN
			SET @error_kod = 'ABC03';
			SET @error_opis = 'Nie podano daty odjazdu';
			RAISERROR(@error_opis,15,1);
		END
		IF @P�atno�� = ''
		BEGIN
			SET @error_kod = 'ABC05';
			SET @error_opis = 'Nie podano sposobu p�atno�ci';
			RAISERROR(@error_opis,15,1);
		END
		BEGIN TRY
				Set identity_insert Rezerwacje on
				Insert into Rezerwacje(nr_rezerwacji, nr_domku ,id_klienta ,nazwa_domku,Miejscowo��,data_przyjazdu,data_odjazdu,Rodzaj_domku,nr_telefonu,platnosc)
				values((Select Max(Rezerwacje.nr_rezerwacji)+1 from Rezerwacje),@Nrdomku,@IdKlienta,@NazwaDomku,@Miejscowo��,@DataPrzyjazdu,@DataOdjazdu,@RodzajDomku,@NrTelefonu,@P�atno��)
				Set identity_insert Rezerwacje off
			END TRY
			BEGIN CATCH
				SET @error_kod = 'ABC06';
				SET @error_opis = 'B��d podczas dodawania nowej rezerwacji. ERROR_NUMBER=' + CAST(ERROR_NUMBER() AS nvarchar);
				RAISERROR(@error_opis,15,1)
		END CATCH;
		
END TRY
BEGIN CATCH
	PRINT 'B��d:' + @error_kod;
	PRINT 'Opis:' + @error_opis;
END CATCH
end;
go

--Wywo�anie
exec Dodawanie_rezerwacji 1,7,12,'Halny','Zakopane','2021-07-12','2021-07-19','Bronze',478475145,'gotowka'