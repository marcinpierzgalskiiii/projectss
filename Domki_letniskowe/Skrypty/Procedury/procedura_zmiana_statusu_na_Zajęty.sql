USE [Domki_letniskowe]
IF exists (select * from sys.objects where name='procedura_zmiana_statusu_na_Zaj�ty')
BEGIN
	DROP procedure procedura_zmiana_statusu_na_Zaj�ty
END;
GO

create procedure procedura_zmiana_statusu_na_Zaj�ty

@Nr_domku AS int,
@Status AS nvarchar(20)
as
    DECLARE
     @b��dny_kod nvarchar(18) = '',
     @b��dny_obiekt nvarchar(150) = '',
	 @b��dny_opis nvarchar(1000) = '';
 BEGIN TRY

				UPDATE dbo.Domki_letniskowe SET Status = @Status  WHERE Nr_domku = @Nr_domku;
  END TRY

            BEGIN CATCH
				SET @b��dny_kod = 'STATER00003';
				SET @b��dny_obiekt = 'B��dny status';
				SET @b��dny_opis = 'B��d aktualizacji statusu.' + CAST(ERROR_NUMBER() AS nvarchar);
				
			END CATCH;
            GO

--Wywo�anie
exec procedura_zmiana_statusu_na_Zaj�ty 5, 'zajety' 

