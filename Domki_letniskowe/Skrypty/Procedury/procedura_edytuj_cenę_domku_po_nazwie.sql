Use [Domki_letniskowe]
BEGIN
	IF exists (select * from sys.procedures where name='procedura_edytuj_cenê_domku_po_nazwie') 
	DROP PROC dbo.procedura_edytuj_cenê_domku_po_nazwie;
END;
GO
CREATE PROC dbo.procedura_edytuj_cenê_domku_po_nazwie

@Nazwa_domku AS nvarchar(20),
@Cena AS money,

@Cena_domku_output money OUTPUT

AS
BEGIN
SET NOCOUNT ON;
BEGIN TRY
	DECLARE
		@b³êdny_kod nvarchar(15) = '',
		@b³êdny_obiekt nvarchar(180) = '',
		@b³êdny_opis nvarchar(2300) = '';

	

	IF  (@Nazwa_domku = '' )
		BEGIN
			SET @b³êdny_kod = 'DOMERR000001';
			SET @b³êdny_obiekt = 'NR_domku';
			SET @b³êdny_opis = 'Pusty Nr_domku';
			
	END
	
	ELSE IF  @Cena <= 0
		BEGIN
			SET @b³êdny_kod = 'DOMERR000005';
			SET @b³êdny_obiekt = 'Cena domu mniejsz b¹dŸ równa 0';
			SET @b³êdny_opis = 'Cena domku jest niepoprawna';
			

		END
	

	IF @Cena is null
		BEGIN

			SET @Cena = (SELECT ISNULL(SCOPE_IDENTITY(),0));
		END
	ELSE
		BEGIN

			BEGIN TRY
				UPDATE dbo.Domki_letniskowe SET Cena = @Cena  WHERE Nazwa_domku = @Nazwa_domku ;
			END TRY
			BEGIN CATCH
				SET @b³êdny_kod = 'DOMERR000003';
				SET @b³êdny_obiekt = 'Domek';
				SET @b³êdny_opis = 'B³¹d aktualizacji ceny domku' + CAST(ERROR_NUMBER() AS nvarchar);
				
			END CATCH;
	END

	SET @Cena = @Cena_domku_output;
END TRY
BEGIN CATCH
	
END CATCH
END;
GO



DECLARE @cenaPoEdycji money; 
exec procedura_edytuj_cenê_domku_po_nazwie
	@Nazwa_domku= 'Bryza',
	@Cena = 400,
@Cena_domku_output = @cenaPoEdycji OUTPUT;
