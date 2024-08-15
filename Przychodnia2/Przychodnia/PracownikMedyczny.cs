using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Przychodnia
{
    public class PracownikMedyczny
    {
        string imię, nazwisko;
        List<CzynnośćMedyczna> listaUprawnień = new List<CzynnośćMedyczna>();
        static List<PracownikMedyczny> listaPracowników = new List<PracownikMedyczny>();

        public string Imię { get => imię; set => imię = value; }
        public string Nazwisko { get => nazwisko; set => nazwisko = value; }
        public List<CzynnośćMedyczna> ListaUprawnień { get => listaUprawnień; set => listaUprawnień = value; }
        public static List<PracownikMedyczny> ListaPracowników { get => listaPracowników; set => listaPracowników = value; }

        public override string ToString()
        {
            return imię+" "+nazwisko;
        }
    }
}
