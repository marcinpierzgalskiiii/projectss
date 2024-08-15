USE [Silownia]
GO
/****** Object:  Table [dbo].[Dostepnosc]    Script Date: 04.04.2022 19:24:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Dostepnosc](
	[dostepnosc_id] [int] IDENTITY(1,1) NOT NULL,
	[wejscie_id] [int] NULL,
	[wyjscie_id] [int] NULL,
	[licznik] [int] NOT NULL,
	[data] [datetime] NOT NULL,
	[karnet_id] [int] NULL,
 CONSTRAINT [PK_Dostepnosc] PRIMARY KEY CLUSTERED 
(
	[dostepnosc_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Karnet]    Script Date: 04.04.2022 19:24:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Karnet](
	[karnet_id] [int] IDENTITY(1,1) NOT NULL,
	[karnet_dlugosc] [int] NOT NULL,
	[karnet_data_rozp] [date] NOT NULL,
	[karnet_data_zakon] [date] NOT NULL,
	[klient_id] [int] NOT NULL,
	[trener_id] [int] NOT NULL,
	[cena] [decimal](10, 2) NOT NULL,
	[rodzaj] [varchar](20) NOT NULL,
 CONSTRAINT [PK_Karnet] PRIMARY KEY CLUSTERED 
(
	[karnet_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Klient]    Script Date: 04.04.2022 19:24:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Klient](
	[klient_id] [int] IDENTITY(1,1) NOT NULL,
	[klient_imie] [varchar](30) NOT NULL,
	[klient_nazwisko] [varchar](30) NOT NULL,
	[klient_telefon] [varchar](10) NOT NULL,
	[klient_email] [varchar](30) NOT NULL,
	[klient_data_urodzenia] [date] NOT NULL,
 CONSTRAINT [PK_Klient] PRIMARY KEY CLUSTERED 
(
	[klient_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Trener]    Script Date: 04.04.2022 19:24:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Trener](
	[trener_id] [int] IDENTITY(1,1) NOT NULL,
	[trener_imie] [varchar](30) NOT NULL,
	[trener_nazwisko] [varchar](30) NOT NULL,
	[trener_specjalizacja] [varchar](30) NOT NULL,
	[trener_doswiadczenie] [varchar](255) NOT NULL,
	[trener_telefon] [varchar](10) NOT NULL,
	[trener_email] [varchar](30) NOT NULL,
 CONSTRAINT [PK_Trener2] PRIMARY KEY CLUSTERED 
(
	[trener_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Wejscie]    Script Date: 04.04.2022 19:24:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Wejscie](
	[wejscie_id] [int] IDENTITY(1,1) NOT NULL,
	[godzina_wejscia] [datetime] NOT NULL,
	[karnet_id] [int] NOT NULL,
 CONSTRAINT [PK_Wejscie] PRIMARY KEY CLUSTERED 
(
	[wejscie_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Wyjscie]    Script Date: 04.04.2022 19:24:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Wyjscie](
	[wyjscie_id] [int] IDENTITY(1,1) NOT NULL,
	[godzina_wyjscia] [datetime] NOT NULL,
	[karnet_id] [int] NOT NULL,
 CONSTRAINT [PK_Wyjscie] PRIMARY KEY CLUSTERED 
(
	[wyjscie_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Dostepnosc] ON 

INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (8, 26, NULL, 1, CAST(N'2022-04-04T19:16:12.650' AS DateTime), 5)
INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (9, NULL, 6, 0, CAST(N'2022-04-04T19:16:17.787' AS DateTime), 5)
INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (10, 27, NULL, 1, CAST(N'2022-04-04T19:16:21.817' AS DateTime), 7)
INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (11, NULL, 7, 0, CAST(N'2022-04-04T19:16:24.430' AS DateTime), 7)
INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (12, 28, NULL, 1, CAST(N'2022-04-04T19:16:29.777' AS DateTime), 3)
INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (13, NULL, 8, 0, CAST(N'2022-04-04T19:16:32.400' AS DateTime), 3)
INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (14, 29, NULL, 1, CAST(N'2022-04-04T19:16:36.383' AS DateTime), 5)
INSERT [dbo].[Dostepnosc] ([dostepnosc_id], [wejscie_id], [wyjscie_id], [licznik], [data], [karnet_id]) VALUES (15, NULL, 9, 0, CAST(N'2022-04-04T19:16:38.917' AS DateTime), 5)
SET IDENTITY_INSERT [dbo].[Dostepnosc] OFF
SET IDENTITY_INSERT [dbo].[Karnet] ON 

INSERT [dbo].[Karnet] ([karnet_id], [karnet_dlugosc], [karnet_data_rozp], [karnet_data_zakon], [klient_id], [trener_id], [cena], [rodzaj]) VALUES (3, 36, CAST(N'2022-04-04' AS Date), CAST(N'2022-05-09' AS Date), 3, 2, CAST(360.00 AS Decimal(10, 2)), N'Gold - 10')
INSERT [dbo].[Karnet] ([karnet_id], [karnet_dlugosc], [karnet_data_rozp], [karnet_data_zakon], [klient_id], [trener_id], [cena], [rodzaj]) VALUES (4, 43, CAST(N'2022-04-04' AS Date), CAST(N'2022-05-16' AS Date), 3, 1, CAST(215.00 AS Decimal(10, 2)), N'Silver - 5 ')
INSERT [dbo].[Karnet] ([karnet_id], [karnet_dlugosc], [karnet_data_rozp], [karnet_data_zakon], [klient_id], [trener_id], [cena], [rodzaj]) VALUES (5, 43, CAST(N'2022-04-04' AS Date), CAST(N'2022-05-16' AS Date), 3, 2, CAST(215.00 AS Decimal(10, 2)), N'Silver - 5 ')
INSERT [dbo].[Karnet] ([karnet_id], [karnet_dlugosc], [karnet_data_rozp], [karnet_data_zakon], [klient_id], [trener_id], [cena], [rodzaj]) VALUES (6, 43, CAST(N'2022-04-04' AS Date), CAST(N'2022-05-16' AS Date), 8, 8, CAST(215.00 AS Decimal(10, 2)), N'Silver - 5 ')
INSERT [dbo].[Karnet] ([karnet_id], [karnet_dlugosc], [karnet_data_rozp], [karnet_data_zakon], [klient_id], [trener_id], [cena], [rodzaj]) VALUES (7, 43, CAST(N'2022-04-04' AS Date), CAST(N'2022-05-16' AS Date), 3, 6, CAST(645.00 AS Decimal(10, 2)), N'Platinium - 15')
SET IDENTITY_INSERT [dbo].[Karnet] OFF
SET IDENTITY_INSERT [dbo].[Klient] ON 

INSERT [dbo].[Klient] ([klient_id], [klient_imie], [klient_nazwisko], [klient_telefon], [klient_email], [klient_data_urodzenia]) VALUES (1, N'Adam', N'Nowak', N'987654321', N'abc@gmail.com', CAST(N'1998-12-28' AS Date))
INSERT [dbo].[Klient] ([klient_id], [klient_imie], [klient_nazwisko], [klient_telefon], [klient_email], [klient_data_urodzenia]) VALUES (3, N'Adam', N'Nowak', N'987654329', N'abcde@gmail.com', CAST(N'1998-12-24' AS Date))
INSERT [dbo].[Klient] ([klient_id], [klient_imie], [klient_nazwisko], [klient_telefon], [klient_email], [klient_data_urodzenia]) VALUES (5, N'Piotr', N'Nowacki', N'987654325', N'piitr@gmail.com', CAST(N'1998-12-24' AS Date))
INSERT [dbo].[Klient] ([klient_id], [klient_imie], [klient_nazwisko], [klient_telefon], [klient_email], [klient_data_urodzenia]) VALUES (8, N'Adamek', N'Nowak', N'987654322', N'abcdea@gmail.com', CAST(N'1998-12-03' AS Date))
SET IDENTITY_INSERT [dbo].[Klient] OFF
SET IDENTITY_INSERT [dbo].[Trener] ON 

INSERT [dbo].[Trener] ([trener_id], [trener_imie], [trener_nazwisko], [trener_specjalizacja], [trener_doswiadczenie], [trener_telefon], [trener_email]) VALUES (1, N'Jan', N'Nowak', N'Fitness', N'Robił tu i tam', N'123456789', N'janek@gmail.com')
INSERT [dbo].[Trener] ([trener_id], [trener_imie], [trener_nazwisko], [trener_specjalizacja], [trener_doswiadczenie], [trener_telefon], [trener_email]) VALUES (2, N'Piotr', N'Kowalski', N'CrossFit', N'Robił tu i  i jeszcze tam', N'123456781', N'piotrek@gmail.com')
INSERT [dbo].[Trener] ([trener_id], [trener_imie], [trener_nazwisko], [trener_specjalizacja], [trener_doswiadczenie], [trener_telefon], [trener_email]) VALUES (5, N'Michał', N'Polak', N'Siłowy', N'Jakiekolgowiek', N'222333444', N'michgal@gmail.com')
INSERT [dbo].[Trener] ([trener_id], [trener_imie], [trener_nazwisko], [trener_specjalizacja], [trener_doswiadczenie], [trener_telefon], [trener_email]) VALUES (6, N'Piotr', N'Polak', N'CrossFit', N'Jakiekolgowiek', N'222333555', N'polak@gmail.com')
INSERT [dbo].[Trener] ([trener_id], [trener_imie], [trener_nazwisko], [trener_specjalizacja], [trener_doswiadczenie], [trener_telefon], [trener_email]) VALUES (7, N'Piotr', N'Kowalik', N'Aeroby ', N'Robił tu i  i jeszcze tam', N'123456782', N'piotrek12@gmail.com')
INSERT [dbo].[Trener] ([trener_id], [trener_imie], [trener_nazwisko], [trener_specjalizacja], [trener_doswiadczenie], [trener_telefon], [trener_email]) VALUES (8, N'Jacek', N'Polak', N'CrossFit', N'Jakiekolgowiek', N'222333111', N'polak2@gmail.com')
INSERT [dbo].[Trener] ([trener_id], [trener_imie], [trener_nazwisko], [trener_specjalizacja], [trener_doswiadczenie], [trener_telefon], [trener_email]) VALUES (9, N'Jacek', N'Kot', N'CrossCare', N'Jakiekolgowiek', N'111333111', N'kot@gmail.com')
SET IDENTITY_INSERT [dbo].[Trener] OFF
SET IDENTITY_INSERT [dbo].[Wejscie] ON 

INSERT [dbo].[Wejscie] ([wejscie_id], [godzina_wejscia], [karnet_id]) VALUES (26, CAST(N'2022-04-04T19:16:12.647' AS DateTime), 5)
INSERT [dbo].[Wejscie] ([wejscie_id], [godzina_wejscia], [karnet_id]) VALUES (27, CAST(N'2022-04-04T19:16:21.817' AS DateTime), 7)
INSERT [dbo].[Wejscie] ([wejscie_id], [godzina_wejscia], [karnet_id]) VALUES (28, CAST(N'2022-04-04T19:16:29.777' AS DateTime), 3)
INSERT [dbo].[Wejscie] ([wejscie_id], [godzina_wejscia], [karnet_id]) VALUES (29, CAST(N'2022-04-04T19:16:36.380' AS DateTime), 5)
SET IDENTITY_INSERT [dbo].[Wejscie] OFF
SET IDENTITY_INSERT [dbo].[Wyjscie] ON 

INSERT [dbo].[Wyjscie] ([wyjscie_id], [godzina_wyjscia], [karnet_id]) VALUES (6, CAST(N'2022-04-04T19:16:17.783' AS DateTime), 5)
INSERT [dbo].[Wyjscie] ([wyjscie_id], [godzina_wyjscia], [karnet_id]) VALUES (7, CAST(N'2022-04-04T19:16:24.427' AS DateTime), 7)
INSERT [dbo].[Wyjscie] ([wyjscie_id], [godzina_wyjscia], [karnet_id]) VALUES (8, CAST(N'2022-04-04T19:16:32.400' AS DateTime), 3)
INSERT [dbo].[Wyjscie] ([wyjscie_id], [godzina_wyjscia], [karnet_id]) VALUES (9, CAST(N'2022-04-04T19:16:38.780' AS DateTime), 5)
SET IDENTITY_INSERT [dbo].[Wyjscie] OFF
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__Klient__1AB3D82F7CA8DE67]    Script Date: 04.04.2022 19:24:41 ******/
ALTER TABLE [dbo].[Klient] ADD UNIQUE NONCLUSTERED 
(
	[klient_email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__Klient__34E03B825298284F]    Script Date: 04.04.2022 19:24:41 ******/
ALTER TABLE [dbo].[Klient] ADD UNIQUE NONCLUSTERED 
(
	[klient_telefon] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__Trener__7023F77294C63AC5]    Script Date: 04.04.2022 19:24:41 ******/
ALTER TABLE [dbo].[Trener] ADD  CONSTRAINT [UQ__Trener__7023F77294C63AC5] UNIQUE NONCLUSTERED 
(
	[trener_telefon] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__Trener__86306C8A288AF126]    Script Date: 04.04.2022 19:24:41 ******/
ALTER TABLE [dbo].[Trener] ADD  CONSTRAINT [UQ__Trener__86306C8A288AF126] UNIQUE NONCLUSTERED 
(
	[trener_email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Dostepnosc]  WITH CHECK ADD  CONSTRAINT [FK_Dostepnosc_Karnet] FOREIGN KEY([karnet_id])
REFERENCES [dbo].[Karnet] ([karnet_id])
GO
ALTER TABLE [dbo].[Dostepnosc] CHECK CONSTRAINT [FK_Dostepnosc_Karnet]
GO
ALTER TABLE [dbo].[Dostepnosc]  WITH CHECK ADD  CONSTRAINT [FK_Dostepnosc_Wejscie] FOREIGN KEY([wejscie_id])
REFERENCES [dbo].[Wejscie] ([wejscie_id])
GO
ALTER TABLE [dbo].[Dostepnosc] CHECK CONSTRAINT [FK_Dostepnosc_Wejscie]
GO
ALTER TABLE [dbo].[Dostepnosc]  WITH CHECK ADD  CONSTRAINT [FK_Dostepnosc_Wyjscie] FOREIGN KEY([wyjscie_id])
REFERENCES [dbo].[Wyjscie] ([wyjscie_id])
GO
ALTER TABLE [dbo].[Dostepnosc] CHECK CONSTRAINT [FK_Dostepnosc_Wyjscie]
GO
ALTER TABLE [dbo].[Karnet]  WITH CHECK ADD  CONSTRAINT [FK_Karnet_Klient] FOREIGN KEY([klient_id])
REFERENCES [dbo].[Klient] ([klient_id])
GO
ALTER TABLE [dbo].[Karnet] CHECK CONSTRAINT [FK_Karnet_Klient]
GO
ALTER TABLE [dbo].[Karnet]  WITH CHECK ADD  CONSTRAINT [FK_Karnet_Trener] FOREIGN KEY([trener_id])
REFERENCES [dbo].[Trener] ([trener_id])
GO
ALTER TABLE [dbo].[Karnet] CHECK CONSTRAINT [FK_Karnet_Trener]
GO
