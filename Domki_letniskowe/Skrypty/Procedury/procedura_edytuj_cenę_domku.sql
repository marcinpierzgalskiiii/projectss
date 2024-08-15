Use [Domki_letniskowe]
BEGIN
	IF exists (select * from sys.procedures where name='procedura_edytuj_cen�_domku') 
		DROP PROC dbo.procedura_edytuj_cen�_domku;
END;
GO
CREATE PROC dbo.procedura_edytuj_cen�_domku

@Nr_domku AS int,
@Cena AS money
AS
BEGIN
SET NOCOUNT ON;
BEGIN TRY
	DECLARE
     @b��dny_kod nvarchar(18) = '',
     @b��dny_obiekt nvarchar(150) = '',
	 @b��dny_opis nvarchar(1000) = '';

	  IF @Nr_domku = ''
		 BEGIN
		      SET @b��dny_kod = 'DOMER000001';
			  SET @b��dny_obiekt = 'Nr_domku';
			  SET @b��dny_opis = 'Pusty Nr_domku';
		
		 END
	
	ELSE IF  @Cena <= 0
		BEGIN
			SET @b��dny_kod = 'DOMER00002';
			SET @b��dny_obiekt = 'Niepoprawna cena za dob� w domku';
			SET @b��dny_opis = 'Podana cena  powinna by� wi�ksza od 0.';
		
		END
	
			BEGIN TRY
				UPDATE Domki_letniskowe SET Cena = @Cena  WHERE Nr_domku = @Nr_domku;
			END TRY
			BEGIN CATCH
				SET @b��dny_kod = 'CENER00003';
				SET @b��dny_obiekt = 'Domek';
				SET @b��dny_opis = 'B��d aktualizacji produktu.' + CAST(ERROR_NUMBER() AS nvarchar);
				
			END CATCH;


END TRY
BEGIN CATCH
	PRINT 'B��d:' + @b��dny_kod;
	PRINT 'Obiekt:' + @b��dny_obiekt;
	PRINT 'Opis:' + @b��dny_opis;
END CATCH
end;
go

--Wywo�anie
exec procedura_edytuj_cen�_domku 6,500