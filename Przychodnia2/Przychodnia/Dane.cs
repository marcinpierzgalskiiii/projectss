using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Runtime.Serialization.Formatters.Binary;
using System.IO;

namespace Przychodnia
{
    public static class Dane
    {
        static public void Deserialize()
        {
            //BinaryFormatter bf = new BinaryFormatter();
            //FileStream fs = new FileStream("c://dane przychodni.bin",FileMode.Open,FileAccess.Read);

            CzynnośćMedyczna cz = new CzynnośćMedyczna();
            cz.Nazwa = "Wizyta lekarska";
            CzynnośćMedyczna.ListaCzynnościMedycznych.Add(cz);
            
            Pacjent p1 = new Pacjent();
            p1.Imię = "Jan";
            p1.Nazwisko = "Kolwalski";
            p1.Pesel = "1111";
            p1.Email = "jk@gmail.com";
            Pacjent.ListaPacjentów.Add(p1);

            PracownikMedyczny pr = new PracownikMedyczny();
            pr.Imię = "Piotr";
            pr.Nazwisko = "Nowak";

            pr.ListaUprawnień.Add(cz);

        }
    }
}
