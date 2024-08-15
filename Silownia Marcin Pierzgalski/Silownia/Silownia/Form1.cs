using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Silownia
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        int trener_rekord_id;
        int klient_rekord_id;
        int trener_karnet_rekord_id;
        int klient_karnet_rekord_id;
        int karnet_rekord_id;
        int karnet_wejscia_id;
        int l;
        int wyjscie_id;
        int wejscie_id;



        public System.Data.DataView DefaultView { get; }


        private void Form1_Load(object sender, EventArgs e)
        {
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Dostepnosc' . Możesz go przenieść lub usunąć.
            this.dostepnoscTableAdapter.Fill(this.silowniaDataSet1.Dostepnosc);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Wyjscie' . Możesz go przenieść lub usunąć.
            this.wyjscieTableAdapter1.Fill(this.silowniaDataSet1.Wyjscie);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Wejscie' . Możesz go przenieść lub usunąć.
            this.wejscieTableAdapter1.Fill(this.silowniaDataSet1.Wejscie);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Karnet' . Możesz go przenieść lub usunąć.
            this.karnetTableAdapter1.Fill(this.silowniaDataSet1.Karnet);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Karnet' . Możesz go przenieść lub usunąć.
            this.karnetTableAdapter1.Fill(this.silowniaDataSet1.Karnet);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Klient' . Możesz go przenieść lub usunąć.
            this.klientTableAdapter1.Fill(this.silowniaDataSet1.Klient);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Trener' . Możesz go przenieść lub usunąć.
            this.trenerTableAdapter1.Fill(this.silowniaDataSet1.Trener);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Wyjscie' . Możesz go przenieść lub usunąć.
            this.wyjscieTableAdapter1.Fill(this.silowniaDataSet1.Wyjscie);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Wejscie' . Możesz go przenieść lub usunąć.
            this.wejscieTableAdapter1.Fill(this.silowniaDataSet1.Wejscie);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Karnet' . Możesz go przenieść lub usunąć.
            this.karnetTableAdapter1.Fill(this.silowniaDataSet1.Karnet);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Klient' . Możesz go przenieść lub usunąć.
            this.klientTableAdapter1.Fill(this.silowniaDataSet1.Klient);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet1.Trener' . Możesz go przenieść lub usunąć.
            this.trenerTableAdapter1.Fill(this.silowniaDataSet1.Trener);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet.Wyjscie' . Możesz go przenieść lub usunąć.
            this.dostepnoscTableAdapter.Fill(this.silowniaDataSet1.Dostepnosc);
            // TODO: Ten wiersz kodu wczytuje dane do tabeli 'silowniaDataSet.Wyjscie' . Możesz go przenieść lub usunąć.


        }

        public static bool CzySameCyfry(string slowo)
        {
            foreach (char cyfra in slowo)
            {
                if (char.IsDigit(cyfra))
                    return true;
            }
            return false;
        }

        



