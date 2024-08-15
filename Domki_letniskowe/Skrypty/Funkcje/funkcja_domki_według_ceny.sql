Use [Domki_letniskowe]
IF exists (select * from sys.objects where name='funkcja_domki_wed³ug_ceny')
begin
DROP function dbo.funkcja_domki_wed³ug_ceny;
end
go

CREATE FUNCTION funkcja_domki_wed³ug_ceny
(@min int,
@max int
)
RETURNS table
as

	return
	(SELECT Domki_letniskowe.Nr_domku, Domki_letniskowe.Nazwa_domku as Domek,  Cena FROM Domki_letniskowe
	WHERE Domki_letniskowe.Cena >= @min AND Domki_letniskowe.Cena<=@max AND Domki_letniskowe.Nr_domku = Domki_letniskowe.Nr_domku AND Domki_letniskowe.Nazwa_domku = Domki_letniskowe.Nazwa_domku)
	
go

--Wywo³anie
select *
from funkcja_domki_wed³ug_ceny(300,400)
ORDER BY CENA