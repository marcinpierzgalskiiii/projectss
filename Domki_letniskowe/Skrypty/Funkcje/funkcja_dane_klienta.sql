USE [Domki_letniskowe]
GO

IF exists (select * from sys.objects where type='FN' AND name='funkcja_dane_klienta')
BEGIN
	DROP FUNCTION funkcja_dane_klienta
END;
GO

CREATE or alter FUNCTION funkcja_dane_klienta(@Idklienta  int = 0)
RETURNS TABLE 
AS
RETURN 
(
   SELECT Klienci.id_klienta, Klienci.Imie, Klienci.Nazwisko, Klienci.Pesel, Klienci.nr_telefonu FROM Klienci
);
GO

--Wywo³anie
select *
from funkcja_dane_klienta(6)