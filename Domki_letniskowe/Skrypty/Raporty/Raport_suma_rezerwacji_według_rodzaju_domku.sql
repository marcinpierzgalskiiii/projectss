USE[Domki_letniskowe]

BEGIN
	IF exists (select * from sys.procedures where name='Raport_suma_rezerwacji_wed³ug_rodzaju_domku') DROP PROC dbo.Raport_suma_rezerwacji_wed³ug_rodzaju_domku;
END;
GO

CREATE PROC Raport_suma_rezerwacji_wed³ug_rodzaju_domku
AS
BEGIN
DECLARE 
  @Rodzaj_domku AS nvarchar(10),
  @Iloœæ_rezerwacji AS nvarchar(3),
  @Iloœæ_zarezerwowanych_dni AS nvarchar(3);

DECLARE r_rodzaj CURSOR FOR
  select * from funkcja_suma_rezerwacji_wed³ug_rodzaju_domku()



OPEN r_rodzaj;
FETCH NEXT FROM r_rodzaj INTO @Rodzaj_domku, @Iloœæ_rezerwacji, @Iloœæ_zarezerwowanych_dni;

WHILE @@FETCH_STATUS = 0
	BEGIN
		PRINT '   ' +
			  'Rodzaj domku: '            + @Rodzaj_domku  + '    ' + 
			  'Iloœæ rezerwacji: '        + @Iloœæ_rezerwacji  + '    ' +
			  'Iloœæ zarezerwowanych dni: '        + @Iloœæ_zarezerwowanych_dni;
			  
		FETCH NEXT FROM r_rodzaj INTO @Rodzaj_domku, @Iloœæ_rezerwacji, @Iloœæ_zarezerwowanych_dni;
	END;

CLOSE r_rodzaj;
DEALLOCATE r_rodzaj;
END;
GO

--Wywo³anie:
exec Raport_suma_rezerwacji_wed³ug_rodzaju_domku  