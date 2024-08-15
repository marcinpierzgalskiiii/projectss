using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Przychodnia
{
    public class CzynnośćMedyczna
    {
        string nazwa;

        static List<CzynnośćMedyczna> listaCzynnościMedycznych = new List<CzynnośćMedyczna>();

        public string Nazwa { get => nazwa; set => nazwa = value; }
        public static List<CzynnośćMedyczna> ListaCzynnościMedycznych { get => listaCzynnościMedycznych; set => listaCzynnościMedycznych = value; }

        public override string ToString()
        {
            return nazwa;
        }
    }
}
