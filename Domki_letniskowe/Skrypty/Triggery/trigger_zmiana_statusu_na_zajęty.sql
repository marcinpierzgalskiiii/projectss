USE [Domki_letniskowe]
GO

SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

IF exists (select * from sys.objects where name='trigger_zmiana_statusu_na_zajêty')
BEGIN
	DROP trigger trigger_zmiana_statusu_na_zajêty
END;
GO

create TRIGGER [dbo].trigger_zmiana_statusu_na_zajêty ON [dbo].[Rezerwacje]
After INSERT, UPDATE
AS 
BEGIN

  Declare @data_odjazdu date  
  SET @data_odjazdu = (Select data_odjazdu from   inserted)  

  IF @data_odjazdu > GETDATE()
	Update Domki_letniskowe Set Domki_letniskowe.Status =  'zajety' where Domki_letniskowe.Nr_domku=(Select Nr_domku from  inserted) 
	 
END
