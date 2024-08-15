Use [Domki_letniskowe]
BEGIN
	IF exists (select * from sys.procedures where name='Edytuj_sposób_p³atnoœci') 
		DROP PROC dbo.Edytuj_sposób_p³atnoœci;
END;
GO
CREATE PROC dbo.Edytuj_sposób_p³atnoœci

@NrRezerwacji AS int,
@P³atnoœæ AS varchar(10)
AS
BEGIN
SET NOCOUNT ON;
BEGIN TRY
	DECLARE
		@err_kod nvarchar(5) = '',
		@err_opis nvarchar(200) = '';

	
	IF @NrRezerwacji = ''
		BEGIN
			SET @err_kod = 'ABC01';
			SET @err_opis = 'Pusty identyfikator';
			RAISERROR(@err_opis,15,1);
		END
	
	ELSE IF  @P³atnoœæ = ''
		BEGIN
			SET @err_kod = 'ABC02';
			SET @err_opis = 'Nie podano sposobu p³atnoœci';
			RAISERROR(@err_opis,15,1);
		END
	
	IF not exists (Select nr_rezerwacji from Rezerwacje where nr_rezerwacji=@NrRezerwacji)
		BEGIN
			SET @err_kod = 'ABC03';
			SET @err_opis = 'Rezerwacja o podanym numerze nie istnieje'
			RAISERROR(@err_opis,15,1);
		END 

--modyfikacja samochodu
			BEGIN TRY
				UPDATE Rezerwacje SET platnosc = @P³atnoœæ  WHERE nr_rezerwacji = @NrRezerwacji;
			END TRY
			BEGIN CATCH
				SET @err_kod = 'ABC04';
				SET @err_opis = 'B³¹d zmiany sposobu p³atnoœci. ERROR_NUMBER=' + CAST(ERROR_NUMBER() AS nvarchar);
				RAISERROR(@err_opis,15,1);
			END CATCH;


END TRY
BEGIN CATCH
	PRINT 'B³¹d:' + @err_kod;
	PRINT 'Opis:' + @err_opis;
END CATCH
end;
go

--Wywo³anie
exec Edytuj_sposób_p³atnoœci 2,'karta'
