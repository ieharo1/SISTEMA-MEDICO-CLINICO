using System;

namespace App
{
    class Program
    {
        static void Main(string[] args)
        {
            int a, b;
            Console.WriteLine("Ingrese el 1er digitos");
            a = int.Parse(Console.ReadLine());
            Console.WriteLine("Ingrese el 2do digitos");
            b = int.Parse(Console.ReadLine());
            Console.WriteLine(Hola(a, b));
            Console.WriteLine(Hola2(a, b));
          

        }
        static int Hola(int uno, int dos)
        {
            int respuesta;
            respuesta=uno + dos;
            return respuesta;
        }
        static int Hola2(int uno, int dos) => uno + dos;
    }
}
