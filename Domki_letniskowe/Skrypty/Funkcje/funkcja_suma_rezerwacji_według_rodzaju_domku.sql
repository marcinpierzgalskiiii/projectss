USE [Domki_letniskowe]
IF exists (select * from sys.objects where name='funkcja_suma_rezerwacji_wed�ug_rodzaju_domku')
begin
	DROP function dbo.funkcja_suma_rezerwacji_wed�ug_rodzaju_domku;
end
go

CREATE FUNCTION [dbo].funkcja_suma_rezerwacji_wed�ug_rodzaju_domku()
RETURNS TABLE 
AS
RETURN 

(
   Select Rodzaje_domk�w.rodzaj_domku, COUNT(Rezerwacje.Rodzaj_domku) as 'Ilo�� rezerwacji', (SUM(DATEDIFF(day,Rezerwacje.data_przyjazdu, Rezerwacje.data_odjazdu)))+1 as ' ��czna suma zarezerwowanych dni'
	from Rezerwacje, Domki_letniskowe, Rodzaje_domk�w
	where  Rezerwacje.Miejscowo��= Domki_letniskowe.Miejscowo�� and Rodzaje_domk�w.rodzaj_domku = Rezerwacje.Rodzaj_domku
	GROUP BY Rodzaje_domk�w.rodzaj_domku
	);
go


--Wywo�anie
select *
from funkcja_suma_rezerwacji_wed�ug_rodzaju_domku()

