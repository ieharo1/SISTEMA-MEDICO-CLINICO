using System;
using System.Collections.Generic;
using System.Text;

namespace OOPExercise
{
    public class Patient : Person
    {
        public Patient(string nombre, string app)
        {
            FirstName = nombre;
            LastName = app;
        }
        public override void Greet()
        {            
            Console.WriteLine("Hello, I'm a Patient!. My name is {0} {1}", FirstName, LastName);
        }
    }
}
