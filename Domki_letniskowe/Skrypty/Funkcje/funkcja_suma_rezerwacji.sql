USE [Domki_letniskowe]
IF exists (select * from sys.objects where name='funkcja_suma_rezerwacji')
begin
	DROP function dbo.funkcja_suma_rezerwacji;
end
go

CREATE FUNCTION [dbo].funkcja_suma_rezerwacji()
RETURNS TABLE 
AS
RETURN 

(
   Select Rezerwacje.nazwa_domku , (SUM(DATEDIFF(day,Rezerwacje.data_przyjazdu, Rezerwacje.data_odjazdu)))+1 as ' £¹czna suma zarezerwowanych dni :',(Domki_letniskowe.Cena * Sum((DATEDIFF(day,Rezerwacje.data_przyjazdu, Rezerwacje.data_odjazdu))+1))  as 'Cena do zap³aty'
	from Rezerwacje, Domki_letniskowe
	where Rezerwacje.nazwa_domku = Domki_letniskowe.Nazwa_domku and Rezerwacje.nr_domku= Domki_letniskowe.Nr_domku and Rezerwacje.Miejscowoœæ= Domki_letniskowe.Miejscowoœæ and Rezerwacje.Rodzaj_domku = Domki_letniskowe.[Rodzaj domku] 
	GROUP BY Rezerwacje.nazwa_domku, Domki_letniskowe.Cena
);
go


--Wywo³anie
select *
from funkcja_suma_rezerwacji()

