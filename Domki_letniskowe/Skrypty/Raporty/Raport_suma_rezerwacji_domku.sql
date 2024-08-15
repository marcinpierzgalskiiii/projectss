USE[Domki_letniskowe]

BEGIN
	IF exists (select * from sys.procedures where name='Raport_suma_rezerwacji_domku')
	DROP PROC dbo.Raport_suma_rezerwacji_domku;
END;
GO


CREATE PROC Raport_suma_rezerwacji_domku
AS
BEGIN
DECLARE 
  @nazwa_domku AS nvarchar(50),
  @£¹czna_suma_zarezerwowanych_dni AS int,
  @Cena_do_zap³aty AS int
  

DECLARE cursor_domku CURSOR FOR
  select *
from funkcja_suma_rezerwacji()
  
  

OPEN cursor_domku;
FETCH NEXT FROM cursor_domku INTO @nazwa_domku, @£¹czna_suma_zarezerwowanych_dni,  @Cena_do_zap³aty;

WHILE @@FETCH_STATUS = 0
	BEGIN
		PRINT '   ' +
			  'Nazwa_domku: ' + @nazwa_domku  + '    ' + 
			  '£¹czna_suma_zarezerwowanych_dni: ' + CAST (@£¹czna_suma_zarezerwowanych_dni AS nvarchar)  + '    ' +
			  '@Cena_do_zap³aty: ' + CAST (@Cena_do_zap³aty AS nvarchar); 
			  
			  
		FETCH NEXT FROM cursor_domku INTO @nazwa_domku, @£¹czna_suma_zarezerwowanych_dni,  @Cena_do_zap³aty;
	END;

CLOSE cursor_domku;
DEALLOCATE cursor_domku;
END;
GO

--Wywo³anie:
exec Raport_suma_rezerwacji_domku