USE [Domki_letniskowe]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

IF exists (select * from sys.objects where name='trigger_zmiana_sposobu_płatności')
BEGIN
	DROP trigger trigger_zmiana_sposobu_płatności
END;
GO

create TRIGGER [dbo].trigger_zmiana_sposobu_płatności ON [dbo].[Rezerwacje]
after UPDATE,insert
AS ​
BEGIN
  Declare @platnosc varchar(10)
  SET @platnosc = (Select ​platnosc from inserted)

  IF @platnosc = 'gotowka'
	Update Rezerwacje Set platnosc = 'karta' where Rezerwacje.nr_rezerwacji=(Select nr_rezerwacji from inserted)
	else if
	@platnosc = 'karta'
	Update Rezerwacje Set platnosc = 'gotowka' where Rezerwacje.nr_rezerwacji=(Select nr_rezerwacji from inserted)
END​


