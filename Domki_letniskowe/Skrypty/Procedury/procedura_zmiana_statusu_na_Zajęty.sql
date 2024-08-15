USE [Domki_letniskowe]
IF exists (select * from sys.objects where name='procedura_zmiana_statusu_na_Zajêty')
BEGIN
	DROP procedure procedura_zmiana_statusu_na_Zajêty
END;
GO

create procedure procedura_zmiana_statusu_na_Zajêty

@Nr_domku AS int,
@Status AS nvarchar(20)
as
    DECLARE
     @b³êdny_kod nvarchar(18) = '',
     @b³êdny_obiekt nvarchar(150) = '',
	 @b³êdny_opis nvarchar(1000) = '';
 BEGIN TRY

				UPDATE dbo.Domki_letniskowe SET Status = @Status  WHERE Nr_domku = @Nr_domku;
  END TRY

            BEGIN CATCH
				SET @b³êdny_kod = 'STATER00003';
				SET @b³êdny_obiekt = 'B³êdny status';
				SET @b³êdny_opis = 'B³¹d aktualizacji statusu.' + CAST(ERROR_NUMBER() AS nvarchar);
				
			END CATCH;
            GO

--Wywo³anie
exec procedura_zmiana_statusu_na_Zajêty 5, 'zajety' 

