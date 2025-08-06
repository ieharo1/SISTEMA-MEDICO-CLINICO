//Daniel Arcos
//Joel Ona
//Acesoeamiento de la estudiante de nutrion Daniela Arcos
using System;
namespace Proyecto_2A__ej1_Creacion_2_Clases
{
    class Hombre
    {
        //Encapsulamiento
        public int edad;
        public double peso;
        public int estatura;
        private string categoria_H;
        private double basal_H;
        //Contructor
        public Hombre(int estatura, double peso, int edad)
        {
            this.edad = edad;
            this.peso = peso;
            this.estatura = estatura;
            categoria_H = "Sin clasificacion";
            basal_H = 0.0;
        }
        //Calculo del gasto metebolico basal
        private double Basal_Hombre(double o)
        {
            //Gasto matebolico basal;
            //Gasto de calorias cuando el usuario esta en estado de reposo
            if (o <= 29.9)
            { basal_H = (10 * peso) + (6.25 * estatura) - (5 * edad) + 5; }
            else
            {
                basal_H = estatura - 100 - ((estatura - 150)) / 4;
                basal_H = ((peso - basal_H) * 0.25) + basal_H;
                basal_H = Math.Round(basal_H, 2);
            }
            return basal_H;
        }
        public string Ubicacion_Categoria(string linea)
        {
            double ims = 0.0, estatura_metros = 0.0;
            estatura_metros = estatura * 0.01;
            ims = peso / Math.Pow(estatura_metros, 2);
            //Ims indice de masa corpoal
            if (edad >= 60)//Clasificacion de indice de masa corpoal
            {
                if (ims < 16)
                { categoria_H = "Desnutricion severa"; }
                else if ((ims >= 16) && (ims <= 16.9))
                { categoria_H = ("Desnutricion moderada"); }
                else if ((ims >= 17) && (ims <= 18.4))
                { categoria_H = ("Desnutricion leve"); }
                else if ((ims >= 18.5) && (ims <= 21.9))
                { categoria_H = ("Peso insuficiente"); }
                else if ((ims >= 22) && (ims <= 22.9))
                { categoria_H = ("Peso normal"); }
                else if ((ims >= 27) && (ims <= 29.9))
                { categoria_H = ("Sobrepeso"); }
                else if ((ims >= 30) && (ims < 34.9))
                { categoria_H = ("Obesidad grado 1"); }
                else if ((ims >= 35) && (ims <= 39.9))
                { categoria_H = ("Obesidad grado 2"); }
                else if ((ims >= 40) && (ims <= 40.9))
                { categoria_H = ("Obesidad grado 3"); }
                else if (ims >= 50)
                { categoria_H = ("Obesidad grado 4"); }
            }
            else if (edad >= 18)
            {
                if (ims < 16)
                { categoria_H = ("Delgadez severa"); }
                else if ((ims >= 16) && (ims <= 16.9))
                { categoria_H = ("Delgadez moderada"); }
                else if ((ims >= 17) && (ims <= 18.49))
                { categoria_H = ("Degaldez aceptable"); }
                else if (ims < 18.5)
                { categoria_H = ("Bajo peso"); }
                else if ((ims >= 18.5) && (ims <= 24.9))
                { categoria_H = ("Normal"); }
                else if ((ims >= 25) && (ims <= 29.9))
                { categoria_H = ("Sobrepeso"); }
                else if ((ims >= 30) && (ims <= 34.9))
                { categoria_H = ("Obesidad grado 1"); }
                else if ((ims >= 35) && (ims <= 39.9))
                { categoria_H = ("Obesidad grado 2"); }
                else if (ims >= 40)
                { categoria_H = ("Obesidad grado 3"); }
            }
            if (linea == "hombre")
                Basal_Hombre(ims);
            return categoria_H;
        }
    }
    class Mujer
    {
        //Encapsulamiento
        private int edad;
        private double peso;
        private int estatura;
        private string categoria_M;
        private double basal_M;
        //Contructor
        public Mujer(Hombre Hombre1)
        {
            edad = Hombre1.edad;
            peso = Hombre1.peso;
            estatura = Hombre1.estatura;
            categoria_M = "Sin clasificacion";
            basal_M = 0.0;
        }
        public double Basal_Mujer(string Ubicacion_Mujer)
        {
            categoria_M = Ubicacion_Mujer;
            double estaura__metros = estatura * 0.01;
            double o = peso / Math.Pow(estaura__metros, 2);
            if (o <= 29.9)
            { basal_M = 10 * peso + 6.25 * estaura__metros - 5 * edad - 161; }
            else
            {
                basal_M = estaura__metros - 100 - ((estaura__metros - 150)) / 2.5;
                basal_M = ((peso - basal_M) * 0.25) + basal_M;
            }
            return basal_M;
        }
    }
    class Program
    {
        static void Main(string[] args)
        {
            int estatura = 170, edad = 19;
            double peso = 78.0;
            string linea1 = "hombre", linea2 = "mujer";
            Hombre hombre1 = new Hombre(estatura, peso, edad);
            hombre1.Ubicacion_Categoria(linea1);
            Mujer mujer1 = new Mujer(hombre1);
            mujer1.Basal_Mujer(hombre1.Ubicacion_Categoria(linea2));
            Console.ReadKey();
        }
    }
}