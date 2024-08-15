Use [Domki_letniskowe]
BEGIN
	IF exists (select * from sys.procedures where name='procedura_edytuj_cenê_domku') 
		DROP PROC dbo.procedura_edytuj_cenê_domku;
END;
GO
CREATE PROC dbo.procedura_edytuj_cenê_domku

@Nr_domku AS int,
@Cena AS money
AS
BEGIN
SET NOCOUNT ON;
BEGIN TRY
	DECLARE
     @b³êdny_kod nvarchar(18) = '',
     @b³êdny_obiekt nvarchar(150) = '',
	 @b³êdny_opis nvarchar(1000) = '';

	  IF @Nr_domku = ''
		 BEGIN
		      SET @b³êdny_kod = 'DOMER000001';
			  SET @b³êdny_obiekt = 'Nr_domku';
			  SET @b³êdny_opis = 'Pusty Nr_domku';
		
		 END
	
	ELSE IF  @Cena <= 0
		BEGIN
			SET @b³êdny_kod = 'DOMER00002';
			SET @b³êdny_obiekt = 'Niepoprawna cena za dobê w domku';
			SET @b³êdny_opis = 'Podana cena  powinna byæ wiêksza od 0.';
		
		END
	
			BEGIN TRY
				UPDATE Domki_letniskowe SET Cena = @Cena  WHERE Nr_domku = @Nr_domku;
			END TRY
			BEGIN CATCH
				SET @b³êdny_kod = 'CENER00003';
				SET @b³êdny_obiekt = 'Domek';
				SET @b³êdny_opis = 'B³¹d aktualizacji produktu.' + CAST(ERROR_NUMBER() AS nvarchar);
				
			END CATCH;


END TRY
BEGIN CATCH
	PRINT 'B³¹d:' + @b³êdny_kod;
	PRINT 'Obiekt:' + @b³êdny_obiekt;
	PRINT 'Opis:' + @b³êdny_opis;
END CATCH
end;
go

--Wywo³anie
exec procedura_edytuj_cenê_domku 6,500