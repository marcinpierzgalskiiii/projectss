USE[Domki_letniskowe]

BEGIN
	IF exists (select * from sys.procedures where name='Raport_wolnych_domk�w') DROP PROC dbo.Raport_wolnych_domk�w;
END;
GO

CREATE PROC Raport_wolnych_domk�w
AS
BEGIN
DECLARE 
  @Nrdomku AS nvarchar(3),
  @NazwaDomku AS nvarchar(30),
  @Miejscowo�� AS nvarchar(50),
  @RodzajDomku  AS nvarchar(10),
  @Cena AS nvarchar(4),
  @Status AS nvarchar(10);

DECLARE wolny CURSOR FOR
  select * from funkcja_wolne_domki()



OPEN wolny;
FETCH NEXT FROM wolny INTO @Nrdomku,@NazwaDomku, @Miejscowo��, @RodzajDomku, @Cena, @Status;

WHILE @@FETCH_STATUS = 0
	BEGIN
		PRINT '   ' +
			  'Nr: '            + @Nrdomku  + '    ' + 
			  'Nazwa: '        + @NazwaDomku  + '    ' +
			  'Miejscowo��: '        +  @Miejscowo��  + '    ' +
			  'Rodzaj: '            + @RodzajDomku  + '    ' +
			  'Cena: '            + @Cena  + '    ' +
			  'Status: '            + @Status;
			  
		FETCH NEXT FROM wolny INTO @Nrdomku,@NazwaDomku, @Miejscowo��, @RodzajDomku, @Cena, @Status;
	END;

CLOSE wolny;
DEALLOCATE wolny;
END;
GO

--Wywo�anie:
exec Raport_wolnych_domk�w  