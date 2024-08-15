USE [Domki_letniskowe]
BEGIN
IF exists (select * from sys.procedures where name='Raport_rezerwacji') 
	DROP PROC dbo.Raport_rezerwacji;
END;
GO

CREATE PROC Raport_rezerwacji
AS
BEGIN
DECLARE
@nr_rezerwacji AS int,
@nr_domku AS int,
@id_klienta AS int,
@nazwa_domku AS nvarchar(30),
@Miejscowoœæ AS nvarchar(50),
@data_przyjazdu as date,
@data_odjazdu as date,
@Rodzaj_domku as nvarchar(30),
@nr_telefonu as int,
@platnosc as  nvarchar(30)



DECLARE cursor_rezerwacji CURSOR FOR

select * 
from funkcja_info_o_rezerwacji(6)


OPEN cursor_rezerwacji;
FETCH NEXT FROM cursor_rezerwacji INTO @nr_rezerwacji, @nr_domku, @id_klienta, @nazwa_domku, @Miejscowoœæ, @data_przyjazdu, @data_odjazdu, @Rodzaj_domku,  @nr_telefonu, @platnosc

WHILE @@FETCH_STATUS = 0
BEGIN
PRINT ' ' +
'Nr_rezerwacji : ' +CAST  (@nr_rezerwacji AS nvarchar) + ' ' +
'Nr_domku: ' +CAST  (@nr_domku AS nvarchar) + ' ' +
'Id_klienta: ' +CAST  (@id_klienta AS nvarchar)  + ' ' +
'Nazwa_domku: ' +@nazwa_domku  + ' ' +
'Miejscowoœæ: ' + @Miejscowoœæ  + ' ' +
'Data_przyjazdu: ' +CAST (@data_przyjazdu AS nvarchar)  + ' ' +
'Data_odjazdu: ' +CAST (@data_odjazdu AS nvarchar) + ' ' +
'Rodzaj_domku: ' +  @Rodzaj_domku   + ' ' +
'Nr_telefonu: '+ CAST (@nr_telefonu AS nvarchar) + ' ' +
'Platnosc: ' +@platnosc;



FETCH NEXT FROM cursor_rezerwacji INTO @nr_rezerwacji, @nr_domku, @id_klienta, @nazwa_domku, @Miejscowoœæ, @data_przyjazdu, @data_odjazdu, @Rodzaj_domku, @nr_telefonu, @platnosc
END;



CLOSE cursor_rezerwacji;
DEALLOCATE cursor_rezerwacji;
END;
GO


--Wywo³anie
exec Raport_rezerwacji
