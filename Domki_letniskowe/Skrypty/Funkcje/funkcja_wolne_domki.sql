Use [Domki_letniskowe]
IF exists (select * from sys.objects where name='funkcja_wolne_domki')
begin
DROP function dbo.funkcja_wolne_domki;
end
go

CREATE FUNCTION funkcja_wolne_domki()

RETURNS table
as

	return
	(SELECT Domki_letniskowe.Nr_domku, Domki_letniskowe.Nazwa_domku, Domki_letniskowe.Miejscowoœæ, Domki_letniskowe.[Rodzaj domku], Domki_letniskowe.Cena, Status FROM Domki_letniskowe
	WHERE Status ='wolny');

	
go

--Wywo³anie
select *
from funkcja_wolne_domki()