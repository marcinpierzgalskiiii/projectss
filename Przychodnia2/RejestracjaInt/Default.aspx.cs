using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using Przychodnia;

namespace RejestracjaInt
{
    public partial class _Default : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            Przychodnia.Dane.Deserialize();
            Label1.Visible = Label4.Visible = false;
            DropDownList_czynności.Items.Clear();
            DropDownList2.Items.Clear();
            TextBox1.Text = TextBox2.Text = "";
        }

        Pacjent zalogowany = null;

        protected void Button1_Click(object sender, EventArgs e)
        {
            zalogowany = null;

            foreach (Pacjent p in Pacjent.ListaPacjentów)
                if (p.Email == TextBox1.Text && p.Pesel == TextBox2.Text)
                    zalogowany = p;

            if (zalogowany == null)
                Label1.Visible = true;

            if(zalogowany!=null)
            {
                Label2.Visible = Label3.Visible = true;
                Button2.Visible = true;
                DropDownList_czynności.Visible = DropDownList2.Visible = true;
            }
        }

        protected void Button3_Click(object sender, EventArgs e)
        {
            zalogowany = null;

            foreach (Pacjent p in Pacjent.ListaPacjentów)
                if (p.Email == TextBox1.Text && p.Pesel == TextBox2.Text)
                    zalogowany = p;

            if (zalogowany == null)
                Label1.Visible = true;

            if (zalogowany != null)
                zalogowano();
        }

        private void zalogowano()
        {
            Label1.Visible = false;
            Label2.Visible = Label3.Visible = Label4.Visible = true; 
            Button2.Visible = true;
            DropDownList_czynności.Visible = DropDownList2.Visible = true;

            DropDownList_czynności.Items.Clear();
            foreach (CzynnośćMedyczna czynność in CzynnośćMedyczna.ListaCzynnościMedycznych)
                DropDownList_czynności.Items.Add(czynność.ToString());

        }

        protected void DropDownList1_SelectedIndexChanged(object sender, EventArgs e)
        {
            

        }

        protected void DropDownList_czynności_SelectedIndexChanged(object sender, EventArgs e)
        {
            DropDownList2.Items.Clear();
            if (DropDownList_czynności.SelectedIndex == -1)
                return;

            foreach (PracownikMedyczny p in PracownikMedyczny.ListaPracowników)
                foreach (CzynnośćMedyczna cz in p.ListaUprawnień)
                    if (cz.ToString() == DropDownList_czynności.SelectedValue)
                        DropDownList2.Items.Add(p.ToString());
        }
    }
}