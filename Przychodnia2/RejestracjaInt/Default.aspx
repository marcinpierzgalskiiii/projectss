<%@ Page Title="Home Page" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="RejestracjaInt._Default" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">

    <div class="jumbotron">
        <h1>Logowanie:</h1>
        <p>Twój e-mail:
            <asp:TextBox ID="TextBox1" runat="server"></asp:TextBox>
        </p>
        <p>Pesel:
            <asp:TextBox ID="TextBox2" runat="server" TextMode="Password"></asp:TextBox>
        </p>
        <h1>
            <asp:Button ID="Button3" runat="server" OnClick="Button3_Click" Text="Button" />
        </h1>
        <p>
            <asp:Label ID="Label1" runat="server" ForeColor="Red" Text="Wprowadzono nieprawidłowe dane" Visible="False"></asp:Label>
        </p>
        <p>
            <asp:Label ID="Label4" runat="server" Text="Zalogowano"></asp:Label>
        </p>
        <p>&nbsp;</p>
        <h1>Zapisz się i wybierz termin</h1>
        <p>
            <asp:Label ID="Label2" runat="server" Text="Wybierz czynność:" Visible="False"></asp:Label>
&nbsp;<asp:DropDownList ID="DropDownList_czynności" runat="server" OnSelectedIndexChanged="DropDownList_czynności_SelectedIndexChanged">
            </asp:DropDownList>
        </p>
        <p>&nbsp;<asp:Label ID="Label3" runat="server" Text="Wybierz pracownika:" Visible="False"></asp:Label>
&nbsp;
            <asp:DropDownList ID="DropDownList2" runat="server" Visible="False">
            </asp:DropDownList>
        </p>
        <p>
            <asp:Button ID="Button2" runat="server" Text="Zapisz się" Visible="False" Width="200px" />
        </p>
    </div>

    <div class="row">
        <div class="col-md-4">
        </div>
    </div>

</asp:Content>
