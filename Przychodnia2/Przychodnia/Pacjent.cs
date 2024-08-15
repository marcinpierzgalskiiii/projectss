using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Przychodnia
{
    public class Pacjent
    {
        string imię, nazwisko, pesel, email;

        public string Imię { get => imię; set => imię = value; }
        public string Nazwisko { get => nazwisko; set => nazwisko = value; }
        public string Pesel { get => pesel; set => pesel = value; }
        public string Email { get => email; set => email = value; }
        public static List<Pacjent> ListaPacjentów { get => listaPacjentów; set => listaPacjentów = value; }

        static List<Pacjent> listaPacjentów = new List<Pacjent>();
    }
}
