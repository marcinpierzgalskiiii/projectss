using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Przychodnia;

namespace Rejestracja
{
    public partial class FormRejestracja : Form
    {
        public FormRejestracja()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            Przychodnia.Dane.Deserialize();
            foreach (CzynnośćMedyczna cz in CzynnośćMedyczna.ListaCzynnościMedycznych)
                comboBox_czynności.Items.Add(cz);

            
        }

		private void comboBox_czynności_SelectionChanged(object sender, EventArgs e)
		{
			//comboBox_pracownicy.Items.Clear();
			//if (comboBox_czynności.selectedIndex == -1)
			//	return;
			//CzynnośćMedyczna cz = (CzynnośćMedyczna) comboBox_czynności.SelectedItem;

			//foreach (PracownikMedyczny p in PracownikMedyczny.ListaPracownikówMedycznych)
			//	if (p.ListaUprawnień.Contains(cz))
			//		comboBox_pracownicy.Add(p);




		}
    }
}
