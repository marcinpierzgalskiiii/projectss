Use [Domki_letniskowe]
BEGIN
	IF exists (select * from sys.procedures where name='Dodawanie_klienta') 
		DROP PROC dbo.Dodawanie_klienta;
END;
GO
CREATE PROC dbo.Dodawanie_klienta

@IdKlienta AS int,
@Imie AS varchar(30),
@Nazwisko AS varchar(30),
@PESEL as varchar(11),
@NrTelefonu as int

AS
BEGIN
SET NOCOUNT ON;
BEGIN TRY
	DECLARE
		@error_kod nvarchar(5) = '',
		@error_opis nvarchar(200) = '';
	
		IF @Imie = ''
		BEGIN
			SET @error_kod = 'ABC01';
			SET @error_opis = 'Nie podano imienia';
			RAISERROR(@error_opis,15,1);
		END
		IF @Nazwisko = ''
		BEGIN
			SET @error_kod = 'ABC02';
			SET @error_opis = 'Nie podano nazwiska';
			RAISERROR(@error_opis,15,1);
		END
		IF @PESEL = ''
		BEGIN
			SET @error_kod = 'ABC03';
			SET @error_opis = 'Nie podano numeru PESEL';
			RAISERROR(@error_opis,15,1);
		END
		IF @NrTelefonu = ''
		BEGIN
			SET @error_kod = 'ABC04';
			SET @error_opis = 'Nie podano numeru telefonu';
			RAISERROR(@error_opis,15,1);
		END
		BEGIN TRY
				Set identity_insert Klienci on
				Insert into Klienci(id_klienta, Imie ,Nazwisko ,Pesel,nr_telefonu)
				values((Select Max(Klienci.id_klienta)+1 from Klienci),@Imie,@Nazwisko,@PESEL,@NrTelefonu)
				Set identity_insert Rezerwacje off
			END TRY
			BEGIN CATCH
				SET @error_kod = 'ABC05';
				SET @error_opis = 'B³¹d podczas dodawania nowego klienta. ERROR_NUMBER=' + CAST(ERROR_NUMBER() AS nvarchar);
				RAISERROR(@error_opis,15,1)
		END CATCH;
		
END TRY
BEGIN CATCH
	PRINT 'B³¹d:' + @error_kod;
	PRINT 'Opis:' + @error_opis;
END CATCH
end;
go

--Wywo³anie
exec Dodawanie_klienta 1,'Krzysztof', 'Stonoga', '841102254784',125478547