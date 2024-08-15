USE[Domki_letniskowe]

BEGIN
	IF exists (select * from sys.procedures where name='Raport_wolnych_domków') DROP PROC dbo.Raport_wolnych_domków;
END;
GO

CREATE PROC Raport_wolnych_domków
AS
BEGIN
DECLARE 
  @Nrdomku AS nvarchar(3),
  @NazwaDomku AS nvarchar(30),
  @Miejscowoœæ AS nvarchar(50),
  @RodzajDomku  AS nvarchar(10),
  @Cena AS nvarchar(4),
  @Status AS nvarchar(10);

DECLARE wolny CURSOR FOR
  select * from funkcja_wolne_domki()



OPEN wolny;
FETCH NEXT FROM wolny INTO @Nrdomku,@NazwaDomku, @Miejscowoœæ, @RodzajDomku, @Cena, @Status;

WHILE @@FETCH_STATUS = 0
	BEGIN
		PRINT '   ' +
			  'Nr: '            + @Nrdomku  + '    ' + 
			  'Nazwa: '        + @NazwaDomku  + '    ' +
			  'Miejscowoœæ: '        +  @Miejscowoœæ  + '    ' +
			  'Rodzaj: '            + @RodzajDomku  + '    ' +
			  'Cena: '            + @Cena  + '    ' +
			  'Status: '            + @Status;
			  
		FETCH NEXT FROM wolny INTO @Nrdomku,@NazwaDomku, @Miejscowoœæ, @RodzajDomku, @Cena, @Status;
	END;

CLOSE wolny;
DEALLOCATE wolny;
END;
GO

--Wywo³anie:
exec Raport_wolnych_domków  