static public bool CzyUkonczone15Lat(DateTime data_urodzenia)
        {

            double liczba_dni = ((DateTime.Today - data_urodzenia).TotalDays);
            if (liczba_dni > (365 * 15))
            {
                return true;
            }
            return false;
        }

        private void buttonDodajTr_Click(object sender, EventArgs e)
        {
           

            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();


            if (string.IsNullOrWhiteSpace(textBoxTrImie.Text) || string.IsNullOrWhiteSpace(textBoxTrNazwisko.Text) || comboBox1.Items==null 
                || string.IsNullOrWhiteSpace(textBoxTrTelefon.Text) || string.IsNullOrWhiteSpace(textBoxTrMail.Text) || string.IsNullOrWhiteSpace(textBoxDosw.Text))
            {
                MessageBox.Show("Uzupełnij brakujące pola");
                return;
            }
            if (textBoxTrImie.TextLength < 3)
            {
                MessageBox.Show("Imię musi zawierać przynajmnej 3 litery");
                return;
            }

            string s = textBoxTrImie.Text;
            foreach (char litera in s)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Imię nie może zawierać cyfr");
                    return;
                }
                  
            }

            string nazwisk = textBoxTrNazwisko.Text;
            foreach (char litera in nazwisk)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Nazwisko nie może zawierać cyfr");
                    return;
                }

            }
        
           string cyfraa = textBoxTrTelefon.Text;
            foreach (char cyfra in cyfraa)
            {
                if (!char.IsDigit(cyfra))
                {
                    MessageBox.Show("Numer telefonu nie może   zawierać znaków");
                    return;
                }

                if (textBoxTrTelefon.TextLength > 9)
                {
                    MessageBox.Show("Numer telefonu nie może mieć więcej niż 9 cyfr");
                    return;
                }
            }

            if(textBoxTrTelefon.TextLength <9)
            {
                MessageBox.Show("Numer telefonu nie może mieć mniej niż 9 cyfr");
                return;
            }



            SqlCommand command = new SqlCommand("Insert into trener (trener_imie, trener_nazwisko, trener_specjalizacja, trener_doswiadczenie, trener_telefon, trener_email) values (@imie, @nazw, @spec, @dosw, @num, @mail)", connection);
                command.Parameters.AddWithValue("@imie", textBoxTrImie.Text);
                command.Parameters.AddWithValue("@nazw", textBoxTrNazwisko.Text);
                command.Parameters.AddWithValue("@spec", comboBox1.SelectedItem);
                command.Parameters.AddWithValue("@dosw", textBoxDosw.Text);
                command.Parameters.AddWithValue("@num", textBoxTrTelefon.Text);
                command.Parameters.AddWithValue("@mail", textBoxTrMail.Text);
            


            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
            {
                connection.Open();
                adapter.InsertCommand = command;
                adapter.InsertCommand.Connection = connection;
                adapter.InsertCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            MessageBox.Show("Trener został dodany");
            connection.Close();
            this.trenerTableAdapter1.Fill(this.silowniaDataSet1.Trener);
          
        }

        private void buttonEdytujTr_Click(object sender, EventArgs e)
        {
            
            
           

            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            SqlCommand command = new SqlCommand("Update trener  Set trener_imie=@imie, trener_nazwisko= @nazw, trener_specjalizacja=@spec, trener_doswiadczenie=@dosw, trener_telefon= @num, trener_email=@mail where trener_id= " + trener_rekord_id+" ");


            if (string.IsNullOrWhiteSpace(textBoxTrImie.Text) || string.IsNullOrWhiteSpace(textBoxTrNazwisko.Text) || comboBox1.Items == null
                || string.IsNullOrWhiteSpace(textBoxTrTelefon.Text) || string.IsNullOrWhiteSpace(textBoxTrMail.Text) || string.IsNullOrWhiteSpace(textBoxDosw.Text))
            {
                MessageBox.Show("Uzupełnij brakujące pola");
                return;
            }

            string slowo = textBoxTrImie.Text;
            foreach (char litera in slowo)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Imię nie może zawierać cyfr");
                    return;
                }

            }

            if (textBoxTrImie.TextLength < 3)
            {
                MessageBox.Show("Imię musi zawierać przynajmnej 3 litery");
                return;
            }
            string nazwisk = textBoxTrNazwisko.Text;
            foreach (char litera in nazwisk)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Nazwisko nie może zawierać cyfr");
                    return;
                }

            }
            if (textBoxTrNazwisko.TextLength < 3)
            {
                MessageBox.Show("Nazwisko musi zawierać przynajmnej 3 litery");
                return;
            }

            if (!CzySameCyfry(textBoxTrTelefon.Text))
            {
                MessageBox.Show("Numer telefonu musi  nie może zawierać liter");
                return;
            }

            if (textBoxTrTelefon.TextLength > 9)
            {
                MessageBox.Show("Numer telefonu nie może mieć więcej niż 9 cyfr");
                return;
            }
            if (textBoxTrTelefon.TextLength < 9)
            {
                MessageBox.Show("Numer telefonu nie może mieć mniej niż 9 cyfr");
                return;
            }


            command.Parameters.AddWithValue("@imie", textBoxTrImie.Text);
            command.Parameters.AddWithValue("@nazw", textBoxTrNazwisko.Text);
            command.Parameters.AddWithValue("@spec", comboBox1.SelectedItem);
            command.Parameters.AddWithValue("@dosw", textBoxDosw.Text);
            command.Parameters.AddWithValue("@num", textBoxTrTelefon.Text);
            command.Parameters.AddWithValue("@mail", textBoxTrMail.Text);

            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
                {
                connection.Open();
                adapter.UpdateCommand = command;
                adapter.UpdateCommand.Connection = connection;
                adapter.UpdateCommand.ExecuteNonQuery();
                    }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            this.trenerTableAdapter1.Fill(this.silowniaDataSet1.Trener);

            MessageBox.Show("Trener został edytowany");


            connection.Close();
        }

        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            trener_rekord_id =  Convert.ToInt32(dataGridView1.Rows[e.RowIndex].Cells[0].Value);
            textBoxTrImie.Text = dataGridView1.Rows[e.RowIndex].Cells[1].Value.ToString();
            textBoxTrNazwisko.Text = dataGridView1.Rows[e.RowIndex].Cells[2].Value.ToString();
            textBoxTrTelefon.Text = dataGridView1.Rows[e.RowIndex].Cells[5].Value.ToString();
            textBoxTrMail.Text = dataGridView1.Rows[e.RowIndex].Cells[6].Value.ToString();
            textBoxDosw.Text = dataGridView1.Rows[e.RowIndex].Cells[4].Value.ToString();
            comboBox1.SelectedItem = dataGridView1.Rows[e.RowIndex].Cells[3].Value.ToString();



        }

        private void buttonUsunTr_Click(object sender, EventArgs e)
        {
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            SqlCommand command = new SqlCommand("Delete from trener where trener_id=" + trener_rekord_id + "");


            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
                {
                connection.Open();
                adapter.DeleteCommand = command;
                adapter.DeleteCommand.Connection = connection;
                adapter.DeleteCommand.ExecuteNonQuery();
                    }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
           
            this.trenerTableAdapter1.Fill(this.silowniaDataSet1.Trener);
            MessageBox.Show("Trener został usunięty");


            connection.Close();

        }

        private void buttonKlDodaj_Click(object sender, EventArgs e)
        {
           // DateTime wiekKlienta = dateTimePickerKlient.Value;
         
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            if (string.IsNullOrWhiteSpace(textBoxKlImie.Text) || string.IsNullOrWhiteSpace(textBoxKlNazwisko.Text)
                || string.IsNullOrWhiteSpace(textBoxKlTelefon.Text) || string.IsNullOrWhiteSpace(textBoxKlMail.Text) || dateTimePickerKlient.Value ==null)
            {
                MessageBox.Show("Uzupełnij brakujące pola");
                return;
            }

            string imieSp = textBoxKlImie.Text;
            foreach (char litera in imieSp)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Imie nie może zawierać cyfr");
                    return;
                }

            }

            if (textBoxKlImie.TextLength < 3)
            {
                MessageBox.Show("Imię musi zawierać przynajmnej 3 litery");
                return;
            }
            string nazwisk = textBoxKlNazwisko.Text;
            foreach (char litera in nazwisk)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Nazwisko nie może zawierać cyfr");
                    return;
                }

            }
            if (textBoxKlNazwisko.TextLength < 3)
            {
                MessageBox.Show("Nazwisko musi zawierać przynajmnej 3 litery");
                return;
            }

            if (!CzyUkonczone15Lat(dateTimePickerKlient.Value))
            {
                MessageBox.Show("Muszisz mieć ukończone 15 lat żeby móc korzystać z siłowni");
                return;
            }

            foreach (char cyfra in textBoxKlTelefon.Text)
            {
                if (!char.IsDigit(cyfra))
                {
                    MessageBox.Show("Numer telefonu nie może   zawierać znaków");
                    return;
                }
            }
            if (textBoxKlTelefon.TextLength > 9)
            {
                MessageBox.Show("Numer telefonu nie może mieć więcej niż 9 cyfr");
                return;
            }
            if (textBoxKlTelefon.TextLength < 9)
            {
                MessageBox.Show("Numer telefonu nie może mieć mniej niż 9 cyfr");
                return;
            }

            SqlCommand command = new SqlCommand("Insert into klient (klient_imie, klient_nazwisko,  klient_telefon, klient_email, klient_data_urodzenia) values (@imie, @nazw, @num, @mail, @dataUrodz)", connection);
            command.Parameters.AddWithValue("@imie", textBoxKlImie.Text);
            command.Parameters.AddWithValue("@nazw", textBoxKlNazwisko.Text);
            command.Parameters.AddWithValue("@num", textBoxKlTelefon.Text);
            command.Parameters.AddWithValue("@mail", textBoxKlMail.Text);
            command.Parameters.AddWithValue("@dataUrodz", dateTimePickerKlient.Value);



            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
            {
                connection.Open();
                adapter.InsertCommand = command;
                adapter.InsertCommand.Connection = connection;
                adapter.InsertCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            connection.Close();
            MessageBox.Show("Klient został dodany");

            this.klientTableAdapter1.Fill(this.silowniaDataSet1.Klient);

        }

        private void buttonKlEdytuj_Click(object sender, EventArgs e)
        {
            DateTime wiekKlienta = dateTimePickerKlient.Value;


            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            SqlCommand command = new SqlCommand("Update klient  Set klient_imie=@imie, klient_nazwisko= @nazw, klient_telefon= @num, klient_email=@mail, klient_data_urodzenia =  @dataUrodz where klient_id= " + klient_rekord_id + " ");


            if (string.IsNullOrWhiteSpace(textBoxKlImie.Text) || string.IsNullOrWhiteSpace(textBoxKlNazwisko.Text)
                || string.IsNullOrWhiteSpace(textBoxKlTelefon.Text) || string.IsNullOrWhiteSpace(textBoxKlMail.Text) || dateTimePickerKlient.Value == null)
            {
                MessageBox.Show("Uzupełnij brakujące pola");
                return;
            }

            string imie = textBoxKlImie.Text;
            foreach (char litera in imie)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Imie nie może zawierać cyfr");
                    return;
                }

            }

            if (textBoxKlImie.TextLength < 3)
            {
                MessageBox.Show("Imię musi zawierać przynajmnej 3 litery");
                return;
            }



            string nazwisk = textBoxKlNazwisko.Text;
            foreach (char litera in nazwisk)
            {
                if (!char.IsLetter(litera))
                {
                    MessageBox.Show("Nazwisko nie może zawierać cyfr");
                    return;
                }

            }
            if (textBoxKlNazwisko.TextLength < 3)
            {
                MessageBox.Show("Nazwisko musi zawierać przynajmnej 3 litery");
                return;
            }

            if (!CzyUkonczone15Lat(dateTimePickerKlient.Value))
            {
                MessageBox.Show("Muszisz mieć ukończone 15 lat żeby móc korzystać z siłowni");
                return;
            }


            foreach (char cyfra in textBoxKlTelefon.Text)
            {
                if (!char.IsDigit(cyfra))
                {
                    MessageBox.Show("Numer telefonu nie może   zawierać znaków");
                    return;
                }
            }

                if (textBoxKlTelefon.TextLength > 9)
                {
                    MessageBox.Show("Numer telefonu nie może mieć więcej niż 9 cyfr");
                    return;
                }
                if (textBoxKlTelefon.TextLength < 9)
                {
                    MessageBox.Show("Numer telefonu nie może mieć mniej niż 9 cyfr");
                    return;
                }







                command.Parameters.AddWithValue("@imie", textBoxKlImie.Text);
                command.Parameters.AddWithValue("@nazw", textBoxKlNazwisko.Text);
                command.Parameters.AddWithValue("@num", textBoxKlTelefon.Text);
                command.Parameters.AddWithValue("@mail", textBoxKlMail.Text);
                command.Parameters.AddWithValue("@dataUrodz", dateTimePickerKlient.Value);



                connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

                try
                {
                    connection.Open();
                    adapter.UpdateCommand = command;
                    adapter.UpdateCommand.Connection = connection;
                    adapter.UpdateCommand.ExecuteNonQuery();
                }
                catch (Exception ex)
                {
                    MessageBox.Show(ex.Message);
                }
                this.klientTableAdapter1.Fill(this.silowniaDataSet1.Klient);

                MessageBox.Show("Klient został edytowany");

                connection.Close();
            
        }

        private void dataGridView2_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            klient_rekord_id = Convert.ToInt32(dataGridView2.Rows[e.RowIndex].Cells[0].Value);
            textBoxKlImie.Text = dataGridView2.Rows[e.RowIndex].Cells[1].Value.ToString();
            textBoxKlNazwisko.Text = dataGridView2.Rows[e.RowIndex].Cells[2].Value.ToString();
            textBoxKlTelefon.Text = dataGridView2.Rows[e.RowIndex].Cells[3].Value.ToString();
            textBoxKlMail.Text = dataGridView2.Rows[e.RowIndex].Cells[4].Value.ToString();
            dateTimePickerKlient.Value = Convert.ToDateTime(dataGridView2.Rows[e.RowIndex].Cells[5].Value);


        }

        private void buttonKlUsun_Click(object sender, EventArgs e)
        {
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            SqlCommand command = new SqlCommand("Delete from klient where klient_id=" + klient_rekord_id + "");


            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
            {
                connection.Open();
                adapter.DeleteCommand = command;
                adapter.DeleteCommand.Connection = connection;
                adapter.DeleteCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            MessageBox.Show("Klient został usunięty");


            connection.Close();
            this.klientTableAdapter1.Fill(this.silowniaDataSet1.Klient);
        }

       
        //Trenerzy przy karnecie

        private void dataGridView3_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            trener_karnet_rekord_id = Convert.ToInt32(dataGridView3.Rows[e.RowIndex].Cells[0].Value);

        }
        //Klienci przy karnecie
        private void dataGridView4_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            klient_karnet_rekord_id = Convert.ToInt32(dataGridView4.Rows[e.RowIndex].Cells[0].Value);

        }

        //karnety
        private void dataGridView5_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            karnet_rekord_id = Convert.ToInt32(dataGridView5.Rows[e.RowIndex].Cells[0].Value);
            dateTimePicker1.Value = Convert.ToDateTime(dataGridView5.Rows[e.RowIndex].Cells[2].Value);
            dateTimePicker2.Value = Convert.ToDateTime(dataGridView5.Rows[e.RowIndex].Cells[3].Value);
            textBoxLiczbaDni.Text = dataGridView5.Rows[e.RowIndex].Cells[1].Value.ToString();
            textBoxCena.Text = dataGridView5.Rows[e.RowIndex].Cells[6].Value.ToString();
            comboBoxRodzaj.SelectedItem = dataGridView5.Rows[e.RowIndex].Cells[7].Value.ToString();






        }

        private void buttonKaDodaj_Click(object sender, EventArgs e)
        {
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

           

           

            SqlCommand command = new SqlCommand("Insert into karnet (karnet_data_rozp, karnet_data_zakon,karnet_dlugosc, klient_id, trener_id, cena, rodzaj) values (@karnet_data_rozp, @karnet_data_zakon, @karnet_dlugosc, @klient_id, @trener_id, @cena, @rodzaj)", connection);
            
            if (dateTimePicker1.Value > dateTimePicker2.Value)
            {
                MessageBox.Show("Data zakończenia nie może przyjmować wcześniejszej wartośći(daty) niż Data rozpoczęczia ");
            }

            command.Parameters.AddWithValue("@karnet_data_rozp", dateTimePicker1.Value) ;
            command.Parameters.AddWithValue("@karnet_data_zakon", dateTimePicker2.Value);
            command.Parameters.AddWithValue("@karnet_dlugosc", textBoxLiczbaDni.Text);
            command.Parameters.AddWithValue("@klient_id", klient_karnet_rekord_id);
            command.Parameters.AddWithValue("@trener_id", trener_karnet_rekord_id);
            command.Parameters.AddWithValue("@cena", textBoxCena.Text);
            command.Parameters.AddWithValue("@rodzaj",  comboBoxRodzaj.SelectedItem);



            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
            {
                connection.Open();
                adapter.InsertCommand = command;
                adapter.InsertCommand.Connection = connection;
                adapter.InsertCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            MessageBox.Show("Karnet został dodany");

            connection.Close();
            this.karnetTableAdapter1.Fill(this.silowniaDataSet1.Karnet);
        }
        int ilosc_dni;

        private void IloscDni()
        {
            TimeSpan span = dateTimePicker2.Value - dateTimePicker1.Value;
            ilosc_dni = span.Days+1;
            String ilosc = ilosc_dni.ToString();
            textBoxLiczbaDni.Text = ilosc;
        }

  
        

        private void dateTimePicker2_ValueChanged(object sender, EventArgs e)
        {
            IloscDni();
            ObliczCene();
        }

        private void dateTimePicker1_ValueChanged(object sender, EventArgs e)
        {
            IloscDni();
            ObliczCene();

        }

        private void ObliczCene()
        {

            int cena;
            if (comboBoxRodzaj.SelectedIndex == 0)
            {
                cena = 5 * ilosc_dni;
                String cena_karnetu = cena.ToString();
                textBoxCena.Text = cena_karnetu;


            }
            else if(comboBoxRodzaj.SelectedIndex == 1)
            {
                cena = 10 * ilosc_dni;
                String cena_karnetu = cena.ToString();
                textBoxCena.Text = cena_karnetu;



            }
            else if(comboBoxRodzaj.SelectedIndex == 2)
            {
                cena = 15 * ilosc_dni;
                String cena_karnetu = cena.ToString();
                textBoxCena.Text = cena_karnetu;



            }




        }

        private void comboBoxRodzaj_SelectedIndexChanged(object sender, EventArgs e)
        {
            ObliczCene();
        }

        private void buttonKaEdytuj_Click(object sender, EventArgs e)
        {
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();


            if (dateTimePicker1.Value > dateTimePicker2.Value)
            {
                MessageBox.Show("Data zakończenia nie może przyjmować wcześniejszej wartośći(daty) niż Data rozpoczęczia ");
            }

            SqlCommand command = new SqlCommand("Update karnet Set karnet_data_rozp=@karnet_data_rozp, karnet_data_zakon=@karnet_data_zakon,karnet_dlugosc=@karnet_dlugosc, klient_id=@klient_id, trener_id= @trener_id, cena=@cena, rodzaj=@rodzaj where karnet_id = "+karnet_rekord_id+"");
            command.Parameters.AddWithValue("@karnet_data_rozp", dateTimePicker1.Value);
            command.Parameters.AddWithValue("@karnet_data_zakon", dateTimePicker2.Value);
            command.Parameters.AddWithValue("@karnet_dlugosc", textBoxLiczbaDni.Text);
            command.Parameters.AddWithValue("@klient_id", klient_karnet_rekord_id);
            command.Parameters.AddWithValue("@trener_id", trener_karnet_rekord_id);
            command.Parameters.AddWithValue("@cena", textBoxCena.Text);
            command.Parameters.AddWithValue("@rodzaj", comboBoxRodzaj.SelectedItem);



            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
            {
                connection.Open();
                adapter.UpdateCommand = command;
                adapter.UpdateCommand.Connection = connection;
                adapter.UpdateCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            this.karnetTableAdapter1.Fill(this.silowniaDataSet1.Karnet);

            MessageBox.Show("Karnet został edytowany");

            connection.Close();
        }

        private void buttonKaUsun_Click(object sender, EventArgs e)
        {
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            SqlCommand command = new SqlCommand("Delete from karnet where karnet_id=" + karnet_rekord_id + "");


            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";

            try
            {
                connection.Open();
                adapter.DeleteCommand = command;
                adapter.DeleteCommand.Connection = connection;
                adapter.DeleteCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            MessageBox.Show("Karnet został usunięty");

            connection.Close();
            this.karnetTableAdapter1.Fill(this.silowniaDataSet1.Karnet);
        }
        //karnety przy wejsciach
        private void dataGridView6_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            karnet_wejscia_id = Convert.ToInt32(dataGridView6.Rows[e.RowIndex].Cells[0].Value);

        }

        private void buttonWejscie_Click(object sender, EventArgs e)
        {
            


            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";


            connection.Open();

            SqlCommand commandlicznik = new SqlCommand("SELECT licznik FROM dostepnosc WHERE dostepnosc_id = (SELECT max(dostepnosc_id) FROM dostepnosc)", connection);
            l = Convert.ToInt32(commandlicznik.ExecuteScalar());

            if (l >= 30)
            {
                MessageBox.Show("Nie przekraczaj limitu");
                return;
            }

            SqlCommand command = new SqlCommand("Insert into wejscie (godzina_wejscia, karnet_id) values (@godzina_wejscia, @karnet_id)  SELECT SCOPE_IDENTITY()", connection);

            command.Parameters.AddWithValue("@godzina_wejscia", DateTime.Now);
            command.Parameters.AddWithValue("@karnet_id", karnet_wejscia_id);


            int x = Convert.ToInt32(command.ExecuteScalar());





            SqlCommand commandWejscie = new SqlCommand("Insert into dostepnosc (wejscie_id, wyjscie_id, licznik, data, karnet_id) values ("+x+", null, @licznik, @data, @karnet_id)", connection);
            commandWejscie.Parameters.AddWithValue("@licznik", l+1);
            commandWejscie.Parameters.AddWithValue("@data", DateTime.Now);
            commandWejscie.Parameters.AddWithValue("@karnet_id", karnet_wejscia_id);

            try
            {
                adapter.InsertCommand = commandWejscie;
                adapter.InsertCommand.Connection = connection;




                adapter.InsertCommand = commandWejscie;
                adapter.InsertCommand.Connection = connection;


    

                adapter.InsertCommand.ExecuteNonQuery();



            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }

            label20.Text = (l+1).ToString();

            MessageBox.Show("Wejście zostało dodane");

            connection.Close();


            this.wejscieTableAdapter1.Fill(this.silowniaDataSet1.Wejscie);
            this.dostepnoscTableAdapter.Fill(this.silowniaDataSet1.Dostepnosc);


        }

        private void buttonWyjscie_Click(object sender, EventArgs e)
        {


            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";


            connection.Open();


            SqlCommand commandlicznik = new SqlCommand("SELECT licznik FROM dostepnosc WHERE dostepnosc_id = (SELECT max(dostepnosc_id) FROM dostepnosc)", connection);
            l = Convert.ToInt32(commandlicznik.ExecuteScalar());
            label20.Text = (l - 1).ToString();

            if (l < 1)
            {
                MessageBox.Show("Liczba osób nie może mniejsza niż zero");
                return;
            }

            SqlCommand command = new SqlCommand("Insert into wyjscie (godzina_wyjscia, karnet_id) values (@godzina_wyjscia, @karnet_id)  SELECT SCOPE_IDENTITY()", connection);

            command.Parameters.AddWithValue("@godzina_wyjscia", DateTime.Now);
            command.Parameters.AddWithValue("@karnet_id", karnet_wejscia_id);


            int x = Convert.ToInt32(command.ExecuteScalar());
             


            SqlCommand commandWyjscie = new SqlCommand("Insert into dostepnosc (wejscie_id, wyjscie_id, licznik, data, karnet_id) values (null,@wyjscie, @licznik, @data, @karnet_id)", connection);            

            commandWyjscie.Parameters.AddWithValue("@licznik", l - 1);
            commandWyjscie.Parameters.AddWithValue("@wyjscie", x);
            commandWyjscie.Parameters.AddWithValue("@data", DateTime.Now);
            commandWyjscie.Parameters.AddWithValue("@karnet_id", karnet_wejscia_id);

            try
            {
                adapter.InsertCommand = command;
                adapter.InsertCommand.Connection = connection;


                adapter.InsertCommand = commandWyjscie;
                adapter.InsertCommand.Connection = connection;

                adapter.InsertCommand.ExecuteNonQuery();



            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }

            MessageBox.Show("Wyjście zostało dodane");

            connection.Close();
            this.wyjscieTableAdapter1.Fill(this.silowniaDataSet1.Wyjscie);
            this.dostepnoscTableAdapter.Fill(this.silowniaDataSet1.Dostepnosc);


        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {
            trenerBindingSource.Filter = "[trener_imie] like '%" + textBox1.Text + "%' " +
                "OR [trener_nazwisko] like '%" + textBox1.Text + "%'";
              

        }

        private void buttonFiltrPoDacie_Click(object sender, EventArgs e)
        {
            dostepnoscBindingSource.Filter = "data >= '" + dateTimePickerWyszukaj1.Value + "' And data <= '" + dateTimePickerWyszukaj2.Value + "'";

        }

        private void textBoxDostId_TextChanged(object sender, EventArgs e)
        {

            dostepnoscBindingSource.Filter = string.Format("convert(karnet_id, 'System.String') Like '%{0}%' ", textBoxDostId.Text);

        }

        private void textBox2_TextChanged(object sender, EventArgs e)
        {
            klientBindingSource.Filter = "[klient_imie] like '%" + textBox2.Text + "%' " +
               "OR [klient_nazwisko] like '%" + textBox2.Text + "%' OR [klient_telefon] like '%" + textBox2.Text + "%'  OR [klient_email] like '%" + textBox2.Text + "%'";
        }

        private void textBox3_TextChanged(object sender, EventArgs e)
        {
            klientBindingSource.Filter = "[klient_imie] like '%" + textBox3.Text + "%' " +
              "OR [klient_nazwisko] like '%" + textBox3.Text + "%' OR [klient_telefon] like '%" + textBox3.Text + "%'  OR [klient_email] like '%" + textBox3.Text + "%'";
        }

        private void textBox4_TextChanged(object sender, EventArgs e)
        {
            trenerBindingSource.Filter = "[trener_imie] like '%" + textBox4.Text + "%' " +
               "OR [trener_nazwisko] like '%" + textBox4.Text + "%'";

        }

        private void textBox5_TextChanged(object sender, EventArgs e)
        {
            karnetBindingSource.Filter = string.Format("convert(karnet_id, 'System.String') Like '%{0}%' ", textBoxIdKarnet.Text);

        }

        private void buttonUsunWejscie_Click(object sender, EventArgs e)
        {
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";


            connection.Open();


            SqlCommand commandlicznik = new SqlCommand("SELECT licznik FROM dostepnosc WHERE dostepnosc_id = (SELECT max(dostepnosc_id) FROM dostepnosc)", connection);
            l = Convert.ToInt32(commandlicznik.ExecuteScalar());
            label20.Text = (l - 1).ToString();

            if (l < 1)
            {
                MessageBox.Show("Liczba osób nie może mniejsza niż zero");
                return;
            }

            SqlCommand commandDost = new SqlCommand("Delete from dostepnosc where wejscie_id=" + wejscie_id + "");

            SqlCommand command = new SqlCommand("Delete from wejscie where wejscie_id=" + wejscie_id + "");



            try
            {
                adapter.DeleteCommand = commandDost;
                adapter.DeleteCommand.Connection = connection;
                adapter.DeleteCommand.ExecuteNonQuery();


                adapter.DeleteCommand = command;

                adapter.DeleteCommand.Connection = connection;
                adapter.DeleteCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            MessageBox.Show("Wejście zostało usunięte");

            connection.Close();
            this.wejscieTableAdapter1.Fill(this.silowniaDataSet1.Wejscie);
            this.dostepnoscTableAdapter.Fill(this.silowniaDataSet1.Dostepnosc);

        }

        private void dataGridView7_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            wejscie_id= Convert.ToInt32(dataGridView7.Rows[e.RowIndex].Cells[0].Value);
        }

        private void dataGridView8_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            wyjscie_id = Convert.ToInt32(dataGridView8.Rows[e.RowIndex].Cells[0].Value);

        }

        private void buttonUsunWyjscia_Click(object sender, EventArgs e)
        {
            SqlDataAdapter adapter = new SqlDataAdapter();
            SqlConnection connection = new SqlConnection();

            SqlCommand commandDost = new SqlCommand("Delete from dostepnosc where wyjscie_id=" + wyjscie_id + "");

            SqlCommand command = new SqlCommand("Delete from wyjscie where wyjscie_id=" + wyjscie_id + "");


            connection.ConnectionString = "Data Source = DESKTOP-4EM5NV1; Initial Catalog = Silownia; Trusted_Connection=True;";


            connection.Open();

            SqlCommand commandlicznik = new SqlCommand("SELECT licznik FROM dostepnosc WHERE dostepnosc_id = (SELECT max(dostepnosc_id) FROM dostepnosc)", connection);
            l = Convert.ToInt32(commandlicznik.ExecuteScalar());

            if (l >= 30)
            {
                MessageBox.Show("Nie przekraczaj limitu");
                return;
            }

            try
            {
                adapter.DeleteCommand = commandDost;
                adapter.DeleteCommand.Connection = connection;
                adapter.DeleteCommand.ExecuteNonQuery();


                adapter.DeleteCommand = command;

                adapter.DeleteCommand.Connection = connection;
                adapter.DeleteCommand.ExecuteNonQuery();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
            MessageBox.Show("Wyjście zostało usunięte");

            connection.Close();
            this.wyjscieTableAdapter1.Fill(this.silowniaDataSet1.Wyjscie);
            this.dostepnoscTableAdapter.Fill(this.silowniaDataSet1.Dostepnosc);

        }
    }
}
