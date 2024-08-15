USE [Domki_letniskowe]
IF exists (select * from sys.objects where name='funkcja_suma_rezerwacji_wed³ug_rodzaju_domku')
begin
	DROP function dbo.funkcja_suma_rezerwacji_wed³ug_rodzaju_domku;
end
go

CREATE FUNCTION [dbo].funkcja_suma_rezerwacji_wed³ug_rodzaju_domku()
RETURNS TABLE 
AS
RETURN 

(
   Select Rodzaje_domków.rodzaj_domku, COUNT(Rezerwacje.Rodzaj_domku) as 'Iloœæ rezerwacji', (SUM(DATEDIFF(day,Rezerwacje.data_przyjazdu, Rezerwacje.data_odjazdu)))+1 as ' £¹czna suma zarezerwowanych dni'
	from Rezerwacje, Domki_letniskowe, Rodzaje_domków
	where  Rezerwacje.Miejscowoœæ= Domki_letniskowe.Miejscowoœæ and Rodzaje_domków.rodzaj_domku = Rezerwacje.Rodzaj_domku
	GROUP BY Rodzaje_domków.rodzaj_domku
	);
go


--Wywo³anie
select *
from funkcja_suma_rezerwacji_wed³ug_rodzaju_domku()

