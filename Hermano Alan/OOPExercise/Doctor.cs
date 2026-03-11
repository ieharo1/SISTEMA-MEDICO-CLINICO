using System;
using System.Collections.Generic;
using System.Globalization;
using System.Text;

namespace OOPExercise
{
    class Doctor : Person
    {
        public Doctor(string nombre, string app) {
            FirstName = nombre;
            LastName = app;
        }
        public override void Greet()
        {
            Console.WriteLine("Hello, I'm a Doctor!. My name is {0} {1}", FirstName, LastName);
        }
    }
}
