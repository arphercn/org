USE [ProAjax]
GO

SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Customers](
	[CustomerId] [int] IDENTITY(1,1) NOT NULL,
	[Name] [varchar](50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	[Address] [varchar](50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	[City] [varchar](50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	[State] [varchar](50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	[Zip] [varchar](50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	[Phone] [varchar](50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	[Email] [varchar](50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL
) ON [PRIMARY]

GO

INSERT INTO Customers([Name], Address, City, State, Zip, Phone, Email) VALUES ('Michael Smith', '123 Somewhere Road', 'Beverly Hills', 'California', '90210', '(555) 555-1234', 'michael@somewhere.com');
INSERT INTO Customers([Name], Address, City, State, Zip, Phone, Email) VALUES ('Matthew Johnson', '1234 Somewhere Else Street', 'Elsewhere', 'Confusion', '00000', '(555) 555-2345', 'johnboy@neato.net');
INSERT INTO Customers([Name], Address, City, State, Zip, Phone, Email) VALUES ('Cindy Benjamin', '1313 Mockingbird Lane', 'Somewhere', 'Montana', '00000', '(555) 555-9876', 'cindybean@mcok.net');
INSERT INTO Customers([Name], Address, City, State, Zip, Phone, Email) VALUES ('Mary Klein', '10 Highland Avenue', 'Salem', 'Massachusetts', '01970', '(555) 555-4920', 'mary@klein.net');
GO

SET ANSI_PADDING OFF
